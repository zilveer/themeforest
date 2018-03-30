jQuery.noConflict();

/******************************************************
*
*	Slideshow shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#slideshow_generator').each(function(){
		var t = jQuery(this);
		jQuery('input.button-primary',t).mousedown(function(){
			var m = jQuery('.milliseconds .slider_input',t).val();
			var s = jQuery('.radio_size input:checked',t).val();
			if(s=='custom'){ s = jQuery('input#custom_size',t).val(); }
			jQuery('input#slideshow_code',t).val('[slideshow time="'+m+'" size="'+s+'"][/slideshow]');
			/* Blocco che aggiorna il valore */
			var allImages = [];
			var allHref = [];
			var allCapt = [];
			var allButt = [];
			jQuery('.slideshow_image', t).each(function() {
				allImages.push(jQuery(this).val());
			});
			jQuery('.slideshow_href', t).each(function() {
				allHref.push(jQuery(this).val());
			});
			jQuery('.slideshow_caption', t).each(function() {
				allCapt.push(jQuery(this).val());
			});
			jQuery('.slideshow_button', t).each(function() {
				allButt.push(jQuery(this).val());
			});
			jQuery('input#slideshow_code',t).val('[slideshow time="'+m+'" size="'+s+'"]');
			jQuery.each(allImages, function(key, value) {
				if(allImages[key]!=''){
					jQuery('input#slideshow_code',t).val(jQuery('input#slideshow_code',t).val()+'[slider img="'+allImages[key]+'" href="href'+key+'" caption="capt'+key+'" button="butt'+key+'"] ');
				}
			});
			jQuery.each(allHref, function(key, value) {
				jQuery('input#slideshow_code',t).val(jQuery('input#slideshow_code',t).val().replace('href'+key, allHref[key]));
			});
			jQuery.each(allCapt, function(key, value) {
				jQuery('input#slideshow_code',t).val(jQuery('input#slideshow_code',t).val().replace('capt'+key, allCapt[key]));
			});
			jQuery.each(allButt, function(key, value) {
				jQuery('input#slideshow_code',t).val(jQuery('input#slideshow_code',t).val().replace('butt'+key, allButt[key]));
			});
			jQuery('input#slideshow_code',t).val(jQuery('input#slideshow_code',t).val()+'[/slideshow]');
			/* Fine */
		});
	});	
});



/******************************************************
*
*	Video shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#video_generator').each(function(){
		var t = jQuery(this);
		/* Fine */
		jQuery('input.button-primary',t).mousedown(function(){
			var w = jQuery('input[name="_custom_video[width]"]',t).val();
			var h = jQuery('input[name="_custom_video[height]"]',t).val();
			var n=Math.floor(Math.random()*1000000);
			var id = 'id_'+n;
			if(jQuery('select option:selected',t).val()=='externally'){
				var v = jQuery('input[name="_custom_video[ext_video]"]',t).val();
			} else {
				var v = jQuery('input[name="_custom_video[video]"]',t).val();
			}
			var p = jQuery('input[name="_custom_video[poster]"]',t).val();
			if(jQuery('select option:selected',t).val()=='externally'){
				jQuery('input[type="hidden"]',t).val('[embed width="'+w+'" height="'+h+'"]'+v+'[/embed]');
			} else {
				jQuery('input[type="hidden"]',t).val('[pix_video src="'+v+'" poster="'+p+'" width="'+w+'" height="'+h+'" id="'+id+'"]');
			}
		});
	});	
});



/******************************************************
*
*	Audio shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#audio_generator').each(function(){
		var t = jQuery(this);
		/* Fine */
		jQuery('input.button-primary',t).mousedown(function(){
			var w = jQuery('input[name="_custom_audio[width]"]',t).val();
			var h = jQuery('input[name="_custom_audio[height]"]',t).val();
			var n=Math.floor(Math.random()*1000000);
			var id = 'id_'+n;
			var v = jQuery('input[name="_custom_audio[audio]"]',t).val();
			var p = jQuery('input[name="_custom_audio[poster]"]',t).val();
			if(jQuery('input[name="_custom_audio[audio_start]"]',t).is(':checked')){
				var pl = 'true';
			} else {
				var pl = 'false';
			}
			jQuery('input[type="hidden"]',t).val('[pix_audio src="'+v+'" poster="'+p+'" width="'+w+'" height="'+h+'" id="'+id+'" play="'+pl+'"]');
		});
	});	
});



