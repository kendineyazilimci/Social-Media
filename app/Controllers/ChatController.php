<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use MongoDB\Client;

class ChatController extends BaseController
{
    public function chatting()
    {
        $uri = getenv('MONGODB_URI');
        $client = new Client($uri);
        $database = $client->selectDatabase("Kullanıcılar");
        $collection = $database->selectCollection('MESAJLAR');
        $data = $collection->find();
        $output = view('headerfooter/header') . view('chat/chat', ['data' => $data]) . view('headerfooter/footer');
        return $output;
    }   
}
?>