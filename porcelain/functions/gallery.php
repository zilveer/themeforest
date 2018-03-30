<?php

/**
 * This file contains all the main functions thar are used for the Portfolio
 * Gallery page and the Quick Gallery (the default WordPress gallery).
 *
 * PORTFOLIO GALLERY FUNCTIONS:
 *
 * HTML FUNCTIONS:
 *  pexeto_get_gallery_thumbnail_html
 *  pexeto_get_gallery_pagination_html
 *  pexeto_get_portfolio_slider_item_html
 *  pexeto_get_portfolio_carousel_html
 *
 * GENERAL FUNCTIONS :
 *  pexeto_get_portfolio_gallery_query
 *  pexeto_get_portfolio_slider_images
 *  pexeto_get_post_gallery_images
 *  pexeto_get_portfolio_items_map
 *  pexeto_remove_gallery_from_content
 *
 * AJAX FUNCTIONS:
 *  pexeto_ajax_get_portfolio_items
 *  pexeto_ajax_get_portfolio_slider_item
 *  pexeto_ajax_get_slider_images
 *
 * ----------------------------------------
 * QUICK GALLERY FUNCTIONS:
 *
 * HTML FUNCTIONS :
 *  pexeto_print_gallery
 *
 * GENERAL FUNCTIONS:
 *  pexeto_get_gallery_attachments
 *
 * ----------------------------------------
 * OTHER FUNCTIONS:
 *
 */

add_filter( 'post_gallery', 'pexeto_print_gallery', 10, 2 );
add_action( 'wp_ajax_pexeto_get_portfolio_items', 'pexeto_ajax_get_portfolio_items' );
add_action( 'wp_ajax_nopriv_pexeto_get_portfolio_items', 'pexeto_ajax_get_portfolio_items' );

add_action( 'wp_ajax_pexeto_get_portfolio_slider_item', 'pexeto_ajax_get_portfolio_slider_item' );
add_action( 'wp_ajax_nopriv_pexeto_get_portfolio_slider_item', 'pexeto_ajax_get_portfolio_slider_item' );

add_action( 'wp_ajax_pexeto_get_slider_images', 'pexeto_ajax_get_slider_images' );
add_action( 'wp_ajax_nopriv_pexeto_get_slider_images', 'pexeto_ajax_get_slider_images' );


/**---------------------------------------------------------------------------
 * PORTFOLIO GALLERY HTML FUNCTIONS
 *--------------------------------------------------------------------------*/

