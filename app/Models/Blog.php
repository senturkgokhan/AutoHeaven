<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blogs';

    public function getUsers(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getComments(){
        return $this->hasMany(Comment::class,'blog_id','id');
    }
}
