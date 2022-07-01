<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gps extends Model
{
    use HasFactory;
    protected $table="gps";
    public $timestamps = true;
    protected $fillable =['connection_id','name_gps','created_at','updated_at'];
}
