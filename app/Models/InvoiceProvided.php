<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceProvided extends Model
{
    use HasFactory;
    protected $table="invoice_provides";
    public $timestamps = true;
    protected $fillable =['provided_id','user_id','total','created_at'];
    public function provided() {
        return $this->hasOne('App\Models\Provided','id','provided_id');
    }
    public function invoiceProvidedDetail() {
        return $this->hasMany('App\Models\InvoiceProvidedDetail','invoice_provided_id','id');
    }
    public function user() {
        return $this->hasOne('App\Models\UserDB','id','user_id');
    }
}
