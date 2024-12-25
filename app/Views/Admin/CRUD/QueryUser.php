<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class QueryUser extends Controller
{
    public function queryuser()
    {
        $uri = getenv('MONGODB_URI');
        $client = new Client($uri);
        $result = [];
        $collection = $client->selectDatabase('Kullanıcılar')->selectCollection('KULLANICILAR');

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
            return view('QueryUser', $result);
   }
}
