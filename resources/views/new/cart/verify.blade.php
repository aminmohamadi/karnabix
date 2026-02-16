<div class="bg-gray-100 min-h-screen flex items-center justify-center py-10 px-4">

    <div class="w-full max-w-4xl space-y-8">

        {{-- جدول محصولات خریداری شده --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            @if(!is_null($order))
            <table class="w-full text-sm text-right text-gray-700">
                <thead class="bg-gray-100 font-bold text-sm text-gray-600">
                <tr>
                    <th class="px-4 py-3">نام محصول</th>
                    <th class="px-4 py-3">قیمت (تومان)</th>
                    <th class="px-4 py-3">وضعیت</th>
                    <th class="px-4 py-3">جمع</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                @foreach($order->details as $item)
                    <tr>
                        <td class="px-4 py-2">{{ $item->course->title }}</td>
                        <td class="px-4 py-2"> {{ number_format($item->price) }} تومان</td>
                        <td class="px-4 py-2">{{ $item->status_label }}</td>
                        <td class="px-4 py-2">{{ number_format($item->price) }}تومان</td>

                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr class="bg-gray-50 font-semibold text-sm">
                    <td colspan="3" class="px-4 py-2 text-left">مجموع کل</td>
                    <td class="px-4 py-2">{{ number_format($order->price) }} تومان</td>
                </tr>
                </tfoot>
            </table>
            @endif
        </div>

        {{-- پیام نتیجه پرداخت --}}
        <div class="bg-white shadow-xl rounded-xl p-8 text-center">
            @if($isSuccessful)
                <div class="flex flex-col items-center space-y-4 text-green-700">
                    <svg  class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4m6 2a10 10 0 1 1-20 0 10 10 0 0 1 20 0z"/>
                    </svg>
                    <h1 class="text-xl font-bold">پرداخت موفق بود!</h1>
                    <p class="text-sm">شماره پیگیری: {{ session('ref_id') }}</p>
                </div>
            @else
                <div class="flex flex-col items-center space-y-4 text-red-700">
                    <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <h1 class="text-xl font-bold">پرداخت ناموفق بود!</h1>
                    <p class="text-sm">در صورت کسر وجه، مبلغ طی ۷۲ ساعت به حساب شما بازخواهد گشت.</p>
                </div>
            @endif

            <a href="{{ route('home') }}"
               class="mt-6 inline-block bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/90 transition">
                بازگشت به صفحه اصلی
            </a>
        </div>

    </div>
</div>
