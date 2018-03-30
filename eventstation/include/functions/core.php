<?php
/*------------- THEME SETUP START -------------*/
add_action( 'after_setup_theme', 'eventstation_setup' );
function eventstation_setup(){
	load_theme_textdomain( 'eventstation', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	
	if( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'eventstation-blog-list', 1300, 630, true );
		add_image_size( 'eventstation-latest-posts-widget', 419, 248, true );
		add_image_size( 'eventstation-speaker-image', 400, 330, true );
		add_image_size( 'eventstation-blog-posts', 900, 600, true );
		add_image_size( 'eventstation-gallery', 290, 210, true );
	}
	
	if( ! isset( $content_width ) ) {
		$content_width = 600;
	}
	
	if( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
/*------------- THEME SETUP END -------------*/

/*------------- ENQUE PERADA SCRIPT FILE AND STYLE FILE START -------------*/
function eventstation_scripts()
{
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'eventstation-animate-script', get_template_directory_uri() . '/assets/js/animate.js', array(), false, true  );
	wp_enqueue_script( 'waxa-scrollbar', get_template_directory_uri() . '/assets/js/scrollbar.min.js', array(), false, true  );
		wp_enqueue_script( 'eventstation-script', get_template_directory_uri() . '/assets/js/eventstation.js', array(), false, true  );
	$eventstation_fixed_sidebar = ot_get_option( 'eventstation_fixed_sidebar' );
	if( $eventstation_fixed_sidebar == 'on' ) :
		wp_enqueue_script( 'eventstation-fixed-sidebar-script', get_template_directory_uri() . '/assets/js/fixed-sidebar.js', array(), false, true  );
	endif;
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array(), false, true  );
	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.js', array(), false, true  );
	wp_enqueue_script( 'timecircles', get_template_directory_uri() . '/assets/js/timecircles.js', array(), false, true  );
	wp_enqueue_script( 'html5lightbox', get_template_directory_uri() . '/assets/js/html5lightbox.js', array(), false, true  );
	wp_enqueue_script( 'vegas-slider', get_template_directory_uri() . '/assets/js/vegas.min.js', array(), false, true  );
	$header_fixed = ot_get_option( 'header_fixed' );
	if( $header_fixed == 'on' or !$header_fixed == 'off' ) :
		wp_enqueue_script( 'eventstation-fixed-header-script', get_template_directory_uri() . '/assets/js/fixed-header.js', array(), false, true  );
		wp_enqueue_script( 'eventstation-admin-bar-script', get_template_directory_uri() . '/assets/js/admin-bar.js', array(), false, true  );
	endif;
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css'  );
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/assets/css/font-awesome.min.css'  );
	wp_enqueue_style( 'vegas-slider-style', get_template_directory_uri() . '/assets/css/vegas-slider.css'  );
	wp_enqueue_style( 'waxa-scrollbar-style', get_template_directory_uri() . '/assets/css/scrollbar.css'  );
	wp_enqueue_style( 'eventstation-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'eventstation_scripts' );

function eventstation_load_custom_wp_admin() {
	wp_enqueue_style( 'eventstation-admin-style', get_template_directory_uri() . '/assets/css/admin.css'  );
	wp_enqueue_style( 'eventstation-admin-ot', get_template_directory_uri() . '/assets/css/admin-ot.css' );
	wp_enqueue_script( 'eventstation-admin-script', get_template_directory_uri() . '/assets/js/admin.js' );
}
add_action( 'admin_enqueue_scripts', 'eventstation_load_custom_wp_admin' );
/*------------- ENQUE PERADA SCRIPT FILE AND STYLE FILE END -------------*/

/*------------- THEME HEAD META TAGS START -------------*/
function eventstation_meta_tags() {
    global $post;
 
    if(is_single()) {
        if( has_post_thumbnail( $post->ID ) ):
            $head_img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
		else:
			$head_img_src = "";
			$head_img_src[0] = "";
		endif;
		
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>
 
    <meta property="og:title" content="<?php the_title(); ?>"/>
    <meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>"/>
    <meta property="og:url" content="<?php the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo() ); ?>"/>
    <meta property="og:image" content="<?php echo esc_url( $head_img_src[0] ); ?>"/>
 
<?php
    } else {
        return;
    }
}
add_action('wp_head', 'eventstation_meta_tags', 5);
/*------------- THEME HEAD META TAGS END -------------*/

/*------------- COMMENTS START -------------*/
function eventstation_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'eventstation_move_comment_field_to_bottom' );

function eventstation_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) :
		$tag = 'div';
		$add_below = 'comment';
	else:
		$tag = 'li';
		$add_below = 'div-comment';
	endif;
?>
	<<?php echo esc_attr( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	
	<?php if ( 'div' != $args['style'] ) : ?>
	
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		
	<?php endif; ?>
	
	<div class="comment-author vcard">

		<div class="reply">
		
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		
		<?php edit_comment_link( esc_html__( 'Edit', 'eventstation' ), '  ', '' ); ?>
		
		</div>
	
		<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		
		<?php $allowed_html = array ( 'span' => array() ); printf( wp_kses( '<cite class="fn">%s</cite>, ', 'eventstation' ), get_comment_author_link() ); ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
		
			<?php printf( esc_html__( '%1$s', 'eventstation' ), get_comment_date() ); ?></a>
			
		</div>
		
	</div>
	
	<?php if ( $comment->comment_approved == '0' ) : ?>
	
		<em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'eventstation' ); ?></em>
		
	<?php endif; ?>

	<?php comment_text(); ?>

	<?php if ( 'div' != $args['style'] ) : ?>
	
		</div>
	
	<?php endif; ?>
