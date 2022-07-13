<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table="invoice_details";
    public $timestamps = true;
    protected $fillable =['invoice_id','product_id','amount','discount','price','promotion','created_at','updated_at'];
    public function invoice() {
        return  $this->belongsTo('App\Models\Invoice','id','invoice_id');
    }
    public function product() {
        return  $this->hasOne('App\Models\Product','id','product_id');
    }
}
