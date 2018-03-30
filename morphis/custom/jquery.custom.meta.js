/*-----------------------------------------------------------------------------------

 	Custom js for meta boxes of pages/posts and post types
 
-----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function($) {

	// hide layer slider option id
	var layer_slider_id_row = jQuery( '#_cmb_layer_slider_id' ).closest('tr');
	layer_slider_id_row.css('display','none');

/*----------------------------------------------------------------------------------*/
/*	Home - Masonry when selecting Posts OR Portfolio Items to show
/*----------------------------------------------------------------------------------*/

	var masonryPostLayout = jQuery('label[for="_cmb_exclude_masonry_cat_multi"]').closest('tr');
	masonryPostLayout.css('display', 'none');
	
	var masonryPortfolioLayout =  jQuery('label[for="_cmb_exclude_masonry_portfolio_cat_multi"]').closest('tr');
	masonryPortfolioLayout.css('display', 'none');

	var masonryItemsSelect = jQuery('#_cmb_masonry_items_select');
	masonryItemsSelect.change( function() {
		if(jQuery(this).val() == 'post') {						
			hideMasonryLayoutExcludeCats();
			masonryPostLayout.css('display', 'table-row');
		} else if(jQuery(this).val() == 'portfolio') {			
			hideMasonryLayoutExcludeCats();
			masonryPortfolioLayout.css('display', 'table-row');
		} else {
			
		}
	});
	
	var selectedMasonryLayout = jQuery('#_cmb_masonry_items_select option:selected');
	if(selectedMasonryLayout.val() == 'post') {	
		hideMasonryLayoutExcludeCats();
		masonryPostLayout.css('display', 'table-row');
	} else if (selectedMasonryLayout.val() == 'portfolio') {
		hideMasonryLayoutExcludeCats();
		masonryPortfolioLayout.css('display', 'table-row');
	} else {
		hideMasonryLayoutExcludeCats();
		masonryPostLayout.css('display', 'table-row');
	}				
	
	function hideMasonryLayoutExcludeCats() {
			masonryPortfolioLayout.css('display', 'none');
			masonryPostLayout.css('display', 'none');			
	}

/*----------------------------------------------------------------------------------*/
/*	Home Page Template Meta Box
/*----------------------------------------------------------------------------------*/
	var homePageCustomMetaBox = jQuery('#headline_box');
	homePageCustomMetaBox.css('display', 'none');


/*----------------------------------------------------------------------------------*/
/*	Page/Post Headline Settings Meta Box
/*----------------------------------------------------------------------------------*/
	var pagespostsCustomMetaBox = jQuery('#headline_box_pages_posts');
	pagespostsCustomMetaBox.css('display', 'none');

	
	
/*----------------------------------------------------------------------------------*/
/*	Portfolio Page Template Meta Box
/*----------------------------------------------------------------------------------*/
	var portfolioPageCustomMetaBox = jQuery('#portfolio_page_layout');
	portfolioPageCustomMetaBox.css('display', 'none');

/*----------------------------------------------------------------------------------*/
/*	Home Page - Masonry Page Template Meta Box
/*----------------------------------------------------------------------------------*/
	var masonryCustomMetaBox = jQuery('#masonry_page_layout');
	masonryCustomMetaBox.css('display', 'none');


/*----------------------------------------------------------------------------------*/
/*	Page Template Meta Box
/*----------------------------------------------------------------------------------*/
	var contactPageCustomMetaBox = jQuery('#contact_page_template_mb');
	contactPageCustomMetaBox.css('display', 'none');
	
	var pageLayout = jQuery('#page_layout');
	pageLayout.css('display', 'block');

	var blogPageMainLayoutOption = jQuery('#_cmb_page_layout_main').closest('tr');
	blogPageMainLayoutOption.css('display', 'none');
		
