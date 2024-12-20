<?php
namespace app\Views\Admin\CRUD;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class deleteUser extends Controller
{
    public function deleteUser()
    {
        $uri = "mongodb+srv://OzanAdmin:1234@ozan.zgre1.mongodb.net/?retryWrites=true&w=majority&appName=Ozan";
        $client = new Client($uri);
        $vt = $_POST['vt'] ?? null;

        if ($vt == "Deneme") {
            $collection = $client->selectDatabase('ilkDatabaseDeneme')->selectCollection('users');
        } elseif ($vt == "Gerçek") {
            $collection = $client->selectDatabase('Kullanıcılar')->selectCollection('Users');
        } else {
            echo "Hatalı Veritabanı Adı";
            return;
        }

        try {
            $filters = [
                'name' => $_POST['name'] ?? null,
                'surname' => $_POST['surname'] ?? null,
                'age' => (int) ($_POST['age'] ?? 0),
                'tel' => (int) ($_POST['tel'] ?? 0),
                'email' => $_POST['email'] ?? null
            ];

            // Filtrede null olmayan değerleri topla
            $filteredData = array_filter($filters, fn($value) => !is_null($value));
            
            // Filtreli veriyi kullanarak kullanıcıları sil
            $deleteUser = $collection->deleteMany($filteredData);
            
            if ($deleteUser->getDeletedCount() > 0) {
                echo "Kullanıcı başarıyla silindi. Silinen kullanıcı sayısı: " . $deleteUser->getDeletedCount() . "\n";
            } else {
                echo "Kullanıcı bulunamadı.";
            }
        } catch (Exception $e) {
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
