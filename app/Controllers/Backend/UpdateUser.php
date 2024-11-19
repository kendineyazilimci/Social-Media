<?php
namespace App\Controllers\Backend;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class UpdateUser extends Controller
{
    public function updateUser()
    {
        $uri = "mongodb+srv://OzanAdmin:1234@ozan.zgre1.mongodb.net/?retryWrites=true&w=majority&appName=Ozan";
        $client = new Client($uri);
        $vt = $this->request->getPost('vt');

        
        if ($this->request->getPost('submit2') === 'Submit2') {
            try {
                $database = $client->selectDatabase('ilkDatabaseDeneme');
                $collection = $database->selectCollection('users');

                $filter = [
                    'name' => $this->request->getPost('name'),
                    'surname' => $this->request->getPost('surname'),
                    'email' => $this->request->getPost('email')
                ];

                $updateData = [
                    'name' => $this->request->getPost('namee'),
                    'surname' => $this->request->getPost('surnamee'),
                    'age' => (int) $this->request->getPost('agee'),
                    'tel' => $this->request->getPost('tell'),
                    'email' => $this->request->getPost('emaill')
                ];

                $updateUser = $collection->updateOne(
                    $filter,
                    ['$set' => $updateData]
                );

                if ($updateUser->getModifiedCount() > 0) {
                    echo "Kullanıcı başarıyla güncellendi. Güncellenen kullanıcı sayısı: " . $updateUser->getModifiedCount() . "\n";
                } else {
                    echo "Kullanıcı bulunamadı veya güncellenecek bir değişiklik yok.";
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
    <title>Update User</title>
</head>
<body>
    <form action="/ipvt2/updateuser" method="post">
            <h1>Bağlanmak İstediğiniz Veritabanını Yazınız:</h1>
            <p>Kabul Edilenler: Deneme, Gerçek.</p>
            <input type="text" id="vt" name="vt">
            <h2>Güncellenecek Kullanıcı Bilgileri</h2>
            <p>Orijinal İsim:</p>
            <input type="text" id="name" name="name">
            <p>Orijinal Soyisim:</p>
            <input type="text" id="surname" name="surname">
            <p>Orijinal E-mail:</p>
            <input type="text" id="email" name="email" required><br>
            <h2>Yeni Bilgiler</h2>
            <p>İsim:</p>
            <input type="text" id="namee" name="namee">

            <p>Soyisim:</p>
            <input type="text" id="surnamee" name="surnamee">

            <p>Yaş:</p>
            <input type="number" id="agee" name="agee"><br>

            <p>Telefon Numarası:</p>
            <input type="text" id="tell" name="tell"><br>

            <p>E-mail:</p>
            <input type="text" id="emaill" name="emaill"><br><br>

            <input type="submit" name="submit2" value="Submit2">    
    </form>
</body>
</html>
