<?php

namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = ['username', 'password', 'email', 'tel'];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]',
        'password' => 'required|min_length[6]|max_length[50]',
        'email' => 'required|valid_email|max_length[50]|is_unique[users.email]',
        'tel' => 'required|numeric|min_length[10]|max_length[11]|is_unique[users.tel]'
    ];
    protected $validationMessages = [
        'username' => [
            'required' => 'Kullanıcı adı alanı boş bırakılamaz.',
            'min_length' => 'Kullanıcı adı en az 3 karakter olmalıdır.',
            'max_length' => 'Kullanıcı adı en fazla 50 karakter olmalıdır.'
        ],
        'password' => [
            'required' => 'Şifre alanı boş bırakılamaz.',
            'min_length' => 'Şifre en az 5 karakter olmalıdır.',
            'max_length' => 'Şifre en fazla 50 karakter olmalıdır.'
        ],
        'email' => [
            'required' => 'E-posta alanı boş bırakılamaz.',
            'valid_email' => 'Geçerli bir e-posta adresi giriniz.',
            'max_length' => 'E-posta en fazla 50 karakter olmalıdır.',
            'is_unique' => 'Bu e-posta adresi zaten kullanılmaktadır.'
        ],  
        'tel' => [
            'required' => 'Telefon numarası alanı boş bırakılamaz.',
            'numeric' => 'Telefon numarası sadece rakamlardan oluşmalıdır.',
            'min_length' => 'Telefon numarası en az 10 karakter olmalıdır.',
            'max_length' => 'Telefon numarası en fazla 11 karakter olmalıdır.',
            'is_unique' => 'Bu telefon numarası zaten kullanılmaktadır.'
        ]
    ];
    protected $skipValidation = false;
}
?>