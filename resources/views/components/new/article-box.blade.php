@props(['item'])

<div class="relative bg-background rounded-xl p-4">
    <div class="relative mb-3 z-20">
        <a href="{{route('article',['slug'=>$item->slug])}}" class="block">
            <img style="height: 150px"  src="{{asset($item->image)}}" class="max-w-full w-full rounded-xl"
                 alt="{{$item->title}}" />
        </a>
        <button type="button"
                class="absolute left-3 -bottom-3 w-9 h-9 inline-flex items-center justify-center bg-secondary rounded-full shadow-xl text-muted transition-colors hover:text-red-500 z-10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                 class="w-5 h-5">
                <path
                    d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">
                </path>
            </svg>
        </button>
    </div>
    <div class="relative space-y-3 z-10">
        <h2 class="font-bold text-sm">
            <a href="{{route('article',['slug'=>$item->slug])}}"
               class="line-clamp-1 text-foreground transition-colors hover:text-primary">

                {{$item->title}}
            </a>
        </h2>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-1">
                <div
                    class="flex-shrink-0 w-8 h-8 border border-white rounded-full overflow-hidden">
                    <img src="{{$item->user->image}}"
                         class="w-full h-full object-cover" alt="...">
                </div>
                <p
                    class="line-clamp-1 font-bold text-xs text-foreground transition-colors hover:text-primary">

                    {{$item->user->details->fullName ?? "کاربر سایت"}}</p>
            </div>
            <a href="{{route('articles',['category'=>$item->category->slug])}}"
               class="bg-primary/10 rounded-full text-primary transition-all hover:opacity-80 py-1 px-4">
                                <span class="font-bold text-xxs">
                                    {{$item->category->title}}
                                </span>
            </a>
        </div>
        <div class="flex justify-end">
            <div class="flex items-center gap-1 text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="font-semibold text-xs text-muted">زمان مطالعه:</span>
                <span class="font-semibold text-xs text-foreground">۲۰ دقیقه</span>
            </div>
        </div>
    </div>
</div>
