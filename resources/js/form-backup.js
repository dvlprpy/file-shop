// ==================== Helper Functions ====================
function showFieldError(selector, noSelectorError = '') {
    const el = document.querySelector(selector);
    
    if (el) {
        el.style.display = "block";

        if (noSelectorError === 'noError') { /* no error and hide el */
            el.style.display = 'none'
            
        } else if (noSelectorError === 'Error') {/* error and show el */
            el.style.display = "block";            
        }else{/* error and show el */
            el.style.display = 'none'            
        }
        
    }
}
 
/* ================= Email Validation Custome Function ===============================*/
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/* ===================== Password Validation And Checker Function ====================== */
function validatePasswordRules(password) {
    return {
        length: password.length >= 8,
        number: /\d/.test(password),
        upper: /[A-Z]/.test(password),
        special: /[^A-Za-z0-9]/.test(password)
    };
}


// ==================== File Checker ====================
function fileChecker(inputElement, options = {}) {
    const defaults = {
        fileNameSelector: null,
        previewSelector: null,
        errorSelector: null,
        allowedTypes: [],
        maxSize: 2 * 1024 * 1024, // 2MB
        defaultFileNameMessage: 'هیچ فایلی انتخاب نشده',
        defaultErrorMessage: 'لطفاً یک فایل انتخاب کنید.'
    };
    
    const settings = { ...defaults, ...options };

    const fileNameElement = settings.fileNameSelector ? document.querySelector(settings.fileNameSelector) : null;
    const previewImage = settings.previewSelector ? document.querySelector(settings.previewSelector) : null;
    const fileError = settings.errorSelector ? document.querySelector(settings.errorSelector) : null;

    const file = inputElement.files[0];

    // اگر فایلی انتخاب نشده
    if (!file) {
        if (fileNameElement) fileNameElement.textContent = settings.defaultFileNameMessage;
        if (previewImage) previewImage.style.display = 'none';
        if (fileError) {
            fileError.textContent = settings.defaultErrorMessage;
            fileError.style.display = "block";
        }
        return false;
    }

    // بررسی نوع فایل
    if (settings.allowedTypes.length && !settings.allowedTypes.includes(file.type)) {
        if (fileError) {
            fileError.textContent = `نوع فایل مجاز نیست.`;
            fileError.style.display = "block";
        }
        if (previewImage) previewImage.style.display = 'none';
        return false;
    }

    // بررسی حجم فایل
    if (file.size > settings.maxSize) {
        if (fileError) {
            fileError.textContent = `حجم فایل نباید بیشتر از ${(settings.maxSize / 1024 / 1024).toFixed(1)} مگابایت باشد.`;
            fileError.style.display = "block";
        }
        if (previewImage) previewImage.style.display = 'none';
        return false;
    }

    // نمایش نام فایل
    if (fileNameElement) fileNameElement.textContent = file.name;
    if (fileError) fileError.style.display = "none";

    // پیش‌نمایش فقط برای تصاویر
    if (previewImage && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else if (previewImage) {
        previewImage.style.display = 'none';
    }

    return true;
}


// ==================== Send Data Controller (AJAX) ====================
const userForm = document.getElementById('userForm');
if (userForm) {
    userForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        let getErrorFromLaravel = document.getElementById('errorContainer');

        const form = this;
        let isEdit = document.querySelector('[name="_method"]') ? true : false; // اگر @method('PUT') بود یعنی edit
        let hasError = false;

        const email = form.querySelector('[name="email"]').value.trim();
        const password = form.querySelector('[name="password"]').value;

        // ---- Check empty required fields ----
        const requiredFields = [
            { name: "fullname", errorSelector: `.invalid-fullname`},
            { name: "username", errorSelector: `.invalid-username`},
            { name: "email", errorSelector: `.invalid-email`},
            { name: "phone", errorSelector: `.invalid-phone`}
        ];

        // پسورد فقط در حالت create اجباریه
        if (!isEdit) {
            requiredFields.push({ name: "password", errorSelector: `.invalid-password`});
        }

        requiredFields.forEach(field => {
            const value = form.querySelector(`[name="${field.name}"]`).value.trim();
            if (!value) {
                showFieldError(field.errorSelector, 'Error');
                hasError = true;
            } else {
                showFieldError(field.errorSelector);
            }
        });

        // Check email format
        if (!validateEmail(email)) {
            showFieldError(".invalid-email", 'Error');
            hasError = true;
        } else {
            showFieldError(".invalid-email");
        }

        // Check password rules (فقط در create)
        if (!isEdit) {
            const passRules = validatePasswordRules(password);
            if (!(passRules.length && passRules.number && passRules.upper && passRules.special)) {
                showFieldError(".invalid-password", 'Error');
                hasError = true;
            } else {
                showFieldError(".invalid-password");
            }
        } else {
            // edit → اگه خالی بود ایراد نگیر، فقط اگه چیزی وارد شده بود چک کن
            if (password) {
                const passRules = validatePasswordRules(password);
                if (!(passRules.length && passRules.number && passRules.upper && passRules.special)) {
                    showFieldError(".invalid-password", 'Error');
                    hasError = true;
                } else {
                    showFieldError(".invalid-password");
                }
            }
        }

        // Check profile image (اجباری فقط در create)
        const profileImageInput = document.getElementById('profileImage');
        if (!isEdit && profileImageInput.files.length) {
            let isValidImage = fileChecker(profileImageInput, {
                fileNameSelector: '#fileName',
                previewSelector: '#previewImage',
                errorSelector: '#fileError',
                allowedTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'],
                maxSize: 2 * 1024 * 1024
            });
            if (!isValidImage) hasError = true;
        }

        if (hasError) return;

        // ---- Send to Backend ----
        const formData = new FormData(form);
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrf) {
            showToast("توکن امنیتی یافت نشد!", "danger");
            return;
        }

        const headers = {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrf
        };

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        try {            
            const res = await fetch(form.getAttribute('action'), {
                method: 'POST',
                headers,
                body: formData
            });

            const data = await res.json();

            if (!res.ok) {
                if (res.status === 422 && data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        getErrorFromLaravel.innerHTML += `<div>${data.errors[key]}</div>`;
                    });
                } else {
                    getErrorFromLaravel.innerHTML = data.message || "خطای ناشناخته!";
                }
                return;
            } else {
                getErrorFromLaravel.innerHTML = '';
            }

            // Success
            showToast(data.message || (isEdit ? "کاربر با موفقیت ویرایش شد" : "کاربر با موفقیت ثبت شد"), "success");

            if (!isEdit) {
                form.reset();
                document.getElementById('previewImage').style.display = 'none';
                document.getElementById('fileName').textContent = 'هیچ فایلی انتخاب نشده';
            }

            if (data.redirect_url) {
                setTimeout(() => {
                    window.location.href = data.redirect_url;
                }, 2000);
            }

        } catch (err) {
            showToast(err.message || "خطا در ارسال داده‌ها", "danger");            
        } finally {
            submitBtn.disabled = false;
        }
    });
}



