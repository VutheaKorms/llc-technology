
'use strict';

angular.module('app')

    .controller('ProductEditUploadCtrl', ['$scope', 'FileUploader','$state','Notification','$stateParams','$http', function($scope, FileUploader, $state, Notification, $stateParams,$http) {

       // $scope.id = $stateParams.id;
        var uploader = $scope.uploader = new FileUploader({
            url: 'api/test/upload/' + $stateParams.id
        });


        var API_URL_PHOTO = 'api/product/review/';

        uploader.filters.push({
            name: 'imageFilter',
            fn: function(item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });


        function goToBack() {
            $state.go('dashboard.product');
        }

        $scope.back = function () {
            goToBack();
        }

        $scope.goBack = function() {
            window.history.back();
        };

        function loadDataPhoto() {
            $http({
                method: 'GET',
                url: API_URL_PHOTO + $stateParams.id,
            }).then(function (success){
                $scope.photos = success.data;
                console.log($scope.photos);
            },function (error){
                console.log(error, " can't get data.");
            });
        }

        loadDataPhoto();

        // CALLBACKS

        //uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        //    console.info('onWhenAddingFileFailed', item, filter, options);
        //};
        //uploader.onAfterAddingFile = function(fileItem) {
        //    console.info('onAfterAddingFile', fileItem);
        //};
        //uploader.onAfterAddingAll = function(addedFileItems) {
        //    console.info('onAfterAddingAll', addedFileItems);
        //};
        //uploader.onBeforeUploadItem = function(item) {
        //    console.info('onBeforeUploadItem', item);
        //};
        //uploader.onProgressItem = function(fileItem, progress) {
        //    console.info('onProgressItem', fileItem, progress);
        //};
        //uploader.onProgressAll = function(progress) {
        //    console.info('onProgressAll', progress);
        //};
        //uploader.onSuccessItem = function(fileItem, response, status, headers) {
        //    console.info('onSuccessItem', fileItem, response, status, headers);
        //};
        //uploader.onErrorItem = function(fileItem, response, status, headers) {
        //    console.info('onErrorItem', fileItem, response, status, headers);
        //};
        //uploader.onCancelItem = function(fileItem, response, status, headers) {
        //    console.info('onCancelItem', fileItem, response, status, headers);
        //};

        uploader.onCompleteItem = function(fileItem, response, status, headers) {
            console.info('onCompleteItem', fileItem, response, status, headers);
        };
        uploader.onCompleteAll = function() {
            //console.info('onCompleteAll');
            Notification.success('Successfully saved');
            goToBack();
        };


    }]);





