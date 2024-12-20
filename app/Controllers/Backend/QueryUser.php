<?php
namespace App\Controllers\Backend;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class QueryUser extends Controller
{
    public function queryuser()
    {
        $uri = "mongodb+srv://OzanAdmin:1234@ozan.zgre1.mongodb.net/?retryWrites=true&w=majority&appName=Ozan";
        $client = new Client($uri);
        $vt = $this->request->getPost('vt');
        $result = [];

        if ($this->request->getPost('submit') === 'Submit') {
            if ($vt == "Deneme") {
                $collection = $client->selectDatabase('ilkDatabaseDeneme')->selectCollection('users');
            } elseif ($vt == "Gerçek") {
                $collection = $client->selectDatabase('Kullanıcılar')->selectCollection('Users');
            } else {
                return "Hatalı Veritabanı Adı";
            }

            try {
                $queryData = [];
                if ($name = $this->request->getPost('name')) {
                    $queryData['name'] = $name;
                }
                if ($surname = $this->request->getPost('surname')) {
                    $queryData['surname'] = $surname;
                }
                if ($age = $this->request->getPost('age')) {
                    $queryData['age'] = (int) $age;
                }
                if ($tel = $this->request->getPost('tel')) {
                    $queryData['tel'] = $tel;
                }
                if ($email = $this->request->getPost('email')) {
                    $queryData['email'] = $email;
                }

                $result['users'] = $collection->find($queryData)->toArray();
            } catch (Exception $e) {
                $result['error'] = $e->getMessage();
            }
        }

        return view('Backend/queryuser', $result);
    }
}