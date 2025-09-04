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
            <caption class="text-center mt-5 mb-1">لیست پرداخت ها</caption>
            <thead>
                <tr>
                    <th scope="col" class="text-center">کاربر</th>
                    <th scope="col" class="text-center">مبلغ</th>
                    <th scope="col" class="text-center">روش پرداخت</th>
                    <th scope="col" class="text-center">نام بانک</th>
                    <th scope="col" class="text-center">شماره رزرو</th>
                    <th scope="col" class="text-center">شماره ارجاع</th>
                    <th scope="col" class="text-center">تاریخ پرداخت</th>
                    <th scope="col" class="text-center">وضعیت</th>
                    <th scope="col" class="text-center">عملیات</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                
                @if ($data && count($data) > 0)
                    @foreach ($data as $dataItem)
                        <tr>
                            <th scope="row" class="text-center">{{ $dataItem->user->fullname  }}</th>
                            <td class="text-center">{{ number_format($dataItem->payment_amount) }}</td>
                            <td class="text-center">{{ $dataItem->payment_method_format }}</td>
                            <td class="text-center">{{ $dataItem->payment_bank_name }}</td>
                            <td class="text-center">{{ $dataItem->payment_res_num }}</td>
                            <td class="text-center">{{ $dataItem->payment_ref_num }}</td>
                            <td class="text-center">{{ $dataItem->payment_created_at  }}</td>
                            <td class="text-center">{!! $dataItem->payment_status_icon !!}</td>
                            <td class="text-center">

                                {{-- Delete --}}
                                <form action="{{ route('payment.destroy', $dataItem->payment_id ) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 bg-transparent">
                                        <i class="bi bi-trash fs-2 cursor-pointer text-danger"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-title="حذف پرداخت"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                @else
                    @include('admin.payment.item')
                @endif
            </tbody>
        </table>
    </div>
@endsection