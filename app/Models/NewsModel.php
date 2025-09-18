<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

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


    public function getNewsWithDetails($categoryTitle = null)
    {
        // Start building a query from the 'news' table
        $builder = $this->db->table($this->table);

        // Define the columns you want to select
        $builder->select('
            news.*, 
            news_categories.title as category_title, 
            user.name as author_name
        ');

        $builder->join('news_categories', 'news_categories.id = news.category_id', 'left');


        $builder->join('user', 'user.id = news.user_id', 'left');

        if (!empty($categoryTitle)) {
            $builder->where('news_categories.title', $categoryTitle);
        }

        // Order the results by the newest first
        $builder->orderBy('news.created_at', 'DESC');
        $builder->orderBy('news.id', 'DESC');

        // Execute the query and return the results
        return $builder->get()->getResultArray();
    }
    public function getLatestNewsDetailsByCategory(string $categoryTitle): ?array
    {
        // Start building a query from the 'news' table
        $builder = $this->db->table($this->table);

        // Define the columns you want to select
        $builder->select('
            news.*, 
            news_categories.title as category_title, 
            user.name as author_name
        ');

        // Join with news_categories to access the category title
        $builder->join('news_categories', 'news_categories.id = news.category_id', 'left');

        // Join with the user table to get the author's name
        $builder->join('user', 'user.id = news.user_id', 'left');

        // ***** THE MAIN CORRECTION IS HERE *****
        $builder->where('news_categories.title', $categoryTitle);

        // Order the results by the newest first
        $builder->orderBy('news.created_at', 'DESC');

        // Execute the query and return only the FIRST row found as an array.
        return $builder->get()->getRowArray();
    }

    public function getNewsDetailsById(int $id): ?array
    {
        // Start building a query from the 'news' table
        $this->db->table($this->table)->where('id', $id)->set('view_count', 'view_count+1', false)->update();
        $builder = $this->db->table($this->table);

        // Define the columns you want to select
        $builder->select('
            news.*, 
            news_categories.title as category_title, 
            user.name as author_name
        ');

        $builder->join('news_categories', 'news_categories.id = news.category_id', 'left');
        $builder->join('user', 'user.id = news.user_id', 'left');

        // Find the specific news item by its primary key
        $builder->where('news.id', $id);

        // Execute the query and return a single row as an array.
        // getRowArray() returns null if no results are found.
        return $builder->get()->getRowArray();
    }

    public function getPopularNews(int $currentNewsId = null): array
    {
        $builder = $this->db->table($this->table);

        // Select all columns from the news table
        $builder->select('*');

        if ($currentNewsId) {
            $builder->where('id !=', $currentNewsId);
        }



        // Order the results by view_count in descending order
        $builder->orderBy('view_count', 'DESC');

        // Limit the results to the top 5
        $builder->limit(5);

        // Execute the query and return the results as an array
        return $builder->get()->getResultArray();
    }

}
