jQuery(document).ready(function() {
	
	//PAGE TITLE SETTING	
	jQuery('#new-meta-boxes-ptitle').css('display','none');	
	var $ptselect = jQuery('#page_template');	
	var $ptselected = jQuery('#page_template').find(':selected').attr('value');
	if($ptselected == 'page-with_title.php' || $ptselected == 'page-gallery-with_title.php'){		 	
			jQuery('#new-meta-boxes-ptitle').css('display','block');							
	}	
	$ptselect.change(function(){
		if($ptselect.val() == 'page-with_title.php' || $ptselect.val() == 'page-gallery-with_title.php'){		 	
			jQuery('#new-meta-boxes-ptitle').css('display','block');							
		}else{
			jQuery('#new-meta-boxes-ptitle').css('display','none');			
		}
	});
	
	
	
	//REV SLIDER
	jQuery('#new-meta-boxes-page_revslider').css('display','none');	
	var $ptselect = jQuery('#page_template');	
	var $ptselected = jQuery('#page_template').find(':selected').attr('value');
	if($ptselected == 'page-revslider.php'){		 	
			jQuery('#new-meta-boxes-page_revslider').css('display','block');							
	}	
	$ptselect.change(function(){
		if($ptselect.val() == 'page-revslider.php'){		 	
			jQuery('#new-meta-boxes-page_revslider').css('display','block');							
		}else{
			jQuery('#new-meta-boxes-page_revslider').css('display','none');			
		}
	});
	
	
	
	//FULL WIDTH SLIDER
	jQuery('#new-meta-boxes-page_fwslider').css('display','none');	
	var $ptselect = jQuery('#page_template');	
	var $ptselected = jQuery('#page_template').find(':selected').attr('value');
	if($ptselected == 'page-fw_slider.php'){		 	
			jQuery('#new-meta-boxes-page_fwslider').css('display','block');							
	}	
	$ptselect.change(function(){
		if($ptselect.val() == 'page-fw_slider.php'){		 	
			jQuery('#new-meta-boxes-page_fwslider').css('display','block');							
		}else{
			jQuery('#new-meta-boxes-page_fwslider').css('display','none');			
		}
	});
	
	
	
	//PINTEREST GRID
	jQuery('#new-meta-boxes-page_pingrid').css('display','none');	
	var $ptselect = jQuery('#page_template');	
	var $ptselected = jQuery('#page_template').find(':selected').attr('value');
	if($ptselected == 'page-pinterest.php'){		 	
			jQuery('#new-meta-boxes-page_pingrid').css('display','block');							
	}	
	$ptselect.change(function(){
		if($ptselect.val() == 'page-pinterest.php'){		 	
			jQuery('#new-meta-boxes-page_pingrid').css('display','block');							
		}else{
			jQuery('#new-meta-boxes-page_pingrid').css('display','none');			
		}
	});
	
	
	
	//METABOXES CLOSED BY DEAULT
	if(jQuery('#new-meta-boxes-post_bottom').length != 0){
		jQuery('#new-meta-boxes-post_bottom').addClass('closed');
	}
	if(jQuery('#new-meta-boxes-blogcats').length != 0){
		jQuery('#new-meta-boxes-blogcats').addClass('closed');
	}
	
	
	//REVIEW BOX
	if(jQuery('#new-meta-boxes-post_review').length != 0){
		jQuery('#new-meta-boxes-post_review').addClass('closed');
	}
	
	jQuery('#new-meta-boxes-post_review #tp_post_review_add').click(function(){		
		jQuery('<p class="review_line copy"><input type="text" class="" name="tp_post_review_lines[]" value="Text" /><input type="text" class="small-text" name="tp_post_review_lines_scores[]" value="Score" /></p>').insertAfter('#new-meta-boxes-post_review .review_line:last');
	});
	jQuery('#new-meta-boxes-post_review #tp_post_review_del').click(function(){		
		jQuery('.review_line.copy :last').remove();
	});
	
	
	//POST FORMATS
	if(jQuery('#new-meta-boxes-postf').length != 0){
		jQuery('#new-meta-boxes-postf').insertAfter('#titlediv');
	}
	
	jQuery('#new-meta-boxes-postf, .postf-contents').css('display','none');
	var $postf = jQuery('input.post-format:checked');
	if($postf.val() == 'link'){		
		jQuery('#new-meta-boxes-postf,#postf-link').css('display','block');
	}
	else if($postf.val() == 'audio'){		
		jQuery('#new-meta-boxes-postf,#postf-audio').css('display','block');
	}
	else if($postf.val() == 'video'){		
		jQuery('#new-meta-boxes-postf,#postf-video').css('display','block');
	}
	jQuery('input.post-format').change(function(){
		$postf = jQuery('input.post-format:checked');
		jQuery('#new-meta-boxes-postf,.postf-contents').css('display','none');		
		if($postf.val() == 'link'){
			jQuery('#new-meta-boxes-postf,#postf-link').css('display','block');
		}
		else if($postf.val() == 'audio'){
			jQuery('#new-meta-boxes-postf,#postf-audio').css('display','block');
		}
		else if($postf.val() == 'video'){
			jQuery('#new-meta-boxes-postf,#postf-video').css('display','block');
		}
	});
	

	
	//TABS WIDGET
	
	var tabselected;
	jQuery('select#tp_w_tabs_s1').change(function(){
		tabselected = jQuery('option:selected',this).val();
		if(tabselected == 'recent' || tabselected == 'popular' || tabselected == 'cats'){
			jQuery('p.tab1-cat-list').css('display','inline');
			jQuery('p.tab1-customcnt').css('display','none');	
		}else if(tabselected == 'tags'){
			jQuery('p.tab1-cat-list').css('display','none');
			jQuery('p.tab1-customcnt').css('display','none');			
		}else{
			jQuery('p.tab1-cat-list').css('display','none');
			jQuery('p.tab1-customcnt').css('display','inline');			
		}
		
		if(tabselected == 'recent' || tabselected == 'popular'){
			jQuery('p.tab1-cat-listb').css('display','inline');
		}else{
			jQuery('p.tab1-cat-listb').css('display','none');
		}
	});
	
	var tabselected2;
	jQuery('select#tp_w_tabs_s2').change(function(){
		tabselected = jQuery('option:selected',this).val();
		if(tabselected == 'recent' || tabselected == 'popular' || tabselected == 'cats'){
			jQuery('p.tab2-cat-list').css('display','inline');
			jQuery('p.tab2-customcnt').css('display','none');	
		}else if(tabselected == 'tags'){
			jQuery('p.tab2-cat-list').css('display','none');
			jQuery('p.tab2-customcnt').css('display','none');			
		}else{
			jQuery('p.tab2-cat-list').css('display','none');
			jQuery('p.tab2-customcnt').css('display','inline');			
		}
		
		if(tabselected == 'recent' || tabselected == 'popular'){
			jQuery('p.tab2-cat-listb').css('display','inline');
		}else{
			jQuery('p.tab2-cat-listb').css('display','none');
		}
	});
		
	var tabselected3;
	jQuery('select#tp_w_tabs_s3').change(function(){
		tabselected = jQuery('option:selected',this).val();
		if(tabselected == 'recent' || tabselected == 'popular' || tabselected == 'cats'){
			jQuery('p.tab3-cat-list').css('display','inline');
			jQuery('p.tab3-customcnt').css('display','none');	
		}else if(tabselected == 'tags'){
			jQuery('p.tab3-cat-list').css('display','none');
			jQuery('p.tab3-customcnt').css('display','none');			
		}else{
			jQuery('p.tab3-cat-list').css('display','none');
			jQuery('p.tab3-customcnt').css('display','inline');			
		}
		
		if(tabselected == 'recent' || tabselected == 'popular'){
			jQuery('p.tab3-cat-listb').css('display','inline');
		}else{
			jQuery('p.tab3-cat-listb').css('display','none');
		}
	});
	
	
	
	
	
	//SHORTCODE GENERATOR
	
	jQuery('#ub_scg_select').change(function(){
		jQuery('.ub_nu_input_field').remove();
		jQuery('.ub_nu_input_field2').remove();
		
		
		//CTA
			if(jQuery('#ub_scg_select').val() == 'cta'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-cta" href="#" onclick="return false">Generate Code</a></div>');			
				
				
				jQuery('#sc-cta').click(function(){
					var addthissc = '[cta]Your emphasized text goes here...[/cta]';
			
					
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}			
				});
			}
			
			
		
		//audio
			if(jQuery('#ub_scg_select').val() == 'audio'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Audio File URL:</label><input name="ub_scg_audio_url" id="ub_scg_audio_url" type="text" style="width: 200px;" /></div>'+			
				'<div class="ub_nu_input_field ub_scg_video_flv"><label>Width:</label><input name="ub_scg_audio_width" id="ub_scg_audio_width" type="text" style="width: 60px;" /> <span class="description">Optional</span></div>'+					
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-audio" href="#" onclick="return false">Generate Code</a></div>');			
				
				
				jQuery('#sc-audio').click(function(){
					var addthissc = '[aud';
			
					if(jQuery('#ub_scg_audio_url').val() != ''){
						addthissc = addthissc + ' url="'+jQuery('#ub_scg_audio_url').val()+'"';
					}
				
					if(jQuery('#ub_scg_audio_width').val() != ''){
						addthissc = addthissc + ' width="'+jQuery('#ub_scg_audio_width').val()+'"';
					}
					
				
					addthissc = addthissc + ']';
					
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}			
				});
			}
		
		
		//video
			if(jQuery('#ub_scg_select').val() == 'video'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Video URL:</label><input name="ub_scg_video_url" id="ub_scg_video_url" type="text" style="width: 200px;" /> <span class="description">YouTube or Vimeo</span></div>'+			
				'<div class="ub_nu_input_field ub_scg_video_flv"><label>Width:</label><input name="ub_scg_video_width" id="ub_scg_video_width" type="text" style="width: 60px;" /> <span class="description">Optional</span></div>'+	
				'<div class="ub_nu_input_field ub_scg_video_flv"><label>Height:</label><input name="ub_scg_video_height" id="ub_scg_video_height" type="text" style="width: 60px;" /> <span class="description">Optional</span></div>'+	
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-video" href="#" onclick="return false">Generate Code</a></div>');			
				
				
				jQuery('#sc-video').click(function(){
					var addthissc = '[vid';
			
					if(jQuery('#ub_scg_video_url').val() != ''){
						addthissc = addthissc + ' url="'+jQuery('#ub_scg_video_url').val()+'"';
					}
				
					if(jQuery('#ub_scg_video_width').val() != ''){
						addthissc = addthissc + ' width="'+jQuery('#ub_scg_video_width').val()+'"';
					}
					
					if(jQuery('#ub_scg_video_height').val() != ''){
						addthissc = addthissc + ' height="'+jQuery('#ub_scg_video_height').val()+'"';
					}
				
					addthissc = addthissc + ']';
					
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}			
				});
			}
			
			
		
		//quote
			if(jQuery('#ub_scg_select').val() == 'quote'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Type:</label><select name="ub_scg_quote_type" id="ub_scg_quote_type">'+
				'<option value="">Classic</option><option value="modern">Modern</option>'+
				'</select></div>'+
				'<div class="ub_nu_input_field"><label>Alignment:</label><select name="ub_scg_quote_align" id="ub_scg_quote_align">'+
				'<option value="">None</option><option value="left">Left</option><option value="right">Right</option>'+
				'</select></div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');	

				jQuery('#sc-generate').click(function(){				
					var addthissc = '';
					
					if(jQuery('#ub_scg_quote_align option:selected').val() == ''){
						addthissc = '<blockquote';
						if(jQuery('#ub_scg_quote_type option:selected').val() == 'modern'){
							addthissc = addthissc + ' type="modern"';
						}
						addthissc = addthissc + '>Your text...</blockquote>';
					}
					
					
					if(jQuery('#ub_scg_quote_align option:selected').val() == 'left' || jQuery('#ub_scg_quote_align option:selected').val() == 'right' ){
						addthissc = '[pullquote';
						if(jQuery('#ub_scg_quote_type option:selected').val() == 'modern'){
							addthissc = addthissc + ' type="modern"';
						}
						addthissc = addthissc + ' align="'+jQuery('#ub_scg_quote_align option:selected').val()+'"]Your text...[/pullquote]';
					}
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}						
					
				});
			}
		
		
		
		//lists
			if(jQuery('#ub_scg_select').val() == 'list'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Type:</label><select name="ub_scg_list_type" id="ub_scg_list_type">'+
				'<option value="ul">Unordered List</option><option value="ol">Ordered List</option><option value="circle">List with Circle</option><option value="arrow">List with Arrow</option>'+
				'</select></div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');	

				jQuery('#sc-generate').click(function(){				
					var addthissc = '';
					
					if(jQuery('#ub_scg_list_type option:selected').val() == 'ul'){
						addthissc = '<ul>\n'+
						'	<li>Item One</li>\n'+
						'	<li>Item Two</li>\n'+
						'	<li>...</li>\n'+
						'</ul>';
					}
					else if(jQuery('#ub_scg_list_type option:selected').val() == 'ol'){
						addthissc = '<ol>\n'+
						'	<li>Item One</li>\n'+
						'	<li>Item Two</li>\n'+
						'	<li>...</li>\n'+
						'</ol>';
					}
					else if(jQuery('#ub_scg_list_type option:selected').val() == 'circle'){
						addthissc = '<ul class="circle">\n'+
						'	<li>Item One</li>\n'+
						'	<li>Item Two</li>\n'+
						'	<li>...</li>\n'+
						'</ul>';
					}
					else if(jQuery('#ub_scg_list_type option:selected').val() == 'arrow'){
						addthissc = '<ul class="arrow">\n'+
						'	<li>Item One</li>\n'+
						'	<li>Item Two</li>\n'+
						'	<li>...</li>\n'+
						'</ul>';
					}
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}						
					
				});
			}
		
		
		//dropcap letter
			if(jQuery('#ub_scg_select').val() == 'dropcap'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Letter:</label><input name="ub_scg_dropcap_letter" id="ub_scg_dropcap_letter" type="text" style="width: 30px;" /></div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');	

				jQuery('#sc-generate').click(function(){
					var addthissc = '[dropcap]';
					
					if(jQuery('#ub_scg_dropcap_letter').val() != ''){
						addthissc = addthissc + jQuery('#ub_scg_dropcap_letter').val();
					}
				
					addthissc = addthissc + '[/dropcap]';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}						
					
				});
			}
		
		
		//circled letter
			if(jQuery('#ub_scg_select').val() == 'circled'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Letter to be in Circle:</label><input name="ub_scg_circled_letter" id="ub_scg_circled_letter" type="text" style="width: 30px;" /></div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');	

				jQuery('#sc-generate').click(function(){
					var addthissc = '[circle]';
					
					if(jQuery('#ub_scg_circled_letter').val() != ''){
						addthissc = addthissc + jQuery('#ub_scg_circled_letter').val();
					}
				
					addthissc = addthissc + '[/circle]';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}						
					
				});
			}
		
		
		//testemonial
			if(jQuery('#ub_scg_select').val() == 'testemonial'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Author</label><input name="ub_scg_testemonial_author" id="ub_scg_testemonial_author" type="text" style="width: 200px;" /></div>'+
				'<div class="ub_nu_input_field"><label>Company</label><input name="ub_scg_testemonial_company" id="ub_scg_testemonial_company" type="text" style="width: 200px;" /></div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');	

				jQuery('#sc-generate').click(function(){
					var addthissc = '[testemonial';
					
					if(jQuery('#ub_scg_testemonial_author').val() != ''){
						addthissc = addthissc+' author="'+jQuery('#ub_scg_testemonial_author').val()+'"';
					}
					
					if(jQuery('#ub_scg_testemonial_company').val() != ''){
						addthissc = addthissc+' company="'+jQuery('#ub_scg_testemonial_company').val()+'"';
					}
				 
					addthissc = addthissc + ']Client quote text...[/testemonial]';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}						
					
				});
			}
			
		
		//vspace
			if(jQuery('#ub_scg_select').val() == 'vspace'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Vertical Size</label><input name="ub_scg_vspace_height" id="ub_scg_vspace_height" type="text" style="width: 50px;" />px</div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');	

				jQuery('#sc-generate').click(function(){
					var addthissc = '[vspace]';
					
					if(jQuery('#ub_scg_vspace_height').val() != ''){
						addthissc = '[vspace size="'+jQuery('#ub_scg_vspace_height').val()+'px"]';
					}
				
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}						
					
				});
			}
			
		
		
		//rulers
			if(jQuery('#ub_scg_select').val() == 'rulers'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Style:</label><select name="ub_scg_hr_style" id="ub_scg_hr_style">'+
				'<option value="1">Simple Line</option><option value="2">Dotted Line</option><option value="3">Faded Line</option><option value="4">Faded Line and Dots</option></select></div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
						
											
				jQuery('#sc-generate').click(function(){
					var addthissc = '[hr';
				
					if(jQuery('#ub_scg_hr_style option:selected').val() != ''){
						addthissc = addthissc + jQuery('#ub_scg_hr_style option:selected').val();
					}	
					
					addthissc = addthissc + ']';
		
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}						
					
				});
			}
		
		
		//headings
			if(jQuery('#ub_scg_select').val() == 'headings'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Title:</label><input name="ub_scg_headings_title" id="ub_scg_headings_title" type="text" style="width: 200px;" /> </div>'+
				'<div class="ub_nu_input_field"><label>Subtitle:</label><input name="ub_scg_headings_stitle" id="ub_scg_headings_stitle" type="text" style="width: 200px;" /></div>'+
				'<div class="ub_nu_input_field"><label>Style:</label><select name="ub_scg_headings_style" id="ub_scg_headings_style"><option value="1">Style #1</option><option value="2">Style #2</option></select></div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
						
											
				jQuery('#sc-generate').click(function(){
					var addthissc = '[heading';
				
					if(jQuery('#ub_scg_headings_title').val() != ''){
						addthissc = addthissc + ' title="'+jQuery('#ub_scg_headings_title').val()+'"';
					}	
					
					if(jQuery('#ub_scg_headings_stitle').val() != ''){
						addthissc = addthissc + ' subtitle="'+jQuery('#ub_scg_headings_stitle').val()+'"';
					}	
					
					if(jQuery('#ub_scg_headings_style option:selected').val() == '2'){
						addthissc = addthissc + ' style="2"';
					}	
					
					addthissc = addthissc + ']';
		
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}						
					
				});
			}
		
		
		//columns
			if(jQuery('#ub_scg_select').val() == 'columns'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Type:</label><select name="ub_scg_columns" id="ub_scg_columns" style="width: 200px;">'+
				'<option value="">-</option><option value="one half">One Half</option><option value="one third">One Third</option><option value="two third">Two Third</option>'+
				'<option value="one fourth">One Fourth</option><option value="three fourth">Three Fourth</option><option value="one fifth">One Fifth</option><option value="two fifth">Two Fifth</option><option value="three fifth">Three Fifth</option></select></div>'+		
				'<div class="ub_nu_input_field"><label>Is this the last box in the row?</label><input name="ub_scg_columns_last" id="ub_scg_columns_last" type="checkbox" value="yes" /> Yes</div>'+						
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
				
				jQuery('#sc-generate').click(function(){
					var addthissc = '';
					var lastchild = '';
					
					if(jQuery('#ub_scg_columns_last').is(':checked')){
						var lastchild = ' last="yes"';
					}
					
					if(jQuery('#ub_scg_columns').val() == 'one half'){
						addthissc = '[one_half'+lastchild+']Your content goes here.[/one_half]';
					}
					
					if(jQuery('#ub_scg_columns').val() == 'one third'){
						addthissc = '[one_third'+lastchild+']Your content goes here.[/one_third]';
					}
					
					if(jQuery('#ub_scg_columns').val() == 'two third'){
						addthissc = '[two_third'+lastchild+']Your content goes here.[/two_third]';
					}
					
					if(jQuery('#ub_scg_columns').val() == 'one fourth'){
						addthissc = '[one_fourth'+lastchild+']Your content goes here.[/one_fourth]';
					}
					
					if(jQuery('#ub_scg_columns').val() == 'three fourth'){
						addthissc = '[three_fourth'+lastchild+']Your content goes here.[/three_fourth]';
					}
					
					if(jQuery('#ub_scg_columns').val() == 'one fifth'){
						addthissc = '[one_fifth'+lastchild+']Your content goes here.[/one_fifth]';
					}
					
					if(jQuery('#ub_scg_columns').val() == 'two fifth'){
						addthissc = '[two_fifth'+lastchild+']Your content goes here.[/two_fifth]';
					}
					
					if(jQuery('#ub_scg_columns').val() == 'three fifth'){
						addthissc = '[three_fifth'+lastchild+']Your content goes here.[/three_fifth]';
					}
				
				
					
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
					
					
				});
			}
		
		
		
		//posts
			if(jQuery('#ub_scg_select').val() == 'posts'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Posts Category to Display:</label><input name="ub_scg_posts_cat" id="ub_scg_posts_cat" type="text" style="width: 200px;" /> <span class="description">Slug name of Category</span></div>'+														
				'<div class="ub_nu_input_field"><label>Columns:</label><select name="ub_scg_posts_col" id="ub_scg_posts_col"><option value="4">4</option><option value="3">3</option><option value="2">1</option><option value="1">1</option></select></div>'+										
				'<div class="ub_nu_input_field"><label>Number of Posts to Show:</label><input name="ub_scg_posts_limit" id="ub_scg_posts_limit" type="text" style="width: 60px;" /></div>'+														
				'<div class="ub_nu_input_field"><label>Display Posts in Carousel:</label><input name="ub_scg_posts_carousel" id="ub_scg_posts_carousel" type="checkbox" /> Yes</div>'+										
				'<div class="ub_nu_input_field"><label>Show Post Titles:</label><input name="ub_scg_posts_title" id="ub_scg_posts_title" type="checkbox" /> Yes</div>'+										
				'<div class="ub_nu_input_field"><label>Show Post Excerpts:</label><input name="ub_scg_posts_excerpt" id="ub_scg_posts_excerpt" type="checkbox" /> Yes</div>'+										
				'<div class="ub_nu_input_field"><label>Show Post Dates:</label><input name="ub_scg_posts_date" id="ub_scg_posts_date" type="checkbox" /> Yes</div>'+										
				'<div class="ub_nu_input_field"><label>Show Post Review:</label><input name="ub_scg_posts_review" id="ub_scg_posts_review" type="checkbox" /> Yes</div>'+	
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
				
				jQuery('#sc-generate').click(function(){
					var addthissc = '[posts';
				
					if(jQuery('#ub_scg_posts_cat').val() != ''){
						addthissc = addthissc + ' category="'+jQuery('#ub_scg_posts_cat').val()+'"';
					}	
					
					if(jQuery('#ub_scg_posts_col option:selected').val() != ''){
						addthissc = addthissc + ' columns="'+jQuery('#ub_scg_posts_col').val()+'"';
					}	
					
					if(jQuery('#ub_scg_posts_limit').val() != ''){
						addthissc = addthissc + ' limit="'+jQuery('#ub_scg_posts_limit').val()+'"';
					}	
					
					if(jQuery('#ub_scg_posts_carousel').is(':checked') != ''){
						addthissc = addthissc + ' carousel="yes"';
					}	
					
					if(jQuery('#ub_scg_posts_title').is(':checked') != ''){
						addthissc = addthissc + ' title="yes"';
					}	
					
					if(jQuery('#ub_scg_posts_excerpt').is(':checked') != ''){
						addthissc = addthissc + ' excerpt="yes"';
					}	
					
					if(jQuery('#ub_scg_posts_date').is(':checked') != ''){
						addthissc = addthissc + ' date="yes"';
					}	
					
					if(jQuery('#ub_scg_posts_review').is(':checked') != ''){
						addthissc = addthissc + ' review="yes"';
					}	
					
					
					addthissc = addthissc + ']';
					
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
					
				});
			}
			
			
		
		//toggles
			if(jQuery('#ub_scg_select').val() == 'toggles'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Toggle Title:</label><input name="ub_scg_toggle_title" id="ub_scg_toggle_title" type="text" style="width: 200px;" /></div>'+						
				'<div class="ub_nu_input_field"><label>Custom Image URL:</label><input name="ub_scg_toggle_image" id="ub_scg_toggle_image" type="text" style="width: 200px;" /> <span class="description">(Optional)</span></div>'+						
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
				
				jQuery('#sc-generate').click(function(){
					var addthissc = '[toggle';
				
					if(jQuery('#ub_scg_toggle_title').val() != ''){
						addthissc = addthissc + ' title="'+jQuery('#ub_scg_toggle_title').val()+'"';
					}	
					
					if(jQuery('#ub_scg_toggle_image').val() != ''){
						addthissc = addthissc + ' image="'+jQuery('#ub_scg_toggle_image').val()+'"';
					}	
					
					addthissc = addthissc + '] Your content... [/toggle]';
					
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
					
				});
			}

		
		
		//vertical tab
			if(jQuery('#ub_scg_select').val() == 'vtab'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
				
				jQuery('#sc-generate').click(function(){
					var addthissc = '\n[vtabs titles="TAB ONE, TAB TWO, TAB THREE"]\n'+
					'	[vtab]Tab One Content[/vtab]\n'+
					'	[vtab]Tab Two Content[/vtab]\n'+
					'	[vtab]Tab Three Content[/vtab]\n'+
					'[/vtabs]\n';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
				});
			}
		
		//horizontal tab
			if(jQuery('#ub_scg_select').val() == 'tab'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
				
				jQuery('#sc-generate').click(function(){
					var addthissc = '\n[tabs titles="TAB ONE, TAB TWO, TAB THREE"]\n'+
					'	[tab]Tab One Content[/tab]\n'+
					'	[tab]Tab Two Content[/tab]\n'+
					'	[tab]Tab Three Content[/tab]\n'+
					'[/tabs]\n';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
				});
			}
		
		
		
		//icons
			if(jQuery('#ub_scg_select').val() == 'icons'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Social Icon:</label><select name="ub_scg_icons_social" id="ub_scg_icons_social"><option value="">-</option><option value="blogger">Blogger</option><option value="deviantart">Deviantart</option><option value="digg">Digg</option><option value="Dribbble">Dribbble</option>'+
				'<option value="email">Email</option><option value="envato">Envato</option><option value="facebook">Facebook</option><option value="flickr">Flickr</option><option value="forrst">Forrst</option>'+
				'<option value="github">Github</option><option value="google+">Google +</option><option value="instagram">Instagram</option><option value="linkedin">LinkedIn</option><option value="picasa">Picasa</option>'+
				'<option value="pinterest">Pinterest</option><option value="rss">RSS</option><option value="skype">Skype</option><option value="soundcloud">SoundCloud</option><option value="tumblr">Tumblr</option>'+
				'<option value="twitter">Twitter</option><option value="vimeo">Vimeo</option><option value="wordpress">WordPress</option><option value="youtube">YouTube</option> </select></div>'+						
				'<div class="ub_nu_input_field"><label>or FontAwesome Icon Name:</label><input name="ub_scg_icons_fa" id="ub_scg_icons_fa" type="text" style="width: 200px;" /> <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Cheatsheet is here</a></div>'+						
				'<div class="ub_nu_input_field"><label>or Custom Icon Image URL:</label><input name="ub_scg_icons_custom" id="ub_scg_icons_custom" type="text" style="width: 200px;" /></div>'+						
				'<div class="ub_nu_input_field"><label>Icon Links to:</label><input name="ub_scg_icons_link" id="ub_scg_icons_link" type="text" style="width: 200px;" /></div>'+						
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');		

				jQuery('#sc-generate').click(function(){
					var addthissc = '';
								
					
					if(jQuery('#ub_scg_icons_custom').val() != ''){
						addthissc = addthissc + 'image="'+jQuery('#ub_scg_icons_custom').val()+'"';
					}			
					else if(jQuery('#ub_scg_icons_social option:selected').val() != ''){
						addthissc = addthissc + 'type="'+jQuery('#ub_scg_icons_social').val()+'"';
					}
					else if(jQuery('#ub_scg_icons_fa').val() != ''){
						addthissc = addthissc + 'name="'+jQuery('#ub_scg_icons_fa').val()+'"';
					}

					if(jQuery('#ub_scg_icons_link').val() != ''){
						addthissc = addthissc + ' link="'+jQuery('#ub_scg_icons_link').val()+'"';
					}						
								
					addthissc = '[icon '+addthissc+']';
								
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
					
				});			
			}
		
		
		//resp display
			if(jQuery('#ub_scg_select').val() == 'resp'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Target Device:</label><select name="ub_scg_resp_device" id="ub_scg_resp_device"><option value="desktop">Desktop</option><option value="tablet">Tablet</option><option value="mobile">Mobile</option></select></div>'+						
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');		

				jQuery('#sc-generate').click(function(){
					var addthissc = '';
								

					if(jQuery('#ub_scg_resp_device option:selected').val() != ''){
						addthissc = addthissc + 'device="'+jQuery('#ub_scg_resp_device').val()+'"';
					}								
								
					addthissc = '[display '+addthissc+'] Your content goes here... [/display]';
								
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
					
				});			
			}
		
		
		//google fonts
			if(jQuery('#ub_scg_select').val() == 'gfonts'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Font Name:</label><input name="ub_scg_gfonts_name" id="ub_scg_gfonts_name" type="text" style="width: 200px;"></div>'+						
				'<div class="ub_nu_input_field"><label>Size:</label><input name="ub_scg_gfonts_size" id="ub_scg_gfonts_size" type="text" style="width: 60px;"> <span class="description">px</span></div>'+										
				'<div class="ub_nu_input_field"><label>CSS Stylings:</label><input name="ub_scg_gfonts_css" id="ub_scg_gfonts_css" type="text" style="width: 200px;"></div>'+						
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');		

				jQuery('#sc-generate').click(function(){
					var addthissc = '';
								

					if(jQuery('#ub_scg_gfonts_name').val() != ''){
						addthissc = addthissc + ' name="'+jQuery('#ub_scg_gfonts_name').val()+'"';
					}								
								
					if(jQuery('#ub_scg_gfonts_size').val() != ''){
						addthissc = addthissc + ' size="'+jQuery('#ub_scg_gfonts_size').val()+'"';
					}
					
					if(jQuery('#ub_scg_gfonts_css').val() != ''){
						addthissc = addthissc + ' style="'+jQuery('#ub_scg_gfonts_css').val()+'"';
					}
								
					addthissc = '[font '+addthissc+']Your text goes here...[/font]';
								
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
					
				});			
			}
		
		
		//google maps
			if(jQuery('#ub_scg_select').val() == 'gmaps'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Valid Address:</label><input name="ub_scg_gmaps_addr" id="ub_scg_gmaps_addr" type="text" style="width: 200px;" /></div>'+										
				'<div class="ub_nu_input_field"><label>Window Width:</label><input name="ub_scg_gmaps_w" id="ub_scg_gmaps_w" type="text" style="width: 60px;" /> <span class="description">px or %</span></div>'+
				'<div class="ub_nu_input_field"><label>Window Height:</label><input name="ub_scg_gmaps_h" id="ub_scg_gmaps_h" type="text" style="width: 60px;" /> <span class="description">px or %</span></div>'+
				'<div class="ub_nu_input_field"><label>Zoom:</label><input name="ub_scg_gmaps_z" id="ub_scg_gmaps_z" type="text" style="width: 60px;" /> <span class="description">0-20</span></div>'+
				'<div class="ub_nu_input_field">&nbsp;</div>'+
				'<div class="ub_nu_input_field"><label>Info Window Content:</label><input name="ub_scg_gmaps_window" id="ub_scg_gmaps_window" type="text" style="width: 200px;" /> <span class="description">HTML is allowed</span></div>'+				
				'<div class="ub_nu_input_field"><label>Map type:</label><select name="ub_scg_gmaps_type" id="ub_scg_gmaps_type"><option value="">Default</option><option value="SATELLITE">Satellite</option><option value="HYBRID">Hybrid</option><option value="TERRAIN">Terrain</option></select></div>'+
				'<div class="ub_nu_input_field"><label>Hide Controls:</label><input name="ub_scg_gmaps_controls" id="ub_scg_gmaps_controls" type="checkbox" value="yes" /> Yes</div>'+
				'<div class="ub_nu_input_field"><label>Show Marker:</label><input name="ub_scg_gmaps_marker" id="ub_scg_gmaps_marker" type="checkbox" value="yes" /> Yes</div>'+
				'<div class="ub_nu_input_field"><label>Custom Marker Image:</label><input name="ub_scg_gmaps_markeri" id="ub_scg_gmaps_markeri" type="text" style="width: 200px;" /> <span class="description">URL to image</span></div>'+
								
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');		

				jQuery('#sc-generate').click(function(){
					var addthissc = '';
			
					if(jQuery('#ub_scg_gmaps_addr').val() != ''){
						addthissc = addthissc + ' address="'+jQuery('#ub_scg_gmaps_addr').val()+'"';
					}				
				
					if(jQuery('#ub_scg_gmaps_w').val() != ''){
						addthissc = addthissc + ' width="'+jQuery('#ub_scg_gmaps_w').val()+'"';
					}else{
						addthissc = addthissc + ' width="100%"';
					}
					
					if(jQuery('#ub_scg_gmaps_h').val() != ''){
						addthissc = addthissc + ' height="'+jQuery('#ub_scg_gmaps_h').val()+'"';
					}else{
						addthissc = addthissc + ' height="300px"';
					}
					
					if(jQuery('#ub_scg_gmaps_z').val() != ''){
						addthissc = addthissc + ' zoom="'+jQuery('#ub_scg_gmaps_z').val()+'"';
					}									
					
					if(jQuery('#ub_scg_gmaps_window').val() != ''){
						addthissc = addthissc + ' infowindow="'+jQuery('#ub_scg_gmaps_window').val()+'"';
					}				
					
					if(jQuery('#ub_scg_gmaps_type option:selected').val() != ''){
						addthissc = addthissc + ' maptype="'+jQuery('#ub_scg_gmaps_type').val()+'"';
					}			
					
					if(jQuery('#ub_scg_gmaps_controls').is(':checked') != ''){
						addthissc = addthissc + ' hidecontrols="true"';
					}
					
					if(jQuery('#ub_scg_gmaps_marker').is(':checked') != ''){
						addthissc = addthissc + ' marker="true"';
					}
					
					if(jQuery('#ub_scg_gmaps_markeri').val() != ''){
						addthissc = addthissc + ' markerimage="'+jQuery('#ub_scg_gmaps_markeri').val()+'"';
					}		
					
					
					addthissc = '[map'+addthissc+']';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
					
				});			
			}
		
		
		//buttons
			if(jQuery('#ub_scg_select').val() == 'buttons'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Size:</label><select name="ub_scg_buttons_size" id="ub_scg_buttons_size" type="text" style="width: 200px;"><option value="">Normal</option><option value="small">Small</option><option value="large">Large</option></select></div>'+						
				'<div class="ub_nu_input_field"><label>Target Link:</label><input name="ub_scg_buttons_target" id="ub_scg_buttons_target" type="text" style="width: 200px;" /></div>'+
				'<div class="ub_nu_input_field"><label>Target Window:</label><select name="ub_scg_buttons_window" id="ub_scg_buttons_window"><option value="_blank">New Tab</option><option value="">Current Tab</option></select></div>'+
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');		

				jQuery('#sc-generate').click(function(){
					var addthissc = '';
			
					if(jQuery('#ub_scg_buttons_size').val() != ''){
						addthissc = addthissc + ' size="'+jQuery('#ub_scg_buttons_size').val()+'"';
					}				
				
					if(jQuery('#ub_scg_buttons_target').val() != ''){
						addthissc = addthissc + ' link="'+jQuery('#ub_scg_buttons_target').val()+'"';
					}
					
					if(jQuery('#ub_scg_buttons_window').val() != ''){
						addthissc = addthissc + ' target="'+jQuery('#ub_scg_buttons_window').val()+'"';
					}
								
					addthissc = '[button'+addthissc+']Button[/button]';
								
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
					
				});			
			}
		
		
		//grid
			if(jQuery('#ub_scg_select').val() == 'grid-modern'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Category to display:</label><input name="ub_scg_category" id="ub_scg_category" type="text" style="width: 80px;" /> <span class="description">Slug name of category</span></div>'+				
				'<div class="ub_nu_input_field"><label>Display category selection:</label><input name="ub_scg_portfolio" id="ub_scg_portfolio" type="checkbox" value="1" /> Yes</div>'+				
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
				jQuery('#sc-generate').click(function(){
					var addthissc = '[grid';
														
					if(jQuery('#ub_scg_category').val() != ''){
						addthissc = addthissc + ' category="' +jQuery('#ub_scg_category').val()+'"';
					}
					
					if(jQuery('#ub_scg_portfolio').is(':checked') != ''){
						addthissc = addthissc + ' portfolio="yes"';
					}
			
					addthissc = addthissc + ']';
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
				});
			}
			
			if(jQuery('#ub_scg_select').val() == 'grid-classic'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Category to display:</label><input name="ub_scg_category" id="ub_scg_category" type="text" style="width: 80px;" /> <span class="description">Slug name of category</span></div>'+				
				'<div class="ub_nu_input_field"><label>Columns:</label><select name="ub_scg_cols" id="ub_scg_cols"><option value="3">3</option><option value="4">4</option><option value="5">5</option></select></div>'+				
				'<div class="ub_nu_input_field"><label>Display category selection:</label><input name="ub_scg_portfolio" id="ub_scg_portfolio" type="checkbox" value="1" /> Yes</div>'+				
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-generate" href="#" onclick="return false">Generate Code</a></div>');			
				jQuery('#sc-generate').click(function(){
					var addthissc = '[grid style="classic"';
														
					if(jQuery('#ub_scg_category').val() != ''){
						addthissc = addthissc + ' category="' +jQuery('#ub_scg_category').val()+'"';
					}
					
					if(jQuery('#ub_scg_cols option:selected').val() != ''){
						addthissc = addthissc + ' columns="' +jQuery('#ub_scg_cols option:selected').val()+'"';
					}
					
					if(jQuery('#ub_scg_portfolio').is(':checked') != ''){
						addthissc = addthissc + ' portfolio="yes"';
					}
			
					addthissc = addthissc + ']';
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
				});
			}
			
			
		
		//table
			if(jQuery('#ub_scg_select').val() == 'table1'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-table1" href="#" onclick="return false">Generate Code</a></div>');			
				jQuery('#sc-table1').click(function(){
					var addthissc = '<table>\n'+
					'	<thead>\n'+
					'		<tr>\n'+
					'			<th>COLUMN 1</th>\n'+
					'			<th>COLUMN 2</th>\n'+
					'			<th>COLUMN 3</th>\n'+
					'			<th style="text-align: right;">COLUMN 4</th>\n'+
					'		</tr>\n'+
					'	</thead>\n'+
					'	<tbody>\n'+
					'		<tr>\n'+
					'			<td>Product #1</td>\n'+
					'			<td>Description</td>\n'+
					'			<td>Another Field</td>\n'+
					'			<td style="text-align: right;">&euro;1.00</td>\n'+
					'		</tr>\n'+
					'	</tbody>\n'+
					'</table>\n';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
				});
			}
			
			
			if(jQuery('#ub_scg_select').val() == 'table2'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-table1" href="#" onclick="return false">Generate Code</a></div>');			
				jQuery('#sc-table1').click(function(){
					var addthissc = '<table class="style2">\n'+
					'	<thead>\n'+
					'		<tr>\n'+
					'			<th>COLUMN 1</th>\n'+
					'			<th>COLUMN 2</th>\n'+
					'			<th>COLUMN 3</th>\n'+
					'			<th style="text-align: right;">COLUMN 4</th>\n'+
					'		</tr>\n'+
					'	</thead>\n'+
					'	<tbody>\n'+
					'		<tr>\n'+
					'			<td>Product #1</td>\n'+
					'			<td>Description</td>\n'+
					'			<td>Another Field</td>\n'+
					'			<td style="text-align: right;">&euro;1.00</td>\n'+
					'		</tr>\n'+
					'	</tbody>\n'+
					'</table>\n';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
				});
			}
		
		
			if(jQuery('#ub_scg_select').val() == 'ptable'){
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Title:</label><input name="ub_scg_title" id="ub_scg_title" type="text" style="width: 200px;" /></div>'+				
				'<div class="ub_nu_input_field"><label>Price:</label><input name="ub_scg_price" id="ub_scg_price" type="text" style="width: 80px;" /></div>'+				
				'<div class="ub_nu_input_field"><label>Price / time:</label><input name="ub_scg_per" id="ub_scg_per" type="text" style="width: 200px;" /> <span class="description">E.g.: per year</span></div>'+								
				'<div class="ub_nu_input_field"><label>Button text:</label><input name="ub_scg_button" id="ub_scg_button" type="text" style="width: 200px;" /></div>'+								
				'<div class="ub_nu_input_field"><label>Button links to:</label><input name="ub_scg_buttonlink" id="ub_scg_buttonlink" type="text" style="width: 200px;" /></div>'+								
				'<div class="ub_nu_input_field"><label>Button color:</label><input name="ub_scg_buttoncolor" id="ub_scg_buttoncolor" type="text" style="width: 200px;" /></div>'+								
				'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-table1" href="#" onclick="return false">Generate Code</a></div>');			
				jQuery('#sc-table1').click(function(){
					var addthissc = '[plan';
														
					if(jQuery('#ub_scg_title').val() != ''){
						addthissc = addthissc + ' title="' +jQuery('#ub_scg_title').val()+'"';
					}
					
					if(jQuery('#ub_scg_price').val() != ''){
						addthissc = addthissc + ' price="' +jQuery('#ub_scg_price').val()+'"';
					}
					
					if(jQuery('#ub_scg_per').val() != ''){
						addthissc = addthissc + ' per="' +jQuery('#ub_scg_per').val()+'"';
					}
					
					if(jQuery('#ub_scg_button').val() != ''){
						addthissc = addthissc + ' button="' +jQuery('#ub_scg_button').val()+'"';
					}
					
					if(jQuery('#ub_scg_buttonlink').val() != ''){
						addthissc = addthissc + ' link="' +jQuery('#ub_scg_buttonlink').val()+'"';
					}
					
					if(jQuery('#ub_scg_buttoncolor').val() != ''){
						addthissc = addthissc + ' color="' +jQuery('#ub_scg_buttoncolor').val()+'"';
					}
					
					addthissc = addthissc + ']\n'+
					'<ul>\n'+
					'	<li>Featured Service #1</li>\n'+
					'	<li>Featured Service #2</li>\n'+
					'	<li>Featured Service #3</li>\n'+
					'</ul>\n'+
					'[/plan]\n';
				
					if(jQuery('#new-meta-boxes .inside #display_sc').length){
						jQuery('#new-meta-boxes .inside #display_sc').text(addthissc);					
					}else{
						jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code above into the Editor:</label><textarea id="display_sc">'+addthissc+'</textarea>');					
					}
				});
			}
		
		
			/*

		
		
		
		
		//audio
		if(jQuery('#ub_scg_select').val() == 'audio'){
			jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Link to mp3 file:</label><input name="ub_scg_audio_link" id="ub_scg_audio_link" type="text" style="width: 200px;" /></div>'+						
			'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-audio" href="#" onclick="return false">Generate Code</a></div>');			
						
			jQuery('#sc-audio').click(function(){
				
				var addthissc = '\n[audio url="'+jQuery('#ub_scg_audio_link').val()+'"]';
			
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code in HTML mode:</label><textarea id="display_sc">'+addthissc+'</textarea>');
				
			});
		}
		
		
		
		
		
		//text
		if(jQuery('#ub_scg_select').val() == 'text'){
			jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Type:</label><select name="ub_scg_text_type" id="ub_scg_text_type" type="text" style="width: 200px;"><option value="">-</option><option value="blockquote_left">Blockquote Left</option><option value="blockquote_right">Blockquote Right</option><option value="blockquote">Blockquote Full Width</option><option value="dropcap">Dropcap</option><option value="list_num">Circle Dropcap</option><option value="code">Code</option><option value="pre">Pre</option><option value="list1">List Style #1</option><option value="list2">List Style #2</option><option value="list3">List Style #3</option></select></div>'+						
			'<div class="ub_nu_input_field"><label>&nbsp;</label><a class="button-secondary" id="sc-text" href="#" onclick="return false">Generate Code</a></div>');			
			
			jQuery('#sc-text').click(function(){
				var addthissc = '';		
	
				if(jQuery('#ub_scg_text_type').val() == 'blockquote_left'){
					addthissc = '\n[quote align="left"]Insert quote here.[/quote]';
				}
				
				if(jQuery('#ub_scg_text_type').val() == 'blockquote_right'){
					addthissc = '\n[quote align="right"]Insert quote here.[/quote]';
				}
				
				if(jQuery('#ub_scg_text_type').val() == 'blockquote'){
					addthissc = '\n[quote]Insert quote here.[/quote]';
				}
			
				if(jQuery('#ub_scg_text_type').val() == 'dropcap'){
					addthissc = '\n[dropcap]T[/dropcap]his is a dropcap!';
				}
			
				if(jQuery('#ub_scg_text_type').val() == 'code'){
					addthissc = '\n[code]Your code goes here[/code]';
				}
				
				if(jQuery('#ub_scg_text_type').val() == 'pre'){
					addthissc = '\n[pre]Your text goes here[/pre]';
				}
				
				if(jQuery('#ub_scg_text_type').val() == 'list1'){
					addthissc = '\n[list1]<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>[/list1]';
				}
			
				if(jQuery('#ub_scg_text_type').val() == 'list2'){
					addthissc = '\n[list2]<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>[/list2]';
				}
			
				if(jQuery('#ub_scg_text_type').val() == 'list3'){
					addthissc = '\n[list3]<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>[/list3]';
				}
				
				if(jQuery('#ub_scg_text_type').val() == 'list_num'){
					addthissc = '\n<p><span class="circle">1</span>Lorem ipsum dolor sit amet, consectetur fusce tincidunt condimentum dictum. Lorem ipsum dolor sit amet, consectetur.</p>';
				}
			
				jQuery('#new-meta-boxes .inside').append('<div class="ub_nu_input_field"><label>Paste this code in HTML mode:</label><textarea id="display_sc">'+addthissc+'</textarea>');
				
			});
		}
		
				
		
		
		*/
	});

	
});

	
	