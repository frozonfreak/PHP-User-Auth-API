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
    var userPassword = '1234567890';
    var userDetails = [{
                            firstName   : 'firstName',  
                            surName     : 'LastName',
                            gender      :  'M',
                            contactNo   : '123456789',
                            email       : 'email@email.com'
                        }];
    return {
            getUserDetails: function(){
                return userDetails;
            },
            getUserPassword: function(){
                return userPassword;
            }
        };
});
//Handle all HTTP calls to server

userAuth.factory('authSession', function($http){
    return {
       	registerCustomer: function(userDetails, password) {
        	return $http.post('server/Services.php',{
        		type		: 'registerCustomer',
                user        : userDetails,
                password     : password,
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
        	});
        },
        registerHairDresser: function(userDetails, password) {
            return $http.post('server/Services.php',{
                type        : 'registerHairDresser',
                user        : userDetails,
                password     : password,
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
    $scope.customerRegsistration = function(data, status){
        console.log(data);
        if(data['status'])
            authSession.registerCustomer(sharedValues.getUserDetails(), sharedValues.getUserPassword()).success($scope.displaySuccess).error($scope.displayError);
    };
    $scope.hairdresserRegistration = function(data, status){
        if(data['status'])
            authSession.registerHairDresser(sharedValues.getUserDetails(), sharedValues.getUserPassword()).success($scope.displaySuccess).error($scope.displayError);
    };
    $scope.registerCustomer = function(){
        authSession.getSalt().success($scope.customerRegsistration).error($scope.displayError);
    };
    $scope.registerHairDresser = function(){
        authSession.getSalt().success($scope.hairdresserRegistration).error($scope.displayError);
    }
});