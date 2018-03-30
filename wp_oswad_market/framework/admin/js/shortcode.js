var shortcode = {
	init:function(){
		jQuery('#sc_send_editor').click(function(){
			shortcode.sendEditor();
		});
		jQuery('ul.the-icons > li > a').click(function(event){
			event.preventDefault();

			var shortcode_string = '';
			shortcode_string = jQuery(this).children('i').attr('class');
			if( typeof shortcode_string !== 'undefined' && shortcode_string.length > 0 ){
				if( jQuery('input:radio[name=icon_animation]:checked').val().length > 0 ){
					shortcode_string += " " + jQuery('input:radio[name=icon_animation]:checked').val();
				}
				if( jQuery('input:radio[name=icon_size]:checked').val().length > 0 ){
					shortcode_string += " " + jQuery('input:radio[name=icon_size]:checked').val();
				}	
				if( jQuery('input:radio[name=icon_mute]:checked').val().length > 0 ){
					shortcode_string += " " + jQuery('input:radio[name=icon_mute]:checked').val();
				}
				if( jQuery('input:radio[name=icon_border]:checked').val().length > 0 ){
					shortcode_string += " " + jQuery('input:radio[name=icon_border]:checked').val();
				}	
				
				shortcode_string = "[icon icon=\""+shortcode_string+"\"]";
				jQuery('#icons-string').val(shortcode_string);
				shortcode.sendEditor();
			}
		});		
        jQuery('.sc_selector').change(function(){
            if(jQuery('.sc_options div.active')){
                jQuery('.sc_options div.active').fadeOut('slow');
				jQuery('.sc_options div.active').removeClass('active');
            }
            if(this.value != ''){
                jQuery('#' + this.value + '_options').fadeIn('slow');
                jQuery('#' + this.value + '_options').addClass('active');
            }
                    
       });

	},

	generate:function(){
		var type = jQuery('.sc_selector').val();
		switch( type ){
			case 'custom_query':
				if(jQuery('#query_string_custom_query').val())
					return '[custom_query query_string="' + jQuery('#query_string_custom_query').val() + '"]';
				else
					return '';
				break;
			case 'add_line':
				return '[add_line height_line="' + jQuery('#height_line_add_line').val() + '" color="' + jQuery('#color_add_line').val() + '" class="' + jQuery('#add_line_class').val() + '"]';
				break;
			case 'banner':
				var _link_url = jQuery('#banner_link_url').val();
				var _bg_image = jQuery('#banner_bg_image').val();
				var _bg_color = jQuery('#banner_bg_color').val();
				var _title = jQuery('#banner_title').val();
				var _title_color = jQuery('#banner_title_color').val();
                var _font_size_title = jQuery('#font_size_title').val();
                
				var _sub_title = jQuery('#banner_sub_title').val();
				var _sub_title_color = jQuery('#banner_sub_title_color').val();
                var _font_size_sub_title = jQuery('#font_size_sub_title').val();
				var _border_color = jQuery('#banner_border_color').val();
				var _top_padding = jQuery('#banner_top_padding').val();
				var _left_padding = jQuery('#banner_left_padding').val();
                var _bottom_padding = jQuery('#banner_bottom_padding').val();
				var _right_padding = jQuery('#banner_right_padding').val();
				var _inner_stroke = jQuery('#banner_inner_stroke').val();
				var _inner_stroke_color = jQuery('#banner_inner_stroke_color').val();
				var _sep_padding = jQuery('#banner_sep_padding').val();
				var _sep_color = jQuery('#banner_sep_color').val();
				var _label = jQuery('#banner_label').val();
				var _label_text = jQuery('#banner_label_text').val();
				var _label_text_color = jQuery('#banner_label_text_color').val();
				//var _label_bg_color = jQuery('#banner_label_bg_color').val();
				var _label_top = jQuery('#banner_label_top').val();
                var _label_right = jQuery('#banner_label_right').val();
                var _box_shadow_color = jQuery('#banner_box_shadow_color').val();

				_bg_color = ( _bg_color == "Click to choose color" ? "#000" : _bg_color);
				_title_color = ( _title_color == "Click to choose color" ? "#fff" : _title_color);
				_sub_title_color = ( _sub_title_color == "Click to choose color" ? "#fff" : _sub_title_color);
				_border_color = ( _border_color == "Click to choose color" ? "#fff" : _border_color);
				_inner_stroke_color = ( _inner_stroke_color == "Click to choose color" ? "#fff" : _inner_stroke_color);
				_sep_color = ( _sep_color == "Click to choose color" ? "#fff" : _sep_color);
				//_label_bg_color = ( _label_bg_color == "Click to choose color" ? "#fff" : _label_bg_color);
                _box_shadow_color = ( _box_shadow_color == "Click to choose color" ? "rgba(0,0,0,0)" : _box_shadow_color);
				_label_text_color = ( _label_text_color == "Click to choose color" ? "#000" : _label_text_color);
				return '[banner link_url="' + _link_url + '" bg_image="' + _bg_image + '" bg_color="' + _bg_color + '" title="' + _title + '" font_size_title="' + _font_size_title + '" title_color="' + _title_color + '" subtitle="' + _sub_title + '" font_size_subtitle="' + _font_size_sub_title + '" subtitle_color="' + _sub_title_color + '" border_color="' + _border_color + '" top_padding="' + _top_padding + '" left_padding="' + _left_padding + '" bottom_padding="' + _bottom_padding + '" right_padding="' + _right_padding + '" inner_stroke="' + _inner_stroke + '" inner_stroke_color="' + _inner_stroke_color + '" sep_padding="' + _sep_padding + '" sep_color="' + _sep_color + '" label="' + _label + '" label_text="' + _label_text +  '" label_text_color="' + _label_text_color + '" label_top="' + _label_top +  '" label_right="' + _label_right + '" box_shadow_color="' + _box_shadow_color + '"]';
				break;				
			case 'hidden_phone':
				return '[hidden_phone]' + jQuery('#hidden_phone_content').val() + '[/hidden_phone]';
				break;				
			case 'custom_product':
				return '[custom_product id="' + jQuery('#custom_product_id').val() + '" sku="' + jQuery('#custom_product_sku').val() + '" title="' + jQuery('#custom_product_title').val() + '"]';
				break;
			case 'custom_products_category':
				return '[custom_products_category category="' + jQuery('#custom_products_category_category').val() + '" orderby="' + jQuery('#custom_products_category_orderby').val()  + '" order="' + jQuery('#custom_products_category_order').val()+ '"]';
				break;
			case 'featured_product_slider':
				return '[featured_product_slider columns="' + jQuery('#featured_product_slider_columns').val() + '" layout="' + jQuery('#featured_product_slider_layout').val() + '" per_page="' + jQuery('#featured_product_slider_per_page').val() + '" title="' + jQuery('#featured_product_slider_title').val() + '" desc="' + jQuery('#featured_product_slider_description').val() + '" show_nav="' + jQuery('#featured_product_slider_show_nav').val() + '" show_icon_nav="' + jQuery('#featured_product_slider_show_icon_nav').val() + '" show_image="' + jQuery('#featured_product_slider_show_image').val() + '" show_title="' + jQuery('#featured_product_slider_show_title').val() + '" show_sku="' + jQuery('#featured_product_slider_show_sku').val() + '" show_price="' + jQuery('#featured_product_slider_show_price').val() + '" show_label="' + jQuery('#featured_product_slider_show_label').val() + '" show_rating="' + jQuery('#featured_product_slider_show_rating').val() + '" show_categories="' + jQuery('#featured_product_slider_show_categories').val() + '" show_short_content="' + jQuery('#featured_product_slider_show_short_content').val() + '"]';
				break;
			case 'best_selling_product_slider':
				return '[best_selling_product_slider columns="' + jQuery('#best_selling_product_slider_columns').val() + '" layout="' + jQuery('#best_selling_product_slider_layout').val() + '" per_page="' + jQuery('#best_selling_product_slider_per_page').val() + '" title="' + jQuery('#best_selling_product_slider_title').val() + '" desc="' + jQuery('#best_selling_product_slider_description').val() + '" show_nav="' + jQuery('#best_selling_product_slider_show_nav').val() + '" show_icon_nav="' + jQuery('#best_selling_product_slider_show_icon_nav').val() + '" show_image="' + jQuery('#best_selling_product_slider_show_image').val() + '" show_title="' + jQuery('#best_selling_product_slider_show_title').val() + '" show_sku="' + jQuery('#best_selling_product_slider_show_sku').val() + '" show_price="' + jQuery('#best_selling_product_slider_show_price').val() + '" show_label="' + jQuery('#best_selling_product_slider_show_label').val() + '" show_rating="' + jQuery('#best_selling_product_slider_show_rating').val() + '" show_categories="' + jQuery('#best_selling_product_slider_show_categories').val() + '" show_short_content="' + jQuery('#best_selling_product_slider_show_short_content').val() + '"]';
				break;
			case 'recent_product_slider':
				return '[recent_product_slider columns="' + jQuery('#recent_product_slider_columns').val() + '" layout="' + jQuery('#recent_product_slider_layout').val() + '" per_page="' + jQuery('#recent_product_slider_per_page').val() + '" title="' + jQuery('#recent_product_slider_title').val() + '" desc="' + jQuery('#recent_product_slider_description').val() + '" show_nav="' + jQuery('#recent_product_slider_show_nav').val() + '" show_icon_nav="' + jQuery('#recent_product_slider_show_icon_nav').val() + '" show_image="' + jQuery('#recent_product_slider_show_image').val() + '" show_title="' + jQuery('#recent_product_slider_show_title').val() + '" show_sku="' + jQuery('#recent_product_slider_show_sku').val() + '" show_price="' + jQuery('#recent_product_slider_show_price').val() + '" show_label="' + jQuery('#recent_product_slider_show_label').val() + '" show_rating="' + jQuery('#recent_product_slider_show_rating').val() + '" show_categories="' + jQuery('#recent_product_slider_show_categories').val() + '" show_short_content="' + jQuery('#recent_product_slider_show_short_content').val() + '"]';
				break;
			case 'popular_product_slider':
				return '[popular_product_slider columns="' + jQuery('#popular_product_slider_columns').val() + '" layout="' + jQuery('#popular_product_slider_layout').val() + '" per_page="' + jQuery('#popular_product_slider_per_page').val() + '" title="' + jQuery('#popular_product_slider_title').val() + '" desc="' + jQuery('#popular_product_slider_description').val() + '" show_nav="' + jQuery('#popular_product_slider_show_nav').val() + '" show_icon_nav="' + jQuery('#popular_product_slider_show_icon_nav').val() + '" show_image="' + jQuery('#popular_product_slider_show_image').val() + '" show_title="' + jQuery('#popular_product_slider_show_title').val() + '" show_sku="' + jQuery('#popular_product_slider_show_sku').val() + '" show_price="' + jQuery('#popular_product_slider_show_price').val() + '" show_label="' + jQuery('#popular_product_slider_show_label').val() + '" show_rating="' + jQuery('#popular_product_slider_show_rating').val() + '" show_categories="' + jQuery('#popular_product_slider_show_categories').val() + '" show_short_content="' + jQuery('#popular_product_slider_show_short_content').val() + '"]';
				break;
			case 'recent_product_by_categories_slider':
				return '[recent_product_by_categories_slider columns="' + jQuery('#recent_product_by_categories_slider_columns').val() + '" layout="' + jQuery('#recent_product_by_categories_slider_layout').val() + '" per_page="' + jQuery('#recent_product_by_categories_slider_per_page').val() + '" title="' + jQuery('#recent_product_by_categories_slider_title').val() + '" desc="' + jQuery('#recent_product_by_categories_slider_description').val() + '" show_nav="' + jQuery('#recent_product_by_categories_slider_show_nav').val() + '" show_icon_nav="' + jQuery('#recent_product_by_categories_slider_show_icon_nav').val() + '" show_image="' + jQuery('#recent_product_by_categories_slider_show_image').val() + '" show_title="' + jQuery('#recent_product_by_categories_slider_show_title').val() + '" show_sku="' + jQuery('#recent_product_by_categories_slider_show_sku').val() + '" show_price="' + jQuery('#recent_product_by_categories_slider_show_price').val() + '" show_label="' + jQuery('#recent_product_by_categories_slider_show_label').val() + '" show_rating="' + jQuery('#recent_product_by_categories_slider_show_rating').val() + '" show_categories="' + jQuery('#recent_product_by_categories_slider_show_categories').val() + '" show_short_content="' + jQuery('#recent_product_by_categories_slider_show_short_content').val() + '" cat_slug="' + jQuery('#recent_product_by_categories_slider_cat_slug').val() + '"]';
				break;			
			case 'icon':
				return jQuery('#icons-string').val();
				break;	
			case 'google_map':
				return '[google_map map_type="' + jQuery('#google_map_type').val() + '" address="' + jQuery('#google_map_address').val() + '" title="' + jQuery('#google_map_address_title').val() + '" zoom="' + jQuery('#google_map_zoom').val() + '" height="' + jQuery('#google_map_height').val() + '" map_color="' + jQuery('#google_map_color').val() + '" road_color="' + jQuery('#google_map_road_color').val() + '" water_color="' + jQuery('#google_map_water_color').val() + '"]';
				break;				
			case 'dropcap':
				var sc_result = '[dropcap';
				if(jQuery('#dropcap_color').val()){
					sc_result += ' color="' + jQuery('#dropcap_color').val() + '"';
				}
				sc_result += ']'+ jQuery('#dropcap_content').val() +'[/dropcap]';
				return sc_result;
				break;					
			case 'align':
				return '[align style="' + jQuery('#align_style').val() + '"]'+ jQuery('#align_content').val() + "[/align]";
				break;		
			case 'heading':
				return '[heading size="' + jQuery('#heading_size').val() + '"]'+ jQuery('#heading_content').val() + "[/heading]";
				break;
			case 'portfolio':
				return '[portfolio id="' + jQuery('#portfolio_id').val() + '" slug="' + jQuery('#portfolio_slug').val() + '"]' + "[/portfolio]";
				break;		
			case 'hr':
				return '[hr style="' + jQuery('#hr_style').val()+'"]';
				break;
			case 'service_item':
				if(jQuery('#service_id').val().length <= 0){
					alert('Please choose server item from list');
					return '';
				}
				return '[ew_service_item display_style="' + jQuery('#service_style').val() + '" items_id="' + jQuery('#service_id').val() + '"]';
				break;
			case 'add_button':
				return '[add_button width="' + jQuery('#width_add_button').val() + '" height="' + jQuery('#height_add_button').val() + '" background_color="' + jQuery('#background_color_add_button').val() + '" color="' + jQuery('#color_add_button').val() + '"]' + jQuery('#content_add_button').val() + '[/add_button]';
				break;	
			case 'quote':
				var sc_result = '[quote';
				//if(jQuery('#style_quote').val())
				//	sc_result += ' style="' + jQuery('#style_quote').val() + '"';
				if(jQuery('#custom_class_quote').val())
					sc_result += ' class="' + jQuery('#custom_class_quote').val() + '"';	
				sc_result += ']';	
				sc_result += jQuery('#content_quote').val() + '[/quote]';
				return sc_result;
				break;
			case 'block':
				var sc_result = '[block';
				if(jQuery('#border_color_block').val())
					sc_result += ' border_color="' + jQuery('#border_color_block').val() + '"';
				if(jQuery('#background_color_block').val())
					sc_result += ' background_color="' + jQuery('#background_color_block').val() + '"';
				if(jQuery('#custom_class_block').val())
					sc_result += ' custom_class="' + jQuery('#custom_class_block').val() + '"';
				sc_result += ']';
				sc_result += jQuery('#content_block').val() + '[/block]';
				return sc_result;
				break;	
			case 'button_group':
				var _add_on_params = '';
				if( jQuery('#vertical_button_group').val() == 1 )
					_add_on_params += ' vertical="1"';
				return '[button_group' + _add_on_params + ']' + jQuery('#content_button_group').val() + '[/button_group]';
				break;				
			case 'button':
				var sc_result = '[button ';
				if(jQuery('#size_button').val())
					sc_result += 'size="' + jQuery('#size_button').val() + '" ';
				if(jQuery('#type_button').val()){
					sc_result += 'type="' + jQuery('#type_button').val() + '" ';
				}
				if(jQuery('#link_button').val())
					sc_result += 'link="' + jQuery('#link_button').val() + '" ';	
                if(jQuery('#background_button').val())
					sc_result += 'background="' + jQuery('#background_button').val() + '" ';
                if(jQuery('#opacity_button').val())
					sc_result += 'opacity="' + jQuery('#opacity_button').val() + '" ';	        	
				if(jQuery('#color_button').val())
					sc_result += 'color="' + jQuery('#color_button').val() + '" ';
				if(jQuery('#color_text_button').val())
					sc_result += 'color_text="' + jQuery('#color_text_button').val() + '" ';	
				//if(jQuery('#shadow_button').val())
				//	sc_result += 'shadow="' + jQuery('#shadow_button').val() + '" ';
				//if(jQuery('#color_hover_button').val())
					//sc_result += 'color_hover="' + jQuery('#color_hover_button').val() + '" ';	
				if(jQuery('#custom_class_button').val())
					sc_result += 'custom_class="' + jQuery('#custom_class_button').val() + '" ';
				sc_result = jQuery.trim(sc_result);	
				sc_result += ']';
				sc_result += jQuery('#content_button').val() + '[/button]';
				return sc_result;
				break;
			case 'alert':
				var sc_result = '[alert ';
				if(jQuery('#style_alert').val())
					sc_result += 'style="' + jQuery('#style_alert').val() + '" ';
				if(jQuery('#close_alert').val())
					sc_result += 'close="' + jQuery('#close_alert').val() + '" ';					
				sc_result += ']';
				sc_result += jQuery('#content_alert').val() + '[/alert]';
				return sc_result;
				break;					
			case 'label':
				var sc_result = '[label ';
				if(jQuery('#type_label').val())
					sc_result += 'type="' + jQuery('#type_label').val() + '" ';
				sc_result += ']';
				sc_result += jQuery('#content_label').val() + '[/label]';
				return sc_result;
				break;		
			case 'badge':
				var sc_result = '[badge ';
				if(jQuery('#type_badge').val())
					sc_result += 'type="' + jQuery('#type_badge').val() + '" ';
				sc_result += ']';
				sc_result += jQuery('#content_badge').val() + '[/badge]';
				return sc_result;
				break;		
			case 'checklist':
				var sc_result = '[checklist ';
				if(jQuery('#checklist_icon').val())
					sc_result += 'icon="' + jQuery('#checklist_icon').val() + '" ';
				sc_result += ']';
				sc_result += "\n<ul>\n";
				sc_result += "\n\t<li>list item #1</li>";
				sc_result += "\n\t<li>list item #2</li>";
				sc_result += "\n\t<li>list item #3</li>";
				sc_result += "\n</ul>\n" + '[/checklist]';
				return sc_result;
				break;					
			case 'hightlight_text':
				return '[hightlight_text background="' + jQuery('#background_hightlight_text').val() + '"]' + jQuery('#content_hightlight_text').val() + '[/hightlight_text]';
				break;
			case 'slideshow':
				var sc_result = '[slideshow';
				if(jQuery('#slideshow_width').val())
					sc_result += ' width="' + jQuery('#slideshow_width').val() + '"';
				if(jQuery('#slideshow_height').val())
					sc_result += ' height="' + jQuery('#slideshow_height').val() + '"';
				sc_result += ']';
				if(jQuery('#slideshow_content').val())
					sc_result += "\n"+jQuery('#slideshow_content').val()+"\n";	
				sc_result += '[/slideshow]';	
				//sc_result = jQuery.trim(sc_result);	
				return sc_result;
				break;
			case 'ew_recent_slider':
				var sc_result = '[ew_recent_slider ';
				if(jQuery('#width_ew_recent_slider').val())
					sc_result += 'width="' + jQuery('#width_ew_recent_slider').val() + '" ';
				if(jQuery('#height_ew_recent_slider').val())
					sc_result += 'height="' + jQuery('#height_ew_recent_slider').val() + '" ';
				if(jQuery('#showposts_ew_recent_slider').val())
					sc_result += 'showposts="' + jQuery('#showposts_ew_recent_slider').val() + '" ';
				if(jQuery('#post_type_ew_recent_slider').val())
					sc_result += 'post_type="' + jQuery('#post_type_ew_recent_slider').val() + '" ';
				if(jQuery('#auto_play_ew_recent_slider').val())
					sc_result += 'auto_play="' + jQuery('#auto_play_ew_recent_slider').val() + '" ';
				if(jQuery('#delay_ew_recent_slider').val())
					sc_result += 'delay="' + jQuery('#delay_ew_recent_slider').val() + '" ';
				if(jQuery('#class_ew_recent_slider').val())
					sc_result += 'class="' + jQuery('#class_ew_recent_slider').val() + '" ';
				if(jQuery('#num_pic_per_slide_ew_recent_slider').val())
					sc_result += 'num_pic_per_slide="' + jQuery('#num_pic_per_slide_ew_recent_slider').val() + '" ';
				if(jQuery('#post_type_ew_recent_slider').val() == 'post')
				{
					if(jQuery('#category_ew_recent_slider').val())
						sc_result += 'category="' + jQuery('#category_ew_recent_slider').val() + '" ';
				}
				else
				{
					if(jQuery('#gallery_ew_recent_slider').val())
						sc_result += 'gallery="' + jQuery('#gallery_ew_recent_slider').val() + '" ';
					
				}	
				sc_result = jQuery.trim(sc_result);	
				sc_result += ']';
				return sc_result;
				break;	
			case 'ew_recent_blog':
				var sc_result = '[ew_recent_blog ';
				if(jQuery('#width_thumb_ew_recent_blog').val())
					sc_result += 'width_thumb="' + jQuery('#width_thumb_ew_recent_blog').val() + '" ';
				if(jQuery('#height_thumb_ew_recent_blog').val())
					sc_result += 'height_thumb="' + jQuery('#height_thumb_ew_recent_blog').val() + '" ';
				if(jQuery('#post_per_page_ew_recent_blog').val())
					sc_result += 'post_per_page="' + jQuery('#post_per_page_ew_recent_blog').val() + '" ';
				if(jQuery('#show_pagination_ew_recent_blog').val())
					sc_result += 'show_pagination="' + jQuery('#show_pagination_ew_recent_blog').val() + '" ';
				if(jQuery('#class_ew_recent_blog').val())
					sc_result += 'class="' + jQuery('#class_ew_recent_blog').val() + '" ';
				sc_result = jQuery.trim(sc_result);	
				sc_result += ']';
				return sc_result;
				break;
			case 'ew_sidebar':
				var sc_result = '[ew_sidebar ';
				if(jQuery('#id_area_ew_sidebar').val())
					sc_result += 'id_area="' + jQuery('#id_area_ew_sidebar').val() + '" ';
				if(jQuery('#ul_class_ew_sidebar').val())
					sc_result += 'ul_class="' + jQuery('#ul_class_ew_sidebar').val() + '" ';
				if(jQuery('#id_sidebar_ew_sidebar').val())
					sc_result += 'id_sidebar="' + jQuery('#id_sidebar_ew_sidebar').val() + '" ';
				sc_result = jQuery.trim(sc_result);	
				sc_result += ']';
				return sc_result;
				break;					
			
			case 'ew_style_table':
				var sc_result = '[ew_style_table ';
				if(jQuery('#class_ew_sidebar').val())
					sc_result += 'class="' + jQuery('#class_ew_sidebar').val() + '" ';
				if(jQuery('#width_ew_sidebar').val())
					sc_result += 'width="' + jQuery('#width_ew_sidebar').val() + '" ';
				sc_result = jQuery.trim(sc_result);	
				sc_result += ']';
				sc_result += jQuery('#content_ew_sidebar').val() + '[/ew_style_table]';
				return sc_result;
			case 'ew_img_video':
				var sc_result = '[ew_img_video ';
				
				if(jQuery('#width_thumb_ew_img_video').val())
					sc_result += 'width_thumb="' + jQuery('#width_thumb_ew_img_video').val() + '" ';
				if(jQuery('#height_thumb_ew_img_video').val())
					sc_result += 'height_thumb="' + jQuery('#height_thumb_ew_img_video').val() + '" ';
				if(jQuery('#use_lightbox_ew_img_video').val() == 'false')
					sc_result += 'use_lightbox="' + jQuery('#use_lightbox_ew_img_video').val() + '" ';
				if(jQuery('#custom_link_ew_img_video').val())
					sc_result += 'custom_link="' + jQuery('#custom_link_ew_img_video').val() + '" ';
				if(jQuery('#title_ew_img_video').val())
					sc_result += 'title="' + jQuery('#title_ew_img_video').val() + '" ';		
				if(jQuery('#type_ew_img_video').val()){
					sc_result += 'type="' + jQuery('#type_ew_img_video').val() + '" ';
					if(jQuery('#type_ew_img_video').val() == 'image'){
						if(jQuery('#src_thumb_ew_img_video').val())
							sc_result += 'src_thumb="' + jQuery('#src_thumb_ew_img_video').val() + '" ';
						if(jQuery('#src_zoom_img_ew_img_video').val())
							sc_result += 'src_zoom_img="' + jQuery('#src_zoom_img_ew_img_video').val() + '" ';
					}
					else {
						if(jQuery('#link_video_ew_img_video').val())
							sc_result += 'link_video="' + jQuery('#link_video_ew_img_video').val() + '" ';
					}
				}

				if(jQuery('#class_ew_img_video').val())
					sc_result += 'class="' + jQuery('#class_ew_img_video').val() + '" ';
				sc_result = jQuery.trim(sc_result);	
				sc_result += ']';
				return sc_result;
				break;	
				
			case 'accordions':
				var sc_result = '[accordions';
				return sc_result + ']'+jQuery('#content_accordions').val()+'[/accordions]';
				break;
			case 'tooltip':
				var sc_result = '[tooltip';
				if(jQuery('#style_tooltip').val())
					sc_result += ' style="' + jQuery('#style_tooltip').val() + '" ';
				if(jQuery('#content_tooltip').val())
					sc_result += ' tooltip_content="' + jQuery('#content_tooltip').val() + '" ';					
				return sc_result + ']'+jQuery('#show_content').val()+'[/tooltip]';
				break;				
			case 'accordion_item':
				var sc_result = '[accordion_item ';
				if(jQuery('#title_accordion_item').val())
					sc_result += 'title="' + jQuery('#title_accordion_item').val() + '" ';
				sc_result = jQuery.trim(sc_result);	
				sc_result += ']';
				sc_result += jQuery('#content_accordion_item').val() + '[/accordion_item]';
				return sc_result;	
			case 'ew_list_post':
				var sc_result = '[ew_list_post';
				if(jQuery('#post_type_ew_list_post').val()!='post')
					sc_result += ' post_type="' + jQuery('#post_type_ew_list_post').val() + '"';
				if(jQuery('#column_count_ew_list_post').val())
					sc_result += ' column_count="' + jQuery('#column_count_ew_list_post').val() + '"';
				if(jQuery('#num_post_per_page_ew_list_post').val())
					sc_result += ' num_post_per_page="' + jQuery('#num_post_per_page_ew_list_post').val() + '"';
				if(jQuery('#width_thumb_ew_list_post').val())
					sc_result += ' width_thumb="' + jQuery('#width_thumb_ew_list_post').val() + '"';
				if(jQuery('#height_thumb_ew_list_post').val())
					sc_result += ' height_thumb="' + jQuery('#height_thumb_ew_list_post').val() + '"';
				if(jQuery('#filter_or_pag_ew_list_post').val() != 'pagination')
					sc_result += ' filter_or_pag="' + jQuery('#filter_or_pag_ew_list_post').val() + '"';
				if(jQuery('#custom_class_ew_list_post').val())
					sc_result += ' custom_class="' + jQuery('#custom_class_ew_list_post').val() + '"';
				if(jQuery('#action_ajax_ew_list_post').val())
					sc_result += ' action_ajax="' + jQuery('#action_ajax_ew_list_post').val() + '"';
				if(jQuery('#lightbox_ew_list_post').val() != 'true')
					sc_result += ' lightbox="' + jQuery('#lightbox_ew_list_post').val() + '"';
				if(jQuery('#multi_ul_ew_list_post').val() != 'false')
					sc_result += ' multi_ul="' + jQuery('#multi_ul_ew_list_post').val() + '"';	
				if(jQuery('#callback_ew_list_post').val())
					sc_result += ' callback="' + jQuery('#callback_ew_list_post').val() + '"';			
				sc_result = jQuery.trim(sc_result);	
				sc_result += ']';
				return sc_result;
			case 'tabs':
				var sc_result = '[tabs';
				if(jQuery('#custom_class_tabs').val())
					sc_result += ' custom_class="' + jQuery('#custom_class_tabs').val() + '"';
				if(jQuery('#style_class_tabs').val())
					sc_result += ' style="' + jQuery('#style_class_tabs').val() + '"';	
				sc_result += ']';
				sc_result += jQuery('#content_tabs').val() + '[/tabs]';
				return sc_result;
			case 'progress':
				var sc_result = '[progress';
				if(jQuery('#animated_bars').val())
					sc_result += ' animated_bars="' + jQuery('#animated_bars').val() + '"';	
				if(jQuery('#striped_bars').val())		
				sc_result += ' striped_bars="' + jQuery('#striped_bars').val() + '"';
				sc_result += '][bar';
				if(jQuery('#style_bar').val())
					sc_result += ' style="' + jQuery('#style_bar').val() + '"';
				if(jQuery('#percent_bars').val())
					sc_result += ' percent_bars="' + jQuery('#percent_bars').val() + '"';						
				sc_result += ']';
				sc_result += jQuery('#content_bars').val() + '[/bar][/progress]';
				return sc_result;								
			case 'tab_item':
				var sc_result = '[tab_item';
				if(jQuery('#custom_class_tab_item').val())
					sc_result += ' custom_class="' + jQuery('#custom_class_tab_item').val() + '"';
				if(jQuery('#title_tab_item').val())
					sc_result += ' title="' + jQuery('#title_tab_item').val() + '"';	
				sc_result += ']';
				sc_result += jQuery('#content_tab_item').val() + '[/tab_item]';
				return sc_result;	
			case 'ew_listing':
				var sc_result = '[ew_listing';
				if(jQuery('#style_class_ew_listing').val())
					sc_result += ' style_class="' + jQuery('#style_class_ew_listing').val() + '"';
				if(jQuery('#custom_class_ew_listing').val())
					sc_result += ' custom_class="' + jQuery('#custom_class_ew_listing').val() + '"';	
				sc_result += ']';
				sc_result += jQuery('#content_ew_listing').val() + '[/ew_listing]';
				return sc_result;
			case 'ew_embbed_video':
				if(jQuery('#src_ew_embbed_video').val()){
					var sc_result = '[ew_embbed_video';
					if(jQuery('#src_ew_embbed_video').val())
						sc_result += ' src="' + jQuery('#src_ew_embbed_video').val() + '"';
					if(jQuery('#width_ew_embbed_file').val())
						sc_result += ' width="' + jQuery('#width_ew_embbed_video').val() + '"';
					if(jQuery('#height_ew_embbed_file').val())
						sc_result += ' height="' + jQuery('#height_ew_embbed_video').val() + '"';	
					if(jQuery('#custom_class_ew_embbed_video').val())
						sc_result += ' custom_class="' + jQuery('#custom_class_ew_embbed_video').val() + '"';	
					sc_result += ']';
					return sc_result;		
				}
				else return '';	
			case 'ew_toggle':
				var sc_result = '[ew_toggle';
				if(jQuery('#title_ew_toggle').val())
					sc_result += ' title="' + jQuery('#title_ew_toggle').val() + '"';
				if(jQuery('#show_when_load_ew_toggle').val())
					sc_result += ' show_when_load="' + jQuery('#show_when_load_ew_toggle').val() + '"';
				if(jQuery('#speed_ew_toggle').val())
					sc_result += ' speed="' + jQuery('#speed_ew_toggle').val() + '"';
				if(jQuery('#style_ew_toggle').val())
					//sc_result += ' style="' + jQuery('#style_ew_toggle').val() + '"';	
				if(jQuery('#custom_class_ew_toggle').val())
					sc_result += ' custom_class="' + jQuery('#custom_class_ew_toggle').val() + '"';			
				sc_result += ']';
				sc_result += jQuery('#content_ew_toggle').val() + '[/ew_toggle]';
				return sc_result;
			case 'code':
				return '[code]'+ jQuery('#content_ew_code').val() +'[/code]';		
			case 'ew_framed_box':
				var sc_result = '[ew_framed_box';
				if(jQuery('#width_ew_framed_box').val())
					sc_result += ' width="' + jQuery('#width_ew_framed_box').val() + '"';
				if(jQuery('#height_ew_framed_box').val())
					sc_result += ' height="' + jQuery('#height_ew_framed_box').val() + '"';
				if(jQuery('#bgcolor_ew_framed_box').val())
					sc_result += ' bgcolor="' + jQuery('#bgcolor_ew_framed_box').val() + '"';	
				if(jQuery('#textcolor_ew_framed_box').val())
					sc_result += ' textcolor="' + jQuery('#textcolor_ew_framed_box').val() + '"';
				if(jQuery('#custom_class_ew_framed_box').val())
					sc_result += ' custom_class="' + jQuery('#custom_class_ew_framed_box').val() + '"';	
				sc_result += ']';	
				sc_result += jQuery('#content_ew_framed_box').val() + '[/ew_framed_box]';		
				return sc_result;
			case 'ew_style_box':
				var sc_result = '[ew_style_box';
				if(jQuery('#type_ew_style_box').val())
					sc_result += ' type="' + jQuery('#type_ew_style_box').val() + '"';
				if(jQuery('#type_ew_style_box').val() == 'custom'){
					if(jQuery('#stylebox_border_color').val())
						sc_result += ' border="' + jQuery('#stylebox_border_color').val() + '"';
					// if(jQuery('#stylebox_background_color').val())
						// sc_result += ' background="' + jQuery('#stylebox_background_color').val() + '"';
					// if(jQuery('#stylebox_text_color').val())
						// sc_result += ' text="' + jQuery('#stylebox_text_color').val() + '"';
				}
				sc_result += ']';	
				sc_result += jQuery('#content_style_box').val() + '[/ew_style_box]';		
				return sc_result;
			case 'ew_typography':
				var sc_result = '[ew_typography';
				if(jQuery('#custom_class_ew_typography').val())
					sc_result += ' custom_class="' + jQuery('#custom_class_ew_typography').val() + '"';
					
				var num_col = parseInt(jQuery('#num_col_ew_typography').val());
				sc_result += ' num_col="' + num_col + '"';
				sc_result += ']';
				if(num_col == 1)
					sc_result += jQuery('#content_1_ew_typography').val();
				else {
					for(var i = 1;i <= num_col;i++){
						if(i == num_col)
							sc_result += '<div class="col clast">';
						else
							sc_result += '<div class="col">';
						sc_result += jQuery('#content_' + i + '_ew_typography').val();	
						sc_result += '</div>';	
					}
				}
				sc_result += '[/ew_typography]';
				return sc_result;
			case 'ew_lightbox':
				if(jQuery('#href_ew_lightbox').val()){
					var sc_result = '[ew_lightbox';
					sc_result += ' href="' + jQuery('#href_ew_lightbox').val() + '"';
					if(jQuery('#title_ew_lightbox').val())
						sc_result += ' title="' + jQuery('#title_ew_lightbox').val() + '"';
					if(jQuery('#group_ew_lightbox').val())
						sc_result += ' group="' + jQuery('#group_ew_lightbox').val() + '"';
					if(jQuery('#use_iframe_ew_lightbox').val() == 'true')
						sc_result += ' use_iframe="' + jQuery('#use_iframe_ew_lightbox').val() + '"';	
					var lb_with = jQuery('#lb_with_ew_lightbox').val();
					sc_result += ' lb_with="' + jQuery('#lb_with_ew_lightbox').val() + '"';	
					if(lb_with == 'img'){
						if(jQuery('#photo_ew_lightbox').val())
							sc_result += ' photo="' + jQuery('#photo_ew_lightbox').val() + '"';	
						else {
							if(jQuery('#width_ew_lightbox').val())
								sc_result += ' width="' + jQuery('#width_ew_lightbox').val() + '"';
							if(jQuery('#height_ew_lightbox').val())
								sc_result += ' height="' + jQuery('#height_ew_lightbox').val() + '"';	
						}	
					}
					else if(lb_with == 'button'){
						if(jQuery('#button_text_ew_lightbox').val())
							sc_result += ' button_text="' + jQuery('#button_text_ew_lightbox').val() + '"';	
					}
					sc_result += ']';
					return sc_result;
				}
				return '';
			case 'ew_columns':	
				var sc_result = '[' + jQuery('#type_ew_columns').val() + ']' + jQuery('#content_ew_columns').val() + '[/' + jQuery('#type_ew_columns').val() + ']';
				return sc_result;
			case 'sitemap':
				var sc_result = '[sitemap';
				if(jQuery('#home_page_id_sitemap').val())
					sc_result += ' home_page_id="' + jQuery('#home_page_id_sitemap').val() + '"';
				if(jQuery('#home_page_sidebar_id_sitemap').val())
					sc_result += ' home_page_sidebar_id="' + jQuery('#home_page_sidebar_id_sitemap').val() + '"';
				if(jQuery('#shortcode_page_id_sitemap').val())
					sc_result += ' shortcode_page_id="' + jQuery('#shortcode_page_id_sitemap').val() + '"';
				if(jQuery('#portfolio_page_id_sitemap').val())
					sc_result += ' portfolio_page_id="' + jQuery('#portfolio_page_id_sitemap').val() + '"';
				if(jQuery('#blog_page_id_sitemap').val())
					sc_result += ' blog_page_id="' + jQuery('#blog_page_id_sitemap').val() + '"';		
				sc_result += ']';	
				return sc_result;
			case 'about':
				var sc_result='[about ' + 'about_id="'+ jQuery('#about_id').val() +'"]';
				return sc_result;
			case 'testimonials':
				return '[testimonial id="' + jQuery('#testimonial_id').val() + '" slug="' + jQuery('#testimonial_slug').val() + '"]' + "[/testimonial]";
			case 'feature':
				return '[feature id="' + jQuery('#feature_id').val() + '" slug="' + jQuery('#feature_slug').val() + '" title="' + jQuery('#feature_title').val() + '" thumbnail="' + jQuery('#feature_thumbnail').val()  + '" excerpt="' + jQuery('#feature_excerpt').val() + '" content="' + jQuery('#feature_content').val() + '"]' + "[/feature]";	
			case 'recent_blogs':
				var sc_result='[recent_blogs ';
				if(jQuery('#recent_blogs_category').val()){
					sc_result += 'category="'+ jQuery('#recent_blogs_category').val() +'" ';
				}
				sc_result += 'columns="'+ jQuery('input:radio[name=recent_blogs_column]:checked').val() +'" ' + 'number_posts="' + jQuery('#recent_blogs_count').val() + '" ';
				sc_result += 'title="'+ jQuery('input:radio[name=recent_blogs_show_title]:checked').val() +'" ' + 'thumbnail="' + jQuery('input:radio[name=recent_blogs_show_thumb]:checked').val() + '" ';
				sc_result += 'meta="'+ jQuery('input:radio[name=recent_blogs_show_meta]:checked').val() +'" ' + 'excerpt="' + jQuery('input:radio[name=recent_blogs_show_excerpt]:checked').val() + '"' + ' excerpt_words="' + jQuery('#recent_blogs_excerpt_words').val() + '"';
				sc_result += ']';
				return sc_result;				
			case 'recent_works':
				var sc_result='[recent_works ';
				if(jQuery('#gallery_id').val()){
					sc_result += 'gallery="'+ jQuery('#gallery_id').val() +'" ';
				}
				sc_result += 'count_items="' + jQuery('#count_items').val() + '"' + ' show_items="' + jQuery('#show_items').val() + '"]';
				return sc_result;				
		}
		return '';
	},
	getVal:function(a,b,c){
		if(b == undefined){
			var target = jQuery('[name="sc_'+a+'"]');
			if(target.is('.toggle-button')){
				if(target.is(':checked')){
					return true;
				}else{
					return false;
				}
			}
			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'[]"]').val();
			}else{
				return target.val();
			}
		}else if(c == undefined){
			var target = jQuery('[name="sc_'+a+'_'+b+'"]');
			if(target.is('.toggle-button')){
				if(target.is(':checked')){
					return true;
				}else{
					return false;
				}
			}
			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'_'+b+'[]"]').val();
			}else{
				return target.val();
			}
		}else {
			var target = jQuery('[name="sc_'+a+'_'+b+'_'+c+'"]');
			if(target.is('.toggle-button')){
				if(target.is(':checked')){
					return true;
				}else{
					return false;
				}
			}
			if(target.is('.tri-toggle-button')){
				switch(target.val()){
					case 'true':
						return true;
					case 'false':
						return false;
					case 'default':
						return '';
				}
			}
			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'_'+b+'_'+c+'[]"]').val();
			}else{
				return target.val();
			}
		}

	},
	sendEditor :function(){
		var win = window.dialogArguments || opener || parent || top;
		send_to_editor(shortcode.generate());
	},
	// sendToEditor :function( input_str ){
		// alert(123);
		// var win = window.dialogArguments || opener || parent || top;
		// send_to_editor( input_str );
	// },	
	getUploadedImage : function(target,src){
		jQuery("#"+target).val(src);
		jQuery("#"+target+"_preview").html('<a class="thickbox" href="'+src+'?"><img src="'+src+'"/></a>');
	}

}



