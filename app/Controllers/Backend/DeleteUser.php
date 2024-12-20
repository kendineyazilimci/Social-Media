<?php
namespace App\Controllers\Backend;

use CodeIgniter\Controller;
use MongoDB\Client;
use Exception;

class DeleteUser extends Controller
{
    public function deleteuser()
    {

     echo view('Admin/CRUD/DeleteUser');
    }
}
?>
