<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"         => ":attribute باید پذیرفته شده باشد.",
    'accepted_if'      => 'هنگامی که :other، :value است باید با :attribute توافق کنید.',
    "active_url"       => "آدرس :attribute معتبر نیست",
    "after"            => ":attribute باید تاریخی بعد از :date باشد.",
    'after_or_equal'   => ':attribute باید بعد از یا برابر تاریخ :date باشد.',
    "alpha"            => ":attribute باید شامل حروف الفبا باشد.",
    "alpha_dash"       => ":attribute باید شامل حروف الفبا و عدد و خظ تیره(-) باشد.",
    "alpha_num"        => ":attribute باید شامل حروف الفبا و عدد باشد.",
    'any_of' => 'The :attribute field is invalid.',
    "array"            => ":attribute باید شامل آرایه باشد.",
    "ascii"            => ":attribute .باید شامل کاراکترها و نمادهای الفبایی تک بایتی باشد",
    "before"           => ":attribute باید تاریخی قبل از :date باشد.",
    'before_or_equal' => ':attribute باید قبل از یا برابر تاریخ :date باشد.',
    "between"          => [
        "numeric" => ":attribute باید بین :min و :max باشد.",
        "file"    => ":attribute باید بین :min و :max کیلوبایت باشد.",
        "string"  => ":attribute باید بین :min و :max کاراکتر باشد.",
        "array"   => ":attribute باید بین :min و :max آیتم باشد.",
    ],
    "boolean"          => "فیلد :attribute فقط میتواند صحیح و یا غلط باشد",
    'can' => 'The :attribute field contains an unauthorized value.',
    "confirmed"        => ":attribute با تاییدیه مطابقت ندارد.",
    'contains' => 'The :attribute field is missing a required value.',
    'current_password'         => 'رمز عبور اشتباه است.',
    "date"             => ":attribute یک تاریخ معتبر نیست.",
    'date_equals'      => ':attribute باید برابر تاریخ :date باشد.',
    "date_format"      => ":attribute با الگوی :format مطاقبت ندارد.",
    'decimal'          => 'The :attribute field must have :decimal decimal places.',
    'declined'         => ':attribute باید پذیرفته نشود.',
    'declined_if'      => 'هنگامی که :other، :value است باید با :attribute نپذیرید.',
    "different"        => ":attribute و :other باید متفاوت باشند.",
    "digits"           => ":attribute باید :digits رقم باشد.",
    "digits_between"   => ":attribute باید بین :min و :max رقم باشد.",
    'dimensions'       => 'dimensions مربوط به فیلد :attribute اشتباه است.',
    'distinct'         => ':attribute مقدار تکراری دارد.',
    'doesnt_end_with'  => ':attribute نباید با یکی از موارد :values تمام شود.',
    'doesnt_start_with'  => ':attribute نباید با یکی از موارد :values شروع شود.',
    "email"            => "فرمت :attribute معتبر نیست.",
    'ends_with'        => ':attribute باید با این مقدار تمام شود: :values.',
    "enum"             => ":attribute انتخاب شده، معتبر نیست.",
    "exists"           => ":attribute انتخاب شده، معتبر نیست.",
    'extensions' => 'The :attribute field must have one of the following extensions: :values.',
    'file'            => 'فیلد :attribute باید فایل باشد.',
    "filled"           => "فیلد :attribute الزامی است",
    'gt' => [
        'numeric' => ':attribute باید بیشتر از :value باشد.',
        'file'    => ':attribute باید بیشتر از :value کیلوبایت باشد.',
        'string'  => ':attribute باید بیشتر از :value کاراکتر باشد.',
        'array'   => ':attribute باید بیشتر از :value ایتم باشد.',
    ],
    'gte' => [
        'numeric' => ':attribute باید بیشتر یا برابر :value باشد.',
        'file'    => ':attribute باید بیشتر یا برابر :value کیلوبایت باشد.',
        'string'  => ':attribute باید بیشتر یا برابر :value کاراکتر باشد.',
        'array'   => ':attribute باید :value ایتم یا بیشتر را داشته باشد.',
    ],
    'hex_color' => 'The :attribute field must be a valid hexadecimal color.',
    "image"            => ":attribute باید تصویر باشد.",
    "in"               => ":attribute انتخاب شده، معتبر نیست.",
    "integer"          => ":attribute باید نوع داده ای عددی (integer) باشد.",
    'in_array'         => 'فیلد :attribute در :other موجود نیست.',
    'in_array_keys' => 'The :attribute field must contain at least one of the following keys: :values.',
    "ip"               => ":attribute باید IP آدرس معتبر باشد.",
    'ipv4'             => ':attribute باید یک ادرس درست IPv4 باشد.',
    'ipv6'             => ':attribute باید یک ادرس درست IPv6 باشد.',
    'json'             => ':attribute یک مقدار درست JSON باشد.',
    'list' => 'The :attribute field must be a list.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'lt' => [
        'numeric' => ':attribute باید کمتر از :value باشد.',
        'file'    => ':attribute باید کمتر از :value کیلوبایت باشد.',
        'string'  => ':attribute باید کمتر از :value کاراکتر باشد.',
        'array'   => ':attribute باید :value ایتم یا کمتر را داشته باشد.',
    ],
    'lte' => [
        'numeric' => ':attribute باید کمتر یا برابر :value باشد.',
        'file'    => ':attribute باید کمتر یا برابر :value کیلوبایت باشد.',
        'string'  => ':attribute باید کمتر یا برابر :value کاراکتر باشد.',
        'array'   => ':attribute باید :value ایتم یا کمتر را داشته باشد.',
    ],
    "mac_address"           => ":attribute باید یک مک آدرس معتبر باشد.",
    "max"              => [
        "numeric" => ":attribute نباید بزرگتر از :max باشد.",
        "file"    => ":attribute نباید بزرگتر از :max کیلوبایت باشد.",
        "string"  => ":attribute نباید بیشتر از :max کاراکتر باشد.",
        "array"   => ":attribute نباید بیشتر از :max آیتم باشد.",
    ],
    "max_digits"       => ":attribute نباید بیشتر از :max رقم داشته باشد.",
    "mimes"            => ":attribute باید یکی از فرمت های :values باشد.",
    'mimetypes'        => ':attribute باید تایپ آن از نوع: :values باشد.',
    "min"              => [
        "numeric" => ":attribute نباید کوچکتر از :min باشد.",
        "file"    => ":attribute نباید کوچکتر از :min کیلوبایت باشد.",
        "string"  => ":attribute نباید کمتر از :min کاراکتر باشد.",
        "array"   => ":attribute نباید کمتر از :min آیتم باشد.",
    ],
    "min_digits"       => ":attribute نباید کمتر از :min رقم داشته باشد.",
    "missing"           => ":attribute باید از دست رفته باشد.",
    "missing_if"           => ":attribute نباید وجود داشته باشد تا زمانی که :other :value باشد.",
    "missing_unless"           => ":attribute نباید وجود داشته باشد یا اینکه :other :value باشد.",
    "missing_with"           => ":attribute باید در صورت :value وجود نداشته باشد.",
    "missing_with_all"           => ":attribute باید در صورت تمامی :value وجود نداشته باشد.",
    'multiple_of'      => ':attribute باید ضریبی از :value باشد.',
    "not_in"           => ":attribute انتخاب شده، معتبر نیست.",
    'not_regex'        => ':attribute فرمت معتبر نیست.',
    "numeric"          => ":attribute باید شامل عدد باشد.",
    'password' => [
        'letters' => ':attribute باید حدقل شامل یک حرف باشد.',
        'mixed' => ':attribute باید حداقل یک حرف بزرگ یا یک حرف کوچک انگلیسی را شامل باشد.',
        'numbers' => ':attribute باید حداقل شامل یک عدد باشد.',
        'symbols' => ':attribute باید حداقل شامل یک نماد یا نشان(سمبل) باشد ',
        'uncompromised' => ':attribute وارد شده سازگار ندارد. لطفا :attribute دیگری را امتحان کنید.',
    ],
    'present'          => ':attribute باید وجود داشته باشد.',
    'present_if' => 'The :attribute field must be present when :other is :value.',
    'present_unless' => 'The :attribute field must be present unless :other is :value.',
    'present_with' => 'The :attribute field must be present when :values is present.',
    'present_with_all' => 'The :attribute field must be present when :values are present.',
    'prohibited'       => 'فیلد :attribute ممنوع است.',
    'prohibited_if'    => 'هنگام که :other، :value است فیلد :attribute ممنوع است.',
    'prohibited_if_accepted' => 'The :attribute field is prohibited when :other is accepted.',
    'prohibited_if_declined' => 'The :attribute field is prohibited when :other is declined.',
    'prohibited_unless' => ':attribute ممنوع است مگر اینکه :other برابر با (:values) باشد.',
    'prohibits'        => 'هنگام ورود فیلد :attribute، وارد کردن فیلد :other ممنوع است.',
    "regex"            => ":attribute یک فرمت معتبر نیست",
    "required"         => "فیلد :attribute الزامی است",
    "required_array_keys" => ":attribute باید شامل ورودی هایی برای :for :values باشد.",
    "required_if"      => "فیلد :attribute هنگامی که :other برابر با :value است، الزامیست.",
    "required_if_accepted" => ":attribute زمانی الزامی میباشد که :other پذیرفته شود.",
    'required_if_declined' => 'The :attribute field is required when :other is declined.',
    'required_unless'  => 'قیلد :attribute الزامیست مگر این فیلد :other مقدارش  :values باشد.',
    "required_with"    => ":attribute الزامی است تا زمانی که :values موجود است.",
    "required_with_all" => ":attribute الزامی است تا زمانی که همه :values ها موجود است.",
    "required_without" => ":attribute الزامی است تا زمانی که :values موجود نیست.",
    "required_without_all" => ":attribute الزامی است تا زمانی که :values ها موجود نیست.",
    "same"             => ":attribute و :other باید مانند هم باشند.",
    "size"             => [
        "numeric" => ":attribute باید برابر با :size باشد.",
        "file"    => ":attribute باید برابر با :size کیلوبایت باشد.",
        "string"  => ":attribute باید برابر با :size کاراکتر باشد.",
        "array"   => ":attribute باسد شامل :size آیتم باشد.",
    ],
    'starts_with'      => ':attribute باید با یکی از این مقادیر شروع شود: :values.',
    "string"           => ":attribute باید رشته باشد.",
    "timezone"         => "فیلد :attribute باید یک منطقه صحیح باشد.",
    "unique"           => ":attribute قبلا انتخاب شده است.",
    'uploaded'         => 'فیلد :attribute به درستی اپلود نشد.',
    'uppercase' => 'The :attribute field must be uppercase.',
    "url"              => "فرمت آدرس :attribute اشتباه است.",
    'ulid'             => ':attribute باید یک فرمت درست ULID باشد.',
    'uuid'             => ':attribute باید یک فرمت درست UUID باشد.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'fullname' => [
            'required' => 'وارد کردن نام و نام خانوادگی الزامی است.',
            'max'      => 'نام و نام خانوادگی نباید بیشتر از ۱۰۰ کاراکتر باشد.',
            'regex'    => 'نام و نام خانوادگی فقط می‌تواند شامل حروف فارسی یا انگلیسی، اعداد و فاصله باشد. کاراکترهایی مانند ! ، @ ، # مجاز نیستند.',
            'string' => 'نام و نام خانوادگی باید رشته از کاراکتر باشد.',
        ],
        'username' => [
            'required' => 'وارد کردن نام کاربری الزامی است.',
            'max'      => 'نام کاربری نباید بیشتر از ۵۰ کاراکتر باشد.',
            'regex'    => 'نام کاربری فقط می‌تواند شامل حروف انگلیسی (A-Z , a-z) و اعداد (0-9) باشد. استفاده از فاصله یا کاراکتر خاص مجاز نیست.',
            'unique'   => 'این نام کاربری قبلاً ثبت شده است.',
            'string'   => 'نام کاربری باید به صورت رشته از از کاراکتر ها باشد.',
        ],
        'password' => [
            'required'  => 'رمز عبور الزامی است.',
            'min'       => 'رمز عبور نباید کمتر از ۸ کاراکتر باشد.',
            'max'       => 'رمز عبور نباید بیشتر از ۱۵ کاراکتر باشد.',
            'confirmed' => 'تکرار رمز عبور مطابقت ندارد.',
            'regex'     => 'رمز عبور باید شامل موارد زیر باشد:  
                - حداقل یک حرف کوچک انگلیسی (a-z)  
                - حداقل یک حرف بزرگ انگلیسی (A-Z)  
                - حداقل یک عدد (0-9)  
                - حداقل یک کاراکتر خاص مانند !@#$%^&*()_+  
                طول رمز عبور باید بین ۸ تا ۱۵ کاراکتر باشد.',
            'string'    => 'پسورد باید ترکیبی از کاراکتر، اعداد، علائم خاص باشد.',
        ],
        'phone' => [
            'required' => 'شماره موبایل الزامی است.',
            'digits'   => 'شماره موبایل باید دقیقاً ۱۱ رقم باشد.',
            'regex'    => 'شماره موبایل معتبر نیست. باید با 09 شروع شود و فقط شامل اعداد باشد.',
            'unique'   => 'این شماره موبایل قبلاً ثبت شده است.',
        ],
        'email' => [
            'required' => 'ایمیل الزامی است.',
            'email'    => 'ایمیل وارد شده معتبر نیست.',
            'max'      => 'ایمیل نباید بیشتر از 200 کاراکتر باشد.',
            'unique'   => 'این ایمیل قبلاً ثبت شده است.',
        ],
        'wallet' => [
            'numeric' => 'موجودی کیف پول باید یک عدد باشد.',
            'min'     => 'موجودی کیف پول نمی‌تواند منفی باشد.',
        ],
        'role' => [
            'required' => 'انتخاب نقش کاربر الزامی است.',
            'max'      => 'نقش کاربر نباید بیشتر از ۱۵ کاراکتر باشد.',
            'in'       => 'نقش انتخاب شده معتبر نیست.',
        ],
        'profile_picture' => [
            'image' => 'فایل آپلود شده باید تصویر باشد.',
            'mimes' => 'تصویر باید با فرمت jpg، jpeg یا png باشد.',
            'max'   => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ],
        'file_title' => [
            'required' => 'وارد کردن نام فایل الزامی می باشد.',
            'max' => 'حداکثر تعداد کاراکتر مجاز برای فیلد نام فایل 255 کاراکتر است.',
            'string' => 'نام فایل را به درستی وارد کنید .',
        ],
        'file_description' => [
            'required' => 'وارد کردن توضیحات فایل الزامی می باشد.',
            'string' => 'توضیحات فایل را به درستی وارد کنید .',
        ],
        'your_file' => [
            'required' => "بارگذای فایل الزامی می باشد.",
            'file' => 'شما باید الزاما یک فایل بارگذاری کنید.',
            'max' => 'حداکثر حجم فایل قابل بارگذاری نباید از 10 مگابایت تجاوز کند.',
            'mimes' => 'فایل مورد نظر باید یا عکس یا پی دی اف و یا ورد باشد.'
        ],
        'plan_title' => [
            'required' => "وارد کردن عنوان طرح الزامی می باشد.",
            'string' => 'عنوان طرح باید به صورت رشته ای یا کاراکتری باشد.',
            'max' => 'عنوان طرح حداکثر باید 200 کاراکتر باشد.',
        ],
        'plan_download_limit' => [
            'required' => "وارد کردن محدودیت تعداد دانلود الزامی می باشد.",
            'integer' => 'محدودیت تعداد دانلود باید الزاما عددی باشد.',
            'min' => 'حداقل محدودیت تعداد دانلود باید 1 باشد.',
        ],
        'plan_price' => [
            'required' => "وارد کردن قیمت طرح الزامی می باشد.",
            'numeric' => 'قیمت طرح باید به صورت عددی وارد شود.',
            'min' => 'حداقل قیمت طرح باید 1.0 باشد.',
        ],
        'plan_day' => [
            'required' => "وارد کردن تعداد روز های طرح الزامی می باشد.",
            'integer' => 'تعداد روز های طرح باید عددی باشد.',
            'min' => 'حداقل تعداد روز های طرح باید 1 روز باشد.',
        ],
        'package_title' => [
            'required' => "وارد کردن عنوان یا نام پکیج الزامی می باشد.",
            'string' => 'عنوان یا نام پکیج باید مجموعه ای از کاراکتر ها باشد. ',
            'max' => 'حداکثر کاراکتر مجاز برای نام پکیج 220 کاراکتر است.',
        ],
        'package_description' => [
            'required' => "وارد کردن توضیحات پکیج الزامی می باشد.",
            'string' => 'توضیحات پکیج باید مجموعه ای از کاراکتر ها باشد.',
        ],
        'package_price' => [
            'required' => "وارد کردن قیمت پکیج الزامی می باشد. ",
            'integer' => 'قیمت پکیج باید عدد صحیح باشد بدون اعشار.',
        ],
    ],



    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    'attributes' => [
        "name" => "نام",
        "fullname" => "نام و نام خانوادگی",
        "username" => "نام کاربری",
        "email" => "پست الکترونیکی",
        "first_name" => "نام",
        "last_name" => "نام خانوادگی",
        "family" => "نام خانوادگی",
        "password" => "رمز عبور",
        'password_confirmation' => 'تکرار رمز عبور',
        "city" => "شهر",
        "province" => "استان",
        "country" => "کشور",
        "address" => "نشانی",
        "phone" => "تلفن",
        "mobile" => "تلفن همراه",
        "age" => "سن",
        "sex" => "جنسیت",
        "gender" => "جنسیت",
        "birthday" => "تاریخ تولد",
        "birthdate" => "تاریخ تولد",
        "married" => "متاهل",
        "single" => "مجرد",
        "day" => "روز",
        "month" => "ماه",
        "year" => "سال",
        "hour" => "ساعت",
        "minute" => "دقیقه",
        "second" => "ثانیه",
        "title" => "عنوان",
        "text" => "متن",
        "content" => "محتوا",
        "description" => "توضیحات",
        "excerpt" => "گلچین کردن",
        "date" => "تاریخ",
        "time" => "زمان",
        "available" => "موجود",
        "size" => "اندازه",
        "volume" => "حجم",
        "file" => "فایل",
        "fullname" => "نام کامل",
        "melli_code" => "کد ملی",
        "national_number" => "کد ملی",
        "postal_code" => "کد پستی",
        "zip_code" => "کد پستی",
        "passport_number" => "شماره پاسپورت",
        "passport_no" => "شماره پاسپورت",
        "sheba_number" => "شماره شبا",
        "iban" => "شماره شبا",
        "accountـnumber" => "شماره حساب",
        'wallet' => 'موجودی کیف پول',
        'role' => 'نقش کاربر',
        'profile_picture' => 'عکس پروفایل',
    ],
];
