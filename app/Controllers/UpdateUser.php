<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class UpdateUser extends Controller
{
    public function updateuser()
    {
        echo view('Admin/CRUD/UpdateUser');
    }
}
?>
