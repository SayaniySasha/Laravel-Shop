<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Role extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'slug', 'description', 'level'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * many-to-many relationship method.
     *
     * @return QueryBuilder
     */

     public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
     * many-to-many relationship method.
     *
     * @return QueryBuilder
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission')->withTimestamps();
    }
}
