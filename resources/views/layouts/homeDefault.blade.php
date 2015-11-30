<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">

@if(Session::has('message'))
<p class="alert-box {{ Session::get('alert-class', 'success radius') }}">{{ Session::get('message') }}</p>
@endif
    <header>
        @include('includes.home.header')
    </header>

    <div id="main" class="large-12 columns">

            @yield('content')

    </div>

    <footer class="row">
        @include('includes.home.footer')
    </footer>

</div>
</body>
</html>

