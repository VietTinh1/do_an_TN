<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class film extends Model
{
    use HasFactory;
    protected $table="films";
    public $timestamps = true;
    protected $fillable =['rear_camera_id','name_film','created_at','updated_at'];
}