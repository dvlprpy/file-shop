<?php

namespace App\Models;

use App\Traits\categoriables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    use categoriables;
    
    protected $table = 'files';
    
    protected $primaryKey = 'file_id';

    protected $guarded = ['file_id'];

    public function packages(){

        return $this->belongsToMany(Package::class, 'package_file', 'file_id', 'package_id');
    }

    public function setYourFileArrtibute ($value) {

        $this->attributes['path'] = '/storage/app/public/images/default-avatar.svg';
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->visibility === 'public') {
            // فایل public توی storage/app/public/upload ذخیره میشه
            return Storage::url($this->path); 
        }

        if ($this->visibility === 'private') {
            // برای private باید یه روت واسط داشته باشیم
            return route('files.private.thumbnail', $this->file_id );
        }

        return '/storage/app/public/images/default-avatar.svg'; // fallback
    }
    
}