<?php
}
/*------------- COMMENTS END -------------*/

/*------------- BODY CLASS START -------------*/
function eventstation_class_names( $classes ) {
	$classes[] = 'eventstation-class';
	
	$woocommerce_shop_product_column = esc_attr( ot_get_option( 'woocommerce_shop_product_column' ) );
	if( !empty( $woocommerce_shop_product_column ) ) {
		$classes[] = ' eventstation-shop-column-' . $woocommerce_shop_product_column;
	}
	
	return $classes;
}
add_filter( 'body_class', 'eventstation_class_names' );
/*------------- BODY CLASS END -------------*/

/*------------- EXCERPT START -------------*/
function eventstation_new_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'eventstation_new_excerpt_more' );

function eventstation_my_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'eventstation_my_add_excerpts_to_pages' );
/*------------- EXCERPT END -------------*/

/*------------- THEME SIDEBAR - WIDGET START -------------*/
if( !function_exists( 'eventstation_sidebars_init' ) ) {
	function eventstation_sidebars_init() {
		register_sidebar(array(
			'id' => 'general-sidebar',
			'name' => esc_html__( 'General Sidebar', 'eventstation' ),
			'before_widget' => '<div id="%1$s" class="general-sidebar-wrap widget-box animate anim-fadeIn %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
		
		register_sidebar(array(
			'id' => 'shop-sidebar',
			'name' => esc_html__( 'Shop Sidebar', 'eventstation' ),
			'before_widget' => '<div id="%1$s" class="shop-sidebar-wrap widget-box animate anim-fadeIn %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
	}
}
add_action( 'widgets_init', 'eventstation_sidebars_init' );
/*------------- THEME SIDEBAR - WIDGET END -------------*/

/*------------- SUB MENU CLASS START -------------*/
class eventstation_walker extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		//Add class and attribute to LI element that contains a submenu UL.
		if ($args->has_children){
			$classes[] 		= 'dropdown';
			$li_attributes .= ' data-dropdown="dropdown"';
		}
		$classes[] = 'menu-item-' . $item->ID;
		//If we are on the current page, add the active class to that menu item.
		$classes[] = ($item->current) ? 'active' : '';

		//Make sure you still add all of the WordPress classes.
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		//Add attributes to link element.
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : ''; 

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? '' : '';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;
        $id_field = $this->db_fields['id'];
        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
}
/*------------- SUB MENU CLASS END -------------*/

/*------------- EVENT STATION MENUS START -------------*/
register_nav_menus( 
	array(
		'mainmenu'	=>	esc_html__( 'Main Navigation', 'eventstation' ),
		'menuslot1'	=>	esc_html__( 'Alternative Menu Slot 1', 'eventstation' ),
		'menuslot2'	=>	esc_html__( 'Alternative Menu Slot 2', 'eventstation' )
	)
);
/*------------- EVENT STATION MENUS END -------------*/

/*------------- PAGE LOADING START -------------*/
function eventstation_page_loading() {
	$eventstation_loader = ot_get_option( 'eventstation_loader' );
	if( !$eventstation_loader == 'off' or $eventstation_loader == 'on' ) :
		echo '<div class="loader-wrapper"> <div class="spinner"> <div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div> <div class="sk-cube sk-cube2"></div> <div class="sk-cube sk-cube3"></div> <div class="sk-cube sk-cube4"></div> <div class="sk-cube sk-cube5"></div> <div class="sk-cube sk-cube6"></div> <div class="sk-cube sk-cube7"></div> <div class="sk-cube sk-cube8"></div> <div class="sk-cube sk-cube9"></div> </div> </div> </div>';
	endif;
}
/*------------- PAGE LOADING END -------------*/

/*------------- RELATED POSTS START -------------*/
function eventstation_related_posts() {
	$single_post_related_posts = ot_get_option( 'single_post_related_posts' );
	if( $single_post_related_posts == "on" or !$single_post_related_posts == "off" ) {
		global $post;
		$tags = wp_get_post_tags( $post->ID );
		$post_related_limit = ot_get_option( 'single_post_related_posts_post_count' );
		if( !empty( $post_related_limit ) ) {
		} else {
			$post_related_limit = 3;
		}
		
		if ($tags) {
		?>
			<div class="post-related">
				<h4><?php echo esc_html__( 'You May Also Like', 'eventstation' ); ?></h4>
				<div class="post-related-posts row">
					<?php
					$tag_ids = array();
					foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
						$args = array(
							'tag__in' => $tag_ids,
							'post__not_in' => array($post->ID),
							'post_status' => 'publish',
							'posts_type' => 'post',
							'ignore_sticky_posts'    => true,
							'posts_per_page' => $post_related_limit
						);
			 
					$my_query = new wp_query( $args );
					while( $my_query->have_posts() ) {
						$my_query->the_post();
				?>
						<div class="item col-sm-4 col-xs-12">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="image">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'eventstation-related-post-image' ); ?></a>
								</div>
							<?php } ?>
							<div class="desc">
								<ul class="post-information">
									<li class="author"><i class="fa fa-user"></i> <?php echo esc_html__( 'Author:', 'eventstation' ); ?> <span><?php the_author_posts_link(); ?></span></li>
									<li class="separator">&#45;</li>
									<li class="date"><i class="fa fa-calendar-check-o"></i> <?php echo esc_html__( 'Date:', 'eventstation' ); ?> <span><?php the_time( get_option( 'date_format' ) ); ?></span></li>
								</ul>
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-related-more"><?php echo esc_html__( 'Read More', 'eventstation' ); ?> <i class="fa fa-angle-right"></i></a>
							</div>
						</div>
				<?php
					}
				?>
				</div>
			</div>
		<?php } ?>
		<?php wp_reset_postdata(); ?>
	<?php
	}
}
/*------------- RELATED POSTS END -------------*/

/*------------- SIDEBAR START -------------*/
function eventstation_post_content_area_start() {
		if( is_shop() ) {
			$sidebar_position = ot_get_option('woocommerce_sidebar_position');
		} elseif( is_product() ) {
			$sidebar_position = ot_get_option('woocommerce_product_sidebar_position');
		} elseif( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$eventstation_category_sidebar_style = get_term_meta( $cat_id, 'eventstation_category_sidebar_style', true );
			if( !empty( $eventstation_category_sidebar_style ) ) {
				$sidebar_position = get_term_meta( $cat_id, 'eventstation_category_sidebar_style', true );
			} else {
				$sidebar_position = ot_get_option('category_sidebar_position');
			}
		} elseif( is_tag() ) {
			$sidebar_position = ot_get_option('tag_sidebar_position');
		} elseif( is_author() ) {
			$sidebar_position = ot_get_option('author_sidebar_position');
		} elseif( is_search() ) {
			$sidebar_position = ot_get_option('search_sidebar_position');
		} elseif( is_archive() ) {
			$sidebar_position = ot_get_option('archive_sidebar_position');
		} elseif( is_attachment() ) {
			$sidebar_position = ot_get_option('attachment_sidebar_position');
		} elseif( is_single() ) {
			$sidebar_position = ot_get_option('single_sidebar_position');
		} else {
			$sidebar_position = ot_get_option( 'sidebar_position' );
		}
	
		if ( is_page() or is_single() ) {
			global $post;
			$layout_select = get_post_meta( $post->ID, 'layout_select_meta_box_text', true);
		} else {
			$layout_select = "";
		}
		
		if( $layout_select == 'fullwidth' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 fullwidthsidebar">';
		}
		
		elseif( $layout_select == 'leftsidebar' ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 site-content-right site-content-left pull-right">';
		}
		
		elseif( $layout_select == 'rightsidebar' ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 site-content-left">';
		}
		
		elseif( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 fullwidthsidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 site-content-right site-content-left pull-right">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 site-content-left">';
		}
		
		else {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 site-content-left">';
		}
}

function eventstation_post_sidebar_start() {
		if( is_shop() ) {
			$sidebar_position = ot_get_option('woocommerce_sidebar_position');
		} elseif( is_product() ) {
			$sidebar_position = ot_get_option('woocommerce_product_sidebar_position');
		} elseif( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$eventstation_category_sidebar_style = get_term_meta( $cat_id, 'eventstation_category_sidebar_style', true );
			if( !empty( $eventstation_category_sidebar_style ) ) {
				$cat = get_queried_object();
				$sidebar_position = get_term_meta( $cat_id, 'eventstation_category_sidebar_style', true );
			} else {
				$sidebar_position = ot_get_option('category_sidebar_position');
			}
		} elseif( is_tag() ) {
			$sidebar_position = ot_get_option('tag_sidebar_position');
		} elseif( is_author() ) {
			$sidebar_position = ot_get_option('author_sidebar_position');
		} elseif( is_search() ) {
			$sidebar_position = ot_get_option('search_sidebar_position');
		} elseif( is_archive() ) {
			$sidebar_position = ot_get_option('archive_sidebar_position');
		} elseif( is_attachment() ) {
			$sidebar_position = ot_get_option('attachment_sidebar_position');
		} elseif( is_single() ) {
			$sidebar_position = ot_get_option('single_sidebar_position');
		} else {
			$sidebar_position = ot_get_option( 'sidebar_position' );
		}
	
		if ( is_page() or is_single() ) {			
			global $post;
			$layout_select = get_post_meta( $post->ID, 'layout_select_meta_box_text', true);
		} else {
			$layout_select = "";
		}
		
		if( $layout_select == 'fullwidth' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 hide fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $layout_select == 'leftsidebar' ) {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12 site-content-right leftsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $layout_select == 'rightsidebar' ) {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12 site-content-right rightsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 hide fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12 site-content-right leftsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12 site-content-right rightsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		else {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12 site-content-right fixedrightSidebar"><div class="theiaStickySidebar">';
		}
}

function eventstation_content_area_start() {
		if( is_shop() ) {
			$sidebar_position = ot_get_option('woocommerce_sidebar_position');
		} elseif( is_product() ) {
			$sidebar_position = ot_get_option('woocommerce_product_sidebar_position');
		} elseif( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$eventstation_category_sidebar_style = get_term_meta( $cat_id, 'eventstation_category_sidebar_style', true );
			if( !empty( $eventstation_category_sidebar_style ) ) {
				$sidebar_position = get_term_meta( $cat_id, 'eventstation_category_sidebar_style', true );
			} else {
				$sidebar_position = ot_get_option('category_sidebar_position');
			}
		} elseif( is_tag() ) {
			$sidebar_position = ot_get_option('tag_sidebar_position');
		} elseif( is_author() ) {
			$sidebar_position = ot_get_option('author_sidebar_position');
		} elseif( is_search() ) {
			$sidebar_position = ot_get_option('search_sidebar_position');
		} elseif( is_archive() ) {
			$sidebar_position = ot_get_option('archive_sidebar_position');
		} elseif( is_attachment() ) {
			$sidebar_position = ot_get_option('attachment_sidebar_position');
		} elseif( is_single() ) {
			$sidebar_position = ot_get_option('single_sidebar_position');
		} else {
			$sidebar_position = ot_get_option( 'sidebar_position' );
		}
		
		if( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 fullwidthsidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 site-content-right site-content-left pull-right">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 site-content-left">';
		}
		
		else {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 site-content-left">';
		}
}

function eventstation_sidebar_start() {
		if( is_shop() ) {
			$sidebar_position = ot_get_option('woocommerce_sidebar_position');
		} elseif( is_product() ) {
			$sidebar_position = ot_get_option('woocommerce_product_sidebar_position');
		} elseif( is_category() ) {
			$cat = get_queried_object();
			$cat_id = $cat->term_id;
			$eventstation_category_sidebar_style = get_term_meta( $cat_id, 'eventstation_category_sidebar_style', true );
			if( !empty( $eventstation_category_sidebar_style ) ) {
				$sidebar_position = get_term_meta( $cat_id, 'eventstation_category_sidebar_style', true );
			} else {
				$sidebar_position = ot_get_option('category_sidebar_position');
			}
		} elseif( is_tag() ) {
			$sidebar_position = ot_get_option('tag_sidebar_position');
		} elseif( is_author() ) {
			$sidebar_position = ot_get_option('author_sidebar_position');
		} elseif( is_search() ) {
			$sidebar_position = ot_get_option('search_sidebar_position');
		} elseif( is_archive() ) {
			$sidebar_position = ot_get_option('archive_sidebar_position');
		} elseif( is_attachment() ) {
			$sidebar_position = ot_get_option('attachment_sidebar_position');
		} elseif( is_single() ) {
			$sidebar_position = ot_get_option('single_sidebar_position');
		} else {
			$sidebar_position = ot_get_option( 'sidebar_position' );
		}
		
		if( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 hide fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12 site-content-right leftsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12 site-content-right rightsidebar fixedrightSidebar"><div class="theiaStickySidebar">';
		}
		
		else {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12 site-content-right fixedrightSidebar"><div class="theiaStickySidebar">';
		}
}

function eventstation_content_area_end() {
	echo '</div>';
}

function eventstation_sidebar_end() {
	echo '</div></div>';
}
/*------------- SIDEBAR END -------------*/

/*------------- CONTACT FORM 7 START -------------*/
function eventstation_mycustom_wpcf7_form_elements( $form ) {
	$form = do_shortcode( $form );
	return $form;
}
add_filter( 'wpcf7_form_elements', 'eventstation_mycustom_wpcf7_form_elements' );
/*------------- CONTACT FORM 7 END -------------*/

/*------------- WOOCOMMERCE START -------------*/
function eventstation_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'eventstation_woocommerce_support' );

function eventstation_related_products_args( $args ) {
	$related_product_count = esc_attr( ot_get_option( 'woocommerce_related_product_count_column' ) );
	if( !empty( $related_product_count ) ) {
		$args['posts_per_page'] = $related_product_count;
		$args['columns'] = 4;
	} else {
		$args['posts_per_page'] = 4;
		$args['columns'] = 4;
	}
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'eventstation_related_products_args' );

if (!function_exists('eventstation_loop_columns')) {
	function eventstation_loop_columns() {
		$woocommerce_shop_product_column = esc_attr( ot_get_option( 'woocommerce_shop_product_column' ) );
		if( !empty( $woocommerce_shop_product_column ) ) {
			return $woocommerce_shop_product_column;
		} else {
			return 3;
		}
	}
}
add_filter('loop_shop_columns', 'eventstation_loop_columns');
/*------------- WOOCOMMERCE END -------------*/

/*------------- HEADER SEARCH START -------------*/
function eventstation_header_search() {
	$header_search = ot_get_option( 'header_search' );
	if( !$header_search == 'off' or $header_search == "on" ) :
		?>
		<div class="search-area">
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_html__( 'Search...', 'eventstation' ); ?>" name="s" id="s" class="searchform-text" />
				<button id="searchsubmit"><i class="fa fa-search"></i></button>
			</form>
		</div>
	<?php
	endif;
}
/*------------- HEADER SEARCH END -------------*/

/*------------- HEADER LOGO START -------------*/
function eventstation_site_logo() {
	$logo = ot_get_option( 'eventstation_logo' );
	$logo_height = ot_get_option( 'logo_height' ); if( !empty( $logo_height ) ) { $logo_height = 'height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"'; }
	$logo_width = ot_get_option( 'logo_width' ); if( !empty( $logo_width ) ) { $logo_width = 'width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"'; }
	if( !$logo == ""  ) {
		echo '<div class="logo-area"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'eventstation' ) . '" src="' . esc_url( ot_get_option( 'eventstation_logo' ) ) . '" ' . $logo_height . $logo_width . ' /></a></div>';
	} else {
		echo '<div class="logo-area"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'eventstation' ) . '" src="' . get_template_directory_uri() . '/assets/img/logo.png" /></a></div>';
	}
}

function eventstation_site_logo_alternative() {
	$logo = ot_get_option( 'eventstation_logo_alternative' );
	$logo_height = ot_get_option( 'logo_height' ); if( !empty( $logo_height ) ) { $logo_height = 'height="' . esc_attr( $logo_height[0] ) . esc_attr( $logo_height[1] ) . '"'; }
	$logo_width = ot_get_option( 'logo_width' ); if( !empty( $logo_width ) ) { $logo_width = 'width="' . esc_attr( $logo_width[0] ) . esc_attr( $logo_width[1] ) . '"'; }
	if( !$logo == ""  ) {
		echo '<div class="logo-area logo-area-alternative"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'eventstation' ) . '" src="' . esc_url( ot_get_option( 'eventstation_logo_alternative' ) ) . '" ' . $logo_height . $logo_width . ' /></a></div>';
	} else {
		echo '<div class="logo-area logo-area-alternative"><a href="' . esc_url( home_url( '/' ) ) . '" class="site-logo"><img alt="' . esc_html__( 'Logo', 'eventstation' ) . '" src="' . get_template_directory_uri() . '/assets/img/logo-alternative.png" /></a></div>';
	}
}
/*------------- HEADER LOGO END -------------*/

/*------------- HEADER STYLES START -------------*/
function eventstation_header() {
	$hide_header = ot_get_option( 'hide_header' );
	$default_header_layout = ot_get_option( 'default_header_layout' );
	
	if( !$hide_header == 'off' or $hide_header == 'on' ) {
		if ( is_page() or is_single() ) {
			global $post;
			$header_style = get_post_meta( $post->ID, 'header_layout_select_meta_box_text', true);
			$header_status = get_post_meta( $post->ID, 'header_status', true);
		}
		else {
			$header_style = "";
			$header_status = "";
		}
		
		function eventstation_headerstyle1() {
			if ( is_page() or is_single() ) {
				global $post;
				$menu_slot_select = get_post_meta( $post->ID, 'alternative_menu_slot_select', true);
			}
			else {
				$menu_slot_select = "";
			}
		
			if ( $menu_slot_select == "menuslot1" ) {
				$menu_location = 'menuslot1';
			} elseif ( $menu_slot_select == "menuslot2" ) {
				$menu_location = "menuslot2";		
			} else {
				$menu_location = "mainmenu";		
			}
		?>
			<div class="header-wrapper header-default">
				<div class="container-fluid">
					<header class="header">
						<?php eventstation_site_logo(); ?>
						<?php eventstation_site_logo_alternative(); ?>
						<?php eventstation_header_search(); ?>
						<div class="menu-area">
							<nav class="navbar">
								<div class="navbar-header">
								  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only"><?php echo esc_html__( 'Toggle Navigation', 'eventstation' ); ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								  </button>
								</div>
								<?php wp_nav_menu( array( 'menu' => esc_attr( $menu_location ), 'theme_location' => esc_attr( $menu_location ), 'depth' => 5, 'container' => 'div', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'bs-example-navbar-collapse-1', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'eventstation_walker::fallback', 'walker' => new eventstation_walker()) ); ?>
							</nav>
						</div>
					</header>
				</div>
			</div>
		<?php
		}
		
		function eventstation_headerstyle2() {
			if ( is_page() or is_single() ) {
				global $post;
				$menu_slot_select = get_post_meta( $post->ID, 'alternative_menu_slot_select', true);
			}
			else {
				$menu_slot_select = "";
			}
		
			if ( $menu_slot_select == "menuslot1" ) {
				$menu_location = 'menuslot1';
			} elseif ( $menu_slot_select == "menuslot2" ) {
				$menu_location = "menuslot2";		
			} else {
				$menu_location = "mainmenu";		
			}
		?>
			<div class="header-wrapper header-alternative">
				<div class="container-fluid">
					<header class="header">
						<?php eventstation_site_logo(); ?>
						<?php eventstation_site_logo_alternative(); ?>
						<?php eventstation_header_search(); ?>
						<div class="menu-area">
							<nav class="navbar">
								<div class="navbar-header">
								  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only"><?php echo esc_html__( 'Toggle Navigation', 'eventstation' ); ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								  </button>
								</div>
								<?php wp_nav_menu( array( 'menu' => esc_attr( $menu_location ), 'theme_location' => esc_attr( $menu_location ), 'depth' => 5, 'container' => 'div', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'bs-example-navbar-collapse-1', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'eventstation_walker::fallback', 'walker' => new eventstation_walker()) ); ?>
							</nav>
						</div>
					</header>
				</div>
			</div>
		<?php
		}
		
		function eventstation_headerstyle3() {
			if ( is_page() or is_single() ) {
				global $post;
				$menu_slot_select = get_post_meta( $post->ID, 'alternative_menu_slot_select', true);
			}
			else {
				$menu_slot_select = "";
			}
		
			if ( $menu_slot_select == "menuslot1" ) {
				$menu_location = 'menuslot1';
			} elseif ( $menu_slot_select == "menuslot2" ) {
				$menu_location = "menuslot2";		
			} else {
				$menu_location = "mainmenu";		
			}
		?>
			<div class="header-wrapper header-alternative header-alternative2">
				<div class="container">
					<header class="header">
						<?php eventstation_site_logo(); ?>
						<?php eventstation_site_logo_alternative(); ?>
						<?php eventstation_header_search(); ?>
						<div class="menu-area">
							<nav class="navbar">
								<div class="navbar-header">
								  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only"><?php echo esc_html__( 'Toggle Navigation', 'eventstation' ); ?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								  </button>
								</div>
								<?php wp_nav_menu( array( 'menu' => esc_attr( $menu_location ), 'theme_location' => esc_attr( $menu_location ), 'depth' => 5, 'container' => 'div', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'bs-example-navbar-collapse-1', 'menu_class' => 'nav navbar-nav', 'fallback_cb' => 'eventstation_walker::fallback', 'walker' => new eventstation_walker()) ); ?>
							</nav>
						</div>
					</header>
				</div>
			</div>
		<?php
		}
		
		if( !$header_status == 'off' or $header_status == "on" ) {
			
			if ( is_page() or is_single() ) {
				
				if( $header_style == "alternativestylev1" ) {
					eventstation_headerstyle2();
				} elseif( $header_style == "alternativestylev2" ) {
					eventstation_headerstyle3();
				} elseif( $header_style == "default" ) {
					eventstation_headerstyle1();
				} else {
					
					if( $default_header_layout == "alternativestylev1" ) {
						eventstation_headerstyle2();
					} elseif( $default_header_layout == "alternativestylev2" ) {
						eventstation_headerstyle3();
					} else {
						eventstation_headerstyle1();
					}
					
				}
				
			} elseif( is_category() ) {
				
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventstation_category_header_style = get_term_meta( $cat_id, 'eventstation_category_header_style', true );
				
				if( $eventstation_category_header_style == "alternativestylev1" ) {
					eventstation_headerstyle2();
				} elseif( $eventstation_category_header_style == "alternativestylev2" ) {
					eventstation_headerstyle3();
				} elseif( $eventstation_category_header_style == "default" ) {
					eventstation_headerstyle1();
				} else {
					
					if( $default_header_layout == "alternativestylev1" ) {
						eventstation_headerstyle2();
					} elseif( $default_header_layout == "alternativestylev2" ) {
						eventstation_headerstyle3();
					} else {
						eventstation_headerstyle1();
					}
					
				}
				
			} else {
			
				if( $default_header_layout == "alternativestylev1" ) {
					eventstation_headerstyle2();
				} elseif( $default_header_layout == "alternativestylev2" ) {
					eventstation_headerstyle3();
				} else {
					eventstation_headerstyle1();
				}

			}
			
		}

	}
}
/*------------- HEADER STYLES START END -------------*/

/*------------- FOOTER CONTENT START -------------*/
function eventstation_footer_content() {
	$hide_footer = ot_get_option( 'hide_footer' );
	$default_footer_layout = ot_get_option( 'default_footer_layout' );
	$footer_page = ot_get_option( 'footer_page' );
	$footer_page_alternative = ot_get_option( 'footer_page_alternative' );
	
	if( !$hide_footer == 'off' or $hide_footer == 'on' ) {
		if ( is_page() or is_single() ) {
			global $post;
			$footer_style = get_post_meta( $post->ID, 'footer_layout_select_meta_box_text', true);
			$footer_status = get_post_meta( $post->ID, 'footer_status', true);
		}
		else {
			$post = "";
			$footer_style = "";
			$footer_status = "";
		}
		
		function eventstation_footerstyle1() {
			$footer_page = ot_get_option( 'footer_page' );
			?>
				<footer class="footer animate anim-fadeIn" id="Footer">
					<div class="footer-widget">
						<?php eventstation_container_fluid_before(); ?>
							<?php
								$args_footer_page_content = array(
									'p' => $footer_page,
									'ignore_sticky_posts' => true,
									'post_type' => 'page',
									'post_status' => 'publish'
								);
								$wp_query = new WP_Query( $args_footer_page_content );
								while ( $wp_query->have_posts() ) :
								$wp_query->the_post();
								$postid = get_the_ID();
							?>
								<?php the_content(); ?>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						<?php eventstation_container_fluid_after(); ?>
					</div>
				</footer>
			<?php
		}
		
		function eventstation_footerstyle2() {
			$footer_page_alternative = ot_get_option( 'footer_page_alternative' );
			?>
				<footer class="footer footer-alternative animate anim-fadeIn" id="Footer">
					<div class="footer-widget">
						<?php eventstation_container_before(); ?>
							<?php
								$args_footer_page_content = array(
									'p' => $footer_page_alternative,
									'ignore_sticky_posts' => true,
									'post_type' => 'page',
									'post_status' => 'publish'
								);
								$wp_query = new WP_Query( $args_footer_page_content );
								while ( $wp_query->have_posts() ) :
								$wp_query->the_post();
								$postid = get_the_ID();
							?>
								<?php the_content(); ?>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						<?php eventstation_container_after(); ?>
					</div>
				</footer>
			<?php
		}
		
		if( !$footer_status == 'off' or $footer_status == "on" ) {
		
			if( !$footer_page == '0' and !empty( $footer_page  ) or !$footer_page_alternative == '0' and !empty( $footer_page_alternative  ) ) {
				
				if ( is_page() or is_single() ) {
					
					if( $footer_style == "alternativestyle" ) {
						eventstation_footerstyle2();
					} elseif( $footer_style == "default" ) {
						eventstation_footerstyle1();
					} else {
						
						if( $default_footer_layout == "alternativestyle" ) {
							eventstation_footerstyle2();
						} else {
							eventstation_footerstyle1();
						}
						
					}
					
				} elseif( is_category() ) {
				
					$cat = get_queried_object();
					$cat_id = $cat->term_id;
					$eventstation_category_footer_style = get_term_meta( $cat_id, 'eventstation_category_footer_style', true );
					
					if( $eventstation_category_footer_style == "alternativestyle" ) {
						eventstation_footerstyle2();
					} elseif( $eventstation_category_footer_style == "default" ) {
						eventstation_footerstyle1();
					} else {
						
						if( $default_footer_layout == "alternativestyle" ) {
							eventstation_footerstyle2();
						} else {
							eventstation_footerstyle1();
						}
						
					}
					
				} else {
					
					if( $default_footer_layout == "alternativestyle" ) {
						eventstation_footerstyle2();
					} else {
						eventstation_footerstyle1();
					}
					
				}
			
			}
		}
		
	}
}
/*------------- FOOTER CONTENT END -------------*/

/*------------- HEADING NAVIGATION START -------------*/
function eventstation_heading_navigation() {
	?>
		<div class="content-heading">
			<?php eventstation_container_fluid_before(); ?>
				<div class="heading-navigation">
					<i class="fa fa-pencil-square-o"></i>
					<ul>
						<li><?php printf( esc_html__( 'Home', 'eventstation' ) ); ?></li>
						<li>&#47;</li>
						<li><?php
							if ( is_404() ) { echo esc_html__( '404', 'eventstation' ); }
							elseif ( is_category() ) {
								printf( '', single_cat_title( '', true ) );
							}
							elseif ( is_product_category() ) { echo esc_html__( 'Product Category', 'eventstation' ); }
							elseif ( is_shop() ) { echo esc_html__( 'Shop', 'eventstation' ); }
							elseif ( is_product_tag() ) { echo esc_html__( 'Product Tag', 'eventstation' ); }
							elseif ( is_cart() ) { echo esc_html__( 'Cart', 'eventstation' ); }
							elseif ( is_product() ) { echo esc_html__( 'Product', 'eventstation' ); }
							elseif ( is_tag() ) {
								printf( '', single_cat_title( '', true ) );
							}
							elseif ( is_search() ) {
								printf( esc_html__( 'Search: %s', 'eventstation' ), get_search_query() );
							}
							elseif ( is_author() ) {
								printf( esc_html__( 'Author: %s', 'eventstation' ), '' . get_the_author() . '' );
							}
							elseif ( is_archive() ) {
								if ( is_day() ) :
									printf( esc_html__( 'Daily Archives: %s', 'eventstation' ), get_the_date() );
								elseif ( is_month() ) :
									printf( esc_html__( 'Monthly Archives: %s', 'eventstation' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'eventstation' ) ) );
								elseif ( is_year() ) :
									printf( esc_html__( 'Yearly Archives: %s', 'eventstation' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'eventstation' ) ) );
								else :
									echo esc_html__( 'Archives', 'eventstation' );
								endif;
							}
							elseif ( is_attachment() ) { echo esc_html__( 'Attachment', 'eventstation' ); }
							elseif ( is_single() ) { echo esc_html__( 'Single', 'eventstation' ); }
							else { echo esc_html__( 'Page', 'eventstation' ); }
						?></li>
					</ul>
				</div>
				
				<?php if ( is_single() ) { ?>
					<div class="heading-title">
					</div>
				<?php } ?>
			<?php eventstation_container_fluid_after(); ?>
		</div>
	<?php
}
/*------------- HEADING NAVIGATION END -------------*/

