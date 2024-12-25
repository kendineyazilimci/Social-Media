<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class DeleteUserController extends Controller
{
    public function manageUser()
    {
        if ($this->request->getMethod() === 'post' && $this->request->getPost('action')) {
            $uri = getenv('MONGODB_URI');
            if (!$uri) {
                echo "MongoDB URI bulunamadı. <br>";
                return;
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

                // Filtreyi kontrol edin
                if (empty($filter)) {
                    echo "En az bir alan doldurulmalıdır. <br>";
                    return;
                }

                $action = $this->request->getPost('action');
                if ($action === 'list') {
                    // Veritabanında eşleşen kayıtları kontrol edin
                    $matchingUsers = $collection->find($filter)->toArray();
                    if (count($matchingUsers) > 0) {
                        echo "Eşleşen kullanıcılar bulundu: <br>";
                        foreach ($matchingUsers as $user) {
                            echo "ID: " . $user['_id'] . "<br>";
                            echo "İsim: " . $user['name'] . "<br>";
                            echo "Soyisim: " . $user['surname'] . "<br>";
                            echo "Telefon: " . $user['tel'] . "<br>";
                            echo "Yaş: " . $user['age'] . "<br>";
                            echo "Email: " . $user['email'] . "<br>";
                            echo "Şifre: " . $user['sifre'] . "<br>";
                            echo "<br>";
                        }
                        // Form verilerini session'a kaydet
                        session()->set('deleteUserFilter', $filter);
                        session()->set('matchingUsers', $matchingUsers);
                    } else {
                        echo "Eşleşen kullanıcı bulunamadı. <br>";
                    }
                } elseif ($action === 'delete') {
                    // Kullanıcıyı sil
                    $deleteUser = $collection->deleteMany($filter);
                    if ($deleteUser->getDeletedCount() > 0) {
                        echo "Kullanıcı başarıyla silindi. Silinen kullanıcı sayısı: " . $deleteUser->getDeletedCount() . "\n";
                    } else {
                        echo "Kullanıcı bulunamadı.";
                    }
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