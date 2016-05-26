<?php
/*
* Template name: Schedule
*/
get_header(); ?>


<div id="page-schedule" class="container">
  <div class="topic-nav">
    <div class="btn-group">
      <button type="button" class="btn btn-b-ghost dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Category <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <li class="topic-nav-item-inner activeTopic">
          <div class="topic-nav-item">
            <p>ALL</p>
          </div>
          <div class="active-topic-arrow"></div>
        </li>

        <li class="topic-nav-item-inner">
          <div class="topic-nav-item">
            <p>
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/talk.png" alt="Maker Exhibit Talk Topic Icon" class="img-responsive" />
            Talk</p>
          </div>
          <div class="active-topic-arrow"></div>
        </li>

        <li class="topic-nav-item-inner">
          <div class="topic-nav-item">
            <p>
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/demo.png" alt="Maker Exhibit Demo Topic Icon" class="img-responsive" />
            Demo</p>
          </div>
          <div class="active-topic-arrow"></div>
        </li>

        <li class="topic-nav-item-inner">
          <div class="topic-nav-item">
            <p>
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/workshop.png" alt="Maker Exhibit Workshop Topic Icon" class="img-responsive" />
            Workshop</p>
          </div>
          <div class="active-topic-arrow"></div>
        </li>

        <li class="topic-nav-item-inner">
          <div class="topic-nav-item">
            <p>
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/performance.png" alt="Maker Exhibit Performance Topic Icon" class="img-responsive" />
            Performance</p>
          </div>
          <div class="active-topic-arrow"></div>
        </li>
      </ul>
    </div>
  </div>

  <ul class="day-nav nav nav-tabs">
    <li class="day-nav-box active">
      <div class="day-nav-item active">
        <a data-toggle="tab" href="#FridaySched">
          <h2>Education Friday</h2>
        </a>
      </div>
    </li>
    <li class="day-nav-box">
      <div class="day-nav-item">
        <a data-toggle="tab" href="#SaturdaySched">
          <h2>DAY 1: SATURDAY</h2>
        </a>
      </div>
    </li>
    <li class="day-nav-box">
      <div class="day-nav-item">
        <a data-toggle="tab" href="#SundaySched">
          <h2>DAY 2: SUNDAY</h2>
        </a>
      </div>
    </li>
  </ul>

  <div class="container schedule-table"  ng-controller="scheduleCtrl" ng-app="scheduleApp">
    <div class="row header">
        <div class="col-lg-1">&nbsp;</div>
        <div class="col-lg-4">Title</div>
        <div class="col-lg-1">Time</div>
        <div class="col-lg-2">Stage</div>
        <div class="col-lg-2">Type</div>
        <div class="col-lg-2">Topics</div>
    </div>
<div class="tab-content">
    <div ng-repeat="day in days" id="{{day}}Sched" ng-class="day=='Friday'?'active tab-pane':'tab-pane'">
      <div ng-repeat="schedule in schedules | dayFilter:day | orderBy: 'time_start'">
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
          <div class="col-lg-2">{{schedule.category}}</div>
        </div>
      </div>
    </div>
</div>
  </div>


</div>



<script>
jQuery( ".quick-view-toggle" ).click(function(event) {
  event.preventDefault();
  jQuery(this).closest(".schedule-row").next(".quick-view-tr").fadeToggle("medium");
});
</script>

<?php get_footer(); ?>