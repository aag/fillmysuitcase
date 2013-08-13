/* global _ */
'use strict';

angular.module('suitcase.controllers', []).
  controller('ListCtrl', function($scope, $http, $resource) {
    var Item = $resource('/item/:id', 
        {id: '@id'});
    $scope.items = Item.query();

    var saveItem = function(item) {
        console.log(item);
        item.$save();
    };

    $scope.change = _.debounce(saveItem, 500);
  });
