    
    
    <div id="errorContainer">
            @include('admin.partials.errors')
    </div>

    
<div class="container mt-3" style="padding: 0;">
    <h4 class="file-heading-class mb-3">
        {{
            isset($get_plan) ? 'ویرایش طرح' : 'ایجاد طرح';
        }}
    </h4>
    <form action="{{ isset($get_plan) ? route('plan.update', $get_plan->plan_uuid) : route('plan.store')  }}" method="POST" novalidate>

        @csrf
        @if (isset($get_plan))
            @method('PUT')
        @endif


        {{-- plan_title --}}
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">عنوان طرح</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="plan_title" id="inputEmail3" placeholder="لطفا نام یا عنوان طرح را وارد کنید." value="{{ old('plan_title', isset($get_plan) ? $get_plan->plan_title : '') }}">
            </div>
        </div>

        {{-- plan_download_limit --}}
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">محدودیت تعداد دانلود</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="plan_download_limit" id="inputEmail3" placeholder="لطفا محدودیت تعداد دانلود را مشخص کنید." value="{{ old('plan_download_limit', isset($get_plan) ? $get_plan->plan_download_limit : '') }}">
            </div>
        </div>


        {{-- plan_price --}}
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">قیمت طرح</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="plan_price" id="inputEmail3" placeholder="لطفا قیمت طراح را وارد کنید." value="{{ old('plan_price', isset($get_plan) ? $get_plan->plan_price : '') }}">
            </div>
        </div>
        

        {{-- plan_day --}}
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">تعداد روزهای طرح</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="plan_day" id="inputEmail3" placeholder="لطفا تعداد روز طرح را وارد کنید." value="{{ old('plan_day', isset($get_plan) ? $get_plan->plan_day : '') }}">
            </div>
        </div>


        <button type="submit" class="btn btn-success w-25" style="display: block; margin: 5px auto;">
            {{
                isset($get_plan) ? 'ذخیره طرح' : 'ثبت طرح جدید';
            }}
        </button>

    
    </form>
</div>