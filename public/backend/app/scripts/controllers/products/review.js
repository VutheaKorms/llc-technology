'use strict';

angular.module('app')
    .controller('ProductReviewCtrl', function($scope, $http, $state, $stateParams, Notification) {
        var API_URL = 'api/product/review/';

        function loadData() {
            $http({
                method: 'GET',
                url: API_URL,
            }).then(function (success){
                $scope.products = success.data;
            },function (error){
                console.log(error, " can't get data.");
            });
        }

        loadData();

        $scope.goBack = function() {
            window.history.back();
        };

        $scope.back = function() {
            $state.go("dashboard.product");
        }

    });
