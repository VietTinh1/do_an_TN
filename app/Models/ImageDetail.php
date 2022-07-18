<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageDetail extends Model
{
    use HasFactory;
    protected $table="image_details";
    public $timestamps = true;
    protected $fillable =['product_id','image_main','image','slider','created_at','updated_at'];
    public function product() {
        $this->belongsTo('App\Models\Product','id','product_id');
    }
}