/*------------- POST SOCIAL SHARE START -------------*/
function eventstation_post_content_social_share() {
	$social_share_facebook = ot_get_option( 'social_share_facebook' );
	$social_share_twitter = ot_get_option( 'social_share_twitter' );
	$social_share_googleplus = ot_get_option( 'social_share_googleplus' );
	$social_share_linkedin = ot_get_option( 'social_share_linkedin' );
	$social_share_pinterest = ot_get_option( 'social_share_pinterest' );
	$social_share_reddit = ot_get_option( 'social_share_reddit' );
	$social_share_delicious = ot_get_option( 'social_share_delicious' );
	$social_share_stumbleupon = ot_get_option( 'social_share_stumbleupon' );
	$social_share_tumblr = ot_get_option( 'social_share_tumblr' );
	$social_share_link_title = esc_html__( 'Share to', 'eventstation' );
	$share_post_id = get_the_ID();
	$share_featured_post_image = "";
	if( has_post_thumbnail( $share_post_id ) ) :
		$share_featured_post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $share_post_id ), 'medium' );
	else:
		$share_featured_post_image[0] = "";
	endif;
	
	 if( $social_share_facebook == 'on' or $social_share_twitter == 'on' or $social_share_googleplus == 'on' or $social_share_linkedin == 'on' or $social_share_pinterest == 'on' or $social_share_delicious == 'on' or $social_share_stumbleupon == 'on' or $social_share_tumblr == 'on' or $social_share_reddit == 'on' ) {
	?>
		<div class="post-social-share">
			<ul>
				<li class="title"><?php echo esc_html__( 'Share', 'eventstation' ); ?><span></span></li>
				<?php
					$facebook = "";
					$twitter = "";
					$googleplus = "";
					$linkedin = "";
					$pinterest = "";	
					$reddit = "";
					$delicious = "";
					$stumbleupon = "";
					$tumblr = "";
					
					if( !$social_share_facebook == 'off' or $social_share_facebook == 'on' ) : $facebook = '<li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Facebook', 'eventstation' ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>'; endif;
					if( !$social_share_twitter == 'off' or $social_share_twitter == 'on' ) : $twitter = '<li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . urlencode( get_the_title() ). '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Twitter', 'eventstation' ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>'; endif;
					if( !$social_share_googleplus == 'off' or $social_share_googleplus == 'on' ) : $googleplus = '<li><a class="share-googleplus"  href="https://plus.google.com/share?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Google+', 'eventstation' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a></li>'; endif;
					if( !$social_share_linkedin == 'off' or $social_share_linkedin == 'on' ) : $linkedin = '<li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Linkedin', 'eventstation' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>'; endif;
					if( !$social_share_pinterest == 'off' or $social_share_pinterest == 'on' ) : $pinterest = '<li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Pinterest', 'eventstation' ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>'; endif;
					if( !$social_share_reddit == 'off' or $social_share_reddit == 'on' ) : $reddit = '<li><a class="share-reddit"  href="http://reddit.com/submit?url=' . get_the_permalink() . '&title=' . urlencode( get_the_title() ) . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Reddit', 'eventstation' ) . '" target="_blank"><i class="fa fa-reddit"></i></a></li>'; endif;
					if( !$social_share_delicious == 'off' or $social_share_delicious == 'on' ) : $delicious = '<li><a class="share-delicious"  href="http://del.icio.us/post?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Delicious', 'eventstation' ) . '" target="_blank"><i class="fa fa-delicious"></i></a></li>'; endif;
					if( !$social_share_stumbleupon == 'off' or $social_share_stumbleupon == 'on' ) : $stumbleupon = '<li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=' . get_the_permalink() . '&title=' . get_the_title() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Stumbleupon', 'eventstation' ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>'; endif;
					if( !$social_share_tumblr == 'off' or $social_share_tumblr == 'on' ) : $tumblr = '<li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=' . get_the_permalink() . '" title="' . esc_attr( $social_share_link_title ) . esc_html__( 'Tumblr', 'eventstation' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>'; endif;
					$output = $facebook . $twitter . $googleplus . $linkedin . $pinterest . $reddit . $delicious . $stumbleupon . $tumblr;
					echo balanceTags ( stripslashes( addslashes( $output ) ) );
				?>
			</ul>
		</div>
	<?php
	}
}
/*------------- POST SOCIAL SHARE END -------------*/

