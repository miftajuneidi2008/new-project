<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'program';

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
        'user_id',
        'photo',
        'category_id',
        'title',
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


    public function getNewsWithDetails()
    {
        // Start building a query from the 'news' table
        $builder = $this->db->table($this->table);

        // Define the columns you want to select
        $builder->select('
            program.*, 
            program_categories.title as category_title, 
            user.name as author_name
        ');

        $builder->join('program_categories', 'program_categories.id = program.category_id', 'left');


        $builder->join('user', 'user.id = program.user_id', 'left');

        // Order the results by the newest first
        $builder->orderBy('program.created_at', 'DESC');

        // Execute the query and return the results
        return $builder->get()->getResultArray();
    }

    public function getNewsPostDetails($id)
    {
        // Start building a query from the 'news' table
        $builder = $this->db->table($this->table);

        // Define the columns you want to select
        $builder->select('
            program.*, 
            program_categories.title as category_title, 
            user.name as author_name
        ');

        $builder->join('program_categories', 'program_categories.id = program.category_id', 'left');


        $builder->join('user', 'user.id = program.user_id', 'left');
        $builder->where('program_categories.id', $id);

        $builder->orderBy('program.created_at', 'DESC');

        // Execute the query and return the results
        return $builder->get()->getResultArray();
    }

    public function getPopularPost(): array
    {
        $builder = $this->db->table($this->table);

        // Select all columns from the news table
        $builder->select('*');


        // Order the results by view_count in descending order
        $builder->orderBy('view_count', 'DESC');

        // Limit the results to the top 5
        $builder->limit(5);

        // Execute the query and return the results as an array
        return $builder->get()->getResultArray();
    }

    public function incrementViewCount(int $id)
    {
        $this->db->table($this->table)
            ->where('id', $id)
            ->set('view_count', 'view_count+1', false)
            ->update();
    }
    public function getPopularPrograms(int $id): ?array
    {
       $builder = $this->db->table($this->table);

        // Select all columns from the news table
        $builder->select('*');

        if ($id) {
            $builder->where('id !=', $id);
        }



        // Order the results by view_count in descending order
        $builder->orderBy('view_count', 'DESC');

        // Limit the results to the top 5
        $builder->limit(5);

        // Execute the query and return the results as an array
        return $builder->get()->getResultArray();

    }

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

        $builder->join('program_categories', 'program_categories.id = program.category_id', 'left');
        $builder->join('user', 'user.id = program.user_id', 'left');


        $builder->where('program.id', $id);

        $program_data = $builder->get()->getRowArray();
        $commentBuilder = $this->db->table('program_comment');

        $commentBuilder->select('
            program_comment.*,
            user.name as commenter_name 
        ');
        $commentBuilder->join('user', 'user.id = program_comment.user_id', 'left');
        $commentBuilder->where('program_comment.program_id', $id);
        $commentBuilder->orderBy('program_comment.created_at', 'DESC');
        $comments = $commentBuilder->get()->getResultArray();


        $program_data['comments'] = $comments;

        return $program_data;
    }
}