jQuery(document).ready(function(){

	// storeSendToEditor = window.send_to_editor;
	// console.log(storeSendToEditor);
	// send_to_editor = function(html){
		// console.log(tinyMCE);
		// console.log(tinyMCE.get('content'));
	// }
    shortcode.init();
	// select type (image or video) for shortcode fancy box
	jQuery('#link_video_ew_img_video').parent().parent().hide();
	
	jQuery('#type_ew_img_video').change(function() {
		var type = jQuery(this).val();
		if(type == 'image'){
			jQuery('#src_thumb_ew_img_video').parent().parent().show();
			jQuery('#src_zoom_img_ew_img_video').parent().parent().show();
			jQuery('#link_video_ew_img_video').parent().parent().hide();
		}
		else {
			jQuery('#link_video_ew_img_video').parent().parent().show();
			jQuery('#src_thumb_ew_img_video').parent().parent().hide();
			jQuery('#src_zoom_img_ew_img_video').parent().parent().hide();
		}
	});
	jQuery('#stylebox_border_color').parent().parent().hide();
	jQuery('#stylebox_background_color').parent().parent().hide();
	jQuery('#stylebox_text_color').parent().parent().hide();
	jQuery('#type_ew_style_box').change(function() {
		var type = jQuery(this).val();
		if(type == 'custom'){
			jQuery('#stylebox_border_color').parent().parent().show();
			// jQuery('#stylebox_background_color').parent().parent().show();
			// jQuery('#stylebox_text_color').parent().parent().show();
		}
		else {
			jQuery('#stylebox_border_color').parent().parent().hide();
			// jQuery('#stylebox_background_color').parent().parent().hide();
			// jQuery('#stylebox_text_color').parent().parent().hide();
		}
	});
	
	
	// Show/hide enter content depend number column
	jQuery('#content_2_ew_typography').parent().parent().hide();
	jQuery('#content_3_ew_typography').parent().parent().hide();
	jQuery('#content_4_ew_typography').parent().parent().hide();
	jQuery('#num_col_ew_typography').change(function() {
		var num_col = parseInt(jQuery('#num_col_ew_typography').val());
		for(var i = 1;i <= num_col;i++){
			if(i <= num_col)
				jQuery('#content_' + i + '_ew_typography').parent().parent().show();
			else
				jQuery('#content_' + i + '_ew_typography').parent().parent().hide();
		}
	});
	
	// show/hide field photo, width and height
	jQuery('#photo_ew_lightbox').parent().parent().hide();
	jQuery('#width_ew_lightbox').parent().parent().hide();
	jQuery('#height_ew_lightbox').parent().parent().hide();
	jQuery('#button_text_ew_lightbox').parent().parent().hide();
	jQuery('#lb_with_ew_lightbox').change(function() {
		var lb_with = jQuery('#lb_with_ew_lightbox').val();
		if(lb_with == 'img'){
			jQuery('#photo_ew_lightbox').parent().parent().show();
			jQuery('#width_ew_lightbox').parent().parent().show();
			jQuery('#height_ew_lightbox').parent().parent().show();
			jQuery('#button_text_ew_lightbox').parent().parent().hide();
		}
		else{
			if(lb_with == 'button')
				jQuery('#button_text_ew_lightbox').parent().parent().show();
			else
				jQuery('#button_text_ew_lightbox').parent().parent().hide();
			jQuery('#photo_ew_lightbox').parent().parent().hide();
			jQuery('#width_ew_lightbox').parent().parent().hide();
			jQuery('#height_ew_lightbox').parent().parent().hide();
		}
	});
	
	// show/hide field category, gallery with recent_slider shortcode
	jQuery('#category_ew_recent_slider').parent().parent().hide();
	jQuery('#post_type_ew_recent_slider').change(function() {
		var type = jQuery(this).val();
		if(type == 'post'){
			jQuery('#category_ew_recent_slider').parent().parent().show();
			jQuery('#gallery_ew_recent_slider').parent().parent().hide();
		}
		else {
			jQuery('#gallery_ew_recent_slider').parent().parent().show();
			jQuery('#category_ew_recent_slider').parent().parent().hide();
		}
	});
	
	// illustrations quote
	jQuery('#quote_options .style2,#quote_options .style3').parent().hide();
	jQuery('#style_quote').change(function(){
		var style = jQuery(this).val().replace('quote-','');
		jQuery('#quote_options .style1,#quote_options .style2,#quote_options .style3').parent().hide();
		jQuery('#quote_options .' + style).parent().show();
		
	});
	
	// illustrations toggle
	jQuery('#ew_toggle_options .toggles-with-frame').parent().hide();
	jQuery('#style_ew_toggle').change(function(){
		var style = jQuery(this).val();
		jQuery('#ew_toggle_options .toggles-no-frame,#ew_toggle_options .toggles-with-frame').parent().hide();
		jQuery('#ew_toggle_options .' + style).parent().show();
		
	});
	
	// illustrations toggle
	jQuery('#ew_listing_options .listing-style').parent().hide();
	jQuery('#ew_listing_options .listing-style-1').parent().show();
	jQuery('#style_class_ew_listing').change(function(){
		var style = jQuery(this).val();
		jQuery('#ew_listing_options .listing-style').parent().hide();
		jQuery('#ew_listing_options .' + style).parent().show();
		
	});
});