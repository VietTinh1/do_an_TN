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
    public function imageDetail(){
        return $this->hasMany('App\Models\ImageDetail','id','image_detail_id');
    }
    public function frontCamera(){
        return $this->hasMany('App\Models\FrontCamera','id','front_id');
    }
    public function rearCamera(){
        return $this->hasMany('App\Models\RearCamera','id','rear_camera_id');
    }
    public function operatingSystemCpu(){
        return $this->hasMany('App\Models\OperatingSystemCpu','id','operating_system_cpu_id');
    }
    public function memory(){
        return $this->hasMany('App\Models\Memory','id','memory_id');
    }
    public function information(){
        return $this->hasMany('App\Models\Information','id','information_id');
    }
    public function connection(){
        return $this->hasMany('App\Models\Connection','id','connection_id');
    }
    public function pin(){
        return $this->hasMany('App\Models\Pin','id','pin_id');
    }
    public function utilitie(){
        return $this->hasMany('App\Models\Utilitie','id','utilities_id');
    }
    public function screen(){
        return $this->hasMany('App\Models\Screen','id','screen_id');
    }
}
