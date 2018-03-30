jQuery(document).ready(function() {
	jQuery('html, body').animate({scrollTop:0},0);	
	jQuery('#duotive-admin-panel img.hint-icon[title]').tooltip({ 'effect':'slide', 'offset':[-9, 0],'layout': '<div><span class="arrow"></span></div>'});								   
	jQuery("#duotive-admin-panel").jqTransform();
	jQuery("#duotive-admin-panel div.table-row:even").addClass('table-row-alternative');
	jQuery('#slides .table-row-last,#general .table-row-last').prev('div').addClass('table-row-beforelast');	
	jQuery('#addslideshow .table-row-last').prev('div').addClass('table-row-beforelast');					
	jQuery('#addslide .table-row-last').prev('div').addClass('table-row-beforelast');						
	//UPLOAD BUTTONS
	jQuery('#slideshow_background_image_button').click(function() {
		 formfield = jQuery('#slideshow_background_image').attr('name');
		 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		 destination = 'slideshow-bg';
		 return false;
	});

	jQuery('#slide_image_button').click(function() {
		 formfield = jQuery('#slide_image').attr('name');
		 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		 destination = 'add-slide';			 
		 return false;
	});
	
	jQuery('#slidestaticimage_button').click(function() {
		 formfield = jQuery('#slidestaticimage').attr('name');
		 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		 destination = 'add-slidestaticimage';			 
		 return false;
	});			
	window.send_to_editor = function(html) {
		switch(destination)
		{
			case 'slideshow-bg':
				 imgurl = jQuery('img',html).attr('src');
				 jQuery('#slideshow_background_image').val(imgurl);
			break; 
			case 'add-slide':
				imgurl2 = jQuery('img',html).attr('src');
				jQuery('#slide_image').val(imgurl2);
			break;
			case 'add-slidestaticimage':
				imgurl3 = jQuery('img',html).attr('src');
				jQuery('#slidestaticimage').val(imgurl3);
			break;					
		}
		tb_remove();
	}
	jQuery("#dialog").dialog({
	  autoOpen: false,
	  modal: true
	});
	
	jQuery(".confirmLink").click(function(e) { 
		e.preventDefault();
		
		var targetUrl = jQuery(this).attr("href");
		jQuery("#dialog").dialog({
		  buttons : {
			"Yes" : function() {
			  window.location.href = targetUrl;
			},
			"No" : function() {
			  jQuery(this).dialog("close");
			}
		  }
		});
	
		jQuery("#dialog").dialog("open");
	});
	jQuery('#duotive-admin-panel div.row-content').toggle();
	jQuery('#duotive-admin-panel div.row-header').click(function() {
		jQuery(this).toggleClass('row-header-active');
		jQuery(this).next('.row-content').addClass('row-content-active');
		jQuery(this).next('.row-content').stop(true, true).slideToggle('fast', function(){});
	});		
    jQuery('.cancel-edit-button').click(function(){
        parent.history.back();
        return false;                             
    });
	
	jQuery('.edit-slideshow-caller').click(function(){
		var slideshowID = jQuery(this).attr('href');
		jQuery('.edit-slide-wrapper').css('height',0);
		jQuery(slideshowID).animate({'height':266},200);
	});	
});		