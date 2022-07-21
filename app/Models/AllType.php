<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllType extends Model
{
    use HasFactory;
    protected $table="all_types";
    public $timestamps = true;
    protected $fillable =['classify','name_classify','created_at','updated_at'];
//dynamic scope
    public function scopeSecurity($query) {
        return $query->where('classify','Bảo mật');
    }
    public function scopeFeature($query) {
        return $query->where('classify','Tính năng');
    }
    public function scopeRecord($query) {
        return $query->where('classify','Ghi âm');
    }
    public function scopeVideo($query) {
        return $query->where('classify','Xem phim');
    }
    public function scopeMusic($query) {
        return $query->where('classify','Nghe nhạc');
    }
    public function scopeCameraFeatureFront($query) {
        return $query->where('classify','Tính năng camera trước');
    }
    public function scopeCameraFeatureRear($query) {
        return $query->where('classify','Tính năng camera sau');
    }
    public function scopeWjfj($query) {
        return $query->where('classify','Wjfj');
    }
    public function scopeFilm($query) {
        return $query->where('classify','Quay phim');
    }
    public function scopeGps($query) {
        return $query->where('classify','Định vị');
    }
    public function scopeBluetooth($query) {
        return $query->where('classify','bluetooth');
    }
    public function allTypeDetail() {
        return $this->hasOne('App\Models\AllTypeDetail','all_type_id','id');
    }
    public function scopeBatteryTechnology($query) {
        return $query->where('classify','Công nghệ pin');
    }

}
