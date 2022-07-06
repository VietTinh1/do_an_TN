<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllTypeDetail extends Model
{
    use HasFactory;
    protected $table="all_type_details";
    public $timestamps = true;
    protected $fillable =['product_id','all_type_id','created_at','updated_at'];
    public function allType() {
        return $this->hasOne('App\Models\AllType','id','all_type_id');
    }
    public function product() {
        $this->belongsTo('App\Models\Product','id','product_id');
    }
}
