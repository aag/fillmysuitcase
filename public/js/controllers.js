'use strict';

angular.module('suitcase.controllers', []).
  controller('ListCtrl', function($scope) {
    $scope.items = [
        {"id": 1, "name": "Socks", "created": 1368745503519, "packed": false},
        {"id": 2, "name": "Pants", "created": 1368644503317, "packed": false},
        {"id": 3, "name": "Shirts", "created": 1368443503202, "packed": true},
        {"id": 4, "name": "Toothbrush + Toothpaste", "created": 1368243503202, "packed": false},
        {"id": 5, "name": "Hat", "created": 1367443503202, "packed": true}
    ];
  });

