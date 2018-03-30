<?php

	// Change Taxonomy for Media Categories
	$wpdb->query(
		"UPDATE wp_term_taxonomy SET taxonomy = 'portfolio-category' WHERE taxonomy = 'media-category'"
	);
	
	function convert_skin( $meta, $value )
	{
		if( $meta == 'outskin' )
		{
			if( $value == 'two' ) 		 return 'BlueDark';	
			if( $value == 'three' ) 	 return 'Blue';	
			if( $value == 'four' ) 		 return 'Teal';	
			if( $value == 'five' ) 		 return 'Green';	
			if( $value == 'six' ) 		 return 'Mustard';	
			if( $value == 'seven' ) 	 return 'Orange';	
			if( $value == 'eight' ) 	 return 'Red';	
			if( $value == 'nine' ) 		 return 'Pink';	
			if( $value == 'ten' ) 		 return 'GreyDark';	
			if( $value == 'eleven' ) 	 return 'Urban';	
			if( $value == 'twelve' ) 	 return 'Carbon';	
			if( $value == 'thirteen' ) 	 return 'Wood';	
			if( $value == 'fourteen' ) 	 return 'Grunge';	
			if( $value == 'fithteen' ) 	 return 'Bokeh';	
			if( $value == 'sixteen' ) 	 return 'TealDark';	
			if( $value == 'seventeen' )  return 'GreenDark';		
			if( $value == 'eighteen' ) 	 return 'PinkDark';		
			if( $value == 'nineteen' ) 	 return 'RedDark';		
			if( $value == 'twenty' ) 	 return 'BrownDark';
			if( $value == 'customplus' ) return 'CustomPlus';
			if( $value == 'custom' ) 	 return 'Custom';				
		}
		
		if( $meta == 'inskin' )
		{
			if( $value == 'one' ) 		 return 'light';	
			if( $value == 'two' ) 		 return 'dark';	
		}
	}
		
	$options_array = array(
			'enable_responsive',
			'pagelayout',
			'breadcrumb',
			'pagecomments',
			'author_bio',
			'cufon_font',
			'nv_font_type',
			'googlefont_url_1',
			'googlefont_url_2',
			'googlefont_css_1',
			'googlefont_css_2',
			'buddylayout',
			'buddycontentborder',
			'buddycolone',
			'buddycolone_border',
			'buddycoltwo',
			'buddycoltwo_border',
			'sidebars_num',
			'timthumb_disable',
			'jwplayer_js',
			'jwplayer_swf',
			'jwplayer_yt',
			'jwplayer_skin',
			'jwplayer_skinpos',
			'jwplayer_plugins',
			'jwplayer_height',
			'flickr_apikey',
			'flickr_userid',
			'slideset_enable',
			'medialib_disable',
			'sociallink_digg',
			'sociallink_fb',
			'sociallink_linkedin',
			'sociallink_deli',
			'sociallink_google',
			'sociallink_reddit',
			'sociallink_stumble',
			'sociallink_twitter',
			'sociallink_rss',
			'sociallink_youtube',
			'sociallink_vimeo',
			'sociallink_pinterest',
			'sociallink_email',
			'sociallink_instagram',
			'sociallink_soundcloud',
			'rss_feed',
			'rss_title',
			'twitter_usrname',
			'twitter_feednum',
			'twitter_label',
			'inskin',
			'outskin',
			'arhpostdisplay',
			'arhpostcolumns',
			'arhpostcontent',
			'arhexcerpt',
			'arhpostpostmeta',
			'arhimgdisplay',
			'arhimgheight',	
			'arhimgwidth',
			'arhimgeffect',
			'arhimgalign',
			'postmetaalign',
			'postimgdisplay',
			'postimgheight',
			'postimgwidth',
			'postimgeffect',
			'postimgalign',
			'arhlayout',
			'archcontentborder',
			'archcolone',
			'archcoltwo',
			'archcolone_border',
			'archcoltwo_border',
			'wpcustomm_enable',
			'wpcustommdesc_enable',	
			'header_html',
			'custom_css',
			'header_favicon',
			'enable_droppanel',
			'droppanel_button_align',
			'enable_search',
			'droppanel',
			'droppanel_columns_num',
			'header_infobar',
			'branding_disable',
			'branding_url',
			'branding_url_sec',			
			'header_customfield',		
			'mainfooter',
			'footer_columns_num',
			'lowerfooter',
			'lowfooterleft',
			'lowfooterright',																						
		);
		
	$options = get_option( 'themeva' );
		
	foreach( $options_array as $option )
	{
		if( get_option( $option ) !='' )
		{
			$value = '';
			$value = get_option( $option );
				
			// Convert Custom CSS to Header CSS
			if( $option == 'custom_css' )
			{
				$option = 'header_css';	
			}
				
			// Convert Skins
			if( $option == 'outskin' )
			{
				$value = convert_skin( $meta, $value );	
				update_option( 'default_skin', $value );
			}
	
			if( $option == 'inskin' )
			{
				$value = convert_skin( $meta, $value );	
				update_option( 'inskin', $value );
			}		
			
			// Cufon Font
			if( $meta == 'cufon_font' && $value !='' )
			{
				$options[ 'nv_font_type' ] = 'enable';
				update_option( 'themeva', $options );	
			}
			
			// Convert Droppanel / Search Options
			if( $option == 'droppanel' )
			{
				if( $value == 'disable' )
				{
					$options[ 'enable_droppanel' ] = 'disable';
					update_option( 'themeva', $options );	
					
					$options[ 'enable_search' ] = 'enable';
					update_option( 'themeva', $options );	
				}
				elseif( $value == 'none' )
				{
					$options[ 'enable_droppanel' ] = 'disable';
					update_option( 'themeva', $options );	
						
					$options[ 'enable_search' ] = 'disable';
					update_option( 'themeva', $options );							
				}
			}				
			else
			{
				$options[ $option ] = $value;
				update_option( 'themeva', $options );				
			}
		}
		
		$options[ 'postmetaalign' ] = 'post_title';
		update_option( 'themeva', $options );
	}
	
	
	// CustomSkin Plus
	$skin_options = array(
		'font_link' => 'skin_id_background_link_color',
		'font_hover' => 'skin_id_background_linkhover_color',
		'skin_header_pri_color' => 'skin_id_layer1_pri_color',
		'skin_header_sec_color' => 'skin_id_layer1_sec_color',
		'skin_headergallery_image' => 'skin_id_layer2_image',
		'skin_headergallery_image_valign' => 'skin_id_layer2_image_valign',
		'skin_headergallery_image_halign' => 'skin_id_layer2_image_halign',
		'skin_headergallery_image_repeat' => 'skin_id_layer2_image_repeat',
		'skin_footer_pri_color' => 'skin_id_layer3_pri_color',
		'skin_footer_sec_color' => 'skin_id_layer3_sec_color',
		'skin_footer_image' => 'skin_id_layer4_image',
		'skin_footer_image_valign' => 'skin_id_layer4_image_valign',
		'skin_footer_image_halign' => 'skin_id_layer4_image_halign',
		'skin_footer_image_repeat' => 'skin_id_layer4_image_repeat',
		'skin_footer_link_color' => 'skin_id_footer_link_color',
		'skin_footer_linkhover_color' => 'skin_id_footer_linkhover_color',
		'skin_footer_text_color' => 'skin_id_footer_font_color',
		'skin_footer_back_color' => 'skin_id_footer_form_color',
		'skin_footer_border_tl_color' => 'skin_id_footer_form_border_color_tl',
		'skin_footer_border_br_color' => 'skin_id_footer_form_border_color_br',
		'skin_menu_link_color' => 'skin_id_header_link_color',
		'skin_menu_linkhover_color' => 'skin_id_header_linkhover_color',
		'skin_menu_text_color' => 'skin_id_header_font_color',
		'skin_menu_back_color' => 'skin_id_menu_panel_color',
	);	
	
	$options = get_option( 'skin_data_CustomPlus' );
	
	foreach ( $skin_options as $skin_option => $new_option )
	{
		$value = '';
		$value = get_option( $skin_option );
		
		if( $skin_option == 'skin_header_pri_color' )
		{
			$options[ $new_option ] = $value;
			$options[ 'skin_id_layer1_type' ] = 'layer1_color';
			$options[ 'skin_id_layer1_pri_opac' ] = 100;
			$options[ 'skin_id_layer1_sec_opac' ] = 100;			
			update_option( 'skin_data_CustomPlus', $options );
		}
		elseif( $skin_option == 'skin_headergallery_image' )
		{
			$options[ $new_option ] = $value;
			$options[ 'skin_id_layer2_type' ] = 'layer2_image';
			$options[ 'skin_id_layer2_image_opac' ] = 100;
			update_option( 'skin_data_CustomPlus', $options );
		}
		elseif( $skin_option == 'skin_footer_pri_color' )
		{
			$options[ $new_option ] = $value;
			$options[ 'skin_id_layer3_type' ] = 'layer3_color';
			$options[ 'skin_id_layer3_pri_opac' ] = 100;
			$options[ 'skin_id_layer3_sec_opac' ] = 100;
			update_option( 'skin_data_CustomPlus', $options );
		}	
		elseif( $skin_option == 'skin_footer_image' )
		{
			$options[ $new_option ] = $value;
			$options[ 'skin_id_layer4_type' ] = 'layer4_image';
			$options[ 'skin_id_layer4_image_opac' ] = 100;
			update_option( 'skin_data_CustomPlus', $options );
		}
		elseif( $skin_option == 'font_link' )
		{
			if( $value != '' )
			{
				$options[ $new_option ] = $value;
			}
			else
			{
				$options[ $new_option ] = '1594d9';
			}
			
			update_option( 'skin_data_CustomPlus', $options );
		}
		elseif( $skin_option == 'font_hover' )
		{
			if( $value != '' )
			{
				$options[ $new_option ] = $value;
			}
			else
			{
				$options[ $new_option ] = '3bb8ff';
			}
			
			update_option( 'skin_data_CustomPlus', $options );
		}
		elseif( $skin_option == 'font_link' )
		{
			if( $value != '' )
			{
				$options[ $new_option ] = $value;
			}
			else
			{
				$options[ $new_option ] = '1594d9';
			}
			
			update_option( 'skin_data_CustomPlus', $options );
		}						
		else
		{
			$options[ $new_option ] = $value;
			update_option( 'skin_data_CustomPlus', $options );
		}
	}
	
	// Get existing Skin ID's
	$skin_data_ids  = maybe_unserialize(get_option('skins_dynamix_ids'));
	
	if ( !preg_match("/\bCustomPlus\b/", $skin_data_ids) )
	{
		update_option( 'skins_dynamix_ids', $skin_data_ids.'CustomPlus,');						
	}
	

	// Gallery Slide Set
	$slideset_data_ids = '';
	$slideset_data_ids = substr(maybe_unserialize(get_option('slideset_data_ids')), 0, -1);  // trim last comma
	$slideset_data_ids = explode(",", $slideset_data_ids);
	
		
	foreach( $slideset_data_ids as $slide_set_id )
	{
		if( $slide_set_id != '' )
		{
			$post = array(
			  'post_title'  => $slide_set_id,
			  'post_name'   => $slide_set_id,
			  'post_type'   => 'slide-sets',
			  'post_status' => 'publish' 
			); 
			
			$slide_set_xml = $id = '';	
				
			$get_slideset_data = get_option("slideset_data_". $slide_set_id );
				
			$num = $get_slideset_data['slideset_id_slide_count'] -1;
				
			$slide_set_xml = "<slide-set>";
					
			for( $i=0; $i<=$num; $i++ )
			{
				$slide_set_xml = $slide_set_xml. "<slide>";				
	
				$image_url = ( !empty( $get_slideset_data['slideset_id_url_'.$i] ) ) ? stripslashes( $get_slideset_data['slideset_id_url_'.$i] ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('image_url',$image_url);
						
				$link_url = ( !empty( $get_slideset_data['slideset_id_link_'.$i] ) ) ? stripslashes( $get_slideset_data['slideset_id_link_'.$i] ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('link_url',$link_url);
						
				$title = ( !empty( $get_slideset_data['slideset_id_title_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_title_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('title',$title);
	
				$description = ( !empty( $get_slideset_data['slideset_id_desc_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_desc_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('description',$description);
	
				$media_url = ( !empty( $get_slideset_data['slideset_id_videourl_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_videourl_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('media_url',$media_url);	
	
				$embed_type = ( !empty( $get_slideset_data['slideset_id_embed_'.$i] ) ) ? stripslashes( htmlspecialchars( strtolower($get_slideset_data['slideset_id_embed_'.$i]) ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('embed_type',$embed_type);	
	
				$timeout = ( !empty( $get_slideset_data['slideset_id_timeout_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_timeout_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('timeout',$timeout);
	
					
				$autoplay = ( !empty( $get_slideset_data['slideset_id_autoplay_'.$i] ) ) ?  'on' : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('autoplay',$autoplay);
	
	
				$stage_content = ( !empty( $get_slideset_data['slideset_id_stagecontent_'.$i] ) ) ? $get_slideset_data['slideset_id_stagecontent_'.$i] : '';
					
				if( $stage_content == "Image Only" )
				{ 
					$stage_content="image"; 
				}
				elseif( $stage_content == "Image (Text Left Overlay)" )
				{ 
					$stage_content="textimageleft"; 
				}
				elseif( $stage_content == "Image (Text Right Overlay)" )
				{ 
					$stage_content="textimageright"; 
				}
				elseif( $stage_content == "Image (Title Overlay Hover)" )
				{ 
					$stage_content="titleoverlay"; 
				}
				elseif( $stage_content == "Image (Title/Text Overlay Hover)" )
				{ 
					$stage_content="titletextoverlay"; 
				}
				elseif( $stage_content == "Image (Text Overlay)" )
				{ 
					$stage_content="textoverlay"; 
				}
				elseif( $stage_content == "Text Only" )
				{ 
					$stage_content="textonly"; 
				}
					
				$slide_set_xml = $slide_set_xml. create_xml_tag('stage_content',$stage_content);	
	
				$title_overlay = ( !empty( $get_slideset_data['slideset_id_overlay_'.$i] ) ) ? stripslashes( htmlspecialchars( strtolower($get_slideset_data['slideset_id_overlay_'.$i]) ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('title_overlay',$title_overlay);
		
				$gallery3d_pieces = ( !empty( $get_slideset_data['slideset_id_segments_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_segments_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('gallery3d_pieces',$gallery3d_pieces);
	
				$gallery3d_depthoffset = ( !empty( $get_slideset_data['slideset_id_depthoffset_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_depthoffset_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('gallery3d_depthoffset',$gallery3d_depthoffset);
	
				$gallery3d_cubedist = ( !empty( $get_slideset_data['slideset_id_cubedistance_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_cubedistance_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('gallery3d_cubedist',$gallery3d_cubedist);
	
				$gallery3d_tween = ( !empty( $get_slideset_data['slideset_id_transition_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_transition_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('gallery3d_tween',$gallery3d_tween);	
	
				$gallery3d_transtime = ( !empty( $get_slideset_data['slideset_id_transtime_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_transtime_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('gallery3d_transtime',$gallery3d_transtime);
	
				$gallery3d_seconds = ( !empty( $get_slideset_data['slideset_id_transdelay_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_transdelay_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('gallery3d_seconds',$gallery3d_seconds);
	
				$css_classes = ( !empty( $get_slideset_data['slideset_id_cssclasses_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_cssclasses_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('css_classes',$css_classes);
	
				$filter_tags = ( !empty( $get_slideset_data['slideset_id_catselect_'.$i] ) ) ? stripslashes( htmlspecialchars( $get_slideset_data['slideset_id_catselect_'.$i] ) ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('filter_tags',$filter_tags);
						
				$readmore_link = ( !empty( $get_slideset_data['slideset_id_disreadmore_'.$i] ) ) ? stripslashes( $get_slideset_data['slideset_id_disreadmore_'.$i] ) : '';
				$slide_set_xml = $slide_set_xml. create_xml_tag('readmore_link',$readmore_link);																														
					
				$slide_set_xml = $slide_set_xml . "</slide>";
			}
					
			$new = $slide_set_xml . "</slide-set>";
				
			$old = get_post_meta( $id, 'slide_manager_xml' );
				
			if( $id = wp_insert_post($post) )
			{
				if ( $new && $new != $old )
				{
					update_post_meta( $id, 'slide_manager_xml', $new );
				}			
			}
		}

	}		

		
	// META OPTIONS
	$meta_array = array(
			'layout',
			'pagelayout',
			'textresize',
			'pagetitle',
			'pagesubtitle',
			'posttitle',
			'postsubtitle',			
			'postdate',
			'authorname',
			'author_bio',
			'hidebreadcrumbs',
			'contentborder',
			'disableheader',
			'hidecontent',
			'disablefooter',
			'border_config_one',
			'border_config_two',
			'sidebar_one',
			'sidebar_two',
			'border_config_one',
			'border_config_two',
			'infobar_classes',
			'infobartext',
			'socialicons',
			'disableheart',
			'twitter',
			'socialdeli',
			'socialdigg',
			'socialtwitter',
			'socialgoogle',
			'socialfb',
			'socialrss',
			'socialreddit',
			'sociallinkedin',		
			'socialstumble',
			'socialyoutube',
			'socialvimeo',
			'socialpinterest',
			'socialemail',
			'socialinstagram',
			'socialsoundcloud',
			'gallery',
			'datasource_selector',
			'attachedmedia',
			'flickrset',
			'gallerycat',
			'gallerypostformat',
			'productcat',
			'producttag',
			'gallerymediacat',
			'slideset',
			'archivecat',
			'imgheight',		
			'imgwidth',
			'galleryheight',
			'gallerynumposts',
			'gallerynpostexcerpt',
			'gallerysortby',
			'galleryorderby',		
			'stagetimeout',
			'stagetransition',
			'stagetween',
			'stageplaypause',
			'groupsliderpos',
			'gridcolumns',		
			'gridshowposts',
			'gridfilter',
			'groupgridcontent',
			'accordiontitles',
			'accordionautoplay',
			'nivoeffect',		
			'imageeffect',
			'lightbox',
			'sliderlayout',
			'sliderimagealign',
			'gridcolumns',
			'gallerycssclass',		
			'customskin',
			'outskin',
			'inskin',
			'menu_alignment',
			'branding_alignment',
			'previewimgurl',
			'movieurl',
			'videotype',
			'videoratio',
			'videoautoplay',
			'slidetimeout',
			'postshowimage',
			'cssclasses',
			'galexturl',
			'disablegallink',
			'disablereadmore',
			'stagegallery',
			'displaytitle',
			'gallery3dsegments',
			'gallery3dtween',
			'gallery3dtweentime',
			'gallery3dtweendelay',
			'gallery3dzdistance',
			'gallery3dexpand',																																						
	);		
		
	$args = array(
		'posts_per_page'  => -1,
		'post_type' => array( 'post','page' )
	); 	
	
	$update_posts = get_posts( $args );
		
	foreach( $update_posts as $post )
	{
		$option = maybe_unserialize( get_post_meta( $post->ID, 'pgopts', true ) );

		foreach($meta_array as $meta)
		{
			if( !empty( $option[ $meta ] ) )
			{	
				$value = $option[ $meta ];
				
				if( is_array( $value ) ) $value = implode(",", $value );
								
				if( $meta == 'attachedmedia' )  	$meta = 'data-1';
				
				if( $meta == 'gallerycat' )
				{
					$meta = 'data-2';				
					update_post_meta( $post->ID , '_cmb_'. 'datasource_selector', $meta );	
				}
				
				if( $meta == 'gallerypostformat' ) 	$meta = 'data-2-formats';
				if( $meta == 'flickrset' )			$meta = 'data-3';
				
				if( $meta == 'slideset' ) {
					$meta = 'data-4';
					update_post_meta( $post->ID , '_cmb_'. 'datasource_selector', $meta );	
				}
				
				if( $meta == 'productcat' )  		$meta = 'data-5';
				if( $meta == 'producttag' )  		$meta = 'data-5-tags';
				if( $meta == 'gallerymediacat' )	$meta = 'data-6';
				if( $meta == 'posttitle' )			$meta = 'pagetitle';
				if( $meta == 'postsubtitle' )		$meta = 'pagesubtitle';
				
				if( $meta == 'outskin' )
				{
					$value = convert_skin( $meta, $value );	
					$meta = 'customskin';
				}

				if( $meta == 'inskin' )
				{
					$value = convert_skin( $meta, $value );	
					$meta = 'innerskin';
				}				
								
				update_post_meta( $post->ID , '_cmb_'. $meta, $value );
				//delete_post_meta( $post->ID, '_cmb_'. $meta,'' );
			}
		}
		
	}
		
	update_option( 'themeva_update', 'updated' );