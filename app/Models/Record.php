<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $table="records";
    public $timestamps = true;
    protected $fillable =['utilitie_id','name_record','created_at','updated_at'];
}
