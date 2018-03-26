<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Article.
 *
 * @package namespace App;
 */
class Article extends Model
{
    
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['title','category_id','content', 'slug', 'is_active'];


}
