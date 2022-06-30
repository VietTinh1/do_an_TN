<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bluetooth extends Model
{
    use HasFactory;
    protected $table="bluetooths";
    public $timestamps = true;
    protected $fillable =['connection_id','all_type_id','created_at','updated_at'];
}
