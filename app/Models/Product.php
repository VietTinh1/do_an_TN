<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table="products";
    public $timestamps = true;
    protected $fillable =['user_id','product_type_id','name_product','trademark','product_code','amount','price','tax','unit','time_warranty','sale','screen_technology','screen_resolution','screen_width','screen_maximum_brightness','touch_screen_glass','flash_light','operating_system','CPU','speed_cpu','GPU','ram','rom','available_memory','memory_stick','mobile_network','sim','phonebook','charging_port','headphone','connection_orther','battery_capacity','pin_type','maximum_battery_charging_support','charger_included','battery_technology','water_and_dust_resistant','radio','design','material','size_volume','date_created','status','created_at','updated_at'];
    public function scopeGetName($query,$name){
        return $this->where('name_product',$name);
    }
    public function invoiceDetail() {
        return $this->hasOne('App\Models\InvoiceDetail','product_id','id');
    }
    public function invoiceProvidedDetail() {
        return $this->hasMany('App\Models\InvoiceProvidedDetail','product_id','id');
    }
    public function comment() {
        return $this->hasOne('App\Models\Comment','product_id','id');
    }
    public function productType() {
        return $this->hasOne('App\Models\ProductType','id','product_type_id');
    }
    public function allTypeDetail() {
        return $this->hasMany('App\Models\AllTypeDetail','product_id','id');
    }
    public function imageDetail() {
        return $this->hasMany('App\Models\ImageDetail','product_id','id');
    }
    public function user() {
        return $this->belongsTo('App\Models\UserDB','user_id','id');
    }
}
