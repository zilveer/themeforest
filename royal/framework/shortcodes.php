<?php
// **********************************************************************// 
// ! WordPress Gallery Shortcode
// **********************************************************************// 

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'etheme_gallery_shortcode');

function etheme_gallery_shortcode($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	/**
	 * Filter the default gallery shortcode output.
	 *
	 * If the filtered output isn't empty, it will be used instead of generating
	 * the default gallery template.
	 *
	 * @since 2.5.0
	 * @since 4.2.0 The `$instance` parameter was added.
	 *
	 * @see gallery_shortcode()
	 *
	 * @param string $output   The gallery output. Default empty.
	 * @param array  $attr     Attributes of the gallery shortcode.
	 * @param int    $instance Unique numeric ID of this gallery shortcode instance.
	 */
	$output = apply_filters( 'post_gallery', '', $attr, $instance );
	if ( $output != '' ) {
		return $output;
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	} else {
		$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
		$itemtag = 'dl';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
		$captiontag = 'dd';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
		$icontag = 'dt';
	}

	$columns = intval( $atts['columns'] );
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = '';

	/**
	 * Filter whether to print default gallery styles.
	 *
	 * @since 3.1.0
	 *
	 * @param bool $print Whether to print default gallery styles.
	 *                    Defaults to false if the theme supports HTML5 galleries.
	 *                    Otherwise, defaults to true.
	 */
	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>\n\t\t";
	}

	$size_class = sanitize_html_class( $atts['size'] );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

	/**
	 * Filter the default gallery shortcode CSS styles.
	 *
	 * @since 2.5.0
	 *
	 * @param string $gallery_style Default CSS styles and opening HTML div container
	 *                              for the gallery shortcode output.
	 */
	$output = '<div class="et-gallery">';
	$current_id = current($attachments);
	$preview_src = wp_get_attachment_image_src( $current_id->ID, 'large', true, false );
	$preview_output = wp_get_attachment_image( $current_id->ID, 'large', true, false );
	$output .= '<div class="gallery-preview" data-index="0">'.$preview_output.'</div>';

	$output .= apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
			$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
			$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta  = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='{$orientation}'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
	}

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "
			<br style='clear: both' />";
	}

	$output .= "
		</div>\n";

	$output .= '</div>';

	$output .= '
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("#gallery-'.$instance.' a").magnificPopup({
			        type:"image",
			        gallery:{
			            enabled:true
			        }
			    });
			});
	    </script>
	';
	return $output;
}

function etheme_gallery_shortcodeDEPRECATED( $attr ) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	/**
	 * Filter the default gallery shortcode output.
	 *
	 * If the filtered output isn't empty, it will be used instead of generating
	 * the default gallery template.
	 *
	 * @since 2.5.0
	 *
	 * @see gallery_shortcode()
	 *
	 * @param string $output The gallery output. Default empty.
	 * @param array  $attr   Attributes of the gallery shortcode.
	 */
	$output = apply_filters( 'post_gallery', '', $attr );
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	$html5 = current_theme_supports( 'html5', 'gallery' );
	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery'));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'dl';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'dd';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'dt';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';

	/**
	 * Filter whether to print default gallery styles.
	 *
	 * @since 3.1.0
	 *
	 * @param bool $print Whether to print default gallery styles.
	 *                    Defaults to false if the theme supports HTML5 galleries.
	 *                    Otherwise, defaults to true.
	 */
	if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
			/* see gallery_shortcode() in wp-includes/media.php */
		</style>\n\t\t";
	}

	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

	/**
	 * Filter the default gallery shortcode CSS styles.
	 *
	 * @since 2.5.0
	 *
	 * @param string $gallery_style Default gallery shortcode CSS styles.
	 * @param string $gallery_div   Opening HTML div container for the gallery shortcode output.
	 */
	$output = '<div class="et-gallery">';
	
	$current_id = current($attachments);
	$preview_src = wp_get_attachment_image_src( $current_id->ID, 'large', true, false );
	$preview_output = wp_get_attachment_image( $current_id->ID, 'large', true, false );
	$output .= '<div class="gallery-preview" data-index="0">'.$preview_output.'</div>';
	
	$output .= apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		
        $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
        if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
                $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
        } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
                $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
        } else {
        }

        $image_meta  = wp_get_attachment_metadata( $id );


		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) )
			$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} data-index='".$i."' class='{$orientation}'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
			$output .= '<br style="clear: both" />';
		}
	}

	if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
		$output .= "
			<br style='clear: both' />";
	}
	
	$output .= "
		</div>\n";
	$output .= '</div>';

	$output .= '
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("#gallery-'.$instance.' a").magnificPopup({
			        type:"image",
			        gallery:{
			            enabled:true
			        }
			    });
			});
	    </script>
	';

	return $output;
}


// **********************************************************************// 
// ! Contact form
// **********************************************************************// 



if(!function_exists('et_contact_form')) {
  function et_contact_form($atts) {
    extract( shortcode_atts( array(
      'class' => ''
    ), $atts ) );
    
    $captcha_instance = new ReallySimpleCaptcha();
    $captcha_instance->bg = array( 244, 80, 80 );
    $word = $captcha_instance->generate_random_word();
    $prefix = mt_rand();
    $img_name = $captcha_instance->generate_image( $prefix, $word );
    $captcha_img = ETHEME_CODE_URL.'/inc/really-simple-captcha/tmp/'.$img_name;

    ob_start();
    ?>
        <div id="contactsMsgs"></div>
        <form action="<?php the_permalink(); ?>" method="get" id="contact-form" class="contact-form <?php echo $class; ?>">
            
            <div class="form-group">
              <p class="form-name">
                <label for="name" class="control-label"><?php _e('Name and Surname', ETHEME_DOMAIN) ?> <span class="required">*</span></label>
                <input type="text" name="contact-name" class="required-field form-control" id="contact-name">
              </p>
            </div>

            <div class="form-group">
                <p class="form-name">
                  <label for="contact-email" class="control-label"><?php _e('Email', ETHEME_DOMAIN) ?> <span class="required">*</span></label>
                  <input type="text" name="contact-email" class="required-field form-control" id="contact-email">
                </p>
            </div>
            
            <div class="form-group">
              <p class="form-name">
                <label for="contact-website" class="control-label"><?php _e('Website', ETHEME_DOMAIN) ?></label>
                <input type="text" name="contact-website" class="form-control" id="contact-website">
              </p>
            </div>
            

            <div class="form-group">
              <p class="form-textarea">
                <label for="contact_msg" class="control-label"><?php _e('Message', ETHEME_DOMAIN); ?> <span class="required">*</span></label>
                <textarea name="contact-msg" id="contact-msg" class="required-field form-control" cols="30" rows="7"></textarea>
              </p>
            </div>
            
            <div class="captcha-block">
              <img src="<?php echo $captcha_img; ?>">
              <input type="text" name="captcha-word" class="captcha-input">
              <input type="hidden" name="captcha-prefix" value="<?php echo $prefix; ?>">
            </div>
            
            <p class="pull-right">
              <input type="hidden" name="contact-submit" id="contact-submit" value="true" >
              <span class="spinner"><?php _e('Sending...', ETHEME_DOMAIN) ?></span>
              <button class="btn btn-black big" id="submit" type="submit"><?php _e('Send message', ETHEME_DOMAIN) ?></button>
            </p>

            <div class="clearfix"></div>
        </form>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
  }
}

add_shortcode('contact_form', 'et_contact_form');

/**
 * List all (or limited) product categories
 *
 * @access public
 * @param array $atts
 * @return string
 */
