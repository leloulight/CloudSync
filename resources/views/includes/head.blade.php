<meta charset="utf-8">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>Cloud Sync</title>

<!-- load bootstrap from a cdn -->

  <link rel="stylesheet" type="text/css" href="{{asset('css/foundation.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('css/login_Style.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('css/Homecss.css')}}"/>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
      if ( $( "#file-send-success" ).length ) {
          
          $("#file-send-success" ).fadeOut(3000);
      }
      
      if($('#registration-success').length){
          
          $('#registration-success').fadeOut(3000);
      }
      
  });    
  </script>