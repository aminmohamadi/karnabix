

<div class="container">
    <form wire:submit.prevent="store()" class="row pt-40px">
        <div class="input-box col-lg-6">
            <label class="label-text">کد کاربر مورد نظر</label>

            <div class="form-group">

                <input class="form-control form--control" type="text" name="ref"
                       wire:model.defer="ref"/>
                <span class="la la-city input-icon"></span>
                @error('ref')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>
        <div class="input-box col-lg-6">
            <label class="label-text">مبلغ (تومان)</label>

            <div class="form-group">

                <input class="form-control form--control" type="text" name="amount"
                       wire:model.defer="amount"/>
                <span class="la la-city input-icon"></span>
                @error('amount')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="input-box col-lg-12 py-2">
            <button type="submit" class="btn btn-outline-success">انتقال</button>
        </div>
    </form>
</div>
