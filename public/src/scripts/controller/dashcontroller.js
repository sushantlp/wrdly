(function() {

    'use strict';
    angular.module('wrdly')
    .controller('DashboardController', DashboardController)
    .config(cardConfig);

    DashboardController.$inject = ['RestfullApi','$mdDialog'];
    cardConfig.$inject = ['$mdThemingProvider','$mdIconProvider'];

    function cardConfig($mdThemingProvider,$mdIconProvider) {
        $mdThemingProvider.theme('dark-blue').backgroundPalette('blue').dark();
        $mdIconProvider.fontSet('md', 'material-icons');
    }

    function DashboardController(RestfullApi,$mdDialog) {
        var dash = this;
        dash.change = 'grey';
        dash.content = [
            {
                past: 'fish',
                color: '#ff6686'
            },
            {
                past: 'yellow',
                color: '#ffc555'
            },
            {
                past: 'green',
                color: '#33DAA0'
            },
            {
                past: 'blue',
                color: '#21e8ea'
            },
            {
                past: 'red',
                color: '#D52735'
            },
            {
                past: 'ultra',
                color: '#7b53fc'
            },
            {
                past: 'nice-green',
                color: '#65A026'
            },
            {
                past: 'orange',
                color: '#ff6686'
            }
        ];


        // Execute When User Like or Dislike Thought
        dash.hitLike = function() {
            dash.change = '#FF6666';
        }

        dash.showPrompt = function() {
            swal({
                input: 'textarea',
                showCancelButton: true,
                inputPlaceholder: 'Your words here...',
                inputAttributes: {
    'maxlength': 200,
    'autocapitalize': 'off',
    'autocorrect': 'off'
},
                width: 800,
                padding: 100,
                html:
                '<md-button class="md-raised md-accent btn-fw m-b-sm">Next</md-button>'
            }).then(function (text) {
                if (text) {
                    swal(text)
                }
            })
        };
    }
})();
