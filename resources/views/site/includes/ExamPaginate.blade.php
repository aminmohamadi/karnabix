@if ($paginator->hasPages())
    <div class="text-center py-3 ">
        <nav aria-label="مثال ناوبری صفحه" class="pagination-box d-block">
            <ul class="pagination justify-content-center">
                @if (!$paginator->onFirstPage())
                    <li style="cursor: pointer" class="next page-item" wire:click="previousPage">
                        <a class="page-link">
                            <i class="la la-angle-double-right"></i>
                            قبلی
                        </a>
                    </li>
                @endif


                @if ($paginator->hasMorePages())
                    <li style="cursor: pointer" class="next page-item" wire:click="nextPage">
                        <a class="page-link">
                            بعدی
                            <i class="la la-angle-double-left"></i>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        @if (!$paginator->hasMorePages())
        <button onclick="finish()" wire:loading.attr="disabled" class="mt-5  btn btn-primary d-inline-flex align-items-center">پایان ازمون <i class="la la-close icon ml-1"></i></button>
        @endif
    </div>

@endif