/******************************************************
*
*	Contact form shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#contactform_generator').each(function(){
		var t = jQuery(this);
		jQuery('input.button-primary',t).mousedown(function(){
			var c = jQuery('select[name="_custom_contactform[form]"] option:selected',t).val();
			jQuery('input[type="hidden"]',t).val('[pix_contact_form form="'+c+'"]');
		});
	});	
});



/******************************************************
*
*	Tooltip shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#tooltip_generator').each(function(){
		var t = jQuery(this);
		jQuery('input.button-primary',t).mousedown(function(){
			var c = jQuery('textarea[name="_custom_tooltip[content]"]',t).val();
			var hr = jQuery('input[name="_custom_tooltip[href]"]',t).val();
			var w = jQuery('input[name="_custom_tooltip[width]"]',t).val();
			var h = jQuery('input[name="_custom_tooltip[height]"]',t).val();
			var to = jQuery('select[name="_custom_tooltip[tooltip]"] option:selected',t).val();
			if(to == 'local'){
				var l = 'text=\''+jQuery('textarea[name="_custom_tooltip[local]"]',t).val()+'\'';
			} else {
				var l = 'data-rel=\''+jQuery('input[name="_custom_tooltip[external]"]',t).val()+'\'';
			}
			jQuery('input[type="hidden"]',t).val('[pix_tooltip width=\''+w+'\' height=\''+h+'\' link=\''+hr+'\' '+l+']'+c+'[/pix_tooltip]');
		});
	});	
});



/******************************************************
*
*	Googlemap shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#googlemap_generator').each(function(){
		var t = jQuery(this);
		jQuery('input.button-primary',t).mousedown(function(){
			var w = jQuery('input[name="_custom_googlemap[width]"]',t).val();
			var h = jQuery('input[name="_custom_googlemap[height]"]',t).val();
			var u = jQuery('input[name="_custom_googlemap[url]"]',t).val();
			jQuery('input[type="hidden"]',t).val('[googlemap width="'+w+'" height="'+h+'" link="'+u+'"]');
		});
	});	
});



/******************************************************
*
*	Accordion shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#accordion_generator').each(function(){
		var t = jQuery(this);
		jQuery('input.button-primary',t).mousedown(function(){
			/* Blocco che aggiorna il valore */
				var aA = jQuery('.accordion_active', t).val();
				var allTitles = [];
				var allContents = [];
				jQuery('.accordion_title_generated', t).each(function() {
					allTitles.push(jQuery(this).val());
				});
				jQuery('.accordion_content_generated', t).each(function() {
					allContents.push(jQuery(this).val());
				});
				jQuery('input#accordion_code',t).val('[pix_accordion active="'+aA+'"]<br>');
				jQuery.each(allTitles, function(key, value) {
					if(allTitles[key]!=''){
						jQuery('input#accordion_code',t).val(jQuery('input#accordion_code',t).val()+'[pix_acc title="'+allTitles[key]+'"]content'+key+'[/pix_acc]<br>');
					}
				});
				jQuery.each(allContents, function(key, value) {
					jQuery('input#accordion_code',t).val(jQuery('input#accordion_code',t).val().replace('content'+key, allContents[key]));
				});
				jQuery('input#accordion_code',t).val(jQuery('input#accordion_code',t).val()+'[/pix_accordion]');
				/* Fine */
		});
	});	
});



