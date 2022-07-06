<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table="invoices";
    public $timestamps = true;
    protected $fillable =['user_id','name_customer','email_customer','phone','address_customer','message','total','status','created_at','updated_at'];

    public function invoiceDetail(){
        return $this->hasMany('App\Models\InvoiceDetail','invoice_id','id');
    }
    public function user() {
        return $this->belongsTo('App\Models\UserDB','user_id','id');
    }
}
