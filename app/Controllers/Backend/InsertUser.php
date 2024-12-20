<?php
namespace App\Controllers\Backend;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class InsertUser extends Controller
{
    public function insertuser()
    {
        echo view('Admin/CRUD/InsertUser');
    }
}
?>