if(!function_exists('etheme_product_categories')) {
    function etheme_product_categories( $atts ) {
        global $woocommerce_loop;

        extract( shortcode_atts( array(
            'number'     => null,
            'title'      => '',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => 1,
            'parent'     => '',
            'display_type'=> 'grid',
            'class'      => ''
        ), $atts ) );

        if ( isset( $atts[ 'ids' ] ) ) {
            $ids = explode( ',', $atts[ 'ids' ] );
            $ids = array_map( 'trim', $ids );
        } else {
            $ids = array();
        }

        $title_output = '';

        if($title != '') {
            $title_output = '<h3 class="title"><span>' . $title . '</span></h3>';
        }

        $hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

        // get terms and workaround WP bug with parents/pad counts
        $args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty,
            'include'    => $ids,
            'pad_counts' => true,
            'child_of'   => $parent
        );

        $product_categories = get_terms( 'product_cat', $args );

        if ( $parent !== "" ) {
            $product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );
        }

        if ( $hide_empty ) {
            foreach ( $product_categories as $key => $category ) {
                if ( $category->count == 0 ) {
                    unset( $product_categories[ $key ] );
                }
            }
        }

        if ( $number ) {
            $product_categories = array_slice( $product_categories, 0, $number );
        }

        //$woocommerce_loop['columns'] = $columns;

        if($display_type == 'slider') {
            $class .= 'owl-carousel carousel-area';
        } else {
            $class .= 'row';
        }

        $box_id = rand(1000,10000);

        ob_start();

        // Reset loop/columns globals when starting a new loop
        $woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

        $woocommerce_loop['display_type'] = $display_type;

        if ( $product_categories ) {

            
            if($display_type == 'menu') {
            	$instance = array(
            		'title' => $title,
            		'hierarchical' => 1,
		            'orderby'    => $orderby,
		            'order'      => $order,
		            'hide_empty' => $hide_empty,
		            'include'    => $ids,
		            'pad_counts' => true,
		            'child_of'   => $parent
            	);
            	$args = array();
            	the_widget( 'WC_Widget_Product_Categories', $instance, $args );
            } else {
            
            	echo $title_output;
            
	            echo '<div class="categoriesCarousel '.$class.' slider-'.$box_id.'">';
	
	            foreach ( $product_categories as $category ) {
	
	                wc_get_template( 'content-product_cat.php', array(
	                    'category' => $category
	                ) );
	
	            }
	
	            echo '</div>';
	            
            }


            if($display_type == 'slider') {
                echo '
                    <script type="text/javascript">
                        jQuery(".slider-'.$box_id.'").owlCarousel({
                            items:4, 
                            lazyLoad : true,
                            navigation: true,
                            navigationText:false,
                            rewindNav: false,
                            itemsCustom: [[0, 1], [479,2], [619,3], [768,3],  [1200, 4], [1600, 4]]
                        });
        
                    </script>
                ';
            }

        }

        woocommerce_reset_loop();

        return ob_get_clean();
    }
}
add_shortcode('etheme_product_categories', 'etheme_product_categories');

// **********************************************************************// 
// ! Shortcodes
// **********************************************************************// 


if(!function_exists('et_brands')) {
	function et_brands($atts) {
        extract( shortcode_atts( array(
            'number'     => null,
            'title'      => '',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'columns'    => 3,
            'parent'     => '',
            'display_type'=> 'slider',
            'class'      => ''
        ), $atts ) );

        if ( isset( $atts[ 'ids' ] ) ) {
            $ids = explode( ',', $atts[ 'ids' ] );
            $ids = array_map( 'trim', $ids );
        } else {
            $ids = array();
        }


        // get terms and workaround WP bug with parents/pad counts
        $args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => 1,
            'include'    => $ids,
            'pad_counts' => true,
            'child_of'   => $parent
        );

        $terms = get_terms( 'brand', $args );

        if ( $parent !== "" ) {
            $terms = wp_list_filter( $terms, array( 'parent' => $parent ) );
        }

        if ( $number ) {
            $terms = array_slice( $terms, 0, $number );
        }

		
		$output = '';
		$rand = rand(1000,9999);
		
		$count = count($terms); $i=0;
		if ($count > 0) {
			$output .= '<div class="carousel-area et-brands-'.$display_type.' '.$class.' columns-number-'.$columns.'">';	
			if($title != '') {
				$output .= '<h2 class="brands-title title"><span>'.$title.'</span></h2>';
			}
			$output .= '<div class="brandCarousel'.$rand.'">';
			
		    foreach ($terms as $term) {
		        $i++;
		        $thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
				$output .= '<div class="et-brand">';
				if($thumbnail_id) {
					$output .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all products from %s', ETHEME_DOMAIN), $term->name) . '"><img src="' . etheme_get_image($thumbnail_id) . '" title="' . $term->name . '"/></a>';		
				} else {
					$output .= '<h3><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all products from %s', ETHEME_DOMAIN), $term->name) . '">' . $term->name . '</a></h3>';		
				}		
				$output .= '</div>';
		    }
		    
		    $output .= '</div>';
			$output .= '</div>';
			
			if($display_type == 'slider') {
				$items = '[[0, 1], [479,1], [619,2], [768,3],  [1200, 4], [1600, 4]]';
				$output .=  '<script type="text/javascript">';
				$output .=  '     jQuery(".brandCarousel'.$rand.'").owlCarousel({';
				$output .=  '         items:4, ';
				$output .=  '         navigation: true,';
				$output .=  '         navigationText:false,';
				$output .=  '         rewindNav: false,';
				$output .=  '         itemsCustom: '.$items.'';
				$output .=  '    });';
				
				$output .=  ' </script>';
			}
				
		}
			
		
		
		return $output;
	}
}

add_shortcode('brands', 'et_brands');

/***************************************************************/
/* Etheme Global Search */
/***************************************************************/
if(!function_exists('etheme_search')) {
	function etheme_search($atts) {
		extract( shortcode_atts( array(
			'products' => 0,
			'posts' => 0,
			'portfolio' => 0,
			'pages' => 0,
			'testimonial' => 0,
			'images' => 1,
			'count' => 3,
			'class' => '',
			'post_type' => 'product',
			'widget' => 0
		), $atts ) );
		
		$search_input = $output = '';

		switch ($post_type) {
			case 'product':
				$products = 1;
			break;

			case 'etheme_portfolio':
				$portfolio = 1;
			break;

			case 'post':
				$posts = 1;
			break;

			case 'page':
				$pages = 1;
			break;

			case 'testimonial':
				$testimonial =1;
			break;

			case 'any':
				$posts = 1;
				$products = 1;
				$pages = 1;
				$portfolio = 1;
				$testimonial =1;
			break;

			default:
				$products = 1;
			break;
		}
		
		if(get_search_query() != '') {  
			$search_input = get_search_query(); 
		}
		
		$output .= '<div class="et-mega-search '.$class.'" data-products="'.$products.'" data-count="'.$count.'" data-posts="'.$posts.'" data-portfolio="'.$portfolio.'" data-pages="'.$pages.'" data-testimonial="'.$testimonial.'" data-images="'.$images.'">';

			$output .= '<form method="get" action="'.home_url( '/' ).'">';
				$output .= '<input type="text" value="'.$search_input.'" name="s" id="s" autocomplete="off" placeholder="'.__('Search', ETHEME_DOMAIN).'"/>';

				$output .= '<input type="hidden" name="post_type" value="'.$post_type.'"/>';

				$output .= '<input type="submit" value="'.__( 'Go', ETHEME_DOMAIN ).'" class="button active filled"  /> ';
			$output .= '</form>';
			$output .= '<span class="et-close-results"></span>';
			$output .= '<div class="et-search-result">';
			$output .= '</div>';
		$output .= '</div>';
		
		return $output;
			
	}
}

add_shortcode('etheme_search', 'etheme_search');

/***************************************************************/
/* TWITTER SLIDER */
/***************************************************************/

if(!function_exists('et_twitter_slider')) {
	function et_twitter_slider($atts) {
		extract( shortcode_atts( array(
			'title' => '',
			'user' => '',
			'consumer_key' => '',
			'consumer_secret' => '',
			'user_token' => '',
			'user_secret' => '',
			'limit' => 10,
			'class' => 10
		), $atts ) );
		
		if(empty($consumer_key) || empty($consumer_secret) || empty($user_token) || empty($user_secret) || empty($user)) {
			return __('Not enough information', ETHEME_DOMAIN);
		}
		
		$tweets_array = et_get_tweets($consumer_key, $consumer_secret, $user_token, $user_secret, $user, $limit);
		$output = '';
		
		$output .= '<div class="et-twitter-slider '.$class.'">';
		if($title != '') {
			$output .= '<h2 class="twitter-slider-title"><span>'.$title.'</span></h2>';
		}
		
		
		$output .= '<ul class="et-tweets">';
		
		
		foreach($tweets_array as $tweet) {
			$output .= '<li class="et-tweet">';
			$output .= etheme_tweet_linkify($tweet['text']);
			$output .= '<div class="twitter-info">';
                            $output .= '<a href="'.$tweet['user']['url'].'" class="active" target="_blank">@'.$tweet['user']['screen_name'].'</a> '.date("l M j \- g:ia",strtotime($tweet['created_at']));
			$output .= '</div>';
			$output .= '</li>';
		}
		
		$output .= '</ul>';
			
		$output .= '</div>';
		
		$items = '[[0, 1], [479,1], [619,1], [768,1],  [1200, 1], [1600, 1]]';
		$output .=  '<script type="text/javascript">';
		$output .=  '     jQuery(".et-tweets").owlCarousel({';
		$output .=  '         items:1, ';
		$output .=  '         navigation: true,';
		$output .=  '         navigationText:false,';
		$output .=  '         rewindNav: false,';
		$output .=  '         itemsCustom: '.$items.'';
		$output .=  '    });';
		
		$output .=  ' </script>';	
		
		return $output;
		
	}
}

add_shortcode( 'twitter_slider', 'et_twitter_slider' );


