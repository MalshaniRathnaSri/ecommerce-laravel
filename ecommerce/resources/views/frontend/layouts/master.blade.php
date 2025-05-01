<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Believe</title>

    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('frontend/font-awesome/css/font-awesome.css')}}" rel='stylesheet' type='text/css'>
      
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    
    <link href="frontend/style.css" rel="stylesheet">
    <link href="frontend/responsive.css" rel="stylesheet">
    
    <link href="{{ asset('frontend/css/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.theme.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/css/owl.transitions.css')}}" rel="stylesheet"> 
      
    <link href="{{asset ('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
  </head>
  <body>

      <div id="wrapper" class="homepage-1"> 
          <div id="header">
            <div>
                @include('frontend/layouts/topnavbar')
            </div>
            
            <div>
                @include('frontend/layouts/navbar')
            </div>
           
            <div>
                @yield('content')
            </div>

            <div>
                @include('frontend/layouts/footer')
            </div>
      </div>

    <script src="{{ asset('frontend/js/library.js')}}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.raty.js')}}"></script>
    <script src="{{ asset('frontend/js/ui.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.selectbox-0.2.js')}}"></script>
    <script src="{{ asset('frontend/js/theme-script.js')}}"></script>
  </body>
</html>