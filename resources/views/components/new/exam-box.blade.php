@props(['data'])
<div class="relative shadow-xl mb-5 rounded-2xl">
    <div class="relative z-10">
        <a href="{{ route('exams',$data['slug']) }}" class="block">
            <img style="height: 200px" src="{{asset($data['image'])}}" class="max-w-full rounded-3xl"
                 alt="..."/>
        </a>
        <a href="{{ route('exams',['category'=>$data['category']['slug']]) }}"
           class="absolute left-3 top-3 h-11 inline-flex items-center justify-center gap-1 bg-black/20 rounded-full text-white transition-all hover:opacity-80 px-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd"
                      d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                      clip-rule="evenodd"/>
            </svg>
            <span class="font-semibold text-sm">{{ $data['category']['title'] }}</span>
        </a>
    </div>
    <div class="bg-background rounded-b-3xl -mt-12 pt-12">
        <div
            class="bg-gradient-to-b from-background to-secondary rounded-b-3xl space-y-2 p-5 mx-5">
            <div class="flex items-center gap-2">
                <span class="block w-1 h-1 bg-success rounded-full"></span>
                @php
                    $cert = false;
                    (!is_null($data->quiz) && !is_null($data->quiz->certificate)) ? $cert = true : $cert = false
                @endphp
                <span class="font-bold text-xs  {{$cert = true ? "text-success" : "text-success"}}">{{
$cert = true ? "دارای گواهی نامه" : "فاقد گواهی نامه"
                                    }}</span>
            </div>
            <h2 class="font-bold text-sm">
                <a href="{{ route('exams',$data['slug']) }}"
                   class="line-clamp-1 text-foreground transition-colors hover:text-primary">
                    {{$data['title']}}
                </a>
            </h2>
        </div>
        <div class="space-y-3 p-5">
            <div class="flex flex-wrap items-center gap-3">

                <span class="block w-1 h-1 bg-muted-foreground rounded-full"></span>

            </div>
            <div class="flex items-center justify-between gap-5">
                <div class="flex gap-3 mt-3">
                    <a href="{{ route('exams',$data['slug']) }}"
                       class="w-full h-11 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                        <span class="line-clamp-1 font-semibold text-sm">مشاهده</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                             fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </a>

                </div>
                <div class="flex flex-col items-end justify-center h-14">
                    @if($data['has_reduction'] && $data['base_price'] > 0)
                        <span class="line-through text-muted">
                       {{ number_format($data['base_price']) }}
                    </span>
                        <div class="flex items-center gap-1">
                            <span class="font-black text-xl text-foreground">
                                 {{ number_format($data['price']) }}


                            </span>
                            <span class="text-xs text-muted">تومان</span>
                        </div>
                    @elseif($data['base_price'] == 0 || $data['price'] == 0)
                        <div class="flex items-center gap-1">
                            <span class="text-xs text-muted">رایگان</span>
                        </div>
                    @else
                        <div class="flex items-center gap-1">
                            <span class="font-black text-xl text-foreground">{{ number_format($data['price']) }}</span>
                            <span class="text-xs text-muted">تومان</span>
                        </div>

                    @endif

                </div>

            </div>

        </div>
    </div>
</div>
