<div class="max-w-7xl space-y-14 px-4 mx-auto">
    <div class="flex md:flex-nowrap flex-wrap items-start gap-5">
        <div class="md:w-8/12 w-full">
            <div class="relative">
                <!-- article:thumbnail -->
                <div class="relative w-full z-10">
                    <img src="{{$article->image}}" class="max-w-full w-full rounded-3xl" alt="{{$article->title}}" />
                </div>

                <div class="-mt-12 pt-12">
                    <div
                        class="bg-gradient-to-b from-background to-secondary rounded-b-3xl space-y-2 p-5 mx-5">
                        <!-- article:title -->
                        <h1 class="font-bold text-xl text-foreground">{{$article->title}}</h1>

                    </div>
                    <div class="space-y-10 py-5">
                        <!-- article:description -->
                        <div class="description">
                            {!! $article->body !!}
                        </div>

                        @include('new.components.comments')
                    </div>
                </div>
            </div>
        </div>
        <div class="md:w-4/12 w-full md:sticky md:top-24 space-y-8">
            <div class="space-y-5">
                <div class="bg-background rounded-2xl">
                    <div class="flex flex-col space-y-1">
                        <div class="w-full space-y-1" x-data="{ open: true }">
                            <button type="button"
                                    class="w-full h-14 flex items-center justify-between gap-x-2 relative bg-secondary rounded-2xl transition hover:text-foreground px-5"
                                    x-bind:class="open ? 'text-foreground' : 'text-muted'"
                                    x-on:click="open = !open">
                                        <span class="flex items-center gap-3 text-right">

                                            <div class="w-1 h-1 bg-muted-foreground rounded-full"></div>
                                            <span class="font-semibold text-xs">
                                                مطالب مرتبط
                                            </span>
                                        </span>
                                <span class="" x-bind:class="open ? 'rotate-180' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                            </svg>
                                        </span>
                            </button>
                            <!-- end accordion:button -->

                            <!-- accordion:content -->
                            <div class="flex flex-col relative" x-show="open">
                                <div
                                    class="bg-background border border-border rounded-2xl space-y-1 overflow-hidden">
                                    @foreach($related_posts as $item)
                                        <div class="flex sm:flex-nowrap flex-wrap items-center gap-3 sm:h-12 p-5">
                                            <span class="text-xs text-muted">{{$loop->index + 1}}</span>
                                            <div class="w-1 h-1 bg-muted-foreground rounded-full"></div>
                                            <a href="{{route('article',['slug'=>$item->slug])}}"
                                               class="font-semibold text-xs text-foreground line-clamp-1 transition-all hover:underline">
                                                {{$item->title}}
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <!-- end accordion:content -->
                        </div>
                        <!-- end course:section:accordion -->
                    </div>
                    <!-- end course:sections:wrapper -->
                </div>
            </div>
        </div>
    </div>
</div>
