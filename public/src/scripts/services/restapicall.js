(function () {
    'use strict';

    angular.module('wrdly')
    .constant('APIBASEPATHCLOUD', "https://ide.c9.io/sushantlp/wrdly")
    .constant('APIBASEPATHLOCAL', "http://127.0.0.1:8000")
    .factory('RestfullApi',['$q', '$http', 'APIBASEPATHCLOUD', 'APIBASEPATHLOCAL', function($q, $http, APIBASEPATHCLOUD, APIBASEPATHLOCAL) {



        var RestfullApi = function(url) {
            this.relativePath = url;
            this.basePath = APIBASEPATHLOCAL;
        }

        RestfullApi.prototype.callSignupApi = function (name,email,password) {
            var response = $http({
                method: "POST",
                url: this.basePath + this.relativePath,
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
})();
