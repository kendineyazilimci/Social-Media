<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class UpdateUserController extends Controller
{
    public function updateUser()
    {
        if (session()->get('email') != 'admin@admin') {
            return redirect()->to('/anasayfa');
        }


        $uri = getenv('MONGODB_URI');
        $client = new Client($uri);
        $session = session();

        if ($this->request->getMethod() === 'post') {
            try {
                $database = $client->selectDatabase('Kullanıcılar');
                $collection = $database->selectCollection('KULLANICILAR');
                $filter = [
                    'name' => $this->request->getPost('name'),
                    'surname' => $this->request->getPost('surname'),
                    'email' => $this->request->getPost('email')
                ];
                $updateData = [
                    'name' => $this->request->getPost('namee'),
                    'surname' => $this->request->getPost('surnamee'),
                    'tel' => $this->request->getPost('tell'),
                    'age' => (int) $this->request->getPost('agee'),
                    'email' => $this->request->getPost('emaill'),
                    'sifre' => $this->request->getPost('sifree')
                ];

                $result = $collection->updateOne($filter, ['$set' => $updateData]);

                if ($result->getModifiedCount() > 0) {
                    echo "Kullanıcı başarıyla güncellendi.";
                } else {
                    echo "Kullanıcı bulunamadı veya güncellenecek bir değişiklik yok.";
                }
            } catch (Exception $e) {
                echo 'Hata: ' . $e->getMessage() . "<br>";
                echo 'Dosya: ' . $e->getFile() . "<br>";
                echo 'Satır: ' . $e->getLine() . "<br>";
            }
        } else {
            return view('Admin/CRUD/updateUserHTML');
        }
    }
}
?>