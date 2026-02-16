<div>

    @if(!$user->details()->first())
        <p class="alert alert-warning"><b class="text-danger">توجه</b> : کاربر گرامی قبل از ثبت درخواست می بایست پروفایل خود را تکمیل نمایید.
            <a class="btn-link" href="{{route('user.profile')}}">تکمیل پروفایل</a>
        </p>
    @else
        <div>
            <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
            <div class="container-fluid">
                <div class="dashboard-heading mb-5">
                    <h3 class="fs-22 font-weight-semi-bold">
                        درخواست های همکاری من
                    </h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item dashboard-info-card">
                            <div class="card-body d-flex align-items-center">
                                <div class="icon-element flex-shrink-0 bg-1 text-white">
                                    <i class="la la-money"></i>
                                </div>
                                <div class="pl-4">
                                    <p class="card-text fs-18">  کسب درآمد از فروش  </p>
                                    <a href="{{route('user.salePerson')}}" class="card-title pt-2 fs-26">مشارکت در فروش</a>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item dashboard-info-card">
                            <div class="card-body d-flex align-items-center">
                                <div class="icon-element flex-shrink-0 bg-1 text-white">
                                    <i class="la la-person-booth"></i>
                                </div>
                                <div class="pl-4">
                                    <p class="card-text fs-18">همکاری به عنوان مدرس</p>
                                    <a href="{{route('user.teacher')}}" class="card-title pt-2 fs-26">درخواست تدریس</a>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <div style="overflow-x:auto;" class="dashboard-cards mb-5">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>تاریخ</td>
                            <td>وضعیت</td>
                            <td>مشاهده جزئیات</td>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($requests as $key =>  $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->status_label }}</td>
                                <td>
                                    <p wire:click="show_details('{{$item->id}}')" data-toggle="modal" data-target="#show_details" class="d-flex align-items-center cursor-pointers">
                                        مشاهده<i class="la la-eye px-2 la-lg"></i>
                                    </p>
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
            <div wire:ignore.self class="modal fade modal-container" id="show_details" tabindex="-1" role="dialog" aria-labelledby="show_detailsTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-gray d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">نتیجه درخواست همکاری شما : </h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            @if(!empty($result))
                                {!! $result !!}
                            @else
                                <p class="text-info">نتیجه ای ثبت نشده است</p>
                            @endif
                        </div>
                        <div class="modal-footer justify-content-center border-top-gray">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif

</div>
