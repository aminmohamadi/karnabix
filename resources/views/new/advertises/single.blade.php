<div class="max-w-7xl space-y-14 px-4 mx-auto">
    <div class="flex md:flex-nowrap flex-wrap items-start gap-5">
        <div class="md:w-8/12 w-full">
            <div class="-mt-12 pt-12">
                <div
                    class="bg-gradient-to-b from-background to-secondary rounded-b-3xl space-y-2 p-5 mx-5">
                    <h1 class="font-bold text-xl text-foreground">{{$advertise->title}}</h1>
                    <p class="text-sm text-muted">
                        {{$advertise->company}}({{$advertise->job}})
                    </p>
                </div>
                <div class="space-y-10 py-5">
                    <div class="grid lg:grid-cols-4 grid-cols-2 gap-5">
                        <div
                            class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                          d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                            <div
                                class="flex flex-col items-center justify-center text-center space-y-1">
                                <span class="font-bold text-xs text-muted line-clamp-1">تاریخ اعتبار آگهی</span>
                                <span
                                    class="font-bold text-sm text-foreground line-clamp-1">{{$advertise->validity}}</span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                     fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                          d="M4.25 2A2.25 2.25 0 0 0 2 4.25v2.5A2.25 2.25 0 0 0 4.25 9h2.5A2.25 2.25 0 0 0 9 6.75v-2.5A2.25 2.25 0 0 0 6.75 2h-2.5Zm0 9A2.25 2.25 0 0 0 2 13.25v2.5A2.25 2.25 0 0 0 4.25 18h2.5A2.25 2.25 0 0 0 9 15.75v-2.5A2.25 2.25 0 0 0 6.75 11h-2.5Zm9-9A2.25 2.25 0 0 0 11 4.25v2.5A2.25 2.25 0 0 0 13.25 9h2.5A2.25 2.25 0 0 0 18 6.75v-2.5A2.25 2.25 0 0 0 15.75 2h-2.5Zm0 9A2.25 2.25 0 0 0 11 13.25v2.5A2.25 2.25 0 0 0 13.25 18h2.5A2.25 2.25 0 0 0 18 15.75v-2.5A2.25 2.25 0 0 0 15.75 11h-2.5Z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                            <div
                                class="flex flex-col items-center justify-center text-center space-y-1">
                                                <span class="font-bold text-xs text-muted line-clamp-1">
                                                    بیمه
                                                </span>
                                <span class="font-bold text-sm text-foreground line-clamp-1">
                                        @switch($advertise->insurance)
                                        @case(1) دارد
                                        @break
                                        @case(2) ندارد
                                        @break
                                    @endswitch
                                    </span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="800px"
                                                   height="800px" viewBox="0 0 1024 1024">
                                                  <path
                                                      d="M541.7 768v-45.3c46.3-2.4 81.5-15 108.7-37.8 27.2-22.8 40.8-53.1 40.8-88.2 0-37.8-11-65.7-35.3-83.4-24.6-20.1-59.8-35.4-111.6-45.3h-2.6V351.8c35.3 5.1 65.3 15 95.1 35.4l43.6-55.5c-43.6-27.9-89.9-42.9-138.8-45.3V256h-40.8v30.3c-40.8 2.4-76.3 15-103.5 37.8-27.2 22.8-40.8 53.1-40.8 88.2s11 63 35.3 80.7c21.7 17.7 59.8 32.7 108.7 42.9v118.5c-38.2-5.1-76.3-22.8-114.2-53.1l-48.9 53.1c48.9 40.5 103.5 63 163.3 68.1V768h41zm2.6-219.6c27.2 7.5 43.6 15 54.4 22.8 8.1 10.2 13.6 20.1 13.6 35.4s-5.5 25.2-19.1 35.4c-13.6 10.2-30.1 15-48.9 17.7V548.4zM449.2 440c-8.1-7.5-13.6-20.1-13.6-32.7 0-15 5.5-25.2 16.2-35.4 13.6-10.2 27.2-15 48.9-17.7v108.6c-27.2-7.8-43.4-15.3-51.5-22.8z"/>
                                              </svg>
                                            </span>
                            <div
                                class="flex flex-col items-center justify-center text-center space-y-1">
                                <span class="font-bold text-xs text-muted line-clamp-1">دستمزد</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1">
                                        {{number_format($advertise->salary)}} تومان
                                    </span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                     <svg fill="currentColor" class="h-5 w-5" viewBox="0 0 42 42" xml:space="preserve">
