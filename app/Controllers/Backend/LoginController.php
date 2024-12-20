<?php
namespace App\Controllers\Backend;
use App\Helpers\SessionManager;
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
    
                $database = $client->selectDatabase("ilkDatabaseDeneme");
                $collection = $database->selectCollection('users');
    
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
    
                if ($result) {
                    $_SESSION['email'] = $email;
    
                    return redirect()->to('/anasayfa');
                } else {
                    throw new Exception("Kullanıcı bulunamadı.");
                }
            } catch (Exception $e) {
                return view('loginUyelikExit/login', [
                    'error' => $e->getMessage()
                ]);
            }
        }
    
        // Giriş sayfasını yükle
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
                $database = $client->selectDatabase("ilkDatabaseDeneme");
                $collection = $database->selectCollection('users');

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
        $uri = getenv('MONGODB_URI');
        return view('loginUyelikExit/exit');
    }
}
?>