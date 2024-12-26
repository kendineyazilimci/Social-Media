<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class DeleteUserController extends Controller
{
    public function deleteUser()
    {
        if (session()->get('email') != 'admin@admin') {
            return redirect()->to('/anasayfa');
        }


        if ($this->request->getMethod() === 'post') {
            $uri = getenv('MONGODB_URI');
            if (!$uri) {
                echo "MongoDB URI bulunamadı. <br>";
                return;
            }
            if(session->session('email') != 'admin@admin')
            {
                return redirect()->to('/anasayfa');
            }else{
                return redirect()->to('/admin/crud/deleteuser');
            }
            $client = new Client($uri);
            $database = $client->selectDatabase('Kullanıcılar');
            $collection = $database->selectCollection('KULLANICILAR');

            try {
                $filter = [];
                if ($this->request->getPost('name')) {
                    $filter['name'] = $this->request->getPost('name');
                }
                if ($this->request->getPost('surname')) {
                    $filter['surname'] = $this->request->getPost('surname');
                }
                if ($this->request->getPost('tel')) {
                    $filter['tel'] = $this->request->getPost('tel');
                }
                if ($this->request->getPost('age')) {
                    $filter['age'] = $this->request->getPost('age');
                }
                if ($this->request->getPost('email')) {
                    $filter['email'] = $this->request->getPost('email');
                }
                if ($this->request->getPost('sifre')) {
                    $filter['sifre'] = $this->request->getPost('sifre');
                }

                if (empty($filter)) {
                    echo "En az bir alan doldurulmalıdır. <br>";
                    return;
                }

                $deleteUser = $collection->deleteMany($filter);
                if ($deleteUser->getDeletedCount() > 0) {
                    echo "Kullanıcı başarıyla silindi. Silinen kullanıcı sayısı: " . $deleteUser->getDeletedCount() . "\n";
                } else {
                    echo "Kullanıcı bulunamadı.";
                }
            } catch (Exception $e) {
                echo 'Hata: ' . $e->getMessage() . "<br>";
                echo 'Dosya: ' . $e->getFile() . "<br>";
                echo 'Satır: ' . $e->getLine() . "<br>";
            }
        }
        return view('Admin/CRUD/deleteUserHTML');
    }
}
?>