<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;
    protected $table="screens";
    public $timestamps = true;
    protected $fillable =['screen_technology','resolution','width','maximum_brightness','unit','touch_glass','created_at','updated_at'];

}