/*------------- WRAPPER BEFORE START -------------*/
function eventstation_wrapper_before() {
	?>
		<div class="eventstation-wrapper" id="general-wrapper">
	<?php
}
/*------------- WRAPPER BEFORE END -------------*/

/*------------- WRAPPER AFTER START -------------*/
function eventstation_wrapper_after() {
	?>
		</div>
	<?php
}
/*------------- WRAPPER AFTER END -------------*/

/*------------- NO HEADER CODE START -------------*/
function eventstation_no_header_code() {
		if ( is_page() or is_single() ) {
			
			global $post;
			$header_style = get_post_meta( $post->ID, 'header_layout_select_meta_box_text', true);
			$eventstation_category_header_style = "";
			
			if( !$header_style == "alternativestylev1" or !$header_style == "alternativestylev2" ) {
				echo '<div class="height60"></div>';
			}
			
		} elseif( is_category() ) {
				
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				$eventstation_category_header_style = get_term_meta( $cat_id, 'eventstation_category_header_style', true );
				$header_style = "";
				
				if( !$eventstation_category_header_style == "alternativestylev1"  or !$eventstation_category_header_style == "alternativestylev2" ) {
					echo '<div class="height60"></div>';
				}
				
		} else {
			
			
			$default_header_layout = ot_get_option( 'default_header_layout' );
	
			if( !$default_header_layout == "alternativestylev1"  or !$default_header_layout == "alternativestylev2" ) {
				echo '<div class="height60"></div>';
			}
	
		}
}
/*------------- NO HEADER CODE END -------------*/

