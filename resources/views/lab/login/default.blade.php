<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>Artisan Lab - Admin CMS - 2.0</title>
<link rel="stylesheet" href="{{url('assets/lab/css/style.default.css')}}" type="text/css" />
<link rel="shortcut icon" type="image/x-icon" href="{{url('assets/lab/images/favicon.png')}}">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

<script src="{{url('assets/lab/js/jquery-1.10.2.min.js')}}"></script>
<script src="{{url('assets/lab/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{url('assets/lab/js/jquery-ui-1.10.3.min.js')}}"></script>
<script src="{{url('assets/lab/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/lab/js/modernizr.min.js')}}"></script>
<script src="{{url('assets/lab/js/jquery.cookies.js')}}"></script>
<script src="{{url('assets/lab/js/custom.js')}}"></script>

</head>

<body class="loginpage">

<div class="loginpanel">
    <div class="loginpanelinner">
        
        <div class="logo animate0 bounceIn"><img src="{{url('assets/lab/images/logo.png')}}" alt="" /></div>
        <form id="login" action="{{action('Lab\LoginController@authenticate')}}" method="post">
        {{ csrf_field() }}

            @if (session('error'))
            <div class="login-alert" style="display: block;">
                <div class="alert alert-error">Le credenziali sono errate</div>
            </div>
            @endif
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email" autofocus />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Password" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Login</button>
            </div>
            
        </form>
        
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<div class="loginfooter">
    <p>&copy; {{date('Y')}}. {{trans('lab.dev_company')}} - {{trans('lab.cms_name')}}. {{trans('lab.cms_rights')}}</p>
</div>

</body>
</html>