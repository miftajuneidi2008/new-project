<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteUrl extends Model
{
    protected $table = 'site_url';

    protected $primaryKey = 'id';
    protected $allowedFields = ['url', 'url_type', 'user_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    function getAudio()
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            site_url.*
        ');
        $builder->where('site_url.url_type', 'ኦዲዮ');
        return $builder->get()->getRowArray();
    }

    function getVideo()
    {
        $builder = $this->db->table($this->table);
        $builder->select('
            site_url.*
        ');
        $builder->where('site_url.url_type', 'ቪዲዮ');
        return $builder->get()->getRowArray();
    }
}
