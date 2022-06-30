<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageDetail extends Model
{
    use HasFactory;
    protected $table="image_details";
    public $timestamps = true;
    protected $fillable =['front','backside','created_at','updated_at'];
}
