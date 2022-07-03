<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RearCamera extends Model
{
    use HasFactory;
    protected $table="rear_cameras";
    public $timestamps = true;
    protected $fillable =['main_rear_camera','main_secondary_1','main_secondary_2','main_secondary_3','film','flash_light','created_at','updated_at'];
    public function rearCameraFeature(){
        return $this->hasMany('App\Models\RearCameraFeature','rear_camera_id','id');
    }
    public function film(){
        return $this->hasMany('App\Models\film','rear_camera_id','id');
    }
}
