<?php

namespace App\Models;

use CodeIgniter\Model;

class AddsModel extends Model
{
    protected $table = 'adds';

    protected $primaryKey = 'id';
    protected $allowedFields = ['photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