if ( !function_exists( 'pexeto_get_gallery_thumbnail_html' ) ) {

	/**
	 * Generates the HTML code for a gallery thumbnail item.
	 *
	 * @param object  $post         the post that will represent the gallery item
	 * @param int     $columns      the number of columns of items the gallery will contain
	 * @param int     $image_height the height of the thumbnail image
	 * @param string  $itemclass    the class of the wrapping div
	 * @return string               the generated HTML code for the item
	 */
	function pexeto_get_gallery_thumbnail_html( $post, $columns, $image_height, $itemclass='pg-item' ) {

		$size_key = $itemclass == 'pc-item' ? 'carousel' : 'gallery';
		$size_options = pexeto_get_image_size_options($columns, $size_key);

		$image_width = $size_options['width'];
		$settings = pexeto_get_post_meta( $post->ID, array( 'type' ), PEXETO_PORTFOLIO_POST_TYPE );
		$exclude_info = pexeto_option( 'portfolio_exclude_info' );
		$add_class = sizeof( $exclude_info ) == 2 ? ' pg-info-dis' : '';

		$html='<div class="'.$itemclass.$add_class.'" data-defwidth="'.( $image_width+10 ).'"'.
			' data-type="'.$settings['type'].'"'.
			' data-itemid="'.$post->ID.'">';


		$preview = pexeto_get_portfolio_preview_img( $post->ID );

		$crop = $image_height ? true : false;

		//retrieve the image URL
		if ( $preview['custom'] ) {
			//use the original image set
			$img_url = $preview['img'];
		}else {
			//use a resized image
			$big_image_width = $image_width + 200;
			$big_image_height = empty($image_height)?$image_height:$image_height*($image_width+200)/$image_width;
			$img_url = pexeto_get_resized_image( $preview['img'],
				$big_image_width,
				$big_image_height );
		}

		//load the categories assigned to the item
		$terms=wp_get_post_terms( $post->ID, PEXETO_PORTFOLIO_TAXONOMY );
		$term_names=array();
		foreach ( $terms as $term ) {
			$term_names[]=$term->name;
		}

		$href='#';
		$rel='';
		//set the link of the item according to its type
		switch ( $settings['type'] ) {
		case 'smallslider':
		case 'fullslider':
		case 'standard':
		case 'fullvideo':
		case 'smallvideo':
			$href = get_permalink( $post->ID );
			break;
		case 'custom':
			$href = pexeto_get_single_meta( $post->ID, 'custom_link' );
			break;
		case 'lightbox':
			$href = $preview['img'];
			//gallery items should be in a group in the lightbox preview
			$add_rel = $itemclass == 'pg-item'?'[group]':'';
			$rel = ' rel="pglightbox'.$add_rel.'"';
		}

		$alt = isset($preview['alt']) ? $preview['alt'] : $post->post_title;


		$html.='<a href="'.$href.'" title="'.$post->post_title.'"'.$rel.' >'.
			'<div class="pg-img-wrapper">';
			//add the item icon
			$html.='<span class="icon-circle">'.
			'<span class="pg-icon '.$settings['type'].'-icon"></span>'.
			'</span>'.
			'<img src="'.$img_url.'" alt="'.esc_attr($alt).'"/></div>';

		


			//display the item info
			$html.='<div class="pg-info">';
			$html.='<div class="pg-details'.$add_class.'">';
			if ( !in_array( 'title', $exclude_info ) ) {
				$html.='<h2>'.$post->post_title.'</h2>';
			}
			if ( !in_array( 'category', $exclude_info ) ) {
				$html.='<span class="pg-categories">'.implode( ' / ', $term_names ).'</span>';
			}
			$html.='</div></div>';
		

		$html.='</a></div>';

		return $html;
	}
}


if ( !function_exists( 'pexeto_get_gallery_pagination_html' ) ) {

	/**
	 * Generates the gallery pagination HTML code.
	 *
	 * @param object  $query          the WP Query used to load the items in
	 * the gallery
	 * @param int     $posts_per_page the number of posts(items) per page
	 * @param int     $current        the current page number
	 * @param string  $page_url       the URL of the gallery page
	 * @return string                 the HTML code of the pagination
	 */
	function pexeto_get_gallery_pagination_html( $query, $posts_per_page, $current, $page_url ) {
		$html = '';
		$page_num = $query->max_num_pages;

		$html.='<ul>';
		if ( $page_num>1 ) {
			for ( $i=1; $i<=$page_num; $i++ ) {
				$add_class = $i==$current?' class="current"':'';
				$html.='<li><a href="'.esc_url(add_query_arg( 'set', $i, $page_url ))
					.'" data-page="'.$i.'" '.$add_class.'>'.$i.'</a></li>';
			}
		}
		$html.='</ul>';

		return $html;
	}
}

