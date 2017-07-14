//'use strict';
//
//angular
//    .module('main', [
//        'angularUtils.directives.dirPagination',
//    ])
//    .config(['$interpolateProvider',
//        function ($interpolateProvider) {
//            $interpolateProvider.startSymbol('[[');
//            $interpolateProvider.endSymbol(']]');
//        }]);
//
//


'use strict';

angular
    .module('app', [
        'angularUtils.directives.dirPagination',
    ])
    .config(['$interpolateProvider',
        function ($interpolateProvider) {

            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]');


        }]);


