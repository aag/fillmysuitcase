/* global _ */
'use strict';

angular.module('suitcase.controllers', []).
  controller('ListCtrl', function($scope, $http, $resource) {
    var Item = $resource('/item/:id', 
        {id: '@id'});
    $scope.items = Item.query();
    $scope.newName = '';

    var saveItem = function(item) {
        item.$save();
    };

    $scope.change = _.debounce(saveItem, 500);

    $scope.submit = function() {
        var that = this;
        var newItem = new Item();
        newItem.name = this.newName;

        newItem.$save(function(i) {
            that.items.push(i);
            that.newName = '';
        });
    };

  });
