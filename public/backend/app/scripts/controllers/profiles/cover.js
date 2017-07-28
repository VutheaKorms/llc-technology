

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
    .controller('CoverCtrl', function(dataFactory,FileUploader,$scope, $state, Notification) {

        var uploader = $scope.uploader = new FileUploader({
            url: 'api/cover/upload'
        });

        uploader.filters.push({
            name: 'imageFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        uploader.onCompleteItem = function(fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
        };

        function goToBack() {
            window.history.back();
        }

        $scope.back = function () {
            goToBack();
        }

        uploader.onCompleteAll = function() {
            Notification.success('Successfully saved');
            loadCovers();
        };

        $scope.edit = function(id){
            dataFactory.httpRequest('api/cover/'+id).then(function(data) {
                console.log(data);
                $scope.form = data;
            });
        }

        function loadCovers() {
            dataFactory.httpRequest('api/cover').then(function(data) {
                $scope.photos = data;
                console.log($scope.photos);
            });
        }

        loadCovers();

        $scope.saveDisable = function(){
            $scope.loading = true;
            dataFactory.httpRequest('api/cover/'+ $scope.form.id ,'DELETE').then(function(data) {
                $(".modal").modal("hide");
                Notification.success('Successfully saved');
                //$scope.loading = false;
                loadCovers();
            });
        }

    });
