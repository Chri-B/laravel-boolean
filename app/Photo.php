<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'path'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pages()
    {
        return $this->belongsToMany('App\Page');
    }
}
