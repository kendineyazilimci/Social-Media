<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use MongoDB\Client;
use Exception;

class LoginController extends BaseController
{
    public function giris()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    
        if ($this->request->getMethod() === 'post') {
            try {
                $uri = getenv('MONGODB_URI');
                if (!$uri) {
                    throw new Exception("MongoDB URI bulunamadı.");
                }

                try {
                    $client = new Client($uri);
                } catch (Exception $e) {
                    throw new Exception("MongoDB Bağlantı Hatası: " . $e->getMessage());
                }
    
                $database = $client->selectDatabase("Kullanıcılar");
                $collection = $database->selectCollection('KULLANICILAR');
    
                $email = $this->request->getPost('email');
                $sifre = $this->request->getPost('sifre');

                if (empty($email) || empty($sifre)) {
                    throw new Exception("Tüm alanlar doldurulmalıdır.");
                }
    
                $userDataQuery = [
                    'email' => $email,
                    'sifre' => $sifre
                ];
    
                $result = $collection->findOne($userDataQuery);
                if (!$result) {
                    echo "Yanlış Email veya Şifre. <br>";
                }
                
                if ($result) {
                    session()->set('email', $email);
                    session()->set('sifre', $sifre);
                    return redirect()->to('/anasayfa');
                }
            } catch (Exception $e) {
                return view('loginUyelikExit/login', [
                    'error' => $e->getMessage()
                ]);
            }
        }
        return view('loginUyelikExit/login');
    }
    
    
    //------------------------------------------------------------------------------------------------------------------
    
    public function uyelik()
    {
        if ($this->request->getMethod() === 'post') {
            try {
                $uri = getenv('MONGODB_URI');
                if (!$uri) {
                    echo "MongoDB URI bulunamadı. <br>";
                }

                $client = new Client($uri);
                $database = $client->selectDatabase("Kullanıcılar");
                $collection = $database->selectCollection('KULLANICILAR');
                $checkemail = $collection->findOne(['email' => $this->request->getPost('email')]);
                $checktel = $collection->findOne(['tel' => $this->request->getPost('tel')]);

                $userDataInsert = [
                    'name' => $this->request->getPost('name'),
                    'surname' => $this->request->getPost('surname'),
                    'tel' => $this->request->getPost('tel'),
                    'age' => $this->request->getPost('age'),
                    'email' => $this->request->getPost('email'),
                    'sifre' => $this->request->getPost('sifre')
                ];
                if($checkemail or $checktel){
                    session()->setFlashdata('error', 'Bu Email Adresi Veya Numara Kullanılmaktadır. Lütfen Kontrol Ediniz');
                    return redirect()->to('/uyelik');
                    if (empty($userDataInsert['name']) || empty($userDataInsert['surname']) || empty($userDataInsert['tel']) || empty($userDataInsert['age']) || empty($userDataInsert['email']) || empty($userDataInsert['sifre'])) {
                            echo "Tüm Alanlar Dolu Olmalıdır. <br>";
                    }
                }

                $result = $collection->insertOne($userDataInsert);

                return redirect()->to('/giris');

            } catch (Exception $e) {
                echo 'Hata: ' . $e->getMessage() . "<br>";
                echo 'Dosya: ' . $e->getFile() . "<br>";
                echo 'Satır: ' . $e->getLine() . "<br>";
            }
        }
        return view('loginUyelikExit/uyelik');
    }

//------------------------------------------------------------------------------------------------------------------

    public function cikis()
    {
        session()->destroy();

        return redirect()->to('/anasayfa');
        return view('loginUyelikExit/exit');
    }
}
?>