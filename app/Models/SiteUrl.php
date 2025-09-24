<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteUrl extends Model
{
    protected $table = 'site_url';
   
    protected $primaryKey = 'id';
    protected $allowedFields = ['url', 'url_type', 'user_id'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