if(!function_exists('et_get_tweets')) {
	function et_get_tweets($consumer_key = 'Ev0u7mXhBvvVaLOfPg2Fg', $consumer_secret = 'SPdZaKNIeBlUo99SMAINojSJRHr4EQXPSkR0Dw97o', $user_token = '435115014-LVrLsvzVAmQWjLw1r8KjNy93QiXHWKH09kcIQCKh', $user_secret = 'eTxZP8jQfB7DjKAAoJx1AFsTd3wPfImNaqau6HIVw', $user = '8theme', $count = 10) {
	    if(etheme_twitter_cache_enabled()){
	        //setting the location to cache file
	        $cachefile = ETHEME_CODE_DIR . '/cache/twitterSliderCache.json'; 
	        $cachetime = 50;
	        
	        // the file exitsts but is outdated, update the cache file
	        if (file_exists($cachefile) && ( time() - $cachetime > filemtime($cachefile)) && filesize($cachefile) > 0) {
	            //capturing fresh tweets
	            $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	            $tweets_decoded = json_decode($tweets, true);
	            //if get error while loading fresh tweets - load outdated file
	            if(isset($tweets_decoded['error'])) {
	                $tweets = etheme_pick_tweets($cachefile);
	            }
	            //else store fresh tweets to cache
	            else
	                etheme_store_tweets($cachefile, $tweets);
	        }
	        //file doesn't exist or is empty, create new cache file
	        elseif (!file_exists($cachefile) || filesize($cachefile) == 0) {
	            $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	            $tweets_decoded = json_decode($tweets, true);
	            //if request fails, and there is no old cache file - print error
	            if(isset($tweets_decoded['error']))
	                return 'Error: ' . $tweets_decoded['error'];
	            //make new cache file with request results
	            else
	                etheme_store_tweets($cachefile, $tweets);            
	        }
	        //file exists and is fresh
	        //load the cache file
	        else { 
	           $tweets = etheme_pick_tweets($cachefile);
	        }
	    } else{
	       $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	    }
	
	    $tweets = json_decode($tweets, true);
	    return $tweets;
	}
}



add_shortcode('quick_view', 'etheme_quick_view_shortcodes');
function etheme_quick_view_shortcodes($atts, $content=null){
    extract(shortcode_atts(array( 
        'id' => '',
        'class' => ''
    ), $atts));
    
    
    return '<div class="show-quickly-btn '.$class.'" data-prodid="'.$id.'">'. do_shortcode($content) .'</div>';

}


add_shortcode('teaser_box', 'etheme_teaser_box_shortcodes');
function etheme_teaser_box_shortcodes($atts, $content=null){
    extract(shortcode_atts(array( 
        'title' => '',
        'heading' => '4',
        'img' => '',
        'img_src' => '',
        'img_size' => '270x170',
        'style' => '',
        'class' => ''
    ), $atts));

    $src = '';

    $img_size = explode('x', $img_size);

    $width = $img_size[0];
    $height = $img_size[1];

    if($img != '') {
        $src = etheme_get_image($img, $width, $height);
    }elseif ($img_src != '') {
        $src = do_shortcode($img_src);
    }
    
    if($title != '') {
	    $title = '<h'.$heading.' class="text-center"><span>'.$title.'</span></h'.$heading.'><hr class="horizontal-break-alt"/>';
    }
    
    if($src != '') {
	    $img = '<img src="'.$src.'">';
    }
    
    if($style != '') {
	    $class .= ' style-'.$style;
    }
    
    return '<div class="teaser-box '.$class.'"><div>'. $title . $img . do_shortcode($content) .'</div></div>';

}
// **********************************************************************// 
// ! WooCommerce PRODUCT slider and grid
// **********************************************************************// 
add_shortcode('etheme_products', 'etheme_products_shortcodes');
function etheme_products_shortcodes($atts, $content=null){
    global $wpdb, $woocommerce_loop;
    if ( !class_exists('Woocommerce') ) return false;
    
    extract(shortcode_atts(array( 
        'ids' => '',
        'skus' => '',
        'columns' => 4,
        'shop_link' => 1,
        'limit' => 20,
        'categories' => '',
        'block_id' => false,
        'product_img_hover' => '',
        'type' => 'slider',
        'style' => 'default',
        'products' => '', //featured new sale bestsellings recently_viewed
        'title' => '',
        'desktop' => 4,
        'notebook' => 4,
        'tablet' => 3,
        'phones' => 1,
        'orderby' => 'ASC',
        'order' => 'default'
    ), $atts)); 


	if (!empty($ids) && $order == 'post__in') {
		$order = 'post__in';
	} elseif ($order == 'post__in') {
		$order = 'ID';
	} elseif($order == 'default') {
		$order = '';
	} else {
		$order = $order;
	}

    $args = array(
        'post_type'             => 'product',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit,
        'orderby'   => $order,
        'order'     => $orderby,
        'meta_query' => array(
            array(
                'key'       => '_visibility',
                'value'     => array('catalog', 'visible'),
                'compare'   => 'IN'
            )
        )
    );

    if ($products == 'featured') {
        $args['meta_key'] = '_featured';
        $args['meta_value'] = 'yes';
    }

    if ($products == 'new') {
        $args['meta_key'] = 'product_new';
        $args['meta_value'] = 'enable';
    }

    if ($products == 'sale') {
        $product_ids_on_sale = woocommerce_get_product_ids_on_sale();
        $args['post__in'] = array_merge( array( 0 ), $product_ids_on_sale );
    }

    if ($products == 'bestsellings') {
        $args['meta_key'] = 'total_sales';
        $args['orderby'] = 'meta_value_num';
    }

    if ($products == 'recently_viewed') {
        $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
        $viewed_products = array_filter( array_map( 'absint', $viewed_products ) );

        if ( empty( $viewed_products ) )
          return;
        $args['post__in'] = $viewed_products;
        $args['orderby'] = 'rand';
    }


    if($skus != ''){
        $skus = explode(',', $atts['skus']);
        $skus = array_map('trim', $skus);
        $args['meta_query'][] = array(
            'key'       => '_sku',
            'value'     => $skus,
            'compare'   => 'IN'
        );
    }

    if($ids != ''){
        $ids = explode(',', $atts['ids']);
        $ids = array_map('trim', $ids);
        $args['post__in'] = $ids;
    }

    // Narrow by categories
    if ( $categories != '' ) {
      $categories = explode(",", $categories);
      $gc = array();
      foreach ( $categories as $grid_cat ) {
          array_push($gc, $grid_cat);
      }
      $gc = implode(",", $gc);
      ////http://snipplr.com/view/17434/wordpress-get-category-slug/
      //$args['category_name'] = $gc;
      $pt = array('product');


      $taxonomies = get_taxonomies('', 'object');
      $args['tax_query'] = array('relation' => 'OR');
      foreach ( $taxonomies as $t ) {
          if ( in_array($t->object_type[0], $pt) ) {
              $args['tax_query'][] = array(
                  'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                  'terms' => $categories,
                  'field' => 'id',
              );
          }
      }
    }

    $customItems = array(
        'desktop' => $desktop,
        'notebook' => $notebook,
        'tablet' => $tablet,
        'phones' => $phones
    );

    $woocommerce_loop['hover'] = $product_img_hover;
      
    if ($type == 'slider') {
    	$slider_args = array(
    		'title' => $title,
    		'shop_link' => $shop_link,
    		'slider_type' => false,
    		'items' => $customItems,
    		'style' => $style,
    	);
        ob_start();
        etheme_create_slider($args, $slider_args);
        $output = ob_get_contents();
        ob_end_clean();
    } elseif($type == 'full-width') {
    	$slider_args = array(
    		'title' => $title,
    		'shop_link' => $shop_link,
    		'slider_type' => 'swiper',
    		'customItems' => $customItems,
    		'style' => $style,
    		'block_id' => $block_id
    	);
        ob_start();
        etheme_create_slider($args, $slider_args);
        $output = ob_get_contents();
        ob_end_clean();
    } else {
        $woocommerce_loop['view_mode'] = $type;
        $output = etheme_products($args, $title, $columns);
    }

    unset($woocommerce_loop['hover']);
    
    return $output;

}

// **********************************************************************// 
// ! WooCommerce featured slider
// **********************************************************************// 
add_shortcode('etheme_featured', 'etheme_featured_shortcodes');
function etheme_featured_shortcodes($atts, $content=null){
    global $wpdb;
    if ( !class_exists('Woocommerce') ) return false;
    
    extract(shortcode_atts(array( 
        'shop_link' => 1,
        'limit' => 50,
        'categories' => '',
        'title' => __('Featured Products', ETHEME_DOMAIN)
    ), $atts)); 
    
    $key = '_featured';
    

    $args = apply_filters('woocommerce_related_products_args', array(
        'post_type'             => 'product',
        'meta_key'              => $key,
        'meta_value'            => 'yes',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit
    ) );
    
      // Narrow by categories
      if ( $categories != '' ) {
          $categories = explode(",", $categories);
          $gc = array();
          foreach ( $categories as $grid_cat ) {
              array_push($gc, $grid_cat);
          }
          $gc = implode(",", $gc);
          ////http://snipplr.com/view/17434/wordpress-get-category-slug/
          $args['category_name'] = $gc;
          $pt = array('product');

          $taxonomies = get_taxonomies('', 'object');
          $args['tax_query'] = array('relation' => 'OR');
          foreach ( $taxonomies as $t ) {
              if ( in_array($t->object_type[0], $pt) ) {
                  $args['tax_query'][] = array(
                      'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                      'terms' => $categories,
                      'field' => 'id',
                  );
              }
          }
      }
      
    ob_start();
    etheme_create_slider($args,$title, $shop_link);
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}

