'use strict';

angular.module('app')
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
    .controller('ProductCreateCtrl', function(dataFactory,$scope, $state, Notification, $http) {

        $scope.data = [];
        $scope.libraryTemp = {};
        $scope.totalItemsTemp = {};
        $scope.totalItems = 0;

        $scope.selectedBrand = null;
        $scope.brands = [];
        $scope.selectedCategory = null;
        $scope.productCategory = [];

        $scope.selectedColor = "Black";
        $scope.colors = [];
        $scope.selectedType = "New";
        $scope.types = [];
        $scope.editor = '';


        $scope.pageChanged = function(newPage) {
            getResultsPage(newPage);
        };
        getResultsPage(1);

        function getResultsPage(pageNumber) {
            if(! $.isEmptyObject($scope.libraryTemp)){
                dataFactory.httpRequest('api/test').then(function(data) {
                    $scope.users = data;
                    dataFactory.httpRequest('api/products/account/' + $scope.users.id + '?search='+$scope.searchText +'&page='+pageNumber).then(function(data) {
                        $scope.data = data.data;
                        $scope.totalItems = data.total;
                    });
                });
            }else{
                dataFactory.httpRequest('api/test').then(function(data) {
                    $scope.users = data;
                    dataFactory.httpRequest('api/products/account/' + $scope.users.id  +'?page=' +pageNumber).then(function(data) {
                        $scope.data = data.data;
                        $scope.totalItems = data.total;
                    });
                });
            }
        }

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

        $scope.form = {
            product_name: $scope.product_name,
            product_code: $scope.product_code,
            price: $scope.price,
            brand_id: $scope.selectedBrand,
            user_id: $scope.users,
            category_id: $scope.selectedCategory,
            description: $scope.description,
            specification: $scope.specification
        }

        $scope.saveAdd = function(){
            $scope.form.brand_id = $scope.selectedBrand;
            $scope.form.category_id= $scope.selectedCategory;
            $scope.form.type= $scope.selectedType;
            $scope.form.product_color = $scope.selectedColor;
            dataFactory.httpRequest('api/products','POST',{},$scope.form).then(function(data) {
                $scope.data = data;
                Notification.success('Successfully saved');
                clear();
                getResultsPage(1);
                goToUpload();
            });
        }

        function goToUpload() {
            $state.go('dashboard.product-upload');
        }

        $scope.edit = function(id){
            dataFactory.httpRequest('api/products/'+id+'/edit').then(function(data) {
                $scope.form = data;
                $scope.selectedBrand = data.brand_id;
                $scope.selectedCategory = data.category_id;
            });
        }

        $scope.saveEdit = function(){
            $scope.form.brand_id = $scope.selectedBrand;
            $scope.form.category_id= $scope.selectedCategory;
            dataFactory.httpRequest('api/products/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
                $(".modal").modal("hide");
                $scope.data = apiModifyTable($scope.data,data.id,data);
                Notification.success('Successfully saved');
                getResultsPage(1);
            });
        }


        $scope.show = function(id){
            dataFactory.httpRequest('api/products/'+id).then(function(data) {
                $scope.form = data;
            });
        }

        $scope.goBack = function() {
            window.history.back();
        };

        function loadCategory(status) {
            dataFactory.httpRequest('api/test').then(function(data) {
                $scope.users = data;
                dataFactory.httpRequest('api/categories/status/' + status +'/acc/' + $scope.users.id).then(function(data) {
                    $scope.productCategory = data;
                });
            });
        }

        loadCategory(1);

        function loadBrand(status) {
            dataFactory.httpRequest('api/test').then(function(data) {
                $scope.users = data;
                dataFactory.httpRequest('api/brands/status/' + status +'/acc/' + $scope.users.id).then(function(data) {
                    $scope.brands = data;
                });
            });
        }

        loadBrand(1);

        function clear() {
            $scope.form.description = "";
            $scope.form.product_name= "";
            $scope.form.product_code="";
            $scope.form.price= "";
            $scope.selectedBrand = null;
            $scope.selectedCategory = null;
        }

        $scope.saveDisable = function(){
            $scope.loading = true;
            dataFactory.httpRequest('api/products/disable/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
                $(".modal").modal("hide");
                $scope.data = apiModifyTable($scope.data,data.id,data);
                Notification.success('Successfully saved');
                $scope.loading = false;
                getResultsPage(1);
            });
        }


        $scope.types = [
            { "id" : "New","name" : "New"},
            { "id" : "Used","name" : "Used"},
        ];

        $scope.colors = [
            { "id" : "Black","name" : "Black"},
            { "id" : "Blue","name" : "Blue"},
            { "id" : "Orange","name" : "Orange"},
            { "id" : "Red","name" : "Red"},
            { "id" : "White","name" : "White"},
            { "id" : "Silver","name" : "Silver"},
            { "id" : "Brown","name" : "Brown"},
            { "id" : "Green","name" : "Green"},
            { "id" : "Yellow","name" : "Yellow"},
            { "id" : "Lime","name" : "Lime"},
            { "id" : "Purple","name" : "Purple"},
            { "id" : "Olive","name" : "Olive"},
            { "id" : "Cyan","name" : "Cyan"},
            { "id" : "Maroon","name" : "Maroon"},
            { "id" : "DarkBlue","name" : "DarkBlue"},
        ];

    });
