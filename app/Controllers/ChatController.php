<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use MongoDB\Client;

class ChatController extends BaseController
{
    public function chat()
    {
        $session = session();
        $senderUserEmail = $session->get('email');
        $takerUserEmail = $this->request->getPost('email');
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

        $usersCollection = $database->selectCollection('KULLANICILAR');
        $users = $usersCollection->find()->toArray();

        $output = view('headerfooter/header') . view('chat/Chat', ['messages' => $messages, 'userEmail' => $userEmail, 'users' => $users]);
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
            'gonderen' => $session->get('email'), // Use session to get sender email
            'alici' => $this->request->getPost('recipientEmail'), // Get recipient email from form input
            'icerik' => $this->request->getPost('message'),
        ];
        $result = $collection->insertOne($message);
        return redirect()->to('/chat');
    }
}
?>