<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Permission extends Model
{
    use Sluggable;
    
    protected $fillable = ['name', 'slug', 'description', 'model'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    
    /**
     * many-to-many relationship method
     *
     * @return QueryBuilder
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }
    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Role')->withTimestamps();
    }
}

