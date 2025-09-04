<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $primaryKey = 'payment_id';
    protected $guarded = ['payment_id'];
    const CREATED_AT = 'payment_created_at';
    const UPDATED_AT = 'payment_updated_at';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_user_id', 'user_id');
    }


    // فرمت روش پرداخت
    public function getPaymentMethodFormatAttribute()
    {
        switch ($this->payment_method) {
            case 'wallet':
                return 'پرداخت با کیف پول';
            case 'card':
                return 'پرداخت با کارت بانکی';
            default:
                return 'روش پرداخت نامشخص';
        }
    }


    // فرمت وضعیت پرداخت
    public function getPaymentStatusIconAttribute()
    {
        switch ($this->payment_status) {
            case 'complete':
                return '<i class="bi bi-check-circle-fill text-success fs-4" data-bs-toggle="tooltip" data-bs-placement="top" title="پرداخت موفقیت آمیز بود"></i>';
            
            case 'incomplete':
                return '<i class="bi bi-x-circle-fill text-danger fs-4" data-bs-toggle="tooltip" data-bs-placement="top" title="پرداخت ناموفق بود"></i>';
            
            default:
                return '<i class="bi bi-question-circle text-secondary fs-4" data-bs-toggle="tooltip" data-bs-placement="top" title="وضعیت نامشخص"></i>';
        }
    }

}