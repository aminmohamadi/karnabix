@props(['item'])
<div class="flex bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden">

    <div class="w-3/4 p-6 space-y-5">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
            استخدام {{ $item->job }} ({{$item->company}})
        </h2>

        <!-- توضیح -->
        <p class="text-sm text-gray-600 dark:text-white leading-relaxed">
            {{ $item->title }}
        </p>

        <!-- badgeها -->
        <div class="flex flex-wrap gap-3">
            <span class="bg-primary/10 dark:bg-white/10 dark:text-white text-blue-700 text-xs font-medium px-3 py-1 rounded-full">
                حقوق: {{ $item->salary }} تومان
            </span>

            <span class="bg-primary/10 dark:bg-white/10 dark:text-white text-green-700 text-xs font-medium px-3 py-1 rounded-full">
                {{ \App\Repositories\Classes\SettingRepository::getCities()[$item->province][$item->city] ?? 'نامشخص' }}
            </span>

            <span class="bg-primary/10 dark:bg-white/10 dark:text-white text-yellow-700 text-xs font-medium px-3 py-1 rounded-full">
                @switch($item->remote)
                    @case(1) دورکاری @break
                    @case(2) حضوری @break
                    @default نامشخص
                @endswitch
            </span>

            <span class="bg-primary/10 text-purple-700 dark:bg-white/10 dark:text-white text-xs font-medium px-3 py-1 rounded-full">
                @switch($item->job_type)
                    @case(1) تمام وقت @break
                    @case(2) پاره وقت @break
                    @case(3) کارآموزی @break
                    @default نامشخص
                @endswitch
            </span>
        </div>

        <!-- پایین باکس -->
        <div class="flex justify-between items-center dark:text-white text-sm text-gray-500 pt-3 border-t border-gray-100">
            <span>مهلت: {{ $item->validity }}</span>
            <a href="{{ route('advertise', ['id' => $item->id]) }}" class="text-primary hover:underline font-medium">مشاهده جزئیات</a>
        </div>
    </div>
</div>

