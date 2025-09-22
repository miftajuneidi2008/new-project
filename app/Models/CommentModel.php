<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    
    protected $table = 'comment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['news_id', 'user_id', 'comment'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

   
}
