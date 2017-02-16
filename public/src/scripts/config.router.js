(function(){

    'use strict';

    angular.module('wrdly')
    .config(routeConfig);

    routeConfig.$inject = ['$stateProvider','$urlRouterProvider'];

    function routeConfig ($stateProvider,$urlRouterProvider) {

        $urlRouterProvider.otherwise('/signin');

        $stateProvider
            .state('signin', {
                url: '/signin',
            //    templateUrl: 'src/template/signin.html',
                templateUrl: 'template/signin.html',
                controller: 'LoginController',
                controllerAs: 'loginCtrl',
            })

            .state('signup', {
                url: '/signup',
            //    templateUrl: 'src/template/signup.html',
                templateUrl: 'template/signup.html',
                controller: 'SignUpController',
                controllerAs: 'signupCtrl',
            })

            .state('lockme', {
                url: '/lockme',
            //    templateUrl: 'src/template/lockme.html',
                templateUrl: 'template/lockme.html',
                controller: 'LockMeController',
                controllerAs: 'lockmeCtrl',
            })

            .state('forgot-password', {
                url: '/forgot-password',
            //    templateUrl: 'src/template/forgot-password.html',
                templateUrl: 'template/forgot-password.html',
                controller: 'ForgotPasswordController',
                controllerAs: 'forgotCtrl',
            });
    };
})();