if ( !function_exists( 'pexeto_get_portfolio_slider_item_html' ) ) {

	/**
	 * Generates the gallery slider HTML code.
	 *
	 * @param int     $itemid the ID of the item(post) that will represent the slider
	 * @param boolean $single setting whether it is a single item page or the
	 * slider was loaded from the gallery, as part of the gallery
	 * @return string          the HTML code of the slider
	 */
	function pexeto_get_portfolio_slider_item_html( $itemid, $single=true ) {
		$html = '';
		global $post;
		if ( empty( $post ) || $post->ID !== $itemid ) {
			$post = get_post( $itemid );
		}

		$item_type = pexeto_get_single_meta( $itemid, 'type' );
		$fullwidth = $item_type=='fullslider' || $item_type=='fullvideo'?true:false;
		$video = $item_type=='fullvideo' || $item_type=='smallvideo'?true:false;
		$content_class = $video ? 'ps-video':'ps-images';

		$preview = pexeto_get_portfolio_preview_img( $post->ID );

		if ( !empty( $post ) ) {
			$add_class = $fullwidth ? ' ps-fullwidth':'';

			$html = '<div class="ps-wrapper'.$add_class.'">';

			//add the slider
			$html.='<div class="'.$content_class.'">';
			if ( $video ) {
				global $pexeto_content_sizes;
				$width = $fullwidth ?
					$pexeto_content_sizes['fullwidth'] : $pexeto_content_sizes['sliderside'];
				$video_url=pexeto_get_single_meta( $itemid, 'video' );
				$html.=pexeto_get_video_html( $video_url, $width );
			}
			$html.='</div>';

			//add the content
			$html.='<div class="ps-content">';

			//get the categories
			//load the categories assigned to the item
			$terms=wp_get_post_terms( $post->ID, PEXETO_PORTFOLIO_TAXONOMY );
			$term_names=array();
			foreach ( $terms as $term ) {
				$term_names[]=$term->name;
			}

			//add the title and content_class
			$html.='<h2 class="ps-title">'.$post->post_title.'</h2>';
			$content = pexeto_option( 'ps_strip_gallery' ) ?
				pexeto_remove_gallery_from_content( $post->post_content ) :
				$post->post_content;
			$html.='<span class="ps-categories">'.implode( ' / ', $term_names ).'</span>';
			$html.='<div class="ps-content-text">'.
				do_shortcode( apply_filters( 'the_content', $content ) ).'</div>';

			//add the share buttons
			$share = pexeto_get_share_btns_html( $itemid, 'slider' );
			if ( !empty( $share ) ) {
				$html.='<div class="ps-share">'.$share.'</div>';
			}
			$html.='</div>';
			$html.='<div class="clear"></div></div>';
		}

		return $html;
	}
}

if(!function_exists('pexeto_get_portfolio_slider_item_navigation')){
	function pexeto_get_portfolio_slider_item_navigation($itemid){
		//add the buttons for navigation within the gallery
		$html='<div class="ps-navigation">';
		$p_dis_class='';
		$n_dis_class='';

		
		if ( ( isset( $_GET['prev'] ) && ( $_GET['prev']==='false' || $_GET['prev']==false ) ) ) {
			$p_dis_class=' disabled';
		}
		$prev_text = __( 'Prev Project', 'pexeto' );
		$html.='<div class="ps-nav-wrapper"><a href="#" rel="prev" class="ps-prev-project-link'.$p_dis_class
			.'"><span class="ps-icon icon-arrow-left"></span><span class="ps-nav-text">'.$prev_text.'</span></a>';
		if ( ( isset( $_GET['next'] ) && ( $_GET['next']==='false' || $_GET['next']==false ) ) ) {
			$n_dis_class=' disabled';
		}

		$html.='<div class="ps-back"><a href="#" rel="back" class="ps-back-link">'.
			'<span class="ps-icon"></span> <span class="ps-back-text">'.__( 'Back to gallery', 'pexeto' ).'</span></a></div>';
		

		$next_text = __( 'Next project', 'pexeto' );
		$html.='<a href="#" rel="next" class="ps-next-project-link'.$n_dis_class.'"><span class="ps-icon icon-arrow-right"></span><span class="ps-nav-text">'.$next_text.'</span></a></div>';
		$html.='<div class="clear"></div></div>';

		return $html;
	}
}


