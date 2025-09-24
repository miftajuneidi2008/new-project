<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramCategoryModel extends Model
{/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'program_categories';

    /**
     * The primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fields that are allowed to be saved by the model.
     *
     * @var array
     */
    protected $allowedFields = [
        'title',
        'user_id',
        'photo',
        'category_title',
        'description'
    ];

    /**
     * Whether to use the created_at and updated_at timestamps.
     *
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * The format of the date fields.
     *
     * @var string
     */
    protected $dateFormat = 'datetime';

    /**
     * The name of the field to use for the created timestamp.
     *
     * @var string
     */
    protected $createdField = 'created_at';

    /**
     * The name of the field to use for the updated timestamp.
     *
     * @var string
     */
    protected $updatedField = 'updated_at';
    public function getProgramDetailsById(int $id): ?array
    {
       // Start building a query from the 'news' table
        $builder = $this->db->table($this->table);

        // Define the columns you want to select
        $builder->select('
            program.*, 
            program_categories.title as category_title, 
            user.name as author_name,

        ');

        $builder->join('news_categories', 'news_categories.id = news.category_id', 'left');
        $builder->join('user', 'user.id = news.user_id', 'left');


        $builder->where('news.id', $id);

        $news_data = $builder->get()->getRowArray();
        $commentBuilder = $this->db->table('comment');

        $commentBuilder->select('
            comment.*,
            user.name as commenter_name 
        ');
        $commentBuilder->join('user', 'user.id = comment.user_id', 'left');
        $commentBuilder->where('comment.news_id', $id);
        $commentBuilder->orderBy('comment.created_at', 'DESC');
        $comments = $commentBuilder->get()->getResultArray();


        $news_data['comments'] = $comments;

        return $news_data;
    }

}
