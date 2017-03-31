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
        dash.changeColor = '#a7a3a3';

        dash.content = [
            {
                past: 'fish',
                color: '#ff6686',
                theme:'Story'
            },
            {
                past: 'yellow',
                color: '#ffc555',
                theme:'Poem'
            },
            {
                past: 'green',
                color: '#33DAA0',
                theme:'Lyrics'
            },
            {
                past: 'blue',
                color: '#21e8ea',
                theme:'Comdey'
            },
            {
                past: 'red',
                color: '#D52735',
                theme:'Drama'
            },
            {
                past: 'ultra',
                color: '#7b53fc',
                theme:'Sci-fi'
            },
            {
                past: 'nice-green',
                color: '#65A026',
                theme:'Adventure'
            },
            {
                past: 'orange',
                color: '#ff6686',
                theme:'Art'
            }
        ];


        // Execute When User Like or Dislike Thought
        dash.hitLike = function(flag) {
            console.log(flag);
            if(flag == 1) {
                dash.changeColor = '#FF6666';
            } else if(flag == 2) {
                dash.changeColor = '#33DAA0';
            } else {
                dash.changeColor = '#a7a3a3';
            }
        }

    /*    dash.showPrompt = function() {
            swal({
                input: 'textarea',
                showCancelButton: true,
                inputPlaceholder: 'Your words here...',
                width: 800,
                padding: 100,
                html:
                '<md-button class="md-raised md-accent btn-fw m-b-sm">Next</md-button>'
            }).then(function (text) {
                if (text) {
                    swal(text)
                }
            })
        }; */
    }
})();
