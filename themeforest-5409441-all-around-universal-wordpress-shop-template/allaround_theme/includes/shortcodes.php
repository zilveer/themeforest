<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */
 
add_filter( 'widget_text', 'do_shortcode' );

// Columns [one_third], [two_third], [one_half], [one_fourth], [three_fourth]
function allaround_one_third( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'last' => 'no',
	), $atts ) );
	if ( $last == 'no' ) {
		return "<div class='column column-1-3'>" . do_shortcode( $content ) . "</div>";
	} else {
		return "<div class='column column-1-3 column-last'>" . do_shortcode( $content ) . "</div><div class='clear'></div>";	
	}
}

function allaround_two_third( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'last' => 'no',
	), $atts ) );
	if ( $last == 'no' ) {	
		return "<div class='column column-2-3'>" . do_shortcode( $content ) . "</div>";
	} else {
		return "<div class='column column-2-3 column-last'>" . do_shortcode( $content ) . "</div><div class='clear'></div>";	
	}   
}

function allaround_one_half( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'last' => 'no',
	), $atts ) );
	if ( $last == 'no' ) {	
		return "<div class='column column-1-2'>" . do_shortcode( $content ) . "</div>";
	} else {
		return "<div class='column column-1-2 column-last'>" . do_shortcode( $content ) . "</div><div class='clear'></div>";	
	}		
}

function allaround_one_fourth( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'last' => 'no',
	), $atts ) );
	if ( $last == 'no' ) {	
		return "<div class='column column-1-4'>" . do_shortcode( $content ) . "</div>";
	} else {
		return "<div class='column column-1-4 column-last'>" . do_shortcode( $content ) . "</div><div class='clear'></div>";	
	}   
}

function allaround_three_fourth( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'last' => 'no',
	), $atts ) );
	if ( $last == 'no' ) {	
		return "<div class='column column-3-4'>" . do_shortcode( $content ) . "</div>";
	} else {
		return "<div class='column column-3-4 column-last'>" . do_shortcode( $content ) . "</div><div class='clear'></div>";	
	}   
}

// [clear]
function allaround_clear_row( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'margin' => 0
	), $atts ) );
	if ( $margin == 0 ) : $margindo = ''; else : $margindo = "style='height:{$margin}px;'"; endif;
	$out = "<div $margindo></div>";	
	return $out;
}

// [accordion], [accordion_section]
function allaround_accordion( $atts, $content = null ) {
	global $accordion_first;
	$accordion_first = 1;
	$out = "<div class='accordion'>" . do_shortcode( $content ) . "</div>";
	return $out;
}

function allaround_accordion_section( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Title'
	), $atts ) );
	global $accordion_first;
	if ( $accordion_first == 1 ) { $class = ' first'; $accordion_first = 0; } else { $class = ''; $style = ''; }
	$out = '<a class="acc-trigger ' . $class . '" href="#">' . $title . '</a><div class="acc-content">' . do_shortcode( $content ) . '</div>';
	return $out;
}

// [tabs], [tab]
function allaround_tabs( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'horizontal'
	), $atts ) );
	preg_match_all( '/\[aa_tab[^]]+]/', $content, $matches ); 
	$titles = '<ul class="tabs-nav">';
	foreach ( $matches[0] as $match ) {
		$title = allaround_get_between( $match, 'title="', '"' );
		$id = str_replace( ' ', '-', $title );
		$titles .= '<li><a href="#tab-' . $id . '">' . $title . '</a></li>';
	}
	$titles .= '</ul>';
	$out = "<div class='tabs " . $type . "'>" . $titles . '<div class="clear"></div><div class="tabs-container">' . do_shortcode( $content ) . '</div>' . "</div>";
	
	return $out;
}
function allaround_tab( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Title'
	), $atts ) );
	$id = str_replace( ' ', '-', $title );
	$out = '<div id="tab-' . $id . '" class="tab-content">' . do_shortcode( $content ) . '</div>';
	return $out;
}

// [progressbar]
function allaround_progress( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'howmuch' => '5',
		'outof' => '10',
		'title' => 'Progress'
	), $atts ) );
	$progress = $howmuch * 100 / $outof;
	$out = '<div class="statistics_background"><div class="statistics_bar" data-width="' . $progress . '"></div><!-- statistics_bar --><span>' . $title . '</span></div><!-- statistics_background -->';
	return $out;
}

