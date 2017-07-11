'use strict';

angular.module('main')

    .config(function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    })

    .controller('IdController', function ($scope,$http) {

        var API_URL_CATEGORIES = 'api/categories/status/';

        function loadCategory(status) {
            $http({
                method: 'GET',
                url: API_URL_CATEGORIES + status,
            }).then(function (success){
                $scope.categories = success.data;
                console.log(success);
            },function (error){
                console.log(error, " can't get data.");
            });
        }

        loadCategory(1);

        $scope.data = [];
        $scope.libraryTemp = {};
        $scope.totalItemsTemp = {};
        $scope.totalItems = 0;



        function loadAllProductByCate(status,cateId) {
            $http({
                method: 'GET',
                url: 'api/products/getAll/' + status + '/cate/'+ cateId
            }).then(function (data){
                $scope.data = data.data;
                $scope.totalItems = data.total;
                console.log($scope.data);
            },function (error){
                console.log(error, " can't get data.");
            });
        }

        $scope.showcat = { };
        $scope.setShowCat = function(id){
            $scope.showcat = {category_id: id };
            loadAllProductByCate(1,id);
        }

    });


//
//angular.module('main')
//    .factory('dataFactory', function ($http) {
//        var myService = {
//            httpRequest: function(url,method,params,dataPost,upload) {
//                var passParameters = {};
//                passParameters.url = url;
//                if (typeof method == 'undefined'){
//                    passParameters.method = 'GET';
//                }else{
//                    passParameters.method = method;
//                }
//                if (typeof params != 'undefined'){
//                    passParameters.params = params;
//                }
//                if (typeof dataPost != 'undefined'){
//                    passParameters.data = dataPost;
//                }
//                if (typeof upload != 'undefined'){
//                    passParameters.upload = upload;
//                }
//                var promise = $http(passParameters).then(function (response) {
//                    if(typeof response.data == 'string' && response.data != 1){
//                        if(response.data.substr('loginMark')){
//                            location.reload();
//                            return;
//                        }
//                        $.gritter.add({
//                            title: 'Application',
//                            text: response.data
//                        });
//                        return false;
//                    }
//                    if(response.data.jsMessage){
//                        $.gritter.add({
//                            title: response.data.jsTitle,
//                            text: response.data.jsMessage
//                        });
//                    }
//                    return response.data;
//                },function(){
//                    $.gritter.add({
//                        title: 'Application',
//                        text: 'An error occured while processing your request.'
//                    });
//                });
//                return promise;
//            }
//        };
//        return myService;
//    })
//    .controller('IdController', function(dataFactory,$scope, $state, $stateParams, Notification) {
//        //$scope.id = $stateParams.id;
//        //
//        //$scope.data = [];
//        //$scope.libraryTemp = {};
//        //$scope.totalItemsTemp = {};
//        //$scope.totalItems = 0;
//        //
//        //$scope.pageChanged = function(newPage) {
//        //    getResultsPage(newPage);
//        //};
//        //getResultsPage(1);
//        //
//        //function getResultsPage(pageNumber) {
//        //    if(! $.isEmptyObject($scope.libraryTemp)){
//        //        dataFactory.httpRequest('api/brands?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
//        //            $scope.data = data.data;
//        //            $scope.totalItems = data.total;
//        //            console.log($scope.data);
//        //        });
//        //    }else{
//        //        dataFactory.httpRequest('api/brands?page='+pageNumber).then(function(data) {
//        //            $scope.data = data.data;
//        //            $scope.totalItems = data.total;
//        //            console.log($scope.data);
//        //        });
//        //    }
//        //}
//        //
//        //$scope.searchDB = function(){
//        //    if($scope.searchText.length >= 1){
//        //        if($.isEmptyObject($scope.libraryTemp)){
//        //            $scope.libraryTemp = $scope.data;
//        //            $scope.totalItemsTemp = $scope.totalItems;
//        //            $scope.data = {};
//        //        }
//        //        getResultsPage(1);
//        //    }else{
//        //        if(! $.isEmptyObject($scope.libraryTemp)){
//        //            $scope.data = $scope.libraryTemp ;
//        //            $scope.totalItems = $scope.totalItemsTemp;
//        //            $scope.libraryTemp = {};
//        //        }
//        //        getResultsPage(1);
//        //    }
//        //}
//
//        function loadBrand(status) {
//            dataFactory.httpRequest('api/brands/status/' + status).then(function(data) {
//                $scope.brands = data;
//                console.log($scope.brands);
//            });
//        }
//
//        loadBrand(1);
//
//
//
//
//    });
