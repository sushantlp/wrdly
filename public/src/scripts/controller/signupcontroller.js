(function () {

    'use strict';
    angular.module('wrdly')
    .controller('SignUpController', SignUpController);


    SignUpController.$inject = ['RestfullApi'];

    function SignUpController(RestfullApi) {
        var signupCtrl = this;

        signupCtrl.submitFunction = function() {
            var apiUrl = '/api/v1/user/signup'
            var userName = signupCtrl.userName;
            var userEmail = signupCtrl.userEmail;
            var userPassword = signupCtrl.userPassword;

            console.log(userName);
            console.log(userEmail);
            console.log(userPassword);
            var apiCall = new RestfullApi(apiUrl);
            var promise = apiCall.callSignupApi(userName,userEmail,userPassword);
            promise.then(function (response) {
                console.log(response.data);
            })
            .catch(function (error) {
                console.log(error);
            })
        }

    }

})();