if ( !function_exists( 'pexeto_get_portfolio_carousel_html' ) ) {

	/**
	 * Loads the portfolio carousel HTML code.
	 *
	 * @param int     $itemid the ID of the post that will contain the carousel
	 * @return string         the HTML code of the carousel.
	 */
	function pexeto_get_portfolio_carousel_html( $itemid ) {

		if ( !pexeto_option( 'portfolio_show_carousel' ) ) {
			return '';
		}

		$args= array(
			'posts_per_page' => pexeto_option( 'portfolio_carousel_num_items' ),
			'post_type' => PEXETO_PORTFOLIO_POST_TYPE,
			'orderby' => pexeto_option( 'portfolio_carousel_order_by' ),
			'order' => pexeto_option( 'portfolio_carousel_order' ),
			'post__not_in' => array( $itemid )
		);

		$cats = pexeto_option( 'portfolio_carousel_cat' );

		if ( $cats=='related' ) {
			//load all the items from the same category as the current item
			$terms = array();
			$item_terms = wp_get_post_terms( $itemid, PEXETO_PORTFOLIO_TAXONOMY );
			foreach ( $item_terms as $term ) {
				$terms[]=$term->term_id;
			}
		}elseif ( $cats!='all' ) {
			//load the selected categories only
			$cats = pexeto_get_actual_term_id($cats, PEXETO_PORTFOLIO_TAXONOMY );
			$terms = array( $cats );
		}

		if ( !empty( $terms ) ) {

			$args['tax_query'] = array(
				array(
					'taxonomy' => PEXETO_PORTFOLIO_TAXONOMY,
					'field' => 'id',
					'terms' => $terms,
					'operator' => 'IN'
				)
			);
		}

		$posts=get_posts( $args );
		$html = pexeto_build_portfolio_carousel_html( $posts, __( 'Related Projects', 'pexeto' ) );
		return $html;
	}
}



/**---------------------------------------------------------------------------
 * PORTFOLIO GALLERY GENERAL FUNCTIONS
 *--------------------------------------------------------------------------*/


if ( !function_exists( 'pexeto_get_portfolio_gallery_query' ) ) {

	/**
	 * Generates a WP Query object with the arguments set
	 *
	 * @param array   $args the arguments for the query:
	 * - number : number of posts to load
	 * - page : current page number
	 * - order_by : order by parameter (date/menu_order)
	 * - order : how to order the items (ASC/DESC)
	 * - cat : the slug of the category that should be loaded
	 * - excludeCats : array containing the IDs of the categories that
	 * should be excluded
	 * - slider_only : set to true if slider items should be loaded only
	 * @return object       a WP_Query object with the arguments set
	 */
	function pexeto_get_portfolio_gallery_query( $args ) {
		extract( $args );
		$number = isset( $number ) && is_numeric( $number ) ? $number : 10;
		$page = isset( $page ) && is_numeric( $page ) ? $page : 1;
		$order_by = isset( $orderby ) ? $orderby : 'date';
		if ( $order_by=='menu_order' ) {
			$order_by.=' title';  //add an additional order by option
		}
		$order = isset( $order ) ? $order : 'DESC';

		$query_args = array(
			'post_type' => PEXETO_PORTFOLIO_POST_TYPE,
			'paged' => $page,
			'posts_per_page'=>$number,
			'post_status'=>'publish',
			'orderby' => $order_by,
			'order' => $order,
			'suppress_filters' => false
		);

		if ( isset( $cat ) && $cat!=-1 ) {
			//include a category
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => PEXETO_PORTFOLIO_TAXONOMY,
					'field' => 'slug',
					'terms' => $cat
				)
			);
		}
		if ( !empty( $excludeCats ) ) {
			if ( !isset( $query_args['tax_query'] ) ) {
				$query_args['tax_query'] = array();
			}
			//exclude categories
			$query_args['tax_query'][]= array(
				'taxonomy' => PEXETO_PORTFOLIO_TAXONOMY,
				'field' => 'id',
				'terms' => $excludeCats,
				'operator' => 'NOT IN'
			);
		}

		if ( isset( $slider_only ) && $slider_only===true ) {
			//load only the slider items
			$query_args['meta_query'] = array(
				array(
					'key' => PEXETO_META_PREFIX.'type',
					'value' => array( 'smallslider', 'fullslider', 'smallvideo', 'fullvideo' ),
					'compare' => 'IN'
				)
			);
		}

		return new WP_Query( $query_args );

	}
}


