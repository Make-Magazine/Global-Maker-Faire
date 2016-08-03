<?php
/*
* Template name: Meet the Makers
*/
get_header(); ?>

<div class="mtm" ng-app="mtm">
  <div ng-controller="mtmMakers">
    <input type="hidden" id="forms2use" value="<?php echo get_field('form_id'); ?>" />
    <div class="container">
      <h1 class="text-center"><?php echo get_the_title(); ?></h1>
    </div>
    <div class="mtm-carousel-cont">
      <div id="carouselImgs" class="mtm-carousel owl-carousel">
      </div>

      <a id="left-trigger" class="left carousel-control" href="#" role="button" data-slide="prev">
        <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_left.png" alt="Image Carousel button left" />
        <span class="sr-only">Previous</span>
      </a>
      <a id="right-trigger" class="right carousel-control" href="#" role="button" data-slide="next">
        <img class="glyphicon-chevron-right" src="<?php echo get_bloginfo('template_directory');?>/img/arrow_right.png" alt="Image Carousel button right" />
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!--//end old-->
    <div class="container">
      <h2 class="text-center">Explore our Maker Exhibits!</h2>
    </div>
    <div class="flag-banner"></div>

    <div class="mtm-search">
      <form class="form-inline">
        <label for="mtm-search-input">Search:</label>
        <input ng-model="makerSearch.$" id="mtm-search-input" class="form-control" placeholder="Looking for a specific Exhibit or Maker?" type="text">
        <!--input class="form-control btn-w-ghost" value="GO" type="submit"-->
      </form>
    </div>


    <div class="mtm-filter container">
      <div class="mtm-filter-view">
        <span class="mtm-view-by">View by:</span>
        <a class="mtm-filter-g pointer-on-hover"><i class="fa fa-picture-o" aria-hidden="true"></i> GALLERY</a>
        <span class="mtm-pipe">|</span>
        <a class="mtm-filter-l pointer-on-hover"><i class="fa fa-th-list" aria-hidden="true"></i> LIST</a>
      </div>

      <div class="dropdown">
        <button class="btn btn-link dropdown-toggle" type="button" id="mtm-dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Filter by Topics: {{category}}
          <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </button>

        <ul class="dropdown-menu" aria-labelledby="mtm-dropdownMenu">
          <li>
            <a class="pointer-on-hover" ng-click="clearFilter()">All</a>
          </li>
          <li ng-repeat="tag in tags | orderBy: tag">
            <a class="pointer-on-hover" ng-click="setTagFilter(tag)">{{ tag }}</a>
          </li>
        </ul>

      </div>
    </div>

    <div class="mtm-results">
      <div class="mtm-results-cont">
        <div ng-repeat="maker in makers | filter : makerSearch | byCategory:category" >
          <a href="/maker/entry/{{maker.id}}">
            <article class="mtm-maker" style="background-image: url('{{ maker.large_img_url }}')">
              <h3>{{ maker.name }}</h3>
            </article>
          </a>
        </div>
        <div class="clearfix"></div>

      </div>
    </div>
  </div>



</div>

<script>
  jQuery(document).ready(function(){
    // Gallery and list view
    jQuery(".mtm-filter-l").click( function(event) {
      event.preventDefault();
      jQuery(".mtm-results-cont").addClass("container");
    });
    jQuery(".mtm-filter-g").click( function(event) {
      event.preventDefault();
      jQuery(".mtm-results-cont").removeClass("container");
    });

    // Carousel left right
    jQuery( "#right-trigger" ).click(function() {
      jQuery( ".owl-next" ).click();
    });
    jQuery( "#left-trigger" ).click(function() {
      jQuery( ".owl-prev" ).click();
    });
  });
</script>

<?php get_footer(); ?>
