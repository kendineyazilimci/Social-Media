<?php
namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use App\Helpers\SessionManager;


class Home extends BaseController
{
    public function index()
    {
        // CodeIgniter oturum kütüphanesi
        $session = session();

        $output = view('headerfooter/header') . view('anasayfa/homecontent');

        // Oturum bilgilerini kontrol et
        if ($session->has('last_activity')) {
            $sessionLifetime = ini_get("session.gc_maxlifetime");
            $remainingTime = $sessionLifetime - (time() - $session->get('last_activity'));

            $output .= "<pre>";
            $output .= "Session Data: " . print_r($session->get(), true) . "<br>";
            $output .= "Session Remaining Time: " . $remainingTime . " seconds<br>";
            $output .= "</pre>";
        } else {
            $output .= "<p>Oturum başlatılmamış veya sona ermiş.</p>";
        }

        $output .= view('headerfooter/footer') . view('headerfooter/sidebar');

        return $output;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ozan</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <script>
        function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const headerRight = document.getElementById('header-right');
        const footerRight = document.getElementById('footer-right');
        const homecontent = document.getElementById('homecontent');
        const toggleButton = document.querySelector('.toggle-btn');

        sidebar.classList.toggle('open');
        headerRight.classList.toggle('shifted');
        footerRight.classList.toggle('shifted');
        homecontent.classList.toggle('shifted');

        toggleButton.classList.toggle('open'); 
        toggleButton.textContent = toggleButton.classList.contains('open') ? '✖' : '☰';
    }
</script>
</body>
</html>