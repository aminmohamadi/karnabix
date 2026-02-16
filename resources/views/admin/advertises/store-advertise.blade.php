<div>
    @section('title',' مقاله ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف مقاله" mode="{{$mode}}" title="مقاله" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <form wire:submit.prevent="store()" class="row pt-40px">
                <fieldset class="row col-12 border p-4">
                    <legend class="float-none w-auto">اطلاعات آگهی :</legend>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.input id="title" label="عنوان" wire:model="title" type="text"/>

                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.input id="company" label="نام شرکت" wire:model="company" type="text"/>

                    </div>
                    <div class="input-box col-lg-4 ">
                        <x-admin.forms.input id="job" label="عنوان شغلی" wire:model="job" type="text"/>

                    </div>

                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="category" label="دسته بندی" :data="$categories" wire:model="category"/>
                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="province" label="استان" :data="$data['province']" wire:model="province"/>

                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="province" label="استان" :data="$data['city']" wire:model="city"/>

                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="job_type" label="نوع شغل" :data="$job_types" wire:model="job_type"/>
                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="remote" label="نوع حضور" :data="$remotes" wire:model="remote"/>
                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="insurance" label="بیمه" :data="$insurances" wire:model="insurance"/>

                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="soldier" label="خدمت سربازی" :data="$soldiers" wire:model="soldier"/>

                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="gender" label="جنسیت" :data="$genders" wire:model="gender"/>

                    </div>
                    <div class="input-box col-lg-4">
                        <x-admin.forms.dropdown id="resume" label="سابقه کار" :data="$resumes" wire:model="resume"/>

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
                        <x-admin.forms.input id="validity" type="text" label="تاریخ اعتبار" wire:model="validity"/>
                    </div>
                    <x-admin.forms.dropdown
                    id="status"
                    label="وضعیت"
                    wire:model="status"
                    :data="config('jobs.jobs.status')"
                    />


                    <div class="input-box col-lg-6">
                        <div class="media media-card align-items-center">
                            <div class="media-img media-img-lg mr-4 bg-gray">
                                @if(!is_null($file) && $file->temporaryUrl() !== null)
                                    <img class="mr-3" src="{{ $file->temporaryUrl() }}" alt="تصویر "/>
                                @elseif($image)
                                    <img class="mr-3" src="{{asset($image)}}" alt="تصویر ">
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
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف مقاله!',
                text: 'آیا از حذف این مقاله اطمینان دارید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'خیر',
                confirmButtonText: 'بله'
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'موفیت امیز!',
                            'مقاله مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('deleteItem', id)
                }
            })
        }
    </script>
@endpush
