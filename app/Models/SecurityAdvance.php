<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityAdvance extends Model
{
    use HasFactory;
    protected $table="security_advances";
    public $timestamps = true;
    protected $fillable =['utilitie_id','all_type_id','created_at','updated_at'];

}
