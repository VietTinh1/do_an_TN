<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table="invoices";
    public $timestamps = true;
    public function invoice(){
        $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }
}
