<nav class="navbar navbar-expand-lg bg-body-tertiary" style="height: 10vh">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">پنل مدیریت</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav flex-grow-1">

        {{-- خانه --}}
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard.index')  }}">خانه</a>
        </li>

        {{-- کاربران --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            کاربران
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('admin.user.create')}}">ثبت کاربر جدید</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('admin.user.list') }}">لیست کاربران</a></li>
          </ul>
        </li>

        {{-- طرح ها --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            طرح ها
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('plan.create')}}">افزودن طرح جدید</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('plan.index') }}">لیست طرح ها</a></li>
          </ul>
        </li>
        
        {{-- فایل ها --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            فایل ها
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('file.create') }}">افزودن فایل جدید</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('file.index') }}">لیست فایل ها</a></li>
          </ul>
        </li>
        
        {{-- پکیج --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            پکیج ها
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('package.create') }}">افزودن پکیج جدید</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('package.index') }}">لیست پکیج ها</a></li>
          </ul>
        </li>

        {{-- پرداخت ها --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            پرداخت ها
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('payment.index') }}">لیست پرداخت ها</a></li>
          </ul>
        </li>

        {{-- دسته بندی ها --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            دسته بندی ها
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('category.create') }}">افزودن دسته بندی جدید</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('category.index') }}">لیست دسته بندی ها</a></li>
          </ul>
        </li>

      </ul>

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
  </div>
</nav>