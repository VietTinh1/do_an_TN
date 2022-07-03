<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontCamera extends Model
{
    use HasFactory;
    protected $table="front_cameras";
    public $timestamps = true;
    protected $fillable =['resolution','created_at','updated_at'];
    public function frontCameraFeature(){
        return $this->hasMany('App\Models\FrontCameraFeature','front_camera_id','id');
    }
}