// [divider]
function allaround_shortcode_divider( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'margin' => 24
		
	), $atts ) );
	$out = "<div class='separator' style='margin:{$margin}px 0'></div>";
	return $out;
}

// [bluebox]
function allaround_shortcode_blue_box( $atts, $content = null ) {
	 return '<div class="alert_box_wrapper alert_box_info"><div class="alert_icon_bg"><img width="63" height="63" src="' . get_template_directory_uri() . '/images/elements/info.png" alt="error" /></div><!-- alert_icon_bg --><div class="alert_box">' . do_shortcode( $content) . '</div><!-- alert_text --></div><!-- alert_box_wrapper -->';
}

// [greenbox]
function allaround_shortcode_green_box( $atts, $content = null ) {
	return '<div class="alert_box_wrapper alert_box_success"><div class="alert_icon_bg"><img width="63" height="63" src="' . get_template_directory_uri() . '/images/elements/success.png" alt="error" /></div><!-- alert_icon_bg --><div class="alert_box">' . do_shortcode( $content) . '</div><!-- alert_text --></div><!-- alert_box_wrapper -->';
}

// [redbox]
function allaround_shortcode_red_box( $atts, $content = null ) {
	return '<div class="alert_box_wrapper"><div class="alert_icon_bg"><img width="63" height="63" src="' . get_template_directory_uri() . '/images/elements/error.png" alt="error" /></div><!-- alert_icon_bg --><div class="alert_box">' . do_shortcode( $content) . '</div><!-- alert_text --></div><!-- alert_box_wrapper -->';
}

// [yellowbox]
function allaround_shortcode_yellow_box( $atts, $content = null ) {
	return '<div class="alert_box_wrapper alert_box_notice"><div class="alert_icon_bg"><img width="63" height="63" src="' . get_template_directory_uri() . '/images/elements/notice.png" alt="error" /></div><!-- alert_icon_bg --><div class="alert_box">' . do_shortcode( $content) . '</div><!-- alert_text --></div><!-- alert_box_wrapper -->';
}