/******************************************************
*
*	Tabs shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#tab_generator').each(function(){
		var t = jQuery(this);
		jQuery('input.button-primary',t).mousedown(function(){
				var aA = jQuery('.tab_active', t).val();
				var allTitles = [];
				var allContents = [];
				jQuery('.tab_title_generated', t).each(function() {
					allTitles.push(jQuery(this).val());
				});
				jQuery('.tab_content_generated', t).each(function() {
					allContents.push(jQuery(this).val());
				});
				jQuery('input#tab_code',t).val('[pix_tabs active="'+aA+'"] ');
				jQuery('input#tab_code',t).val(jQuery('input#tab_code',t).val()+'[ul] ');
				jQuery.each(allTitles, function(key, value) {
					if(allTitles[key]!=''){
						jQuery('input#tab_code',t).val(jQuery('input#tab_code',t).val()+'[pix_tab title="'+allTitles[key]+'"]');
					}
				});
				jQuery('input#tab_code',t).val(jQuery('input#tab_code',t).val()+'[/ul] ');
				jQuery.each(allTitles, function(key, value) {
					if(allTitles[key]!=''){
						jQuery('input#tab_code',t).val(jQuery('input#tab_code',t).val()+'[pix_tab_content title="'+allTitles[key]+'"]content'+key+'[/pix_tab_content]<br>');
					}
				});
				jQuery.each(allContents, function(key, value) {
					jQuery('input#tab_code',t).val(jQuery('input#tab_code',t).val().replace('content'+key, allContents[key]));
				});
				jQuery('input#tab_code',t).val(jQuery('input#tab_code',t).val()+'[/pix_tabs]');
				/* Fine */
		});
	});	
});



