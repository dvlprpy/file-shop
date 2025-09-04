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
            <caption class="text-center mt-5 mb-1">لیست دسته بندی ها</caption>
            <thead>
                <tr>
                    <th scope="col" class="text-center">ردیف</th>
                    <th scope="col" class="text-center">عنوان طرح</th>
                    <th scope="col" class="text-center">عملیات</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                
                @if ($category && count($category) > 0)
                    @foreach ($category as $categoryItem)
                        <tr>
                            <th scope="row" class="text-center">{{ $categoryItem->category_id  }}</th>
                            <td class="text-center">{{ $categoryItem->category_name }}</td>
                            <td class="text-center">

                                {{-- Edit --}}
                                <a href="{{ route('category.edit', $categoryItem->category_id) }}">
                                    <i class="bi bi-pencil-square fs-2 cursor-pointer text-warning" 
                                    data-bs-toggle="tooltip" 
                                    data-bs-placement="bottom" 
                                    data-bs-title="ویرایش دسته بندی"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('category.destroy', $categoryItem->category_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 bg-transparent">
                                        <i class="bi bi-trash fs-2 cursor-pointer text-danger"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-title="حذف دسته بندی"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.category.item')
                @endif
                
            </tbody>

        </table>
    </div>


@endsection