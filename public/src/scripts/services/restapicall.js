//(function () {
    'use strict';

    angular.module('wrdly')
    //.constant('APIBASEPATH', "https://ide.c9.io/sushantlp/wrdly")
    .factory('RestfullApi',['$q', '$http', function($q, $http) {



        var RestfullApi = function(url) {
            this.url = url;
        }

        RestfullApi.prototype.callSignupApi = function (name,email,password) {
            var response = $http({
                method: "POST",
                url: this.url,
                params: {
                    user_name:name,
                    user_email:email,
                    user_password:password
                }
            });

            return response;
        };

        return RestfullApi;
    }]);
//})();
