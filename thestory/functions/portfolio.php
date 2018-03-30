<?php
/**
 * This file contains all the portfolio functionality:
 * - registers the custom portfolio post type
 * - registers the custom portfolio catefogory taxonomy
 * - helper portfolio functions
 *
 * @author Pexeto
 */

if ( !defined( 'PEXETO_PORTFOLIO_POST_TYPE' ) )
	define( 'PEXETO_PORTFOLIO_POST_TYPE', 'portfolio' );
if ( !defined( 'PEXETO_PORTFOLIO_POST_SLUG' ) )
	define( 'PEXETO_PORTFOLIO_POST_SLUG', 'portfolio' );  //you can overwrite this option in a child theme,
// after the slug is changed, make sure to refresh (re-save) the permalink settings in Settings -> Permalinks
if ( !defined( 'PEXETO_PORTFOLIO_TAXONOMY' ) )
	define( 'PEXETO_PORTFOLIO_TAXONOMY', 'portfolio_category' );

/**
 * ADD THE ACTIONS
 */
add_action( 'init', 'pexeto_register_portfolio_category' );
add_action( 'init', 'pexeto_register_portfolio_post_type' );
add_action( 'manage_posts_custom_column',  'pexeto_add_custom_portfolio_columns', 10, 2 );


add_filter( 'manage_edit-portfolio_columns', 'pexeto_portfolio_columns' );


if ( !function_exists( 'pexeto_init_portfolio_custom_order' ) ) {
	/**
	 * Registers an order manager to add an easy order functionality to the
	 * portfolio items.
	 */
	function pexeto_init_portfolio_custom_order() {
		$order_manager = new PexetoOrderManager( PEXETO_PORTFOLIO_POST_TYPE );
		$order_manager->init();
	}
}
if ( is_admin() ) {
	pexeto_init_portfolio_custom_order();
}


if ( !function_exists( 'pexeto_register_portfolio_category' ) ) {

	/**
	 * Registers the portfolio category taxonomy.
	 */
	function pexeto_register_portfolio_category() {

		register_taxonomy( PEXETO_PORTFOLIO_TAXONOMY,
			array( PEXETO_PORTFOLIO_POST_TYPE ),
			array( 'hierarchical' => true,
				'label' => 'Portfolio Categories',
				'singular_label' => 'Portfolio Categories',
				'rewrite' => true,
				'query_var' => true
			) );
	}
}


