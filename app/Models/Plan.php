<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $primaryKey = 'plan_id';

    protected $fillable = [
        'plan_title',
        'plan_download_limit',
        'plan_price',
        'plan_day',
    ];

    protected static function boot() {

        parent::boot();

        static::creating(function ($model) {

            $model->plan_uuid = (string) \Illuminate\Support\Str::uuid();

        });
    }

    public function subscribe()
    {
        return $this->hasMany(Subscribe::class, 'subscribe_plan_id');
    }
}