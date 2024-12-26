<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class QueryUserController extends Controller
{
    public function queryUser()
    {
        if (session()->get('email') != 'admin@admin') {
            return redirect()->to('/anasayfa');
        }


        $result = [];
        if ($this->request->getMethod() === 'post') {
            $uri = getenv('MONGODB_URI');
            if (!$uri) {
                $result['error'] = "MongoDB URI bulunamadı.";
                return view('Admin/CRUD/QueryUserHTML', $result);
            }

            $client = new Client($uri);
            $database = $client->selectDatabase('Kullanıcılar');
            $collection = $database->selectCollection('KULLANICILAR');

            try {
                $queryData = [];
                if ($name = $this->request->getPost('name')) {
                    $queryData['name'] = $name;
                }
                if ($surname = $this->request->getPost('surname')) {
                    $queryData['surname'] = $surname;
                }
                if ($tel = $this->request->getPost('tel')) {
                    $queryData['tel'] = $tel;
                }
                if ($age = $this->request->getPost('age')) {
                    $queryData['age'] = (int) $age;
                }
                if ($email = $this->request->getPost('email')) {
                    $queryData['email'] = $email;
                }
                if ($sifre = $this->request->getPost('sifre')) {
                    $queryData['sifre'] = $sifre;
                }
                $result['users'] = $collection->find($queryData)->toArray();
            } catch (Exception $e) {
                $result['error'] = $e->getMessage();
            }
        }
        return view('Admin/CRUD/QueryUserHTML', $result);
    }
}
?>