<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=1">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link href="{{ asset('/css/schema.min.css') }}" rel="stylesheet">
<link href="{{ asset('/css/aplus_style.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/icon-fonts.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('css/alertify.core.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/alertify.default.css') }}">

<link rel="apple-touch-icon" sizes="180x180" href="/image/meta/logo320.png">
<link rel="apple-touch-icon-precomposed" href="/image/meta/logo320.png">
<link rel="shortcut icon" href="/image/meta/logo320.png">
<link rel="icon" sizes="192x192" href="/image/meta/logo320.png">

<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script type="text/javascript">
  $(window).load(function() {
  function changeWidget() {
    var twFrame = $('iframe.twitter-timeline');
    if (twFrame.length > 0) {
      twFrame.contents()
      .find('head').append('<link href="/css/tw.css" rel="stylesheet" type="text/css" media="all" />');
      } else {
        setTimeout(changeWidget, 1500);
        }
      }
      changeWidget();
   });
</script>
<meta property="og:type" content="website" />
<meta property="og:locale" content="ja_JP" />
<!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
<![endif]-->
