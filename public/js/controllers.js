'use strict';

angular.module('suitcase.controllers', []).
  controller('ListCtrl', function($scope, $http, $resource) {
    var Item = $resource('/item/:itemId');
    $scope.items = Item.query();
  });

