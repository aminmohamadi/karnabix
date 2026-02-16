<div>
{{--    <x-site.articles.breadcrumbs :data="$page_address" :article="$advertise" />--}}

    <section class="blog-area pt-100px pb-20px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="card card-item p-5">
                        <h3 class="title m-3">استخدام {{$advertise->job}} ({{$city}})</h3>
                        <hr>
                        <div class="row">
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">دسته بندی شغل</p></div>
                                <div class="bottom badge badge-secondary p-2">{{$advertise->category}}</div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">موقعیت مکانی</p></div>
                                <div class="bottom badge badge-secondary p-2">{{$city}} , {{$province}}</div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">نوع همکاری</p></div>
                                <div class="bottom badge badge-secondary p-2">{{$advertise->job_type}}</div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">حداقل سابقه کار</p></div>
                                <div class="bottom badge badge-secondary p-2">
                                    @switch($advertise->resume)
                                        @case(0) مهم نیست
                                        @break
                                        @case(1)بین یک تا سه سال
                                        @break
                                        @case(2) بین سه تا شش سال
                                        @break
                                        @case(3) بیش از شش سال
                                        @break
                                    @endswitch
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">حقوق</p></div>
                                <div class="bottom badge badge-secondary p-2">{{$advertise->salary}} تومان</div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">مهارت های مورد نیاز</p></div>
                                <div class="bottom badge badge-secondary p-2">{{$advertise->skills}}</div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">جنسیت</p></div>
                                <div class="bottom badge badge-secondary p-2">
                                    @switch($advertise->soldier)
                                        @case(0)
                                            مهم نیست
                                        @break
                                        @case(1) آقا
                                            @break
                                        @case(2) خانم
                                            @break
                                    @endswitch

                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">وضعیت نظام وظیفه</p></div>
                                <div class="bottom badge badge-secondary p-2">
                                    @switch($advertise->soldier)
                                        @case(0)
                                            مهم نیست
                                        @break
                                        @case(1) اجباری برای آقایان
                                            @break
                                    @endswitch

                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">نوع بیمه</p></div>
                                <div class="bottom badge badge-secondary p-2">
                                    @switch($advertise->insurance)
                                        @case(0)
                                            ندارد
                                        @break
                                        @case(1)دارد
                                            @break
                                    @endswitch

                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <div class="top"><p class="font-weight-bold text-black">مهارت های مورد نیاز</p></div>
                                <div class="bottom badge badge-secondary p-2">{{$advertise->skills}}</div>
                            </div>
                        </div>
                        <hr>
                        <h5>
                            شرح موقعیت شغلی

                        </h5>
                        <div class="mt-3">
                            {!! $advertise->content !!}
                        </div>
                        <!-- end card-body -->
                    </div>
            </div>
            <!-- end col-lg-8 -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">آکهی های مرتبط</h3>
                            <div class="divider"><span></span></div>
                            @foreach($related_posts as $item)
                            <div class="media media-card border-bottom border-bottom-gray pb-4 mb-4">
                                <a href="{{ route('advertise',$item->id) }}">
                                    <div class="media-body">
                                        <h5 class="fs-15"><a href="{{ route('advertise',$item->id) }}">استخدام  {{ $item->job }} </a>
                                        </h5>

                                    </div>
                                </a>

                            </div>
                            @endforeach
                            <div class="view-all-course-btn-box">
                                <a href="{{ route('advertises') }}" class="btn theme-btn w-100">مشاهده همه آگهی ها <i
                                        class="la la-arrow-left icon ml-1"></i></a>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- end sidebar -->
            </div>
            <!-- end col-lg-4 -->
        </div>
        <!-- end row -->
</div>
<!-- end container -->
</section>


</div>
@push('scripts')

<script>
    function reCaptchaCallback(response) {
        @this.set('recaptcha', response);
        }

        function back_to_episode(id)
        {
            $('html, body').animate({
                scrollTop: $(`#episode${id}`).offset().top
            }, 1000);
        }

        Livewire.on('resetReCaptcha', () => {
            grecaptcha.reset();
        });

    Livewire.on('loadRecaptcha', () => {
        const script = document.createElement('script');

        script.setAttribute('src', 'https://www.google.com/recaptcha/api.js');

        const start = document.createElement('script');


        document.body.appendChild(script);
        document.body.appendChild(start);
    });
</script>
@endpush
