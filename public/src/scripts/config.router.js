(function(){

    'use strict';

    angular.module('wrdly')
    .constant('RELATIVEPATH', "src/template/")
    .config(routeConfig);

    routeConfig.$inject = ['$stateProvider','$urlRouterProvider','RELATIVEPATH'];

    function routeConfig ($stateProvider,$urlRouterProvider,RELATIVEPATH) {

        $urlRouterProvider.otherwise('/signin');

        $stateProvider
            .state('signin', {
                url: '/signin',
                templateUrl: RELATIVEPATH + 'signin.html',
                controller: 'LoginController',
                controllerAs: 'loginCtrl',
            })

            .state('signup', {
                url: '/signup',
                templateUrl: RELATIVEPATH + 'signup.html',
                controller: 'SignUpController',
                controllerAs: 'signupCtrl',
            })

            .state('lockme', {
                url: '/lockme',
                templateUrl: RELATIVEPATH + 'lockme.html',
                controller: 'LockMeController',
                controllerAs: 'lockmeCtrl',
            })

            .state('forgot-password', {
                url: '/forgot-password',
                templateUrl: RELATIVEPATH + 'forgot-password.html',
                controller: 'ForgotPasswordController',
                controllerAs: 'forgotCtrl',
            })

            .state('profile-fillup', {
                url: '/profile-fillup',
                templateUrl: RELATIVEPATH + 'profile-fillup.html',
                controller: 'ProfileController',
                controllerAs: 'profileCtrl',
            });
    };
})();
