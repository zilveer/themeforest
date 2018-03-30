(function($) {
  "use strict";
  try {
	  // first, hide the image and video field.
	  var cover_post_type =  $('table.cmb_metabox select[name="saturn_cover_screen"]').val();
	  saturn_hide_show_the_field( cover_post_type );
	  // check the action.
	  $('table.cmb_metabox select[name="saturn_cover_screen"]').change(function(){
		  cover_post_type =  $('table.cmb_metabox select[name="saturn_cover_screen"]').val();
		  saturn_hide_show_the_field( cover_post_type );
	  });
	}
  catch(e) {
		// TODO: handle exception
		console.log('error');
  }
  function saturn_hide_show_the_field( type ){
	  if( type === undefined || type === null || type=='' ){
		  $('.cmb_id_saturn_cover_screen_imageurl, .cmb_id_saturn_cover_screen_videourl').hide();
	  }	
	  if( type == 'image' ){
		  $('.cmb_id_saturn_cover_screen_imageurl').show();
		  $('.cmb_id_saturn_cover_screen_videourl').hide();
	  }
	  if( type == 'video' ){
		  $('.cmb_id_saturn_cover_screen_videourl').show();
		  $('.cmb_id_saturn_cover_screen_imageurl').hide();
	  }	
  }
 })(jQuery);