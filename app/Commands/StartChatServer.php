<?php
namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Controllers\ChatController; // Doğru sınıfı dahil edin

class StartChatServer extends BaseCommand
{
    protected $group = 'Chat';
    protected $name = 'chat:start';
    protected $description = 'Start the chat WebSocket server';

    public function run(array $params)
    {
        CLI::write('Starting chat server...', 'green');

        try {
            $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new ChatController() // Doğru sınıfı kullanın
                    )
                ),
                8080
            );

            CLI::write('Chat server started successfully on port 8080', 'green');
            $server->run();
        } catch (\Exception $e) {
            CLI::error('Failed to start chat server: ' . $e->getMessage());
        }
    }
}