<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */

    protected $fillable = [
        'theme_id',
        'location',
        'bio',
        'twitter_username',
        'github_username',
        'user_profile_bg',
        'avatar',
        'avatar_status',
    ];

    protected $casts = [
        'theme_id' => 'integer',
    ];

    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Profile Theme Relationships.
     *
     * @var array
     */
    public function theme()
    {
        return $this->hasOne('App\Theme');
    }
}
