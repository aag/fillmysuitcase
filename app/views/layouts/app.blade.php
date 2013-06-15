<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FillMySuitcase</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ HTML::style('css/bootstrap.min.css', array('media' => 'screen')) }}
    {{ HTML::style('css/bootstrap-responsive.min.css', array('media' => 'screen')) }}
    {{ HTML::style('css/styles.css') }}
</head>

<body>
    <div class="container-narrow">
        <div class="masthead">
            <ul class="nav nav-pills pull-right">
                <li class="active"><a href="{{ URL::route('root') }}">Home</a></li>
                @if (!Auth::user())
                    <li><a href="{{ URL::route('login') }}">Log In</a></li>
                @else
                    <li><a href="#">{{ Auth::user()->username }}</a></li>
                    <li><a href="{{ URL::route('logout') }}">Log Out</a></li>
                @endif
            </ul>
            <h3 class="muted rootlink"><a href="{{ URL::route('root') }}">FillMySuitcase</a></h3>
        </div>

        <hr />

        @if (Session::has('errors'))
        <div class="page-errors alert alert-error">
            <h4>Errors</h4>
            <ul>
            @foreach (Session::get('errors')->getMessages() as $message)
                <li>{{ $message[0] }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        @yield('content')

    </div>
    <script src="//code.jquery.com/jquery-1.9.1.min.js"></script>
    {{ Html::script('js/bootstrap.min.js') }}
</body>
</html>