add_shortcode('etheme_new', 'etheme_new_shortcodes');
function etheme_new_shortcodes($atts, $content=null){
    global $wpdb;
    if ( !class_exists('Woocommerce') ) return false;
    
    extract(shortcode_atts(array( 
        'shop_link' => 1,
        'limit' => 50,
        'categories' => '',
        'title' => __('Latest Products', ETHEME_DOMAIN)
    ), $atts)); 
    
    $key = 'product_new';
    
    
    if(!class_exists('Woocommerce')) return;

    $args = array(
        'post_type'             => 'product',
        'meta_key'              => $key,
        'meta_value'            => 'enable',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit
    );
    
      // Narrow by categories
      if ( $categories != '' ) {
          $categories = explode(",", $categories);
          $gc = array();
          foreach ( $categories as $grid_cat ) {
              array_push($gc, $grid_cat);
          }
          $gc = implode(",", $gc);
          ////http://snipplr.com/view/17434/wordpress-get-category-slug/
          $args['category_name'] = $gc;
          $pt = array('product');

          $taxonomies = get_taxonomies('', 'object');
          $args['tax_query'] = array('relation' => 'OR');
          foreach ( $taxonomies as $t ) {
              if ( in_array($t->object_type[0], $pt) ) {
                  $args['tax_query'][] = array(
                      'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                      'terms' => $categories,
                      'field' => 'id',
                  );
              }
          }
      }
      
    ob_start();
    etheme_create_slider($args,$title, $shop_link);
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}


add_shortcode('template_url', 'etheme_template_url_shortcode');
function etheme_template_url_shortcode(){
    return get_template_directory_uri();
}

add_shortcode('base_url', 'etheme_base_url_shortcode');
function etheme_base_url_shortcode(){
    return home_url();
}


// **********************************************************************// 
// ! Recent posts shortcodes
// **********************************************************************// 


add_shortcode('recent_posts', 'etheme_recent_posts_shortcode');
function etheme_recent_posts_shortcode($atts){
    $a = shortcode_atts( array(
       'title' => 'Recent Posts',
       'limit' => 10,
       'cat' => '',
       'imgwidth' => 300,
       'imgheight' => 200,
       'imgcrop' => 1,
       'date' => 0,
       'excerpt' => 0,
       'more_link' => 1
   ), $atts );


    $args = array(
        'post_type'             => 'post',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $a['limit'],
        'cat'                   => $a['cat']
    );

    $crop = ($a['imgcrop'] == 1);

    ob_start();
    etheme_create_posts_slider($args, $a['title'], $a['more_link'], $a['date'], $a['excerpt'], $a['imgwidth'], $a['imgheight'], $crop );
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;

}

// **********************************************************************// 
// ! Typography Shortcodes
// **********************************************************************// 

// **********************************************************************// 
// ! Buttons
// **********************************************************************// 

add_shortcode('button', 'etheme_btn_shortcode');
function etheme_btn_shortcode($atts){
    $a = shortcode_atts( array(
       'title' => 'Button',
       'href' => '#',
       'icon' => '',
       'size' => '',
       'style' => '',
       'el_class' => '',
       'type' => ''
   ), $atts );
    $icon = $class = '';
    if($a['icon'] != '') {
        $icon = '<i class="fa fa-'.$a['icon'].'"></i>';
    }
    if($a['style'] != '') {
	    $class .= ' '.$a['style'];
    }
    if($a['type'] != '') {
	    $class .= ' '.$a['type'];
    }
    if($a['size'] != '') {
	    $class .= ' '.$a['size'];
    }
    if($a['el_class'] != '') {
	    $class .= ' '.$a['el_class'];
    }
    return '<a class="btn'. $class .'" href="' . $a['href'] . '"><span>'. $icon . $a['title'] . '</span></a>';
}

// **********************************************************************// 
// ! Alert Boxes
// **********************************************************************// 

add_shortcode('alert', 'etheme_alert_shortcode');
function etheme_alert_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'type' => 'success',
        'title' => '',
        'close' => 1
    ), $atts);
    $icon = '';
    switch($a['type']) {
        case 'error':
            $class = 'error';
            $icon = 'times-circle';
        break;
        case 'success':
            $class = 'success';
            $icon = 'check-circle';

        break;
        case 'info':
            $class = 'info';
            $icon = 'info-circle';

        break;
        case 'warning':
            $class = 'warning';
            $icon = 'exclamation-circle';

        break;
        default:
            $class = 'success';
    }
    $closeBtn = '';
    $title = '';
    if($a['close'] == 1){
        $closeBtn = '<span class="close-parent">close</span>';
    }
    if($a['title'] != '') {
        $title = '<span class="h3">' . $a['title'] . '</span><br>';
    }
    
    return '<p class="' . $class . '">' . $title . do_shortcode($content) . $closeBtn . '</p>';
}

// **********************************************************************// 
// ! Title with subtitle
// **********************************************************************// 

add_shortcode('title', 'etheme_title_shortcode');
function etheme_title_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'heading' => '2',
        'subtitle' => '',
        'align' => 'center',
        'subtitle' => '',
        'line' => 1
    ), $atts);
    $subtitle = '';
    $class = 'title';
    $class .= ' text-'.$a['align'];
    if(!$a['line']) {
        $class .= ' without-line';
    }
    if($a['subtitle'] != '') {
        $class .= ' with-subtitle';
        $subtitle = '<span class="subtitle text-'.$a['align'].'">'.$a['subtitle'].'</span>';
    }

    return '<h'.$a['heading'].' class="'.$class.'"><span>'.$content.'</span></h'.$a['heading'].'>'.$subtitle;
}

// **********************************************************************// 
// ! Animated counter
// **********************************************************************// 

add_shortcode('counter', 'etheme_counter_shortcode');
function etheme_counter_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'init_value' => 1,
        'final_value' => 100,
        'class' => ''
    ), $atts);

    return '<span id="animatedCounter" class="animated-counter '.$a['class'].'" data-value='.$a['final_value'].'>'.$a['init_value'].'</span>';
}



// **********************************************************************// 
// ! Call to action
// **********************************************************************// 

add_shortcode('callto', 'etheme_callto_shortcode');
function etheme_callto_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'btn' => '',
        'style' => '',
        'btn_position' => 'right',
        'link' => ''
    ), $atts);
    $btn = '';
    $class = '';
    $btnClass = '';
    $onclick = '';

    if($a['style'] == 'filled') {
        $btnClass = 'filled';
    } else if($a['style'] == 'dark') {
        $btnClass = 'white';
    }
    
    if($a['btn'] != '') {
        $btn = '<a href="'.$a['link'].'" class="btn '.$btnClass.'">' . $a['btn'] . '</a>';
    }
    
    if($a['style'] != '') {
        $class = 'style-'.$a['style'];
    }
    
    if($a['style'] == 'fullwidth') { 
        $onclick = 'window.location="'.$a['link'].'"';
    }
    
    $output = '';

    $output .= '<div class="cta-block '.$class.'" onclick=\''. $onclick.'\'>';
    if($a['style'] == 'fullwidth') { 
        $output .= '<div class="container">';
    }
        $output .= '<div class="table-row">';

            if($a['btn'] != '') {

                    if ($a['btn_position'] == 'left') {
                        $output .= '<div class="table-cell button-left">'.$btn.'</div>';
                    }
                    $output .= '<div class="table-cell">'. do_shortcode($content) .'</div>';

                    if ($a['btn_position'] == 'right') {
                        $output .= '<div class="table-cell button-right">'.$btn.'</div>';
                    }

            } else{
                $output .= '<div class="table-cell">'. do_shortcode($content) .'</div>';
            }
        $output .= '</div>';
    if($a['style'] == 'fullwidth') { 
        $output .= '</div>';
    }
    $output .= '</div>';
    
    return $output;
}


// **********************************************************************// 
// ! Dropcap
// **********************************************************************// 

add_shortcode('dropcap', 'etheme_dropcap_shortcode');
function etheme_dropcap_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'style' => ''
   ), $atts );
   
    return '<span class="dropcap ' . $a['style'] . '">' . $content . '</span>';
}

// **********************************************************************// 
// ! Blockquote
// **********************************************************************// 

