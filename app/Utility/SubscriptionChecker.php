<?php

namespace App\Utility;

use App\Models\Subscribe;
use Carbon\Carbon;

class SubscriptionChecker
{
    /**
     * بررسی می‌کند که آیا کاربر اشتراک فعال دارد یا خیر.
     *
     * @param int|null $userId
     * @return array
     */
    public static function checkUserSubscription(?int $userId): array
    {
        if (!$userId) {
            return [
                'status'  => false,
                'message' => 'شناسه کاربر معتبر نیست.',
                'downloads_left' => 0
            ];
        }

        $user_subscribed = Subscribe::where('subscribe_user_id', $userId)
            ->where('subscribe_expired_at', '>=', Carbon::now())
            ->orderByDesc('subscribe_expired_at')
            ->first();

        if (!$user_subscribed) {
            return [
                'status'  => false,
                'message' => 'هیچ اشتراک فعالی برای این کاربر یافت نشد.',
                'downloads_left' => 0
            ];
        }

        // محاسبه تعداد دانلود باقی‌مانده
        $downloads_left = $user_subscribed->subscribe_download_limit - $user_subscribed->subscribe_download_count;

        if ($downloads_left > 0) {
            return [
                'status'  => true,
                'message' => 'کاربر اشتراک فعال دارد.',
                'downloads_left' => $downloads_left
            ];
        }

        return [
            'status'  => false,
            'message' => 'سقف دانلود این اشتراک به پایان رسیده است.',
            'downloads_left' => 0
        ];
    }
}