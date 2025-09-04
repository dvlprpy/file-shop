<?php

namespace App\Models;

use App\Traits\categoriables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    
    use categoriables;

    protected $table = 'packages'; // اسم جدول
    protected $primaryKey = 'package_id'; // کلید اصلی
    public $incrementing = true; // اگه auto_increment هست

    protected $fillable = [
        'package_title', 
        'package_description',
        'package_price',
    ];


    protected static function boot(){

        parent::boot();

        static::creating(function ($model) {
            $model->package_uuid = (string) \Illuminate\Support\Str::uuid();
        });
    }


    public function files(){

        return $this->belongsToMany(File::class, 'package_file', 'package_id', 'file_id');
    }

    public function users(){

        return $this->belongsToMany(User::class, 'pivot_user_package', 'package_id', 'user_id')->withPivot(['amount','created_at','updated_at']);
    }
}
