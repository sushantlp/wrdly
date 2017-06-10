(function() {

    'use strict';
    angular.module('wrdly')
    .controller('ModalInstanceCtrl', ModalInstanceCtrl)
    .controller('TimelineController', TimelineController);

    TimelineController.$inject = ['RestfullApi','$mdDialog','$modal'];
    ModalInstanceCtrl.$inject = ['$modalInstance','items','$scope','$interval'];

    function TimelineController(RestfullApi,$mdDialog,$modal) {
        var timeline = this;

        timeline.choice = 1;

        timeline.content = [
            {
                paragraph: 'In publishing, art, and communication, content is the information and experience(s) that is directed towards an end-user or audience',
            },
            {
                paragraph: 'A paragraph consists of one or more sentences.[1][2] Though not required by the syntax of any language, paragraphs are usually an expected part of formal writing, used to organize longer prose'
            },
            {
                paragraph: 'The oldest classical Greek and Latin writing had little or no space between words and could be written in boustrophedon (alternating directions). Over time, text direction (left to right) became standardized, and word dividers and terminal punctuation became common'
            },
            {
                paragraph: 'In ancient manuscripts, another means to divide sentences into paragraphs was a line break (newline) followed by an initial at the beginning of the next paragraph'
            }
        ];

        timeline.theme = 'story';

        if(timeline.theme === 'story') {
            timeline.past = 'fish';
        } else if(timeline.theme === 'poem') {
            timeline.past = 'yellow';
        } else if(timeline.theme === 'lyrics') {
            timeline.past = 'green';
        } else if(timeline.theme === 'comdey') {
            timeline.past = 'blue';
        } else if(timeline.theme === 'drama') {
            timeline.past = 'orange';
        } else if(timeline.theme === 'science') {
            timeline.past = 'ultra';
        } else {
            timeline.past = 'ultra';
        }

        timeline.items = ['item1', 'item2', 'item3'];
        timeline.open = function (size) {

            var modalInstance = $modal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                size: size,
                resolve: {
                    items: function () {
                        return timeline.items;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                timeline.selected = selectedItem;
            }, function () {
                console.log('Modal dismissed at: ' + new Date());
            });
        };
    }

    function ModalInstanceCtrl($modalInstance,items,$scope,$interval) {

        $scope.items = items;
        $scope.magic = '#FFFFFF';
        $scope.counter = 200;

        $scope.selected = {
            item: $scope.items[0]
        };

        $scope.ok = function() {
            $modalInstance.close($scope.selected.item);
        };

        $scope.cancel = function() {
            $modalInstance.dismiss('cancel');
        };

        $scope.calculateText = function(event) {

            if(event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 127) {
                if($scope.counter == 200) {
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
})();