/******************************************************
*
*	Columns shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#column_generator').each(function(){
		var t = jQuery(this);
		jQuery('img',t).click(function(){
			jQuery('img',t).removeClass('active');
			jQuery(this).addClass('active');
			
			var v = jQuery(this).attr('id');
			var inp;
			switch(v){
				case 'two':
				inp = '[col_two]First column[/col_two]<br>'+
					'[col_two last="true"]Second column[/col_two]<br>';
				break;
				case 'three':
				inp = '[col_three]First column[/col_three]<br>'+
					'[col_three]Second column[/col_three]<br>'+
					'[col_three last="true"]Third column[/col_three]<br>';
				break;
				case 'two-one':
				inp = '[col_two_three]First column[/col_two_three]<br>'+
					'[col_three last="true"]Second column[/col_three]<br>';
				break;
				case 'one-two':
				inp = '[col_three]First column[/col_three]<br>'+
					'[col_two_three last="true"]Second column[/col_two_three]<br>';
				break;
				case 'four':
				inp = '[col_four]First column[/col_four]<br>'+
					'[col_four]Second column[/col_four]<br>'+
					'[col_four]Third column[/col_four]<br>'+
					'[col_four last="true"]Fourth column[/col_four]<br>';
				break;
				case 'two-one-one':
				inp = '[col_two_four]First column[/col_two_four]<br>'+
					'[col_four]Second column[/col_four]<br>'+
					'[col_four last="true"]Third column[/col_four]<br>';
				break;
				case 'one-two-one':
				inp = '[col_four]First column[/col_four]<br>'+
					'[col_two_four]Second column[/col_two_four]<br>'+
					'[col_four last="true"]Third column[/col_four]<br>';
				break;
				case 'one-one-two':
				inp = '[col_four]First column[/col_four]<br>'+
					'[col_four]Second column[/col_four]<br>'+
					'[col_two_four last="true"]Third column[/col_two_four]<br>';
				break;
				case 'three-one':
				inp = '[col_three_four]First column[/col_three_four]<br>'+
					'[col_four last="true"]Second column[/col_four]<br>';
				break;
				case 'one-three':
				inp = '[col_four]First column[/col_four]<br>'+
					'[col_three_four last="true"]Second column[/col_three_four]<br>';
				break;
				case 'five':
				inp = '[col_five]First column[/col_five]<br>'+
					'[col_five]Second column[/col_five]<br>'+
					'[col_five]Third column[/col_five]<br>'+
					'[col_five]Fourth column[/col_five]<br>'+
					'[col_five last="true"]Fifth column[/col_five]<br>';
				break;
				case 'two-one-one-one':
				inp = '[col_two_five]First column[/col_two_five]<br>'+
					'[col_five]Second column[/col_five]<br>'+
					'[col_five]Third column[/col_five]<br>'+
					'[col_five last="true"]Fourth column[/col_five]<br>';
				break;
				case 'one-two-one-one':
				inp = '[col_five]First column[/col_five]<br>'+
					'[col_two_five]Second column[/col_two_five]<br>'+
					'[col_five]Third column[/col_five]<br>'+
					'[col_five last="true"]Fourth column[/col_five]<br>';
				break;
				case 'one-one-two-one':
				inp = '[col_five]First column[/col_five]<br>'+
					'[col_five]Second column[/col_five]<br>'+
					'[col_two_five]Third column[/col_two_five]<br>'+
					'[col_five last="true"]Fourth column[/col_five]<br>';
				break;
				case 'one-one-one-two':
				inp = '[col_five]First column[/col_five]<br>'+
					'[col_five]Second column[/col_five]<br>'+
					'[col_five]Third column[/col_five]<br>'+
					'[col_two_five last="true"]Fourth column[/col_two_five]<br>';
				break;
				case 'two-two-one':
				inp = '[col_two_five]First column[/col_two_five]<br>'+
					'[col_two_five]Second column[/col_two_five]<br>'+
					'[col_five last="true"]Third column[/col_five]<br>';
				break;
				case 'two-one-two':
				inp = '[col_two_five]First column[/col_two_five]<br>'+
					'[col_five]Second column[/col_five]<br>'+
					'[col_two_five last="true"]Third column[/col_two_five]<br>';
				break;
				case 'one-two-two':
				inp = '[col_five]First column[/col_five]<br>'+
					'[col_two_five]Second column[/col_two_five]<br>'+
					'[col_two_five last="true"]Third column[/col_two_five]<br>';
				break;
				case 'three-one-one':
				inp = '[col_three_five]First column[/col_three_five]<br>'+
					'[col_five]Second column[/col_five]<br>'+
					'[col_five last="true"]Third column[/col_five]<br>';
				break;
				case 'one-three-one':
				inp = '[col_five]First column[/col_five]<br>'+
					'[col_three_five]Second column[/col_three_five]<br>'+
					'[col_five last="true"]Third column[/col_five]<br>';
				break;
				case 'one-one-three':
				inp = '[col_five]First column[/col_five]<br>'+
					'[col_five]Second column[/col_five]<br>'+
					'[col_three_five last="true"]Third column[/col_three_five]<br>';
				break;
			}
			
			jQuery('#column_code',t).html('[pix_columns]<br>'+inp+'[/pix_columns]');
		});
	});
});



/******************************************************
*
*	Box shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#box_generator').each(function(){
		var t = jQuery(this);
		var inp = '';

		jQuery('input[type="hidden"]',t).val('[pix_box pix_inp pix_bg pix_color pix_border_size pix_border_style pix_border_color]Your content[/pix_box]');
	
		jQuery('img',t).click(function(){
			jQuery('img',t).removeClass('active');
			jQuery(this).addClass('active');
			
			var v = jQuery(this).attr('id');
			var inp = '';
			switch(v){
				case 'none':
				inp = '';
				break;
				case 'quotes':
				inp = ' icon="quotes"';
				break;
				case 'balloon':
				inp = ' icon="balloon"';
				break;
				case 'info':
				inp = ' icon="info"';
				break;
				case 'arrow':
				inp = ' icon="arrow"';
				break;
				case 'question':
				inp = ' icon="question"';
				break;
			}
			
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_inp',inp));
			
		});

		jQuery('input.button-primary',t).mousedown(function(){
			
			var bg = 'bg="'+jQuery('input#box_bg',t).val()+'"';
			var color = 'color="'+jQuery('input#box_color',t).val()+'"';
			var b_size = 'border_size="'+jQuery('input#box_border_size',t).val()+'"';
			var b_color = 'border_color="'+jQuery('input#box_border_color',t).val()+'"';
			var b_style = 'border_style="'+jQuery('select',t).val()+'"';
	
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_inp',inp));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_bg',bg));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_color',color));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_border_size',b_size));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_border_color',b_color));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_border_style',b_style));
		});
		
		
	});
});



/******************************************************
*
*	Drop cap shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#dropcap_generator').each(function(){
		var t = jQuery(this);

		jQuery('input[type="hidden"]',t).val('[pix_dropcap pix_height pix_line_height pix_width pix_font pix_bg pix_color pix_shape pix_top pix_right]A[/pix_dropcap]');
	
		jQuery('input.button-primary',t).mousedown(function(){
			
			var h = 'height="'+jQuery('input#height',t).val()+'"';
			var lH = 'line_height="'+jQuery('input#line_height',t).val()+'"';
			var w = 'width="'+jQuery('input#width',t).val()+'"';
			var s = 'size="'+jQuery('input#font_size',t).val()+'"';
			var bg = 'bg="'+jQuery('input#cap_bg',t).val()+'"';
			var color = 'color="'+jQuery('input#cap_color',t).val()+'"';
			var top = 'top="'+jQuery('input#margin_top',t).val()+'"';
			var right = 'right="'+jQuery('input#margin_right',t).val()+'"';
	
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_height',h));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_line_height',lH));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_width',w));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_font',s));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_bg',bg));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_color',color));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_top',top));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_right',right));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_shape','shape="square"'));
		});
		
		jQuery('select',t).change(function(){
			var sh = 'shape="'+jQuery('option:selected',this).val()+'"';
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_shape',sh));
		});

		
	});
});



/******************************************************
*
*	Button
*
******************************************************/
jQuery(function(){
	jQuery('#button_generator').each(function(){
		var t = jQuery(this);

		jQuery('input[type="hidden"]',t).val('[pix_button pix_bg pix_hover pix_color pix_border_color pix_border_size pix_size]pix_text[/pix_button]');
	
		jQuery('input.button-primary',t).mousedown(function(){
			
			var te = jQuery('input#text_button',t).val();
			var bg = 'bg_color="'+jQuery('input#button_bg',t).val()+'"';
			var h = 'bg_hover="'+jQuery('input#hover_bg',t).val()+'"';
			var c = 'text_color="'+jQuery('input#button_color',t).val()+'"';
			var bC = 'border_color="'+jQuery('input#button_border_color',t).val()+'"';
			var bS = 'border_size="'+jQuery('input#button_border_size',t).val()+'"';
			var s = 'size="'+jQuery('select',t).val()+'"';
	
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_text',te));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_bg',bg));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_hover',h));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_color',c));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_border_color',bC));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_border_size',bS));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_size',s));
		});
		
		
	});
});



