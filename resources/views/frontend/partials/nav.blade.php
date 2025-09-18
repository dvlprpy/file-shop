<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">فایل شاپ</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- منو وسط -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-grow-1 justify-content-center">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('home') }}">خانه</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('frontend.plan.buy') }}">مشاهده پلن ها</a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" href="{{ route('frontend.aboutus') }}">درباره ما</a>
        </li>
      </ul>

      <!-- بخش راست -->
      <div class="d-flex">

        @guest
          <a class="btn btn-outline-success me-2 ms-2" href="{{ route('frontend.login.form') }}">ورود</a>
          <a class="btn btn-success" href="{{ route('frontend.register.form') }}">ثبت نام</a>
        @endguest

        @auth
          <div class="nav-item dropdown">
            <span class="nav-link dropdown-toggle cursor-pointer" data-bs-toggle="dropdown">
              <span>سلام، </span>
              <span class="text-primary">{{ auth()->user()->fullname }}</span>
              <span>خوش آمدید</span>
            </span>
            <div class="dropdown-menu">
              @if (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role === 'adminsystem')
                <span>
                  <a href="{{ route('admin.dashboard.index') }}" class="dropdown-item">ورود به داشبورد مدیریتی</a>
                </span>
              @else
                <span>
                  <a href="{{ route('frontend.user.dashboard.show') }}" class="dropdown-item">ورود به داشبورد کاربر</a>
                </span>
              @endif
              <hr class="dropdown-divider">
              <form action="{{ route('frontend.logout') }}" method="POST" class="d-flex justify-content-center">
                @csrf
                <button type="submit" class="btn btn-danger w-100">خروج</button>
              </form>
            </div>
          </div>
        @endauth

      </div>
    </div>
  </div>
</nav>