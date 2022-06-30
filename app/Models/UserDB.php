<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDB extends Model
{
    use HasFactory;
    protected $table="users";
    public $timestamps = true;
    protected $fillable =['account_id','image_url','fullname','sex','birthday','citizen_ID','address','phone','email','status','permission','created_at','updated_at'];
}