if ( !function_exists( 'pexeto_get_portfolio_slider_images' ) ) {

	/**
	 * Loads all the images that are part of the slider item.
	 * @param  int $itemid the ID of the item (post) that contains the slider
	 * @return array         an array with all the images with the following keys:
	 * - img : the image URL
	 * - desc : the image description
	 */
	function pexeto_get_portfolio_slider_images( $itemid ) {
		$post = get_post( $itemid );
		$images = pexeto_get_post_gallery_images( $post );
		$type = pexeto_get_single_meta( $itemid, 'type' );
		if ( $type=='lightbox' ) {
			$autoresize = false;
		}elseif ( $type=='fullslider' ) {
			$autoresize = pexeto_option( 'ps_full_auto_resize' );
		}else {
			$autoresize = pexeto_option( 'ps_side_auto_resize' );
		}

		if ( $autoresize ) {
			//get the image width and height
			global $pexeto_content_sizes;
			$width_key = $type=='fullslider'?'fullwidth':'sliderside';
			$width = $pexeto_content_sizes[$width_key];
			$height_key = $type=='fullslider'?'ps_full_height':'ps_side_height';
			$height = pexeto_option( $height_key );
		}
		$res = array();

		foreach ( $images as $img ) {
			$img_src = wp_get_attachment_image_src($img->ID, 'full');
			$img_url = $img_src[0];
			if ( $autoresize ) {
				$img_url = pexeto_get_resized_image( $img_url, $width, $height );
			}
			$res[]=array( 'img'=>$img_url, 'desc'=>$img->pexeto_desc );
		}

		return $res;
	}
}


if ( !function_exists( 'pexeto_get_post_gallery_images' ) ) {
	/**
	 * Loads the post images into an array. First checks for a gallery inserted
	 * in the content of the post. If there is a gallery, loads the gallery images.
	 * If there isn't a gallery, loads the post attachment images. If there aren't
	 * attachment images, loads the featured image of the post (if it set).
	 *
	 * @param unknown $post the post object
	 * @return array containing the attachment(image) objects
	 */
	function pexeto_get_post_gallery_images( $post ) {
		$pattern = get_shortcode_regex();
		$ids = array();
		$images = array();

		//check if there is a gallery shortcode included
		if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
			&& array_key_exists( 2, $matches )
			&& in_array( 'gallery', $matches[2] ) ) {

			$key = array_search( 'gallery', $matches[2] );
			$att_text = $matches[3][$key];
			$atts = shortcode_parse_atts( $att_text );
			if ( !empty( $atts['ids'] ) ) {
				$ids = explode( ',' , $atts['ids'] );
			}
		}

		$args = array(
			'post_type' => 'attachment',
			'post_mime_type' =>'image',
			'numberposts' =>-1
		);

		if ( !empty( $ids ) ) {
			//there is a gallery shortcode included
			$args['post__in'] = $ids;
		}else {
			//there is no gallery shortcode included, load the item attachments
			$args['post_parent'] = $post->ID;
			$args['orderby'] = 'menu_order';
			$args['order'] = 'ASC';
		}

		$images = get_posts( $args );

		if ( empty( $images ) && has_post_thumbnail( $post->ID ) ) {
			$att_id = get_post_thumbnail_id( $post->ID );
			$att = get_post( $att_id );
			if ( !empty( $att->post_content ) ) {
				$att->pexeto_desc=$att->post_content;
			}
			$images[]=$att;
			return $images;
		}

		if ( !empty( $ids ) ) {
			//the images are added via the gallery shortcode, order them as set in their IDs attribute
			
			if(sizeof($images)==sizeof($ids)){
				$ordered_images = array_fill( 0, sizeof( $images ), null );

				foreach ( $images as $img ) {
					$index = array_search( $img->ID, $ids );
					$ordered_images[$index] = $img;
				}

				$images = $ordered_images;
			}else{
				//overcome the WP bug about not removing the deleted images IDs
				//from the gallery shortcode
				$ordered_images=array();

				foreach ($ids as $id) {
					foreach ($images as $img) {
						if($img->ID == $id){
							$ordered_images[]=$img;
							break;
						}
					}
				}
			}
			

		}

		//set the description of the image
		foreach ( $images as &$img ) {
			if ( !empty( $img->post_content ) ) {
				// the descrtiption field of the image is set
				$img->pexeto_desc=$img->post_content;
			}elseif ( !empty( $img->post_excerpt ) ) {
				// the caption field of the image is set
				$img->pexeto_desc=$img->post_excerpt;
			}else {
				$img->pexeto_desc='';
			}
		}

		return $images;

	}
}



