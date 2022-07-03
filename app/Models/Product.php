<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table="products";
    public $timestamps = true;
    protected $fillable =['account_id','product_type_id','name','trademark','product_code','amount','price','unit','describe','time_warranty','sale','tax','so_sao','status','created_at','updated_at'];
    public function configuration() {
        return $this->hasOne('App\Models\Configuration','product_id','id');
    }
    public function invoiceDetail() {
        return $this->hasOne('App\Models\InvoiceDetail','product_id','id');
    }
    public function comment() {
        return $this->hasOne('App\Models\Comment','product_id','id');
    }
    public function productType() {
        return $this->hasOne('App\Models\ProductType','id','product_type_id');
    }
}
