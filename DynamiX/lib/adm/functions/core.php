<?php

	/* ------------------------------------
	
	::	Core Functions
	
	------------------------------------ */	

	/*
	 * for 'textarea' sanitization and $allowedposttags + embed and script.
	 */
	 
	add_action('admin_init','optionscheck_change_santiziation', 100);
	
	function optionscheck_change_santiziation()
	{
		remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
		add_filter( 'of_sanitize_textarea', 'custom_sanitize_textarea' );
	}
	
	function custom_sanitize_textarea($input)
	{
		global $allowedposttags;
		$custom_allowedtags["embed"] = array(
		  "src" => array(),
		  "type" => array(),
		  "allowfullscreen" => array(),
		  "allowscriptaccess" => array(),
		  "height" => array(),
			  "width" => array()
		  );
		  $custom_allowedtags["script"] = array();
		  $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);

		if ( current_user_can( 'unfiltered_html' ) ) {
			$output = $input;
		}
		else {
			$output = wp_kses( $input, $custom_allowedtags);
		}

		return $output;
	}

	// Find the XML value from XML Object
	function find_xml_value($xml, $field)
	{
		if(!empty($xml))
		{
			foreach($xml->childNodes as $xmlChild)
			{
				if($xmlChild->nodeName == $field)
				{
					if( is_admin() )
					{
						return $xmlChild->nodeValue;
					}
					else
					{
						return $xmlChild->nodeValue;
					}
				}
			}
		}
		
		return '';
	}
	
	// Find the XML node from XML Object
	function find_xml_node($xml, $node)
	{
		if(!empty($xml))
		{
			foreach($xml->childNodes as $xmlChild)
			{
				if($xmlChild->nodeName == $node)
				{
					return $xmlChild;	
				}
			}
		}
		
		return '';
	}
	
	// Create tag string from nodename and value
	function create_xml_tag($node, $value)
	{
		return '<' . $node . '>' . $value . '</' . $node . '>';	
	}


	// Populate Data Source List
	function data_source_list()
	{
		$data_source_array = array(
			array( 'name' => 'Select Source', 'value' => '', ),
			array( 'name' => 'Slide Manager Sets', 'value' => 'data-4' ),
			array( 'name' => 'Attached Media', 'value' => 'data-1' ),
			array( 'name' => 'Portfolio Categories', 'value' => 'data-6' ),
			array( 'name' => 'Post Categories', 'value' => 'data-2' ),
			array( 'name' => 'Page / Post ID', 'value' => 'data-8' ),
		);
		
		if( class_exists('Woocommerce') || class_exists('WPSC_Query') )
		{
			$data_source_array[] = array( 'name' => 'Product Categories', 'value' => 'data-5' );
		}
		
		if( of_get_option('flickr_userid') )
		{
			$data_source_array[] = array( 'name' => 'Flickr', 'value' => 'data-3' );			
		}
		
		return $data_source_array;
	}


	// Get Post Category Function
	function get_data_source($data_type, $type = '')
	{
		$arr = array();
		
		if( $data_type == 'data-2' ) // Post Categories
		{
			$arr = get_categories();
		}
		elseif( $data_type == 'data-2-formats' ) // Post Formats
		{
			$post_formats = get_theme_support( 'post-formats' );
			$arr = $post_formats[0];
			array_unshift($arr, "Select Filter");
		}
		elseif( $data_type == 'data-3' ) // Flickr
		{
			if( is_admin() )
			{
				global $ph_sets;
				
				if( !empty( $ph_sets ) )
				{
					$arr = $ph_sets['photoset'];
				}
				else
				{
					if( of_get_option('flickr_userid') !='' )
					{
						require_once(NV_FILES."/adm/inc/phpFlickr/phpFlickr.php");
						$f = new phpFlickr('7caca0370ede756c26832c28b266ead5');
						$user = of_get_option('flickr_userid');
						$ph_sets = $f->photosets_getList($user);	
						
						$arr = $ph_sets['photoset'];
					}					
				}
				
				if( $arr !='' && $type == 'shortcode' )
				{
					array_unshift($arr, "Select Flickr Set");
				}
			}
		}
		elseif( $data_type == 'data-4' ) // Slide Sets
		{
			$args = array(
				'numberposts' => -1,
				'post_type' => 'slide-sets',
				'post_status' => 'publish'
			);
			
			$arr = get_posts ( $args );
		}		
		elseif( $data_type == 'data-5' ) // Woocommerce / WP e-commerce
		{
			if( class_exists('Woocommerce') )
			{
				$arr = get_terms('product_cat', 'orderby=name&hide_empty=0');
			}
			else
			{ 
				$arr = get_terms('wpsc_product_category', 'orderby=name&hide_empty=0');  
			}
			
			
		}
		elseif( $data_type == 'data-5-tags' ) // Woocommerce / WP e-commerce TAGS
		{
			$arr = get_terms('product_tag', 'orderby=name&hide_empty=1');
		}				
		elseif( $data_type == 'data-6' ) // Gallery Media Categories
		{
			$arr = get_terms('portfolio-category', 'orderby=name&hide_empty=1');
		}
		
		
		
		// Set the options array
		if( is_array( $arr ) )
		{
			foreach ( $arr as $val )
			{
				if( $data_type == 'data-2' )
				{
					if( $type == 'shortcode' )
					{
						$options_array[htmlspecialchars($val->cat_name)] = $val->cat_name;
					}
					else
					{
						$options_array[htmlspecialchars($val->term_id)] = $val->cat_name;
					}
				}				
				elseif( $data_type == 'data-3' )
				{				
					if( $type == 'shortcode' )
					{
						if( $val == 'Select Flickr Set' )
						{
							$options_array[htmlspecialchars($val)] = '';
						}
						else
						{						
							$options_array[$val['title']['_content']] = $val['id'];
						}
					}
					else
					{
						$options_array[$val['id']] = $val['title']['_content'];
					}
				}			
				elseif( $data_type == 'data-4' )
				{
					if( $type == 'shortcode' )
					{				
						$options_array[htmlspecialchars($val->post_title)] = $val->post_title;
					}
					else
					{
						$options_array[htmlspecialchars($val->ID)] = $val->post_title;
					}					
				}
				elseif( $data_type == 'data-2-formats' )
				{
					if( $type == 'shortcode' )
					{	
						if( $val == 'Select Filter' )
						{
							$options_array[htmlspecialchars($val)] = '';
						}
						else
						{
							$options_array[htmlspecialchars($val)] = $val;
						}
					}
					elseif( $type == 'blog' )
					{	
						if( $val != 'Select Filter' )
						{
							$options_array[htmlspecialchars($val)] = $val;
						}
					}					
					else
					{				
						if( $val == 'Select Filter' )
						{
							$options_array[] = array(
								'name' => $val,
								'value' => ''
							);					
						}
						else
						{
							$options_array[] = array(
								'name' => $val,
								'value' => $val
							);
						}
					}
				}						
				else
				{
					$options_array[htmlspecialchars($val->name)] = $val->name;
				}
			}
		}
		
		if( empty($options_array) ) $options_array[''] = 'No Data Found';
		
		return $options_array;
	}


	// Social Icons Data
	function social_icon_data()
	{
		$social_icon_array = array(
			'sociallink_digg' => array(
				'path' => 'http://www.digg.com/submit?phase=2&amp;url=[get_permalink]&amp;title=[get_the_title]',
				'name' => 'Digg'
			),
			'sociallink_fb' => array(
				'path' => 'http://www.facebook.com/sharer.php?u=[get_permalink]&amp;t=[get_the_title]',
				'name' => 'Facebook'
			),	
			'sociallink_linkedin' => array(
				'path' => 'http://www.linkedin.com/shareArticle?mini=true&url=[get_permalink]&title=[get_the_title]&source=[get_blogurl]',
				'name' => 'LinkedIn'
			),
			'sociallink_deli' => array(
				'path' => 'http://del.icio.us/post?url=[get_permalink]&amp;title=[get_the_title]',
				'name' => 'Del.icio.us'
			),
			'sociallink_reddit' => array(
				'path' => 'http://www.reddit.com/submit?url=[get_permalink]',
				'name' => 'Reddit'
			),
			'sociallink_stumble' => array(
				'path' => 'http://www.stumbleupon.com/submit?url=[get_permalink]&amp;title=[get_the_title]',
				'name' => 'Stumble'
			),
			'sociallink_twitter' => array(
				'path' => 'http://twitter.com/share?text=[get_the_title]&amp;url=[get_permalink]',
				'name' => 'Twitter'
			),
			'sociallink_google' => array(
				'path' => 'https://m.google.com/app/plus/x/?v=compose&content=[get_the_title] - [get_permalink]',
				'name' => 'Google'
			),
			'sociallink_rss' => array(
				'path' => '[get_permalink]feed/rss/',
				'name' => 'RSS'
			),
			'sociallink_youtube' => array(
				'path' => 'http://www.youtube.com/user/',
				'name' => 'YouTube'
			),
			'sociallink_vimeo' => array(
				'path' => 'http://vimeo.com/',
				'name' => 'Vimeo'
			),
			'sociallink_pinterest' => array(
				'path' => 'http://pinterest.com/',
				'name' => 'Pinterest'
			),
			'sociallink_soundcloud' => array(
				'path' => 'http://soundcloud.com',
				'name' => 'Soundcloud'
			),
			'sociallink_instagram' => array(
				'path' => 'http://instagram.com',
				'name' => 'Instagram'
			),
			'sociallink_flickr' => array(
				'path' => 'http://flickr.com',
				'name' => 'Flickr'
			),
			'sociallink_email' => array(
				'path' => 'mailto:example@email.com',
				'name' => 'Email'
			),												
		);
		
		if( get_option('themeva_theme') == 'ePix' || get_option('themeva_theme') == 'Copa' ) 
		{
			unset(
				$social_icon_array['sociallink_stumble'],
				$social_icon_array['sociallink_reddit'],
				$social_icon_array['sociallink_deli'],
				$social_icon_array['sociallink_digg']
			);
		}
		
		return $social_icon_array;
	}


	// Get WP Media Library 
	add_action('wp_ajax_get_media_image','get_media_library');
	
	function get_media_library(){
	
		$image_width = 70;
		$image_height = 70;
		
		$paged = (isset($_POST['page']))? $_POST['page'] : 1; 	
		
		if($paged == '')
		{
			$paged = 1;
		}
		
		$statement = array('post_type' => 'attachment',
			'post_mime_type' =>'image, video/mp4, application/flash',
			'post_status' => 'inherit', 
			'posts_per_page' => 31,
			'paged' => $paged);
		
		$media_query = new WP_Query($statement);
		
		echo '<div class="media-gallery-nav" id="media-gallery-nav">';
		echo '<ul>';
		echo '<a><li class="nav-first" rel="1" ></li></a>';
		
		for( $i=1 ; $i<=$media_query->max_num_pages; $i++){
		
			if($i == $paged)
			{
				echo '<li rel="' . $i . '">' . $i . '</li>';
			}
			else if( ($i <= $paged+2 && $i >= $paged-2) || $i%10 == 0)
			{
				echo '<a><li rel="' . $i . '">' . $i . '</li></a>';		
			}
			
		}
		echo '<a><li class="nav-last" rel="' . $media_query->max_num_pages . '"></li></a>';
		echo '</ul>';
		echo '</div><br class=clear>';
	
		echo '<ul>';
		
		foreach( $media_query->posts as $image )
		{ 
		
			$thumb_src = wp_get_attachment_image_src( $image->ID, '150x150');
			$thumb_src_preview = wp_get_attachment_image_src( $image->ID, '100x69');

			// assign default image if path is empty
			if( empty($thumb_src[0]) ) 
			{
				$thumbnail = get_template_directory_uri() . '/lib/adm/images/layout-1.png';
			}
			else 
			{
				$thumbnail = $thumb_src[0];
			}
							
			echo '<li><img src="' . $thumbnail .'" title="' . $image->post_title . '" attid="' . $image->ID . '" rel="' . $thumb_src_preview[0] . '"/></li>';			
		
		}
		
		echo '</ul><br class=clear>';
		
		if(isset($_POST['page'])){ die(''); }
			
					
	}

	// Social Meta Options
	function get_social_options()
	{
		$prefix = '_cmb_';
		
		$social_icon_array = social_icon_data();

		$social_icon_options = array();
		
		$social_icon_options[] =	array(
				'name'     => __( 'Twitter Feed', 'themeva_admin' ),
				'desc'     => __( 'Add an animated Twitter feed to your page or post.', 'themeva_admin' ),
				'id'       => $prefix . 'twitterfeed_title',
				'type'     => 'title',
		);
				
		$social_icon_options[] = array(
			'name'    => 'Twitter Cycle',
			'id'      => $prefix . 'twitter',
			'type'    => 'radio_inline',
			'std'		  => 'none',
			'options' => array(
				array( 'name' => 'Default', 'value' => 'none', ),
				array( 'name' => 'Disable', 'value' => 'disable', ),
				array( 'name' => 'Top', 'value' => 'pagetop', ),
				array( 'name' => 'Bottom', 'value' => 'pagebot', ),
			),
		);

		$social_icon_options[] =	array(
				'name'     => __( 'Social Icons', 'themeva_admin' ),
				'desc'     => __( 'Add social icons to your page or post.', 'themeva_admin' ),
				'id'       => $prefix . 'general_title',
				'type'     => 'title',
		);			

		$social_icon_options[] = array(
			'name'    => 'Icon Color',
			'id'      => $prefix . 'socialicons_color',
			'type'    => 'select',
			'std'		  => '',
			'options' => array(
				array( 'name' => 'Default', 'value' => '', ),
				array( 'name' => 'Light', 'value' => 'light', ),
				array( 'name' => 'Dark', 'value' => 'dark', ),
				array( 'name' => 'Color', 'value' => 'color', ),
			),
		);			

		$social_icon_options[] = array(
			'name'    => 'Social Icons',
			'id'      => $prefix . 'socialicons',
			'type'    => 'radio_inline',
			'std'		  => '',
			'options' => array(
				array( 'name' => 'Default', 'value' => '', ),
				array( 'name' => 'Enable', 'value' => 'yes', ),
				array( 'name' => 'Disable', 'value' => 'disable', ),
			),
		);
		
		/*
		$social_icon_options[] = array(
			'name'    => 'Social Icons',
			'id'      => $prefix . 'socialicons',
			'type'    => 'switch',
			'std'		  => '',
			'options' => array(
				array( 'name' => 'Off', 'value' => '', ),
				array( 'name' => 'On', 'value' => 'yes', ),
			),
		);
		*/
			
		$social_icon_options[] = array(
			'name'    => 'Share Icon',
			'id'      => $prefix . 'disableheart',
			'type'    => 'radio_inline',
			'std'		  => '',
			'options' => array(
				array( 'name' => 'Default', 'value' => '', ),
				array( 'name' => 'Enable', 'value' => 'enable', ),
				array( 'name' => 'Disable', 'value' => 'yes', ),
			),
		);

		
		foreach ( $social_icon_array as $key => $socialicon )
		{
			$social_icon_options[] = array(
				'name'    => $socialicon['name'],
				'id'      => $prefix . $key,
				'type'    => 'radio_inline',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Off', 'value' => 'yes', ),
					array( 'name' => 'On', 'value' => '', ),
				),
			);
		}
		
		return $social_icon_options;
		
	}	
	
	function hexLighter($hex,$factor = 80) { 
		$new_hex = ''; 
		 
		$base['R'] = hexdec($hex{0}.$hex{1}); 
		$base['G'] = hexdec($hex{2}.$hex{3}); 
		$base['B'] = hexdec($hex{4}.$hex{5}); 
		 
		foreach ($base as $k => $v) 
			{ 
			$amount = 255 - $v; 
			$amount = $amount / 100; 
			$amount = round($amount * $factor); 
			$new_decimal = $v + $amount; 
		 
			$new_hex_component = dechex($new_decimal); 
			if(strlen($new_hex_component) < 2) 
				{ $new_hex_component = "0".$new_hex_component; } 
			$new_hex .= $new_hex_component; 
			} 
			 
		return $new_hex;     
	} 
	
	function hexDarker($hex,$factor = 30){
        $new_hex = '';
        
        $base['R'] = hexdec($hex{0}.$hex{1});
        $base['G'] = hexdec($hex{2}.$hex{3});
        $base['B'] = hexdec($hex{4}.$hex{5});
        
        foreach ($base as $k => $v)
                {
                $amount = $v / 100;
                $amount = round($amount * $factor);
                $new_decimal = $v - $amount;
        
                $new_hex_component = dechex($new_decimal);
                if(strlen($new_hex_component) < 2)
                        { $new_hex_component = "0".$new_hex_component; }
                $new_hex .= $new_hex_component;
                }
                
        return $new_hex;        
    }

	/* ------------------------------------
	:: POST FIRST IMAGE DETECTION
	------------------------------------ */
	
	function catch_image()
	{ 
		if( of_get_option('firstimage_detect') == 'enable' )
		{
			global $post, $posts;
			$first_img = $short_img = $shrtmatches = $matches = '';
			ob_start();
			ob_end_clean();
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
			$shrtoutput = preg_match_all('/imageeffect.+url=[\'"]([^\'"]+)[\'"].*/i', $post->post_content, $shrtmatches); // Check shortcode image
			
			$short_img = ( !empty( $shrtmatches [1] [0] ) ) ? $shrtmatches [1] [0] : '';
			$first_img = ( !empty( $matches [1] [0] ) ) ? $matches [1] [0] : '';
		
			if( $short_img )
			{
				return $short_img;
			} 
			else
			{
				return $first_img;  
			}
		}
		else
		{
			return;	
		}
	}	

	/* ------------------------------------
	:: GET ATTACHMENT DATA
	------------------------------------ */	
	
	function themeva_attachment_data( $attachment_id ) {
	
		$attachment = get_post( $attachment_id );
		return array(
			'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption' => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href' => get_permalink( $attachment->ID ),
			'src' => $attachment->guid,
			'title' => $attachment->post_title
		);
	}	

	/* ------------------------------------
	:: POST FORMAT GALLERY
	------------------------------------ */		

	function switch_gallery( $content )
	{
		//search for the first av gallery or gallery shortcode
		preg_match("!\[(?:postgallery)?gallery.+?\]!", $content, $match_gallery);
					
		if(!empty($match_gallery))
		{
			$gallery = $match_gallery[0];
	
			if(strpos($gallery, 'postgallery') === false)
			{
				$gallery = str_replace("gallery", 'postgallery_image id="stage_'. get_the_id() .'" timeout="10" navigation="enabled" data_source="data-9" ', $gallery);
				$gallery = str_replace("ids", 'images_attach', $gallery);
			}
		
			$content = str_replace($match_gallery[0], $gallery , $content);
		}
		
		return $content;
	}

	/* ------------------------------------
	:: AJAX DATA
	------------------------------------ */	

	function tva_ajaxdata()
	{
	   if( isset( $_POST ) )
	   
	   $data_contents = $data_source = $type = '';

		$type 			= ( isset( $_POST['type'] ) ?  $_POST['type'] : '' );
		$data_source 	= ( isset( $_POST['source'] ) ?  $_POST['source'] : '' );
		$query 			= ( isset( $_POST['query'] ) ?  $_POST['query'] : '' );
		$data_offset 	= ( isset( $_POST['data_offset'] ) ?  $_POST['data_offset'] : '' );
		$load_value 	= ( isset( $_POST['load_value'] ) ?  $_POST['load_value'] : '' );
		$postlayout 	= ( isset( $_POST['postlayout'] ) ?  $_POST['postlayout'] : '' );
		$grid_columns 	= ( isset( $_POST['grid_columns'] ) ?  $_POST['grid_columns'] : '' );
		$config 		= ( isset( $_POST['attributes'] ) ?  $_POST['attributes'] : '' );
		$attributes 	= ( !empty( $config ) ? explode('|', $config) : array() );

		foreach( $attributes as $attribute )
		{
			list($key, $value) = explode(":", $attribute);
			$config_attributes[$key] = $value;
		}

		// Configuration Options
		$NV_gridcolumns 		= $grid_columns;
		$NV_slidercolumns 		= $load_value;
		$NV_groupgridcontent 	= ( !empty( $config_attributes['content'] ) ? $config_attributes['content'] : '' );	
		$NV_imgwidth 			= ( !empty( $config_attributes['img_width'] ) ? $config_attributes['img_width'] : '' );	
		$NV_imgheight			= ( !empty( $config_attributes['img_height'] ) ? $config_attributes['img_height'] : '' );				
		$NV_lightbox 			= ( !empty( $config_attributes['lightbox'] ) ? $config_attributes['lightbox'] : '' );	
		$NV_imageeffect 		= ( !empty( $config_attributes['imageeffect'] ) ? $config_attributes['imageeffect'] : '' );		
		$NV_customlayer 		= ( !empty( $config_attributes['customlayer'] ) ? $config_attributes['customlayer'] : '' );			
		$NV_zoomhover			= ( !empty( $config_attributes['zoomhover'] ) ? $config_attributes['zoomhover'] : '' );	
		$NV_gridcolumns_text	= ( !empty( $NV_gridcolumns ) ? $NV_slidercolumns_text = numberToWords( $NV_gridcolumns ) : '' );	
		$columnpadding 		= ( !empty( $config_attributes['columnpadding'] ) ? $config_attributes['columnpadding'] : '' );	
		$NV_shortcode_id		= ( !empty(  $config_attributes['shortcodeid'] ) ? $config_attributes['shortcodeid'] : '' );	
		$NV_blackwhite			= '';
		
		if( $NV_imageeffect == 'shadowblackwhite' || $NV_imageeffect == 'frameblackwhite' || $NV_imageeffect == 'blackwhite' )
		{
			$NV_blackwhite = 'blackwhite';
			
			if( $NV_imageeffect == 'shadowblackwhite' ) $NV_imageeffect = 'shadow';
			if( $NV_imageeffect == 'frameblackwhite' ) $NV_imageeffect = 'frame';
			if( $NV_imageeffect == 'blackwhite' ) $NV_imageeffect = 'none';
		}		

		if( $data_source == 'data-4' )
		{
			if( !is_array( $query ) )
			{
				$slide_sets = rtrim( $query , ',' );
				$slide_sets = explode(",", $query );
			}
			else
			{
				$slide_sets = implode( ",", $query ); // needed to upgrades of older versions
				$slide_sets = explode( ",", $query );
			}			
			
			$sorted_slidesets = array();
			
			foreach ( $slide_sets as $slide_set )
			{
				if( is_numeric( $slide_set ) )
				{ 		
					$slide_id = $slide_set;
					$slide_name = get_the_title( $slide_set );		
					$sorted_slidesets[$slide_name] = $slide_id;
				}
				else
				{
					$name = get_page_by_title( $slide_set, 'OBJECT', "slide-sets" );
					$slide_id = $name->ID;
					$slide_name = $slide_set;		
					$sorted_slidesets[$slide_name] = $slide_id;					
				}
			}

			
			ksort( $sorted_slidesets );
			$slide_sets 		= $sorted_slidesets;
			$slide_set_array 	= array();
			$postcount 		= 0;
			$slidecount		= 0;
			$data_id			= $data_offset;

			foreach( $slide_sets as $slide_set )
			{
				$slide_xml = get_post_meta( $slide_set, 'slide_manager_xml', true );
				$slide_data = new DOMDocument();
				$slide_data->loadXML( $slide_xml );
				$slide_set = $slide_data->documentElement;
	
				foreach( $slide_set->childNodes as $slide )
				{						
					// Get Attached / Post Image Data
					$get_image_src = wp_get_attachment_image_src( find_xml_value( $slide, 'image' ), 'full');
			
					// Get Image Meta Data Attachment ID
					$attachment_meta = themeva_attachment_data( find_xml_value( $slide, 'image' ) );
					
					$slide_set_array[$slidecount]['img']				= $get_image_src;
					$slide_set_array[$slidecount]['img_url'] 		= $get_image_src[0];
					$slide_set_array[$slidecount]['media_url'] 		= find_xml_value( $slide, 'media_url' );
					$slide_set_array[$slidecount]['embed_type'] 	= find_xml_value( $slide, 'embed_type' );
					$slide_set_array[$slidecount]['autoplay'] 		= find_xml_value( $slide, 'autoplay' );
					$slide_set_array[$slidecount]['title'] 			= ( find_xml_value( $slide, 'title' ) !='' ) ? find_xml_value( $slide, 'title' ) : $attachment_meta['title'];
					$slide_set_array[$slidecount]['description']	= ( find_xml_value( $slide, 'description' ) !='' ) ? find_xml_value( $slide, 'description' ) : $attachment_meta['description'];
					$slide_set_array[$slidecount]['link_url']		= find_xml_value( $slide, 'link_url' );
					$slide_set_array[$slidecount]['css_classes']	= find_xml_value( $slide, 'css_classes' );
					$slide_set_array[$slidecount]['readmore_link']	= find_xml_value( $slide, 'readmore_link' );
					$slide_set_array[$slidecount]['timeout'] 		= find_xml_value( $slide, 'timeout' );
					$slide_set_array[$slidecount]['filter_tags'] 	= find_xml_value( $slide, 'filter_tags' ); 
					
					$slidecount++;
				}
			}

			$slide_set_array = array_slice( $slide_set_array, $data_offset, $load_value );			

			foreach( $slide_set_array as $slide_set )
			{
				$NV_disablegallink=
				$NV_movieurl=
				$NV_previewimgurl=
				$NV_cssclasses=
				$NV_galexturl=
				$NV_videotype=
				$NV_videoautoplay=
				$NV_posttitle=
				$NV_description=
				$NV_slidetimeout=
				$img = '';
				
				$img 					= $slide_set['img'];
				$NV_previewimgurl		= $slide_set['img_url'];
				$NV_movieurl 			= $slide_set['media_url'];
				$NV_videotype 			= $slide_set['embed_type'];
				$NV_videoautoplay 		= $slide_set['autoplay'];		
				$NV_posttitle 			= $slide_set['title'];
				$NV_description 		= $slide_set['description'];
				$NV_galexturl 			= $slide_set['link_url'];
				$NV_cssclasses 		= $slide_set['css_classes'];
				$NV_disablereadmore 	= $slide_set['readmore_link'];
				$NV_slidetimeout 		= $slide_set['timeout'];
				$tags_array		 	= $slide_set['filter_tags']; 
		
				$NV_disablegallink	= ( empty( $NV_galexturl ) ? 'yes' : '');
				$NV_disablereadmore	= ( $NV_disablereadmore == 'off' ? 'yes' : '' );
				$NV_videoautoplay 		= ( $NV_videoautoplay == 'on' ) ? '1' : '0';

				$categories = '';
				
				// Enter Categories into an Array
				if( !empty( $tags_array ) )
				{
					$tags_array = str_replace(" ", "", $tags_array );
						
					$tags_array = explode(',', $tags_array);
						
					foreach($tags_array as $tag)
					{
						$categories .= $tag . $NV_shortcode_id.',';
					}
						
					$replace_arr = array(' ',',');
					$replace_with= array('_',' '); 
						
					$categories = str_replace( $replace_arr, $replace_with, $categories );
				}				
		
				// Assign unique video ID
				$video_id = $postcount + $data_id;			
					
				$postcount++;
				$data_id++;

				$output 			= '';
				$NV_show_slider	= $type;

				// Check is Timthumb is Enabled or Disabled
				if( of_get_option('timthumb_disable') !='disable' && empty( $NV_customlayer ) )
				{  
					require_once NV_FILES . '/adm/functions/BFI_Thumb.php';
						
					if( !empty( $NV_imgwidth ) )
					{
						$params['width'] = $NV_imgwidth;	
					}
				
					if( !empty( $NV_imgheight ) )
					{	
						$params['height'] = $NV_imgheight;	
					}		
						
					$params['crop'] = true;
						
					if( $NV_imageeffect == 'circular' ) $params['height'] = $params['width'];
						
					$NV_imagepath = bfi_thumb( dyn_getimagepath($NV_previewimgurl) , $params );
				}
				else 
				{
					$NV_imagepath = dyn_getimagepath($NV_previewimgurl);
				}				
				
				require get_slider_frame( $type );
				
				$data_contents .= $output;					
			}
		}	
		 
	   die($data_contents);
	}	
	
	add_action( 'wp_ajax_nopriv_tva_ajaxdata', 'tva_ajaxdata' );
	add_action( 'wp_ajax_tva_ajaxdata', 'tva_ajaxdata' );
	
	add_action( 'admin_bar_menu', 'toolbar_link_to_mypage', 999 );			

	function toolbar_link_to_mypage( $wp_admin_bar )
	{
		$args = array(
			'id'    => 'theme_options',
			'title' => __( 'Theme Options', 'themeva-admin' ),
			'href'  => admin_url() . 'themes.php?page=options-framework',
			'parent' => 'site-name',
			'meta'  => array( 'class' => 'theme-options' )
		);
		$wp_admin_bar->add_node( $args );
	}	