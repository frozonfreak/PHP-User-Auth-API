var appName = angular.module('appName',['ngRoute']);

//Routing
appName.config(function ($routeProvider) {
    $routeProvider
        .when('/',
            {
                controller: 'appController',
                templateUrl: 'partials/home.html'
            })
        .otherwise({ redirectTo: '/' });
});

//Shared Values
appName.service('sharedValues', function () {

    //User details received from phone
    var userDetails = [{
                            firstName   : 'firstName',  
                            surName     : 'LastName',
                            gender      :  'M',
                            preferredLocation: 'Tampines',
                            preferredDresser : 'firstname'
                        }];
    var professionalDetails = [{
                                    firstName : "firstName",
                                    surName   : "lastName",
                                    contact   : "123456789",
                                    branch    : "Tampines",
                                    reportsTo : "boss",
                                    startTime : "9:00AM",
                                    endTime   : "6:00PM"

                                },
                                {
                                    firstName : "firstName",
                                    surName   : "lastName",
                                    contact   : "123456789",
                                    branch    : "Tampines",
                                    reportsTo : "boss",
                                    startTime : "9:00AM",
                                    endTime   : "6:00PM"

                                }];

    var locationDetails  = [{
                                name           : "Tampines",
                                address        : "Tampines Address"
                            }];
    return {
           
            getUserDetails: function(){
                return userDetails;
            },
            getProfessionalDetails: function(){
                return professionalDetails;
            },
            getLocationDetails: function(){
                return locationDetails;
            }
        };
});
//Handle all HTTP calls to server
//APP_ID , clientID and TimeStamp is mandatory for all requst made to server

appName.factory('appSession', function($http){
    return {
       	registerUser: function(UID, userDetails, PhoneNo) {
        	return $http.post('server/Services.php',{
        		type		: 'registerUser',
        		APP_ID    	: UID,
                user        : userDetails,
                clientID    : PhoneNo,
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
        	});
<<<<<<< HEAD
=======
        },
        registeriOSDevice: function(UID, PhoneNo, DeviceToken, IPAddress){
            return $http.post('server/Services.php',{
                type        : 'registeriOSDevice',
                APP_ID      : UID,
                clientID    : PhoneNo,
                deviceToken : DeviceToken,
                ipAddress   : IPAddress,
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
            });
        },
        registerProfessional: function(UID, PhoneNo, professionaDetails){
            return $http.get('server/Services.php',{ params:{
                type        : 'registerProfessional',
                APP_ID      : UID,
                clientID    : PhoneNo,
                professionalDetails : professionaDetails,
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
            }});
        },
        registerLocation: function(UID, PhoneNo, locationDetails){
            return $http.post('server/Services.php',{
                type        : 'registerLocation',
                APP_ID      : UID,
                clientID    : PhoneNo,
                locationDetails : locationDetails,
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
            });
        },
        checkStatus: function(UID, PhoneNo){
            return $http.get('server/Services.php',{ params:{
                type        : 'checkStatus',
                APP_ID      : UID,
                clientID    : PhoneNo,
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
            }});
        }, 
        getUserList: function(UID, PhoneNo){
            return $http.post('server/Services.php',{
                type        : 'getUserList',
                APP_ID      : UID,
                clientID    : PhoneNo,
                timeStamp   : Math.floor((new Date()).getTime() / 1000)
            });
>>>>>>> 8d55cfedbf80318f7c6799501a4f9ead88371f56
        }
        
    }
});
//controller
appName.controller('appController', function($scope, appSession, sharedValues){

    $scope.displayError = function(data, status){
        console.log("Error");
        $scope.output = data;
    };
    $scope.displaySuccess = function(data, status){
        $scope.output = data;
        console.log(data);
    };
    $scope.registeruser = function(){
        appSession.registerUser(sharedValues.getUserDetails()).success($scope.displaySuccess).error($scope.displayError);
    };
<<<<<<< HEAD
    
=======
    $scope.getUserList = function(){
        appSession.getUserList(sharedValues.getHash(), sharedValues.getClientPhoneNo()).success($scope.displaySuccess).error($scope.displayError);
    };
>>>>>>> 8d55cfedbf80318f7c6799501a4f9ead88371f56
});