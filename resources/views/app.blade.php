<!doctype html>
<html class="" lang="{{ app()->getLocale() }}">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
        <meta name="token" content="{{csrf_token()}}">
        <meta name="theme-color" content="#000000">

        <title>{{env('APP_NAME', '')}}</title>
        <link rel="shortcut icon" href="{{asset('img/logo128x128.png')}}">
        <!-- <link rel="manifest" href="{{asset('manifest.json')}}"> -->
        
        <meta name="description" content="">
        <meta name="HandheldFriendly" content="True">
        <base href="{{url('/')}}">

        <meta name="ogTitle" property="og:title" content="{{env('APP_NAME', 'ABM')}}">
        <meta name="ogDescription" property="og:description" content="">
        <meta name="ogImage" property="og:image" content="{{asset('img/logo128x128.png')}}">
        <meta name="ogUrl" property="og:url" content="{{url('/')}}">

        <meta name="apple-mobile-web-app-title" content="{{env('APP_NAME', 'ABM')}}">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link rel="apple-touch-icon" href="{{asset('img/logo128x128.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/logo128x128.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/logo128x128.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('img/logo128x128.png')}}">

        @stack('meta')
        
        <!-- Bulma -->
        <link type="text/css" rel="stylesheet" href="{{asset('vendor/bulma-0.9.3/bulma.css')}}">
        
        <!-- Font Family -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
        
        <!-- Font -->
        <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <!-- Select2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css"/>

        <!-- Izttoast -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" integrity="sha512-DIW4FkYTOxjCqRt7oS9BFO+nVOwDL4bzukDyDtMO7crjUZhwpyrWBFroq+IqRe6VnJkTpRAS6nhDvf0w+wHmxg==" crossorigin="anonymous" />
        
        <!-- NProgress -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha512-42kB9yDlYiCEfx2xVwq0q7hT4uf26FUgSIZBK8uiaEnTdShXjwr8Ip1V4xGJMg3mHkUt9nNuTDxunHF0/EgxLQ==" crossorigin="anonymous" />

        <!-- Bulma Calendar -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-calendar@6.0.9/dist/css/bulma-calendar.min.css">

        <!-- Datatables -->
        <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bulma.css"/>
        <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
        <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/select/1.3.2/css/select.dataTables.min.css">

        <!-- Internal src -->
        <link type="text/css" rel="stylesheet" href="{{asset('css/app.css')}}?v=1">
        <link type="text/css" rel="stylesheet" href="{{asset('css/bulma-steps.css')}}">

        <!-- Sweet Alert -->
        <!-- <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.3.3/sweetalert2.min.css"> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles">

        <script>
            var base_url = document.getElementsByTagName('base')[0].getAttribute('href') + '/';
        </script>
    </head>
    <body>
        @yield('content')
    </body>
    
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" integrity="sha256-ihAoc6M/JPfrIiIeayPE9xjin4UWjsx2mjW/rtmxLM4=" crossorigin="anonymous"></script>
    
    <!-- Jquery Validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_id.min.js" integrity="sha512-Pb0klMWnom+fUBpq+8ncvrvozi/TDwdAbzbICN8EBoaVXZo00q6tgWk+6k6Pd+cezWRwyu2cB+XvVamRsbbtBA==" crossorigin="anonymous"></script>
    
    <!-- Jquery Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- Izttoast -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous"></script>

    <!-- NProgress -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js" integrity="sha512-bUg5gaqBVaXIJNuebamJ6uex//mjxPk8kljQTdM1SwkNrQD7pjS+PerntUSD+QRWPNJ0tq54/x4zRV8bLrLhZg==" crossorigin="anonymous"></script>

    <!-- Bulma Calendar -->
    <script src="https://cdn.jsdelivr.net/npm/bulma-calendar@6.0.9/dist/js/bulma-calendar.min.js"></script>

    <!-- Auto Numeric -->
    <script src="https://unpkg.com/autonumeric@4.5.4/dist/autoNumeric.min.js"></script>
    
    <!-- Sweet Alert -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.3.3/sweetalert2.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.5.0/dist/sweetalert2.all.min.js"></script>

    <!-- Datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bulma.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.2/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.0.2/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>

    <!-- CK Editor -->
    <!-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> -->
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- internal src -->
    <!-- <script type="text/javascript" src="{{asset('vendor/numeral-2.0.6.min.js')}}"></script>-->
    
    <script type="text/javascript" src="{{asset('js/app-bulma.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/number-currency-helper.js')}}"></script>
    @stack('scripts')
</html>