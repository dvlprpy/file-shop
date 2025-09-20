# فایل‌شاپ

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge\&logo=laravel\&logoColor=white) ![Blade](https://img.shields.io/badge/Blade-000000?style=for-the-badge\&logo=laravel\&logoColor=white) ![SweetAlert](https://img.shields.io/badge/SweetAlert-FF5E5E?style=for-the-badge\&logo=javascript\&logoColor=white) ![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?style=for-the-badge\&logo=chartdotjs\&logoColor=white) ![JalaliDate](https://img.shields.io/badge/JalaliDate-00A859?style=for-the-badge\&logo=calendar\&logoColor=white)

> **فایل‌شاپ** یک وبسایت فروش فایل و پکیج است که با **Laravel** پیاده‌سازی شده و شامل صفحات کاربری و مدیریتی کامل می‌باشد.

---

## 🔎 درباره پروژه

فایل‌شاپ یک فروشگاه فایل و پکیج است که امکانات زیر را فراهم می‌کند:

* ثبت‌نام و ورود کاربران (Sign up / Sign in)
* بازیابی رمز عبور (Forgot password) با ارسال ایمیل از طریق **Mailtrap**
* پنل مدیریتی برای ادمین (`/admin`)
* پنل کاربری برای کاربران واردشده (`/dashboard`)
* صفحه اصلی وبسایت (`/`)
* صفحه خرید پلن
* یک درگاه پرداخت **فیک** برای تست فرایند خرید
* صفحه درباره ما
* استفاده از کتابخانه‌های **SweetAlert** و **Chart.js** در سمت‌کاربر و داشبوردها
* پشتیبانی از تاریخ **جلالی (Jalali Date)**

---

## 🧰 تکنولوژی‌ها

* Laravel (PHP)
* Blade templates
* SweetAlert (برای اطلاع‌رسانی‌های زیبا)
* Chart.js (برای نمایش نمودارها)
* Jalali Date (برای نمایش و مدیریت تاریخ جلالی)
* Mailtrap (برای تست ارسال ایمیل در محیط توسعه)
* npm / webpack (یا Vite بسته به تنظیمات پروژه)

---

## 🚀 شروع سریع (Installation)

1. مخزن را کلون کنید:

```bash
git clone https://github.com/dvlprpy/file-shop.git
cd https://github.com/dvlprpy/file-shop.git
```

2. فایل `.env` را از نمونه بسازید و تنظیمات دیتابیس و دیگر مقادیر را انجام دهید:


### 📧 پیکربندی Mailtrap

برای ارسال ایمیل (مثل ایمیل بازیابی رمز عبور) در محیط توسعه از سرویس **Mailtrap** استفاده شده است. مقادیر زیر را در `.env` قرار دهید:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="no-reply@example.com"
MAIL_FROM_NAME="FileShop"
```

* مقادیر `MAIL_USERNAME` و `MAIL_PASSWORD` را از داشبورد Mailtrap دریافت کنید.
* در حالت توسعه می‌توانید از `QUEUE_CONNECTION=sync` استفاده کنید تا ایمیل‌ها بدون صف ارسال شوند.


```bash
cp .env.example .env
# سپس .env را با مقدارهای دیتابیس و دیگر تنظیمات ویرایش کنید
```

3. پکیج‌های PHP و JS را نصب کنید:

```bash
composer install
npm install
# یا اگر از pnpm/yarn استفاده می‌کنید: yarn / pnpm install
```

4. کلید اپلیکیشن را بسازید:

```bash
php artisan key:generate
```

5. جدول‌های دیتابیس را ایجاد کنید:

```bash
php artisan migrate
```

6. (اختیاری) داده‌های فیک را وارد کنید:

```bash
php artisan db:seed
```

7. فایل‌های فرانت را بیلد یا در حالت توسعه اجرا کنید:

```bash
npm run dev    # برای توسعه
npm run build  # برای تولید نهایی
```

8. سرور لوکال لاراول را اجرا کنید:

```bash
php artisan serve
# سپس به http://127.0.0.1:8000 بروید
```

---

## 📁 ساختار مسیرهای (Routes)

مسیرهای مهم پروژه:

* `/` — صفحه اصلی وبسایت
* `/admin` — پنل مدیریتی ادمین
* `/dashboard` — پنل کاربری (پس از لاگین)

(همچنین صفحات Sign in, Sign up, Forgot Password و صفحه خرید پلن و درباره ما در مسیرهای مناسب پروژه وجود دارند)

---

## 🖼️ اسکرین‌شات‌ها

تصاویر مربوط به پروژه در پوشه `screenshots/` قرار دارند. اگر نام فایل‌های اسکرین‌شات متفاوت است، نام‌ها را در این README یا در پوشه پروژه اصلاح کنید.

مثال‌های درج تصویر:

![صفحه اصلی](/screenshots/home.png)
![داشبورد ادمین](/screenshots/admin-dashboard.png)
![داشبورد کاربر](/screenshots/user-dashboard.png)
![صفحه خرید](/screenshots/payment.png)
![صفحه درباره ما](/screenshots/about-us.png)
![صفحه دانلود](/screenshots/download-package.png)
![صفحه فراموشی رمز عبور](/screenshots/forgot-password.png)
![صفحه لاگین](/screenshots/login.png)
![صفحه ثبت نام](/screenshots/register.png)
![صفحه لیست پلن ها](/screenshots/plan-list.png)
![درگاه پرداخت فیک](/screenshots/fake-gateway.png)

---

## 🛠️ نکات و تنظیمات اضافی

* اگر در پروژه از درگاه پرداخت فیک استفاده شده، اطمینان حاصل کنید که تنظیمات مربوط به پرداخت در `.env` برای حالت تست قرار دارد.
* برای مدیریت فایل‌های آپلود شده بررسی کنید که پوشه `storage` به درستی لینک شده باشد:

```bash
php artisan storage:link
```

* برای به‌روزرسانی مجوزها یا مسائل مربوط به محیط توسعه، دستورات زیر ممکن است مفید باشد:

```bash
chmod -R 775 storage bootstrap/cache
```

---

## ✅ ویژگی‌ها (Features)

* سیستم عضویت و ورود
* مدیریت کاربران و محصولات در پنل ادمین
* خرید پلن با درگاه فیک
* صفحات اطلاع‌رسانی زیبا با SweetAlert
* گزارشات و نمودارها در داشبوردها با Chart.js
* پشتیبانی از تاریخ جلالی (Jalali Date)

---

## 👥 مشارکت (Contributing)

اگر می‌خواهید مشارکت کنید:

1. یک شاخه جدید (branch) بسازید
2. تغییرات را کامیت کنید
3. Pull request ارسال کنید

---

## 📄 لایسنس

این پروژه تحت لایسنس **MIT** قرار می‌گیرد. اگر لایسنس دیگری می‌خواهید، مقدار را تغییر دهید.

---

## 📞 تماس

در صورت سوال یا نیاز به کمک بیشتر، لطفاً در Issues ریپوزیتوری پیام بذارید یا با صاحب پروژه تماس بگیرید.

---

## ⚙️ ایجاد دامین مجازی (Virtual Host)

برای اجرای پروژه با یک دامین محلی (مثلاً `fileshop.local`) می‌توانید تنظیمات زیر را اعمال کنید:

### تنظیمات در ویندوز (XAMPP)

1. فایل پیکربندی Apache را باز کنید:

```
c:/xampp/apache/conf/extra/httpd-vhosts.conf
```

2. یک بلوک `<VirtualHost>` اضافه کرده و آن را از حالت کامنت خارج کنید. مثلاً:

```apache
<VirtualHost *:80>
    ServerAdmin admin@fileshop.local
    DocumentRoot "C:/xampp/htdocs/fileshop/public"
    ServerName fileshop.local
    ErrorLog "logs/fileshop.local-error.log"
    CustomLog "logs/fileshop.local-access.log" common
</VirtualHost>
```

3. فایل `hosts` ویندوز را باز کنید:

```
C:/windows/system32/drivers/etc/hosts
```

در انتهای فایل خط زیر را اضافه کنید:

```
127.0.0.1   fileshop.local
```

4. حالا می‌توانید با اجرای XAMPP پروژه را از طریق مرورگر با آدرس زیر باز کنید:

```
http://fileshop.local
```

### تنظیمات در لینوکس (Apache)

1. فایل پیکربندی Virtual Host را باز کنید یا ایجاد کنید. معمولاً مسیر آن:

```
/etc/apache2/sites-available/fileshop.conf
```

2. محتوای زیر را داخل فایل قرار دهید:

```apache
<VirtualHost *:80>
    ServerAdmin admin@fileshop.local
    DocumentRoot /var/www/fileshop/public
    ServerName fileshop.local
    ErrorLog ${APACHE_LOG_DIR}/fileshop-error.log
    CustomLog ${APACHE_LOG_DIR}/fileshop-access.log combined
</VirtualHost>
```

3. فایل را ذخیره کنید و سپس سایت را فعال کنید:

```bash
sudo a2ensite fileshop.conf
sudo systemctl reload apache2
```

4. فایل hosts لینوکس را ویرایش کنید:

```
sudo nano /etc/hosts
```

در انتهای فایل خط زیر را اضافه کنید:

```
127.0.0.1   fileshop.local
```

5. حالا می‌توانید پروژه را در مرورگر با آدرس زیر باز کنید:

```
http://fileshop.local
```
