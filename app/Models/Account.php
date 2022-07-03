<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table="accounts";
    public $fillable=['username', 'password','token','status','created_at', 'updated_at'];
    public $timestamps = true;
    public function user() {
        return $this->hasOne('App\Models\UserDB','account_id','id');
    }
}