add_shortcode('blockquote', 'etheme_blockquote_shortcode');
function etheme_blockquote_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'align' => 'left',
        'class' => ''
    ), $atts);
    switch($a['align']) {

        case 'right':
            $align = 'fl-r';
        break;
        case 'center':
            $align = 'fl-none';
        break;
        default:
            $align = 'fl-l';        
    }
    $content = wpautop(trim($content));
    return '<blockquote class="' . $align .' '. $a['class'] . '">' . $content . '</blockquote>';
}


// **********************************************************************// 
// ! Checklist
// **********************************************************************// 

add_shortcode('checklist', 'etheme_checklist_shortcode');
function etheme_checklist_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'style' => 'arrow'
    ), $atts);
    switch($a['style']) {
        case 'arrow':
            $class = 'arrow';
        break;
        case 'circle':
            $class = 'circle';
        break;
        case 'star':
            $class = 'star';
        break;
        case 'square':
            $class = 'square';
        break;
        case 'dash':
            $class = 'dash';
        break;
        default:
            $class = 'arrow';
    }
    return '<div class="list list-' . $class . '">' . do_shortcode($content) . '</div	>';
}

// **********************************************************************// 
// ! Columns
// **********************************************************************// 

add_shortcode('et_section', 'etheme_et_section_shortcode');
function etheme_et_section_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'el_class' => '',
        'color_sceheme' => '',
        'section_border' => '',
        'padding' => '',
        'color' => '',
        'content' => '',
        'parallax' => 0,
        'parallax_speed' => 0.05,
        'video_poster' => '',
        'video_mp4' => '',
        'video_webm' => '',
        'video_ogv' => '',
        'img' => '',
        'img_src' => '',
        'mt' => '',
        'mb' => '',
        'pt' => '',
        'pb' => ''

    ), $atts);


    $src = '';
    $style = 'style="';
    $video = '';

    if($a['img'] != '') {
        $src = etheme_get_image($a['img']);
    }elseif ($a['img_src'] != '') {
        $src = do_shortcode($a['img_src']);
    }

    if ($src != '') {
        $style .= 'background-image: url('.$src.');';
    }
    if ($a['color'] != '') {
        $style .= 'background-color: '.$a['color'].';';
    }

    if ($a['content'] != '') {
        $content = $a['content'];
    }
    
    $class = '';

    if ($a['parallax']) {
        $class .= 'parallax-section';
    }

    if($a['mt'] != '') {
        $style .= 'margin-top: '.$a['mt'].'px;';
    }

    if($a['mb'] != '') {
        $style .= 'margin-bottom: '.$a['mb'].'px;';
    }

    if($a['pt'] != '') {
        $style .= 'padding-top: '.$a['pt'].'px;';
    }

    if($a['pb'] != '') {
        $style .= 'padding-bottom: '.$a['pb'].'px;';
    }

    $style .= '"';
    $data = '';

    if ($a['parallax_speed'] != '') {
      $data = 'data-parallax-speed="'.$a['parallax_speed'].'"';
    }

    if($a['video_mp4'] != '' || $a['video_webm'] != '' || $a['video_ogv'] != '') {
        if($a['video_poster'] != '') { 
            $video_poster = etheme_get_image($a['video_poster']);
            $video .= '
                <div class="section-video-poster" style="background-image: url('.$video_poster.')"></div>
            ';
        }

        $video .= '
        <div class="section-back-video hidden-tablet hidden-phone">
            <video autoplay="autoplay" loop="loop" muted="muted" style="" class="et-section-video">
                <source src="'.$a['video_mp4'].'" type="video/mp4">
                <source src="'.$a['video_ogv'].'" type="video/ogv">
                <source src="'.$a['video_webm'].'" type="video/webm">
            </video>
        </div>
        <div class="section-video-mask"></div>
        ';
    }



    return '<div class="et_section '.$a['padding'].' '.$a['section_border'].' color-scheme-'.$a['color_sceheme'].' '.$class . ' ' . $a['el_class'] . '" '. $style . $data .'>'.$video.'<div class="container">' . do_shortcode($content) . '</div></div>';
}

add_shortcode('row', 'etheme_row_shortcode');
function etheme_row_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'class' => ''
    ), $atts);
    
    $class = '';

    return '<div class="row'.$class . ' ' . $a['class'] . '">' . do_shortcode($content) . '</div>';
}

add_shortcode('column', 'etheme_column_shortcode');
function etheme_column_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'size' => 'one_half',
        'class' => '',
    ), $atts);
    switch($a['size']) {
        case 'one-half':
            $class = 'col-md-6 ';
        break;
        case 'one-third':
            $class = 'col-md-4 ';
        break;
        case 'two-third':
            $class = 'col-md-8 ';
        break;
        case 'one-fourth':
            $class = 'col-md-3 ';
        break;
        case 'three-fourth':
            $class = 'col-md-9 ';
        break;
        default: 
            $class = $a['size'];
        }
        
        $class .= ' '.$a['class'];
        
        return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
}

// **********************************************************************// 
// ! Toggles
// **********************************************************************// 

add_shortcode('toggle_block', 'etheme_toggle_block_shortcode');
function etheme_toggle_block_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => ''
    ), $atts);
    return '<div class="toggle-block '.$a['class'].'">' . do_shortcode($content) . '</div>';
}

add_shortcode('toggle', 'etheme_toggle_shortcode');

function etheme_toggle_shortcode($atts, $content = null) {
    global $tab_count;
    $a = shortcode_atts(array(
        'title' => 'Tab',
        'class' => '',
        'active' => 0
    ), $atts);
    
    $class = $a['class'];
    $style = '';

    $opener = '<div class="open-this">+</div>';
    
    if ($a['active'] == 1)  {
        $style = ' style="display: block;"';
        $class .= 'opened'; 
        $opener = '<div class="open-this">&ndash;</div>';
    }
    
    $tab_count++;
    
    return '<div class="toggle-element ' . $class . '"><a href="#" class="toggle-title">' . $opener . $a['title'] . '</a><div class="toggle-content" ' . $style . '>' . do_shortcode($content) . '</div></div>';
}

// **********************************************************************// 
// ! Tabs
// **********************************************************************// 

add_shortcode('tabs', 'etheme_tabs_shortcode');
function etheme_tabs_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => ''
    ), $atts);
    return '<div class="tabs '.$a['class'].'">' . do_shortcode($content) . '</div>';
}

add_shortcode('tab', 'etheme_tab_shortcode');

function etheme_tab_shortcode($atts, $content = null) {
    global $tab_count;
    $a = shortcode_atts(array(
        'title' => 'Tab',
        'class' => '',
        'active' => 0
    ), $atts);
    
    $class = $a['class'];
    $style = '';
    
    if ($a['active'] == 1)  {
        $style = ' style="display: block;"';
        $class .= 'opened'; 
    }
    
    $tab_count++;
    
    return '<a href="#tab_'.$tab_count.'" id="tab_'.$tab_count.'" class="tab-title ' . $class . '">' . $a['title'] . '</a><div id="content_tab_'.$tab_count.'" class="tab-content" ' . $style . '><div class="tab-content-inner">' . do_shortcode($content) . '</div></div>';
}


// **********************************************************************// 
// ! Dividers
// **********************************************************************// 

add_shortcode('hr','etheme_hr_shortcode');

function etheme_hr_shortcode($atts) {
    $a = shortcode_atts(array(
        'class' => '',
        'height' => ''   
    ),$atts);
    
    return '<hr class="divider '.$a['class'].'" style="height:'.$a['height'].'px;"/>';
}



// **********************************************************************// 
// ! Countdown
// **********************************************************************// 

add_shortcode('countdown','etheme_countdown_shortcode');

function etheme_countdown_shortcode($atts) {
    $a = shortcode_atts(array(
        'class' => '',
        'date' => '31 December 2014 00:00',
        'height' => ''   
    ),$atts);
    
    return '<div class="et-timer" data-final="'.$a['date'].'">
                <div class="time-block">
                    <span class="days">00</span>
                    days
                </div>
                <div class="timer-devider">:</div>
                <div class="time-block">
                    <span class="hours">00</span>
                    hours
                </div>
                <div class="timer-devider">:</div>
                <div class="time-block">
                    <span class="minutes">00</span>
                    minutes
                </div>
                <div class="timer-devider">:</div>
                <div class="time-block">
                    <span class="seconds">00</span>
                    seconds
                </div>
                <div class="clear"></div>
            </div>';
}


// **********************************************************************// 
// ! Tooltip
// **********************************************************************// 

add_shortcode('tooltip', 'etheme_tooltip_shortcode');
function etheme_tooltip_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'position' => 'top',
       'text' => '',
       'class' => ''
   ), $atts );
   
    return '<div class="et-tooltip '.$a['class'].'" rel="tooltip" data-placement="'.$a['position'].'" data-original-title="'.$a['text'].'"><div><div>'.$content.'</div></div></div>';
}

