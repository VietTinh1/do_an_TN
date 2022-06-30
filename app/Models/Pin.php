<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;
    protected $table="pins";
    public $timestamps = true;
    protected $fillable =['memory_pin','pin_type','support_pin_max','charger','technology_pin','created_at','updated_at'];
}
