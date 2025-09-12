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
                'downloads_left' => 0,
                'subscribe' => null,
            ];
        }

        // گرفتن آخرین اشتراک کاربر بر اساس تاریخ انقضاء
        $user_subscribed = Subscribe::where('subscribe_user_id', $userId)
            ->whereColumn('subscribe_download_count', '<', 'subscribe_download_limit')
            ->where('subscribe_expired_at', '>', now())
            ->orderByDesc('subscribe_created_at') // آخرین اشتراک خریداری شده
            ->first();


        if (!$user_subscribed) {
            return [
                'status'  => false,
                'message' => 'هیچ اشتراکی برای این کاربر یافت نشد.',
                'downloads_left' => 0,
                'subscribe' => null,
            ];
        }

        // بررسی تاریخ انقضاء
        if (now()->gt($user_subscribed->subscribe_expired_at)) {
            return [
                'status'  => false,
                'message' => 'اشتراک منقضی شده است.',
                'downloads_left' => 0,
                'subscribe' => $user_subscribed,
            ];
        }

        // بررسی سقف دانلود
        $downloads_left = $user_subscribed->subscribe_download_limit - $user_subscribed->subscribe_download_count;

        if ($downloads_left <= 0) {
            return [
                'status'  => false,
                'message' => 'سقف دانلود این اشتراک به پایان رسیده است.',
                'downloads_left' => 0,
                'subscribe' => $user_subscribed,
            ];
        }

        return [
            'status'  => true,
            'message' => 'اشتراک فعال است.',
            'downloads_left' => $downloads_left,
            'subscribe' => $user_subscribed,
        ];
    }
}