<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory,SoftDeletes;

    protected $table ='cars';

    public function getUsers(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getModels(){
        return $this->belongsTo(CarModel::class,'model_id','id');
    }

    public function getDamages(){
        return $this->belongsTo(CarDamage::class,'damage_id','id');
    }

    public function comments()
    {
        return $this->hasMany(CarComment::class, 'car_id', 'id')->with('user')->latest();
    }
}