/******************************************************
*
*	Price table shortcode generator
*
******************************************************/
jQuery(function(){
	jQuery('#pricetable_generator').each(function(){
		var t = jQuery(this);
		
		
		/* Blocco che aggiorna il valore */
		jQuery('input.button-primary',t).mousedown(function(){
				/* Blocco che aggiorna il valore */
				var theID = jQuery('.pricetable_id',t).val();
				var allBlock = [];
				var allIDs = [];
				var allHl = [];
				var theHtml = '[pix_price_title]Title[/pix_price_title]<br>'+
				'[pix_price_price]Price[/pix_price_price]<br>'+
				'[pix_price_explanation]Explanation[/pix_price_explanation]<br>'+
				'[pix_price_row]Simple row[/pix_price_row]<br>'+
				'[pix_price_check]Check sign[/pix_price_check]<br>'+
				'[pix_price_error]Error sign[/pix_price_error]<br>'+
				'[pix_price_row]Simple row[/pix_price_row]<br>'+
				'[pix_price_row]<br>'+
				'[pix_button bg_color="#333333" bg_hover="#000000" text_color="#ffffff" border_color="#333333" border_size="0" size="medium"]Button[/pix_button]<br>'+
				'[/pix_price_row]<br>';
				jQuery('.image_block', t).each(function() {
					allBlock.push('block');
				});
				var l = allBlock.length-1;
				jQuery.each(allBlock, function(key, value) {
					if(key==1){
						jQuery('#pricetablecode',t).html('[pix_price_table columns="'+l+'" id="'+theID+'"]<br>[pix_price_columnm id="pix_id'+key+'" highlighted="pix_hl'+key+'"]<br>'+theHtml+'[/pix_price_columnm]');
					} else if(key>1){
						jQuery('#pricetablecode',t).html(jQuery('#pricetablecode',t).html()+'<br>[pix_price_columnm id="pix_id'+key+'" highlighted="pix_hl'+key+'"]<br>'+theHtml+'[/pix_price_columnm]');
					}
				});
				jQuery('.pricetable_class', t).each(function() {
					allIDs.push(jQuery(this).val());
				});
				jQuery('.pricetable_hl', t).each(function() {
					allHl.push(jQuery(this).val());
				});
				jQuery.each(allIDs, function(key, value) {
					if(allIDs[key]!=''){
					jQuery('#pricetablecode',t).html(jQuery('#pricetablecode',t).html().replace('pix_id'+(key+1), allIDs[key]));
					}
				});
				jQuery.each(allHl, function(key, value) {
					jQuery('#pricetablecode',t).html(jQuery('#pricetablecode',t).html().replace('pix_hl'+(key+1), allHl[key]));
				});
				jQuery('#pricetablecode',t).html(jQuery('#pricetablecode',t).html()+'<br>[/pix_price_table]');
			/* Fine */
		});
	});	
});




