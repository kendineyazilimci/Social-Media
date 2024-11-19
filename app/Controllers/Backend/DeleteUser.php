<?php
namespace App\Controllers\Backend;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class deleteUser extends Controller
{
    public function deleteUser()
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

        try {
            $filter = ['name' => $this->request->getPost('name')];
            $filter2 = ['surname' => $this->request->getPost('surname')];
            $filter3 = ['age' => (int) $this->request->getPost('age')];
            $filter4 = ['tel' => (int) $this->request->getPost('tel')];
            $filter5 = ['email' => $this->request->getPost('email')];
            $deleteUser = $collection->deleteMany($filter, $filter2, $filter3, $filter4, $filter5);
            if($deleteUser->getDeletedCount() > 0){
                echo "Kullanıcı başarıyla silindi. Silinen kullanıcı sayısı: " . $deleteUser->getDeletedCount() ."\n";
            }
            else{echo "Kullanıcı bulunamadı.";
            }
        } catch (Exception $e) {
            // Hata mesajı
            printf("Hata: %s\n", $e->getMessage());
        }
    }
}

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
</head>
<body>
    <form action="/ipvt2/deleteuser" method="post">
        <h1>Bağlanmak İstediğiniz Veritabanını Yazınız:</h1>
        <p>Kabul Edilenler: Deneme, Gerçek.</p>
        <input type="text" id="vt" name="vt">
        <h2>Silinecek Kullanıcı Bilgileri</h2>

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
