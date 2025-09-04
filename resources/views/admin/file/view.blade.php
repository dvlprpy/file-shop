<div class="" style="display: flex; flex-direction: column; justify-content:space-between; align-items:center;height:100%;">

    <h1 class="mt-3 mb-3 text-primary" 
        style="direction: rtl;
            text-align: center; 
            margin-top:5px;
            margin-bottom: 3px
            ">{{ $file->file_title }}</h1>
    {{-- {{
        dd($file)
    }} --}}
    <img src="{{ route('access.file', $file->file_id) }}" alt="{{ $file->file_original_name }}" style="max-width: 80vw;max-height: 80vh;">


    <a href="{{ route('file.index') }}">بازگشت به لیست فایل ها</a>

</div>