/*------------- SITE CONTENT START -------------*/
function eventstation_site_content_start() {
	?>
		<div class="site-content">
	<?php
}

function eventstation_site_content_end() {
	?>			
		</div>
	<?php
}
/*------------- SITE CONTENT END -------------*/

/*------------- SITE SUB CONTENT START -------------*/
function eventstation_site_sub_content_start() {
	?>
		<div class="site-sub-content clearfix">
	<?php
}

function eventstation_site_sub_content_end() {
	?>			
		</div>
	<?php
}
/*------------- SITE SUB CONTENT END -------------*/

/*------------- WIDGET CONTENT BEFORE START -------------*/
function eventstation_widget_content_before() {
	?>
		<div class="widget-content">
	<?php
}
/*------------- WIDGET CONTENT BEFORE END -------------*/

/*------------- WIDGET CONTENT AFTER START -------------*/
function eventstation_widget_content_after() {
	?>
		</div>
	<?php
}
/*------------- WIDGET CONTENT AFTER END -------------*/

/*------------- SITE PAGE CONTENT BEFORE START -------------*/
function eventstation_site_page_content_before() {
	?>
		<div class="site-page-content">
	<?php
}
/*------------- SITE PAGE CONTENT BEFORE END -------------*/

/*------------- SITE PAGE CONTENT AFTER START -------------*/
function eventstation_site_page_content_after() {
	?>
		</div>
	<?php
}
/*------------- SITE PAGE CONTENT AFTER END -------------*/

