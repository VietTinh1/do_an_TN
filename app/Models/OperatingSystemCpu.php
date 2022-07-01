<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingSystemCpu extends Model
{
    use HasFactory;
    protected $table="operating_system_cpus";
    public $timestamps = true;
    protected $fillable =['operating_system_name','chip_cpus','speed_cpu','gpu','created_at','updated_at'];
}
