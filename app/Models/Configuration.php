<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table="configuration";
    public $timestamps = true;
    protected $fillable =['product_id','image_detail_id','screen_id','front_id','rear_camera_id','operating_system_cpu_id','memory_id','connection_id','pin_id','utilities_id','information_id','created_at','updated_at'];
}
