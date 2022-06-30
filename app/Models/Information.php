<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table="informations";
    public $timestamps = true;
    protected $fillable =['design','material','size_mass','created_at','updated_at',];
}
