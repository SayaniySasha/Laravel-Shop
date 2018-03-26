<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class CustomPage extends Model
{
    use SoftDeletes;
    use Sluggable;
    
    protected $fillable = ['slug', 'title', 'content', 'page',
    'key', 'description', 'tags'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


}
