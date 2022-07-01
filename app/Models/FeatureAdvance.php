<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureAdvance extends Model
{
    use HasFactory;
    protected $table="feature_advances";
    public $timestamps = true;
    protected $fillable =['utilitie_id','name_feature_advance','created_at','updated_at'];
}
