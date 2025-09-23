<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramComment extends Model
{
    protected $table = 'program_comment';
    protected $primaryKey = 'id';
    protected $allowedFields = ['program_id', 'user_id', 'comment'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
