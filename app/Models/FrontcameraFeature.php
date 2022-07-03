<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontcameraFeature extends Model
{
    use HasFactory;
    protected $table="front_camera_features";
    public $timestamps = true;
    protected $fillable =['front_camera_id','name_front_camera_feature','created_at','updated_at'];
}