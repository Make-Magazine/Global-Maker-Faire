/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery( document ).ready(function() {
  jQuery('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
  jQuery('#datetimepickerstart').datetimepicker({
    formatTime:'g:i a',
    formatDate:'d.m.Y',
    defaultTime:'10:00 am'
  });
  jQuery('#datetimepickerend').datetimepicker({
    formatTime:'g:i a',
    formatDate:'d.m.Y',
    defaultTime:'10:00 am'
  });

  jQuery('[data-toggle="popover"]').popover();

  //on update of rating submit ajax to update value in database
  jQuery('.star-rating :radio').change(
    function(){
      jQuery('#ratingMSG').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>');
      var entry_id = jQuery("input[name=entry_info_entry_id]").val();
      var data = {
        'action': 'update-entry-rating',
        'rating_entry_id': entry_id,
        'rating': this.value,
        'rating_user': userSettings.uid
      };
      jQuery.post(ajaxurl, data, function(response) {
        jQuery('#ratingMSG').text(response.msg);
      });
    }
  );

  //on click of save status button - update status
  jQuery('#update_status').click(function(e){
      e.preventDefault();
      jQuery('#statusResp').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>');
      var entry_id = jQuery("input[name=entry_info_entry_id]").val();
      var status   = jQuery("#entry_info_status_change option:selected").val();

      var data = {
        'action': 'set_entry_status',
        'entry_id': entry_id,
        'status': status,
        'user': userSettings.uid
      };
      jQuery.post(ajaxurl, data, function(response) {
        jQuery('#statusResp').text(response.msg);
      });
    }
  );

  //on click of delete note button
  jQuery('#delete_note_sidebar').click(function(e){
      e.preventDefault();
      jQuery('#noteResp').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>');
      var entry_id = jQuery("input[name=entry_info_entry_id]").val();
      var note = jQuery('input[name=note]:checked').map(function() {
          jQuery('#note'+this.value).remove();
          return this.value;
      }).get();


      var data = {
        'action': 'delete_note_sidebar',
        'entry_id': entry_id,
        'note': note
      };
      jQuery.post(ajaxurl, data, function(response) {
        jQuery('#noteResp').text(response.msg);
      });
    jQuery('html, body').animate({
        scrollTop: jQuery("#noteResp").offset().top - 100
    }, 2000);
  });

  //update entry flags
  jQuery('#update_flags').click(function(e){
    e.preventDefault();
    jQuery('#flagResp').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>');
    var entry_id = jQuery("input[name=entry_info_entry_id]").val();
    var flags = jQuery('input[name=entry_info_flags]').map(function() {
        return this.value + '_'+this.checked;
    }).get();

    var data = {
      'action': 'update_flags',
      'entry_id': entry_id,
      'flag': flags
    };
    jQuery.post(ajaxurl, data, function(response) {
      jQuery('#flagResp').text(response.msg);
      });
  });

  //location/schedule info
  jQuery('#locationSel').change(function(){
    if(jQuery(this).val()!='new'){
      locText = jQuery(this).val();
      //hide entry location box
      jQuery('#update_entry_location_code').hide();
    } else{
      jQuery('#update_entry_location_code').show();
    }
  });

  //update location information
  jQuery('#update_entry_schedule').click(function(e){
    e.preventDefault();
    var entry_id = jQuery("input[name=entry_info_entry_id]").val();

    //get selected location
    var location   = jQuery("#locationSel option:selected").val();

    //if selected location is 'new', then pull from the add new bo
    if(location =='new'){
      location = jQuery("#update_entry_location_code").val();
    }

    if(location==''){
      alert('Location is required');
      return;
    }

    var type = jQuery("#typeSel").val();
    var dateStart = jQuery("#datetimepickerstart").val();
    var dateEnd   = jQuery("#datetimepickerend").val();

    if(dateStart != '' && type=='') {
      alert('You must select a type if a date is entered');
      return;
    }
    if(dateStart == '' && type!='') {
      alert('You must enter a date if type is selected');
      return;
    }
    if((dateStart != '' && dateEnd == '') ||
        dateStart == '' && dateEnd != '') {
      alert('Must set both start and end date');
      return;
    }
    // check if the end date is before the startdate
    edate = new Date(dateEnd);
    sdate = new Date(dateStart);
    if(edate < sdate){
      alert('End Date/Time cannot be before Start Date/Time');
      return;
    }

    //everything looks good, lets process it
    jQuery('#schedResp').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>');

    var entry_id = jQuery("input[name=entry_info_entry_id]").val();
    var flags = jQuery('input[name=entry_info_flags]').map(function() {
        return this.value + '_'+this.checked;
    }).get();

    var data = {
      'action': 'update_entry_schedule',
      'entry_id': entry_id,
      'location': location,
      'dateStart': dateStart,
      'dateEnd': dateEnd,
      'type': type
    };

    jQuery.post(ajaxurl, data, function(response) {
      jQuery('#schedResp').text(response.msg);
      jQuery("#datetimepickerstart").val('');
      jQuery("#datetimepickerend").val('');
      var locID   = response.locID;
      var schedID = response.schedID;
      if(dateStart==''&&dateEnd==''){
        //add location to the sidebar
        var newLoc = '<div id="location'+locID+'" class="locBox"><input type="checkbox" value="'+locID+'" name="delete_location_id"> <span class="stageName">'+location+'</span></div>';
      }else{
        startD = formatDate(dateStart);
        endD   = formatDate(dateEnd);
        //put it all together now
        var dispStart = startD.day+" " +startD.month+"/"+startD.date + "/" + startD.year;
        var dispTime  = startD.hour+":"+startD.min+" "+startD.ampm+" - "+
                        endD.hour+":"+endD.min+" "+endD.ampm;
        var newLoc =
          '<div id="schedule'+schedID+'" class="schedBox">'  +
            '<input type="checkbox" value="'+schedID+'" name="delete_schedule">'  +
            '<span class="schedInfo">' +
              '<span>'+location+'</span>' +
              '<div class="clear"></div>' +
              '<div class="startDt">'+dispStart+'</div>'  +
              '<span class="time">'+dispTime+'</span>'  +
              '<div class="clear"></div>'  +
              '<div class="innerInfo">Type: '+type+'</div>'  +
            '</span>'  +
            '<div class="clear"></div>' +
          '</div>';
      }

      jQuery('#entrySched #locationList').append(newLoc);
    });
  });

  //delete schedule info
  jQuery('#delete_entry_schedule').click(function(e){
    e.preventDefault();
    var schedule = [];
    var location = [];
    var entry_id = jQuery("input[name=entry_info_entry_id]").val();

    schedule = jQuery('input[name=delete_schedule]:checked').map(function() {
      jQuery('#schedule'+this.value).remove();
      return this.value;
    }).get();
    locationDel = jQuery('input[name=delete_location_id]:checked').map(function() {
      jQuery('#location'+this.value).remove();
      return this.value;
    }).get();

    var data = {
      'action': 'delete_entry_schedule',
      'entry_id': entry_id,
      'schedule': schedule,
      'location': locationDel
    };
    jQuery.post(ajaxurl, data, function(response) {
      //jQuery('#flagResp').text(response.msg);
    });
  });

  //add note
  jQuery('#add_entry_note').click(function(e){
    e.preventDefault();
    jQuery('#addNoteResp').html('<i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>');
    var note = [];
    var emailTo = [];
    var entry_id = jQuery("input[name=entry_info_entry_id]").val();

    emailTo = jQuery('input[name=email_notes_to]:checked').map(function() {
      return this.value;
    }).get();
    var note = jQuery('#new_note').val();

    var data = {
      'action': 'add_entry_note',
      'note': note,
      'entry_id': entry_id,
      'emailTo': emailTo,
      'user': userSettings.uid
    };
    jQuery.post(ajaxurl, data, function(response) {
      jQuery('#addNoteResp').text(response.msg);
      location.reload();
    });
  });

  //show schedule section when #dispSchedSect is checked
  jQuery("#dispSchedSect").change(function() {
    if(this.checked) {
      jQuery('#schedSect').show();
    }else{
      jQuery('#schedSect').hide();
    }
  });
});

function formatDate(date){
  var formatD = new Date(date);
  var d = formatD.getDate();
  var m = formatD.getMonth();
  m += 1;  // JavaScript months are 0-11
  var y = formatD.getFullYear()-2000;

  //format start date
  var curr_hour = formatD.getHours();
  if (curr_hour < 12){
    a_p = "AM";
  }else{
    a_p = "PM";
  }
  if (curr_hour == 0){curr_hour = 12;}
  if (curr_hour > 12){curr_hour = curr_hour - 12;}
  var curr_min = formatD.getMinutes();
  curr_min = curr_min + "";

  if (curr_min.length == 1){
    curr_min = "0" + curr_min;
  }

  //determine the name of the date
  var d_names = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
  var day_name = formatD.getDay();
  return {'day':d_names[day_name],'date':d,'month':m, 'year':y, 'hour':curr_hour,'min':curr_min,'ampm':a_p};
}
