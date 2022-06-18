<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provided extends Model
{
    use HasFactory;
    protected $table="provideds";
    public $timestamps = true;
    protected $fillable = ['tax_code','name','email','phone','address','notes','created_at'];
}
