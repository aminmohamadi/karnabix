<div class="container">
    <form wire:submit.prevent="store()" class="row pt-40px">
        <fieldset class="row col-12 border p-4">
            <legend class="float-none w-auto">اطلاعات آگهی :</legend>
            <div class="input-box col-lg-4">
                <label class="label-text">عنوان آگهی</label>

                <div class="form-group">

                    <input class="form-control form--control" type="text" name="title"
                           wire:model.defer="title"/>
                    <span class="la la-city input-icon"></span>
                    @error('title')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">نام شرکت</label>
                <div class="form-group">
                    <input class="form-control form--control" type="text" name="company"
                           wire:model.defer="company"/>
                    <span class="la la-user input-icon"></span>
                    @error('company')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4 ">
                <label class="label-text">عنوان شغلی</label>
                <div class="form-group">
                    <input id="birthday" class="form-control form--control" wire:model.defer="job" name="job">
                    <span class="la la-calendar-day input-icon"></span>
                    @error('job')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="input-box col-lg-4">
                <label class="label-text">دسته بندی</label>

                <div class="form-group">

                    <select class="form-control form--control" name="category" wire:model.defer="category"
                            id="categories">
                        <option value="">انتخاب کنید</option>
                        @foreach(config('jobs.jobs.categories') as $key=> $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach

                    </select>
                    <span class="la la-city input-icon"></span>
                    @error('categories')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">استان</label>
                <div class="form-group">
                    <select class="form-control form--control" name="province" wire:model="province"
                            id="province">
                        <option value="">انتخاب کنید</option>
                        @foreach($data['province'] as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                    <span class="la la-city input-icon"></span>
                    @error('province')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">شهر</label>
                <div class="form-group">
                    <select class="form-control form--control" name="city" wire:model.defer="city"
                            id="city">
                        <option value="">انتخاب کنید</option>
                        @foreach($data['city'] as $key => $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                    <span class="la la-city input-icon"></span>
                    @error('city')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">نوع کار</label>
                <div class="form-group">
                    <select class="form-control form--control" name="job_type" wire:model.defer="job_type"
                            id="city">
                        <option value="">انتخاب کنید</option>
                        @foreach(config('jobs.jobs.types') as $key=> $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach

                    </select>
                    <span class="la la-city input-icon"></span>
                    @error('job_type')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">نوع حضور</label>
                <div class="form-group">
                    <select class="form-control form--control" name="resume" wire:model.defer="remote"
                            id="city">
                        <option value="">انتخاب کنید</option>
                        @foreach(config('jobs.jobs.remote') as $key=> $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">بیمه</label>
                <div class="form-group">
                    <select class="form-control form--control" name="insurance" wire:model.defer="insurance"
                            id="city">
                        <option value="">انتخاب کنید</option>
                        @foreach(config('jobs.jobs.insurance') as $key=> $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach

                    </select>
                    <span class="la la-city input-icon"></span>
                    @error('insurance')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">وضعیت خدمت</label>
                <div class="form-group">
                    <select class="form-control form--control" name="soldier" wire:model.defer="soldier"
                            id="city">
                        <option value="">انتخاب کنید</option>
                        @foreach(config('jobs.jobs.soldier') as $key=> $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach

                    </select>
                    <span class="la la-city input-icon"></span>
                    @error('soldier')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">جنسیت</label>
                <div class="form-group">
                    <select class="form-control form--control" name="soldier" wire:model.defer="gender"
                            id="city">
                        <option value="">انتخاب کنید</option>
                        @foreach(config('jobs.jobs.genders') as $key=> $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach

                    </select>
                    <span class="la la-city input-icon"></span>
                    @error('gender')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">سابقه کار</label>
                <div class="form-group">
                    <select class="form-control form--control" name="resume" wire:model.defer="resume"
                            id="city">
                        <option value="">انتخاب کنید</option>
                        @foreach(config('jobs.jobs.resume') as $key=> $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                    <span class="la la-city input-icon"></span>
                    @error('resume')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">مهارت های مورد نیاز</label>
                <div class="form-group">
                    <input type="text" class="form-control form--control" wire:model.defer="skills">
                    <span class="la la-city input-icon"></span>
                    @error('skills')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4">
                <label class="label-text">مبلغ دستمزد (تومان)</label>
                <div class="form-group">
                    <input type="text" class="form-control form--control" wire:model.defer="salary">
                    <span class="la la-city input-icon"></span>
                    @error('salary')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="input-box col-lg-4  position-relative" id="date-pickers">
                <label class="label-text">تاریخ اعتبار</label>
                <div class="form-group">
                    <input id="validity" class="form-control form--control pdp-el" wire:model.defer="validity" x-data="" x-init="" pdp-id="pdp-4120466">
                    <span class="la la-calendar-day input-icon"></span>
                </div>
                @error('validity')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>


            <div class="input-box col-lg-6">
                <div class="media media-card align-items-center">
                    <div class="media-img media-img-lg mr-4 bg-gray">
                        @if(!is_null($file) && $file->temporaryUrl() !== null)
                            <img class="mr-3" src="{{ $file->temporaryUrl() }}" alt="تصویر آواتار"/>
                        @elseif($image)
                            <img class="mr-3" src="{{asset($image)}}" alt="تصویر آواتار">
                        @endif
                    </div>
                    <div class="media-body">
                        <div x-data="{ isUploading: false, progress: 0 }"
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress"
                             class="file-upload-wrap file-upload-wrap-2">
                            <input type="file" wire:model="file" class="multi file-upload-input with-preview"/>
                            <span class="file-upload-text"><i class="la la-photo mr-2"></i>انتخاب تصویر</span>
                            <div class="mt-2" x-show="isUploading">
                                در حال اپلود تصویر...
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                        </div>
                        <!-- file-upload-wrap -->
                        <p class="fs-14">حداکثر اندازه فایل {{$max_file_size}} کیلوبایت، فایل های مناسب jpg و
                            png.</p>
                        <br>
                        @error('file')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="input-box col-12">
                <label class="label-text">متن</label>
                <x-admin.forms.basic-text-editor with="12" id="content" label="" wire:model.defer="content"/>
            </div>
            <div class="input-box col-lg-12 py-2">
                <button type="submit" class="btn btn-outline-success">ذخیره تغییرات</button>
            </div>
        </fieldset>

        <!-- end input-box -->
    </form>

</div>