/*----------------------------------------------------------------------------------*/
/*	Hide/Show Meta Boxes based on Page Attributes Template selection
/*----------------------------------------------------------------------------------*/
	
	var templateSelect = jQuery('#page_template');
	templateSelect.change( function() {
		
		if(jQuery(this).val() == 'template-home.php') {			
			homePageCustomMetaBox.css('display', 'block');
			pageLayout.css('display', 'none');
			hideAllPageTemplateMetaBoxesButNot(homePageCustomMetaBox);
		} else if(jQuery(this).val() == 'template-contact.php') {			
			contactPageCustomMetaBox.css('display', 'block');
			pageLayout.css('display', 'block');
			hideAllPageTemplateMetaBoxesButNot(contactPageCustomMetaBox);
		} else if(jQuery(this).val() == 'template-blog.php') {			
			blogPageMainLayoutOption.css('display', 'table-row');
			pageLayout.css('display', 'block');
			hideAllPageTemplateMetaBoxesButNot(blogPageMainLayoutOption);			
		} else if(jQuery(this).val() == 'template-full-width.php') {			
			//blogPageMainLayoutOption.css('display', 'table-row');
			pageLayout.css('display', 'none');
			contactPageCustomMetaBox.css('display', 'none');
			homePageCustomMetaBox.css('display', 'none');		
			//hideAllPageTemplateMetaBoxesButNot(blogPageMainLayoutOption);			
			portfolioPageCustomMetaBox.css('display', 'none');			
		} else if(jQuery(this).val() == 'portfolio.php') {									
			hideAllPageTemplateMetaBoxesButNot(portfolioPageCustomMetaBox);	
			pageLayout.css('display', 'none');
		} else if(jQuery(this).val() == 'template-home-masonry.php') {									
			hideAllPageTemplateMetaBoxesButNot(masonryCustomMetaBox);	
			pageLayout.css('display', 'none');			
		} else if(jQuery(this).val() == 'default') {
			blogPageMainLayoutOption.css('display', 'none');
			homePageCustomMetaBox.css('display', 'none');
		} else {			
			homePageCustomMetaBox.css('display', 'none');		
			pageLayout.css('display', 'block');
			contactPageCustomMetaBox.css('display', 'none');	
			portfolioPageCustomMetaBox.css('display', 'none');	
			masonryCustomMetaBox.css('display', 'none');				
		}
		
		if(jQuery(this).val() != 'template-home.php' && jQuery(this).val() != 'template-home-masonry.php' && jQuery(this).val() != 'portfolio.php'  ){
			pagespostsCustomMetaBox.css('display', 'block');
		}
		
	});
	
	var selectedTemplate = jQuery('#page_template option:selected');
		if(selectedTemplate.val() == 'template-home.php') {	
			homePageCustomMetaBox.css('display', 'block');
			pageLayout.css('display', 'none');
		}	
		if(selectedTemplate.val() == 'template-home-masonry.php') {	
			masonryCustomMetaBox.css('display', 'block');
			pageLayout.css('display', 'none');
		}	
		if(selectedTemplate.val() == 'template-contact.php') {	
			contactPageCustomMetaBox.css('display', 'block');
		}	
		if(selectedTemplate.val() == 'template-blog.php') {	
			blogPageMainLayoutOption.css('display', 'table-row');
		}
		if(selectedTemplate.val() == 'template-full-width.php') {	
			pageLayout.css('display', 'none');
		}		
		if(selectedTemplate.val() == 'portfolio.php') {	
			portfolioPageCustomMetaBox.css('display', 'block');
			pageLayout.css('display', 'none');
			//pageLayout.css('display', 'block');
			//blogPageMainLayoutOption.css('display', 'table-row');
		}		
		
		if(selectedTemplate.val() == 'default'||
			selectedTemplate.val() == 'template-full-width.php'||
			selectedTemplate.val() == 'template-blog.php'||
			selectedTemplate.val() == 'template-contact.php') {	
				pagespostsCustomMetaBox.css('display', 'block');
		}
		
	
	function hideAllPageTemplateMetaBoxesButNot(me_){
		homePageCustomMetaBox.css('display', 'none');		
		masonryCustomMetaBox.css('display', 'none');	
		contactPageCustomMetaBox.css('display', 'none');
		blogPageMainLayoutOption.css('display', 'none');
		portfolioPageCustomMetaBox.css('display', 'none');	
		pagespostsCustomMetaBox.css('display', 'none');
		if(me_ == blogPageMainLayoutOption) {
			me_.css('display', 'table-row');
		} else {
			me_.css('display','block');
		}
	}
	

	
	
	
	

	
