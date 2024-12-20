<?php
namespace App\Controllers\Backend;
use App\Controllers\BaseController;

class AdminController extends BaseController
{   
    public function index()
    {
        $a = 2;
        echo view('headerfooter/header');

        if (isset($_POST['crudislemleributon'])) {
            $a = 1;
        } else if (isset($_POST['siteislemleributon'])) {
            $a = 0;
        }

        if ($a == 2) {
            echo view('Admin/AdminPanelYonlendirme');
        } else if ($a == 1) {
            echo view('Admin/CRUD/CRUDYonlendirme');
        } else if ($a == 0) {
            echo "asdadas";
        }
    }
}