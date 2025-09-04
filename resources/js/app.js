// CSS آماده Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';

// SCSS یا CSS سفارشی
import '../scss/app.scss';

// فایل‌های JS پروژه
import './form-backup';
import './table-responsive';

// Import کل Bootstrap JS به صورت module
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// فعال کردن همه tooltip ها
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
    new bootstrap.Tooltip(el);
});
