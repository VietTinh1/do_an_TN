<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;
    protected $table="memorys";
    public $timestamps = true;
    protected $fillable =['ram','rom','memory_available','memory_stick','phone_book','created_at','updated_at'];
}