// **********************************************************************// 
// ! Vimeo Video
// **********************************************************************// 

add_shortcode('vimeo', 'etheme_vimeo_shortcode');
function etheme_vimeo_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'src' => '',
        'height' => '500',
        'width' => '900'
    ), $atts);
    if ($a['src'] == '') return;
    return '<div class="vimeo-video" style="width=:' . $a['width'] . 'px; height:' . $a['height'] . 'px;"><iframe width="' . $a['width'] . '" height="' . $a['height'] . '" src="' . $a['src'] . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}

// **********************************************************************// 
// ! Youtube Video
// **********************************************************************// 

add_shortcode('youtube', 'etheme_youtube_shortcode');
function etheme_youtube_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'src' => '',
        'height' => '500',
        'width' => '900'
    ), $atts);
    if ($a['src'] == '') return;
    return '<div class="youtube-video" style="width=:' . $a['width'] . 'px; height:' . $a['height'] . 'px;"><iframe width="' . $a['width'] . '" height="' . $a['height'] . '" src="' . $a['src'] . '" frameborder="0" allowfullscreen></iframe></div>';
}

// **********************************************************************// 
// ! QR Code
// **********************************************************************// 

add_shortcode('qrcode', 'etheme_qrcode_shortcode');
function etheme_qrcode_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'size' => '128',
        'self_link' => 0,
        'title' => 'QR Code',
        'lightbox' => 0,
        'class' => ''
    ), $atts);

    return generate_qr_code($content,$a['title'],$a['size'],$a['class'],$a['self_link'],$a['lightbox']);
}


// **********************************************************************// 
// ! Project links
// **********************************************************************// 

add_shortcode('project_links', 'etheme_project_links');
function etheme_project_links($atts, $content = null) {
    $next_post = get_next_post();
    $prev_post = get_previous_post();
    ?>
        <div class="project-navigation">
            <?php if(!empty($prev_post)) : ?>
                <div class="pull-left prev-project">
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="btn border-grey btn-xmedium project-nav"><?php _e('Previous', ETHEME_DOMAIN); ?></a> 
                    <div class="hide-info">
                        <?php echo get_the_post_thumbnail( $prev_post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ); ?>
                        <span class="price"><?php echo get_the_title($prev_post->ID); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($next_post)) : ?>
                <div class="pull-right next-project">
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="btn border-grey btn-xmedium project-nav"><?php _e('Next', ETHEME_DOMAIN); ?></a>
                    <div class="hide-info">
                    	<span class="price"><?php echo get_the_title($next_post->ID); ?></span>
                        <?php echo get_the_post_thumbnail( $next_post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php
}

// **********************************************************************// 
// ! Share This Product
// **********************************************************************// 

add_shortcode('share', 'etheme_share_shortcode');
if(!function_exists('etheme_share_shortcode')) {
	function etheme_share_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
			'title'  => '',
			'text' => '',
			'tooltip' => 1,
	        'twitter' => 1,
	        'facebook' => 1,
	        'pinterest' => 1,
	        'google' => 1,
	        'mail' => 1,
			'class' => ''
		), $atts));
		global $post;
		if(!isset($post->ID)) return;
	    $html = '';
		$permalink = get_permalink($post->ID);
		$tooltip_class = '';
		if($tooltip) {
			$tooltip_class = 'title-toolip';
		}
		$image =  etheme_get_image( get_post_thumbnail_id($post->ID), 150,150,false);
		$post_title = rawurlencode(get_the_title($post->ID)); 
		if($title) $html .= '<span class="share-title">'.$title.'</span>';
	    $html .= '
	        <ul class="menu-social-icons '.$class.'">
	    ';
	    if($twitter == 1) {
	        $html .= '
	                <li>
	                    <a href="https://twitter.com/share?url='.$permalink.'&text='.$post_title.'" class="'.$tooltip_class.'" title="'.__('Twitter', ET_DOMAIN).'" target="_blank">
	                        <i class="ico-twitter"></i>
	                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
	                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
	                        </svg>
	                    </a>
	                </li>
	        ';
	    }
	    if($facebook == 1) {
	        $html .= '
	                <li>
	                    <a href="http://www.facebook.com/sharer.php?u='.$permalink.'" class="'.$tooltip_class.'" title="'.__('Facebook', ET_DOMAIN).'" target="_blank">
	                        <i class="ico-facebook"></i>
	                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
	                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
	                        </svg>
	                    </a>
	                </li>
	        ';
	    }

	    if($pinterest == 1) {
	        $html .= '
	                <li>
	                    <a href="http://pinterest.com/pin/create/button/?url='.$permalink.'&amp;media='.$image.'&amp;description='.$post_title.'" class="'.$tooltip_class.'" title="'.__('Pinterest', ET_DOMAIN).'" target="_blank">
	                        <i class="ico-pinterest"></i>
	                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
	                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
	                        </svg>
	                    </a>
	                </li>
	        ';
	    }

	    if($google == 1) {
	        $html .= '
	                <li>
	                    <a href="http://plus.google.com/share?url='.$permalink.'&title='.$text.'" class="'.$tooltip_class.'" title="'.__('Google +', ET_DOMAIN).'" target="_blank">
	                        <i class="ico-google-plus"></i>
	                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
	                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
	                        </svg>
	                    </a>
	                </li>
	        ';
	    }

	    if($mail == 1) {
	        $html .= '
	                <li>
	                    <a href="mailto:enteryour@addresshere.com?subject='.$post_title.'&amp;body=Check%20this%20out:%20'.$permalink.'" class="'.$tooltip_class.'" title="'.__('Mail to friend', ET_DOMAIN).'" target="_blank">
	                        <i class="ico-envelope"></i>
	                        <svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle">
	                                <circle cx="19" cy="19" r="18" fill="rgba(255,255,255,0)" stroke="#000000"></circle>
	                        </svg>
	                    </a>
	                </li>
	        ';
	    }
	    
	    $html .= '
	        </ul>
	    ';
		return $html;
	} 
}


/*
add_shortcode('follow', 'etheme_follow_shortcode');

function etheme_follow_shortcode($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'twitter' => '',
		'facebook' => '',
		'pinterest' => '',
		'email' => '',
	), $atts));
	ob_start();
	?>

    <div class="social-icons">

    	<?php if($title){?> 
    	<span><?php echo $title; ?></span>
		<?php }?>

    	<?php if($facebook){?> 
    	<a href="<?php echo $facebook; ?>" target="_blank"  class="icon facebook tip-top" data-tip="Follow us on Facebook"><span class="icon-facebook"></span></a>
		<?php }?>
		<?php if($twitter){?> 
		       <a href="<?php echo $twitter; ?>" target="_blank" class="icon twitter tip-top" data-tip="Follow us on Twitter"><span class="icon-twitter"></span></a>
		<?php }?>
		<?php if($email){?> 
		       <a href="mailto:<?php echo $email; ?>" target="_blank" class="icon email tip-top" data-tip="Send us an email"><span class="icon-envelop"></span></a>
		<?php }?>
		<?php if($pinterest){?> 
		       <a href="<?php echo $pinterest; ?>" target="_blank" class="icon pintrest tip-top" data-tip="Follow us on Pinterest"><span class="icon-pinterest"></span></a>
		<?php }?>
     </div>
    	

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
*/

// **********************************************************************// 
// ! Google Charts
// **********************************************************************// 

add_shortcode('googlechart', 'etheme_googlechart_shortcode');
function etheme_googlechart_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'title' => '',
        'labels' => '',
        'data' => '',
        'type' => 'pie2d',
        'data_colours' => ''
    ), $atts);
    
    switch($a['type']) {
        case 'pie':   
            $type = 'p3';
        break;
        case 'pie2d':   
            $type = 'p';
        break;
        case 'line':   
            $type = 'lc';
        break;
        case 'xyline':   
            $type = 'lxy';
        break;
        case 'scatter':   
            $type = 's';
        break;
    }
    
    $output = '';
    if ($a['title'] != '') $output = '<h2>'. $a['title'] .'</h2>';
    $output .= '<div class="googlechart">';
    $output .= '<img src="http://chart.apis.google.com/chart?cht='.$type.'&chd=t:'.$a['data'].'&chtt=&chl='.$a['labels'].'&chs=600x250&chf=bg,s,65432100&chco='.$a['data_colours'].'" />';
    $output .= '</div>';
    return $output;
}

// **********************************************************************// 
// ! Icon
// **********************************************************************// 

add_shortcode('icon', 'etheme_icon_shortcode');
function etheme_icon_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'name' => 'circle-blank',
        'size' => '',
        'style' => '',
        'color' => '',
        'hover' => 0,
        'class' => ''
    ), $atts);
    
    if($a['hover'] == 1 ) {
        $a['name'] .= ' hover-icon';
    }
    
    return '<i class="fa fa-'.$a['name'].' ' . $a['class'] . '" style="color:'.$a['color'].'; font-size:'.$a['size'].'px; '.$a['style'].'"></i>';
}

