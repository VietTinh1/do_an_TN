<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProvidedDetail extends Model
{
    use HasFactory;
    protected $table="invoice_provided_details";
    public $timestamps = true;
    protected $fillable =['invoice_provided_id','product_id','image_url','amount','import_price','describe',];
}
