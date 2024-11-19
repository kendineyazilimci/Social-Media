<?php
namespace App\Controllers\Backend;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        echo view ('Frontend/header');
        echo view ('Frontend/homecontent');
        echo view ('Frontend/footer');
        echo view ('Frontend/sidebar');
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

        // Sidebar açma/kapatma
        sidebar.classList.toggle('open');
        headerRight.classList.toggle('shifted');
        footerRight.classList.toggle('shifted');
        homecontent.classList.toggle('shifted');

        // Butonun durumunu güncelle
        toggleButton.classList.toggle('open'); // 'open' sınıfını ekle veya kaldır
        toggleButton.textContent = toggleButton.classList.contains('open') ? '✖' : '☰'; // Buton metnini değiştir
    }
</script>
</body>
</html>