// **********************************************************************// 
// ! Image
// **********************************************************************// 

add_shortcode('image', 'etheme_image_shortcode');
function etheme_image_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'src' => '',
        'alt' => '',
        'height' => '',
        'width' => '',
        'class' => ''
    ), $atts);
    
    return '<img src="'.$a['src'].'" alt="'.$a['alt'].'" height="'.$a['height'].'" width="'.$a['width'].'" class="'.$a['class'].'" />';
}

// **********************************************************************// 
// ! Team Member
// **********************************************************************// 

add_shortcode('team_member', 'etheme_team_member_shortcode');
function etheme_team_member_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => '',
        'type' => 1,
        'name' => '',
        'email' => '',
        'twitter' => '',
        'facebook' => '',
        'skype' => '',
        'linkedin' => '',
        'instagram' => '',
        'position' => '',
        'content' => '',
        'img' => '',
        'img_src' => '',
        'img_size' => '270x170'
    ), $atts);

    $src = '';

    $img_size = explode('x', $a['img_size']);

    $width = $img_size[0];
    $height = $img_size[1];

    if($a['img'] != '') {
        $src = etheme_get_image($a['img'], $width, $height);
    }elseif ($a['img_src'] != '') {
        $src = do_shortcode($a['img_src']);
    }

    if ($a['content'] != '') {
        $content = $a['content'];
    }

    
    $html = '';
    $span = 12;
    $html .= '<div class="team-member member-type-'.$a['type'].' '.$a['class'].'">';

        if($a['type'] == 2) {
            $html .= '<div class="row">';
        }
	    if($src != ''){

            if($a['type'] == 2) {
                $html .= '<div class="col-md-6">';
                $span = 6;
            }
            $html .= '<div class="member-image">';
                $html .= '<img src="'.$src.'" />';
            $html .= '</div>';
            $html .= '<div class="clear"></div>';
            if($a['type'] == 2) {
                $html .= '</div>';
            }		      
	    }

    
        if($a['type'] == 2) {
            $html .= '<div class="col-md-'.$span.'">';
        }
        $html .= '<div class="member-details">';
            if($a['position'] != ''){
                $html .= '<h4>'.$a['name'].'</h4>';
            }

		    if($a['name'] != ''){
			    $html .= '<h5 class="member-position">'.$a['position'].'</h5>';
		    }
            if ($a['linkedin'] != '' || $a['twitter'] != '' || $a['facebook'] != '' || $a['skype'] != '' || $a['instagram'] != '') {
                $html .= '<ul class="menu-social-icons">';
                    $html .= '';
                        if ($a['linkedin'] != '') {
                            $html .= '<li><a href="'.$a['linkedin'].'"><i class="ico-linkedin"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
                        }
                        if ($a['twitter'] != '') {
                            $html .= '<li><a href="'.$a['twitter'].'"><i class="ico-twitter"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
                        }
                        if ($a['facebook'] != '') {
                            $html .= '<li><a href="'.$a['facebook'].'"><i class="ico-facebook"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
                        }
                        if ($a['skype'] != '') {
                            $html .= '<li><a href="'.$a['skype'].'"><i class="ico-skype"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
                        }
                        if ($a['instagram'] != '') {
                            $html .= '<li><a href="'.$a['instagram'].'"><i class="ico-instagram"></i><svg width="38" height="38" xmlns="http://www.w3.org/2000/svg" class="circle"><circle cx="19" cy="19" r="18" fill="#fff" stroke="#000000"></circle></svg></a></li>';
                        }
                $html .= '</ul>';
            }
            if($a['email'] != ''){
                $html .= '<p class="member-email"><span>'.__('Email:', ETHEME_DOMAIN).'</span> <a href="'.$a['email'].'">'.$a['email'].'</a></p>';
            }
		    $html .= do_shortcode($content);
    	$html .= '</div>';

        if($a['type'] == 2) {
                $html .= '</div>';
            $html .= '</div>';
        }
    $html .= '</div>';
    
    
    return $html;
}


// **********************************************************************// 
// ! Banner With mask
// **********************************************************************// 

add_shortcode('banner','etheme_banner_shortcode');

function etheme_banner_shortcode($atts, $content) {
    $image = $mask = '';
    $a = shortcode_atts(array(
        'align'  => 'left',
        'valign'  => 'top',
        'class'  => '',
        'link'  => '',
        'hover'  => '',
        'content'  => '',  
        'font_style'  => '',  
        'banner_style'  => '',  
        'responsive_zoom'  => '',  
        'img' => '',
        'img_src' => '',
        'img_size' => '270x170'
    ), $atts);

    $src = '';

    $img_size = explode('x', $a['img_size']);

    $width = $img_size[0];
    $height = $img_size[1];
	$alt = '';
    if($a['img'] != '') {
        $src = etheme_get_image($a['img'], $width, $height);
        $alt = get_post_meta( $a['img'], '_wp_attachment_image_alt', true );
    }elseif ($a['img_src'] != '') {
        $src = do_shortcode($a['img_src']);
    }

    if ($a['banner_style'] != '') {
      $a['class'] .= ' style-'.$a['banner_style'];
    }

    if ($a['align'] != '') {
      $a['class'] .= ' align-'.$a['align'];
    }

    if ($a['valign'] != '') {
      $a['class'] .= ' valign-'.$a['valign'];
    }

    if($a['responsive_zoom']) {
    	$a['class'] .= ' responsive-fonts';
    }

    $onclick = '';
    if($a['link'] != '') {
        $a['class'] .= ' cursor-pointer';
        $onclick = 'onclick="window.location=\''.$a['link'].'\'"';
    }
    
    return '<div class="banner '.$a['class'].' banner-font-'.$a['font_style'].' hover-'.$a['hover'].'" '.$onclick.'><div class="banner-content"><div class="banner-inner">'.do_shortcode($content).'</div></div><img src="'.$src.'" alt="'.$alt.'"/></div>';
}

// **********************************************************************// 
// ! Progress Bar
// **********************************************************************// 

add_shortcode('progress','etheme_progress_shortcode');

function etheme_progress_shortcode($atts) {
    $a = shortcode_atts(array(
        'complete' => '',
        'color' => '',
        'title'    => ''    
    ),$atts);

    $style = '';
    
    if($a['complete'] > 100) {
        $a['complete'] = 100;
    }elseif($a['complete'] < 0) {
        $a['complete'] = 0;
    }

    if ($a['color'] != '') {
        $style = 'background-color:'.$a['color'];
    }
    
    return '<div class="progress-bars"><div class="progress-bar" data-width="'.$a['complete'].'" style="'.$style.'"><span>'.$a['title'].'</span><div></div></div></div>';
}



// **********************************************************************// 
// ! Google Font
// **********************************************************************// 

add_shortcode('googlefont','etheme_googlefont_shortcode');
$registerd_fonts = array();

function etheme_googlefont_shortcode($atts, $content = null) {
	global $registerd_fonts;
    $a = shortcode_atts(array(
        'name' => 'Open Sans',
        'size' => '',
        'color' => '',
        'class' => ''
    ),$atts);
    $google_name = str_replace(" ", "+", $a['name']);
    if (!in_array($google_name, $registerd_fonts)) {
    	$registerd_fonts[] = $google_name;
	    ?>
	    <link rel='stylesheet'  href='http://fonts.googleapis.com/css?family=<?php echo $google_name; ?>' type='text/css' media='all' />
	    <?php
    }
    
    //wp_enqueue_style($google_name,"http://fonts.googleapis.com/css?family=".$google_name);
    return '<span class="google-font '.$a['class'].'" style="font-family:'.$a['name'].'; color:'.$a['color'].'; font-size:'.$a['size'].'px;">'.do_shortcode($content).'</span>';
}

// **********************************************************************// 
// ! Pricing Tables
// **********************************************************************// 

add_shortcode('ptable','etheme_ptable_shortcode');

function etheme_ptable_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => '',
        'style' => 2,
        'columns' => 1,
        'content' => ''
    ),$atts);
    return '<div class="pricing-table columns'.$a['columns'].' '.$a['class'].' style'.$a['style'].'">'.do_shortcode($content.$a['content']).'</div>';
}

// **********************************************************************// 
// ! Single post
// **********************************************************************// 

add_shortcode('single_post','etheme_featured_post_shortcode');

