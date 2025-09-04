<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribes';
    protected $primaryKey  = 'subscribe_id';
    const CREATED_AT = 'subscribe_created_at';
    const UPDATED_AT = 'subscribe_expired_at';
    protected $guarded = ['subscribe_id'];

    public function user(){
        return $this->belongsTo(User::class, 'subscribe_user_id');
    }
}
