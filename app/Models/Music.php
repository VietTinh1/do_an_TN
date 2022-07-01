<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $table="musics";
    public $timestamps = true;
    protected $fillable =['utilitie_id','name_music','created_at','updated_at'];
}
