<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">



</head>
<body>
    <div id="app" class="h-screen flex items-center justify-center bg-teal-lightest font-sans">
        <main class="py-6">
            @if (session('message'))
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="alert alert-{{session('message')[0]}}">
                        <h4 class="alert-heading">{{ __("Mensaje informativo")  }}</h4>
                        <p> {{ session('message')[1] }}</p>
                    </div>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

<script src="{{ asset('js/app.js') }}"> </script>

</body>
</html>
