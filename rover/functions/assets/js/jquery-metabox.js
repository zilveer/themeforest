jQuery(document).ready(function() {

	/*----------------------------------------------------------------------------------*/
	/*	Portfolio Custom Fields Hide/Show
	/*----------------------------------------------------------------------------------*/
	
	/*Image Options*/
	var Portfolio_ImageOptions = jQuery('#TR_portfolio_image_meta_box');
	var Portfolio_ImageTrigger = jQuery('#TR_portfolio_type_image');	
	Portfolio_ImageOptions.css('display', 'none');

	/*Slideshow Options*/
	var Portfolio_SlideshowOptions = jQuery('#TR_portfolio_image_meta_box');
	var Portfolio_SlideshowTrigger = jQuery('#TR_portfolio_type_slideshow');	
	Portfolio_SlideshowOptions.css('display', 'none');

	/*Video Options*/
	var Portfolio_VideoOptions = jQuery('#TR_portfolio_video_meta_box');
	var Portfolio_VideoTrigger = jQuery('#TR_portfolio_type_video');	
	Portfolio_VideoOptions.css('display', 'none');

	/*Radio Settings*/
	var Portfolio_group = jQuery('#TR_portfolio_type_radio input');

	Portfolio_group.change( function() {
		
		if(jQuery(this).val() == 'image')
		{
			Portfolio_ImageOptions.css('display', 'block');
			TRHideAll(Portfolio_ImageOptions);		
		} 
		else if(jQuery(this).val() == 'slideshow')
		{
			Portfolio_SlideshowOptions.css('display', 'block');
			TRHideAll(Portfolio_SlideshowOptions);			
		}
		else if(jQuery(this).val() == 'video')
		{
			Portfolio_VideoOptions.css('display', 'block');
			TRHideAll(Portfolio_VideoOptions);			
		}

	});

	if(Portfolio_ImageTrigger.is(':checked'))
		Portfolio_ImageOptions.css('display', 'block');

	if(Portfolio_SlideshowTrigger.is(':checked'))
		Portfolio_SlideshowOptions.css('display', 'block');

	if(Portfolio_VideoTrigger.is(':checked'))
		Portfolio_VideoOptions.css('display', 'block');


	/*----------------------------------------------------------------------------------*/
	/*	Blog Custom Fields Hide/Show
	/*----------------------------------------------------------------------------------*/

	/*Standard Options*/
	var Blog_StandardOptions = jQuery('#TR_blog_standard_meta_box');
	var Blog_StandardTrigger = jQuery('#TR_blog_type_standard');	
	Blog_StandardOptions.css('display', 'none');

	/*Image Options*/
	var Blog_ImageOptions = jQuery('#TR_blog_image_meta_box');
	var Blog_ImageTrigger = jQuery('#TR_blog_type_image');	
	Blog_ImageOptions.css('display', 'none');

	/*Slideshow Options*/
	var Blog_SlideshowOptions = jQuery('#TR_blog_image_meta_box');
	var Blog_SlideshowTrigger = jQuery('#TR_blog_type_slideshow');	
	Blog_SlideshowOptions.css('display', 'none');

	/*Audio Options*/
	var Blog_AudioOptions = jQuery('#TR_blog_audio_meta_box');
	var Blog_AudioTrigger = jQuery('#TR_blog_type_audio');	
	Blog_AudioOptions.css('display', 'none');

	/*Video Options*/
	var Blog_VideoOptions = jQuery('#TR_blog_video_meta_box');
	var Blog_VideoTrigger = jQuery('#TR_blog_type_video');	
	Blog_VideoOptions.css('display', 'none');

	/*Link Options*/
	var Blog_LinkOptions = jQuery('#TR_blog_link_meta_box');
	var Blog_LinkTrigger = jQuery('#TR_blog_type_link');	
	Blog_LinkOptions.css('display', 'none');

	/*Quote Options*/
	var Blog_QuoteOptions = jQuery('#TR_blog_quote_meta_box');
	var Blog_QuoteTrigger = jQuery('#TR_blog_type_quote');	
	Blog_QuoteOptions.css('display', 'none');

	/*Radio Settings*/
	var Blog_group = jQuery('#TR_blog_type_radio input');

	Blog_group.change( function() {

		if(jQuery(this).val() == 'standard')
		{
			Blog_StandardOptions.css('display', 'block');
			TRHideAll(Blog_StandardOptions);		
		} 
		else if(jQuery(this).val() == 'image')
		{
			Blog_ImageOptions.css('display', 'block');
			TRHideAll(Blog_ImageOptions);		
		} 
		else if(jQuery(this).val() == 'slideshow')
		{
			Blog_SlideshowOptions.css('display', 'block');
			TRHideAll(Blog_SlideshowOptions);			
		}
		else if(jQuery(this).val() == 'audio')
		{
			Blog_AudioOptions.css('display', 'block');
			TRHideAll(Blog_AudioOptions);			
		}
		else if(jQuery(this).val() == 'video')
		{
			Blog_VideoOptions.css('display', 'block');
			TRHideAll(Blog_VideoOptions);			
		}
		else if(jQuery(this).val() == 'link')
		{
			Blog_LinkOptions.css('display', 'block');
			TRHideAll(Blog_LinkOptions);			
		}
		else if(jQuery(this).val() == 'quote')
		{
			Blog_QuoteOptions.css('display', 'block');
			TRHideAll(Blog_QuoteOptions);			
		}

	});

	if(Blog_ImageTrigger.is(':checked'))
		Blog_ImageOptions.css('display', 'block');

	if(Blog_SlideshowTrigger.is(':checked'))
		Blog_SlideshowOptions.css('display', 'block');

	if(Blog_AudioTrigger.is(':checked'))
		Blog_AudioOptions.css('display', 'block');

	if(Blog_VideoTrigger.is(':checked'))
		Blog_VideoOptions.css('display', 'block');

	if(Blog_LinkTrigger.is(':checked'))
		Blog_LinkOptions.css('display', 'block');

	if(Blog_QuoteTrigger.is(':checked'))
		Blog_QuoteOptions.css('display', 'block');




	/*----------------------------------------------------------------------------------*/
	/*	Slideshow Custom Fields Hide/Show
	/*----------------------------------------------------------------------------------*/
	
	/*Full Options*/
	var Slideshow_FullOptions = jQuery('#TR_slideshow_full_meta_box');
	var Slideshow_FullTrigger = jQuery('#TR_slideshow_type_full');	
	Slideshow_FullOptions.css('display', 'none');

	/*Text Options*/
	var Slideshow_TextOptions = jQuery('#TR_slideshow_text_meta_box');
	var Slideshow_TextTrigger = jQuery('#TR_slideshow_type_text');	
	Slideshow_TextOptions.css('display', 'none');

	/*Video Options*/
	var Slideshow_VideoOptions = jQuery('#TR_slideshow_video_meta_box');
	var Slideshow_VideoTrigger = jQuery('#TR_slideshow_type_video');	
	Slideshow_VideoOptions.css('display', 'none');

	/*Radio Settings*/
	var Slideshow_group = jQuery('#TR_slideshow_type_radio input');

	Slideshow_group.change( function() {
		
		if(jQuery(this).val() == 'full')
		{
			Slideshow_FullOptions.css('display', 'block');
			TRHideAll(Slideshow_FullOptions);		
		}
		else if(jQuery(this).val() == 'text')
		{
			Slideshow_TextOptions.css('display', 'block');
			TRHideAll(Slideshow_TextOptions);		
		}
		else if(jQuery(this).val() == 'video')
		{
			Slideshow_VideoOptions.css('display', 'block');
			TRHideAll(Slideshow_VideoOptions);		
		}

	});

	if(Slideshow_FullTrigger.is(':checked'))
		Slideshow_FullOptions.css('display', 'block');

	if(Slideshow_TextTrigger.is(':checked'))
		Slideshow_TextOptions.css('display', 'block');

	if(Slideshow_VideoTrigger.is(':checked'))
		Slideshow_VideoOptions.css('display', 'block');




	/*----------------------------------------------------------------------------------*/
	/*	TRHideAll
	/*----------------------------------------------------------------------------------*/
	function TRHideAll(NotThisOne) {
		Portfolio_ImageOptions.css('display', 'none');
		Portfolio_SlideshowOptions.css('display', 'none');
		Portfolio_VideoOptions.css('display', 'none');
		Blog_ImageOptions.css('display', 'none');
		Blog_SlideshowOptions.css('display', 'none');
		Blog_AudioOptions.css('display', 'none');
		Blog_VideoOptions.css('display', 'none');
		Blog_LinkOptions.css('display', 'none');
		Blog_QuoteOptions.css('display', 'none');
		Slideshow_FullOptions.css('display', 'none');
		Slideshow_TextOptions.css('display', 'none');
		Slideshow_VideoOptions.css('display', 'none');
		NotThisOne.css('display', 'block');
	}


	/*----------------------------------------------------------------------------------*/
	/*	Image Upload
	/*----------------------------------------------------------------------------------*/

	//Custom Poster images
	jQuery('#TR_video_poster_image_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#TR_video_poster_image').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


	//Custom Slideshow Image
	jQuery('#TR_slideshow_image_full_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#TR_slideshow_image_full').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});


	jQuery('#TR_slideshow_image_text_button').click(function() {		
		window.send_to_editor = function(html) 		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#TR_slideshow_image_text').val(imgurl);
			tb_remove();
		}	 
	 
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;		
	});

});