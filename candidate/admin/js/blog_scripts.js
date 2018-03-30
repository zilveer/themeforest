(function($) {


$(document).ready(function($){
	"use strict";


if ($("#mm_portfolio_post_type option[value='video']").attr('selected')) {
      $('.portfolio_video_select').show();
      $('.portfolio_video_url').show();
	  $('.portfolio_gallery_block').hide();
} 
if ($("#mm_portfolio_post_type option[value='gallery']").attr('selected')) {
      $('.portfolio_video_select').hide();
      $('.portfolio_video_url').hide();
	  $('.portfolio_gallery_block').show();
} 
if ($("#mm_portfolio_post_type option[value='image']").attr('selected')) {
      $('.portfolio_video_select').hide();
      $('.portfolio_video_url').hide();
	  $('.portfolio_gallery_block').hide();
} 
$('#mm_portfolio_post_type').change(function() {
    var selectVal = $('#mm_portfolio_post_type :selected').val();

    if (selectVal=='video') {
      $('.portfolio_video_select').show('slow', function() {});
      $('.portfolio_video_url').show('slow', function() {});
	  $('.portfolio_gallery_block').hide('slow', function() {});
    }
	 if (selectVal=='gallery') {
      $('.portfolio_video_select').hide('slow', function() {});
      $('.portfolio_video_url').hide('slow', function() {});
	  $('.portfolio_gallery_block').show('slow', function() {});
    }
	 if (selectVal=='image') {
      $('.portfolio_video_select').hide('slow', function() {});
      $('.portfolio_video_url').hide('slow', function() {});
	  $('.portfolio_gallery_block').hide('slow', function() {});
    }
});	
	
	





if ($("#meta_blogposttype option[value='video']").attr('selected')) {
      $('#meta_blogvideoservice').show();
	  $('#mm_blog_audio_meta_box').hide();
	  $('#mm_blog_image_meta_box').hide();
	   $('#mm_blog_link_meta_box').hide();
}  
if ($("#meta_blogposttype option[value='blockquote']").attr('selected')) {
      $('#meta_blogvideoservice').hide();
	  $('#mm_blog_audio_meta_box').hide();
	  $('#mm_blog_image_meta_box').hide();
	   $('#mm_blog_link_meta_box').hide();
}    
if ($("#meta_blogposttype option[value='standard']").attr('selected')) {
      $('#meta_blogvideoservice').hide();
	  $('#mm_blog_audio_meta_box').hide();
	  $('#mm_blog_image_meta_box').hide();
	   $('#mm_blog_link_meta_box').hide();
}  
if ($("#meta_blogposttype option[value='audio']").attr('selected')) {
      $('#meta_blogvideoservice').hide();
	  $('#mm_blog_audio_meta_box').show();
	  $('#mm_blog_image_meta_box').hide();
	   $('#mm_blog_link_meta_box').hide();
}    
if ($("#meta_blogposttype option[value='slideshow']").attr('selected')) {
      $('#meta_blogvideoservice').hide();
	  $('#mm_blog_audio_meta_box').hide();
	   $('#mm_blog_link_meta_box').hide();
	  $('#mm_blog_image_meta_box').show();
}    
if ($("#meta_blogposttype option[value='link']").attr('selected')) {
      $('#meta_blogvideoservice').hide();
	  $('#mm_blog_audio_meta_box').hide();
	  $('#mm_blog_image_meta_box').hide();
	  $('#mm_blog_link_meta_box').show();
}    
  


  


$('#meta_blogposttype').change(function() {
    var selectVal = $('#meta_blogposttype :selected').val();

	 if (selectVal=='link') {
      $('#meta_blogvideoservice').hide('slow', function() {});
	  $('#mm_blog_image_meta_box').hide('slow', function() {});
	  $('#mm_blog_audio_meta_box').hide('slow', function() {});
	  $('#mm_blog_link_meta_box').show('slow', function() {});
    }
    if (selectVal=='video') {
      $('#meta_blogvideoservice').show('slow', function() {});
	  $('#mm_blog_image_meta_box').hide('slow', function() {});
	  $('#mm_blog_audio_meta_box').hide('slow', function() {});
	  $('#mm_blog_link_meta_box').hide('slow', function() {});
    }
	if (selectVal=='slideshow') {
	  $('#mm_blog_image_meta_box').show('slow', function() {});
	  $('#meta_blogvideoservice').hide('slow', function() {});
	  $('#mm_blog_audio_meta_box').hide('slow', function() {});
	  $('#mm_blog_link_meta_box').hide('slow', function() {});
    } 
	if (selectVal=='audio') {
	  $('#mm_blog_image_meta_box').hide('slow', function() {});
	  $('#meta_blogvideoservice').hide('slow', function() {});
	  $('#mm_blog_audio_meta_box').show('slow', function() {});
	  $('#mm_blog_link_meta_box').hide('slow', function() {});
    } 
    if (selectVal=='blockquote') {
	  $('#mm_blog_image_meta_box').hide('slow', function() {});
	  $('#meta_blogvideoservice').hide('slow', function() {});
	  $('#mm_blog_audio_meta_box').hide('slow', function() {});
	  $('#mm_blog_link_meta_box').hide('slow', function() {});
    } 
	 if (selectVal=='standard') {
	  $('#mm_blog_image_meta_box').hide('slow', function() {});
	  $('#meta_blogvideoservice').hide('slow', function() {});
	  $('#mm_blog_audio_meta_box').hide('slow', function() {});
	  $('#mm_blog_link_meta_box').hide('slow', function() {});
    } 
});



if ($("#meta_blogposttype_portfolio option[value='video']").attr('selected')) {
      $('#meta_blogvideoservice1').show();
	  $('#mm_portfolio_image_meta_box').hide();
}
if ($("#meta_blogposttype_portfolio option[value='slideshow']").attr('selected')) {
      $('#meta_blogvideoservice1').hide();
	  $('#mm_portfolio_image_meta_box').show();
}

$('#meta_blogposttype_portfolio').change(function() {
    var selectVal = $('#meta_blogposttype_portfolio :selected').val();

    if (selectVal=='video') {
     $('#meta_blogvideoservice1').show('slow', function() {});
     $('#mm_portfolio_image_meta_box').hide('slow', function() {});
    }  
	 if (selectVal=='slideshow') {
     $('#meta_blogvideoservice1').hide('slow', function() {});
     $('#mm_portfolio_image_meta_box').show('slow', function() {});
    }  
});



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  var formfield = null;

  $('#upload_image_button').click(function() {

    $('html').addClass('image');

    formfield = $('#url_image').attr('name');

    tb_show('', 'media-upload.php?type=image&TB_iframe=true');

    return false;

  });

  

  $('#delete_image_button').click(function() {

    $("img#uploaded-pic").attr('src','');

    $("input#url_image").val('');

  });

  



window.original_send_to_editor = window.send_to_editor;

window.send_to_editor = function(html){

	var fileurl;

	if (formfield != null) {

	  fileurl = $(html).filter('a').attr('href');

	  $('#url_image').val(fileurl);

	  tb_remove();

	  $('html').removeClass('image');

	  formfield = null;

	} else {

	  window.original_send_to_editor(html);

	}

};






$('.radio-holder input[type="radio"]:checked').parent('label').addClass('active_label_radio');

$('#option-general #theme_color').wrap('<div class="color_wrap"></div>');
$('#option-general .color_wrap').append('<div style="float:left;margin-right:25px;margin-top:2px;"></div><div class="custom_color_scheme"></div>');

$('.color_wrap').prev('h5').appendTo($('.color_wrap').children('div').eq(0));

$('#theme_color').appendTo($('.color_wrap').children('div').eq(0));

$('#option-general .color_wrap > div:first-child + div').append($('#option-general').find('.color').eq(0).prev('h5'));
$('#option-general .color_wrap').append($('#option-general').find('.color').eq(0));

$('.color_wrap .color').appendTo($('.color_wrap').children('div').eq(1));

$('.radio-holder > label').each(function(){

	$(this).on('click',function(){
		$(this).addClass('active_label_radio');
		$(this).siblings().removeClass('active_label_radio');
	});

});


$('.del_page').each(function(){
$(this).parent().hide();
});

$('.del_page').addClass("selected123");
$('.del_page').hide();


});

})(jQuery);	




	
	
	