// [products]
function allaround_shortcode_products( $atts, $content = null ) {
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	    return;
	}
	extract( shortcode_atts( array(
		'type' => 1,
		'category' => "-1",
		'rows' => 1,
		'order' => 'date',
		'ajax' => 'no',
		'related' => 'no',
		'upsells' => 'no',
		'values' => 'DESC',
		'pagination' => 'yes'
	), $atts ) );
	if ( $related !== 'yes' && $upsells !== 'yes' ) {
		if ( is_page() ) {
			global $allaround_sidebar;
			if ( $allaround_sidebar['sidebarclass'] !== 'no-sidebar' ) return;
		}
		else {
			return;
		}
	}
	$out = '';
	$product_sidebar = '';
	$product_entry = '';
	$post_counter = 0;
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
	if ( $ajax == 'yes' ) $paged = 1;
	$query_string = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => $rows * 3,
		'paged' => $paged,
		'orderby' => $order,
		'order' => $values
		);
	if ( $category !== "-1" ){
		$query_string['ignore_sticky_posts'] = 1;
		$query_string['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'id',
				'terms' => $category
			)
		);
		$class = 'category_products';
	}
	else {
		$query_string['ignore_sticky_posts'] = 0;
		$class = 'all_products';
	}
	if ( $related == 'yes' ) {
		global $post, $product;
		$related_post_in = $product->get_related();
		if ( sizeof( $related_post_in ) == 0 ) return;
		$query_string['post__in'] = $related_post_in;
		$query_string['post__not_in'] = array( $post->ID );
		$query_string['ignore_sticky_posts'] = 0;
		$class = 'related_products';
	}
	if ( $upsells == 'yes' ) {
		global $post, $product, $woocommerce;
		$upsells_post_in = $product->get_upsells();
		$meta_query = $woocommerce->query->get_meta_query();
		if ( sizeof( $upsells_post_in ) == 0 ) return;
		$query_string['post__in'] = $upsells_post_in;
		$query_string['post__not_in'] = array( $post->ID );
		$query_string['meta_query'] = $meta_query;
		$query_string['ignore_sticky_posts'] = 0;
		$class = 'upsells_products';
	}
	
	$query_string_ajax = http_build_query($query_string);
	$allaround_posts = new WP_Query( $query_string );
		if ( $allaround_posts->have_posts() ) :
			$out .= '<div class="products_wrapper '. $class .'" data-string="'. $query_string_ajax .'">';
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				global $product;
				$post_counter++;
				
				if ( $product->get_price() == '' ) :

					$add_to_cart = '';
					
				elseif ( ! $product->is_in_stock() ) : 

				$add_to_cart = '';

				else :

					$link = array(
						'url'   => '',
						'label' => '',
						'class' => ''
					);

					$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

					switch ( $handler ) {
						case "variable" :
							$link['url'] 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'allaround' ) );
						break;
						case "grouped" :
							$link['url'] 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'allaround' ) );
						break;
						case "external" :
							$link['url'] 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
							$link['label'] 	= apply_filters( 'external_add_to_cart_text', __( 'Read More', 'allaround' ) );
						break;
						default :
							if ( $product->is_purchasable() ) {
								$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
								$link['label'] 	= apply_filters( 'add_to_cart_text', __( 'Add to cart', 'allaround' ) );
								$link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
							} else {
								$link['url'] 	= apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
								$link['label'] 	= apply_filters( 'not_purchasable_text', __( 'Read More', 'allaround' ) );
							}
						break;
					}

					$add_to_cart =  apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s button product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );

				endif;

				if ( $post_counter == 3 ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				$excerpt = get_the_excerpt();
				$product_sidebar .= '<li><div class="dot customColorBg"></div><a href="' . get_permalink() . '">' .  get_the_title() . '</a><div class="clear"></div><span>' . string_limit_words( $excerpt, 50 ) . '</span></li>';
				
				$product_entry .= '<div class="product_block' . $last . '"><div class="image_wrapper prod">' . get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image')) . '<div class="image_more_info">';
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'product-500');

				if ( $price_html = $product->get_price_html() ) { $price_html = '<span class="price">' . $price_html . '</span>'; } else $price_html = '';
				$product_entry .= '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto"><img src="' . get_template_directory_uri() . '/images/home/more.png" alt=""  class="customColorBg" /></a>
					</div><!-- image_more_info --><div class="image_read_more_wrapper"><div class="image_read_more"><a href="' . get_permalink() . '">' . __( 'Read More', 'allaround' ) . '</a></div></div><!-- image_read_more_wrapper -->' . $price_html . $add_to_cart . '</div><!-- image_wrapper --><h3><a href="' . get_permalink() . '">' .  get_the_title() . '</a></h3><span>' . string_limit_words( $excerpt, 50 ) . '</span></div><!-- product-block -->' . $clear;
			endwhile;

			if ( $related == 'yes' ) $product_category = (object) array('name' => __('Related Products', 'allaround'), 'description' => __('Check out these related products.', 'allaround')); elseif ( $upsells == 'yes' ) $product_category = (object) array('name' => __('Interesting Products', 'allaround'), 'description' => __('You might also like this products.', 'allaround')); elseif ( $category !== '-1' && ( $related == 'no' or $upsells == 'no' ) ) $product_category = (object) get_term_by('id', $category, 'product_cat'); elseif ( $category == '-1' && ( $related == 'no' or $upsells == 'no' )  ) $product_category = (object) array('name' => __('All Products', 'allaround'), 'description' => __('All Products are listed.', 'allaround'));

			$out .= '<div class="products_sidebar products"><h3>' . $product_category->name . '</h3><span class="subtitle customColor">' . $product_category->description . '</span><ul>';
			$out .= $product_sidebar;
			$out .= '</ul></div><!-- products_sidebar --><div class="products_content">';
			$out .= $product_entry;
			$out .= '</div><!-- products_content -->';
			
			$out .= '<div class="clear"></div>';
			if ( $pagination == 'yes' ) { if ( allaround_pagination($allaround_posts->max_num_pages, $paged, $ajax) ) { $out .= allaround_pagination($allaround_posts->max_num_pages, $paged, $ajax); } else { $out .= '<div class="pagination"></div>'; } } else { $out .= '<div class="pagination"></div>'; }
			$out .=  '</div>';
		endif;
	wp_reset_query();
	return $out;
}

