<?php

namespace App\Models;

use CodeIgniter\Model;

class LogoModel extends Model
{

    protected $table = 'logo';
   
    protected $primaryKey = 'id';
    protected $allowedFields = ['url', 'user_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
