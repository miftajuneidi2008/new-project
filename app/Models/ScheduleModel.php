<?php

namespace App\Models;

use CodeIgniter\Model;

class ScheduleModel extends Model
{
       protected $table = 'schedule';
 

    protected $primaryKey = 'id';
    protected $allowedFields = ['photo'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
