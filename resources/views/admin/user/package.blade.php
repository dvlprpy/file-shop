@extends('layouts.admin')

@section('content')
    

    @if (session('success'))
        
        <div class="alert alert-success d-flex flex-row justify-content-between me-2 ms-2" role="alert">
            <div class="d-flex flex-row justify-content-center">
                <i class="bi bi-check-square-fill"></i>
                <p class="ms-2 me-2">
                    {{
                        session('success')
                    }}
                </p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif



    <div class="table-responsive">

        <table class="table table-striped table-hover table-striped caption-top">

            <caption class="text-center">لیست پکیج های کاربر</caption>

            <thead>
                <tr>
                <th scope="col">ردیف</th>
                <th scope="col">نام کاربر</th>
                <th scope="col">عنوان پکیج خریداری شده</th>
                <th scope="col">قیمت خریداری شده پکیج</th>
                <th scope="col">تاریخ خرید پکیج</th>
                <th scope="col">عملیات</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @if ($find_user_package && count($find_user_package) > 0)
                    @foreach ($find_user_package as $user_package)
                        
                            <tr>
                                <th scope="row">{{ $user_find->user_id }}</th>
                                <td>{{ $user_find->fullname }}</td>
                                <td>{{ $user_package->package_title }}</td>
                                <td>{{ number_format($user_package->pivot->amount) }}</td>
                                <td>{{ $user_package->pivot->created_at }}</td>
                                <td>
                                    {{-- User Package Delete Icon --}}
                                    <form action="{{ route('admin.user.package.delete', [$user_find->user_id, $user_package->package_id]) }}" 
                                        method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        style="border: none; background:none; cursor:pointer;">
                                            <i class="bi bi-trash text-danger fs-4"  
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                data-bs-title="حذف پکیج">
                                            </i>
                                        </button>
                                        
                                    </form>

                                    
                                </td>
                            </tr>
                            
                    @endforeach
                @else
                    @include('admin.user.no-item');
                @endif
            </tbody>

        </table>

    </div>

@endsection