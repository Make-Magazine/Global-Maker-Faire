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
    var locText = '';
    if(jQuery(this).val()!='new'){
      locText = ( jQuery(this).find(":selected").text() );
      //hide entry location box
      jQuery('#update_entry_location_code').hide();
    } else{
      jQuery('#update_entry_location_code').show();
    }
    jQuery('#update_entry_location_code').val(locText);
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
      alert('Please enter a location');
    }else{
      var dateStart = jQuery("#datetimepickerstart").val();
      var dateEnd   = jQuery("#datetimepickerend").val();

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
        'dateEnd': dateEnd
      };
      jQuery.post(ajaxurl, data, function(response) {
        jQuery('#schedResp').text(response.msg);
      });
    }
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
    });
  });
});


