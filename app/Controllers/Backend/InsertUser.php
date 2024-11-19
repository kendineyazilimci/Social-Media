<?php
namespace App\Controllers\Backend;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class insertUser extends Controller
{
    public function addUser()
    {
        $uri = "mongodb+srv://OzanAdmin:1234@ozan.zgre1.mongodb.net/?retryWrites=true&w=majority&appName=Ozan";
        $client = new Client($uri);
        $vt = $this->request->getPost('vt');
        
        
        if ($vt == "Deneme") {
            $collection = $client->selectDatabase('ilkDatabaseDeneme')->selectCollection('users');
        } else if ($vt == "Gerçek") {
            $collection = $client->selectDatabase('Kullanıcılar')->selectCollection('Users');
        } else {
            echo "Hatalı Veritabanı Adı";
        }
        
        if ($this->request->getPost('submit') === 'Submit') {
            try {
                $insertUserName = $this->request->getPost('name');
                $insertUserSurname = $this->request->getPost('surname');
                $insertUserAge = (int) $this->request->getPost('age');
                $insertUserTel = (int) $this->request->getPost('tel');
                $insertUserEmail = $this->request->getPost('email');
                $userData = [
                    'name' => $insertUserName,
                    'surname' => $insertUserSurname,
                    'age' => $insertUserAge,
                    'tel' => $insertUserTel,
                    'email' => $insertUserEmail
                ];

                
                $result = $collection->insertOne($userData);
                // Başarılı ekleme mesajı
                echo "Kullanıcı başarıyla eklendi. Kullanıcı ID: " . $result->getInsertedId() . "\n";
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
    <title>İnsert User</title>
</head>
<body>
    <form action="/ipvt2/insertuser" method="post">
        <h1>Bağlanmak İstediğiniz Veritabanını Yazınız:</h1>
        <p>Kabul Edilenler: Deneme, Gerçek.</p>
        <input type="text" id="vt" name="vt">
        <h2>Eklenecek Kullanıcı Bilgileri</h2>

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
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
