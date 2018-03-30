(function ($) { $(document).ready(function() { 

/* Post Metabox Display as per Post Format ------------------------------------------------------ */

function swm_post_template_metabox() {

	// meta boxes
	var pf_metabox = $('#swm-post-meta-box').css('display', 'none'),	
		m_video = $( '.field-swm_meta_video' ).css('display', 'none'),			
		m_gallery = $( '.field-swm_meta_post_gallery' ).css('display', 'none'),		
		video_onlick = $('#post-format-video'),						
		gallery_onlick = $('#post-format-gallery');				
		
	// video
	if ( video_onlick.is(':checked') ) {
		m_video.css('display', 'block');
		pf_metabox.css('display', 'block');
	}
		
}

/* Page Options Display as per Page Template ------------------------------------------------------ */

function swm_page_template_metabox() {

	// meta boxes
	var m_portfolio = $( '#swm_portfolio_page_image_header' ).hide(),
		m_testimonials = $( '#swm_testimonials_page' ).hide(),		
		m_archives = $( '#swm_archives_page' ).hide(),
		m_cause = $( '#swm_cause_page' ).hide(),
		m_sermons = $( '#swm_sermons_page' ).hide(),		
		template = $( '#page_template' ).val();			
	
	if ( template == 'templates/archives.php' ) { m_archives.show(); }
	if ( template == 'templates/testimonials.php' ) { m_testimonials.show(); }
	if ( template == 'templates/portfolio.php' ) { m_portfolio.show(); }
	if ( template == 'templates/cause.php' ) { m_cause.show(); }
	if ( template == 'templates/sermons.php' ) { m_sermons.show(); }
}

/* Post Metabox Display as per Post Format ------------------------------------------------------ */

function swm_page_header_options() {

	// meta boxes
	var himg_bg_col = $( "label[for='swm_meta_header_bg_color']" ).parent().parent().hide(),
	himg_bg_img = $( "label[for='swm_meta_header_bg_image']" ).parent().parent().hide(),
	himg_bg_pos = $( "label[for='swm_meta_header_bg_position']" ).parent().parent().hide(),
	himg_bg_rep = $( "label[for='swm_meta_header_bg_repeat']" ).parent().parent().hide(),
	himg_bg_att = $( "label[for='swm_meta_header_bg_attachment']" ).parent().parent().hide(),
	himg_bg_stre = $( "label[for='swm_meta_header_bg_stretch']" ).parent().parent().hide(),
	himg_bg_para = $( "label[for='swm_meta_enable_parallax_effect']" ).parent().parent().hide(),
	himg_bg_speed = $( "label[for='swm_meta_header_parallax_speed']" ).parent().parent().hide(),
	himg_bg_hgt = $( "label[for='swm_meta_header_height']" ).parent().parent().hide(),		
	h_revolution_slider = $( "label[for='swm_meta_rev_slider_shortcode']" ).parent().parent().hide(),		
	h_google_map = $( "label[for='swm_header_google_map_link']" ).parent().parent().hide();

	var header_style = $( '#swm_meta_header_style' ).val();
	
	if ( header_style == 'standard' ) {
			himg_bg_col.show();
			himg_bg_img.show();
			himg_bg_pos.show();
			himg_bg_rep.show();
			himg_bg_att.show();
			himg_bg_stre.show();
			himg_bg_para.show();
			himg_bg_speed.show();
			himg_bg_hgt.show();
	}		
	else if ( header_style == 'revolution_slider' ) {			
		h_revolution_slider.show();
	}	
	else if ( header_style == 'google_map' ) {			
		h_google_map.show();
		himg_bg_hgt.show();
	}
		
}

function swm_page_portfolio_post_options() {

	// meta boxes
	var port_video = $( "label[for='swm_portfolio_video']" ).parent().parent().hide();	

	var header_style = $( '#swm_portfolio_project_type' ).val();
	
	if ( header_style == 'video' ) {
			port_video.show();			
	}	
		
}

	/* Run all functions ------------------------------------------------------ */	

	swm_post_template_metabox();
	$( '#post-formats-select' ).on( 'change', swm_post_template_metabox );

	swm_page_template_metabox();
	$( '#page_template' ).on( 'change', swm_page_template_metabox );	

	
	swm_page_header_options();
	$( '#swm_meta_header_style' ).on( 'change', swm_page_header_options );

	swm_page_portfolio_post_options();
	$( '#swm_portfolio_project_type' ).on( 'change', swm_page_portfolio_post_options );	

	jQuery('input#customizer-upload').change(function() {
		jQuery('#customizer-submit').removeAttr('disabled');
	});

}); })(jQuery); // if document ready 

/* Multiple Featured Images */
function kdMuFeaImgSetBoxContent(content,featuredImageID,post_type){jQuery("#"+featuredImageID+"_"+post_type+" .inside").html(content);}function kdMuFeaImgSetMetaValue(id,featuredImageID,post_type){var field=jQuery("input[value=kd_"+featuredImageID+"_"+post_type+"_id]","#list-table");if(field.size()>0){jQuery("#meta\\["+field.attr("id").match(/[0-9]+/)+"\\]\\[value\\]").text(id);}}function kdMuFeaImgRemove(featuredImageID,post_type,nonce){jQuery.post(ajaxurl,{action:"set-MuFeaImg-"+featuredImageID+"-"+post_type,post_id:jQuery("#post_ID").val(),thumbnail_id:-1,_ajax_nonce:nonce,cookie:encodeURIComponent(document.cookie)},function(str){if(str=="0"){alert(setPostThumbnailL10n.error);}else{kdMuFeaImgSetBoxContent(str,featuredImageID,post_type);}});}function kdMuFeaImgSet(id,featuredImageID,post_type,nonce){var $link=jQuery("a#"+featuredImageID+"-featuredimage");$link.text(setPostThumbnailL10n.saving);jQuery.post(ajaxurl,{action:"set-MuFeaImg-"+featuredImageID+"-"+post_type,post_id:post_id,thumbnail_id:id,_ajax_nonce:nonce,cookie:encodeURIComponent(document.cookie)},function(str){if(str=="0"){alert(setPostThumbnailL10n.error);}else{var win=window.dialogArguments||opener||parent||top;$link.show().text(setPostThumbnailL10n.done);$link.fadeOut("slow",function(){jQuery("tr.MuFeaImg-"+featuredImageID+"-"+post_type).hide();});win.kdMuFeaImgSetBoxContent(str,featuredImageID,post_type);win.kdMuFeaImgSetMetaValue(id,featuredImageID,post_type);}});}