<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RearCameraFeature extends Model
{
    use HasFactory;
    protected $table="rear_camera_features";
    public $timestamps = true;
    protected $fillable =['rear_camera_id','all_type_id','created_at','updated_at'];
}
