(function () {

    'use strict';

    angular.module('wrdly')
    .service('CommonService',CommonService);

    CommonService.$inject = ['$interval', '$mdDialog', '$mdToast', '$state', '$rootScope', '$http'];

    function CommonService ($interval, $mdDialog, $mdToast, $state, $rootScope, $http) {

        var service = this;
        var empty = "";
        $rootScope.engine = {};

        // Open Circular Dialog
        service.circularDialogOpen = function () {

            $mdDialog.show({
                template: '<md-dialog style="background-color:transparent;box-shadow:none" id="circular-dialog">' +
                            '<div layout="row" layout-sm="column" layout-align="center center" aria-label="wait">' +
                                '<md-progress-circular md-mode="indeterminate" class="md-accent md-hue-1"></md-progress-circular>' +
                             '</div>' +
                          '</md-dialog>',
                parent: angular.element(document.body),
                clickOutsideToClose:false,
                escapeToClose: false,
                fullscreen: false
            });
        };

        // Toaster Position
        service.toastPosition = {
            bottom: false,
            top: true,
            left: false,
            right: true
        };

        // Toaster Position Set
        service.getToastPosition = function () {
            return Object.keys(service.toastPosition)
            .filter(function(pos) { return service.toastPosition[pos]; })
            .join(' ');
        };

        // Close Circular Dialog
        service.circularDialogClose = function () {
             $mdDialog.hide();
        };

        // Open Error Toast
        service.showActionToast = function (content) {
            $mdToast.show(
                $mdToast.simple()
                .content(content)
                .position(service.getToastPosition())
                .hideDelay(3000)
            )
        };

        // Alert
        service.showAlert = function (content,title,state1,state2,btn1,btn2) {
            var confirm = $mdDialog.confirm()
                .title(title)
                .content(content)
                .ariaLabel('Lucky day')
                .ok(btn1)
                .cancel(btn2)

                $mdDialog.show(confirm).then(function() {
                    $state.go(state1);
                }, function() {
                    $state.go(state2);
                });
        };

        // Set Email and Password Token and Role in RootScope
        service.buildValue = function (email,password,token,role) {
            $rootScope.engine.email = email;
            $rootScope.engine.password = password;
            $rootScope.engine.token = token;
            $rootScope.engine.role = role;
        };

        // Delete Value
        service.destroyValue = function () {
            $rootScope.engine = {};
        };

        // Check User is Login or Not
        service.isAuthenticated = function () {
            if($rootScope.engine.hasOwnProperty('email') && $rootScope.engine.hasOwnProperty('token')) {
                if($rootScope.engine.email != empty && $rootScope.engine.email != undefined) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        };

        // Image Upload service
        service.uploadFileToUrl = function(file, uploadUrl) {
           var fd = new FormData();
           fd.append('file', file);

           $http.post(uploadUrl, fd, {
              transformRequest: angular.identity,
              headers: {'Content-Type': undefined}
           })

           .success(function(){
           })

           .error(function(){
           });
        }
    }
})();
