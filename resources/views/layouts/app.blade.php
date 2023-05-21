<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<style>
    *{
        font-family: sans-serif;
    }
</style>

<body>
    {{-- Header --}}
    <header class="primary" style="top: 0px;">
        @include('frontend.partials.header')
        @include('frontend.partials.nav')
    </header>
    {{-- Home --}}
    @yield('content')
    @include('frontend.partials.footer')
    @include('layouts.footer')
</body>

</html>
