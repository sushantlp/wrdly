(function () {

    'use strict';

    var wrdly = angular.module('wrdly')
    .controller('SignUpController', SignUpController)
    .controller('ProfileController', ProfileController);


    SignUpController.$inject = ['RestfullApi','CommonService'];
    ProfileController.$inject = ['$timeout','$q','CommonService','$rootScope'];

    wrdly.directive('ngFiles', ['$parse', function ($parse) {

           function fn_link(scope, element, attrs) {
               var onChange = $parse(attrs.ngFiles);
               element.on('change', function (event) {
                   onChange(scope, { $files: event.target.files });
               });
           };

           return {
               link: fn_link
           }
    }]);

    // Signup Controller
    function SignUpController(RestfullApi,CommonService) {

        var signupCtrl = this;

        // When Signup Form Submit this Function Call
        signupCtrl.submitFunction = function () {

            // Signup Api
            var apiUrl = '/api/v1/user/signup';

            // Create a Pseudoclassical Class Patterns Service for Api Call Logic
            var apiCall = new RestfullApi(apiUrl); // Pass Api

            // Open Circular Dialog
            CommonService.circularDialogOpen();

            // Variable
            var empty = "";

            // Two Way Binding
            var userName = signupCtrl.userName;
            var userEmail = signupCtrl.userEmail;
            var userPassword = signupCtrl.userPassword;

            // Validate Name Email Password
            if (userName == undefined || userName == empty) {

            } else if (userEmail == undefined || userEmail == empty) {

            } else if (userPassword == undefined || userPassword == empty) {

            } else {

                // Call
                var promise = apiCall.callSignupApi(userName,userEmail,userPassword);
                promise.then(function(response) {
                    if (angular.isObject(response)) {

                        // Close Circular Dialog
                        CommonService.circularDialogClose();

                        if (response.data.hasOwnProperty('wrdly_success')) {

                             // Open Toaster
                             CommonService.showAlert('Successful registration. please verify your email', 'Wrdly', 'verify' ,'signin' ,'Verify' ,'Login');

                        } else if (response.data.hasOwnProperty('wrdly_half_success')) {

                            // Open Dialog
                            CommonService.showAlert(response.data.wrdly_half_success.wrdly, 'Wrdly', 'signin', 'signup', 'Go', 'Stay');
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

    function ProfileController($timeout,$q,CommonService,$rootScope) {
        var profileCtrl = this;

        // Object Form Data
        profileCtrl.formdata = new FormData();

        // User Default Pic
        profileCtrl.userPic = 'src/images/app.jpg';

        // Image Api Upload
        profileCtrl.imageUrl = '/api/v1/user/profile/image';

        profileCtrl.hide = true;
        profileCtrl.submissionDate = "";
        profileCtrl.simulateQuery = true;
        profileCtrl.isDisabled    = false;
        profileCtrl.template = 'src/template/content.html';

        // list of `state` value/display objects
        profileCtrl.states        = stateAll();
        profileCtrl.querySearch   = querySearch;
        profileCtrl.selectedItemChange = null;
        profileCtrl.searchTextChange   = null;

        profileCtrl.newState = null;

        // Search for states... use $timeout to simulate
        function querySearch (query) {
            var results = query ? profileCtrl.states.filter( createFilterFor(query) ) : profileCtrl.states,
            deferred;
            if (profileCtrl.simulateQuery) {
                deferred = $q.defer();
                $timeout(function () { deferred.resolve( results ); }, Math.random() * 1000, false);
                return deferred.promise;
            } else {
                return results;
            }
        }

        // Build `states` list of key/value pairs
        function stateAll() {
            var allStates = 'Alabama, Alaska, Arizona, Arkansas, California, Colorado, Connecticut, Delaware,\
            Florida, Georgia, Hawaii, Idaho, Illinois, Indiana, Iowa, Kansas, Kentucky, Louisiana,\
            Maine, Maryland, Massachusetts, Michigan, Minnesota, Mississippi, Missouri, Montana,\
            Nebraska, Nevada, New Hampshire, New Jersey, New Mexico, New York, North Carolina,\
            North Dakota, Ohio, Oklahoma, Oregon, Pennsylvania, Rhode Island, South Carolina,\
            South Dakota, Tennessee, Texas, Utah, Vermont, Virginia, Washington, West Virginia,\
            Wisconsin, Wyoming';

            return allStates.split(/, +/g).map( function (state) {
                return {
                    value: state.toLowerCase(),
                    display: state
                };
            });
        }


        // Create filter function for a query string
        function createFilterFor(query) {
            var lowercaseQuery = angular.lowercase(query);

            return function filterFn(state) {
                return (state.value.indexOf(lowercaseQuery) === 0);
            };
        }

        /* self.changeClassNext = function() {
             $("#one").removeClass("active");
             $("#two").addClass("active");
         }; */

         // Dynamic User Profile Pic
         profileCtrl.dynamicPic = function (value) {
             $('#user-image').css('background-image', 'url('+value+')');
         };

         profileCtrl.openUploader = function () {
             $("#upload").click();
         };

         profileCtrl.imageHide = function () {
             profileCtrl.hide = true;
         };

         profileCtrl.imageShow = function () {
             profileCtrl.hide = false;
         };

         profileCtrl.getTheFiles = function ($files) {

             // Open Circular Dialog
             CommonService.circularDialogOpen();

             angular.forEach($files, function (value, key) {
                 profileCtrl.formdata.append('image',value);
             });

             profileCtrl.formdata.append('email',$rootScope.engine.email);

             // Image Upload service
             var promise = CommonService.uploadFiles('POST',profileCtrl.imageUrl,profileCtrl.formdata);
             promise.then(function(response) {
                 if (angular.isObject(response)) {

                     // Close Circular Dialog
                     CommonService.circularDialogClose();

                     if (response.data.hasOwnProperty('wrdly_success')) {

                         // Assign User Profile Pic Upload
                         profileCtrl.userPic = response.data.wrdly_success.wrdly;

                         // Dynamic User Profile Pic
                         profileCtrl.dynamicPic(profileCtrl.userPic);
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
         };
    }
})();
