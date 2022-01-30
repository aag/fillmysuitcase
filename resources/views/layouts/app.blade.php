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
    <header class="page-header navbar navbar-expand-sm navbar-light justify-content-between bg-light" role="navigation">
        <a class="navbar-brand" href="/">Fill My Suitcase</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
            @if (Auth::check())
                <li class="nav-item{{ Route::is('listpage') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ URL::route('listpage') }}" dusk="my-list-link">My List{!! URL::getRequest()->is('list') ? ' <span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                <li class="nav-item{{ Route::is('account.getedit') ? ' active' : '' }}">
                    <a class="nav-link" href="/account" dusk="account-link">{{ Auth::user()->username }}{!! URL::getRequest()->is('account') ? ' <span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout" dusk="log-out-link">Log Out</a>
                </li>
            @else
                <li class="nav-item active">
                    <a href="/login" class="nav-link" dusk="log-in-link">Log In</a>
                </li>
            @endif
            </ul>
        </div>
    </header>

    @if (Session::has('errors'))
    <div class="container messages-holder">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-xl-6">
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
    <div class="container messages-holder">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-xl-6">
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

    @if (env('VIEW_CDN_JS_LIBS', true))
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.2/underscore-min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular-resource.min.js"></script>
    @else
        <script src="/js/libs/jquery.min.js"></script>
        <script src="/js/libs/underscore.min.js"></script>

        <script src="/js/libs/angular.min.js"></script>
        <script src="/js/libs/angular-resource.min.js"></script>
    @endif

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

