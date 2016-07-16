<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'title', 'slug', 'color'
    ];

    /**
     * Change Route-Model binding key
     * @return field to bind by
     */
    public function getRouteKeyName() {
        return 'slug';
    }
}
