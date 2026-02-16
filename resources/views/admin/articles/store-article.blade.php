<div>
    @section('title',' آگهی  ')
    <x-admin.form-control deleteAble="true" deleteContent="حذف آگهی" mode="{{$mode}}" title="آگهی" />
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{ $header }}</h3>
        </div>
        <x-admin.forms.validation-errors/>
        <div class="card-body">
            <div class="row">
            </div>
            <hr>
            <x-admin.forms.lfm-standalone id="image" label="تصویر" :file="$image" type="image" required="true" wire:model="image"/>
            <x-admin.forms.full-text-editor id="body" label="محتوا*" wire:model.defer="body"/>
            <x-admin.forms.text-area label="کلمات کلیدی*" help="کلمات را با کاما از هم جدا کنید" wire:model.defer="seo_keywords" id="seo_keywords" />
            <x-admin.forms.text-area label="توضیحات سئو*" wire:model.defer="seo_description" id="seo_description" />
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
