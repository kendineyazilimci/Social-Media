<?php
namespace app\Views\Admin\CRUD;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class InsertUser extends Controller
{
    public function adduser()
    {
        $uri = getenv('MONGODB_URI');
        $client = new Client($uri);
        $database = $client->selectDatabase($_POST['vt'] ?? null);
        $collection = $database->selectCollection('users');

        if (!$collection) {
            echo "Hatalı Veritabanı Adı";
            return;
        }

        if (isset($_POST['submit']) && $_POST['submit'] === 'Submit') {
            try {
                $userData = [
                    'name' => $_POST['name'] ?? null,
                    'surname' => $_POST['surname'] ?? null,
                    'age' => (int) ($_POST['age'] ?? 0),
                    'tel' => (int) ($_POST['tel'] ?? 0),
                    'email' => $_POST['email'] ?? null
                ];
                $result = $collection->insertOne($userData);
                $result->getInsertedId();
                echo "Kullanıcı başarıyla eklendi. Kullanıcı ID: " . $result->getInsertedId() . "\n";
            } catch (Exception $e) {
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
    <title>Insert User</title>
</head>
<body>
    <form action="insertuser" method="post">
        <h1>Bağlanmak İstediğiniz Veritabanını Yazınız:</h1>
        <p>Kabul Edilenler: Deneme, Gerçek.</p>
        <input type="text" id="vt" name="vt" required>
        <h2>Eklenecek Kullanıcı Bilgileri</h2>

        <p>İsim:</p>
        <input type="text" id="name" name="name" required>

        <p>Soyisim:</p>
        <input type="text" id="surname" name="surname" required>
        
        <p>Yaş:</p>
        <input type="number" id="age" name="age" required><br>
        
        <p>Telefon Numarası:</p>
        <input type="number" id="tel" name="tel" required><br>
        
        <p>E-mail:</p>
        <input type="email" id="email" name="email" required><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
