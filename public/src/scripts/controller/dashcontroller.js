(function() {

    'use strict';
    angular.module('wrdly')
    .controller('DashboardController', DashboardController)
    .controller('ModalInstanceCtrl', ModalInstanceCtrl)
    .config(cardConfig);

    DashboardController.$inject = ['RestfullApi','$mdDialog','$modal'];
    ModalInstanceCtrl.$inject = ['$modalInstance','items','$scope','$interval'];
    cardConfig.$inject = ['$mdThemingProvider','$mdIconProvider'];

    function cardConfig($mdThemingProvider,$mdIconProvider) {
        $mdThemingProvider.theme('dark-blue').backgroundPalette('blue').dark();
        $mdIconProvider.fontSet('md', 'material-icons');
    }

    function ModalInstanceCtrl($modalInstance,items,$scope,$interval) {

        $scope.items = items;
        $scope.selected = {
            item: $scope.items[0]
        };
        $scope.ok = function () {
            $modalInstance.close($scope.selected.item);
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };

        $scope.mode = 'query';
        $scope.determinateValue = 30;
        $scope.determinateValue2 = 30;

        $interval(function() {
            $scope.determinateValue += 1;
            $scope.determinateValue2 += 1.5;
            if($scope.determinateValue > 100) {
            //    $scope.determinateValue = 30;
            //    $scope.determinateValue2 = 30;
                    $modalInstance.dismiss('cancel');
            }
        }, 100, 0, true);

        $interval(function() {
            $scope.mode = ($scope.mode == 'query' ? 'determinate' : 'query');
        }, 7200, 0, true);
    }

    function DashboardController(RestfullApi,$mdDialog,$modal) {
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
                past: 'orange',
                color: '#D52735',
                theme:'Drama'
            },
            {
                past: 'ultra',
                color: '#7b53fc',
                theme:'Sci-fi'
            }
        ];


        // Execute When User Like or Dislike Thought
        dash.hitLike = function(flag) {
            if(flag == 1) {
                dash.changeColor = '#FF6666';
            } else if(flag == 2) {
                dash.changeColor = '#33DAA0';
            } else {
                dash.changeColor = '#a7a3a3';
            }
        }

        dash.items = ['item1', 'item2', 'item3'];
        dash.open = function (size) {

            var modalInstance = $modal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                size: size,
                resolve: {
                    items: function () {
                        return dash.items;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                dash.selected = selectedItem;
                console.log("Surprise");
            }, function () {
                console.log('Modal dismissed at: ' + new Date());
            });
        };
    }
})();
