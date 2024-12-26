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
        $takerUserEmail = $this->request->getPost('recipientEmail') ?? $session->get('selectedUserEmail');

        $uri = getenv('MONGODB_URI');
        $client = new Client($uri);
        $database = $client->selectDatabase("Kullanıcılar");
        $collection = $database->selectCollection('MESAJLAR');

        $messages = $collection->find([
            '$or' => [
                [
                    'alici' => $senderUserEmail,
                    'gonderen' => $takerUserEmail
                ],
                [
                    'alici' => $takerUserEmail,
                    'gonderen' => $senderUserEmail
                ]
            ]
        ])->toArray();

        if (empty($messages)) {
            $output = view('headerfooter/header') . view('chat/Chat', ['message' => 'Henüz mesaj yok.', 'userEmail' => $takerUserEmail]);
        } else {
            $usersCollection = $database->selectCollection('KULLANICILAR');
            $users = $usersCollection->find()->toArray();
            $output = view('headerfooter/header') . view('chat/Chat', ['messages' => $messages, 'userEmail' => $takerUserEmail, 'users' => $users]);
        }
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
            'alici' => $this->request->getPost('recipientEmail'),
            'icerik' => $this->request->getPost('message'),
        ];
        $result = $collection->insertOne($message);

        if ($result->isAcknowledged()) {
            $recipientEmail = $this->request->getPost('recipientEmail');
            return redirect()->to('/chat?recipientEmail=' . $recipientEmail)->with('status', 'Mesaj başarıyla gönderildi');
        } else {
            return redirect()->to('/chat')->with('status', 'Mesaj gönderilemedi');
        }
    }
}
?>