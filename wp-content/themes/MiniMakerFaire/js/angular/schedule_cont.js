  var scheduleApp = angular.module('scheduleApp', []);


  scheduleApp.controller('scheduleCtrl', ['$scope', '$filter', '$http', function ($scope, $filter, $http) {
    $scope.days = ['Friday','Saturday','Sunday'];
    $http.get('/wp-content/themes/MiniMakerFaire/schedule.json')
     .then(function successCallback(response) {
       $scope.schedules = response.data.schedule;
     }, function errorCallback(error) {
       console.log(error);
     });
  }]).filter('dayFilter', function($filter) {
    // Create the return function and set the required parameter name to **input**
    return function(input,dayOfWeek) {
      var out = [];

      // Using the angular.forEach method, go through the array of data and perform the operation of figuring out if the language is statically or dynamically typed.
      angular.forEach(input, function(schedule) {
        var schedDOW = $filter('date')(schedule.time_start, "EEEE");
        if(schedDOW==dayOfWeek){
          out.push(schedule);
        }

      })

      return out;
    }

  });
