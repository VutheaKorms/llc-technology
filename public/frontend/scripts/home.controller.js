

'use strict';

angular.module('app')

    .config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    })

    .factory('dataFactory', function ($http) {
        var myService = {
            httpRequest: function(url,method,params,dataPost,upload) {
                var passParameters = {};
                passParameters.url = url;
                if (typeof method == 'undefined'){
                    passParameters.method = 'GET';
                }else{
                    passParameters.method = method;
                }
                if (typeof params != 'undefined'){
                    passParameters.params = params;
                }
                if (typeof dataPost != 'undefined'){
                    passParameters.data = dataPost;
                }
                if (typeof upload != 'undefined'){
                    passParameters.upload = upload;
                }
                var promise = $http(passParameters).then(function (response) {
                    if(typeof response.data == 'string' && response.data != 1){
                        if(response.data.substr('loginMark')){
                            location.reload();
                            return;
                        }
                        $.gritter.add({
                            title: 'Application',
                            text: response.data
                        });
                        return false;
                    }
                    if(response.data.jsMessage){
                        $.gritter.add({
                            title: response.data.jsTitle,
                            text: response.data.jsMessage
                        });
                    }
                    return response.data;
                },function(){
                    $.gritter.add({
                        //title: 'Application',
                        //text: 'An error occured while processing your request.'
                    });
                });
                return promise;
            }
        };
        return myService;
    })

    .filter('encodeURIComponent', function() {
        return window.encodeURIComponent;
    })

    .controller('IdController', function (dataFactory,$scope, $http) {

        $scope.limit = 4;
        $scope.data = [];
        $scope.libraryTemp = {};
        $scope.totalItemsTemp = {};
        $scope.totalItems = 0;
        $scope.selectedprop = {};
        $scope.selectedBrands = {};

        $scope.getId = function (id) {
            loadCategoryByBrand(1,id);
        }

        function loadCategoryByBrand(status,brand_id) {
            dataFactory.httpRequest('api/categories/status/' + status + '/brand/' + brand_id).then(function(data) {
                $scope.Category = data;
            });
        }

        function loadSlider() {
            dataFactory.httpRequest('api/cover').then(function(data) {
                $scope.slider = data;
            });
        }

        loadSlider();

        $scope.pageChanged = function(newPage) {
            getResultsPage(newPage);
        };

        function loadBrand(status) {
            dataFactory.httpRequest('api/brands/status/' + status).then(function(data) {
                $scope.brands = data;;
            });
        }

        loadBrand(1);

        function loadCategory(status) {
            dataFactory.httpRequest('api/categories/status/' + status).then(function(data) {
                $scope.productCategory = data;
            });
        }


        $scope.getAll = function () {
            if(! $.isEmptyObject($scope.libraryTemp)){
                $scope.data = $scope.libraryTemp ;
                $scope.totalItems = $scope.totalItemsTemp;
                $scope.libraryTemp = {};
                $scope.loading = false;
            }
            getResultsPage(1);
        }

        $scope.searchDB1 = function(id){
            $scope.loading = true;
            if($scope.selectedprop = id){
                if($.isEmptyObject($scope.libraryTemp)){
                    $scope.libraryTemp = $scope.data;
                    $scope.totalItemsTemp = $scope.totalItems;
                    $scope.data = {};
                    $scope.loading = false;
                }
                getResultsPage(1);
            }else{
                if(! $.isEmptyObject($scope.libraryTemp)){
                    $scope.data = $scope.libraryTemp ;
                    $scope.totalItems = $scope.totalItemsTemp;
                    $scope.libraryTemp = {};
                    $scope.loading = false;
                }
                getResultsPage(1);
            }
        }

        loadCategory(1);

        getResultsPage(1);

        function getResultsPage(pageNumber) {

            $scope.loading = true;
            if(! $.isEmptyObject($scope.libraryTemp)){
                dataFactory.httpRequest('api/product?search='+$scope.searchText+'&page='+pageNumber + '&category_id=' + $scope.selectedprop + '&brand_id=' + $scope.selectedBrands).then(function(data) {
                    $scope.data = data.data;
                    $scope.totalItems = data.total;;
                    $scope.loading = false;
                });
            }else{
                    dataFactory.httpRequest('api/product?page='+pageNumber).then(function(data) {
                    $scope.data = data.data;
                    $scope.totalItems = data.total;
                    $scope.loading = false;
                });

            }
        }

        $scope.mySortFunction = function(value) {
            if(isNaN(value[$scope.sortExpression]))
                return value[$scope.sortExpression];
            return parseInt(value[$scope.sortExpression]);
        }

        $scope.filterByBrandID = function(id){
            $scope.selectedBrands = id;
            console.log($scope.selectedBrands);
            $scope.loading = true;
            if($scope.selectedBrands = id){
                if($.isEmptyObject($scope.libraryTemp)){
                    $scope.libraryTemp = $scope.data;
                    $scope.totalItemsTemp = $scope.totalItems;
                    $scope.data = {};
                    $scope.loading = false;
                }
                getResultsPage(1);
            }else{
                if(! $.isEmptyObject($scope.libraryTemp)){
                    $scope.data = $scope.libraryTemp ;
                    $scope.totalItems = $scope.totalItemsTemp;
                    $scope.libraryTemp = {};
                    $scope.loading = false;
                }
                getResultsPage(1);
            }
        }


        //$scope.searchDB = function(){
        //    $scope.loading = true;
        //    if($scope.searchText.length >= 0){
        //        if($.isEmptyObject($scope.libraryTemp)){
        //            $scope.libraryTemp = $scope.data;
        //            $scope.totalItemsTemp = $scope.totalItems;
        //            $scope.data = {};
        //            $scope.loading = false;
        //        }
        //        getResultsPage(1);
        //    }else {
        //        if(! $.isEmptyObject($scope.libraryTemp)){
        //            $scope.data = $scope.libraryTemp ;
        //            $scope.totalItems = $scope.totalItemsTemp;
        //            $scope.libraryTemp = {};
        //            $scope.loading = false;
        //        }
        //        getResultsPage(1);
        //    }
        //}

    });



