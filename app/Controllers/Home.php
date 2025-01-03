<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $session = session();

        $output = view('headerfooter/header') . view('anasayfa/homecontent');

        if ($session->has('email')) {
            $output .= "<pre>";
            $output .= "Session Data: " . print_r($session->get(), true) . "<br>";
            $output .= "Hoşgeldiniz " . $session->get('email') . "<br>";
            $output .= "</pre>";
        } else {
            $output .= "<p>Oturum başlatılmamış veya sona ermiş.</p>";
        }

        $output .= view('headerfooter/footer') . view('headerfooter/sidebar');

        return $output;
    }
    
}
?>
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