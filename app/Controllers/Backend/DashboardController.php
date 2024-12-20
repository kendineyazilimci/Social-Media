<?php
namespace App\Controllers\Backend;
use App\Controllers\BaseController;
use MongoDB\Client;
use Exception;

class Dashboard extends BaseController
{
    public function deneme()
    {

        session_start();
        include 'config.php';
        
        // Oturum süresi sınırı (saniye cinsinden)
        $timeout_duration = 300;
        
        // Son etkinlik zamanını kontrol et ve oturum süresi dolmuşsa çıkış yap
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
            session_unset();     // Oturum değişkenlerini temizle
            session_destroy();   // Oturumu sonlandır
            header("Location: login.php");
            exit();
        }
        
        // Son etkinlik zamanını güncelle
        $_SESSION['LAST_ACTIVITY'] = time();
        
        if (!isset($_SESSION['email'])) {
            header("Location: login.php");
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['yks_photo']) && $_FILES['yks_photo']['error'] == 0) {
                $upload_dir = 'uploads/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $upload_file = $upload_dir . basename($_FILES['yks_photo']['name']);
                
                if (move_uploaded_file($_FILES['yks_photo']['tmp_name'], $upload_file)) {
                    header("Location: success.php");
                    exit();
                } else {
                    echo "Dosya yükleme sırasında bir hata oluştu.";
                }
            } else {
                echo "Dosya yüklenirken bir hata oluştu.";
            }
        }
    }
}
?>