// ==================== Toast Manager ====================
function showToast(message, type) {
    const toastEl = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    toastMessage.textContent = message;
    toastEl.className = `toast align-items-center text-bg-${type} border-0`;
    new bootstrap.Toast(toastEl).show();
}


// ==================== Password Checker ====================
document.addEventListener("DOMContentLoaded", () => {
    const passwordInput = document.getElementById("passwordInput");
    const strengthBar = document.getElementById("passwordStrengthBar");
    const strengthText = document.getElementById("passwordStrengthText");
    const togglePassword = document.getElementById("togglePassword");

    const checks = {
        length: document.getElementById("checkLength"),
        number: document.getElementById("checkNumber"),
        upper: document.getElementById("checkUpper"),
        special: document.getElementById("checkSpecial")
    };

    // اگر هیچ‌کدام از المنت‌های اصلی موجود نبودند، ادامه نده
    if (!passwordInput || !strengthBar || !strengthText || !togglePassword) {
        return;
    }

    // ---------------- Toggle password visibility ----------------
    togglePassword.addEventListener("click", () => {
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";
        togglePassword.classList.toggle("bi-eye", !isPassword);
        togglePassword.classList.toggle("bi-eye-slash", isPassword);
    });

    // ---------------- Password strength checker ----------------
    passwordInput.addEventListener("input", () => {
        const val = passwordInput.value;
        const rules = validatePasswordRules(val);
        let score = 0;

        Object.keys(rules).forEach(key => {
            if (checks[key]) {
                checks[key].classList.toggle("text-success", rules[key]);
                checks[key].classList.toggle("text-danger", !rules[key]);
            }
            if (rules[key]) score++;
        });

        const strengths = ["خیلی ضعیف", "ضعیف", "متوسط", "خوب", "عالی"];
        const colors = ["#dc3545", "#fd7e14", "#ffc107", "#0d6efd", "#198754"];

        strengthBar.style.width = (score * 25) + "%";
        strengthBar.style.backgroundColor = colors[score];
        strengthText.textContent = val ? `قدرت رمز: ${strengths[score]}` : "";
    });
});

// ============================ File Checker in 'onchange' Event ============================
const profileImage = document.getElementById('profileImage');
if (profileImage) {
    profileImage.addEventListener('change', function () {
        fileChecker(this, {
            fileNameSelector: '#fileName',
            previewSelector: '#previewImage',
            errorSelector: '#fileError',
            allowedTypes: ['image/jpeg', 'image/png', 'image/gif'],
            maxSize: 2 * 1024 * 1024
        });
    });
}