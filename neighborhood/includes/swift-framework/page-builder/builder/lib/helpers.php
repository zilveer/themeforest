<?php
	
	/*
	*
	*	Swift Page Builder - Helpers Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	/* GET POST TYPES
	================================================== */
	if ( ! function_exists( 'spb_get_post_types' ) ) {
		function spb_get_post_types() {
			$args       = array(
			    'public' => true
			);
		    $post_types = get_post_types($args);
		    array_unshift($post_types, "");

		    // Unset specfic results
		    unset($post_types['attachment']);
		    unset($post_types['spb-section']);
		    unset($post_types['swift-slider']);

		    return $post_types;
		}
	}

	/* GET PRODUCTS
	================================================== */
	if ( ! function_exists( 'spb_get_products' ) ) {
		function spb_get_products() {
	
			if ( !is_admin() ) {
				return;
			}
	
		    $attr = array(
		    	'post_type'       => array( 'product', 'product_variation' ),
	            'fields'          => 'ids',
		    	"orderby"		   => "name",
		    	"order"			   => "asc",
		    	'posts_per_page'   => -1
		    );
		    $results = get_posts($attr);
			$products_array = array();
	
			$products_array[] = "";
		    foreach ($results as $id) {
	            $title = get_the_title($id);
		    	$products_array[$id] = $title;
		    }
	
	        wp_cache_flush();
	
		    return $products_array;
		}
	}

    /* GET THEME NAME
    ================================================== */
    if ( ! function_exists( 'spb_get_theme_name' ) ) {
        function spb_get_theme_name() {
            return get_option( 'sf_theme');
        }
    }

	/* GET PRODUCT CATEGORIES
	================================================== */
	if ( ! function_exists( 'spb_get_product_categories' ) ) {
		function spb_get_product_categories() {

			if ( !is_admin() ) {
				return;
			}

		    $categories = get_terms('product_cat');
			$categories_array = array();

			$categories_array[] = "";
			foreach ($categories as $category) {
			      $categories_array[$category->term_id] = $category->name;
			}

		    return $categories_array;
		}
	}

	/* FORMAT CONTENT
	================================================== */
    function spb_format_content( $content ) {
        $content = do_shortcode( shortcode_unautop( $content ) );
        $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );

        return $content;
    }

    if ( ! function_exists( 'shortcode_exists' ) ) {
        /**
         * Check if a shortcode is registered in WordPress.
         * Examples: shortcode_exists( 'caption' ) - will return true.
         * shortcode_exists( 'blah' ) - will return false.
         */
        function shortcode_exists( $shortcode = false ) {
            global $shortcode_tags;

            if ( ! $shortcode ) {
                return false;
            }

            if ( array_key_exists( $shortcode, $shortcode_tags ) ) {
                return true;
            }

            return false;
        }
    }
	    
	
	function spb_map ( $attributes ) {
	    if( !isset($attributes['base']) ) {
	        trigger_error(__("Wrong spb_map object. Base attribute is required", "swiftframework"), E_USER_ERROR);
	        die();
	    }
	    SPBMap::map($attributes['base'], $attributes);
	}
	
	function spb_getImageBySize ( $params = array( 'post_id' => NULL, 'attach_id' => NULL, 'thumb_size' => 'thumbnail' ) ) {
	    //array( 'post_id' => $post_id, 'thumb_size' => $grid_thumb_size )
	    if ( (!isset($params['attach_id']) || $params['attach_id'] == NULL) && (!isset($params['post_id']) || $params['post_id'] == NULL) ) return;
	    $post_id = isset($params['post_id']) ? $params['post_id'] : 0;
	
	    if ( $post_id ) $attach_id = get_post_thumbnail_id($post_id);
	    else $attach_id = $params['attach_id'];
	
	    $thumb_size = $params['thumb_size'];
	
	    global $_wp_additional_image_sizes;
	    $thumbnail = '';
	
	    if ( is_string($thumb_size) && ((!empty($_wp_additional_image_sizes[$thumb_size]) && is_array($_wp_additional_image_sizes[$thumb_size])) || in_array($thumb_size, array('thumbnail', 'thumb', 'medium', 'large', 'full') ) ) ) {
	        //$thumbnail = get_the_post_thumbnail( $post_id, $thumb_size );
	        $thumbnail = wp_get_attachment_image( $attach_id, $thumb_size );
	        //TODO APPLY FILTER
	    }
	
	    if ( $thumbnail == '' &&  $attach_id ) {
	        if ( is_string($thumb_size) ) {
	            $thumb_size = str_replace(array( 'px', ' ', '*', '×' ), array( '', '', 'x', 'x' ), $thumb_size);
	            $thumb_size = explode("x", $thumb_size);
	        }
	        // Resize image to custom size
	        $p_img = "";
            if ( isset( $thumb_size[0] ) && isset( $thumb_size[1] ) ) {
                $p_img = spb_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
            }
	
	        /*if ( spb_debug() ) {
	              var_dump($p_img);
	          }*/
	        if ( $p_img ) {
	            $img_class = '';
	            //if ( $grid_layout == 'thumbnail' ) $img_class = ' no_bottom_margin'; class="'.$img_class.'"
	            $thumbnail = '<img src="'.$p_img['url'].'" width="'.$p_img['width'].'" height="'.$p_img['height'].'" />';
	            //TODO: APPLY FILTER
	        }
	    }
	    $p_img_large = wp_get_attachment_image_src($attach_id, 'large' );
	    return array( 'thumbnail' => $thumbnail, 'p_img_large' => $p_img_large );
	}
	
	function spb_getColumnControls($width) {
	    switch ( $width ) {
	    	
	    	case "span2" :
	    	    $w = "1/6";
	    	    break;
	        
	        case "span3" :
	            $w = "1/4";
	            break;
	
	        case "span4" :
	            $w = "1/3";
	            break;
	
	        case "span6" :
	            $w = "1/2";
	            break;
	
	        case "span8" :
	            $w = "2/3";
	            break;
	
	        case "span9" :
	            $w = "3/4";
	            break;
	
	        case "span12" :
	            $w = "1/1";
	            break;
	
	        default :
	            $w = $width;
	    }
	    return $w;
	}
	/* Convert span3 to 1/4
	---------------------------------------------------------- */
	function spb_translateColumnWidthToFractional($width) {
	    switch ( $width ) {
	        
	        case "span2" :
                $w = "1/6";
                break;
	        
	        case "span3" :
	            $w = "1/4";
	            break;
	
	        case "span4" :
	            $w = "1/3";
	            break;
	
	        case "span6" :
	            $w = "1/2";
	            break;
	
	        case "span8" :
	            $w = "2/3";
	            break;
	
	        case "span9" :
	            $w = "3/4";
	            break;
	
	        case "span12" :
	            $w = "1/1";
	            break;
	
	        default :
	            $w = $width;
	    }
	    return $w;
	}
	
	/* Convert 2 to
	---------------------------------------------------------- */
	function spb_translateColumnsCountToSpanClass($grid_columns_count) {
	    $teaser_width = '';
	    switch ($grid_columns_count) {
	        case '1' :
	            $teaser_width = 'span12';
	            break;
	        case '2' :
	            $teaser_width = 'span6';
	            break;
	        case '3' :
	            $teaser_width = 'span4';
	            break;
	        case '4' :
	            $teaser_width = 'span3';
	            break;
	        case '6' :
	            $teaser_width = 'span2';
	            break;
	        
	    }
	    return $teaser_width;
	}
	
	if ( ! function_exists( 'spb_translateColumnWidthToSpan' ) ) {
	function spb_translateColumnWidthToSpan($width) {
		
		$sidebars = "";
		
		if (!is_admin()) {
			global $post, $sidebars;
		} else {
			$sidebars = "no-sidebars";
		}
			
	    switch ( $width ) {
	    	
	    	case "1/6" :
	    	       	
	    		$w = "span2";
	    	                
	    	    break;
	    	
	        case "1/4" :
	               	
	        	// DEFAULT
	        	if ($sidebars == "one-sidebar") {
	    		$w = "span2";
	    		} else if ($sidebars == "both-sidebars") {
	    		$w = "span-bs-quarter";
	    		} else { 
	            $w = "span3";
	            }
	                        
	            break;
	
	        case "1/3" :
	        	
	        	// DEFAULT
	        	if ($sidebars == "one-sidebar") {
	        	$w = "span-third";
	        	} else if ($sidebars == "both-sidebars") {
	        	$w = "span2";
	        	} else {
	        	$w = "span4";
	            }
	          
	            break;
	
	        case "1/2" :
	        	
	        	// DEFAULT
	            if ($sidebars == "one-sidebar") {
	            $w = "span4";
	            } else if ($sidebars == "both-sidebars") {
	            $w = "span3";
	            } else { 
	            $w = "span6";
	            }
	            
	            break;
	
	        case "2/3" :
	        	
	        	// DEFAULT
	        	if ($sidebars == "one-sidebar") {
	        	$w = "span-twothirds";
	        	} else if ($sidebars == "both-sidebars") {
	        	$w = "span4";
	        	} else {
	        	$w = "span8";
	        	}
	        	
	            break;
	
	        case "3/4" :
	        	
	        	// DEFAULT
	            if ($sidebars == "one-sidebar") {
	            $w = "span6";
	            } else if ($sidebars == "both-sidebars") {
	            $w = "span-bs-threequarter";
	            } else { 
	            $w = "span9";
	            }
	            
	            break;
	
	        case "1/1" :
	        
	        	// DEFAULT 
	            if ($sidebars == "one-sidebar") {
	            $w = "span8";
	            } else if ($sidebars == "both-sidebars") {
	            $w = "span6";
	            } else { 
	            $w = "span12";
	            }
	            
	            break;
	
	        default :
	            $w = $width;
	    }
	    return $w;
	}
	}
	
	function spb_js_remove_wpautop($content) {
	    $content = do_shortcode( shortcode_unautop($content) );
	    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
	    return $content;
	}
	
	if ( ! function_exists( 'shortcode_exists' ) ) {
	    /**
	     * Check if a shortcode is registered in WordPress.
	     *
	     * Examples: shortcode_exists( 'caption' ) - will return true.
	     * shortcode_exists( 'blah' ) - will return false.
	     */
	    function shortcode_exists( $shortcode = false ) {
	        global $shortcode_tags;
	
	        if ( ! $shortcode )
	            return false;
	
	        if ( array_key_exists( $shortcode, $shortcode_tags ) )
	            return true;
	
	        return false;
	    }
	}
	
	function spb_fieldAttachedImages($att_ids = array()) {
	    $output = '';
	    foreach ( $att_ids as $th_id ) {
	        $thumb_src = wp_get_attachment_image_src($th_id, 'thumbnail');
	        if ( $thumb_src ) {
	            $thumb_src = $thumb_src[0];
	            $output .= '
				<li class="added">
					<img rel="'.$th_id.'" src="'. $thumb_src .'" />
					<span class="img-added">'. __('Added', "swiftframework") .'</span>
				</li>';
	        }
	    }
	    if ( $output != '' ) {
	        return $output;
	    }
	}
	
	function spb_removeNotExistingImgIDs($param_value) {
	    $tmp = explode(",", $param_value);
	    $return_ar = array();
	    foreach ( $tmp as $id ) {
	        if ( wp_get_attachment_image($id) ) {
	            $return_ar[] = $id;
	        }
	    }
	    $tmp = implode(",", $return_ar);
	    return $tmp;
	}
	
	
	/*
	* Resize images dynamically using wp built in functions
	* Victor Teixeira
	*
	* php 5.2+
	*
	* Exemplo de uso:
	*
	* <?php
	 * $thumb = get_post_thumbnail_id();
	 * $image = vt_resize( $thumb, '', 140, 110, true );
	 * ?>
	* <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" />
	*
	* @param int $attach_id
	* @param string $img_url
	* @param int $width
	* @param int $height
	* @param bool $crop
	* @return array
	*/
	if (!function_exists( 'spb_resize' )) {
	    function spb_resize( $attach_id = null, $img_url = null, $width, $height, $crop = false ) {
	
	        // this is an attachment, so we have the ID
	        if ( $attach_id ) {
	            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
	            $actual_file_path = get_attached_file( $attach_id );
	            // this is not an attachment, let's use the image url
	        } else if ( $img_url ) {
	            $file_path = parse_url( $img_url );
	            $actual_file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
	            $actual_file_path = ltrim( $file_path['path'], '/' );
	            $actual_file_path = rtrim( ABSPATH, '/' ).$file_path['path'];
	            $orig_size = getimagesize( $actual_file_path );
	            $image_src[0] = $img_url;
	            $image_src[1] = $orig_size[0];
	            $image_src[2] = $orig_size[1];
	        }
	        $file_info = pathinfo( $actual_file_path );
	        $extension = '.'. $file_info['extension'];
	
	        // the image path without the extension
	        $no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];
	
	        $cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;
	
	        // checking if the file size is larger than the target size
	        // if it is smaller or the same size, stop right here and return
	        if ( $image_src[1] > $width || $image_src[2] > $height ) {
	
	            // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
	            if ( file_exists( $cropped_img_path ) ) {
	                $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
	                $vt_image = array (
	                    'url' => $cropped_img_url,
	                    'width' => $width,
	                    'height' => $height
	                );
	                return $vt_image;
	            }
	
	            // $crop = false
	            if ( $crop == false ) {
	                // calculate the size proportionaly
	                $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
	                $resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;
	
	                // checking if the file already exists
	                if ( file_exists( $resized_img_path ) ) {
	                    $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );
	
	                    $vt_image = array (
	                        'url' => $resized_img_url,
	                        'width' => $proportional_size[0],
	                        'height' => $proportional_size[1]
	                    );
	                    return $vt_image;
	                }
	            }
	
	            // no cache files - let's finally resize it
	            $img_editor =  wp_get_image_editor($actual_file_path);
	
	            if ( is_wp_error( $img_editor->resize($width, $height, $crop)) ) {
	                return array (
	                    'url' => '',
	                    'width' => '',
	                    'height' => ''
	                );
	            }
	
	            $new_img_path = $img_editor->generate_filename();
	
	            if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
	                return array (
	                    'url' => '',
	                    'width' => '',
	                    'height' => ''
	                );
	            }
	
	            if ( spb_debug() ) {
	                var_dump(file_exists($actual_file_path));
	                var_dump($actual_file_path);
	            }
	
	            if(!is_string($new_img_path)) {
	                return array (
	                    'url' => '',
	                    'width' => '',
	                    'height' => ''
	                );
	            }
	
	            $new_img_size = getimagesize( $new_img_path );
	            $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );
	
	            // resized output
	            $vt_image = array (
	                'url' => $new_img,
	                'width' => $new_img_size[0],
	                'height' => $new_img_size[1]
	            );
	            return $vt_image;
	        }
	
	        // default output - without resizing
	        $vt_image = array (
	            'url' => $image_src[0],
	            'width' => $image_src[1],
	            'height' => $image_src[2]
	        );
	        return $vt_image;
	    }
	}
	
	if (!function_exists( 'spb_debug' )) {
	    function spb_debug() {
	        if ( isset($_GET['spb_debug']) && $_GET['spb_debug'] == 'spb_debug' ) return true;
	        else return false;
	    }
	}
	
	function spb_js_force_send($args) {
	    $args['send'] = true;
	    return $args;
	}

?>
