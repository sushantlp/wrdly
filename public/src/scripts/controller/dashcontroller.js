(function() {

    'use strict';
    angular.module('wrdly')
    .controller('DashboardController', DashboardController)
    .config(cardConfig);

    DashboardController.$inject = ['RestfullApi'];
    cardConfig.$inject = ['$mdThemingProvider','$mdIconProvider'];

    function cardConfig($mdThemingProvider,$mdIconProvider) {
        $mdThemingProvider.theme('dark-blue').backgroundPalette('blue').dark();
        $mdIconProvider.fontSet('md', 'material-icons');
    }

    function DashboardController(RestfullApi) {
        var dash = this;

        dash.content = [
            {
                past: 'fish'
            },
            {
                past: 'yellow'
            },
            {
                past: 'green'
            },
            {
                past: 'blue'
            },
            {
                past: 'red'
            },
            {
                past: 'ultra'
            },
            {
                past: 'nice-green'
            },
            {
                past: 'orange',
            }
        ];


        // Execute When User Like or Dislike Thought
        dash.hitLike = function() {
            dash.change = 'red';
        }

    }
})();
