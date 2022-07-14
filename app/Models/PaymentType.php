<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    protected $table="payment_types";
    public $timestamps = true;
    protected $fillable =['card_type','card_code','status'];
    //protected $fillable =['invoice_id','payment_type','total_money','status'];
    public function scopePayment($query) {
        return $query->where('card_type','Trực tiếp tại nhà');
    }
}
