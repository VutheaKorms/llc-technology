
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
    .controller('MainCtrl', function(dataFactory,$scope, $state, $stateParams, Notification) {

      getResultsPage(1);

        function getResultsPage(pageNumber) {

                dataFactory.httpRequest('api/test').then(function(data) {
                    $scope.users = data;
                    dataFactory.httpRequest('api/brands/account/' + $scope.users.id  +'?page=' +pageNumber).then(function(data) {
                        $scope.data = data.data;
                        $scope.totalItems = data.total;
                        $scope.totalBrands = $scope.totalItems;
                    });

                    dataFactory.httpRequest('api/categories/account/' + $scope.users.id  +'?page=' +pageNumber).then(function(data) {
                        $scope.data = data.data;
                        $scope.totalItems = data.total;
                        $scope.totalCategories = $scope.totalItems;
                    });

                    dataFactory.httpRequest('api/products/account/' + $scope.users.id  +'?page=' +pageNumber).then(function(data) {
                        $scope.data = data.data;
                        $scope.totalItems = data.total;
                        $scope.totalProducts = $scope.totalItems;
                    });
                });

        }

    });
