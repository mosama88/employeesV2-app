
{{--        <div class="breadcrumb-header justify-content-between">--}}
{{--            <div class="my-auto">--}}
{{--                <div class="d-flex"><h4 class="content-title mb-0 my-auto">@yield('current-page')</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Cards</span></div>--}}
{{--            </div>--}}
{{--        </div>--}}
    <div class="row align-items-center my-4">
        <div class="col-md-8">
            <h6 class="page-title">@yield('page-title')</h6>
            <ol class="breadcrumb m-0">
                @yield('page-link-back')

                <li class="breadcrumb-item active" aria-current="page">@yield('current-page')</li>
            </ol>
        </div>
    </div>
</div>
