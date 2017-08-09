
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
    .controller('ProfileCtrl', function(dataFactory,$scope, $state, $stateParams, Notification, md5) {
        $scope.id = $stateParams.id;
        $scope.data = [];

        $scope.inputType = 'password';

        // Hide & show password function
        $scope.hideShowPassword = function(){
            if ($scope.inputType == 'password')
                $scope.inputType = 'text';
            else
                $scope.inputType = 'password';
        };

        getResultsPage();

        function getResultsPage() {
                dataFactory.httpRequest('api/test').then(function(data) {
                    $scope.data = data;
                });
        }


        $scope.form = {
            name: $scope.name,
            email: $scope.email,
            password: $scope.password,
        }

        $scope.saveAdd = function(){
            $scope.loading = true;
            dataFactory.httpRequest('api/users','POST',{},$scope.form).then(function(data) {
                $scope.data.push(data);
                $(".modal").modal("hide");
                Notification.success('Successfully saved');
                $scope.loading = false;
                clear();
                getResultsPage();
            });
        }

        $scope.edit = function(id){
            dataFactory.httpRequest('api/users/'+id+'/edit').then(function(data) {
                $scope.form = data;
            });
        }
        $scope.saveEdit = function(){
            $scope.loading = true;
            dataFactory.httpRequest('api/users/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
                $(".modal").modal("hide");
                $scope.data = apiModifyTable($scope.data,data.id,data);
                console.log($scope.data);
                Notification.success('Successfully saved');
                $scope.loading = false;
                getResultsPage();
            });
        }

        $scope.show = function(id){
            dataFactory.httpRequest('api/users/'+id).then(function(data) {
                $scope.form = data;
            });
        }

        $scope.remove = function(item,index){
            var result = confirm("Are you sure delete this user?");
            if (result) {
                dataFactory.httpRequest('api/users/'+item.id,'DELETE').then(function(data) {
                    Notification.success('Successfully deleted');
                    $scope.data.splice(index,1);
                    getResultsPage();
                });
            }
        }

        $scope.saveEnable = function(){
            $scope.loading = true;
            dataFactory.httpRequest('api/user/enable/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
                $(".modal").modal("hide");
                $scope.data = apiModifyTable($scope.data,data.id,data);
                Notification.success('Successfully saved');
                $scope.loading = false;
                getResultsPage();
            });
        }

        $scope.saveDisable = function(){
            $scope.loading = true;
            dataFactory.httpRequest('api/user/disable/'+$scope.form.id,'PUT',{},$scope.form).then(function(data) {
                $(".modal").modal("hide");
                $scope.data = apiModifyTable($scope.data,data.id,data);
                Notification.success('Successfully saved');
                $scope.loading = false;
                getResultsPage();
            });
        }

        $scope.goBack = function() {
            window.history.back();
        };

        function clear() {
            $scope.form.name = "";
            $scope.form.email = "";
            $scope.form.password ="";
        }

    });

