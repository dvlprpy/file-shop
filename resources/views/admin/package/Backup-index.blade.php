@extends('layouts.admin')

@section('content')

    {{-- نمایش پیام موفقیت --}}
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
                    <th scope="col" class="text-center">فایل‌ها</th>
                    <th scope="col" class="text-center">عملیات</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">
                @if ($data && count($data) > 0)
                    @foreach ($data as $dataItem)
                        <tr>
                            {{-- اطلاعات پکیج --}}
                            <th scope="row" class="text-center">{{ $dataItem->package_id }}</th>
                            <td class="text-center">{{ $dataItem->package_title }}</td>
                            <td class="text-center">{{ $dataItem->package_description }}</td>
                            <td class="text-center">{{ $dataItem->package_price }}</td>
                            <td class="text-center">{{ $dataItem->package_uuid }}</td>

                            {{-- ستون فایل‌ها --}}
                            <td class="text-center">
                                {{-- تعداد فایل‌های مرتبط --}}
                                <span class="badge bg-primary">{{ $dataItem->files->count() }} فایل</span>

                                {{-- دکمه باز کردن Modal --}}
                                <button type="button" class="btn btn-sm btn-info ms-2" data-bs-toggle="modal"
                                    data-bs-target="#filesModal{{ $dataItem->package_id }}">
                                    جزئیات
                                </button>

                                {{-- Modal نمایش فایل‌ها --}}
                                <div class="modal fade" id="filesModal{{ $dataItem->package_id }}" tabindex="-1"
                                    aria-labelledby="filesModalLabel{{ $dataItem->package_id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            {{-- هدر Modal --}}
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="filesModalLabel{{ $dataItem->package_id }}">
                                                    فایل‌های پکیج: {{ $dataItem->package_title }}</h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            {{-- بدنه Modal --}}
                                            <div class="modal-body">

                                                @if ($dataItem->files->count() > 0)
                                                    {{-- فیلتر بر اساس visibility --}}

                                                    <div class="mb-3 d-flex gap-2 align-items-center">
                                                        <label>فیلتر نوع فایل:</label>
                                                        <select id="visibilityFilter{{ $dataItem->package_id }}"
                                                            class="form-select w-auto">
                                                            <option value="all">همه</option>
                                                            <option value="private">خصوصی</option>
                                                            <option value="public">عمومی</option>
                                                        </select>
                                                    </div>

                                                    {{-- جستجوی فایل --}}
                                                    <input type="text" class="form-control mb-3"
                                                        id="fileSearch{{ $dataItem->package_id }}"
                                                        placeholder="جستجو در فایل‌ها...">

                                                    {{-- نمایش کارت‌ها --}}
                                                    <div class="row g-3" id="filesContainer{{ $dataItem->package_id }}">
                                                        @php
                                                            $perPage = 6; // تعداد فایل در هر صفحه
                                                            $totalFiles = $dataItem->files->count();
                                                            $pages = ceil($totalFiles / $perPage);
                                                        @endphp
                                                        @foreach ($dataItem->files->chunk($perPage) as $pageIndex => $filesChunk)
                                                            <div class="file-page" data-page="{{ $pageIndex + 1 }}"
                                                                style="{{ $pageIndex > 0 ? 'display:none' : '' }}">
                                                                @foreach ($filesChunk as $file)
                                                                    <div class="col-md-6 col-lg-4 file-card mb-3"
                                                                        data-visibility="{{ $file->visibility }}">
                                                                        <div
                                                                            class="card h-100 shadow-sm @if ($file->visibility === 'private') border-danger @else border-success @endif">
                                                                            <div class="card-body d-flex flex-column">
                                                                                <h6 class="card-title file-title">
                                                                                    {{ $file->file_title }}</h6>
                                                                                <p class="card-text mb-1">
                                                                                    <strong>نوع:</strong>
                                                                                    <span
                                                                                        class="badge @if ($file->visibility === 'private') bg-danger @else bg-success @endif">
                                                                                        {{ $file->visibility }}
                                                                                    </span>
                                                                                </p>
                                                                                <p class="card-text mb-1">
                                                                                    <strong>حجم:</strong>
                                                                                    {{ number_format($file->file_size / 1024, 2) }}
                                                                                    KB
                                                                                </p>
                                                                                <a href="{{ route('file.download', $file->file_id) }}"
                                                                                    class="btn btn-sm btn-primary mt-auto">دانلود</a>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    {{-- Pagination --}}
                                                    @if ($pages > 1)
                                                        <nav>
                                                            <ul class="pagination justify-content-center mt-3"
                                                                id="pagination{{ $dataItem->package_id }}">
                                                                @for ($i = 1; $i <= $pages; $i++)
                                                                    <li class="page-item {{ $i === 1 ? 'active' : '' }}"><a
                                                                            class="page-link" href="#"
                                                                            data-page="{{ $i }}">{{ $i }}</a>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        </nav>
                                                    @endif

                                                    {{-- Script مدیریت جستجو، فیلتر و Pagination --}}
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const searchInput = document.getElementById('fileSearch{{ $dataItem->package_id }}');
                                                            const visibilitySelect = document.getElementById('visibilityFilter{{ $dataItem->package_id }}');
                                                            const container = document.getElementById('filesContainer{{ $dataItem->package_id }}');
                                                            const pages = container.querySelectorAll('.file-page');
                                                            const pagination = document.getElementById('pagination{{ $dataItem->package_id }}');

                                                            // جستجوی زنده
                                                            if (searchInput && container) {
                                                                searchInput.addEventListener('keyup', function() {
                                                                    const query = this.value.toLowerCase();
                                                                    container.querySelectorAll('.file-card').forEach(function(card) {
                                                                        const title = card.querySelector('.file-title').textContent.toLowerCase();
                                                                        card.style.display = title.includes(query) ? '' : 'none';
                                                                    });
                                                                });
                                                            }

                                                            // فیلتر visibility
                                                            if (visibilitySelect && container) {
                                                                visibilitySelect.addEventListener('change', function() {
                                                                    const filter = this.value;
                                                                    container.querySelectorAll('.file-card').forEach(card => {
                                                                        if (filter === 'all' || card.dataset.visibility === filter) {

                                                                            card.style.display = '';
                                                                        } else {
                                                                            card.style.display = 'none';
                                                                        }
                                                                    });
                                                                });
                                                            }

                                                            // Pagination
                                                            if (pagination) {
                                                                pagination.querySelectorAll('.page-link').forEach(link => {
                                                                    link.addEventListener('click', function(e) {
                                                                        e.preventDefault();
                                                                        const page = parseInt(this.getAttribute('data-page'));
                                                                        pages.forEach(p => p.style.display = 'none');
                                                                        const target = container.querySelector('.file-page[data-page="' + page +
                                                                            '"]');
                                                                        if (target) target.style.display = '';
                                                                        pagination.querySelectorAll('.page-item').forEach(item => item.classList
                                                                            .remove('active'));
                                                                        this.parentElement.classList.add('active');
                                                                    });
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                @else
                                                    <p class="text-center">هیچ فایلی به این پکیج متصل نشده است.</p>
                                                @endif

                                            </div>

                                            {{-- Footer Modal --}}
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>

                            {{-- ستون عملیات --}}
                            <td class="text-center">
                                <a href="{{ route('package.edit', $dataItem->package_id) }}">
                                    <i class="bi bi-pencil-square fs-2 cursor-pointer text-warning" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" data-bs-title="ویرایش پکیج"></i>
                                </a>

                                <form action="{{ route('package.destroy', $dataItem->package_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0 border-0 bg-transparent">
                                        <i class="bi bi-trash fs-2 cursor-pointer text-danger" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="حذف پکیج"></i>
                                    </button>
                                </form>

                                <a href="{{ route('package.editSyncFile', $dataItem->package_id) }}">
                                    <i class="bi bi-file-earmark-check fs-2 cursor-pointer text-success"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
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