<path fill-rule="evenodd"
      d="M33,13.924C33,6.893,27.594,1,20.51,1S8,6.897,8,13.93C8,16.25,8.324,18,9.423,20H9.402l10.695,20.621  c0.402,0.551,0.824-0.032,0.824-0.032C20.56,41.13,31.616,20,31.616,20h-0.009C32.695,18,33,16.246,33,13.924z M14.751,13.528  c0-3.317,2.579-6.004,5.759-6.004c3.179,0,5.76,2.687,5.76,6.004s-2.581,6.005-5.76,6.005C17.33,19.533,14.751,16.846,14.751,13.528  z"/>
</svg>                                            </span>
                            <div
                                class="flex flex-col items-center justify-center text-center space-y-1">
                                                <span
                                                    class="font-bold text-xs text-muted line-clamp-1">محل کار</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1">
                                       {{$province}},  {{$city}}
                                </span>
                            </div>
                        </div>

                        <div
                            class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
<path fill="#fff" stroke="currentColor"
      d="M6 7H7M6 10H7M11 10H12M11 13H12M6 13H7M11 7H12M7 21V18C7 16.8954 7.89543 16 9 16C10.1046 16 11 16.8954 11 18V21H7ZM7 21H3V4.6C3 4.03995 3 3.75992 3.10899 3.54601C3.20487 3.35785 3.35785 3.20487 3.54601 3.10899C3.75992 3 4.03995 3 4.6 3H13.4C13.9601 3 14.2401 3 14.454 3.10899C14.6422 3.20487 14.7951 3.35785 14.891 3.54601C15 3.75992 15 4.03995 15 4.6V9M19.7 13.5C19.7 14.3284 19.0284 15 18.2 15C17.3716 15 16.7 14.3284 16.7 13.5C16.7 12.6716 17.3716 12 18.2 12C19.0284 12 19.7 12.6716 19.7 13.5ZM21.5 21V20.5C21.5 19.1193 20.3807 18 19 18H17.5C16.1193 18 15 19.1193 15 20.5V21H21.5Z"
      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>                                           </span>
                            <div
                                class="flex flex-col items-center justify-center text-center space-y-1">
                                                <span
                                                    class="font-bold text-xs text-muted line-clamp-1">سابقه کار</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1">
                                       @switch($advertise->resume)
                                        @case(0)
                                            مهم نیست
                                            @break
                                        @case(1)
                                            بین 1 تا 3 سال
                                            @break
                                        @case(2)
                                            بین 3 تا 6 سال
                                            @break
                                        @case(3)
                                            بیش از سه سال
                                            @break
                                    @endswitch
                                </span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
     viewBox="0 0 28 32" enable-background="new 0 0 28 32" xml:space="preserve" fill="currentColor" class="h-5 w-5">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g
        id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier"> </g>
            <path
                stroke-width="2"
                stroke="currentColor"
                fill="currentColor"
                d="M10.589,8.527c-2.803,0-5.471,1.125-7.513,3.166c-2.148,2.148-3.267,5.129-3.067,8.177 c0.2,3.06,1.719,5.894,4.169,7.776c1.784,1.37,4.033,2.125,6.333,2.125c2.525,0,4.963-0.885,6.864-2.493 c4.015-3.395,4.973-8.798,2.399-13.267l3.749-3.606l0.339,0.348c0.285,0.292,0.665,0.453,1.069,0.454 c0.683,0,1.281-0.46,1.455-1.119l1.576-5.976c0.12-0.453,0.025-0.925-0.26-1.295c-0.366-0.475-1.004-0.692-1.584-0.534 l-5.849,1.594c-0.518,0.141-0.912,0.534-1.053,1.052c-0.141,0.519-0.001,1.058,0.374,1.442l0.528,0.542l-3.615,3.48 C14.743,9.171,12.708,8.527,10.589,8.527z M16.895,11.403l4.279-4.119c0.096-0.092,0.151-0.219,0.153-0.353 c0.002-0.133-0.049-0.262-0.142-0.357l-0.88-0.902c-0.18-0.185-0.147-0.398-0.125-0.481c0.023-0.083,0.102-0.283,0.351-0.351 l5.849-1.594c0.198-0.054,0.406,0.019,0.529,0.18c0.056,0.072,0.141,0.223,0.086,0.43L25.42,9.833 c-0.068,0.258-0.294,0.374-0.488,0.374c-0.094,0-0.231-0.026-0.354-0.152l-0.686-0.703c-0.191-0.196-0.506-0.201-0.705-0.011 l-4.394,4.227c-0.17,0.164-0.203,0.425-0.078,0.625c2.562,4.101,1.745,9.168-1.986,12.323c-1.721,1.456-3.929,2.257-6.219,2.257 c-2.081,0-4.114-0.681-5.724-1.918c-2.222-1.707-3.6-4.276-3.781-7.048c-0.181-2.761,0.832-5.46,2.776-7.405 c1.853-1.853,4.27-2.873,6.806-2.873c2.041,0,3.997,0.662,5.658,1.915C16.443,11.59,16.718,11.572,16.895,11.403z"></path> <path
        fill="currentColor"
        stroke-width="2"
        stroke="currentColor"
        d="M10.615,12.943c-1.673,0-3.247,0.651-4.43,1.835c-1.184,1.183-1.835,2.757-1.835,4.43 s0.651,3.247,1.835,4.43c1.183,1.184,2.757,1.835,4.43,1.835c1.674,0,3.247-0.652,4.431-1.835c2.443-2.443,2.443-6.417,0-8.86 C13.862,13.595,12.289,12.943,10.615,12.943z M14.339,22.932c-0.995,0.995-2.317,1.542-3.724,1.542 c-1.406,0-2.729-0.548-3.723-1.542S5.35,20.615,5.35,19.208s0.547-2.729,1.542-3.723s2.317-1.542,3.723-1.542 c1.407,0,2.729,0.547,3.724,1.542C16.392,17.538,16.392,20.879,14.339,22.932z"></path>
    </g> </g></svg>                                       </span>
                            <div
                                class="flex flex-col items-center justify-center text-center space-y-1">
                                                <span
                                                    class="font-bold text-xs text-muted line-clamp-1">جنسیت</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1">
                                          @switch($advertise->gender)
                                        @case(0)
                                            مهم نیست
                                            @break
                                        @case(1)
                                            آقا
                                            @break
                                        @case(2)
                                            خانم
                                            @break
                                    @endswitch
                                </span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
