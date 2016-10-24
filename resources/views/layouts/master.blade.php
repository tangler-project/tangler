<!DOCTYPE html>
<html lang="en">

    @include('partials.header')

    <body>

    	@include('partials.logo')

        @yield('content')

    	@include('partials.footer')

        @yield('scripts')

    </body>
</html>