function etheme_featured_post_shortcode($atts) {
    $a = shortcode_atts(array(
        'title' => '',
        'id' => '',
        'class' => '',
        'more_posts' => 1
    ),$atts);
    $limit = 1;
    $width = 300;
    $height = 300;
    $lightbox = etheme_get_option('blog_lightbox');
    $blog_slider = etheme_get_option('blog_slider');
    $posts_url = get_permalink(get_option('page_for_posts'));
    $args = array(
        'p'                     => $a['id'],
        'post_type'             => 'post',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'         => 1,
        'posts_per_page'        => $limit
    );

    $the_query = new WP_Query( $args ); 
    ob_start();
    ?>

    <?php if ( $the_query->have_posts() ) : ?>

        <?php while ( $the_query->have_posts() ) : $the_query->the_post();  $postId = get_the_ID(); ?>

            <div class="featured-posts <?php echo $a['class']; ?>">
                <?php if ($a['title'] != ''): ?>
                    <h3 class="title a-left"><span><?php echo $a['title']; ?></span></h3>
                    <?php if ($a['more_posts']): ?>
                            <?php echo '<a href="'.$posts_url.'" class="show-all-posts hidden-tablet hidden-phone">'.__('View more posts', ETHEME_DOMAIN).'</a>'; ?>
                    <?php endif ?>
                <?php endif ?>
                <div class="featured-post row">
                    <div class="col-md-6">
                        <?php 
                            $width = etheme_get_option('blog_page_image_width');
                            $height = etheme_get_option('blog_page_image_height');
                            $crop = etheme_get_option('blog_page_image_cropping');
                        ?>

                        <?php $images = etheme_get_images($width,$height,$crop); ?>

                        <?php if (count($images)>0 && has_post_thumbnail()): ?>
                            <div class="post-images nav-type-small<?php if (count($images)>1): ?> images-slider<?php endif; ?>">
                                <ul class="slides">
                                     <li><a href="<?php the_permalink(); ?>"><img src="<?php echo $images[0]; ?>"></a></li>
                                </ul>
                                <div class="blog-mask">
                                    <div class="mask-content">
                                        <?php if($lightbox): ?><a href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>" rel="lightbox"><i class="fa fa-resize-full"></i></a><?php endif; ?>
                                        <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-md-6">
                        <h4 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="post-info">
                            <span class="posted-on">
                                <?php _e('Posted on', ETHEME_DOMAIN) ?>
                                <?php the_time(get_option('date_format')); ?> 
                                <?php _e('at', ETHEME_DOMAIN) ?> 
                                <?php the_time(get_option('time_format')); ?>
                            </span> 
                            <span class="posted-by"> <?php _e('by', ETHEME_DOMAIN);?> <?php the_author_posts_link(); ?></span>
                        </div>
                        <div class="post-description">
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="button read-more"><?php _e('Read More', ETHEME_DOMAIN) ?></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>

    <?php else:  ?>

        <p><?php _e( 'Sorry, no posts matched your criteria.', ETHEME_DOMAIN ); ?></p>

    <?php endif; ?>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;

}

// **********************************************************************// 
// ! Static Block Shortcode
// **********************************************************************// 

add_shortcode('block','etheme_block_shortcode');

function etheme_block_shortcode($atts) {
    $a = shortcode_atts(array(
        'class' => '',
        'id' => ''
    ),$atts);

    return et_get_block($a['id']);
}

// **********************************************************************// 
// ! Recent posts widget shortcode 
// **********************************************************************// 

add_shortcode('et_recent_posts_widget','etheme_recent_posts_widget_shortcode');

function etheme_recent_posts_widget_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'title' => '', 
        'number' => 5, 
        'slider' => 0
    ),$atts);
    
    $widget = new Etheme_Recent_Posts_Widget();

    $args = array(
        'before_widget' => '<div class="sidebar-widget etheme_widget_recent_entries">',
        'after_widget' => '</div><!-- //sidebar-widget -->',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'widget_id' => 'etheme_widget_recent_entries',
    ); 
    $instance = array(
        'title' => $a['title'],
        'number' => $a['number'],
        'slider' => $a['slider']
    );

    ob_start();
    $widget->widget($args, $instance);
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}

// **********************************************************************// 
// ! Recent comments widget shortcode 
// **********************************************************************// 

add_shortcode('et_recent_comments','etheme_recent_comments_shortcode');

function etheme_recent_comments_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'title' => '', 
        'number' => 5
    ),$atts);
    
    $widget = new Etheme_Recent_Comments_Widget();

    $args = array(
        'before_widget' => '<div class="sidebar-widget etheme_widget_recent_comments">',
        'after_widget' => '</div><!-- //sidebar-widget -->',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'widget_id' => 'etheme_widget_recent_comments',
    ); 
    $instance = array(
        'title' => $a['title'],
        'number' => $a['number']
    );

    ob_start();
    $widget->widget($args, $instance);
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}


// **********************************************************************// 
// ! Icon Box
// **********************************************************************// 

add_shortcode('icon_box','etheme_icon_box_shortcode');

function etheme_icon_box_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'title' => '', 
        'icon' => 'bolt', 
        'icon_position' => 'left',
        'icon_style' => '',
        'color' => '', 
        'bg_color' => '', 
        'color_hover' => '', 
        'bg_color_hover' => '', 
        'text' => ''
    ),$atts);
    
    $box_id = rand(1000,10000);
        
    
    $output = '';
    $output .= '<div class="block-with-ico ico-box-'.$box_id.' ico-position-'.$a['icon_position'].' ico-style-'.$a['icon_style'].'">';
        $output .= '<i class="fa fa-'.$a['icon'].'" ></i>';
        $output .= '<div class="ico-box-content">';
        $output .= '<h5>'.$a['title'].'</h5>';
        $output .= do_shortcode($content).do_shortcode($a['text']);
        $output .= '</div>';
    $output .= '</div>';
    $output .= '<style>';
    $output .= '.ico-box-'.$box_id.' i {';
    if($a['color'] != '') {
	    $output .= 'color:'.$a['color'].'!important;';
    }
    if($a['bg_color'] != '') {
	    $output .= 'background:'.$a['bg_color'].'!important;';
    }
    $output .= '}';
    $output .= '.ico-box-'.$box_id.':hover i {';
    if($a['color_hover'] != '') {
    	$output .= 'color:'.$a['color_hover'].'!important;';
    }
    if($a['bg_color_hover'] != '') {
    	$output .= 'background:'.$a['bg_color_hover'].'!important;';
    }
    $output .= '}';
    $output .= '</style>';

    
    return $output;
}



// **********************************************************************// 
// ! Follow
// **********************************************************************// 

add_shortcode('follow','et_follow_shortcode');

function et_follow_shortcode($atts) {
    extract(shortcode_atts(array(
        'title'  => '',
        'size' => 'normal',
        'target' => '_blank',
        'facebook' => '',
        'twitter' => '',
        'instagram' => '',
        'google' => '',
        'pinterest' => '',
        'linkedin' => '',
        'tumblr' => '',
        'youtube' => '',
        'vimeo' => '',
        'rss' => '',
        'colorfull' => '',
        'class' => '',
    ), $atts));

    $class .= ' buttons-size-'.$size;

    if( $colorfull ) {
        $class .= ' icons-colorfull';
    }

    $target = 'target="' . $target . '"';

    $output = '<div class="et-follow-buttons '.$class.'">';

    if( $facebook ) {
        $output .= '<a href="'. esc_url( $facebook ) .'" class="follow-facebook" '.$target.'><i class="fa fa-facebook"></i></a>';
    }

    if( $twitter ) {
        $output .= '<a href="'. esc_url( $twitter ) .'" class="follow-twitter" '.$target.'><i class="fa fa-twitter"></i></a>';
    }

    if( $instagram ) {
        $output .= '<a href="'. esc_url( $instagram ) .'" class="follow-instagram" '.$target.'><i class="fa fa-instagram"></i></a>';
    }

    if( $google ) {
        $output .= '<a href="'. esc_url( $google ) .'" class="follow-google" '.$target.'><i class="fa fa-google"></i></a>';
    }

    if( $pinterest ) {
        $output .= '<a href="'. esc_url( $pinterest ) .'" class="follow-pinterest" '.$target.'><i class="fa fa-pinterest"></i></a>';
    }

    if( $linkedin ) {
        $output .= '<a href="'. esc_url( $linkedin ) .'" class="follow-linkedin" '.$target.'><i class="fa fa-linkedin"></i></a>';
    }

    if( $tumblr ) {
        $output .= '<a href="'. esc_url( $tumblr ) .'" class="follow-tumblr" '.$target.'><i class="fa fa-tumblr"></i></a>';
    }

    if( $youtube ) {
        $output .= '<a href="'. esc_url( $youtube ) .'" class="follow-youtube" '.$target.'><i class="fa fa-youtube"></i></a>';
    }

    if( $vimeo ) {
        $output .= '<a href="'. esc_url( $vimeo ) .'" class="follow-vimeo" '.$target.'><i class="fa fa-vimeo"></i></a>';
    }

    if( $rss ) {
        $output .= '<a href="'. esc_url( $rss ) .'" class="follow-rss" '.$target.'><i class="fa fa-rss"></i></a>';
    }

    $output .= '</div>';

    return $output;

}


?>