/******************************************************
*
*	Span
*
******************************************************/
jQuery(function(){
	jQuery('#span_generator').each(function(){
		var t = jQuery(this);

		jQuery('input[type="hidden"]',t).val('[pix_span pix_class pix_id] You content [/pix_span]');
	
		jQuery('input.button-primary',t).mousedown(function(){
			
			var c = 'class="'+jQuery('input.span_class',t).val()+'"';
			var i = 'id="'+jQuery('input.span_id',t).val()+'"';
	
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_class',c));
			jQuery('input[type="hidden"]',t).val(jQuery('input[type="hidden"]',t).val().replace('pix_id',i));
		});
		
		
	});
});



/*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/

(function(){

	var DOM = tinymce.DOM;
	
	tinymce.init
	
	tinymce.create('tinymce.plugins.Delight', {
		mceTout : 0,
		
		init : function(ed, url) {
			var t = this,
				hWin = jQuery(window).height()-100;



/******************************************************
*
*	Slideshow
*
******************************************************/
			ed.addButton('pix_slideshow_sc', {
				title : 'Add a slideshow', 
				image : themedir+'/functions/images/slideshow_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_slideshow_metabox");
					t.dialog({
						height: hWin,
						width: 560,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Slideshow shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	GoogleMap
*
******************************************************/
			ed.addButton('pix_googlemap_sc', {
				title : 'Add a Google map',
				image : themedir+'/functions/images/googlemap_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_googlemap_metabox");
					t.dialog({
						height: 350,
						width: 500,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Google map shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Conctact forms
*
******************************************************/
			ed.addButton('pix_contactform_sc', {
				title : 'Add a contact form', 
				image : themedir+'/functions/images/contactform_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_contactform_metabox");
					t.dialog({
						height: 250,
						width: 500,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Contact form shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Tooltip
*
******************************************************/
			ed.addButton('pix_tooltip_sc', {
				title : 'Add a tooltip', 
				image : themedir+'/functions/images/tooltip_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_tooltip_metabox");
					t.dialog({
						height: 620,
						width: 500,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Contact form shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Video
*
******************************************************/
			ed.addButton('pix_video_sc', {
				title : 'Insert a video', 
				image : themedir+'/functions/images/movie_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_video_metabox");
					t.dialog({
						height: 650,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Video shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Audio
*
******************************************************/
			ed.addButton('pix_audio_sc', {
				title : 'Insert an MP3', 
				image : themedir+'/functions/images/audio_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_audio_metabox");
					t.dialog({
						height: 650,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Audio shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Accordion
*
******************************************************/
			ed.addButton('pix_accordion_sc', {
				title : 'Insert an accordion', 
				image : themedir+'/functions/images/accordion_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_accordion_metabox");
					t.dialog({
						height: 750,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Accordion shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Tabs
*
******************************************************/
			ed.addButton('pix_tab_sc', {
				title : 'Insert tabs',
				image : themedir+'/functions/images/tab_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_tab_metabox");
					t.dialog({
						height: 750,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Tab shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Columns
*
******************************************************/
			ed.addButton('pix_column_sc', {
				title : 'Insert columns', 
				image : themedir+'/functions/images/columns_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_columns_metabox");
					t.dialog({
						height: 600,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Column shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('#column_code',t).html();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Sitemap
*
******************************************************/
			ed.addButton('pix_sitemap_sc', {
				title : 'Add a Site map', 
				image : themedir+'/functions/images/sitemap_shortcode_icon.png',
				onclick : function() {
					var sC = '[pix_sitemap]';
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
				}
			});

/******************************************************
*
*	Boxes
*
******************************************************/
			ed.addButton('pix_box_sc', {
				title : 'Insert a box', 
				image : themedir+'/functions/images/box_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_box_metabox");
					jQuery('#box_generator input[type="hidden"]').val('[pix_box pix_inp pix_bg pix_color pix_border_size pix_border_style pix_border_color]Your content[/pix_box]');
					t.dialog({
						height: 600,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Box shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Lists
*
******************************************************/
			ed.addButton('pix_list_sc', {
				title : 'Insert a custom list', 
				image : themedir+'/functions/images/list_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_list_metabox");
					t.dialog({
						height: 220,
						width: 270,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'List shortcode generator',
						zIndex: 50
					});
					jQuery('img',t).click(function(){
						jQuery('img',t).removeClass('active');
						jQuery(this).addClass('active');
						var sC = jQuery(this).attr('id');
						jQuery('input[type="hidden"]',t).val('<ul class="'+sC+'"><li>First list item</li><li>Second list item... go on</li></ul>');
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Dropcap
*
******************************************************/
			ed.addButton('pix_dropcap_sc', {
				title : 'Insert a drop cap', 
				image : themedir+'/functions/images/dropcap_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_dropcap_metabox");
					jQuery('#dropcap_generator input[type="hidden"]').val('[pix_dropcap pix_height pix_line_height pix_width pix_font pix_bg pix_color pix_shape pix_top pix_right]A[/pix_dropcap]');
					t.dialog({
						height: 800,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Drop cap shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Button
*
******************************************************/
			ed.addButton('pix_button_sc', {
				title : 'Insert a button', 
				image : themedir+'/functions/images/button_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_button_metabox");
					jQuery('#button_generator input[type="hidden"]').val('[pix_button pix_bg pix_hover pix_color pix_border_color pix_border_size pix_size]pix_text[/pix_button]');
					t.dialog({
						height: 650,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Drop cap shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Price table
*
******************************************************/
			ed.addButton('pix_pricetable_sc', {
				title : 'Insert a price table', 
				image : themedir+'/functions/images/pricetable_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_pricetable_metabox");
					jQuery('#pricetable_generator input[type="hidden"]').val('');
					t.dialog({
						height: 600,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Price table shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('#pricetablecode',t).html();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	Span
*
******************************************************/
			ed.addButton('pix_span_sc', {
				title : 'Insert a span', 
				image : themedir+'/functions/images/span_shortcode_icon.png',
				onclick : function() {
					var t = jQuery("#_custom_span_metabox");
					t.dialog({
						height: 250,
						width: 520,
						modal: true,
						dialogClass: 'wp-dialog pix-dialog',
						title: 'Span shortcode generator',
						zIndex: 50
					});
					jQuery('.button-primary',t).one('click',function(){
						t.dialog('close');
						var sC = jQuery('input[type="hidden"]',t).val();
						tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
					});
				}
			});

/******************************************************
*
*	HR
*
******************************************************/
			ed.addButton('pix_hr_sc', {
				title : 'Insert a hr', 
				image : themedir+'/functions/images/hr_shortcode_icon.png',
				onclick : function() {
					var sC = '[hr]';
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
				}
			});

/******************************************************
*
*	To top
*
******************************************************/
			ed.addButton('pix_totop_sc', {
				title : 'Insert a to-top button', 
				image : themedir+'/functions/images/top_shortcode_icon.png',
				onclick : function() {
					var sC = '[totop]';
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
				}
			});

/******************************************************
*
*	Clear
*
******************************************************/
			ed.addButton('pix_clear_sc', {
				title : 'Insert a clear div', 
				image : themedir+'/functions/images/clear_shortcode_icon.png',
				onclick : function() {
					var sC = '[clear]';
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
				}
			});

/******************************************************
*
*	Clear
*
******************************************************/
			ed.addButton('pix_clear_sc', {
				title : 'Insert a clear div', 
				image : themedir+'/functions/images/clear_shortcode_icon.png',
				onclick : function() {
					var sC = '[clear]';
					tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sC);
				}
			});
		}
	});

    tinymce.PluginManager.add('delight', tinymce.plugins.Delight);
	
	jQuery('#_custom_slideshow_metabox-hide').parents('label').remove();
	jQuery('#_custom_slideshow_metabox .handlediv, #_custom_slideshow_metabox .hndle').remove();
	jQuery('#_custom_googlemap_metabox-hide').parents('label').remove();
	jQuery('#_custom_googlemap_metabox .handlediv, #_custom_googlemap_metabox .hndle').remove();
	jQuery('#_custom_contactform_metabox-hide').parents('label').remove();
	jQuery('#_custom_contactform_metabox .handlediv, #_custom_contactform_metabox .hndle').remove();
	jQuery('#_custom_tooltip_metabox-hide').parents('label').remove();
	jQuery('#_custom_tooltip_metabox .handlediv, #_custom_tooltip_metabox .hndle').remove();
	jQuery('#_custom_video_metabox-hide').parents('label').remove();
	jQuery('#_custom_video_metabox .handlediv, #_custom_video_metabox .hndle').remove();
	jQuery('#_custom_audio_metabox-hide').parents('label').remove();
	jQuery('#_custom_audio_metabox .handlediv, #_custom_audio_metabox .hndle').remove();
	jQuery('#_custom_accordion_metabox-hide').parents('label').remove();
	jQuery('#_custom_accordion_metabox .handlediv, #_custom_accordion_metabox .hndle').remove();
	jQuery('#_custom_tab_metabox-hide').parents('label').remove();
	jQuery('#_custom_tab_metabox .handlediv, #_custom_tab_metabox .hndle').remove();
	jQuery('#_custom_columns_metabox-hide').parents('label').remove();
	jQuery('#_custom_columns_metabox .handlediv, #_custom_columns_metabox .hndle').remove();
	jQuery('#_custom_box_metabox-hide').parents('label').remove();
	jQuery('#_custom_box_metabox .handlediv, #_custom_box_metabox .hndle').remove();
	jQuery('#_custom_list_metabox-hide').parents('label').remove();
	jQuery('#_custom_list_metabox .handlediv, #_custom_list_metabox .hndle').remove();
	jQuery('#_custom_dropcap_metabox-hide').parents('label').remove();
	jQuery('#_custom_dropcap_metabox .handlediv, #_custom_dropcap_metabox .hndle').remove();
	jQuery('#_custom_button_metabox-hide').parents('label').remove();
	jQuery('#_custom_button_metabox .handlediv, #_custom_button_metabox .hndle').remove();
	jQuery('#_custom_pricetable_metabox-hide').parents('label').remove();
	jQuery('#_custom_pricetable_metabox .handlediv, #_custom_pricetable_metabox .hndle').remove();
	jQuery('#_custom_span_metabox-hide').parents('label').remove();
	jQuery('#_custom_span_metabox .handlediv, #_custom_span_metabox .hndle').remove();
	jQuery('#_custom_hr_metabox-hide').parents('label').remove();
	jQuery('#_custom_hr_metabox .handlediv, #_custom_hr_metabox .hndle').remove();
	jQuery('#_custom_totop_metabox-hide').parents('label').remove();
	jQuery('#_custom_totop_metabox .handlediv, #_custom_totop_metabox .hndle').remove();
	jQuery('#_custom_clear_metabox-hide').parents('label').remove();
	jQuery('#_custom_clear_metabox .handlediv, #_custom_clear_metabox .hndle').remove();

})();

jQuery(window).one('load',function(){
	jQuery('#pix_body #pix_front_page_content_toolbar3').hide();
});