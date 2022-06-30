<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table="invoices";
    public $timestamps = true;
    protected $fillable =['account_id','name_customer','email_customer','phone','address_customer','message','total','status','created_at','updated_at'];

    public function invoice(){
        $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }
}
