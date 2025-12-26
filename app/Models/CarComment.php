<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarComment extends Model
{
    use HasFactory;

    protected $table = 'car_comments';
    protected $fillable = ['car_id', 'user_id', 'comment'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