/*----------------------------------------------------------------------------------*/
/*	Portfolio Post Type Attachment 
/*----------------------------------------------------------------------------------*/
	var portfolioImageAttachmentUploadField = jQuery('#_cmb_attachment_image');
	var portfolioMultiImageAttachmentUploadField = jQuery('#_cmb_attachment_multiple_images');
	var portfolioVimeoAttachmentTextField = jQuery('#_cmb_attachment_vimeo');
	var portfolioYoutubeAttachmentTextField = jQuery('#_cmb_attachment_youtube');
	var portfolioSlideshowAttachmentTextAreaField = jQuery('#_cmb_attachment_slideshow');
	
	var portfolioImageAttachmentUploadFieldRow = jQuery(portfolioImageAttachmentUploadField.closest('tr'));
	var portfolioMultiImageAttachmentUploadFieldRow = jQuery(portfolioMultiImageAttachmentUploadField.closest('tr'));
	var portfolioVimeoAttachmentTextFieldRow = jQuery(portfolioVimeoAttachmentTextField.closest('tr'));
	var portfolioYoutubeAttachmentTextFieldRow = jQuery(portfolioYoutubeAttachmentTextField.closest('tr'));
	var portfolioSlideshowAttachmentTextAreaFieldRow = jQuery(portfolioSlideshowAttachmentTextAreaField.closest('tr'));
	
	portfolioImageAttachmentUploadFieldRow.hide("slow");
	portfolioMultiImageAttachmentUploadFieldRow.hide("slow");
	portfolioVimeoAttachmentTextFieldRow.hide("slow");
	portfolioYoutubeAttachmentTextFieldRow.hide("slow");
	portfolioSlideshowAttachmentTextAreaFieldRow.hide("slow");
	
/*----------------------------------------------------------------------------------*/
/*	Hide/Show Portfolio Attachment Field based on Selected Attachment Type
/*----------------------------------------------------------------------------------*/
	
	var templateSelect = jQuery('#_cmb_select_attachment');
	templateSelect.change( function() {
		
		if(jQuery(this).val() == 'image') {			
			hideAllButNot(portfolioImageAttachmentUploadFieldRow);
		} else if(jQuery(this).val() == 'multiple_image') {			
			hideAllButNot(portfolioMultiImageAttachmentUploadFieldRow);
		} else if(jQuery(this).val() == 'vimeo') {			
			hideAllButNot(portfolioVimeoAttachmentTextFieldRow);
		} else if(jQuery(this).val() == 'youtube') {			
			hideAllButNot(portfolioYoutubeAttachmentTextFieldRow);
		} else if(jQuery(this).val() == 'slideshow') {			
			hideAllButNot(portfolioSlideshowAttachmentTextAreaFieldRow);
		}
		
	});
	
	function hideAllButNot(me_){
		portfolioImageAttachmentUploadFieldRow.stop().hide("slow");
		portfolioMultiImageAttachmentUploadFieldRow.stop().hide("slow");
		portfolioVimeoAttachmentTextFieldRow.stop().hide("slow");
		portfolioYoutubeAttachmentTextFieldRow.stop().hide("slow");
		portfolioSlideshowAttachmentTextAreaFieldRow.stop().hide("slow");
		me_.stop().show("slow");
	}
	
	var selectedAttachment = jQuery('#_cmb_select_attachment option:selected');
		if(selectedAttachment.val() == 'image') {	
			portfolioImageAttachmentUploadFieldRow.show("slow");
		} else if(selectedAttachment.val() == 'multiple_image') {	
			portfolioMultiImageAttachmentUploadFieldRow.show("slow");
		} else if(selectedAttachment.val() == 'vimeo') {	
			portfolioVimeoAttachmentTextFieldRow.show("slow");
		} else if(selectedAttachment.val() == 'youtube') {	
			portfolioYoutubeAttachmentTextFieldRow.show("slow");
		} else if(selectedAttachment.val() == 'slideshow') {	
			portfolioSlideshowAttachmentTextAreaFieldRow.show("slow");
		}	
	