// [blog]
function allaround_shortcode_blog( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 1,
		'category' => "-1",
		'rows' => 1,
		'order' => 'date',
		'ajax' => 'no',
		'related' => 'no',
		'values' => 'DESC',
		'pagination' => 'yes'
	), $atts ) );
	$out = '';
	$firstrow = 0;
	$post_counter = 0;
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
	if ( $ajax == 'yes' ) $paged = 1;
	switch ($type) {
		case 1 :
			$columns = 1;
			$class = '';
			$words = 512;
		break;
		case 2 :
			$columns = 1;
			$class = ' blog2';
			$words = 256;
		break;
		case 3 :
			$columns = 1;
			$class = ' blog2 blog3';		
			$words = 256;
		break;
		case 4 :
			$columns = 2;
			$class = ' blog2 blog2-2col';		
			$words = 256;
		break;
		case 5 :
			$columns = 3;
			$class = ' index_preview blog2 blog2-2col';		
			$words = 192;
		break;
		case 6 :
			$class = ' blog2 blog3 blog3-2col';
			$columns = 2;
			$words = 256;
		break;
		case 7 :
			$class = ' blog2 blog3 blog3-3col';
			$columns = 3;
			$words = 256;
		break;
	}
	$query_string = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $columns * $rows,
				'paged' => $paged,
		'orderby' => $order,
		'order' => $values
		);
	if ( $category !== "-1" ){
		$query_string = $query_string + array(
			'ignore_sticky_posts' => 1,
			'cat' => $category
			);
	}
	else {
		$query_string = $query_string + array(
			'ignore_sticky_posts' => 0
			);
	}
	if ( $related == 'yes' ) {
		global $post;
		$query_string['ignore_sticky_posts'] = 1;
		$query_string = $query_string + array(
			'post__not_in' => array($post->ID)
		);
	}
	if ( $order == 'comment_count' ) {
		$query_string['ignore_sticky_posts'] = 1;
	}
	$query_string_ajax = http_build_query($query_string);
	$allaround_posts = new WP_Query( $query_string );
	if ( $allaround_posts->have_posts() ) :
		$out .= "<div class='blog_content type-{$type}' data-string='{$query_string_ajax}'>";
		switch( $type ) {
			case 1 :
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				$out .= '<div class="blog_post_wrapper">';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="blog_post_main_content">';
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';
				 if ( has_post_thumbnail()) {
					$out .= '<div class="blog_image_wrap"><div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-full', array('class' => 'blog_post_image')); 
					$out .= '</a>';
					$out .= '</div><!-- blog_image_wrap -->';
				 }
				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post_wrapper -->';
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more float_right button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post -->';
				$out .= $clear;
			endwhile;
			break;
			case 2 :
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_socials">
							<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
							<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
							<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
							</div><!-- image_socials -->';
					$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg"/>'; 
					$out .= '</a></div><!-- image_more_info -->';
					$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$out .= '</div><!-- image_wrapper -->';
				}
				$out .= '<div class="blog_post_main_content">';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';
				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 -->';
				$out .= $clear;
			endwhile;
			break;
			case 3 :
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
					$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="blog_post_main_content">';
				$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog3 -->';
				$out .= $clear;
			endwhile;
			break;
			case 4 :
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_socials">
							<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
							<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
							<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
							</div><!-- image_socials -->';
					
					$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info -->';
					$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$out .= '</div><!-- image_wrapper -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="blog_post_main_content">';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog4-->';
				$out .= $clear;
			endwhile;
			break;
			case 5 :
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_socials">
							<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
							<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
							<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
							</div><!-- image_socials -->';
					
					$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info -->';
					$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$out .= '</div><!-- image_wrapper -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="blog_post_main_content">';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog4-->';
				$out .= $clear;
			endwhile;
			break;
			case 6 :
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $firstrow == 0 ) { $top = ' top'; } else $top = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $firstrow = 1; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . $top . '">';
				$out .= '<div class="blog_post_main_content">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
					$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				
				$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="clear"></div>';

				$out .= '<span class="blog_post_text"><div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog3 -->';
				$out .= $clear;
			endwhile;
			break;
			case 7 :
			while( $allaround_posts->have_posts() ): $allaround_posts->the_post();
				$post_counter++;
				$excerpt = get_the_excerpt();
				if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
				if ( $firstrow == 0 ) { $top = ' top'; } else $top = '';
				if ( $post_counter == $columns ) { $post_counter = 0; $firstrow = 1; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
				if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
				$out .= '<div class="blog_post' . $class . $last . $has_thumbail . $top . '">';
				if ( has_post_thumbnail()) {
					$out .= '<div class="image_wrapper">';
					$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
					$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
					$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
					$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
					$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper --><div class="clear"></div><!-- clear -->';
				}
				if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
				$out .= '<div class="blog_post_main_content">';
				$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
				$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
				$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span> | <span class="date">' . get_the_date() . '</span> | <span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

				$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
				$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!--  blog_post blog2 blog3 -->';
				$out .= $clear;
			endwhile;
			break;
		}
		$out .=  '<div class="clear"></div>';
		if ( $pagination == 'yes' ) { if ( allaround_pagination($allaround_posts->max_num_pages, $paged, $ajax) ) { $out .= allaround_pagination($allaround_posts->max_num_pages, $paged, $ajax); } else { $out .= '<div class="pagination"></div>'; } } else { $out .= '<div class="pagination"></div>'; }
		$out .=  '</div><div class="clear"></div>';
	endif;
	wp_reset_query();
	return $out;
}


