@extends('layouts.admin')

@section('content')
    
    @if (session('success'))
        <div class="alert alert-success d-flex flex-row justify-content-between" role="alert">
            <div class="d-flex flex-row justify-content-between">
                <i class="bi bi-check-circle-fill me-2 ms-2"></i>
                <p class="">{{ session('success') }}</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <div class="table-responsive ms-4 me-4">
        <table class="table table-striped table-hover caption-top">
            <caption class="text-center mt-5 mb-1">لیست پکیج ها</caption>
            <thead>
                <tr>
                    <th scope="col" class="text-center">ردیف</th>
                    <th scope="col" class="text-center">عنوان پکیج</th>
                    <th scope="col" class="text-center">توضیحات پکیج</th>
                    <th scope="col" class="text-center">قیمت پکیج</th>
                    <th scope="col" class="text-center">شناسه پکیج</th>
                    <th scope="col" class="text-center">تعداد فایل ها</th>
                    <th scope="col" class="text-center">دسته بندی پکیج ها</th>
                    <th scope="col" class="text-center">عملیات</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                
                @if ($data && count($data) > 0)
                    @foreach ($data as $dataItem)
                        <tr>
                            <th scope="row" class="text-center">{{ $dataItem->package_id   }}</th>
                            <td class="text-center">{{ $dataItem->package_title }}</td>
                            <td class="text-center">{{ $dataItem->package_description }}</td>
                            <td class="text-center">{{ $dataItem->package_price }}</td>
                            <td class="text-center">{{ $dataItem->package_uuid }}</td>
                            <td class="text-center">{{ $dataItem->files()->get()->count() }}</td>
                            <td class="text-center">
                                @if ($dataItem->categories->isEmpty())
                                    <span class="badge bg-secondary">بدون دسته بندی</span>
                                @else
                                    @foreach ($dataItem->categories as $cat)
                                        <span class="badge bg-success">{{ $cat->category_name }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center">

                                {{-- Edit --}}
                                <a href="{{ route('package.edit', $dataItem->package_id) }}">
                                    <i class="bi bi-pencil-square fs-2 cursor-pointer text-warning" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="bottom" 
                                    data-bs-title="ویرایش پکیج"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('package.destroy', $dataItem->package_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 bg-transparent">
                                        <i class="bi bi-trash fs-2 cursor-pointer text-danger"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-title="حذف پکیج"></i>
                                    </button>
                                </form>

                                {{-- Select File --}}
                                <a href="{{ route('package.editSyncFile', $dataItem->package_id) }}">
                                    <i class="bi bi-file-earmark-check fs-2 cursor-pointer text-success" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="bottom" 
                                    data-bs-title="انتخاب فایل"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.package.item')
                @endif
            </tbody>
        </table>
    </div>
@endsection