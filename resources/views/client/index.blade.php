@section('content')
    <div class="grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-5 mb-8">

        <!-- statistics:item -->
        <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M9.664 1.319a.75.75 0 0 1 .672 0 41.059 41.059 0 0 1 8.198 5.424.75.75 0 0 1-.254 1.285 31.372 31.372 0 0 0-7.86 3.83.75.75 0 0 1-.84 0 31.508 31.508 0 0 0-2.08-1.287V9.394c0-.244.116-.463.302-.592a35.504 35.504 0 0 1 3.305-2.033.75.75 0 0 0-.714-1.319 37 37 0 0 0-3.446 2.12A2.216 2.216 0 0 0 6 9.393v.38a31.293 31.293 0 0 0-4.28-1.746.75.75 0 0 1-.254-1.285 41.059 41.059 0 0 1 8.198-5.424ZM6 11.459a29.848 29.848 0 0 0-2.455-1.158 41.029 41.029 0 0 0-.39 3.114.75.75 0 0 0 .419.74c.528.256 1.046.53 1.554.82-.21.324-.455.63-.739.914a.75.75 0 1 0 1.06 1.06c.37-.369.69-.77.96-1.193a26.61 26.61 0 0 1 3.095 2.348.75.75 0 0 0 .992 0 26.547 26.547 0 0 1 5.93-3.95.75.75 0 0 0 .42-.739 41.053 41.053 0 0 0-.39-3.114 29.925 29.925 0 0 0-5.199 2.801 2.25 2.25 0 0 1-2.514 0c-.41-.275-.826-.541-1.25-.797a6.985 6.985 0 0 1-1.084 3.45 26.503 26.503 0 0 0-1.281-.78A5.487 5.487 0 0 0 6 12v-.54Z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
            <div class="flex flex-col items-start text-right space-y-1">
                <span class="font-bold text-xs text-muted line-clamp-1">دوره های خریداری شده</span>
                <span class="font-bold text-sm text-foreground line-clamp-1">{{$myCourses}} دوره</span>
            </div>
        </div>
        <!-- statistics:item -->
        <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-violet-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path
                                                d="M1 4.25a3.733 3.733 0 0 1 2.25-.75h13.5c.844 0 1.623.279 2.25.75A2.25 2.25 0 0 0 16.75 2H3.25A2.25 2.25 0 0 0 1 4.25ZM1 7.25a3.733 3.733 0 0 1 2.25-.75h13.5c.844 0 1.623.279 2.25.75A2.25 2.25 0 0 0 16.75 5H3.25A2.25 2.25 0 0 0 1 7.25ZM7 8a1 1 0 0 1 1 1 2 2 0 1 0 4 0 1 1 0 0 1 1-1h3.75A2.25 2.25 0 0 1 19 10.25v5.5A2.25 2.25 0 0 1 16.75 18H3.25A2.25 2.25 0 0 1 1 15.75v-5.5A2.25 2.25 0 0 1 3.25 8H7Z">
                                            </path>
                                        </svg>
                                    </span>
            <div class="flex flex-col items-start text-right space-y-1">
                <span class="font-bold text-xs text-muted line-clamp-1">موجودی کیف پول</span>
                <div class="flex items-center gap-1">
                    <span class="font-bold text-sm text-foreground">{{ number_format($user->balance) }}  </span>
                    <span class="text-xs text-muted">تومان</span>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-violet-500">
                                      <svg xmlns="http://www.w3.org/2000/svg" fill="#f91010" class="w-5 h-5" viewBox="0 0 24 24" stroke="#f91010">

<g id="SVGRepo_bgCarrier" stroke-width="0"/>

<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

<g id="SVGRepo_iconCarrier">

<path d="M20,18a1,1,0,0,0,1-1V13a1,1,0,0,0-1-1H13V9.858a4,4,0,1,0-2,0V12H4a1,1,0,0,0-1,1v4a1,1,0,0,0,2,0V14h6v3a1,1,0,0,0,2,0V14h6v3A1,1,0,0,0,20,18ZM12,8a2,2,0,1,1,2-2A2,2,0,0,1,12,8ZM23,21a1,1,0,0,1-1,1H18a1,1,0,0,1,0-2h4A1,1,0,0,1,23,21ZM1,21a1,1,0,0,1,1-1H6a1,1,0,0,1,0,2H2A1,1,0,0,1,1,21Zm13-1a1,1,0,0,1,0,2H10a1,1,0,0,1,0-2Z"/>

</g>

</svg>
                                    </span>
            <div class="flex flex-col items-start text-right space-y-1">
                <span class="font-bold text-xs text-muted line-clamp-1">افراد دعوت شده</span>
                <div class="flex items-center gap-1">
                    <span class="font-bold text-sm text-foreground">{{ number_format($user->balance) }}  </span>
                    <span class="text-xs text-muted">نفر</span>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-violet-500">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-5 h-5" viewBox="0 0 800 800" enable-background="new 0 0 800 800" id="GUIDE" version="1.1" xml:space="preserve" fill="#1abcd7" stroke="#1abcd7">

<g id="SVGRepo_bgCarrier" stroke-width="0"/>

<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

