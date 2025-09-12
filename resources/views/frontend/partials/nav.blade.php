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
          <a class="nav-link" href="#">سبد خرید</a>
        </li>
      </ul>

      <!-- بخش راست -->
      <div class="d-flex">

        @guest
          <a class="btn btn-outline-success me-2 ms-2" href="{{ route('login.form') }}">ورود</a>
          <a class="btn btn-success" href="{{ route('register.form') }}">ثبت نام</a>
        @endguest

        @auth
          <div class="nav-item dropdown">
            <span class="nav-link dropdown-toggle cursor-pointer" data-bs-toggle="dropdown">
              <span>سلام، </span>
              <span class="text-primary">{{ auth()->user()->fullname }}</span>
              <span>خوش آمدید</span>
            </span>
            <div class="dropdown-menu">
              <span>
                <a href="{{ route('user.dashboard') }}" class="dropdown-item">داشبورد مدیریتی</a>
              </span>
              <hr class="dropdown-divider">
              <span class="d-flex flex-row justify-content-center align-items-center">
                <a class="btn btn-danger" href="{{ route('logout') }}">
                  خروج
                </a>
              </span>
            </div>
          </div>
        @endauth

      </div>
    </div>
  </div>
</nav>