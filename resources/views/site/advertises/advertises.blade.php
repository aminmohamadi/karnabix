<div>
    <x-site.breadcrumbs :data="$page_address" title="آگهی های استخدام" />

    <section class="course-area">
        <div class="container">
            <div class="filter-bar mb-4">
                <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                    <p class="fs-14">ما <span class="text-black">{{ $advertises->count() }}</span> آگهی برای شما پیدا کردیم
                    </p>
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="select-container select--container">
                            <select class="select-container-select form-control" wire:model="orderBy">
                                <option value="">مرتب سازی</option>
                                @foreach($orders as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('user.advertise',['create']) }}" class="btn btn-outline-primary ml-2 ">ثبت آگهی جدید</a>

                    </div>
                </div>
                <!-- end filter-bar-inner -->
            </div>
            <!-- end filter-bar -->
            <div class="row">
                <div class="col-lg-3" wire:ignore>
                    <div class="sidebar mb-5">
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">بر اساس نوع نوع شغل</h3>
                                <div class="divider"><span></span></div>
                                @foreach($types as $key => $item)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="radio" name="property" class="custom-control-input"
                                               wire:model="type" value="{{$key}}" id="{{$key}}_property" required="" />
                                        <label class="custom-control-label custom--control-label text-black"
                                               for="{{$key}}_property"> {{$item}} </label>
                                    </div>
                                @endforeach
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="radio" name="property" class="custom-control-input"
                                           wire:model="type" value="" id="all_property" required="" />
                                    <label class="custom-control-label custom--control-label text-black"
                                           for="all_property"> همه </label>
                                </div>
                                <!-- end custom-control -->
                            </div>
                        </div>
                        <!-- end card -->
                        <div class="card card-item">
                            <div class="card-body">
                                <h3 class="card-title fs-18 pb-2">دسته بندی ها</h3>
                                <div class="divider"><span></span></div>
                                <div class="custom-control custom-checkbox mb-1 fs-15">
                                    <input type="radio" name="category" class="custom-control-input"
                                           wire:model="category" value="" id="all_categories" required="" />
                                    <label class="custom-control-label custom--control-label text-black"
                                           for="all_categories"> همه دسته بندی ها </label>
                                </div>
                                @foreach(config('jobs.jobs') as $item)
                                    <div class="custom-control custom-checkbox mb-1 fs-15">
                                        <input type="radio" name="category" wire:model="category"
                                               value="{{ $item }}" class="custom-control-input"
                                               id="{{ $item }}" required="" />
                                        <label class="custom-control-label custom--control-label text-black"
                                               for="{{ $item }}"> {{ $item}} </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end sidebar -->
                </div>
                <!-- end col-lg-4 -->
                <div class="col-lg-9">
                    @if(sizeof($advertises) > 0)
                        <div class="row">

                            @foreach($advertises as $item)
                                <a href="{{route('advertise',['id'=>$item->id])}}" style="color: unset!important;" class=" col-lg-4 col-md-6 responsive-column-half">
                                    <div class="card hover-border shadow-lg card-item dashboard-info-card">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="container">
                                                <div class="row">
                                                    <p class=" card-title fs-18">{{$item->job}}</p>

                                                </div>
                                                <div class="row">
                                                    <p class=" card-text pt-2 fs-14">دستمزد : {{$item->salary}} تومان</p>


                                                </div>
                                                <div class="row">
                                                    <p class="card-text pt-2 fs-14" style="color: #7f8897" >
                                                        نوع همکاری :
                                                        @switch ($item->job_type)
                                                            @case(1) تمام وقت
                                                            @break
                                                            @case(2) پاره وقت
                                                            @break
                                                            @case(3) دورکاری
                                                            @break
                                                        @endswitch
                                                    </p>

                                                </div>
                                                <div class="row">
                                                    <p class="card-text pt-2 fs-12">
                                                        تاریخ ثبت : {{$item->date}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
                                </a>
                            @endforeach
                        </div>
                        <!-- end row -->
                    @else
                        <div class="text-center mb-3">
                            <img class="mx-auto no-date d-block mt-5" src="{{ asset('site/svg/no-data.svg') }}" alt="">
                            <h5 class="mt-3">ما هیچ آگهی ای برای شما پیدا نکردیم!</h5>
                        </div>
                    @endif
{{--                    {{$advertises->links('site.includes.paginate')}}--}}
                </div>
                <!-- end col-lg-8 -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
