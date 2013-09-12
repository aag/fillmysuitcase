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

    $scope.checkChange = function(item) {
        saveItem(item);
    };

    $scope.submit = function() {
        var that = this;
        var newItem = new Item();
        newItem.name = this.newName;

        newItem.$save(function(i) {
            that.items.push(i);
            that.newName = '';
        });
    };

    $scope.delete = function(item) {
        item.confirmingDelete = true;
    };

    $scope.confirmDelete = function(item) {
        _.each(this.items, function(scopeItem, i) {
            if (scopeItem.id === item.id) {
                // Send the delete to the server
                item.$delete({id: item.id}, function() {
                    // On success, remove from the scope's Item collection
                    $scope.items.splice(i, 1);
                });
            }
        });
    };

    $scope.cancelDelete = function(item) {
        delete item.confirmingDelete;
    };

    $scope.resetPacked = function() {
        _.map(this.items, function(item) {
            item.packed = false;
            return item;
        });

        _.each(this.items, function(item) {
            item.$save();
        });
    };

  });
