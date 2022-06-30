<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilitie extends Model
{
    use HasFactory;
    protected $table="utilities";
    public $timestamps = true;
    protected $fillable =['waterproof_dustproof','radio','created_at','updated_at'];
}
