(function(){

    'use strict';

    angular.module('wrdly')
    .constant('RELATIVEPATH', "src/template/")
    .run(routeRun)
    .config(routeConfig);

    routeRun.$inject = ['$rootScope', '$state', '$stateParams'];
    routeConfig.$inject = ['$stateProvider','$urlRouterProvider','RELATIVEPATH'];

    function routeRun($rootScope,$state,$stateParams) {
        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;
    }

    function routeConfig($stateProvider,$urlRouterProvider,RELATIVEPATH) {

        $urlRouterProvider.otherwise('/signin');

        $stateProvider

            .state('app', {
                abstract: true,
                views: {
                    '': {
                        templateUrl: RELATIVEPATH + 'layout.html'
                    },

                    'content': {
                        templateUrl: RELATIVEPATH + 'content.html'
                    }
                }
            })

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

            .state('app.profile-fillup', {
                url: '/profile-fillup',
                templateUrl: RELATIVEPATH + 'profile-fillup.html',
                controller: 'ProfileController',
                controllerAs: 'profileCtrl',
            })

            .state('app.dashboard', {
                url: '/dashboard',
                templateUrl: RELATIVEPATH + 'dashboard.html',
                controller: 'DashboardController',
                controllerAs: 'dashCtrl',
            })

            .state('app.timeline', {
                url: '/timeline',
                templateUrl: RELATIVEPATH + 'timeline.html',
                controller: 'TimelineController',
                controllerAs: 'timeCtrl',
            });
    };
})();
