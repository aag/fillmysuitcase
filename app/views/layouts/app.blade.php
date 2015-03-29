<!DOCTYPE html>
<html lang="en" ng-app="suitcase">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>FillMySuitcase</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ HTML::style('css/bootstrap.min.css', array('media' => 'screen')) }}
    {{ HTML::style('css/bootstrap-theme.min.css', array('media' => 'screen')) }}
    {{ HTML::style('css/styles.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        {{ Html::script('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') }}
        {{ Html::script('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}
    <![endif]-->
</head>

<body class="page-type-@yield('page-type')">
    <header role="banner">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-links-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::route('root') }}">FillMySuitcase</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-links-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        @if (!Auth::user())
                            <li><a href="{{ URL::route('login') }}">Log In</a></li>
                        @else
                            <li class="{{ URL::getRequest()->is('list') ? 'active' : '' }}"><a href="{{ URL::route('listpage') }}">My List</a></li>
                            <li class="{{ URL::getRequest()->is('account') ? 'active' : '' }}"><a href="{{ URL::route('user.edit') }}">{{{ Auth::user()->username }}}</a></li>
                            <li><a href="{{ URL::route('logout') }}">Log Out</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @if (Session::has('errors'))
    <div class="page-errors alert alert-danger">
        <h4>Errors</h4>
        <ul>
        @foreach (Session::get('errors')->getMessages() as $message)
            <li>{{ $message[0] }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    @if (Session::has('success-message'))
    <div class="page-errors alert alert-success">
        {{ Session::get('success-message') }}
    </div>
    @endif

    @yield('content')

    <footer class="footer">
        <div class="container-fluid">
            This site is built on free software. <a href="https://github.com/aag/fillmysuitcase">Get the code</a>.
        </div>
    </footer>

    {{ Html::script('js/libs/jquery-1.9.1.min.js') }}
    {{ Html::script('js/libs/bootstrap.min.js') }}
    {{ Html::script('js/libs/underscore.min.js') }}

    {{ Html::script('js/libs/angular.min.js') }}
    {{ Html::script('js/libs/angular-resource.min.js') }}
    {{ Html::script('js/app.js') }}
    {{ Html::script('js/controllers.js') }}
</body>
</html>

