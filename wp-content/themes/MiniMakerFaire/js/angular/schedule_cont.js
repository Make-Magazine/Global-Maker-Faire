  var scheduleApp = angular.module('scheduleApp', ['ngAnimate', 'ui.bootstrap','angular.filter']);

  scheduleApp.controller('scheduleCtrl', ['$scope', '$filter', '$http', function ($scope, $filter, $http) {
    $scope.showType = false;
    $scope.showSchedules = false;
    $scope.propertyName = 'time_start';
    var noMakerText = jQuery('#noMakerText').val();
    var formIDs = jQuery('#forms2use').val();
    if(formIDs=='') alert ('error!  Please set the form to pull from on the admin page.')
    $http.get('/wp-json/makerfaire/v2/fairedata/schedule/'+formIDs)
      .then(function successCallback(response) {
        if('schedule' in response.data && response.data.schedule.length>0){
          jQuery('#page-schedule .loading').hide();
        }else{
          jQuery('#page-schedule .loading').html(noMakerText);
        }

        $scope.catJson = [];
        $scope.types=[];
        angular.forEach(response.data.category,function(catArr){
           $scope.catJson[catArr.id] = catArr.name.trim();
        });

        $scope.schedType = 'all';
        $scope.schedStage = '';
        $scope.schedTopic = '';
        var unorderedSched = response.data.schedule;
        var schedules = {};
        Object.keys(unorderedSched).sort().forEach(function(key) {
          schedules[key] = unorderedSched[key];
        });
        $scope.schedules = schedules;
        $scope.days = {};
        $scope.tags = []; //unique list of categories

        var typeArr = {};
        var addType = '';
        $scope.dateFilter = '';

        /* input categories are a comma sepated list of category id's
            the below will split these into an array,
            compare them to the catJson to get the category name,
            and output an array of category names */
        angular.forEach($scope.schedules, function(schedule, scheduleKey){
          if($scope.dateFilter=='') $scope.dateFilter = schedule.dayOfWeek;
          $scope.days[schedule.dayOfWeek] = $filter('date')(schedule.time_start, "d/M/yyyy");

            //check if there is more than one type
            addType = schedule.type;
            if(addType in typeArr){
              //do nothing
            }else{

              typeArr[addType]={imgName:schedule.type,transText:schedule.transType};
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
                //check if category is already in the array
                if(jQuery.inArray(addCat, categories) === -1){
                  categories.push(addCat);
                }
                //create a unique list of category names for a filter drop down
                if ($scope.tags.indexOf(addCat) == -1)
                  $scope.tags.push(addCat);
              }
            });

            schedule.category = categories;

        });

        /*
        if(typeArr.length > 1){
          $scope.showType = true;
        }*/
        $scope.showType = true;
        $scope.types = typeArr;
      }, function errorCallback(error) {
        console.log(error);
        jQuery('#page-schedule .loading').html(noMakerText);
      }).finally( function (){
       $scope.showSchedules = true;
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
    $scope.setDateFilter = function (date) {
      $scope.dateFilter = date;
    }
    $scope.setStage = function(stage){
      $scope.schedStage = stage;
    }
    $scope.setTagFilter = function (tag) {
      $scope.schedTopic = tag;
    }
    $scope.sortBy = function(propertyName) {
      $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
      $scope.propertyName = propertyName;
    };
  }]).filter('typeFilter', function() {
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