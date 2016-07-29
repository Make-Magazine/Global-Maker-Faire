<?php
/*
* Template name: Schedule
*/
get_header(); ?>


<div id="page-schedule" class="container">
  <div class="container schedule-table"  ng-controller="scheduleCtrl" ng-app="scheduleApp">
    <div class="topic-nav">
      <div class="btn-group">
        <button type="button" class="btn btn-b-ghost dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Category <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li class="topic-nav-item-inner activeTopic">
            <a href="#" ng-click="setTypeFilter('all')">
              <div class="topic-nav-item">
                <p>ALL</p>
              </div>
              <div class="active-topic-arrow"></div>
            </a>
          </li>

          <li class="topic-nav-item-inner">
            <a href="#" ng-click="setTypeFilter('Talk')">
              <div class="topic-nav-item">
                <p>
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/img/talk.png" alt="Maker Exhibit Talk Topic Icon" class="img-responsive" />
                Talk</p>
              </div>
              <div class="active-topic-arrow"></div>
            </a>
          </li>

          <li class="topic-nav-item-inner">
            <a ng-click="setTypeFilter('Demo')">
              <div class="topic-nav-item">
                <p>
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/img/demo.png" alt="Maker Exhibit Demo Topic Icon" class="img-responsive" />
                Demo</p>
              </div>
              <div class="active-topic-arrow"></div>
            </a>
          </li>

          <li class="topic-nav-item-inner">
            <a ng-click="setTypeFilter('Workshop')">
              <div class="topic-nav-item">
                <p>
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/img/workshop.png" alt="Maker Exhibit Workshop Topic Icon" class="img-responsive" />
                Workshop</p>
              </div>
              <div class="active-topic-arrow"></div>
            </a>
          </li>

          <li class="topic-nav-item-inner">
            <a ng-click="setTypeFilter('Performance')">
              <div class="topic-nav-item">
                <p>
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/img/performance.png" alt="Maker Exhibit Performance Topic Icon" class="img-responsive" />
                Performance</p>
              </div>
              <div class="active-topic-arrow"></div>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <ul class="day-nav list-unstyled">
      <li class="day-nav-box active">
        <a class="day-nav-item" data-toggle="tab" href="#FridaySched">
          <h2>Education Friday</h2>
        </a>
      </li>
      <li class="day-nav-box">
        <a class="day-nav-item" data-toggle="tab" href="#SaturdaySched">
          <h2>DAY 1: SATURDAY</h2>
        </a>
      </li>
      <li class="day-nav-box">
        <a class="day-nav-item" data-toggle="tab" href="#SundaySched">
          <h2>DAY 2: SUNDAY</h2>
        </a>
      </li>
    </ul>

    <div class="row header">
      <div class="col-lg-1">&nbsp;</div>
      <div class="col-lg-4">
        <!--<span ng-click="order('name')">Title</span>
        <span class="sortorder" ng-show="predicate === 'name'" ng-class="{reverse:reverse}"></span>
        -->
        Title
      </div>
      <div class="col-lg-1">
        <!--<span ng-click="order('time_start')">Time</span>
        <span class="sortorder" ng-show="predicate === 'time_start'" ng-class="{reverse:reverse}"></span>
        -->
        Time
      </div>
      <div class="col-lg-2">
        <span class="dropdown">
          <button class="btn btn-link dropdown-toggle" type="button" id="mtm-dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Stage: {{schedStage}}
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu" aria-labelledby="mtm-dropdownMenu">
            <li>
              <a ng-click="setStage('')">All</a>
            </li>
            <li ng-repeat="schedule in schedules | unique:'nicename' | orderBy: nicename ">
              <a ng-click="setStage(schedule.nicename)">{{schedule.nicename}}</a>
            </li>
          </ul>
        </span>
      </div>
      <div class="col-lg-2">Type</div>
      <div class="col-lg-2">
        <span class="dropdown">
          <button class="btn btn-link dropdown-toggle" type="button" id="mtm-dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Topics: {{schedTopic}}
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
          </button>
          <ul class="dropdown-menu" aria-labelledby="mtm-dropdownMenu">
            <li>
              <a ng-click="setTagFilter('')">All</a>
            </li>
            <li ng-repeat="tag in tags | orderBy: tag"> <a ng-click="setTagFilter(tag)">{{ tag }}</a></li>
          </ul>
        </span>
      </div>
    </div>
    <div class="tab-content">
      <div ng-repeat="day in days" id="{{day}}Sched" ng-class="day=='Friday'?'active tab-pane':'tab-pane'">
        <div ng-repeat="schedule in schedules | dayFilter:day | typeFilter: schedType | stageFilter: schedStage | catFilter:schedTopic | filter:filterData | orderBy:predicate">
          <div class="row">
            <div class="col-lg-1"><img src="{{schedule.thumb_img_url}}" alt="{{schedule.name}}" /></div>
            <div class="col-lg-4"><h3>{{schedule.name}}</h3>
              <p class="presenterList">{{schedule.maker_list}}</p>
            </div>
            <div class="col-lg-1">{{schedule.time_start | date: "shortTime"}} - <br/>{{schedule.time_end | date: "shortTime"}}<br/></div>
            <div class="col-lg-2">{{schedule.nicename}}</div>
            <div class="col-lg-2">
              <div class="schedType">
                <img ng-if="schedule.type == 'Demo'" src="<?php echo get_bloginfo('template_directory'); ?>/img/demo.png" alt="Maker Exhibit Demo Topic Icon" class="img-responsive" />
                <img ng-if="schedule.type == 'Talk'" src="<?php echo get_bloginfo('template_directory'); ?>/img/talk.png" alt="Maker Exhibit Talk Topic Icon" class="img-responsive" />
                <img ng-if="schedule.type == 'Workshop'" src="<?php echo get_bloginfo('template_directory'); ?>/img/workshop.png" alt="Maker Exhibit Workshop Topic Icon" class="img-responsive" />
                <img ng-if="schedule.type == 'Performance'" src="<?php echo get_bloginfo('template_directory'); ?>/img/performance.png" alt="Maker Exhibit Performance Topic Icon" class="img-responsive" />
              </div>
            </div>
            <div class="col-lg-2">
              <span data-ng-repeat="catName in schedule.category">{{catName}}<font ng-show="!$last">, </font></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
jQuery(".topic-nav-item-inner").click(function() {
  jQuery(".topic-nav-item-inner.activeTopic").removeClass("activeTopic");
  jQuery(this).addClass('activeTopic');
});
jQuery( ".quick-view-toggle" ).click(function(event) {
  event.preventDefault();
  jQuery(this).closest(".schedule-row").next(".quick-view-tr").fadeToggle("medium");
});
</script>

<?php get_footer(); ?>