if ( !function_exists( 'pexeto_register_portfolio_post_type' ) ) {

	/**
	 * Registers the portfolio custom type.
	 */
	function pexeto_register_portfolio_post_type() {

		//the labels that will be used for the portfolio items
		$labels = array(
			'name' => _x( 'Portfolio', 'portfolio name', 'pexeto_admin' ),
			'singular_name' => _x( 'Portfolio Item', 'portfolio type singular name', 'pexeto_admin' ),
			'add_new' => _x( 'Add New', 'portfolio', 'pexeto_admin' ),
			'add_new_item' => __( 'Add New Item', 'pexeto_admin' ),
			'edit_item' => __( 'Edit Item', 'pexeto_admin' ),
			'new_item' => __( 'New Portfolio Item', 'pexeto_admin' ),
			'view_item' => __( 'View Item', 'pexeto_admin' ),
			'search_items' => __( 'Search Portfolio Items', 'pexeto_admin' ),
			'not_found' =>  __( 'No portfolio items found', 'pexeto_admin' ),
			'not_found_in_trash' => __( 'No portfolio items found in Trash', 'pexeto_admin' ),
			'parent_item_colon' => ''
		);

		//register the custom post type
		register_post_type( PEXETO_PORTFOLIO_POST_TYPE,
			array( 'labels' => $labels,
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array( 'slug'=>PEXETO_PORTFOLIO_POST_SLUG ),
				'taxonomies' => array( PEXETO_PORTFOLIO_TAXONOMY ),
				'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'page-attributes' ) ) );

	}
}


if ( !function_exists( 'pexeto_portfolio_columns' ) ) {

	/**
	 * Adds a 'Portfolio category' and 'Featured image' columns to the portfolio posts list
	 * in the admin section.
	 *
	 * @param array   $columns the default columns array
	 * @return array containing the default $columns array including the new columns added
	 */
	function pexeto_portfolio_columns( $columns ) {
		$columns['category'] = 'Portfolio Category';
		$columns['featured'] = 'Featured Image';
		return $columns;
	}
}


if ( !function_exists( 'pexeto_add_custom_portfolio_columns' ) ) {

	/**
	 * Prints the new 'Portfolio category' and 'Featured image' columns content to the portfolio
	 * posts list in the admin section.
	 *
	 * @param string  $name the name of the column
	 * @param int     $id   the ID of the current post
	 */
	function pexeto_add_custom_portfolio_columns( $name, $id ) {
		global $post;
		switch ( $name ) {
		case 'category':
			//print the portfolio category
			$cats = get_the_term_list( $post->ID, PEXETO_PORTFOLIO_TAXONOMY, '', ', ', '' );
			echo $cats;
			break;
		case 'featured' :
			//print the featured image
			if ( has_post_thumbnail( $id ) ) {
				$preview_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'thumbnail' );
				$preview = $preview_arr[0]; ?>
				<img src='<?php echo $preview; ?>' width="70" style='display:block; border:3px solid #ccc; margin-bottom:5px;'/>
				<?php
			}
			break;
		}
	}
}


if ( !function_exists( 'pexeto_get_items' ) ) {

	/**
	 * Loads the portfolio items in a new array containing the portfolio categories assgned to each of them.
	 *
	 * @param array   $args the arguments that will be used in the WP Query
	 * @return array containing the portfolio post slugs and the portfolio categories
	 */
	function pexeto_get_items( $args ) {
		$posts = get_posts( $args );
		$res = array();
		foreach ( $posts as $p ) {
			$action = get_post_meta( $p->ID, 'action_value', true );
			if ( $action == 'slider_full_height' || $action == 'slider_full_width' ) {
				$new_post = array( 'slug'=>$p->post_name );
				//set the category
				$terms=wp_get_post_terms( $p->ID, PEXETO_PORTFOLIO_TAXONOMY );
				$term_ids=array();
				foreach ( $terms as $term ) {
					$term_ids[]=intval( $term->term_id );
				}
				$new_post['cat'] = $term_ids;
				$res[]=$new_post;
			}
		}

		return $res;
	}
}

if ( !function_exists( 'pexeto_get_portfolio_preview_img' ) ) {

	/**
	 * Retrieves the main preview image URL of a portfolio item.
	 *
	 * @param int     $id the item(post) ID
	 * @param skip_custom_thumbnail when set to true, it won't check for a custom
	 * thumbnail
	 * @return array containing the image URL as an 'img' key and
	 * a boolean with key 'custom' setting whether the thumbnail was customly set.
	 */
	function pexeto_get_portfolio_preview_img( $id, $skip_custom_thumbnail = false ) {
		$preview = '';
		$custom = false;
		$custom_thumbnail = $skip_custom_thumbnail == false ? pexeto_get_single_meta( $id, 'thumbnail' ) : null;

		if ( !empty( $custom_thumbnail ) ) {
			//a custom thumbnail image URL was set
			$preview = $custom_thumbnail;
			$custom = true;
		}elseif ( has_post_thumbnail( $id ) ) {
			//a featured image was set
			$preview = pexeto_get_featured_image_url( $id );
		}else {
			//retrieve the first image from the attachment list
			$post = get_post( $id );
			$attachments = pexeto_get_post_gallery_images( $post );
			if ( sizeof( $attachments )>0 ) {
				$vals = array_values( $attachments );
				$attachment = array_shift( $vals );
				$src = wp_get_attachment_image_src($attachment->ID, 'full');
				$preview = $src[0];
				$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
			}
		}

		$img = array( 'img'=>$preview, 'custom'=>$custom );
		if(isset($alt)){
			$img['alt']=esc_attr($alt);
		}

		return $img;
	}
}


if ( !function_exists( 'pexeto_get_image_number' ) ) {

	/**
	 * Retrieves the number of attachments set to a portfolio post.
	 *
	 * @param int     $id the id of the post
	 * @return int the number of attachments
	 */
	function pexeto_get_image_number( $id ) {
		$attachments = pexeto_get_post_attachments( $id );
		return sizeof( $attachments );
	}
}

if ( !function_exists( 'pexeto_get_attachment_thumb_html' ) ) {

	/**
	 * Builds the HTML code of the attachment images of a post. For each image builds an HTML <img/> tag.
	 *
	 * @param int     $id the ID of the post
	 * @return string     the HTML code of the image attachments
	 */
	function pexeto_get_attachment_thumb_html( $id ) {
		$attachments = pexeto_get_post_attachments( $id );
		$featuredImg = pexeto_get_featured_image_url( $id );
		$html = '';
		foreach ( $attachments as $attachment ) {
			$thumb = wp_get_attachment_image_src( $attachment->ID );
			$featured = $attachment->guid==$featuredImg?'class="featured"':'';
			$html.='<img src="'.$thumb[0].'" '.$featured.' />';
		}
		return $html;
	}
}


if ( !function_exists( 'pexeto_get_portfolio_categories' ) ) {

	/**
	 * Loads the portfolio categories into an array and adds them to the global $pexeto object.
	 *
	 * @return array containing the portfolio categories with keys 'id' containing the category ID
	 * and 'name' containing the category name.
	 */
	function pexeto_get_portfolio_categories() {
		global $pexeto;

		if ( !isset( $pexeto->portfolio_categories ) ) {
			$terms=get_terms( PEXETO_PORTFOLIO_TAXONOMY, 'orderby=id&hide_empty=0' );
			$categories=array();
			for ( $i=0; $i<sizeof( $terms ); $i++ ) {
				$categories[]=array( 'id'=>$terms[$i]->term_id, 'name'=>$terms[$i]->name );
			}
			$pexeto->portfolio_categories = $categories;
		}

		return $pexeto->portfolio_categories;
	}
}
