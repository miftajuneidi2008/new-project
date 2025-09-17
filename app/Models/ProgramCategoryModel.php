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

}
