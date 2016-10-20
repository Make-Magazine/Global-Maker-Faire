var app = angular.module('mtm', []);

app.controller('mtmMakers', function($scope, $http) {
  $scope.layout = 'grid';
  $scope.category = '';
  $scope.tags = [];
  catJson = [];
  var formIDs = jQuery('#forms2use').val();
  formIDs = formIDs.replace(",","-");
  //to be added - replace commas with - in form ids
  //call to MF custom rest API
  $http.get('/wp-json/makerfaire/v1/fairedata/mtm/'+formIDs)
    .success(function(response){
      if(response.entity.length<=0){
        jQuery('.mtm .loading').html('No makers found');
      }
      $scope.makers = response.entity;
      //build array of categories
      angular.forEach(response.category,function(catArr){
        catJson[catArr.id] = catArr.name.trim();
      });
      var catList = [];
      //Owl carousel does not like to work with a ng-repeat so the images must be build and loaded
      var carouselImgs ='';
      angular.forEach($scope.makers, function(maker){
        //build carousel images
        if(maker.flag=='Featured Maker') {
          carouselImgs += '<a href="/maker/entry/'+maker.id+'"><div class="mtm-car-image" style="background: url(' + maker.featured_img + ') no-repeat center center;background-size: cover;"></div></a>';
        }
        var categories = [];
        /* input categories are in an array
        This will compare them to the catJson to get the category name,
        and add to the category list if it's not there  */
        angular.forEach(maker.category_id_refs, function(catID){
          catID = catID.trim();
          if(catID!=''){
            var addCat = catID;
            //look up cat id in the category json file to find the matching category name
            if(catID in catJson){
              addCat = catJson[catID];
            }
            categories.push(addCat);
            //create a unique list of category names for a filter drop down
            if (catList.indexOf(addCat) == -1)
              catList.push(addCat);
          }
        });
        //reset the category ids to the category names
        maker.category_id_refs = categories;
      });
      $scope.tags = catList;
      jQuery('#carouselImgs').html(carouselImgs);
    })
    .error(function(response){
      jQuery('.mtm .loading').html('There was an error retrieving makers');
    })
    .finally(function(){
      //trigger the carousel
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