if ( !function_exists( 'pexeto_get_portfolio_items_map' ) ) {

	/**
	 * Loads a map with the IDs of the items (posts) that are from the
	 * slider type. Used for the previous/next project navigation.
	 * @param  array  $args the arguments that will be set to the query:
	 * - order_by : order by parameter (date/menu_order)
	 * - order : how to order the items (ASC/DESC)
	 * - excludeCats : array containing the IDs of the categories that
	 * should be excluded
	 * - slider_only : set to true if slider items should be loaded only
	 * @return array       containing the IDs of the items in the order
	 * in which they should be displayed.
	 */
	function pexeto_get_portfolio_items_map( $args=array() ) {
		$args['number']=-1;
		$args['page']=1;
		$args['slider_only']=true;
		$map_query = pexeto_get_portfolio_gallery_query( $args );
		$items = array();
		while ( $map_query->have_posts() ) {
			$map_query->the_post();
			$items[]=$map_query->post->ID;
		}

		return $items;
	}

}





if ( !function_exists( 'pexeto_remove_gallery_from_content' ) ) {

	/**
	 * Strips the first gallery shortcode from the content of the item.
	 * @param  string $content the content to strip the shortcode from
	 * @return string          the content without the gallery shortcode.
	 */
	function pexeto_remove_gallery_from_content( $content ) {
		$pattern = '/\[.?gallery[^\]]*\]/';

		$content = preg_replace( $pattern, '', $content, 1 );

		return $content;
	}
}


/**---------------------------------------------------------------------------
 * PORTFOLIO GALLERY AJAX FUNCTIONS
 *--------------------------------------------------------------------------*/



if ( !function_exists( 'pexeto_ajax_get_portfolio_items' ) ) {

	/**
	 * AJAX request handler function - loads the requested portfolio items with
	 * the arguments set in the GET request:
	 * - number - the number of items per page
	 * - page - the current page number
	 * - columns - the number of columns the images are located into
	 * - imgheight - default image height
	 * - page_url - the URL of the page that requests the items
	 * - orderby - order by (date/menu_order)
	 * - order - ASC/DESC
	 * - cat - category slug, if the items should be loaded from that category
	 * - eclude_cats - an array containing the categories IDs that should be excluded
	 * Loads the items into array, which is converted into a JSON string and echoed
	 * back as a response.
	 */
	function pexeto_ajax_get_portfolio_items() {
		if ( isset( $_GET['number'] )
			&& isset( $_GET['page'] )
			&& isset( $_GET['columns'] )
			&& isset( $_GET['imgheight'] )
			&& isset( $_GET['page_url'] ) ) {

			$res = array();
			$number = is_numeric( $_GET['number'] ) ? $_GET['number'] : 10;
			$page = is_numeric( $_GET['page'] ) ? $_GET['page'] : 1;
			$columns = is_numeric( $_GET['columns'] ) ? $_GET['columns'] : 3;
			$pageurl = $_GET['page_url'];

			$args = array(
				'number' => $number,
				'page' => $page,
				'excludeCats' => isset( $_GET['exclude_cats'] )?$_GET['exclude_cats']:array(),
				'orderby' => $_GET['orderby'],
				'order' => $_GET['order']
			);

			if ( isset( $_GET['cat'] ) ) {
				$args['cat'] = $_GET['cat'];
				$pageurl = add_query_arg( 'cat', $_GET['cat'], $pageurl );
			}

			$pg_query = pexeto_get_portfolio_gallery_query( $args );
			$html = '';

			while ( $pg_query->have_posts() ) {
				$pg_query->the_post();
				$html.=pexeto_get_gallery_thumbnail_html( $pg_query->post, $columns, $_GET['imgheight'] );
			} //end while

			$res['items']=$html;

			if ( isset( $_GET['require_nav'] ) && ( $_GET['require_nav']=="true" || $_GET['require_nav']===true ) ) {
				//load the pagination
				$pag_html = pexeto_get_gallery_pagination_html( $pg_query, $number, 1, $pageurl );
				$res['pagination'] = $pag_html;
			}

			echo json_encode( $res );
			exit;
		}
	}
}



