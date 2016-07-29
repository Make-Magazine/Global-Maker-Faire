  var scheduleApp = angular.module('scheduleApp', []);
  var weekday = new Array(7);
      weekday[1] =  "Sunday";
      weekday[2] = "Monday";
      weekday[3] = "Tuesday";
      weekday[4] = "Wednesday";
      weekday[5] = "Thursday";
      weekday[6] = "Friday";
      weekday[7] = "Saturday";
    scheduleApp.controller('scheduleCtrl', ['$scope', '$filter', '$http', function ($scope, $filter, $http) {


    var formIDs = jQuery('#forms2use').val();
    /*
      $http.get('/wp-content/themes/MiniMakerFaire/faireData.php?type=categories&formIDs='+formIDs)
      .then(function successCallback(response) {
        $scope.catJson = [];
        angular.forEach(response.data.category,function(catArr){
           $scope.catJson[catArr.id] = catArr.name.trim();
        });
       });*/
    $http.get('/wp-content/themes/MiniMakerFaire/faireData.php?type=schedule&formIDs='+formIDs)
     .then(function successCallback(response) {
        $scope.catJson = [];
        angular.forEach(response.data.category,function(catArr){
           $scope.catJson[catArr.id] = catArr.name.trim();
        });

        $scope.schedType = 'all';
        $scope.schedStage = '';
        $scope.schedTopic = '';
        $scope.schedules = response.data.schedule;
        $scope.tags = []; //unique list of categories
        daysObj = {};
        /* input categories are a comma sepated list of category id's
            the below will split these into an array,
            compare them to the catJson to get the category name,
            and output an array of category names */
        angular.forEach($scope.schedules, function(schedule){

          if(schedule.day){
            var day = parseInt(schedule.day);
            if (!(day in daysObj)) {
              daysObj[day] = weekday[day];
            }
          }

          var categories = [];
          var catList = schedule.category.split(",");
          angular.forEach(catList, function(catID){
            catID = catID.trim();
            if(catID!=''){
              var addCat = catID;
              //look up cat id in the category json file to find the matching category name
              if(catID in $scope.catJson){
                addCat = $scope.catJson[catID];
              }
              categories.push(addCat);
              //create a unique list of category names for a filter drop down
              if ($scope.tags.indexOf(addCat) == -1)
                $scope.tags.push(addCat);
            }
          });
          schedule.category = categories;
        });
         $scope.days = daysObj;
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
    $scope.setStage = function(stage){
      $scope.schedStage = stage;
    }
    $scope.setTagFilter = function (tag) {
      $scope.schedTopic = tag;
    }
  }]).filter('dayFilter', function($filter) {
    // Create the return function and set the required parameter name to **input**
    return function(input,dayOfWeek) {
      var out = [];

      // Using the angular.forEach method, go through the array of data and perform the operation of figuring out if the language is statically or dynamically typed.
      angular.forEach(input, function(schedule) {
        var schedDOW = $filter('date')(schedule.time_start, "EEEE");
        var schedDOW = weekday.indexOf(schedDOW)

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

  }).filter('stageFilter', function() {
    // Create the return function and set the required parameter name to **input**
    return function(schedules,stage) {
      if(stage!=''){
        var out = [];
        // Using the angular.forEach method, go through the array of data and perform the operation of figuring out if the language is statically or dynamically typed.
        angular.forEach(schedules, function(schedule) {
          if(schedule.nicename==stage){
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

scheduleApp.filter('catFilter', function(){
  return function(items, catName) {
    var filtered = [];

    if (!catName || !items.length) {
      return items;
    }
    items.forEach(function(itemElement, itemIndex) {
      itemElement.category.forEach(function(categoryElement, categoryIndex) {

        if (categoryElement === catName) {
          filtered.push(itemElement);
          return false;
        }
      });
    });
    return filtered;
  };
});
