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

    function ProfileController($timeout,$q,$log) {
        var self = this;

        self.simulateQuery = true;
        self.isDisabled    = false;

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

        self.data = {
            group1 : 'Banana',
            group2 : '2',
            group3 : 'avatar-1'
        };

        self.avatarData = [{
            id: "svg-1",
            title: 'avatar 1',
            value: 'avatar-1'
        },{
            id: "svg-2",
            title: 'avatar 2',
            value: 'avatar-2'
        },{
            id: "svg-3",
            title: 'avatar 3',
            value: 'avatar-3'
        }];

        self.radioData = [
            { label: '1', value: 1 },
            { label: '2', value: 2 },
            { label: '3', value: '3', isDisabled: true },
            { label: '4', value: '4' }
        ];
        console.log("hello");
    }
})();
