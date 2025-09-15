<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>بازیابی رمز عبور</title>
    </head>
    <body style="background:#f7f7f7; font-family:Tahoma, Arial, sans-serif; direction:rtl; padding:20px; color:#333;">
    <div style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,.05); overflow:hidden;">
        
        <!-- Header -->
        <div style="background:#4CAF50; color:#fff; padding:20px; text-align:center;">
        <h1 style="margin:0; font-size:22px;">بازیابی رمز عبور</h1>
        </div>
        
        <!-- Body -->
        <div style="padding:30px;">
        <h3 style="margin-top:0; font-size:18px;">
            {{ $Name->fullname ?? 'کاربر عزیز' }}، سلام 👋
        </h3>
        
        <p style="font-size:15px; line-height:1.8; margin:20px 0;">
            ما متوجه شدیم که شما رمز عبور حساب کاربری خود را فراموش کرده‌اید.
            برای بازیابی رمز عبور، یک <strong>توکن امنیتی</strong> برای شما ارسال کرده‌ایم.
        </p>
        
        <p style="font-size:15px; line-height:1.8; margin:20px 0;">
            لطفاً اگر قصد بازیابی رمز عبور خود را دارید، این توکن را در فرم بازیابی رمز وارد کنید.
            در غیر این صورت این ایمیل را نادیده بگیرید.
        </p>

        <!-- Token Button -->
        <div style="text-align:center; margin:30px 0;">
            <span style="
            display:inline-block;
            background-color:#4CAF50;
            color:#fff;
            font-size:20px;
            padding:15px 30px;
            border-radius:6px;
            letter-spacing:2px;
            text-decoration:none;
            cursor:pointer;
            user-select:all;
            ">
            {{ $Token }}
            </span>
            <p style="font-size:12px; color:#999; margin-top:10px;">
            روی توکن کلیک کرده و آن را کپی کنید.
            </p>
        </div>

        <p style="font-size:13px; color:#999; text-align:center;">
            اگر این درخواست توسط شما نبوده است، لطفاً این ایمیل را نادیده بگیرید یا با پشتیبانی تماس بگیرید.
        </p>
        </div>

        <!-- Footer -->
        <div style="background:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#888;">
        © {{ date('Y') }} همه حقوق محفوظ است.
        </div>
    </div>
    </body>
</html>
