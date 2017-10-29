<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ fullTitle() }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    <link href="/css/admin/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/css/admin/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/css/admin/animate.css" rel="stylesheet">
    <link href="/css/admin/style.css" rel="stylesheet">
    <style>
        .required:after {
            color: red;
            content: ' *';
        }
    </style>
</head>

<body class="gray-bg">
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">M+</h1>

        </div>
        <h3>Welcome to M+</h3>

        <p>Login in. To see it in action.</p>

        <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}"
                       required
                       autofocus>
                @if ($errors->has('email'))
                    <span class="help-block" style="text-align: left;">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="help-block" style="text-align: left;">
                    {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <div class="form-group i-checks" style="text-align: left;">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><i></i>
                    Remember me
                </label>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <a href="{{ route('password.request') }}">
                <small>Forgot password?</small>
            </a>
        </form>
    </div>
</div>

<!-- Mainly scripts -->
<script src="/js/admin/jquery-3.1.1.min.js"></script>
<script src="/js/admin/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/js/admin/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>
</html>
