<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">پنل مدیریت کاربر</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex flex-row justify-content-center align-items-center">
        
        {{-- خانه --}}
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('frontend.user.dashboard.show') }}">خانه</a>
        </li>

        {{-- اطلاعات کاربری --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            اطلاعات کاربری
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('frontend.user.dashboard.info') }}">مشاهده اطلاعات کاریری</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('frontend.user.dashboard.edit') }}">ویرایش اطلاعات کاربری</a></li>
          </ul>
        </li>

        {{-- پلن ها --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            پلن ها
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('frontend.user.dashboard.plan') }}">مشاهده پلن های خریداری شده</a></li>
          </ul>
        </li>


        {{-- تیکت به پشتیبانی --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            پشتیبانی
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">ارتباط با پشتیبانی</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="dropdown">
      <button class="rounded-circle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="{{ auth()->user()->fullname }}" width="50" class='rounded-circle' height="50">
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item text-center" href="#">{{ auth()->user()->fullname }}</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('home') }}">صفحه اصلی وبسایت</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">
          <form action="{{ route('frontend.logout') }}" method="post">
            @csrf 
            <button class='btn btn-outline-danger'>خروج از حساب کاربری</button> 
          </form>  
        </a></li>
      </ul>
    </div>
  </div>
</nav>