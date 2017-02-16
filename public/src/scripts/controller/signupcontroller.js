(function () {
    'use strict';
    angular.module('wrdly')
    .controller('SignUpController', SignUpController);


    SignUpController.$inject = ['RestfullApi'];

    function SignUpController(RestfullApi) {
        var signupCtrl = this;

        signupCtrl.submitFunction = function() {
            var userName = signupCtrl.name;
            var email = signupCtrl.email;
            var password = signupCtrl.password;

            var apiCall = new RestfullApi();
            apiCall.callSignupApi(userName,email,password);
            apiCall.then(function (response) {
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            })
        }

    }

})();