/*----------------------------------------------------------------------------------*/
/*	Post Format Meta Boxes
/*----------------------------------------------------------------------------------*/
	var linkPfMetaBox = jQuery('#link_pf_settings');
	linkPfMetaBox.css('display', 'none');
	
	var videoPfMetaBox = jQuery('#video_pf_settings');
	videoPfMetaBox.css('display', 'none');
	
	var statusPfMetaBox = jQuery('#status_pf_settings');
	statusPfMetaBox.css('display', 'none');
	
	var imagePfMetaBox = jQuery('#image_pf_settings');
	imagePfMetaBox.css('display', 'none');
	
	var quotePfMetaBox = jQuery('#quote_pf_settings');
	quotePfMetaBox.css('display', 'none');
	
	var audioPfMetaBox = jQuery('#audio_pf_settings');
	audioPfMetaBox.css('display', 'none');
	
	var chatPfMetaBox = jQuery('#chat_pf_settings');
	chatPfMetaBox.css('display', 'none');
	
	var asidePfMetaBox = jQuery('#aside_pf_settings');
	asidePfMetaBox.css('display', 'none');
	
	var linkPfMetaBoxTrigger = jQuery('#post-format-link');
	var statusPfMetaBoxTrigger = jQuery('#post-format-status');
	var videoPfMetaBoxTrigger = jQuery('#post-format-video');
	var imagePfMetaBoxTrigger = jQuery('#post-format-image');
	var quotePfMetaBoxTrigger = jQuery('#post-format-quote');
	var audioPfMetaBoxTrigger = jQuery('#post-format-audio');
	var chatPfMetaBoxTrigger = jQuery('#post-format-chat');
	var asidePfMetaBoxTrigger = jQuery('#post-format-aside');
		
	
	var postFormatSelect = jQuery('#post-formats-select input');
	
	postFormatSelect.change( function() {
		
		if(jQuery(this).val() == 'link') {			
			linkPfMetaBox.css('display', 'block');
			hideAllPostFormatButNot(linkPfMetaBox);
		} else if(jQuery(this).val() == 'status') {			
			statusPfMetaBox.css('display', 'block');
			hideAllPostFormatButNot(statusPfMetaBox);
		} else if(jQuery(this).val() == 'video') {			
			videoPfMetaBox.css('display', 'block');
			hideAllPostFormatButNot(videoPfMetaBox);
		} else if(jQuery(this).val() == 'image') {			
			imagePfMetaBox.css('display', 'block');
			hideAllPostFormatButNot(imagePfMetaBox);
		} else if(jQuery(this).val() == 'quote') {			
			quotePfMetaBox.css('display', 'block');
			hideAllPostFormatButNot(quotePfMetaBox);
		} else if(jQuery(this).val() == 'audio') {			
			audioPfMetaBox.css('display', 'block');
			hideAllPostFormatButNot(audioPfMetaBox);
		} else if(jQuery(this).val() == 'chat') {			
			chatPfMetaBox.css('display', 'block');
			hideAllPostFormatButNot(chatPfMetaBox);
		} else if(jQuery(this).val() == 'aside') {			
			asidePfMetaBox.css('display', 'block');
			hideAllPostFormatButNot(asidePfMetaBox);
		} else {
			linkPfMetaBox.css('display', 'none');
			statusPfMetaBox.css('display', 'none');
			videoPfMetaBox.css('display', 'none');
			imagePfMetaBox.css('display', 'none');
			quotePfMetaBox.css('display', 'none');
			audioPfMetaBox.css('display', 'none');
			chatPfMetaBox.css('display', 'none');
			asidePfMetaBox.css('display', 'none');
		}
		
	});
	
	function hideAllPostFormatButNot(me_){
		linkPfMetaBox.css('display', 'none');
		statusPfMetaBox.css('display', 'none');
		videoPfMetaBox.css('display', 'none');
		imagePfMetaBox.css('display', 'none');
		quotePfMetaBox.css('display', 'none');
		audioPfMetaBox.css('display', 'none');
		chatPfMetaBox.css('display', 'none');
		asidePfMetaBox.css('display', 'none');
		me_.css('display', 'block');
	}
	
	
	if(linkPfMetaBoxTrigger.is(':checked'))
		linkPfMetaBox.css('display', 'block');
		
	if(statusPfMetaBoxTrigger.is(':checked'))
		statusPfMetaBox.css('display', 'block');
		
	if(videoPfMetaBoxTrigger.is(':checked'))
		videoPfMetaBox.css('display', 'block');
		
	if(imagePfMetaBoxTrigger.is(':checked'))
		imagePfMetaBox.css('display', 'block');
	
	if(quotePfMetaBoxTrigger.is(':checked'))
		quotePfMetaBox.css('display', 'block');
		
	if(audioPfMetaBoxTrigger.is(':checked'))
		audioPfMetaBox.css('display', 'block');
	
	if(chatPfMetaBoxTrigger.is(':checked'))
		chatPfMetaBox.css('display', 'block');
		
	if(asidePfMetaBoxTrigger.is(':checked'))
		asidePfMetaBox.css('display', 'block');
		
		
	// layer slider
	var homesliderPfMetaBox = jQuery('#_cmb_home_slider');	
	homesliderPfMetaBox.change( function() {
		if( jQuery(this).val() == 'layerslider' ) {
			layer_slider_id_row.css('display','table-row');
		} else {
			layer_slider_id_row.css('display','none');
		}
	});		
	var selectedhomeslider = jQuery('#_cmb_home_slider option:selected');
	if(selectedhomeslider.val() == 'layerslider') {	
			layer_slider_id_row.css('display','table-row');
	}			
	
	
});