<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">

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
