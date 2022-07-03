<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDB extends Model
{
    use HasFactory;
    protected $table="users";
    public $timestamps = true;
    protected $fillable =['account_id','image_url','fullname','sex','birthday','citizen_ID','address','phone','email','status','permission','created_at','updated_at'];
    public function account() {
        return $this->hasOne('App\Models\Account','id','account_id');
    }
    public function invoiceProvided() {
        return $this->hasOne('App\Models\InvoiceProvided','account_id','id');
    }
    public function invoice() {
        return $this->hasOne('App\Models\Invoice','account_id','id');
    }
    public function product() {
        return $this->hasOne('App\Models\Product','account_id','id');
    }
}
