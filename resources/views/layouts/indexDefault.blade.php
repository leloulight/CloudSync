
<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
<div class="container">



    <header>
        @include('includes.index.header')
    </header>

    <div id="main" class="large-12 columns">

            @yield('content')

    </div>

    <footer class="row">
        @include('includes.index.footer')
    </footer>

</div>
</body>
</html>
