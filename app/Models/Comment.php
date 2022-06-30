<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table="comments";
    public $timestamps = true;
    protected $fillable =['product_id','name_customer','email_customer','phone_customer','status','created_at','updated_at'];
}