<svg fill="currentColor" class="h-5 w-5" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
     xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 952.2 952.2" xml:space="preserve" stroke="#00f"><g
        id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                       stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path
                d="M864.8,210.7c-27.699-42.3-61.8-79.6-101.5-111C723.2,68,678.5,43.4,630.5,26.4C580.8,8.9,528.7,0,475.601,0 C395.9,0,317.3,20.5,248.3,59.3C188,93.2,135.6,140.6,95.7,197.1l-28.2-13c-10.3-4.8-21.9,3.5-20.9,14.8l12.5,135.2 c1,11.3,14,17.3,23.2,10.7l110.9-78.4c9.3-6.6,8-20.7-2.4-25.5l-25.7-11.8C197.4,186.6,238.4,150.9,284.9,124.7 C342.8,92.2,408.7,75,475.5,75c44.601,0,88.3,7.5,129.9,22.2c40.2,14.2,77.7,34.9,111.3,61.4c33.3,26.3,62,57.6,85.2,93.1 c23.6,36.1,40.899,75.5,51.399,117.1c4.301,17,19.601,28.3,36.301,28.3c3,0,6.1-0.4,9.199-1.2C918.9,390.8,931,370.4,926,350.3 C913.601,300.7,892.9,253.7,864.8,210.7z"></path> <path
                d="M893.2,618c-1-11.3-14-17.3-23.2-10.7l-110.899,78.4c-9.301,6.6-8,20.7,2.399,25.5l25.7,11.8 c-32.3,42.5-73.3,78.2-119.8,104.4c-57.9,32.5-123.8,49.7-190.601,49.7c-44.6,0-88.3-7.5-129.899-22.2 c-40.2-14.2-77.7-34.9-111.301-61.4c-33.3-26.3-62-57.6-85.199-93.1C126.8,664.3,109.5,624.9,99,583.3 c-5.1-20.1-25.5-32.199-45.6-27.199c-20.101,5.1-32.2,25.5-27.2,45.6c12.6,49.7,33.2,96.7,61.399,139.8 c27.7,42.3,61.801,79.601,101.5,111C229.2,884.2,273.9,908.8,321.9,925.8c49.6,17.5,101.8,26.4,154.899,26.4 c79.7,0,158.301-20.5,227.301-59.3c60.3-33.9,112.699-81.3,152.6-137.8l28.2,13c10.3,4.8,21.899-3.5,20.899-14.801L893.2,618z"></path> <path
                d="M352.2,765.9c39.3,16.6,80.9,25,123.9,25s84.6-8.4,123.899-25c37.9-16,71.9-39,101.101-68.2 c29.199-29.2,52.199-63.2,68.199-101.1c16.601-39.301,25-80.9,25-123.9s-8.399-84.6-25-123.9c-16-37.9-39-71.9-68.199-101.1 c-29.2-29.2-63.2-52.2-101.101-68.2c-39.3-16.6-80.899-25-123.899-25s-84.601,8.4-123.9,25c-37.9,16-71.9,39-101.101,68.2 C221.9,276.9,198.9,310.9,182.9,348.8c-16.601,39.3-25,80.9-25,123.9s8.399,84.6,25,123.9c16,37.899,39,71.899,68.199,101.1 C280.3,727,314.3,749.9,352.2,765.9z M284.8,435.2h-49c7.8-50.7,31.4-97.5,68.4-134.5s83.8-60.6,134.5-68.4v49 c0,20.7,16.8,37.5,37.5,37.5s37.5-16.8,37.5-37.5v-49c50.7,7.8,97.5,31.4,134.5,68.4s60.6,83.8,68.4,134.5h-49 c-20.7,0-37.5,16.8-37.5,37.5s16.8,37.5,37.5,37.5h49c-7.9,50.7-31.5,97.5-68.5,134.5s-83.801,60.6-134.5,68.4v-49 c0-20.7-16.801-37.5-37.5-37.5c-20.7,0-37.5,16.8-37.5,37.5v49c-50.7-7.801-97.5-31.4-134.5-68.4s-60.601-83.8-68.4-134.5h49 c20.7,0,37.5-16.8,37.5-37.5S305.5,435.2,284.8,435.2z"></path> <path
                d="M449.4,495.4c1.399,1.7,3.1,3.2,4.8,4.399c0.9,0.7,1.8,1.4,2.7,2c0.3,0.2,0.6,0.4,1,0.601L590.8,593.3 c3.101,2.101,6.7-1.8,4.301-4.699L507.2,482.8L609.7,324c2.5-3.8-2.5-8.1-5.9-5.1l-150.6,132.2c-2.1,1.899-4.2,4.199-5.8,6.699 c-6.101,9.4-6.601,20.9-2.3,30.4C446.2,490.7,447.601,493.2,449.4,495.4z"></path> </g> </g></svg>                                      </span>
                            <div
                                class="flex flex-col items-center justify-center text-center space-y-1">
                                                <span
                                                    class="font-bold text-xs text-muted line-clamp-1">نوع کار</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1">
                                    @switch($advertise->remote)
                                        @case(2)حضوری
                                        @break
                                        @case(1)
                                            دورکاری
                                            @break
                                    @endswitch
                                </span>
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                            <span
                                                class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
