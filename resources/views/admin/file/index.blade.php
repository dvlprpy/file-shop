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
            <caption class="text-center mt-5 mb-1">لیست فایل ها</caption>
            <thead>
                <tr>
                    <th scope="col">ردیف</th>
                    <th scope="col">عنوان فایل</th>
                    <th scope="col" class="text-center">توضیحات فایل</th>
                    <th scope="col">نوع فایل</th>
                    <th scope="col">شناسه فایل</th>
                    <th scope="col">دسته بندی فایل</th>
                    <th scope="col">عملیات</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @foreach ($data as $dataItem)
                    <tr>
                        <th scope="row">{{ $dataItem->file_id }}</th>
                        <td>{{ $dataItem->file_title }}</td>
                        <td>{{ $dataItem->file_description }}</td>
                        <td>{{ $dataItem->file_type }}</td>
                        <td>{{ $dataItem->file_hash }}</td>
                        <td>
                            @if($dataItem->categories->isEmpty())
                                <span class="badge bg-secondary">بدون دسته‌بندی</span>
                            @else
                                @foreach($dataItem->categories as $category)
                                    <span class="badge bg-primary me-1">{{ $category->category_name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>

                            {{-- Edit --}}
                            <a href="{{ route('file.edit', $dataItem->file_id) }}">
                                <i class="bi bi-pencil-square fs-2 cursor-pointer text-warning" 
                                data-bs-toggle="tooltip" 
                                data-bs-placement="bottom" 
                                data-bs-title="ویرایش فایل"></i>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('file.destroy', $dataItem->file_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn p-0 border-0 bg-transparent">
                                    <i class="bi bi-trash fs-2 cursor-pointer text-danger"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    data-bs-title="حذف فایل"></i>
                                </button>
                            </form>


                            {{-- Download --}}
                            <a href="{{ route('file.download', $dataItem->file_id) }}">
                                <i class="bi bi-cloud-arrow-down fs-2 cursor-pointer text-success"
                                data-bs-toggle="tooltip" 
                                data-bs-placement="bottom" 
                                data-bs-title="دانلود فایل"></i>
                            </a>

                            {{-- View --}}
                            <a href="{{ route('file.view', $dataItem->file_id) }}">
                                <i class="bi bi-file-pdf fs-2 cursor-pointer text-primary"
                                data-bs-toggle="tooltip" 
                                data-bs-placement="bottom" 
                                data-bs-title="باز کردن فایل"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
                
            </tbody>

        </table>
    </div>


@endsection