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
                        title: 'Application',
                        text: 'An error occured while processing your request.'
                    });
                });
                return promise;
            }
        };
        return myService;
    })

    .controller('IdController', function (dataFactory,$scope) {

        $scope.limit = 4;
        $scope.data = [];
        $scope.libraryTemp = {};
        $scope.totalItemsTemp = {};
        $scope.totalItems = 0;

        $scope.pageChanged = function(newPage) {
            getResultsPage(newPage);
        };

        function loadCategory(status) {
            dataFactory.httpRequest('api/categories/status/' + status).then(function(data) {
                $scope.productCategory = data;
                //console.log($scope.productCategory);
            });
        }

        loadCategory(1);

        getResultsPage(1);

        function getResultsPage(pageNumber) {
            if(! $.isEmptyObject($scope.libraryTemp)){
                dataFactory.httpRequest('api/products?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
                    $scope.data = data.data;
                    $scope.totalItems = data.total;
                    //console.log($scope.data);
                });
            }else{
                dataFactory.httpRequest('api/products?page='+pageNumber).then(function(data) {
                    $scope.data = data.data;
                    $scope.totalItems = data.total;
                    $scope.images = [];
                    //console.log($scope.data);
                    //console.log("--------");
                    for (var key in $scope.data) {

                        var pro_id = $scope.data[key].id;
                        //console.log(key);
                        dataFactory.httpRequest('api/getImages/' + pro_id).then(function(data) {
                            //$scope.images["'" + pro_id + "'"] = data[0];
                            //$scope.images = data[0];
                            //console.log($scope.images["'" + pro_id + "'"]);

                            //$scope.totalItems = data.total;
                            //console.log(allPro[key]);
                            //$scope.data[key].id = "fdaf";///.images = data;
                        });

                    }
                });



            }
        }

        //function loadProductImages(pageNumber) {
        //    dataFactory.httpRequest('api/images?page=' + pageNumber).then(function(data) {
        //        $scope.productPhotos = data.data;
        //        $scope.totalItems = data.total;
        //        console.log($scope.productPhotos);
        //    });
        //}
        //
        //loadProductImages(1);

        $scope.searchDB = function(){
            if($scope.searchText.length >= 1){
                if($.isEmptyObject($scope.libraryTemp)){
                    $scope.libraryTemp = $scope.data;
                    $scope.totalItemsTemp = $scope.totalItems;
                    $scope.data = {};
                }
                getResultsPage(1);
            }else{
                if(! $.isEmptyObject($scope.libraryTemp)){
                    $scope.data = $scope.libraryTemp ;
                    $scope.totalItems = $scope.totalItemsTemp;
                    $scope.libraryTemp = {};
                }
                getResultsPage(1);
            }
        }


        $scope.showcat = { };
        $scope.setShowCat = function(id){
            $scope.showcat = {category_id: id };
            getResultsPage(1,id);
        }

        $scope.setAllPro = function() {
            $scope.showcat = { };
            getResultsPage(1);
        }

    });



