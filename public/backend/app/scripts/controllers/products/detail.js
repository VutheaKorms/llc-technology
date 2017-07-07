'use strict';

angular.module('app')
    .controller('ProductDetailCtrl', function($scope, $http, $state, $stateParams, Notification) {
        $scope.id = $stateParams.id;
        var API_URL = 'api/products/';
        var API_URL_PHOTO = 'api/product/review/';

        function loadData() {
            $http({
                method: 'GET',
                url: API_URL + $scope.id,
            }).then(function (success){
                $scope.products = success.data[0];
                console.log($scope.products);
            },function (error){
                console.log(error, " can't get data.");
            });
        }

        loadData();

        function loadDataPhoto() {
            $http({
                method: 'GET',
                url: API_URL_PHOTO + $scope.id,
            }).then(function (success){
                $scope.photos = success.data;
                console.log($scope.photos);
            },function (error){
                console.log(error, " can't get data.");
            });
        }

        loadDataPhoto();

        $scope.goBack = function() {
            window.history.back();
        };

        $scope.back = function() {
            $state.go("dashboard.product");
        }

    });
