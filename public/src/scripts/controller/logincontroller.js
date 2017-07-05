'use strict';
(function () {
angular.module('wrdly')
.controller('LoginController', LoginController);

LoginController.$inject = ['RestfullApi', '$state', 'CommonService'];


// Login Controller
function LoginController(RestfullApi, $state, CommonService) {

  var loginCtrl = this;

  // When Login Form Submit this Function Call
  loginCtrl.submitFunction = function () {

      // Signup Api
      var apiUrl = '/api/v1/user/login';
      var empty = "";

      // Create a Pseudoclassical Class Patterns Service for Api Call Logic
      var apiCall = new RestfullApi(apiUrl); // Pass Api

      // Open Circular Dialog
      CommonService.circularDialogOpen();

      // Two Way Binding
      var userEmail = loginCtrl.userEmail;
      var userPassword = loginCtrl.userPassword;

      // Validate Name Email Password
      if (userEmail == undefined || userEmail == empty) {

      } else if (userPassword == undefined || userPassword == empty) {

      } else {

          // Call
          var promise = apiCall.callLoginApi(userEmail,userPassword);
          promise.then(function(response) {

              if (angular.isObject(response)) {

                  // Close Circular Dialog
                  CommonService.circularDialogClose();

                  if (response.data.hasOwnProperty('wrdly_success')) {

                      var email = response.data.wrdly_success.wrdly.User_Email;
                      var password = userPassword;
                      var token = response.data.wrdly_success.wrdly.Token.Token;
                      var role = response.data.wrdly_success.wrdly.Token.Role;
                      var mobile = response.data.wrdly_success.wrdly.User_Mobile;

                      // Set Email and Password Token and Role in RootScope
                      CommonService.buildValue(email,password,token,role);

                      if(mobile === null) {
                          $state.go('profile-fillup');
                      } else {
                          $state.go('app.dashboard');
                      }

                  } else if (response.data.hasOwnProperty('wrdly_half_success')) {

                      // Open Toaster
                      CommonService.showActionToast(response.data.wrdly_half_success.wrdly);
                  } else {

                      // Open Toaster
                      CommonService.showActionToast(response.data.wrdly_error.wrdly);
                  }
              } else {

                  // Close Circular Dialog
                  CommonService.circularDialogClose();

                  // Open Toaster
                  CommonService.showActionToast('Please try again later');
              }
          })
          .catch (function (error) {

              // Close Circular Dialog
              CommonService.circularDialogClose();

              // Open Toaster
              CommonService.showActionToast('Please try again later');
          });
      }

  };

}

})();
