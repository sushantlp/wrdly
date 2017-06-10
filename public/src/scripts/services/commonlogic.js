(function () {

    'use strict';

    angular.module('wrdly')
    .factory('CommonLogic',['$interval', '$mdDialog', function ($interval,$mdDialog) {

        /*  Pseudoclassical Class
            Any API Call
        */
        var CommonLogic = function () {}

        // Call Circular Dialog
        CommonLogic.prototype.circularDialogOpen = function () {

            $mdDialog.show({
                template: '<md-dialog style="background-color:transparent;box-shadow:none" id="circular-dialog">' +
                            '<div layout="row" layout-sm="column" layout-align="center center" aria-label="wait">' +
                                '<md-progress-circular md-mode="indeterminate" class="md-accent md-hue-1"></md-progress-circular>' +
                             '</div>' +
                          '</md-dialog>',
                parent: angular.element(document.body),
                clickOutsideToClose:false,
                fullscreen: false
            });

            return true;
        };

        return true;
    }]);

})();
