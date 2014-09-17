<!DOCTYPE html>
<html lang="en" ng-app="suitcase">
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
                @if (!Auth::user())
                    <li class="{{ URL::getRequest()->is('/') ? 'active' : '' }}"><a href="{{ URL::route('root') }}">Home</a></li>
                    <li><a href="{{ URL::route('login') }}">Log In</a></li>
                @else
                    <li class="{{ URL::getRequest()->is('list') ? 'active' : '' }}"><a href="{{ URL::route('listpage') }}">Home</a></li>
                    <li class="{{ URL::getRequest()->is('account') ? 'active' : '' }}"><a href="{{ URL::route('user.edit') }}">{{{ Auth::user()->username }}}</a></li>
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

        @if (Session::has('success-message'))
        <div class="page-errors alert alert-success">
            {{ Session::get('success-message') }}
        </div>
        @endif

        @yield('content')

        <hr>

        <div class="footer">
            This site is built on free software. <a href="https://github.com/aag/fillmysuitcase">Get the code</a>.
        </div>
    </div>

    {{ Html::script('js/libs/jquery-1.9.1.min.js') }}
    {{ Html::script('js/libs/bootstrap.min.js') }}
    {{ Html::script('js/libs/underscore.min.js') }}

    {{ Html::script('js/libs/angular.min.js') }}
    {{ Html::script('js/libs/angular-resource.min.js') }}
    {{ Html::script('js/app.js') }}
    {{ Html::script('js/controllers.js') }}
</body>
</html>

