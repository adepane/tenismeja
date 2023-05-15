@if (request('noheader') != '1')
    @include($slug . '.breadcrumbs')
@endif
@if (empty($subslug))
    @if (View::exists($slug . '.view.home'))
        @include($slug . '.view.home')
    @else
        @include('layouts.404')
    @endif
@else
    @if (View::exists($slug . '.view.' . $subslug))
        @include($slug . '.view.' . $subslug)
    @else
        @include('layouts.404')
    @endif
@endif
