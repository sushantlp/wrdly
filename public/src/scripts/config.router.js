'use strict';

/**
 * @ngdoc function
 * @name app.config:uiRouter
 * @description
 * # Config
 * Config for the router
 */
angular.module('wrdly')
.config(routeConfig);

 routeConfig.$inject = ['$stateProvider','$urlRouterProvider'];

 function routeConfig ($stateProvider,$urlRouterProvider) {
     $urlRouterProvider.otherwise('/signin');

     $stateProvider
     .state('signin', {
     url: '/signin',
     templateUrl: 'src/template/signin.html',
     controller: 'LoginController',
     controllerAs: 'loginCtrl',
   });
 };
