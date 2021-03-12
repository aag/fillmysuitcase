'use strict';

window._ = require('lodash');
require('bootstrap');

// Declare app level modules
angular.module(
    'suitcase',
    ['ngResource', 'suitcase.controllers'],
    ['$interpolateProvider', function($interpolateProvider) {
        // Customize the AngularJS symbols so they don't clash with the Blade
        // templating engine.
        $interpolateProvider.startSymbol('{%');
        $interpolateProvider.endSymbol('%}');
    }]
);

