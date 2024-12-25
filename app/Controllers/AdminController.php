<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class AdminController extends BaseController
{   
    public function login()
    {
        if(session()->get('email') == 'admin@admin' && session()->get('sifre') == 'admin'){
            return view('admin/AdminPanelYonlendirme');
        }
        else{
            return redirect()->to('/anasayfa');
        }
    }
    public function crud()
    {
        if(session()->get('email') == 'admin@admin' && session()->get('sifre') == 'admin'){
                return view('admin/CRUD/CRUDYonlendirme');
        }else{
            return redirect()->to('/anasayfa');
        }
    }
}