<svg fill="currentColor" class="w-5 h-5" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve" stroke="#00d"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M247.07,323.803l-23.142-14.656c-1.283-0.812-2.449-1.738-3.526-2.735v180.695c0,13.747,11.144,24.891,24.891,24.891 s24.891-11.144,24.891-24.891V325.462C262.649,328.848,253.97,328.173,247.07,323.803z"></path> </g> </g> <g> <g> <path d="M301.242,253.872c-7.605,24.33-10.037,32.11-17.674,56.541c-1.177,3.766-3.267,7.159-5.999,9.917v166.777 c0,13.747,11.144,24.891,24.891,24.891s24.891-11.144,24.891-24.891c0-7.814,0-217.615,0-229.129L301.242,253.872z"></path> </g> </g> <g> <g> <path d="M234.937,68.481c4.648,17.303,20.435,30.044,39.206,30.044c22.423,0,40.601-18.178,40.601-40.601 c0-22.423-18.178-40.601-40.601-40.601c-18.771,0-34.559,12.741-39.207,30.045c-5.745-9.713-18.227-13.076-28.083-7.482 l-83.324,47.323c-7.242,4.113-11.321,12.158-10.36,20.43c0.961,8.272,6.775,15.168,14.767,17.511l92.707,26.606v116.811 l23.608-37.125c-3.48-6.366-4.969-13.884-3.754-21.605c1.469-9.339,6.603-17.189,13.705-22.319 c0.294-3.397,1.388-6.696,3.264-9.66c4.874-7.696,38.366-60.58,42.777-67.546c-8.482,0-66.804,0-75.485,0l-38.185-11.199 l40.769-23.155C230.605,74.107,233.157,71.496,234.937,68.481z"></path> </g> </g> <g> <g> <path d="M268.849,248.777c-6.177-0.971-11.699-3.554-16.217-7.242l-25.744,40.483c-3.55,5.606-1.884,13.03,3.722,16.58 l23.142,14.656c6.657,4.216,15.536,0.984,17.897-6.566l17.123-54.777L268.849,248.777z"></path> </g> </g> <g> <g> <path d="M394.745,1.411c-4.235-2.683-9.847-1.427-12.533,2.814l-7.297,11.522l-6.714-4.252c-4.236-2.683-9.848-1.425-12.533,2.814 c-2.684,4.237-1.424,9.849,2.813,12.533l6.714,4.252l-95.14,150.225c3.048-0.366,6.194-0.333,9.376,0.167l29.884,4.7l0.011-0.036 l52.984-83.662c2.684-4.239,1.424-9.849-2.813-12.533c-3.309-2.096-7.443-1.776-10.375,0.468l48.436-76.48 C400.243,9.705,398.983,4.094,394.745,1.411z"></path> </g> </g> <g> <g> <path d="M374.073,157.589c-0.06-11.998-4.616-22.96-12.05-31.306l-29.36,46.36l0.087,17.226l0.068,13.491l-55.453-8.722 c-11.316-1.78-21.934,5.952-23.714,17.268c-1.78,11.317,5.951,21.934,17.268,23.714l79.541,12.51 c12.631,1.988,24.029-7.832,23.966-20.596C374.236,189.806,374.082,159.267,374.073,157.589z"></path> </g> </g> </g></svg>                                   </span>
                            <div
                                class="flex flex-col items-center justify-center text-center space-y-1">
                                                <span
                                                    class="font-bold text-xs text-muted line-clamp-1">وضعیت سربازی</span>
                                <span class="font-bold text-sm text-foreground line-clamp-1">
                                       @switch($advertise->soldier)
                                        @case(0)
                                            مهم نیست
                                            @break
                                        @case(1)
                                            اجباری برای آقایان
                                            @break
                                    @endswitch
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="space-y-5">

                        <div class="space-y-8">
                            <div class="bg-background rounded-3xl p-5" id="tabOne">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="flex items-center gap-1">
                                        <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                        <div class="w-2 h-2 bg-foreground rounded-full"></div>
                                    </div>
                                    <div class="font-black text-foreground">شرح آگهی</div>
                                </div>

                                <div class="description">
                                    {!! $advertise->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="md:w-4/12 w-full md:sticky md:top-24 space-y-8">

    </div>
</div>
</div>

