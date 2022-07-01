<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wjfj extends Model
{
    use HasFactory;
    protected $table="wjfjs";
    public $timestamps = true;
    protected $fillable =['connection_id','name_wjfj','created_at','updated_at'];
}
