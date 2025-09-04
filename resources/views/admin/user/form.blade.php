<div class="container-fluid d-flex flex-column mt-3 w-100 h-100">

    <div id="errorContainer">
        @include('admin.partials.errors')
    </div>

    <div class="card customized-card w-100" dir="rtl">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                {{ isset($user_item) ? 'ویرایش کاربر' : 'ایجاد کاربر جدید' }}
            </h5>
        </div>
        <div class="card-body customized-card-body">
            <form id="userForm" 
                action="{{ isset($user_item) ? route('admin.user.update', $user_item->user_id) : route('admin.user.store') }}" 
                method="POST" 
                enctype="multipart/form-data" 
                novalidate>
                
                @csrf
                @if(isset($user_item))
                    @method('PUT')
                @endif

                <!-- نام و نام خانوادگی -->
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" name="fullname" class="form-control" placeholder="نام و نام خانوادگی" required 
                               value="{{ old('fullname', isset($user_item)? $user_item->fullname : '') }}">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                              data-bs-title="لطفا نام و نام خانوادگی خود را وارد کنید. توجه داشته باشید که نام شما نباید بیشتر از 100 کاراکتر باشد.">
                            <i class="bi bi-person-circle"></i>
                        </span>
                    </div>
                    <div class="invalid-fullname invalid-feedback">
                        <i class="bi bi-exclamation-triangle fw-bold"></i> لطفاً نام و نام خانوادگی خود را وارد کنید.
                    </div>
                </div>

                <!-- نام کاربری -->
                <div class="mb-3">
                    <div class="input-group">
                        <input type="text" name="username" class="form-control" placeholder="نام کاربری" required 
                               value="{{ old('username', isset($user_item)? $user_item->username : '') }}">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                              data-bs-title="نام کاربری خود را وارد کنید. توجه داشته باشید که نام کاربری نباید بیشتر از 50 کاراکتر باشد و باید شامل فقط عدد و حروف انگلیسی باشد.">
                            <i class="bi bi-person-add"></i>
                        </span>
                    </div>
                    <div class="invalid-username invalid-feedback">
                        <i class="bi bi-exclamation-triangle fw-bold"></i> لطفاً نام کاربری را وارد کنید.
                    </div>
                </div>

                <!-- رمز عبور -->
                <div class="mb-3" dir="rtl">
                    <label for="passwordInput" class="form-label"></label>
                    <div class="input-group flex-row-reverse">
                        <div class="position-relative flex-grow-1">
                            {{-- برای اینکه فیلد پسورد در حالت ادیت وارد کردن آن اجباری نباشد از این روش استفاده میکنیم --}}
                            <input type="password" id="passwordInput" class="form-control" placeholder="رمز عبور" name="password" @if(!isset($user_item)) required @endif>
                            <i id="togglePassword"
                               class="bi bi-eye position-absolute top-50 start-0 translate-middle-y ms-3"
                               style="cursor: pointer;"></i>
                        </div>
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                              data-bs-title="رمز عبور خود را وارد کنید توجه داشته باشید که رمز عبور باید شامل حداقل 8 کاراکتر و حداکثر 15 کاراکتر باشد و باید شامل عدد، حروف انگلیسی کوچک و بزرگ، علامت های خاص باشد.">
                            <i class="bi bi-person-lock"></i>
                        </span>
                    </div>

                    <div class="invalid-password invalid-feedback">
                        <i class="bi bi-exclamation-triangle fw-bold"></i> رمز عبور باید حداقل 6 کاراکتر و شامل موارد زیر باشد.
                    </div>

                    <!-- نوار قدرت رمز -->
                    <div class="mt-2">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" id="passwordStrengthBar" role="progressbar" style="width: 0;"></div>
                        </div>
                        <small id="passwordStrengthText" class="text-muted"></small>
                    </div>

                    <!-- چک‌لیست قدرت رمز -->
                    <ul class="list-unstyled small mt-2" id="passwordChecklist">
                        <li id="checkLength" class="text-danger">حداقل ۸ کاراکتر</li>
                        <li id="checkNumber" class="text-danger">شامل عدد</li>
                        <li id="checkUpper" class="text-danger">شامل حرف بزرگ</li>
                        <li id="checkSpecial" class="text-danger">شامل کاراکتر خاص (!@#$...)</li>
                    </ul>
                </div>

                <!-- شماره تلفن -->
                <div class="mb-3">
                    <div class="input-group">
                        <input type="tel" name="phone" class="form-control" placeholder="شماره تلفن" pattern="^09[0-9]{9}$" required 
                               value="{{ old('phone', isset($user_item)? $user_item->phone : '') }}">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                              data-bs-title="شماره تلفن خود را وارد کنید">
                            <i class="bi bi-telephone"></i>
                        </span>
                    </div>
                    <div class="invalid-phone invalid-feedback">
                        <i class="bi bi-exclamation-triangle fw-bold"></i> شماره معتبر وارد کنید.
                    </div>
                </div>

                <!-- ایمیل -->
                <div class="mb-3">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="ایمیل" required 
                               value="{{ old('email', isset($user_item)? $user_item->email : '') }}">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                              data-bs-title="آدرس ایمیل خود را وارد کنید">
                            <i class="bi bi-envelope-at-fill"></i>
                        </span>
                    </div>
                    <div class="invalid-email invalid-feedback">
                        <i class="bi bi-exclamation-triangle fw-bold"></i> ایمیل معتبر وارد کنید.
                    </div>
                </div>

                {{-- کیف پول --}}
                <div class="mb-3">
                    <div class="input-group flex-row-reverse">
                        <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" 
                              data-bs-title="موجودی کیف پول خود / کاربر را وارد کنید.">
                              <i class="bi bi-wallet2"></i>
                        </span>
                        <input type="text" class="form-control" 
                               value="{{ old('wallet', isset($user_item)? $user_item->wallet : 0.0) }}" 
                               aria-label="Amount (to the nearest dollar)" name="wallet" >
                    </div>
                </div>

                {{-- نقش --}}
                <div class="mb-3">
                    <div class="input-group flex-row-reverse">
                        <select class="form-select" id="inputGroupSelect01" name="role">
                            <option value="normaluser" {{ isset($user_item) && $user_item->role == 'normaluser' ? 'selected' :  '' }}>کاربر عادی</option>
                            <option value="seller" {{ isset($user_item) && $user_item->role == 'seller' ? 'selected' :  '' }}>فروشنده</option>
                            <option value="adminsystem" {{ isset($user_item) && $user_item->role == 'adminsystem' ? 'selected' :  '' }}>مدیر سیستم</option>
                        </select>
                        <label class="input-group-text" for="inputGroupSelect01" 
                               data-bs-toggle="tooltip" data-bs-placement="top" 
                               data-bs-title="نقش خود / کاربر را وارد کنید.">نقش</label>
                    </div>
                </div>

                <!-- عکس پروفایل -->
                <div class="mb-3">
                    <label for="profileImage" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-upload"></i> انتخاب عکس پروفایل
                    </label>
                    <input type="file" 
                           data-mode="{{ isset($user_item) ? 'edit' : 'create' }}" 
                           name="profile_picture" accept="image/*" 
                           id="profileImage" class="d-none"  @if(!isset($user_item)) required @endif>
                    <div class="text-muted small" id="fileName">هیچ فایلی انتخاب نشده</div>
                    <div class="invalid-feedback" id="fileError" style="display: block;">
                        لطفاً یک تصویر انتخاب کنید.
                    </div>
                </div>

                {{-- پیش نمایش تصویر پروفایل --}}
                <div class="d-flex flex-row justify-content-center align-items-center text-center">

                    <img 
                        src="{{ isset($user_item) && $user_item->profile_picture 
                                ? asset('storage/' . $user_item->profile_picture) 
                                : asset('storage/images/default-avatar.svg') }}" 
                        id="previewImage"
                        alt="پیش‌نمایش تصویر"
                        style="max-width:250px; max-height:250px; border-radius:10px; object-fit:cover; border:2px solid #ddd; margin:10px auto; {{ isset($user_item) && $user_item->profile_picture ? 'display:block;' : 'display:none;' }}"
                        {{-- class="preview-img {{ isset($user_item) && $user_item->profile_picture ? 'd-block' : 'd-none' }}" --}}
                        />

                </div>

                <!-- دکمه ایجاد/ویرایش -->
                <button type="submit" class="btn btn-success bg-sky-500 w-100 mt-3">
                    {{ isset($user_item) ? 'ویرایش کاربر' : 'ایجاد کاربر' }}
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div id="toast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            {{-- متن اولیه حذف شد --}}
            <div class="toast-body" id="toastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>