if ( !function_exists( 'pexeto_ajax_get_portfolio_slider_item' ) ) {

	/**
	 * AJAX request handler function which loads the slider data for a portfolio
	 * item. Loads the following data in an array:
	 * - slider : the slider HTML code
	 * - images : an array containing all the images for the slider
	 * - carousel : the carousel HTML code
	 * - permalink : the permalink of the item
	 * The GET request must have an "itemid" set, which contains the item ID.
	 * The result is converted into a JSON string and echoed back as a response.
	 */
	function pexeto_ajax_get_portfolio_slider_item() {
		if ( isset( $_GET['itemid'] ) ) {
			$itemid = intval( $_GET['itemid'] );
			$res = array();
			$single = isset( $_GET['single'] ) && ( $_GET['single']===true || $_GET['single']==='true' ) ?
				true : false;

			if ( $itemid ) {
				$res['slider'] = pexeto_get_portfolio_slider_item_html( $itemid, $single );
				if(!$single){
					$res['slider_nav'] = pexeto_get_portfolio_slider_item_navigation($itemid);
				}
				$res['images'] = pexeto_get_portfolio_slider_images( $itemid );
				$res['carousel'] = pexeto_get_portfolio_carousel_html( $itemid );
				$res['permalink'] = get_permalink( $itemid );
				echo json_encode( $res );
				exit;
			}
		}
	}
}


if ( !function_exists( 'pexeto_ajax_get_slider_images' ) ) {

	/**
	 * Loads the slider images of an item into an array.
	 * The GET request must have an "itemid" set, which contains the item ID.
	 * The result is converted into a JSON string and echoed back as a response.
	 */
	function pexeto_ajax_get_slider_images() {
		if ( isset( $_GET['itemid'] ) ) {
			$itemid = intval( $_GET['itemid'] );

			if ( $itemid ) {
				$res = pexeto_get_portfolio_slider_images( $itemid );
				echo json_encode( $res );
				exit;
			}
		}
	}
}


/**---------------------------------------------------------------------------
 * QUICK GALLERY FUNCTIONS
 *---------------------------------------------------------------------------*/


