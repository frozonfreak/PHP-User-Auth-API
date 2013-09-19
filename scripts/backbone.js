var userAuth = angular.module('userAuth',['ngRoute']);

//Routing
userAuth.config(function ($routeProvider) {
    $routeProvider
        .when('/',
            {
                controller: 'appController',
                templateUrl: 'partials/home.html'
            })
        .otherwise({ redirectTo: '/' });
});

//Shared Values
userAuth.service('sharedValues', function () {

    //User details received from phone
    var userDetails = [{
                            firstName   : 'firstName',  
                            surName     : 'LastName',
                            password    : 'password',
                            gender      :  'M',
                            contactNo   : '123456789',
                            email       : 'email@email.com'
                        }];
    return {
            getUserDetails: function(){
                return userDetails;
            }
        };
});
//Handle all HTTP calls to server

userAuth.factory('authSession', function($http){
    return {
       	registerUser: function(userDetails) {
        	return $http.post('server/Services.php',{
        		type		: 'registerUser',
                user        : userDetails,
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
        	});
        },
        getSalt: function(){
            return $http.post('server/Services.php',{
                type        : 'getSalt',
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
            });
        }
    }
});
//controller
userAuth.controller('appController', function($scope, authSession, sharedValues){
    $scope.output='';
    $scope.displayError = function(data, status){
        console.log("Error");
        $scope.output = JSON.stringify(data);
    };
    $scope.displaySuccess = function(data, status){
        $scope.output = JSON.stringify(data);
        console.log($scope.output);
    };
    $scope.registration = function(data, status){
        console.log(data);
        console.log(unixCryptTD(data, '12345678900'));
        authSession.registerUser(sharedValues.getUserDetails()).success($scope.displaySuccess).error($scope.displayError);
    }
    $scope.registeruser = function(){
        authSession.getSalt().success($scope.registration).error($scope.displayError);
        
    };
});