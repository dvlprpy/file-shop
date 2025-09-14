<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['downloadable_id', 'downloadable_type'];

    public function downloadable()
    {
        return $this->morphTo();
    }
}