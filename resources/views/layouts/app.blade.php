<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.0/css/bulma.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
     @yield('styles')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div class="preloader">
    <div class="img">
      <!-- <img src="/img/loader.gif" alt="Preloader image"> -->
      <span>Loading...</span>
    </div>
</div>
<div id="app">
    @include('layouts/partials/nav')
    
    <section class="section">
        <div class="container">
            @yield('content')
        </div>
    </section>


     <alert :type="message.type" v-show="message.show" >@{{ message.text }}</alert> 
    @if (session()->has('flash_message'))

      <alert type="{!! session()->get('flash_message_level') !!}" >{!! session()->get('flash_message') !!}</alert>

    @endif
    
</div>

    <!-- Scripts -->

    <script src="{{ mix('js/app.js') }}"></script>
    
    @yield('scripts')
</body>
</html>
