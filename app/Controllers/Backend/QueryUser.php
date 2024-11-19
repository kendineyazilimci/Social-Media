<?php
namespace App\Controllers\Backend;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;


class queryUser extends Controller
{
    public function queryUser()
    {
        $uri = "mongodb+srv://OzanAdmin:1234@ozan.zgre1.mongodb.net/?retryWrites=true&w=majority&appName=Ozan";
        $client = new Client($uri);
        $vt = $this->request->getPost('vt');


        if ($this->request->getPost('submit') === 'Submit') {
            if ($vt == "Deneme") {
                $collection = $client->selectDatabase('ilkDatabaseDeneme')->selectCollection('users');
            } else if ($vt == "Gerçek") {
                $collection = $client->selectDatabase('Kullanıcılar')->selectCollection('Users');
            } else {
                echo "Hatalı Veritabanı Adı";
            }
            try {

                // Dinamik olarak dolu alanları al ve sorguyu oluştur
                $queryData = [];
                if ($this->request->getPost('name')) {
                    $queryData['name'] = $this->request->getPost('name');
                }
                if ($this->request->getPost('surname')) {
                    $queryData['surname'] = $this->request->getPost('surname');
                }
                if ($this->request->getPost('age')) {
                    $queryData['age'] = (int) $this->request->getPost('age'); // Sayısal tip
                }
                if ($this->request->getPost('tel')) {
                    $queryData['tel'] = $this->request->getPost('tel');
                }
                if ($this->request->getPost('email')) {
                    $queryData['email'] = $this->request->getPost('email');
                }

                // Sorgu işlemi: Dinamik sorgu ile eşleşen kullanıcıları bul
                $users = $collection->find($queryData);

                // Kullanıcı bilgilerini ekrana yazdır
                foreach ($users as $user) {
                    echo "İsim: " . ($user['name'] ?? 'Bilinmiyor') . "<br>";
                    echo "Soyisim: " . ($user['surname'] ?? 'Bilinmiyor') . "<br>";
                    echo "Yaş: " . ($user['age'] ?? 'Bilinmiyor') . "<br>";
                    echo "Telefon Numarası: " . ($user['tel'] ?? 'Bilinmiyor') . "<br>";
                    echo "E-mail: " . ($user['email'] ?? 'Bilinmiyor') . "<br><hr>";
                }
            } catch (Exception $e) {
                // Hata mesajı
                printf("Hata: %s\n", $e->getMessage());
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query User</title>
</head>
<body>
    <form action="/ipvt2/queryuser" method="post">
        <h1>Bağlanmak İstediğiniz Veritabanını Yazınız:</h1>
        <p>Kabul Edilenler: Deneme, Gerçek.</p>
        <input type="text" id="vt" name="vt">
        <h2>Güncellenecek Kullanıcı Bilgileri</h2>
        <p>İsim:</p>
        <input type="text" id="name" name="name">

        <p>Soyisim:</p>
        <input type="text" id="surname" name="surname">
        
        <p>Yaş:</p>
        <input type="number" id="age" name="age"><br>
        
        <p>Telefon Numarası:</p>
        <input type="number" id="tel" name="tel"><br>
        
        <p>E-mail:</p>
        <input type="text" id="email" name="email"><br><br>
        
        <input type="submit" name="submit" value="Submit"><br><br>
    </form>
</body>
</html>
