/* global _ */
'use strict';

angular.module('suitcase.controllers', []).
  controller('ListCtrl', function($scope, $http, $resource, $timeout) {
    var Item = $resource('/item/:id', 
                         {id: '@id'},
                         {unpackAll: {method: 'POST', url: '/list/unpackall', isArray: true}});
    $scope.items = Item.query();
    $scope.newName = '';

    var saveItem = function(item, hideCheck) {
        item.$save(function() {
            if (!hideCheck) {
                item.justSaved = true;
                $timeout(function() {
                    item.justSaved = false;
                }, 1000);
            }
        });
    };

    $scope.change = _.debounce(saveItem, 1000);

    $scope.checkChange = function(item) {
        saveItem(item, true);
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
        Item.unpackAll({}, function(response) {
            $scope.items = response;
        });
    };

  });
