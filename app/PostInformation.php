<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostInformation extends Model
{
    protected $table = 'posts_information';

    protected $fillable =[
        
        'description'

    ];

    public function post(){

        return $this->belongsTo('App\Post');

    }
}
