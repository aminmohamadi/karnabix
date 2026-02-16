<div class="container-fluid">

    @if($this->user->teacher()->first() != null)
        <p class="alert alert-warning"><b class="text-danger">توجه</b> : کاربر گرامی شما قبلا این درخواست را ثبت کرده اید.
            <a class="btn-link" href="{{route('user.requests')}}">بازگشت</a>
        </p>
    @else
        <form wire:submit.prevent="storeDetails()" class="row pt-40px">
            <fieldset class="row col-12 border p-4">
                <legend class="float-none w-auto">سایر اطلاعات :</legend>
                <div class="input-box col-lg-6">
                    <label class="label-text">عنوان درخواست </label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text"
                               wire:model.defer="sub_title"/>
                        <span class="la la-id-card input-icon"></span>
                        @error('sub_title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="input-box col-lg-6">
                    <label class="label-text">شرح </label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text"
                               wire:model.defer="body"/>
                        <span class="la la-id-card input-icon"></span>
                        @error('body')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="input-box col-lg-12 py-2">
                    <button type="submit" class="btn btn-outline-success">ذخیره تغییرات</button>
                </div>
            </fieldset>

            <!-- end input-box -->
        </form>

    @endif
</div>
