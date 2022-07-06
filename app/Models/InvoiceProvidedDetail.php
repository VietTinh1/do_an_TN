<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProvidedDetail extends Model
{
    use HasFactory;
    protected $table="invoice_provided_details";
    public $timestamps = true;
    protected $fillable =['invoice_provided_id','product_id','amount','import_price','tax'];
    public function product() {
        return $this->hasOne('App\Models\Product','id','product_id');
    }
    public function invoiceProvided() {
        return $this->belongsTo('App\Models\InvoiceProvided','invoice_provided_id','id');
    }
}
