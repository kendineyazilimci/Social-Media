<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use MongoDB\Client;

class ChatController extends BaseController
{
    public function chat()
    {
        $session = session();
        $userEmail = $this->request->getPost('userEmail');
        $uri = getenv('MONGODB_URI');
        $client = new Client($uri);
        $database = $client->selectDatabase("Kullanıcılar");
        $collection = $database->selectCollection('MESAJLAR');
        $messages = $collection->find([
            '$or' => [
                ['alici' => $userEmail],
                ['gonderen' => $userEmail]
            ]
        ])->toArray();
        $output = view('headerfooter/header') . view('chat/Chat', ['messages' => $messages, 'userEmail' => $userEmail]);
        $output .= view('headerfooter/footer') . view('headerfooter/sidebar');
        return $output;
    }

    public function sendMessage()
    {
        $session = session();
        $uri = getenv('MONGODB_URI');
        $client = new Client($uri);
        $database = $client->selectDatabase("Kullanıcılar");
        $collection = $database->selectCollection('MESAJLAR');
        $message = [
            'gonderen' => $session->get('email'),
            'alici' => $this->request->getPost('userEmail'),
            'icerik' => $this->request->getPost('message'),
        ];
        $result = $collection->insertOne($message);
        return redirect()->to('/chat')->with('userEmail', $this->request->getPost('userEmail'));
    }
}
?>