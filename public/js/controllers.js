'use strict';

angular.module('suitcase.controllers', []).
  controller('ListCtrl', function($scope, $http, $resource) {
    var Item = $resource('/item/:id', 
        {id: '@id'},
        {update: {method:'PUT'}, isArray: false});
    $scope.items = Item.query();

    var saveItem = function(item) {
        console.log(item);
        item.$update();
    };

    $scope.change = _.debounce(saveItem, 500);
  });
