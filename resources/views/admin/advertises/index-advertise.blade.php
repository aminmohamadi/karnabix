<div>
    @section('title',' آگهی های استخدام ')
    <x-admin.form-control link="{{ route('admin.store.article',['create'] ) }}"  title="آگهی های استخدام"/>
    <div class="card card-custom">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <x-admin.forms.dropdown id="status" :data="$data['status']" label="وضعیت" wire:model="status"/>

                </div>
                <div class="col-6">
                    <x-admin.forms.dropdown id="status" :data="$data['categories']" label="دسته بندی" wire:model="category"/>

                </div>
            </div>
            @include('admin.layouts.advance-table')
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table  class="table table-striped table-bordered" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>شماره شناسه</th>
                            <th>نام شرکت</th>
                            <th>عنوان شغلی</th>
                            <th>دسته بندی</th>
                            <th>درخواست کننده</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($articles as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->company }}</td>
                                <td>{{ $item->job }}</td>
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    @switch($item->status)
                                        @case(0)
                                         در انتظار تایید
                                        @break
                                        @case(1)
                                            تایید شده
                                            @break
                                        @case(2)
                                            رد شده
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <x-admin.edit-btn href="{{ route('admin.store.advertise',['edit', $item->id]) }}" />
                                    <x-admin.delete-btn onclick="deleteItem({{$item->id}})" />
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="8">
                                دیتایی جهت نمایش وجود ندارد
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{$articles->links('admin.layouts.paginate')}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف آگهی',
                text: 'آیا از حذف این آگهی اطمینان دارید؟',
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
                            'آگهی مورد نظر با موفقیت حذف شد',
                        )
                    }
                @this.call('delete', id)
                }
            })
        }
    </script>
@endpush
