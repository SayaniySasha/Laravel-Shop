<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\Search\Searchable;
   
/**
 * Class Article.
 *
 * @package namespace App\Entities;
 */
class Article extends Model 
{
    use Searchable;
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','category_id','content', 'slug', 'is_active'];

}
