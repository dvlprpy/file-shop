<?php 

namespace App\Traits;

use App\Models\Category;

trait categoriables{

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categoriable', 'categoriables', 'categoriable_id', 'category_id');
    }
}