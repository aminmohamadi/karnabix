
@push('styles')

@endpush
<div class="container">
    <div class="dashboard-heading mb-5 d-flex align-items-center justify-content-between">
        <h3 class="fs-22 font-weight-semi-bold">انتقال وجه</h3>
        <a href="{{ route('user.cart') }}" class="btn btn-outline-primary ">انتقال وجه</a>
    </div>
    <div class="text-center alert alert-info">
        کاربران سایت میتوانند با انتقال وجه به کد "<button style="    background: transparent;
    border: none;" onclick="copyLink('{{$user->referral_code}}')">{{$user->referral_code}}</button>" حساب کاربری شما را شارژ کنند.
    </div>

    <ul class="nav nav-tabs generic-tab pb-30px" id="myTab" role="tablist">
        <li class="nav-item">
            <a wire:click="$set('tab','deposits')" class="nav-link {{ $tab == 'deposits' ? 'active' : '' }}"
               id="deposits-tab" data-toggle="tab" href="#deposits" role="tab" aria-controls="deposits"
               aria-selected="false">
                واریز ها
            </a>
        </li>
        <li class="nav-item">
            <a wire:click="$set('tab','transmission')" class="nav-link {{ $tab == 'transmission' ? 'active' : '' }}"
               id="transmission-tab" data-toggle="tab" href="#transmission" role="tab" aria-controls="transmission"
               aria-selected="false">
                برداشت ها
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent" wire:ignore.self>
        @if($tab == 'deposits')
            <div class="tab-pane fade  {{ $tab == 'deposits' ? 'show active' : '' }}" id="deposits"
                 role="tabpanel" aria-labelledby="edit-profile-tab" wire:ignore.self>
                <div class="setting-body" wire:ignore.self>
                    <div style="overflow-x:auto;" class="dashboard-cards mb-5">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>واریز کننده</td>
                                <td>مبلغ (تومان)</td>
                                <td>تاریخ</td>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user->receivedCarts as  $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->sender->name }}</td>
                                    <td>{{ number_format($item->amount) }}</td>
                                    <td>{{ $item->date }}</td>
                                </tr>
                            @empty
                                <td class="text-center alert alert-warning" colspan="6">
                                    هیج درخواستی ثبت نشده است.
                                </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        @else
            <div class="tab-pane fade {{ $tab == 'transmission' ? 'show active' : '' }}" id="transmission" role="tabpanel"
                 aria-labelledby="wallet-tab" wire:ignore.self>
                <div class="setting-body" wire:ignore.self>
                    <div style="overflow-x:auto;" class="dashboard-cards mb-5">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>دریافت کننده</td>
                                <td>مبلغ (تومان)</td>
                                <td>تاریخ</td>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user->sentCarts as  $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->receiver->name }}</td>
                                    <td>{{ number_format($item->amount) }}</td>
                                    <td>{{ date($item->date) }}</td>
                                </tr>
                            @empty
                                <td class="text-center alert alert-warning" colspan="6">
                                    هیج درخواستی ثبت نشده است.
                                </td>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end setting-body -->
            </div>
        @endif
        <!-- end tab-pane -->
    </div>
</div>
@push('scripts')
    <script>
        function copyLink(text) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    emitNotify('کد با موفقیت کپی شد');
                });
        }

        function emitNotify(message) {
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        }

    </script>
@endpush
