<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProvided extends Model
{
    use HasFactory;
    protected $table="invoice_provides";
    public $timestamps = true;
    protected $fillable =['provided_id','account_id','total','created_at'];
}
