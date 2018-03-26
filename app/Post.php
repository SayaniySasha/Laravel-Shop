<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Traits\HasComments;

use App\Category;
use App\Tag;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use Sluggable;
    use Searchable;
    use HasComments;

    protected $fillable = ['title','category_id','content', 'slug', 'is_active', 'user_id'];
    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function pictures()
    {
        return $this->belongsToMany(Picture::class);
    }

}
