<div>
    <div class="container">
        <div class="dashboard-heading mb-5 d-flex align-items-center justify-content-between">
            <h3 class="fs-22 font-weight-semi-bold">ثبت آگهی </h3>
            <a href="{{ route('user.advertise',['create']) }}" class="btn btn-outline-primary ">آگهی جدید</a>
        </div>
        <div style="overflow-x:auto;" class="dashboard-cards mb-5">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>عنوان شغلی</td>
                    <td>نام شرکت</td>
                    <td>نوع کار</td>
                    <td>تاریخ ثبت</td>
                    <td>وضعیت</td>
                    <td>عملیات</td>

                </tr>
                </thead>
                <tbody>
                @forelse($myAds as  $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->job }}</td>
                        <td>{{ $item->company }}</td>
                        <td>@switch($item->job_type)
                                @case(0) تمام وقت
                                @break
                                @case(1) پاره وقت
                                @break
                                @case(2) کارآموزی
                                @break
                            @endswitch</td>
                        <td>{{$item->getDateAttribute()}}</td>
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
                            <a href="{{route("user.advertise",['edit',$item->id])}}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" >
                                <i class="la la-pen"></i>
                            </a>

                            <button class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" onclick="deleteItem({{$item->id}})">
                                <i class="la la-trash"></i>
                            </button>

                        </td>
                    </tr>
                @empty
                    <td class="text-center alert alert-info" colspan="6">
                        هیج درخواستی ثبت نشده است.
                    </td>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@push('scripts')
    <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'حذف آگهی!',
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
