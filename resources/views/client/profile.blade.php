<div
    x-data="{ activeTab: 'profile' }"
    class="space-y-5"
>

    <!-- Tabs -->
    <div class="relative overflow-x-auto">
        <ul class="inline-flex gap-2 bg-secondary border border-border rounded-full p-1">

            <li>
                <button type="button"
                        class="flex items-center gap-2 rounded-full py-2 px-4"
                        :class="activeTab === 'profile' ? 'text-foreground bg-background' : 'text-muted'"
                        @click="activeTab='profile'"
                        wire:click="$set('tab','profile')">
                    اطلاعات حساب
                </button>
            </li>


            <li>
                <button type="button"
                        class="flex items-center gap-2 rounded-full py-2 px-4"
                        :class="activeTab === 'wallet' ? 'text-foreground bg-background' : 'text-muted'"
                        @click="activeTab='wallet'"
                        wire:click="$set('tab','wallet')"
                >
                    کیف پول
                </button>
            </li>

        </ul>
    </div>

    <!-- Content -->
    <div class="bg-background rounded-3xl p-5">

        <!-- TAB 1 -->
        <div x-show="activeTab === 'profile'" x-cloak>

            <form wire:submit.prevent="storeDetails" class="space-y-5">

                <div class="grid sm:grid-cols-2 gap-5">

                    <div class="space-y-1">
                        <label for="first_name" class="font-medium text-xs text-muted">
                            نام (فارسی)@error('first_name')
                            <small class="text-error">{{$message}}</small>
                            @enderror
                        </label>
                        <input
                            id="first_name"
                            type="text"
                            placeholder="نام"
                            wire:model.defer="first_name"
                            class="form-input w-full h-11 bg-secondary border-border @error('first_name') border-error @enderror rounded-xl px-5"
                        />

                    </div>



                    <div class="space-y-1">
                        <label for="last_name" class="font-medium text-xs text-muted">
                            نام خانوادگی (فارسی) @error('last_name')
                            <small class="text-error">{{$message}}</small>
                            @enderror
                        </label>
                        <input
                            id="last_name"
                            type="text"
                            placeholder="نام خانوادگی"
                            wire:model.defer="last_name"
                            class="form-input w-full h-11 bg-secondary border-border @error('last_name') border-error @enderror rounded-xl px-5"
                        />

                    </div>

                    <div class="space-y-1">
                        <label for="father_name" class="font-medium text-xs text-muted">
                            نام پدر (فارسی)   @error('father_name')
                            <small class="text-error">{{$message}}</small>
                            @enderror
                        </label>
                        <input
                            id="father_name"
                            type="text"
                            placeholder="نام پدر"
                            wire:model.defer="father_name"
                            class="form-input w-full h-11 bg-secondary border-border @error('father_name') border-error @enderror rounded-xl px-5"
                        />

                    </div>
                    <div class="space-y-1">
                        <label for="code_id" class="font-medium text-xs text-muted">
                            کد ملی (انگلیسی) @error('code_id')
                            <small class="text-error">{{$message}}</small>
                            @enderror
                        </label>
                        <input
                            id="code_id"
                            type="text"
                            placeholder="کد ملی"
                            wire:model.defer="code_id"
                            class="form-input w-full h-11 bg-secondary border-border @error('code_id') border-error @enderror rounded-xl px-5"
                        />

                    </div>



                    <div class="space-y-1">
                        <label for="birthday" class="font-medium text-xs text-muted">
                          تاریخ تولد @error('birthday')
                            <small class="text-error">{{$message}}</small>
                            @enderror
                        </label>
                        <input
                            id="birthday"
                            type="text"
                            data-jdp
                            wire:model.defer="birthday"
                            class="form-input w-full h-11 bg-secondary border-border @error('birthday') border-error @enderror rounded-xl px-5"
                        />

                    </div>


                    <div class="space-y-1">
                        <label for="province" class="font-medium text-xs text-muted">
                          استان@error('province')
                            <small class="text-error">{{$message}}</small>
                            @enderror
                        </label>
                        <select id="province" wire:model="province"
                                class="form-select w-full h-11 bg-secondary border-border @error('province') border-error @enderror rounded-xl px-5">

                            <option value="">استان</option>

                            @foreach($data['province'] as $key=>$item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach

                        </select>

                    </div>
                    <div class="space-y-1">
                        <label for="city" class="font-medium text-xs text-muted">
                            شهر@error('city')
                            <small class="text-error">{{$message}}</small>
                            @enderror
                        </label>
                        <select id="city" wire:model.defer="city"
                                class="form-select w-full h-11 bg-secondary border-border @error('city') border-error @enderror rounded-xl px-5">

                            <option value="">شهر</option>

                            @foreach($data['city'] as $key=>$item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach

                        </select>


                    </div>

                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-primary text-white px-6 h-11 rounded-full">
                        بروزرسانی
                    </button>
                </div>

            </form>

        </div>

        <!-- TAB 3 -->
        <div x-show="activeTab === 'wallet'" x-cloak>

            <div class="setting-body" wire:ignore.self>
                <h3 class="fs-17 font-weight-semi-bold pb-4">کیف پول</h3>
                @if(!is_null($message))
                    <p class="alert alert-{{$isSuccessful ? 'success' : 'danger'}}">{{$message}}</p>
                @endif
                <div class="danger-zone">
                    <p class="pt-1 pb-4"><span
                            class="text-primary">موجودی کیف پول:</span> {{ number_format(auth()->user()->balance) }}
                        تومان</p>
                    <div class="row">
                        <div class="input-box col-12 ">
                            <label class="label-text">افزایش اعتبار : </label>
                            <div class="form-group">
                                <input class="form-input w-full h-11 bg-secondary border-border
                                rounded-xl px-5"
                                                                   placeholder="مبلغ" type="text"
                                       name="text" wire:model.defer="price"/>

                                @error('price')
                                <small class="text-error">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="input-box col-12">
                            <label class="label-text">روش پرداخت را انتخاب کنید </label>
                            <div class="payment-option-wrap">
                                <div class="row">
                                    @foreach($gateways as $key => $item)
                                        <div class="col-12 col-md-4">
                                            <div class="p-2">
                                                <img src="{{ asset($item['logo']) }}" alt="">
                                                <input id="{{$key}}" name="gateway" type="radio"
                                                       wire:model.defer="gateway" value="{{$key}}"/>
                                                <label for="{{$key}}">
                                                    {{$item['title']}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('gateway')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-12 py-3">
                            <button wire:click="payment" class="bg-primary text-white px-6 h-11 rounded-full">
                                <p wire:loading.remove>
                                    پرداخت
                                </p>
                                <p wire:loading>
                                    در حال پردازش ...
                                </p>
                            </button>
                            <br>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<!-- Jalali Datepicker -->
@push('scripts')
    <link rel="stylesheet"
          href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">

    <script src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <script>
        jalaliDatepicker.startWatch(
            {
                separatorChars: {
                    date: "-"
                }
            }
        );
    </script>
@endpush
