<div class="space-y-14">
    <div class="max-w-7xl space-y-14 px-4 mx-auto">
        <div class="flex flex-col items-center justify-center space-y-3">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                 class="w-10 h-10 text-yellow-500">
                <path fill-rule="evenodd"
                      d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 0 1-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 0 1-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 0 1-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584ZM12 18a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                      clip-rule="evenodd" />
            </svg>
            <h2
                class="font-black text-2xl text-center text-foreground bg-gradient-to-l from-transparent to-yellow-300 dark:to-yellow-800 py-5 px-8">
                پرسش های متداول
            </h2>
            <div class="flex items-center gap-3 w-40">
                <span class="block flex-grow h-px bg-border"></span>
                <span class="w-2 h-2 bg-border rounded-full"></span>
                <span class="block flex-grow h-px bg-border"></span>
            </div>
        </div>
        <div class="lg:max-w-3xl divide-y divide-border mx-auto">
            @foreach($fag as $key => $item)
                <div x-data="{ open: false  }">
                    <button class="flex items-center justify-between w-full py-3" x-on:click="open = !open">
                                <span class="font-bold text-sm text-foreground rtl:text-right ltr:text-left">
                                    {!! $item['question'] !!}
                                </span>
                        <span class="text-foreground transition-all" x-bind:class="open ? 'rotate-180' : ''">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                    </button>
                    <div class="faq-description space-y-2 pb-3" x-cloak x-show="open">
                        {!! $item['answer'] !!}
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>
