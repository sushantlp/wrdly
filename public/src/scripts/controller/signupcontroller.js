(function () {

    'use strict';
    angular.module('wrdly')
    .controller('SignUpController', SignUpController)
    .controller('ProfileController', ProfileController);
    

    SignUpController.$inject = ['RestfullApi','$state'];
    ProfileController.$inject = ['$timeout','$q'];

    // Signup Controller
    function SignUpController(RestfullApi,$state) {
        var signupCtrl = this;

        // When Signup Form Submit this Function Call
        signupCtrl.submitFunction = function() {
            // Signup Api
            var apiUrl = '/api/v1/user/signup'

            // Two Way Binding
            var userName = signupCtrl.userName;
            var userEmail = signupCtrl.userEmail;
            var userPassword = signupCtrl.userPassword;


            console.log(userName);
            console.log(userEmail);
            console.log(userPassword);
            // Create a Pseudoclassical Class Patterns Service for Api Call Logic
            var apiCall = new RestfullApi(apiUrl); // Pass Api

            // Call
            var promise = apiCall.callSignupApi(userName,userEmail,userPassword);
            promise.then(function(response) {
                if(angular.isObject(response)) {
                    if(response.data.hasOwnProperty('wrdly_success')) {
                        swal("Good job!", "You clicked the button!", "success")
                         $state.go('autopilot.addmanageautopilot');
                    } else if(response.data.hasOwnProperty('wrdly_half_success')) {
                        swal("Good job!", "You clicked the button!", "success")
                         $state.go('signin');
                    } else {
                        swal("Good job!", "You clicked the button!", "success")
                    }
                } else {
                    swal("Good job!", "You clicked the button!", "success")
                }
            })
            .catch(function (error) {
                console.log(error);
            })
        }

    }

    function ProfileController($timeout,$q) {
        var self = this;

        self.simulateQuery = true;
        self.isDisabled    = false;
        self.template = 'src/template/content.html';

        // list of `state` value/display objects
        self.states        = loadAll();
        self.querySearch   = querySearch;
        self.selectedItemChange = null;
        self.searchTextChange   = null;

        self.newState = null;

        // Search for states... use $timeout to simulate
        function querySearch (query) {
            var results = query ? self.states.filter( createFilterFor(query) ) : self.states,
            deferred;
            if (self.simulateQuery) {
                deferred = $q.defer();
                $timeout(function () { deferred.resolve( results ); }, Math.random() * 1000, false);
                return deferred.promise;
            } else {
                return results;
            }
        }

        // Build `states` list of key/value pairs
        function loadAll() {
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

         self.changeClassNext = function() {
             $("#one").removeClass("active");
             $("#two").addClass("active");
         };

         self.changeClassPrev = function() {
             $("#two").removeClass("active");
             $("#one").addClass("active");
         };
    }
})();
