<div>
    @section('title','داشبورد')
    <x-teacher.form-control  :store="false"  title="داشبورد"/>

    <div class="card card-custom">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-6">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="text-danger fa fa-graduation-cap fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{$user_refferals}} نفر
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">زیر مجموعه </span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>
                <div class="col-md-3 col-6">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="text-info fab fa-product-hunt fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
{{$totalReferralPurchases}} دوره
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">فروخته شده</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>

                <div class="col-md-3 col-6">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-success svg-icon-4x">
                                <i class="text-danger flaticon2-open-text-book fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{number_format($earning)}} تومان
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">درآمد کسب شده</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>

                <div class="col-md-3 col-6">
                    <!--begin::Stats Widget 25-->
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <span class="svg-icon svg-icon-info svg-icon-4x">
                                <i class="text-info fas fa-circle-notch fa-3x"></i>
                            </span>
                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">
                                {{number_format($user_wallet)}} تومان
                            </span>
                            <span class="font-weight-bold text-dark font-size-lg">موجودی کیف پول</span>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Stats Widget 25-->
                </div>


            </div>
{{--            <div class="row" wire:ignore>--}}
{{--                <div class="col-xl-12" wire:init="runChart()">--}}
{{--                    <!--begin::Charts Widget 4-->--}}
{{--                    <div class="card card-custom card-stretch gutter-b">--}}
{{--                        <!--begin::Header-->--}}
{{--                        <div class="card-header h-auto border-0">--}}
{{--                            <div class="card-title py-5">--}}
{{--                                <h3 class="card-label">--}}
{{--                                    <span class="d-block text-dark font-weight-bolder"> نمودار واریز حق التدریس بابت دوره های اموزشی</span>--}}
{{--                                </h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Header-->--}}
{{--                        <!--begin::Body-->--}}
{{--                        <div class="card-body">--}}
{{--                            <div id="kt_charts_widget_4_chart2"></div>--}}
{{--                        </div>--}}
{{--                        <!--end::Body-->--}}
{{--                    </div>--}}
{{--                    <!--end::Charts Widget 4-->--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

