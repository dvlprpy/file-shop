@extends('layouts.admin')

@section('content')

    @include('admin.user.operation')
    
    <div class="table-container position-relative">

        <div class="table-responsive-xl mt-3 mb-5">

            <table class="table table-striped table-hover caption-top manage-table-responsive-scroll">
                <caption class="caption-top" style="width: 55vw;">لیست کاربران</caption>
            
                <thead class="table-dark">

                    <tr>
                        <th scope="col">ردیف</th> {{-- row --}}
                        <th scope="col">نام و نام خانوادگی</th> {{-- fullname --}}
                        <th scope="col">نام کاربری</th>{{-- username --}}
                        <th scope="col">ایمیل</th>{{-- email --}}
                        <th scope="col">تلفن همراه</th>{{-- phone --}}
                        <th scope="col">موجودی کیف پول</th>{{-- wallet --}}
                        <th scope="col">نقش</th>{{-- rol --}}
                        <th scope="col">تصویر پروفایل</th>{{-- profile picture --}}
                        <th scope="col">تاریخ ثبت نام</th>{{-- created_at --}}
                        <th scope="col">تاریخ بروزرسانی</th>{{-- update_at --}}
                        <th data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="تعداد پکیج های خریداری شده توسط هر کاربر" scope="col">پکیج ها</th>{{-- pivot_user_package --}}
                        <th scope="col">عملیات</th> {{-- operation --}}
                    </tr>

                </thead>

                <tbody>
                    @if ($user && count($user) > 0)
                        
                        @foreach ($user as $userItem)

                            <tr class="horizontal-vertical-align">
                                <th scope="row">{{$userItem->user_id}}</th> {{-- row --}}
                                <td>{{$userItem->fullname}}</td>{{-- fullname --}}
                                <td>{{$userItem->username}}</td>{{-- username --}}
                                <td>{{$userItem->email}}</td>{{-- email --}}
                                <td>{{$userItem->phone}}</td>{{-- phone --}}
                                <td>{{$userItem->wallet}}</td>{{-- wallet --}}
                                <td>{{$userItem->role}}</td>{{-- rol --}}
                                <td>
                                    <img src="{{ asset('storage/' . $userItem->profile_picture) }}" 
                                    alt="Profile Picture" 
                                    class="table-profile-img"
                                    data-bs-toggle="tooltip"
                                    title="{{ $userItem->fullname }}" />
                                </td>{{-- Profile Picture --}}
                                <td>{{$userItem->created_at}}</td>{{-- created_at --}}
                                <td>{{$userItem->updated_at}}</td> {{-- update_at --}}
                                <td>{{$userItem->packages()->count()}}</td> {{-- pibot_User_package --}}
                                <td> 
                                    <div class="me-auto d-flex flex-row align-items-center gap-2"> 

                                        {{-- Edit Icon --}}
                                        <a href="{{ route('admin.user.edit', $userItem->user_id ) }}">
                                            <i class="bi bi-pencil-square text-warning cursor-pointer fs-4 fw-bolder"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            data-bs-title="ویرایش اطلاعات کاربر"></i>
                                        </a>

                                        {{-- Delete Icon --}}
                                        <a href="{{ route('admin.user.delete', $userItem->user_id ) }}">
                                            <i class="bi bi-trash text-danger cursor-pointer fs-4 fw-bolder"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            data-bs-title="حذف کاربر"></i>
                                        </a>

                                        {{-- Package List Icon --}}
                                        <a href="{{ route('admin.user.package', $userItem->user_id ) }}">
                                            <i class="bi bi-boxes text-primary cursor-pointer fs-4 fw-bolder"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            data-bs-title="لیست پکیج های کاربر"></i>
                                        </a>

                                        {{-- Package File List --}}
                                        <a href="{{ route('admin.user.selectPackage', $userItem->user_id) }}">
                                            <i class="bi bi-archive fs-4 cursor-pointer text-info"
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                data-bs-title="مشاهده لیست پکیج ها و انتخاب آن"></i>
                                        </a>

                                        <div class="dropup-center dropup">
                                            <!-- آیکون یوزر که مودال رو باز می‌کنه -->
                                            <i class="bi bi-person-up text-success cursor-pointer fs-4 fw-bolder"
                                                role="button" data-bs-toggle="modal" data-bs-placement="top"
                                                data-bs-title="تغییر نقش کاربر" data-bs-toggle="tooltip"
                                                data-bs-target="#roleModal">
                                            </i>

                                            <!-- Modal تغییر نقش -->
                                            <div class="modal fade" id="roleModal" tabindex="-1"
                                                aria-labelledby="roleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <!-- هدر مودال -->
                                                        <div
                                                            class="modal-header d-flex justify-content-between align-items-center">
                                                            <h5 class="modal-title" id="roleModalLabel">تغییر نقش کاربر</h5>
                                                            <button type="button" class="btn-close ms-0"
                                                                data-bs-dismiss="modal" aria-label="بستن"></button>
                                                        </div>

                                                        <!-- بدنه مودال -->
                                                        <div class="modal-body">
                                                            <p>لطفاً نقش جدید را انتخاب کنید:</p>
                                                            <div class="list-group">
                                                                <button type="button"
                                                                    class="list-group-item list-group-item-action">
                                                                    <i class="bi bi-person"></i> کاربر عادی
                                                                </button>
                                                                <button type="button"
                                                                    class="list-group-item list-group-item-action">
                                                                    <i class="bi bi-shop"></i> فروشنده
                                                                </button>
                                                                <button type="button"
                                                                    class="list-group-item list-group-item-action text-danger">
                                                                    <i class="bi bi-shield-lock"></i> مدیر سیستم
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <!-- فوتر مودال -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">انصراف</button>
                                                            <button type="button" class="btn btn-primary">تأیید</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td> {{-- Operation --}}
                            </tr>

                        @endforeach

                    @endif

                </tbody>
            </table>

        </div>

        <i class="bi bi-arrow-left-square-fill scroll-btn left"></i>
        <i class="bi bi-arrow-right-square-fill scroll-btn right"></i>

    </div>

@endsection