// [twitter]
function allaround_shortcode_twitter( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'user' => '',
		'count' => 5
	), $atts ) );
	if ( $count <= 0 ) { return; }
	$out = '';
	$out .= allaround_twitter_feed( $user, $count );
	return $out;
}

// [team]
function allaround_shortcode_team( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'users' => '1'
	), $atts ) );
	$out = '';
	$out .= allaround_contacts( $users );
	return $out;
}

// [contactform]
function allaround_shortcode_contactform( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'users' => '1'
	), $atts ) );
	$out = '';
	$out .= allaround_contact_form( $users );
	return $out;
}

// [title]
function allaround_title( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'themecolor' => 'no'
	), $atts ) );
	$color = '';
	if ( $themecolor == 'yes' ) { $color = ' customColor'; }
	return  '<div class="headline_wrapper margin-bottom48 margin-top48"><div class="headline_inner_wrapper"><div class="line"></div><h2 class="main_header' . $color . '">' . $content . '</h2><div class="line"></div></div><!-- headline_inner_wrapper --></div><!-- headline_wrapper -->';
}

// [clientsslider]
function allaround_clientsslider( $atts, $content = null ) {
	$content = str_replace("<br />", "", $content);
	$out = "<div class='car_wrap'><div id='rcarousel2' class='margin-top48'>{$content}</div><a href='#' id='rcarousel2-next'></a><a href='#' id='rcarousel2-prev'></a></div>";
	return $out;
}

// [circles]
function allaround_circles( $atts, $content = null ) {
	if ( is_page() ) {
		global $allaround_sidebar;
		if ( $allaround_sidebar['sidebarclass'] !== 'no-sidebar' ) return;
	}
	else {
		return;
	}
	extract( shortcode_atts( array(
		'title' => '',
		'text' => '',
		'texttitle' => '',
		'last' => 'no'
	), $atts ) );
	if ( $last == 'yes' ) $class = ' column-last'; else $class = '';
	$circles = array ( 1 => "<span class='pop_up_bubble black' data-top='80' data-left='-20' data-radius='10'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='150' data-left='260' data-radius='20'></span><!-- pop_up_bubble --><span class='pop_up_bubble red' data-top='-10' data-left='-10' data-radius='35'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='180' data-left='-20' data-radius='30'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='60' data-left='260' data-radius='15'></span><!-- pop_up_bubble -->", 1 => "<span class='pop_up_bubble black' data-top='110' data-left='250' data-radius='15'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='0' data-left='-50' data-radius='50'></span><!-- pop_up_bubble --><span class='pop_up_bubble red' data-top='25' data-left='240' data-radius='40'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='-10' data-left='35' data-radius='15'></span><!-- pop_up_bubble --><span class='pop_up_bubble red' data-top='110' data-left='-55' data-radius='35'></span><!-- pop_up_bubble -->", 2 => "<span class='pop_up_bubble black' data-top='-10' data-left='35' data-radius='15'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='210' data-left='220' data-radius='20'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='130' data-left='-55' data-radius='35'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='-20' data-left='210' data-radius='35'></span><!-- pop_up_bubble --><span class='pop_up_bubble black' data-top='130' data-left='250' data-radius='15'></span><!-- pop_up_bubble -->");
	shuffle($circles);
	$out = "<div class='column column120 column-1-3 margin-bottom48 margin-top48 about_us center{$class}'><div class='circle_block_wrapper'><div class='circle_block'><h3>{$title}</h3>{$circles[0]}</div><!-- circle_block --><img src='" . get_template_directory_uri() . "/images/about_us/circle.png' alt='' class='dashed_bg' /></div><!-- circle_block_wrapper --><div class='text_wrapper'><h3>{$texttitle}</h3><span>{$text}</span></div><!-- text_wrapper --><div class='clear'></div><!--clear --></div><!-- column-1-3 -->";
	return $out;
}

