<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class InsertUserController extends Controller
{
    public function insertUser()
    {
        if (session()->get('email') != 'admin@admin') {
            return redirect()->to('/anasayfa');
        }


        if ($this->request->getMethod() === 'post') {
            try {
                $uri = getenv('MONGODB_URI');
                if (!$uri) {
                    throw new Exception('MongoDB URI bulunamadı.');
                }

                $client = new Client($uri);
                $database = $client->selectDatabase("Kullanıcılar");
                $collection = $database->selectCollection('KULLANICILAR');

                $userDataInsert = [
                    'name' => $this->request->getPost('name'),
                    'surname' => $this->request->getPost('surname'),
                    'tel' => $this->request->getPost('tel'),
                    'age' => $this->request->getPost('age'),
                    'email' => $this->request->getPost('email'),
                    'sifre' => $this->request->getPost('sifre')
                ];

                if (empty($userDataInsert['name']) || empty($userDataInsert['surname']) || empty($userDataInsert['tel']) || empty($userDataInsert['age']) || empty($userDataInsert['email']) || empty($userDataInsert['sifre'])) {
                    echo "Tüm Alanlar Dolu Olmalıdır. <br>";
                    return redirect()->to('/admin/crud/insertuser');
                }

                $result = $collection->insertOne($userDataInsert);
                echo "Kullanıcı başarıyla eklendi. <br>";
                return redirect()->to('/admin/crud/insertuser');

            } catch (Exception $e) {
                echo 'Hata: ' . $e->getMessage() . "<br>";
                echo 'Dosya: ' . $e->getFile() . "<br>";
                echo 'Satır: ' . $e->getLine() . "<br>";
            }
        }
        return view('Admin/CRUD/insertUserHTML');
    }
}
?>