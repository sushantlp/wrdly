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
        $scope.magic = '#FFFFFF';
        $scope.counter = 270;

        $scope.selected = {
            item: $scope.items[0]
        };

        $scope.ok = function() {
            $modalInstance.close($scope.selected.item);
        };

        $scope.cancel = function() {
            $modalInstance.dismiss('cancel');
        };

        $scope.colorEffect = function(value) {

            if(value === 'story') {
                $scope.magic = value;
            } else if(value === 'poem') {
                $scope.magic =  value;
            } else if(value === 'lyrics') {
                $scope.magic = value;
            } else if(value === 'comdey') {
                $scope.magic = value;
            } else if(value === 'drama') {
                $scope.magic = value;
            } else if(value === 'science') {
                $scope.magic = value;
            } else {
                $scope.magic = '#FFFFFF';
            }
        }

        $scope.calculateText = function(event) {

            if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 127) {
                if($scope.counter == 270) {
                    return true;
                }
                $scope.counter = $scope.counter + 1;
            } else if(event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
                return true;
            } else {
                if($scope.counter == 0) {
                    return true;
                }
                $scope.counter = $scope.counter - 1;
            }
        }
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
            }, function () {
                console.log('Modal dismissed at: ' + new Date());
            });
        };
    }
})();
