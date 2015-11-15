@extends('layouts.default')
@section('content')
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Computer Name</title>
        <link rel="stylesheet" href="css/foundation.css" />
        <script src="js/vendor/modernizr.js"></script>
    </head>
    <body>

        <div class="row">
            <div class="large-12 columns">
                <h1>Logged in from a new computer</h1>
            </div>
        </div>

        <form>

            <div class="row">
                <div class="large-12 columns">
                    <div class="panel">

                        <label>Name your Computer!</label>
                        <input type="text" placeholder="Computer Name" />

                        <div class = "row">
                            <br/><p><a href="#" class="small round button">Save</a><br/></p>
                        </div>
                    </div>
                </div>

            </div>

        </form>


        <script src="js/vendor/jquery.js"></script>
        <script src="js/foundation.min.js"></script>
        <script>
            $(document).foundation();
        </script>
    </body>
</html>
@stop