<g id="SVGRepo_iconCarrier"> <g> <path d="M676.637,183.386c0.002-0.002,0.004-0.004,0.005-0.005L522.549,29.287c-3.619-3.62-8.62-5.86-14.145-5.86H137.5 c-11.046,0-20,8.954-20,20v713.146c0,11.046,8.954,20,20,20h525c11.046,0,20-8.954,20-20V197.522 C682.5,192.407,680.426,187.203,676.637,183.386z M642.5,736.573h-485V63.427h342.62l114.096,114.095l-85.812,0v-41.788 c0-11.046-8.954-20-20-20s-20,8.954-20,20v61.788c0,11.046,8.954,20,20,20c0,0,92.404,0,134.096,0V736.573z"/> <path d="M295.217,224.417l-39.854,39.855l-5.697-5.697c-7.811-7.811-20.473-7.811-28.283,0c-7.811,7.81-7.811,20.473,0,28.284 l19.84,19.84c3.75,3.751,8.838,5.858,14.142,5.858c5.305,0,10.392-2.107,14.143-5.858l53.996-53.999 c7.81-7.811,7.81-20.474-0.001-28.284C315.69,216.606,303.027,216.606,295.217,224.417z"/> <path d="M557.831,312.557h6.646c11.046,0,20-8.954,20-20s-8.954-20-20-20h-6.646c-11.046,0-20,8.954-20,20 S546.785,312.557,557.831,312.557z"/> <path d="M367.389,272.557c-11.046,0-20,8.954-20,20s8.954,20,20,20h129.609c11.046,0,20-8.954,20-20s-8.954-20-20-20H367.389z"/> <path d="M557.831,435.552h6.646c11.046,0,20-8.954,20-20s-8.954-20-20-20h-6.646c-11.046,0-20,8.954-20,20 S546.785,435.552,557.831,435.552z"/> <path d="M496.998,395.552H367.389c-11.046,0-20,8.954-20,20s8.954,20,20,20h129.609c11.046,0,20-8.954,20-20 S508.044,395.552,496.998,395.552z"/> <path d="M557.831,558.547h6.646c11.046,0,20-8.954,20-20s-8.954-20-20-20h-6.646c-11.046,0-20,8.954-20,20 S546.785,558.547,557.831,558.547z"/> <path d="M496.998,518.547H367.389c-11.046,0-20,8.954-20,20s8.954,20,20,20h129.609c11.046,0,20-8.954,20-20 S508.044,518.547,496.998,518.547z"/> <path d="M557.831,681.542h6.646c11.046,0,20-8.954,20-20s-8.954-20-20-20h-6.646c-11.046,0-20,8.954-20,20 S546.785,681.542,557.831,681.542z"/> <path d="M496.998,641.542H367.389c-11.046,0-20,8.954-20,20s8.954,20,20,20h129.609c11.046,0,20-8.954,20-20 S508.044,641.542,496.998,641.542z"/> <path d="M255.363,435.552c5.304,0,10.392-2.107,14.142-5.858l53.996-53.996c7.811-7.811,7.811-20.475,0-28.285 s-20.473-7.811-28.283,0l-39.854,39.855l-5.697-5.698c-7.81-7.81-20.474-7.812-28.284-0.001s-7.811,20.474-0.001,28.284 l19.84,19.841C244.972,433.444,250.059,435.552,255.363,435.552z"/> <path d="M234.239,511.547l-12.856,12.857c-7.81,7.811-7.81,20.474,0.001,28.284c3.905,3.905,9.023,5.857,14.142,5.857 s10.237-1.952,14.143-5.858l12.855-12.855l12.856,12.855c3.904,3.906,9.023,5.858,14.142,5.858s10.237-1.952,14.142-5.858 c7.811-7.811,7.811-20.473,0-28.283l-12.855-12.857l12.856-12.857c7.81-7.811,7.81-20.474-0.001-28.284 c-7.811-7.81-20.474-7.81-28.284,0.001l-12.856,12.856l-12.857-12.856c-7.811-7.811-20.473-7.811-28.283,0s-7.811,20.474,0,28.283 L234.239,511.547z"/> <path d="M295.217,593.4l-39.854,39.855l-5.697-5.697c-7.811-7.811-20.473-7.811-28.283,0c-7.811,7.81-7.811,20.473,0,28.283 l19.84,19.84c3.75,3.752,8.838,5.858,14.142,5.858c5.305,0,10.392-2.107,14.143-5.858l53.996-53.998 c7.81-7.811,7.81-20.474-0.001-28.284C315.69,585.59,303.027,585.59,295.217,593.4z"/> </g> </g>

</svg>                                    </span>
                                    </span>
            <div class="flex flex-col items-start text-right space-y-1">
                <span class="font-bold text-xs text-muted line-clamp-1">آزمون ها آماده</span>
                <div class="flex items-center gap-1">
                    <span class="font-bold text-sm text-foreground">{{ $myQuizzes }}  </span>
                    <span class="text-xs text-muted">نفر</span>
                </div>
            </div>
        </div>
        <!-- end statistics:item -->
    </div>
    <div class="space-y-5">
        @foreach($notifications as $item)

        <div
            class="flex md:items-center items-start gap-5 bg-background border border-border rounded-xl p-5">
            <div class="flex items-center gap-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-warning">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <div class="w-px h-4 bg-border"></div>
            </div>
            <div class="flex flex-col items-start space-y-1">
                <div class="font-bold text-xs text-foreground">
                    {{$item->subject}}
                </div>
                <div class="font-medium text-xs text-muted">
                    {!! $item->content  !!}
                </div>
                <div class="flex items-center gap-1 font-medium text-xs text-muted">
                    {{$item->date}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
