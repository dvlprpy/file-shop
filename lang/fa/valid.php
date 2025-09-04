<?php

return [

    /*
    |--------------------------------------------------------------------------
    | خطوط اعتبارسنجی پیش‌فرض لاراول (ترجمه فارسی)
    |--------------------------------------------------------------------------
    |
    | این پیام‌ها برای ولیدیشن مقادیر ورودی استفاده می‌شوند.
    | :attribute نام فیلد است، :value مقدار داده‌شده و :other یک فیلد دیگر است.
    |
    */

    'accepted'             => ':attribute باید پذیرفته شود.',
    'accepted_if'          => ':attribute باید پذیرفته شود وقتی :other برابر :value باشد.',
    'active_url'           => ':attribute یک آدرس معتبر نیست.',
    'after'                => ':attribute باید تاریخی بعد از :date باشد.',
    'after_or_equal'       => ':attribute باید تاریخی برابر یا بعد از :date باشد.',
    'alpha'                => ':attribute فقط باید شامل حروف باشد.',
    'alpha_dash'           => ':attribute فقط باید شامل حروف، اعداد، خط تیره و زیرخط باشد.',
    'alpha_num'            => ':attribute فقط باید شامل حروف و اعداد باشد.',
    'array'                => ':attribute باید آرایه باشد.',
    'ascii'                => ':attribute باید فقط شامل کاراکترهای الفبایی و نمادهای تک‌بایتی باشد.',
    'before'               => ':attribute باید تاریخی قبل از :date باشد.',
    'before_or_equal'      => ':attribute باید تاریخی برابر یا قبل از :date باشد.',
    'between'              => [
        'numeric' => ':attribute باید بین :min و :max باشد.',
        'file'    => 'حجم :attribute باید بین :min و :max کیلوبایت باشد.',
        'string'  => ':attribute باید بین :min و :max کاراکتر باشد.',
        'array'   => ':attribute باید بین :min و :max آیتم داشته باشد.',
    ],
    'boolean'              => 'فیلد :attribute باید صحیح یا غلط باشد.',
    'can'                  => 'فیلد :attribute شامل مقدار غیرمجاز است.',
    'confirmed'            => ':attribute با تاییدیه مطابقت ندارد.',
    'current_password'     => 'رمز عبور اشتباه است.',
    'date'                 => ':attribute یک تاریخ معتبر نیست.',
    'date_equals'          => ':attribute باید تاریخی برابر با :date باشد.',
    'date_format'          => ':attribute با قالب :format مطابقت ندارد.',
    'decimal'              => ':attribute باید :decimal رقم اعشار داشته باشد.',
    'declined'             => ':attribute باید رد شود.',
    'declined_if'          => ':attribute باید رد شود وقتی :other برابر :value باشد.',
    'different'            => ':attribute و :other باید متفاوت باشند.',
    'digits'               => ':attribute باید :digits رقم باشد.',
    'digits_between'       => ':attribute باید بین :min و :max رقم باشد.',
    'dimensions'           => 'ابعاد تصویر :attribute معتبر نیست.',
    'distinct'             => 'فیلد :attribute مقدار تکراری دارد.',
    'doesnt_end_with'      => ':attribute نباید با یکی از مقادیر :values تمام شود.',
    'doesnt_start_with'    => ':attribute نباید با یکی از مقادیر :values شروع شود.',
    'email'                => ':attribute باید یک ایمیل معتبر باشد.',
    'ends_with'            => ':attribute باید با یکی از مقادیر :values پایان یابد.',
    'enum'                 => ':attribute انتخاب شده معتبر نیست.',
    'exists'               => ':attribute انتخاب شده معتبر نیست.',
    'file'                 => ':attribute باید یک فایل باشد.',
    'filled'               => 'فیلد :attribute باید مقدار داشته باشد.',
    'gt'                   => [
        'numeric' => ':attribute باید بزرگتر از :value باشد.',
        'file'    => 'حجم :attribute باید بزرگتر از :value کیلوبایت باشد.',
        'string'  => ':attribute باید بیشتر از :value کاراکتر باشد.',
        'array'   => ':attribute باید بیشتر از :value آیتم داشته باشد.',
    ],
    'gte'                  => [
        'numeric' => ':attribute باید بزرگتر یا مساوی :value باشد.',
        'file'    => 'حجم :attribute باید بزرگتر یا مساوی :value کیلوبایت باشد.',
        'string'  => ':attribute باید حداقل :value کاراکتر باشد.',
        'array'   => ':attribute باید حداقل :value آیتم داشته باشد.',
    ],
    'image'                => ':attribute باید تصویر باشد.',
    'in'                   => ':attribute انتخاب شده معتبر نیست.',
    'in_array'             => 'فیلد :attribute در :other موجود نیست.',
    'integer'              => ':attribute باید عدد صحیح باشد.',
    'ip'                   => ':attribute باید آدرس IP معتبر باشد.',
    'ipv4'                 => ':attribute باید یک آدرس IPv4 معتبر باشد.',
    'ipv6'                 => ':attribute باید یک آدرس IPv6 معتبر باشد.',
    'json'                 => ':attribute باید یک رشته JSON معتبر باشد.',
    'lowercase'            => ':attribute باید حروف کوچک باشد.',
    'lt'                   => [
        'numeric' => ':attribute باید کمتر از :value باشد.',
        'file'    => 'حجم :attribute باید کمتر از :value کیلوبایت باشد.',
        'string'  => ':attribute باید کمتر از :value کاراکتر باشد.',
        'array'   => ':attribute باید کمتر از :value آیتم داشته باشد.',
    ],
    'lte'                  => [
        'numeric' => ':attribute باید کمتر یا مساوی :value باشد.',
        'file'    => 'حجم :attribute باید کمتر یا مساوی :value کیلوبایت باشد.',
        'string'  => ':attribute باید حداکثر :value کاراکتر باشد.',
        'array'   => ':attribute نباید بیشتر از :value آیتم داشته باشد.',
    ],
    'mac_address'          => ':attribute باید یک آدرس MAC معتبر باشد.',
    'max'                  => [
        'numeric' => ':attribute نباید بیشتر از :max باشد.',
        'file'    => 'حجم :attribute نباید بیشتر از :max کیلوبایت باشد.',
        'string'  => ':attribute نباید بیشتر از :max کاراکتر باشد.',
        'array'   => ':attribute نباید بیشتر از :max آیتم داشته باشد.',
    ],
    'max_digits'           => ':attribute نباید بیشتر از :max رقم باشد.',
    'mimes'                => ':attribute باید از نوع: :values باشد.',
    'mimetypes'            => ':attribute باید از نوع: :values باشد.',
    'min'                  => [
        'numeric' => ':attribute نباید کمتر از :min باشد.',
        'file'    => 'حجم :attribute نباید کمتر از :min کیلوبایت باشد.',
        'string'  => ':attribute نباید کمتر از :min کاراکتر باشد.',
        'array'   => ':attribute نباید کمتر از :min آیتم داشته باشد.',
    ],
    'min_digits'           => ':attribute نباید کمتر از :min رقم باشد.',
    'missing'              => ':attribute باید خالی باشد.',
    'multiple_of'          => ':attribute باید مضربی از :value باشد.',
    'not_in'               => ':attribute انتخاب شده معتبر نیست.',
    'not_regex'            => 'فرمت :attribute معتبر نیست.',
    'numeric'              => ':attribute باید عدد باشد.',
    'password'             => [
        'letters'       => ':attribute باید حداقل یک حرف داشته باشد.',
        'mixed'         => ':attribute باید شامل حروف بزرگ و کوچک باشد.',
        'numbers'       => ':attribute باید حداقل یک عدد داشته باشد.',
        'symbols'       => ':attribute باید حداقل یک نماد داشته باشد.',
        'uncompromised' => ':attribute در یک نشت داده یافت شده است.',
    ],
    'present'              => ':attribute باید وجود داشته باشد.',
    'prohibited'           => ':attribute غیرمجاز است.',
    'regex'                => 'فرمت :attribute معتبر نیست.',
    'required'             => ':attribute الزامی است.',
    'same'                 => ':attribute و :other باید یکسان باشند.',
    'size'                 => [
        'numeric' => ':attribute باید :size باشد.',
        'file'    => 'حجم :attribute باید :size کیلوبایت باشد.',
        'string'  => ':attribute باید :size کاراکتر باشد.',
        'array'   => ':attribute باید شامل :size آیتم باشد.',
    ],
    'starts_with'          => ':attribute باید با یکی از مقادیر :values شروع شود.',
    'string'               => ':attribute باید رشته باشد.',
    'timezone'             => ':attribute باید یک منطقه زمانی معتبر باشد.',
    'unique'               => ':attribute قبلاً استفاده شده است.',
    'uploaded'             => ':attribute بارگذاری نشد.',
    'url'                  => 'فرمت :attribute معتبر نیست.',
    'uuid'                 => ':attribute باید UUID معتبر باشد.',

    /*
    |--------------------------------------------------------------------------
    | پیام‌های سفارشی برای قوانین خاص
    |--------------------------------------------------------------------------
    */
    'custom' => [
        'password' => [
            'min' => 'رمز عبور باید حداقل :min کاراکتر باشد.',
        ],
        'email' => [
            'unique' => 'این ایمیل قبلاً ثبت شده است.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ترجمه نام فیلدها به فارسی
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        'name' => 'نام',
        'username' => 'نام کاربری',
        'email' => 'ایمیل',
        'password' => 'رمز عبور',
        'password_confirmation' => 'تایید رمز عبور',
        'current_password' => 'رمز عبور فعلی',
        'new_password' => 'رمز عبور جدید',
        'new_password_confirmation' => 'تایید رمز عبور جدید',
        'phone' => 'شماره تلفن',
        'mobile' => 'شماره موبایل',
        'address' => 'آدرس',
        'city' => 'شهر',
        'country' => 'کشور',
        'province' => 'استان',
        'postal_code' => 'کد پستی',
        'description' => 'توضیحات',
        'title' => 'عنوان',
        'content' => 'محتوا',
        'body' => 'متن',
        'photo' => 'عکس',
        'image' => 'تصویر',
        'avatar' => 'آواتار',
        'file' => 'فایل',
    ],

];
