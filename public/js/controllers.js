'use strict';

angular.module('suitcase.controllers', []).
  controller('ListCtrl', function($scope, $http) {
    $http.get('/list.json').success(function(data) {
        $scope.items = data;
    });
  });

