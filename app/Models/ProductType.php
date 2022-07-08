<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table="product_types";
    public $timestamps = true;
    protected $fillable =['name','status','created_at','updated_at'];
    public function product() {
        return $this->hasOne('App\Models\Product','product_type_id','id');
    }
    public function scopePhone($query){
        return $query->where('name','=','Điện Thoại');
    }
    public function scopeTablet($query){
        return $query->where('name','=','Tablet');
    }
    public function scopeLaptop($query){
        return $query->where('name','=','Laptop');
    }
}
