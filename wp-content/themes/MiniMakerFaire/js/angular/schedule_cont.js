  var scheduleApp = angular.module('scheduleApp', []);


  scheduleApp.controller('scheduleCtrl', ['$scope', '$filter', '$http', function ($scope, $filter, $http) {
    $scope.days = ['Friday','Saturday','Sunday'];
    $http.get('/wp-content/themes/MiniMakerFaire/schedule.json')
     .then(function successCallback(response) {
        $scope.schedType = 'all';
        $scope.schedules = response.data.schedule;
     }, function errorCallback(error) {
       console.log(error);
     });
    $scope.predicate = 'time_start';
    $scope.reverse = true;
    $scope.order = function(predicate) {
      $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
      $scope.predicate = predicate;
    };
    $scope.setTypeFilter = function (type) {
      $scope.schedType = type;
    }
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

  }).filter('typeFilter', function() {
    // Create the return function and set the required parameter name to **input**
    return function(schedules,schedType) {
      if(schedType!='all'){
        var out = [];
        // Using the angular.forEach method, go through the array of data and perform the operation of figuring out if the language is statically or dynamically typed.
        angular.forEach(schedules, function(schedule) {
          if(schedule.type==schedType){
            out.push(schedule);
          }

        })
      }else{//return all
        var out = schedules;
      }
      return out;
    }

  }).filter('unique', function() {
   return function(collection, keyname) {
      var output = [],
          keys = [];

      angular.forEach(collection, function(item) {
          var key = item[keyname];
          if(keys.indexOf(key) === -1) {
              keys.push(key);
              output.push(item);
          }
      });

      return output;
   };
});
