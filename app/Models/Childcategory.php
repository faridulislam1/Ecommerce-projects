<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childcategory extends Model
{
    use HasFactory;


    /**
     * The table associated with the model
     * @var string
     */
    protected $table = 'categories';

    /**
     * Set the fillable attributes for the model
     * @var string[]
     */
    protected $fillable = ['category_id','subcategory_id','childcategory_slug','childcategory_name',];

    /**
     * The attributes that should be cast
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The storage format of the model's date columns
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The number of models to return for pagination
     * @var int
     */
    protected $perPage = 10;
}
