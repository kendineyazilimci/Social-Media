<?php
namespace App\Controllers\Backend;

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