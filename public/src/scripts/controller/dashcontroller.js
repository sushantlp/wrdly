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

        dash.changeIconColor = function() {
            //var element = document.getElementById('favorite').style.color = "blue";
        };
    }
})();
