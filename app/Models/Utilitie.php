<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilitie extends Model
{
    use HasFactory;
    protected $table="utilities";
    public $timestamps = true;
    protected $fillable =['waterproof_dustproof','radio','created_at','updated_at'];
    public function securityAdvance(){
        return $this->hasMany('App\Models\SecurityAdvance','utilitie_id','id');
    }
    public function featureAdvance(){
        return $this->hasMany('App\Models\FeatureAdvance','utilitie_id','id');
    }
    public function record(){
        return $this->hasMany('App\Models\Record','utilitie_id','id');
    }
    public function video(){
        return $this->hasMany('App\Models\Video','utilitie_id','id');
    }
    public function music(){
        return $this->hasMany('App\Models\Music','utilitie_id','id');
    }

}
