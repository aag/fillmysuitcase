<!DOCTYPE html>
<html lang="en" ng-app="suitcase">
<head>
    <title>Fill My Suitcase</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @stack('meta-tags')

    <link href="{{ mix('css/styles.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <link href="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js" rel="stylesheet">
        <link href="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" rel="stylesheet">
    <![endif]-->
</head>

<body class="page-type-@yield('page-type')">
    <header role="banner">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-links-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{ URL::route('root') }}">Fill My Suitcase</a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-links-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::guest())
                                <li><a href="/login">Log In</a></li>
                            @else
                                <li class="{{ URL::getRequest()->is('list') ? 'active' : '' }}"><a href="{{ URL::route('listpage') }}">My List</a></li>
                                <li class="{{ URL::getRequest()->is('account') ? 'active' : '' }}"><a href="/account">{{ Auth::user()->username }}</a></li>
                                <li><a href="/logout">Log Out</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    @if (Session::has('errors'))
    <div class="container-fluid messages-holder">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="page-errors alert alert-danger">
                    <h4>Errors</h4>
                    <ul>
                    @foreach (Session::get('errors')->getMessages() as $message)
                        <li>{{ $message[0] }}</li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Session::has('success-message'))
    <div class="container-fluid messages-holder">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="page-errors alert alert-success">
                    {{ Session::get('success-message') }}
                </div>
            </div>
        </div>
    </div>
    @endif

    @yield('content')

    <footer class="footer">
        <div class="container">
            This site is built on free software. <a href="https://github.com/aag/fillmysuitcase">Get the code</a>.
        </div>
    </footer>

    @if (config('view.cdn_js_libs'))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular-resource.min.js"></script>
    @else
        <script src="/js/libs/jquery.min.js"></script>
        <script src="/js/libs/underscore.min.js"></script>

        <script src="/js/libs/angular.min.js"></script>
        <script src="/js/libs/angular-resource.min.js"></script>
    @endif

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