/*------------- CONTAINER BEFORE START -------------*/
function eventstation_container_before() {
	?>
		<div class="container">
	<?php
}
/*------------- CONTAINER BEFORE END -------------*/

/*------------- CONTAINER AFTER START -------------*/
function eventstation_container_after() {
	?>
		</div>
	<?php
}
/*------------- CONTAINER AFTER END -------------*/

/*------------- CONTAINER FUILD BEFORE START -------------*/
function eventstation_container_fluid_before() {
	?>
		<div class="container-fluid">
	<?php
}
/*------------- CONTAINER FUILD BEFORE END -------------*/

/*------------- CONTAINER FUILD AFTER START -------------*/
function eventstation_container_fluid_after() {
	?>
		</div>
	<?php
}
/*------------- CONTAINER FUILD AFTER END -------------*/

/*------------- ROW BEFORE START -------------*/
function eventstation_row_before() {
	?>
		<div class="row">
	<?php
}
/*------------- ROW BEFORE END -------------*/

/*------------- ROW AFTER START -------------*/
function eventstation_row_after() {
	?>
		</div>
	<?php
}
/*------------- ROW AFTER END -------------*/

/*------------- ALTERNATIVE ROW BEFORE START -------------*/
function eventstation_alternative_row_before() {
	?>
		<div class="row alternative-row">
	<?php
}
/*------------- ALTERNATIVE ROW BEFORE END -------------*/

/*------------- ALTERNATIVE ROW AFTER START -------------*/
function eventstation_alternative_row_after() {
	?>
		</div>
	<?php
}
/*------------- ALTERNATIVE ROW AFTER END -------------*/