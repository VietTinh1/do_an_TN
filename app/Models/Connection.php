<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;
    protected $table="connections";
    public $timestamps = true;
    protected $fillable =['mobile_network','sim','charging_port','head_phone','connection_orther','created_at','updated_at'];
    public function wjfj(){
        return $this->hasMany('App\Models\Wjfj','connection_id','id');
    }
    public function gps(){
        return $this->hasMany('App\Models\Gps','connection_id','id');
    }
    public function bluetooth(){
        return $this->hasMany('App\Models\bluetooth','connection_id','id');
    }
}
