
'use strict';

angular
    .module('app', [
        'angularUtils.directives.dirPagination',
        'rt.encodeuri',
        'angular-loading-bar',
        'ui.bootstrap',
    ])
    .config(['$interpolateProvider',
        function ($interpolateProvider) {

            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]');

        }])

    .config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
        cfpLoadingBarProvider.parentSelector = '#loading-bar-container';
    }])


