<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribes';
    protected $primaryKey  = 'subscribe_id';
    public $timestamps = false;
    protected $guarded = ['subscribe_id'];
    protected $casts = [
        'subscribe_expired_at' => 'datetime',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'subscribe_user_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'subscribe_plan_id');
    }
}
