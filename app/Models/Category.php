<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $guarded = ['category_id'];
    protected $fillable = ['category_name'];
    public $timestamps = false;

    public function files()
    {
        return $this->morphedByMany(File::class, 'categoriable', 'categoriables', 'category_id', 'categoriable_id');
    }

    public function packages()
    {
        return $this->morphedByMany(Package::class, 'categoriable', 'categoriables', 'category_id', 'categoriable_id');
    }

}