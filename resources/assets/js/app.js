'use strict';

// Declare app level modules
angular.module(
    'suitcase',
    ['ngResource', 'suitcase.controllers'],
    function($interpolateProvider) {
        // Customize the AngularJS symbols so they don't clash with the Blade
        // templating engine.
        $interpolateProvider.startSymbol('{%');
        $interpolateProvider.endSymbol('%}');
    }
);

