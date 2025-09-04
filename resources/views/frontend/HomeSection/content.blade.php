{{-- نمایش لیست فایل ها --}}
<div class="table-responsive mt-5 mb-5">
    
    <table class="table table-striped table-hover caption-top">
        <caption class="text-center">لیست فایل ها</caption>
        <thead>
            <tr>
            <th scope="col">ردیف</th>
            <th scope="col">عنوان فایل</th>
            <th scope="col">توضیحات فایل</th>
            <th scope="col">نوع فایل</th>
            <th scope="col">عملیات</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @if ($file && count($file) > 0)
                
                @foreach ($file as $file)
                    <tr>
                        <td>{{ $file->file_id }}</td>
                        <td>{{ $file->file_title }}</td>
                        <td>{{ $file->file_description }}</td>
                        <td>
                            @switch($file->file_type)
                                @case('pdf')
                                    <i class="bi bi-filetype-pdf fs-3 text-danger"></i>
                                    @break

                                @case('doc')
                                    <i class="bi bi-filetype-doc fs-3 text-primary"></i>
                                    @break

                                @case('image/jpg')
                                @case('image/png')
                                @case('image/jpeg')
                                    <i class="bi bi-image fs-3 text-success"></i>
                                    @break

                                @default
                                    <i class="bi bi-file-earmark fs-3 text-secondary"></i>
                            @endswitch
                        </td>

                        <td>
                            <i class="bi bi-cloud-arrow-down-fill fs-3 text-primary cursor-pointer"></i>
                        </td>
                    </tr>
                @endforeach
            @else
                @include('frontend.no-item')
            @endif  
        </tbody>
    </table>

</div>


{{-- نمایش لیست پکیج ها --}}
<div class="table-responsive mb-5 mt-5">
    
    <table class="table table-striped table-hover caption-top">
        <caption class="text-center">لیست پکیج ها</caption>
        <thead>
            <tr>
            <th scope="col">ردیف</th>
            <th scope="col">عنوان پکیج</th>
            <th scope="col">توضیحات پکیج</th>
            <th scope="col">قیمت پکیح</th>
            <th scope="col">عملیات</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @if ($package && count($package) > 0)
                
                @foreach ($package as $package)
                    <tr>
                        <td>{{ $package->package_id  }}</td>
                        <td>{{ $package->package_title }}</td>
                        <td>{{ $package->package_description }}</td>
                        <td>{{ number_format($package->package_price) }}</td>

                        <td>
                            <i class="bi bi-cloud-arrow-down-fill fs-3 text-primary cursor-pointer"></i>
                        </td>
                    </tr>
                @endforeach
            @else
                @include('frontend.no-item')
            @endif  
        </tbody>
    </table>

</div>