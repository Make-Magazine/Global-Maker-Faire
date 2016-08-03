var app = angular.module('mtm', []);

app.controller('mtmMakers', function($scope, $http) {
  var formIDs = jQuery('#forms2use').val();
  $http.get('/wp-content/themes/MiniMakerFaire/faireData.php?type=mtm&formIDs='+formIDs)
  .then(function successCallback(response) {
    $scope.catJson = [];
    angular.forEach(response.data.category,function(catArr){
      $scope.catJson[catArr.id] = catArr.name.trim();
    });
    $scope.makers = response.data.entity;
    $scope.category = '';
    $scope.tags = [];
    /*angular.forEach($scope.makers, function(maker) {
      for (var i = 0; i < maker.category_id_refs.length; i++) {
        if ($scope.tags.indexOf(maker.category_id_refs[i]) == -1)
            $scope.tags.push(maker.category_id_refs[i]);
      }
    });*/
    /* input categories are in an array
        This will:
        compare them to the catJson to get the category name,
        and output an array of category names */
    var carouselImgs ='';
    angular.forEach($scope.makers, function(maker){
      //build carousel images
      if(maker.flag=='Featured Maker') {
        carouselImgs += '<a href="/maker/entry/'+maker.id+'"><div class="mtm-car-image" style="background: url(' + maker.large_img_url + ') no-repeat center center;background-size: cover;"></div></a>';
      }
      var categories = [];
      var catList = maker.category_id_refs;
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
      maker.category_id_refs = categories;
    })
    jQuery('#carouselImgs').html(carouselImgs);
    // Carousel init
    jQuery('.mtm-carousel').owlCarousel({
      center: true,
      autoWidth:true,
      items:2,
      loop:true,
      margin:0,
      nav:true,
      //navContainer:true,
      autoplay:true,
      autoplayHoverPause:true,
      responsive:{
        600:{
          items:3
        }
      }
    });
  }, function errorCallback(error) {
    console.log(error);
  });
  $scope.setTagFilter = function (tag) {
    $scope.category = tag;
  }
  // Clear category filter on All button click
  $scope.clearFilter = function() {
    $scope.category = '';
  };
});

app.filter('byCategory', function(){
  return function(items, maker) {
    var filtered = [];

    if (!maker || !items.length) {
      return items;
    }
    items.forEach(function(itemElement, itemIndex) {
      itemElement.category_id_refs.forEach(function(categoryElement, categoryIndex) {

        if (categoryElement === maker) {
          filtered.push(itemElement);
          return false;
        }
      });
    });
    return filtered;
  };
});