if ( !function_exists( 'pexeto_print_gallery' ) ) {

	/**
	 * Prints a gallery. Overrides the default WordPress [gallery] shortcode output.
	 *
	 * @param string  $output the output
	 * @param array   $attr   shortcode attributes that set the gallery options
	 * @return string         the gallery markup
	 */
	function pexeto_print_gallery( $output, $attr ) {
		global $post, $pexeto_page, $pexeto_scripts;

		$gallery_settings = array(
			'qg_thumbnail_height' => pexeto_option( 'qg_thumbnail_height_'.$post->post_type ),
			'qg_masonry' => pexeto_option( 'qg_masonry_'.$post->post_type )
		);

		if(pexeto_option('qg_masonry_'.$post->post_type)===true){
			$pexeto_scripts['masonry'] = true;
		}

		//calculate the number of columns
		$columns = isset( $attr['columns'] ) && intval( $attr['columns'] ) ?
			$attr['columns'] : 3;

		$add_class = '';
		//get the gallery container layout
		$layout = isset( $pexeto_page['blog_layout'] ) ?
			$pexeto_page['blog_layout'] :  $pexeto_page['layout'];

		if ( empty( $layout ) ) {
			$layout='full';
		}
		$image_size = pexeto_get_image_size_options( $columns, 'quick_gallery', $layout);
		$image_width = $image_size['width'];

		//get the image height
		if ( $layout == 'twocolumn' || $layout == 'threecolumn' ) {
			//when it is a narrow column in the blog, make the image square
			$image_height = $image_width;
		}elseif ( $gallery_settings['qg_masonry'] === true ) {
			//masonry is enabled, set the height to be dynamic depending on the
			//original image ratio
			$add_class = ' page-masonry';
			$image_height = '';
		}else {
			//masonry is disabled, get the default image height settings
			$image_height = $gallery_settings['qg_thumbnail_height'];
		}



		$html = '<div class="quick-gallery'.$add_class.'">';

		$attachments = pexeto_get_gallery_attachments( $attr, $post->ID );


		if ( empty( $attachments ) ) {
			return '';
		}

		if ( is_feed() ) {
			//return standard list of images in a feed
			$html = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$html .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			}
			return $html;
		}



		foreach ( $attachments as $attachment ) {
			$img =  wp_get_attachment_image_src($attachment->ID, 'full');
			$imgurl = pexeto_get_resized_image( $img[0], $image_width, $image_height );
			$caption = get_post_field( 'post_excerpt', $attachment->ID );
			$add_class = $caption ? '' : ' qg-no-title';

			$html .= '<div class="qg-img'.$add_class.'" data-defwidth="'.$image_width.'"><a href="'
			.$img[0].'" rel="lightbox[group-'.$post->ID.']" title="'
			.htmlspecialchars( $attachment->post_content ).'" ><img src="'
			.$imgurl.'" alt="'.esc_attr(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true)).'"/>';
			$html.='<div class="qg-overlay"><span class="icon-circle"><span class="pg-icon lightbox-icon"></span></span>';
			if ( $caption ) {
				$html.='<span class="qg-title">'.$caption.'</span>';
			}
			$html.='</div></a></div>';
		}

		$html .='<div class="clear"></div></div>';

		return $html;
	}
}

if ( !function_exists( 'pexeto_get_gallery_attachments' ) ) {

	/**
	 * Loads the attachments of a post/page for the gallery shortcode.
	 *
	 * @param array   $attr    the shortcode attributes that will be set for 
	 * retrieving the attachment list
	 * @param int     $post_id the ID of the post for which the attachments are loaded
	 * @return array          containing all the attachment objects
	 */
	function pexeto_get_gallery_attachments( $attr, $post_id ) {

		static $instance = 0;
		$instance++;

		// We're trusting author input, so let's at least make sure it looks like 
		// a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract( shortcode_atts( array(
					'order'      => 'ASC',
					'orderby'    => 'menu_order ID',
					'id'         => $post_id,
					'itemtag'    => 'dl',
					'icontag'    => 'dt',
					'captiontag' => 'dd',
					'columns'    => 3,
					'size'       => 'thumbnail',
					'include'    => '',
					'exclude'    => ''
				), $attr ) );

		$id = intval( $id );
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( !empty( $include ) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array( 
				'include' => $include, 
				'post_status' => 'inherit', 
				'post_type' => 'attachment', 
				'post_mime_type' => 'image', 
				'order' => $order, 
				'orderby' => $orderby
				) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty( $exclude ) ) {
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array( 
				'post_parent' => $id, 
				'exclude' => $exclude, 
				'post_status' => 'inherit', 
				'post_type' => 'attachment', 
				'post_mime_type' => 'image', 
				'order' => $order, 
				'orderby' => $orderby
				) );
		} else {
			$attachments = get_children( array( 
				'post_parent' => $id, 
				'post_status' => 'inherit', 
				'post_type' => 'attachment', 
				'post_mime_type' => 'image', 
				'order' => $order, 
				'orderby' => $orderby
				) );
		}

		return $attachments;
	}
}