// [aa_fw_box]
function allaround_fw_box( $atts, $content = null ) {
	if ( is_page() ) {
		global $allaround_sidebar;
		if ( $allaround_sidebar['sidebarclass'] !== 'no-sidebar' ) return;
	}
	else {
		return;
	}
	extract( shortcode_atts( array(
		'image' => '',
		'text' => ''
	), $atts ) );
 	wp_enqueue_script( 'js-paralax-banner', get_template_directory_uri() . '/js/parallax_banner.js', array( 'jquery' ), '1.0' ); 
	$out = "</div><!-- real_content --></div><!-- content --><div class='parallax_banner_wrapper margin-top24 margin-bottom48'><img src='{$image}' alt='' /><div class='banner_text_wrapper'><div class='banner_text'><div class='banner_text_inner'>{$text}</div><!-- banner_text_inner --></div><!-- banner_text --></div><!-- banner_text_wrapper --></div><!-- parallax_banner_wrapper --><div class='clear'></div><!--clear --><div class='content'><div class='real_content'>";
	return $out;
}

// [aa_fw_link]
function allaround_fw_link( $atts, $content = null ) {
	if ( is_page() ) {
		global $allaround_sidebar;
		if ( $allaround_sidebar['sidebarclass'] !== 'no-sidebar' ) return;
	}
	else {
		return;
	}
	extract( shortcode_atts( array(
		'title' => '',
		'link' => '#'
		//$btnBuy = __("BUY NOW", 'allaround');
	), $atts ) );
	$out = "<div class='clear'></div><!--clear --></div><!-- real_content --></div><!-- content --><div class='static_banner_wrapper margin-bottom48'><div class='inner_wrap'><div class='text'>{$title}</div><!-- text --><a href='{$link}' class='read_more static_banner_item_button_hover_effect ' data-hoveroutcolor='#e84c3d' data-hovercolor='#ffffff'>BUY NOW</a><!-- read_more --></div><!-- inner_wrap --></div><!-- static_banner_wrapper --><div class='content'><div class='real_content'>";
	return $out;
}

// Init shortcodes
add_action( 'init', 'allaround_shortcodes' );
function allaround_shortcodes() {
	add_shortcode( 'aa_one_third', 'allaround_one_third' );
	add_shortcode( 'aa_two_third', 'allaround_two_third' );
	add_shortcode( 'aa_one_half', 'allaround_one_half' );
	add_shortcode( 'aa_one_fourth', 'allaround_one_fourth' );
	add_shortcode( 'aa_three_fourth', 'allaround_three_fourth') ;
	add_shortcode( 'aa_clear', 'allaround_clear_row' );
	add_shortcode( 'aa_accordion', 'allaround_accordion' );
	add_shortcode( 'aa_accordion_section', 'allaround_accordion_section' );
	add_shortcode( 'aa_tabs', 'allaround_tabs' );
	add_shortcode( 'aa_tab', 'allaround_tab' );			
	add_shortcode( 'aa_progressbar', 'allaround_progress');
	add_shortcode( 'aa_divider', 'allaround_shortcode_divider' );
	add_shortcode( 'aa_bluebox', 'allaround_shortcode_blue_box' );
	add_shortcode( 'aa_greenbox', 'allaround_shortcode_green_box' );
	add_shortcode( 'aa_redbox', 'allaround_shortcode_red_box' );
	add_shortcode( 'aa_yellowbox', 'allaround_shortcode_yellow_box' );
	add_shortcode( 'aa_products', 'allaround_shortcode_products' );
	add_shortcode( 'aa_blog', 'allaround_shortcode_blog' );
	add_shortcode( 'aa_team', 'allaround_shortcode_team' );
	add_shortcode( 'aa_twitter', 'allaround_shortcode_twitter' );
	add_shortcode( 'aa_contactform', 'allaround_shortcode_contactform' );
	add_shortcode( 'aa_title', 'allaround_title' );
	add_shortcode( 'aa_clientsslider', 'allaround_clientsslider' );
	add_shortcode( 'aa_circles', 'allaround_circles' );
	add_shortcode( 'aa_fw_box', 'allaround_fw_box' );
	add_shortcode( 'aa_fw_link', 'allaround_fw_link' );
}
?>