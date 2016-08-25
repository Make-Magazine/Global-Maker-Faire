<?php
/*
* Template name: Schedule
*/
get_header(); ?>

<input type="hidden" id="forms2use" value="<?php echo get_field('schedule_ids'); ?>" />

<div id="page-schedule" class="container schedule-table" ng-controller="scheduleCtrl" ng-app="scheduleApp">
  <div ng-cloak>
  <div class="topic-nav" ng-if="showType">
    <div class="btn-group">
      <button type="button" class="btn btn-b-ghost dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Category <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <li class="topic-nav-item-inner activeTopic" ng-class="{ 'activeTopic': schedType== 'all' }">
          <a href="#" ng-click="setTypeFilter('all')">
            <div class="topic-nav-item">
              <p>ALL</p>
            </div>
            <div class="active-topic-arrow"></div>
          </a>
        </li>

        <li class="topic-nav-item-inner" ng-repeat="type in types" ng-class="{ 'activeTopic': type==schedType }">
          <a href="#" ng-click="setTypeFilter(type)">
            <div class="topic-nav-item">
              <p>
                <img src="<?php echo get_bloginfo('template_directory'); ?>/img/{{type}}-icon.svg" alt="Maker Exhibit {{type}} Topic Icon" class="img-responsive" />
                {{type}}
              </p>
            </div>
            <div class="active-topic-arrow"></div>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <ul class="day-nav list-unstyled">
    <li class="day-nav-box" ng-repeat="(schedDay,schedule) in schedules" ng-class="{'active':$first}">
      <a class="day-nav-item" data-toggle="tab" href="#Sched{{schedDay | date: 'd'}}"  ng-click="setDateFilter(schedDay)">
        <h2>{{schedDay | date: "EEEE"}}</h2><br/>
        <h4>{{schedDay | date: "shortDate"}}</h4>
      </a>
    </li>
  </ul>

  <div class="sched-table">
    <div class="row sched-header">
      <div class="sched-col-1"></div>
      <div class="sched-flex-row">
        <div class="sched-col-2">
          <span ng-click="sortBy('name')">Title</span>
          <span class="sortorder" ng-show="propertyName === 'name'" ng-class="{reverse: reverse}"></span>
        </div>

        <div class="sched-col-3">
          <span ng-click="sortBy('time_start')">Time</span>
          <span class="sortorder" ng-show="propertyName === 'time_start'" ng-class="{reverse: reverse}"></span>
        </div>

        <div class="sched-col-4">
          <span class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="mtm-dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Stage {{schedStage}}
              <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="mtm-dropdownMenu">
              <li>
                <a ng-click="setStage('')">All</a>
              </li>
              <li ng-repeat="schedule in schedules[dateFilter] | unique:'nicename' | orderBy: nicename ">
                <a ng-click="setStage(schedule.nicename)">{{schedule.nicename}}</a>
              </li>
            </ul>
          </span>
        </div>

        <div class="sched-col-5">
          <span ng-click="sortBy('type')">Type</span>
          <span class="sortorder" ng-show="propertyName === 'type'" ng-class="{reverse: reverse}"></span>
        </div>

        <div class="sched-col-6">
          <span class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="mtm-dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Topics {{schedTopic}}
              <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
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

    </div>



    <div class="tab-content sched-body">
      <div ng-repeat="(schedDay,schedule) in schedules" id="Sched{{schedDay | date: 'd'}}" class="tab-pane" ng-class="{ 'active': $first }">
        <div ng-repeat="(key,daySched) in schedule | typeFilter: schedType | stageFilter: schedStage | catFilter:schedTopic | filter:filterData |  orderBy:propertyName:reverse">
          <div class="row sched-row">
            <div class="sched-col-1">
              <a href="/maker/entry/{{daySched.id}}">
                <div class="sched-img" style="background-image: url({{daySched.thumb_img_url}});"></div>
              </a>
            </div>

            <div class="sched-flex-row">
              <div class="sched-col-2">
                <h3>
                  <a href="/maker/entry/{{daySched.id}}">{{daySched.name}}</a>
                </h3>
                <p class="sched-description">{{daySched.maker_list}}</p>
              </div>

              <div class="sched-col-3">{{daySched.time_start | date: "EEEE"}}<br/>{{daySched.time_start | date: "shortTime"}} - <br/>{{daySched.time_end | date: "shortTime"}}</div>

              <div class="sched-col-4">{{daySched.nicename}}</div>

              <div class="sched-col-5 sched-type">
                <img ng-if="daySched.type == 'Demo'" src="<?php echo get_bloginfo('template_directory'); ?>/img/Demo-icon.svg" alt="Maker Exhibit Demo Topic Icon" class="img-responsive" />
                <img ng-if="daySched.type == 'Talk'" src="<?php echo get_bloginfo('template_directory'); ?>/img/Talk-icon.svg" alt="Maker Exhibit Talk Topic Icon" class="img-responsive" />
                <img ng-if="daySched.type == 'Workshop'" src="<?php echo get_bloginfo('template_directory'); ?>/img/Workshop-icon.svg" alt="Maker Exhibit Workshop Topic Icon" class="img-responsive" />
                <img ng-if="daySched.type == 'Performance'" src="<?php echo get_bloginfo('template_directory'); ?>/img/Performance-icon.svg" alt="Maker Exhibit Performance Topic Icon" class="img-responsive" />
              </div>

              <div class="sched-col-6">
                <div class="overflow-ellipsis-text">
                  <span data-ng-repeat="catName in daySched.category">{{catName}}<font ng-show="!$last">, </font></span>
                </div>
              </div>
            </div>

            <div class="col-xs-10 col-xs-offset-2 sched-more-info">
              <div class="panel-heading">
                <span ng-click="schedule.isCollapsed = !schedule.isCollapsed" ng-init="schedule.isCollapsed=true">quick view
                  <i class="fa fa-lg" ng-class="{'fa-angle-down': schedule.isCollapsed, 'fa-angle-up': !schedule.isCollapsed}"></i>
                </span>
              </div>
              <div collapse="schedule.isCollapsed">
                <div ng-show="!schedule.isCollapsed" class="panel-body">
                  <p>{{daySched.desc}}</p>
                  <a href="/maker/entry/{{daySched.id}}">full details</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div></div>

<?php get_footer(); ?>