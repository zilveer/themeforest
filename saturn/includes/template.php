<?php
if( !function_exists('saturn_wp_title') && !function_exists( '_wp_render_title_tag' ) ){
	function saturn_wp_title( $title, $sep ) {
		global $paged, $page;
		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'saturn' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'saturn_wp_title', 10, 2 );
}

if( !function_exists( 'saturn_post_classes' ) ){
	function saturn_post_classes( $classes ) {
		global $post;
		if( get_post_type( $post->ID ) == 'attachment' ){
			$classes[]	=	'post';
		}
		return $classes;
	}
	add_filter( 'post_class' , 'saturn_post_classes', 50, 1);
}

if( !function_exists( 'saturn_body_classes' ) ){
	function saturn_body_classes( $classes ){
		global $saturn_global_data;
		$layout	=	isset( $saturn_global_data['layout'] ) ? esc_attr( $saturn_global_data['layout'] ) : 'right-sidebar';		
		$cover_screen = isset( $saturn_global_data['cover_screen'] ) ? esc_attr( $saturn_global_data['cover_screen'] ) : 'no';
		if( $cover_screen == 'no' ){
			$classes[]	=	'no-cover-screen';
		}
		if( is_page_template( 'template-page-leftside.php' ) ){
			unset( $layout );
		}
		if( !empty( $layout ) ){
			$classes[]	=	$layout;
		}
		return $classes;
	}
	add_filter( 'body_class' , 'saturn_body_classes', 50, 1);
}

if( !function_exists( 'saturn_custom_sidebar' ) ){
	function saturn_custom_sidebar( $sidebar ) {
		global $post;
		if( ( is_single() || is_page() ) && isset( $post->ID )){
			$custom_sidebar = get_post_meta( $post->ID, 'custom_sidebar', true );
				
			if( empty( $custom_sidebar ) ){
				return $sidebar;
			}
			else{
				$sidebar = $custom_sidebar;
			}
		}
		return $sidebar;
	}
	add_filter( 'saturn_custom_sidebar' , 'saturn_custom_sidebar', 10, 1);
}

if( !function_exists( 'saturn_col_main_content_size' ) ){
	function saturn_col_main_content_size( $content = 'main' ) {
		$size = apply_filters( 'saturn_col_main_content_size' , 9);
		if( $content == 'main'){
			return $size;
		}
		return 12-$size;
	}
}

if( !function_exists( 'saturn_set_fullwidth_main_content' ) ){
	function saturn_set_fullwidth_main_content( $size ) {
		$is_empty = function_exists( 'saturn_get_primary_sidebar_counter' ) ? saturn_get_primary_sidebar_counter() : 0;
		if( $is_empty == 0 )
			return 12;
		return $size;
	}
	add_filter( 'saturn_col_main_content_size' , 'saturn_set_fullwidth_main_content', 20, 1);
}

if( !function_exists( 'saturn_set_fullwidth_thumbnail_main_content' ) ){
	function saturn_set_fullwidth_thumbnail_main_content( $size ) {
		$is_empty = function_exists( 'saturn_get_primary_sidebar_counter' ) ? saturn_get_primary_sidebar_counter() : 0;
		if( $is_empty == 0 )
			return 'full';
		return $size;		
	}
	add_filter( 'saturn_thumbnail_size' , 'saturn_set_fullwidth_thumbnail_main_content', 20, 1);
}

if( !function_exists( 'saturn_post_meta' ) ){
	function saturn_post_meta() {
		?>
			<div class="post-meta">
				<span class="post-date">
					<time class="entry-date" datetime="<?php the_time('c');?>"><a href="<?php print function_exists( 'saturn_get_post_archive_link' ) ? saturn_get_post_archive_link( get_the_ID() ) : '#';?>"><?php print get_the_date();?></a></time>
				</span>
				<span class="post-author">
					<?php printf( __('By %s','saturn'), '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author_meta('display_name').'</a>' );?>
				</span>
				<?php if( comments_open() && get_comments_number() > 0 ):?>
				<span class="post-comments">
					<a href="<?php comments_link();?>"><?php comments_number( '0', __('1 comment','saturn') , __('% comments','saturn') ); ?></a>
				</span>
				<?php endif;?>
				<?php if( saturn_get_post_views( get_the_ID() ) > 0 ):?>
				<span class="post-views">
					<?php if( saturn_get_post_views( get_the_ID() ) == 1 ):?>
						<?php printf( __('%s View','saturn'), saturn_get_post_views( get_the_ID() ) )?>
					<?php else:?>
						<?php printf( __('%s Views','saturn'), apply_filters( 'saturn_post_views_number' , saturn_get_post_views( get_the_ID() )) )?>
					<?php endif;?>
				</span>
				<?php endif;?>
			</div><!-- end post meta -->
		<?php 
	}
	add_action( 'saturn_post_meta' , 'saturn_post_meta', 10);
}

if( !function_exists( 'saturn_navigation' ) ){
	/**
	 * Display the page navigation.
	 * @param array $query
	 */
	function saturn_navigation( $query = null ) {
		global $wp_query;

		if( empty( $query ) )
			$query = $wp_query;
		if ( $query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		$args = array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 3,
			'type'	=>	'list',
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Prev', 'saturn' ),
			'next_text' => __( 'Next &rarr;', 'saturn' ),
		);

		// Set up paginated links.
		$links = paginate_links( apply_filters( 'saturn_navigation_args' , $args) );

		if ( $links ) :
		$links	=	str_ireplace( 'page-numbers' , 'pagination', $links);
		//echo '<div class="page-number">';
			echo $links;
		//echo '</div>';
		endif;
	}
}

if( !function_exists( 'saturn_post_format_content' ) ){
	function saturn_post_format_content() {
		global $post;
		if( !isset( $post->ID ) )
			return;
		if( post_password_required( $post ) )
			return;
		$post_format = get_post_format( $post );
		
		if( $post_format  == 'gallery' ){
			$_format_gallery_images = get_post_meta( $post->ID, '_format_gallery_images',true );
			if( is_array( $_format_gallery_images ) ){
				?>
					<div class="flexslider">
						<ul class="slides">
							<?php 
							for ($i = 0; $i < count( $_format_gallery_images ); $i++):
							$src = wp_get_attachment_image_src($_format_gallery_images[$i],apply_filters( 'saturn_thumbnail_size' , 'large'));
							?>
						  		<li><img src="<?php print esc_url( $src[0] );?>" alt="<?php print esc_attr( get_the_title( $_format_gallery_images[$i] ) );?>"></li>
						  	<?php endfor;?>
						</ul>   
					</div>				
				<?php
			}
		}
		elseif( $post_format == 'quote' ){
			$quote_source = get_post_meta( $post->ID, '_format_quote_source_url', true ) ? get_post_meta( $post->ID, '_format_quote_source_url', true ) : '#';
			if( $quote_source != '#' )
				$quote_source = esc_url( $quote_source );
			?>
				<blockquote>
					<?php the_content();?>
					<?php if( get_post_meta( $post->ID, '_format_quote_source_name', true ) ):?>
						<cite><a href="<?php print $quote_source;?>"><?php print esc_attr( get_post_meta( $post->ID, '_format_quote_source_name', true ) );?></a></cite>
					<?php endif;?>
				</blockquote>
			<?php 			
		}
		
		elseif( $post_format == 'video' || $post_format == 'audio' ){
			if( has_post_thumbnail( $post->ID ) && !is_single() ){
				?>
					<div class="post-thumbnail">
						<a href="<?php the_permalink();?>"><?php print get_the_post_thumbnail( $post->ID, apply_filters( 'saturn_thumbnail_size' , 'large') );?></a>
						<a href="<?php the_permalink();?>"><div class="img-hover"></div></a>
					</div>
				<?php 
				}
				else{
					saturn_get_embed_code( $post->ID );
				}			
		}
		else{
			if( has_post_thumbnail( $post->ID ) ){
				?>
					<div class="post-thumbnail">
						<?php if( is_single() ):?>
							<?php print get_the_post_thumbnail( $post->ID, apply_filters( 'saturn_thumbnail_size' , 'large') );?>
						<?php else:?>
							<a href="<?php the_permalink();?>"><?php print get_the_post_thumbnail( $post->ID, apply_filters( 'saturn_thumbnail_size' , 'large') );?></a>
						<?php endif;?>
					</div>
				<?php 
			}				
		}
	}
}

if( !function_exists( 'saturn_get_breadcrumbs' ) ){
	function saturn_get_breadcrumbs() {
		if ( function_exists('yoast_breadcrumb') ):
		?>
			<div class="breadcrumbs">
				<?php yoast_breadcrumb('<p id="breadcrumbs">','</p>');?>		
			</div><!-- end breadcrumbs -->		
		<?php 
		endif;
	}
	add_action( 'saturn_breadcrumbs' , 'saturn_get_breadcrumbs', 10);
}

if( !function_exists( 'saturn_cover_media' ) ){
	function saturn_cover_media() {
		global $saturn_global_data;
		// general settings.
		$cover_type = function_exists( 'saturn_get_cover_type' ) ? saturn_get_cover_type() : ''; // image or video
		if( apply_filters( 'saturn_cover_type' , $cover_type) != '' ):
			do_action( 'saturn_before_wrapper_cover_screen' );
			?>
				<div class="cover-background">
					<div class="color-overlay"></div>
					<?php
					// desktop version.
					if( $cover_type == 'image' ){
						// Image cover only.
						$image_url = function_exists( 'saturn_get_cover_media_url' ) ? saturn_get_cover_media_url( 'image' ) : '';
						$image_url	=	apply_filters( 'saturn_cover_media/imageurl' , $image_url);
						if( !empty( $image_url ) ){
							print '<div class="background" style="background-image: url('.esc_url( $image_url ).')"></div>';
						}
					}
					elseif( $cover_type == 'video' ){
						$videourl		=	function_exists( 'saturn_get_cover_media_url' ) ? saturn_get_cover_media_url() : '';
						$videourl		=	apply_filters( 'saturn_cover_media/videourl' , $videourl);
						$showControls	=	isset( $saturn_global_data['cover_video_showcontrols'] ) && $saturn_global_data['cover_video_showcontrols'] == 1 ? 'true' : 'false';
						$autoPlay 		=	isset( $saturn_global_data['cover_video_autoplay'] ) && $saturn_global_data['cover_video_autoplay'] == 1 ? 'true' : 'false';
						$loop			=	isset( $saturn_global_data['cover_video_loop'] ) && $saturn_global_data['cover_video_loop'] == 1 ? 'true' : 'false';
						$vol			=	isset( $saturn_global_data['cover_video_vol'] ) ? esc_attr( $saturn_global_data['cover_video_vol'] ) : '50';
						$mute			=	isset( $saturn_global_data['cover_video_mute'] ) && $saturn_global_data['cover_video_mute'] == 1 ? 'true' : 'false';
						$startat		=	isset( $saturn_global_data['cover_video_startat'] ) ? absint( $saturn_global_data['cover_video_startat'] ) : 0;
						$stopat			=	isset( $saturn_global_data['cover_video_stopat'] ) ? absint( $saturn_global_data['cover_video_stopat'] ) : 0;
						$opacity		=	isset( $saturn_global_data['cover_video_opacity'] ) ? esc_attr( $saturn_global_data['cover_video_opacity'] ) : 1;
						$quality		=	isset( $saturn_global_data['cover_video_quality'] ) ? esc_attr( $saturn_global_data['cover_video_quality'] ) : 'default';
						?>
						<div class="background" id="cover_video_background">
							<a id="bgndVideo" class="cover-player" data-property="{videoURL:'<?php print esc_url( $videourl );?>',containment:'#cover_video_background', showControls:<?php print $showControls;?>, autoplay:<?php print $autoPlay;?>, loop:<?php print $loop;?>, vol:<?php print $vol;?>, mute:<?php print $mute;?>, startAt:<?php print $startat;?>,stopAt:<?php print $stopat;?>, opacity:<?php print $opacity;?>, addRaster:false, quality:'<?php print $quality;?>, showYTLogo:false'}">
							</a>
						</div>							
						<?php 							
					}
					?>
					<div class="site-heading">
						<div class="site-heading-content">
							<?php if( isset( $saturn_global_data['heading'] ) && !empty( $saturn_global_data['heading'] ) ):?>
								<h1 class="site-title"><?php print apply_filters( 'saturn_heading_text' , esc_attr( $saturn_global_data['heading'] ));?></h1>
							<?php endif;?>
							<?php if( isset( $saturn_global_data['subheading'] ) && !empty( $saturn_global_data['subheading'] ) ):?>
								<h3 class="site-subtitle"><?php print apply_filters( 'saturn_subheading_text' , esc_attr( $saturn_global_data['subheading'] ));?></h3>
							<?php endif;?>
						</div>
					</div>
				</div>		
			<?php 
			do_action( 'saturn_after_wrapper_cover_screen' );
		endif;
	}
	add_action( 'saturn_cover_media' , 'saturn_cover_media', 10);
}

if( !function_exists( 'saturn_get_cover_type' ) ){
	function saturn_get_cover_type() {
		global $saturn_global_data;
		if( is_single() || is_page() ){
			global $post;
			if( get_post_meta( $post->ID, 'saturn_cover_screen', true ) ){
				return esc_attr( get_post_meta( $post->ID, 'saturn_cover_screen', true ) );
			}
		}
		if( isset( $saturn_global_data['cover_screen'] ) && $saturn_global_data['cover_screen'] != 'no' ){
			return esc_attr( $saturn_global_data['cover_screen'] );
		}
	}
}

if( !function_exists( 'saturn_get_cover_media_url' ) ){
	/**
	 * return the url of the video/image.
	 * @param unknown_type $type
	 */
	function saturn_get_cover_media_url( $type = '' ) {
		global $saturn_global_data;
		$type_post_meta = ( $type == 'image' ) ? 'saturn_cover_screen_imageurl' : 'saturn_cover_screen_videourl';
		$type_general	= ( $type == 'image' ) ? 'cover_background' : 'cover_video_url';
		if( is_single() || is_page() ){
			global $post;
			if( get_post_meta( $post->ID, $type_post_meta, true ) ){
				return get_post_meta( $post->ID, $type_post_meta, true );
			}
		}
		if( $type == 'image' && isset( $saturn_global_data['cover_screen'] ) && $saturn_global_data['cover_screen'] == 'image' ){
			if( isset( $saturn_global_data[ $type_general ]['url'] ) && !empty( $saturn_global_data[ $type_general ]['url'] ) ){
				return $saturn_global_data[ $type_general ]['url'];
			}
		}
		else{
			if( isset( $saturn_global_data[ 'cover_video_url' ] ) && !empty( $saturn_global_data[ 'cover_video_url' ] ) ){
				return $saturn_global_data[ 'cover_video_url' ];
			}
		}
	}
}

if( !function_exists( 'saturn_post_cover_heading' ) ){
	function saturn_post_cover_heading( $text ) {
		global $post;
		if( !isset( $post->ID ) )
			return $text;
		$post_cover_heading = get_post_meta( $post->ID, 'saturn_cover_screen_heading', true );
		if( empty( $post_cover_heading ) ){
			return $text;
		}
		else{
			return esc_attr( $post_cover_heading );
		}
	}
	add_filter( 'saturn_heading_text' , 'saturn_post_cover_heading', 10, 1);
}

if( !function_exists( 'saturn_post_cover_subheading' ) ){
	function saturn_post_cover_subheading( $text ) {
		global $post;
		if( !isset( $post->ID ) )
			return $text;
		$post_cover_subheading = get_post_meta( $post->ID, 'saturn_cover_screen_subheading', true );
		if( empty( $post_cover_subheading ) )
			return $text;
		return esc_attr( $post_cover_subheading );
	}
	add_filter( 'saturn_subheading_text' , 'saturn_post_cover_subheading', 10, 1);
}

if( !function_exists( 'saturn_get_post_cover_type' ) ){
	function saturn_get_post_cover_type( $post_id ) {
		if( !$post_id )
			return;
		$post_cover_type = get_post_meta( $post_id, 'saturn_cover_screen', true );
		if( !$post_cover_type )
			return 'no';
		return $post_cover_type;
	}
}

if( !function_exists('saturn_archive_heading') ){
	function saturn_archive_heading() {
		global $wp_query;
		if( is_singular( 'product' ) )
			return;
		?>
			<div class="archive-heading">
				<span class="browsing">
					<?php if( is_category() ):?>
						<?php _e('Browsing Category:','saturn');?>
					<?php elseif( is_tag() ):?>
						<?php _e('Browsing Tag:','saturn');?>
					<?php elseif( is_search() ):?>
						<?php printf( __('Search: "%s"','saturn'),  get_query_var( 's' ));?>
					<?php elseif( is_author() ):?>
						<?php _e('Browsing Author:','saturn');?>
					<?php else:?>
						<?php _e('Browsing Archive:','saturn');?>
					<?php endif;?>
				</span>
				<h2>
				    <?php if ( is_day() ) : ?>
				        <?php printf( __( 'Daily Archives: <span>%s</span>', 'saturn' ), get_the_date() ); ?>
				    <?php elseif ( is_month() ) : ?>
				        <?php printf( __( 'Monthly Archives: <span>%s</span>', 'saturn' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'saturn' ) ) ); ?>
				    <?php elseif ( is_year() ) : ?>
				        <?php printf( __( 'Yearly Archives: <span>%s</span>', 'saturn' ), get_the_date( _x( 'Y', 'yearly archives date format', 'saturn' ) ) ); ?>
				    <?php elseif( is_search() ):?>
				    	<?php if( $wp_query->found_posts > 0 ):?>
				    		<?php printf( __('About %s results','saturn') , $wp_query->found_posts )?>
				    	<?php endif;?>
				    <?php elseif( is_author() ):?>
				    	<?php print esc_attr( $wp_query->queried_object->data->display_name );?>
				    <?php else : ?>
				        <?php print esc_attr( $wp_query->queried_object->name );?>
				    <?php endif; ?>					
				</h2>
			</div>		
		<?php 
	}
	add_action('saturn_archive_heading', 'saturn_archive_heading', 10);
}

if( !function_exists( 'saturn_wp_link_pages' ) ){
	function saturn_wp_link_pages( $content ) {
		ob_start();
		$args = array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'saturn' ),
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		);		
		wp_link_pages( apply_filters( 'saturn_wp_link_pages_args' , $args) );
		$the_link_pages = ob_get_clean();
		return $content . $the_link_pages;
	}
	add_action( 'the_content' , 'saturn_wp_link_pages', 7, 1);
}

if( !function_exists( 'saturn_post_tag_category' ) ){
	function saturn_post_tag_category( $content ) {
		global $post;
		if( !is_single() || get_post_format( $post ) == 'quote' )
			return $content;
		ob_start();
		?>
			<?php if( has_category() ):?>
				<div class="post-category">
					<span class="meta-info"><?php _e('Category: ','saturn');?></span><?php the_category(', ');?>			
				</div>
			<?php endif;?>
			<?php if( has_tag() ):?>
			<div class="post-tags">
				<?php the_tags();?>			
			</div>
			<?php endif;?>		
		<?php 
		return $content . ob_get_clean();
	}
	add_action( 'the_content' , 'saturn_post_tag_category', 10, 1);
}

if( !function_exists('saturn_filter_tag_cloud') ){
	function saturn_filter_tag_cloud( $args ) {
		$args['smallest'] = 8;
		$args['largest'] = 16;
		return $args;
	}
	add_filter( 'widget_tag_cloud_args', 'saturn_filter_tag_cloud' );
}

if( !function_exists( 'saturn_modify_read_more_link' ) ){
	function saturn_modify_read_more_link() {
		return '<span class="read-more"><a class="more-link" href="' . get_permalink() . '">'.__( 'Continue reading <span class="readmore">&rarr;</span>', 'saturn' ).'</a></span>';
	}	
	add_filter( 'the_content_more_link', 'saturn_modify_read_more_link' );
}

if( !class_exists('Saturn_Walker_Nav_Menu') ){
	class Saturn_Walker_Nav_Menu extends Walker_Nav_Menu {
		function start_lvl(&$output, $depth = 0, $args = array()) {
			$output .= "\n<ul class=\"dropdown-menu dropdown\">\n";
		}
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			$item_html = '';
			parent::start_el($item_html, $item, $depth, $args);

			if ( $item->is_dropdown && $depth === 0 ) {
				//if ( $item->is_dropdown ) {
				//$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html );
				$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html );
				$item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );
			}

			$output .= $item_html;
		}
		function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
			if ( $element->current )
				$element->classes[] = 'active';

			$element->is_dropdown = !empty( $children_elements[$element->ID] );

			if ( $element->is_dropdown ) {
				if ( $depth === 0 ) {
					$element->classes[] = 'dropdown';
				} elseif ( $depth === 1 ) {
					// Extra level of dropdown menu,
					// as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
					$element->classes[] = 'dropdown-submenu';
				}
			}
			parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}
	}
}

if( !function_exists( 'saturn_infinite_scroll' ) ){
	function saturn_infinite_scroll( $args ) {
		global $saturn_global_data;
		$type			=	isset( $saturn_global_data['infinite-type'] ) ? esc_attr( $saturn_global_data['infinite-type'] ) : 'scroll';
		$posts_per_page	=	isset( $saturn_global_data['infinite_posts_per_page'] ) ? absint( $saturn_global_data['infinite_posts_per_page'] ) : get_option( 'posts_per_page' );
		if( function_exists( 'is_shop' ) && is_shop() ){
			$posts_per_page = get_option( 'posts_per_page' );
		}
		$args['type']	=	$type;
		$args['posts_per_page']	=	$posts_per_page;
		return $args;
	}
	add_filter( 'saturn_infinite_scroll' , 'saturn_infinite_scroll', 10, 1);
}

if( !function_exists( 'saturn_user_contactmethods' ) ){
	function saturn_user_contactmethods( $fields ) {
		$fields['googleplus'] = __( 'Google Plus','saturn' );
		$fields['facebook'] = __( 'Facebook','saturn' );
		$fields['twitter'] = __( 'Twitter username (without @)','saturn' );
		$fields['instagram'] = __( 'Instagram','saturn' );
		$fields['tumblr'] = __( 'Tumblr','saturn' );
		$fields['youtube'] = __( 'Youtube','saturn' );
		$fields['linkedin'] = __( 'LinkedIn','saturn' );
		$fields['flickr'] = __( 'Flickr','saturn' );
		$fields['weibo'] = __( 'Weibo','saturn' );
		$fields['pinterest'] = __( 'Pinterest','saturn' );
		return apply_filters( 'saturn_user_contactmethods_fields' , $fields);
	}
	add_filter('user_contactmethods','saturn_user_contactmethods',20,1);
}

if( !function_exists( 'saturn_author_social_links' ) ){
	function saturn_author_social_links() {
		if( !is_single() )
			return;
		$author_id = get_the_author_meta( 'ID' );
		if( empty( $author_id ) )
			return;
		$fields	= function_exists( 'saturn_user_contactmethods' ) ? saturn_user_contactmethods( array() ) : null;
		if( is_array( $fields ) && !empty( $fields ) ){
			?>
				<ul class="author-socials">
					<?php foreach ( $fields  as $key=>$value) {
						if( get_user_meta( $author_id, $key, true ) ){
							$url = get_user_meta( $author_id, $key, true );
							if( $key == 'twitter' ){
								$twitter_url = 'https://twitter.com/' . $url;
								print '<li><a href="'.esc_url( $twitter_url ).'" target="_blank"><i class="fa fa-'.esc_attr( $key ).'"></i></a></li>';
							}
							elseif( $key == 'googleplus' ){
								print '<li><a href="'.esc_url( $url ).'" target="_blank"><i class="fa fa-google-plus"></i></a></li>';
							}
							else{
								print '<li><a href="'.esc_url( $url ).'" target="_blank"><i class="fa fa-'.esc_attr( $key ).'"></i></a></li>';
							}
						}
					}?>
					<?php 
					if( get_the_author_meta( 'user_url' ) ){
						print '<li><a href="'.esc_url( get_the_author_meta( 'user_url' ) ).'" target="_blank"><i class="fa fa-link"></i></a></li>';
					}
					?>
				</ul>			
			<?php 
		}
	}
	add_action( 'saturn_author_social_links' , 'saturn_author_social_links', 10);
}

if( !function_exists( 'saturn_display_authorbox' ) ){
	function saturn_display_authorbox( $boolean ) {
		global $saturn_global_data;
		$authorbox	=	isset( $saturn_global_data['authorbox'] ) && $saturn_global_data['authorbox'] == 1 ? true : false;
		$boolean = $authorbox;
		return $boolean;
	}
	add_filter( 'saturn_authorbox_activate' , 'saturn_display_authorbox', 10, 1);
}
if( !function_exists('saturn_add_custom_css') ){
	function saturn_add_custom_css() {
		global $saturn_global_data;
		$css = NULL;
		if( isset( $saturn_global_data['custom_css'] ) && trim( $saturn_global_data['custom_css'] ) != '' ){
			$css = '<style>'.esc_attr( $saturn_global_data['custom_css'] ).'</style>';
		}
		print $css;
	}
	add_action('wp_head', 'saturn_add_custom_css');
}
if( !function_exists('saturn_add_custom_js') ){
	function saturn_add_custom_js() {
		global $saturn_global_data;
		$js = NULL;
		if( isset( $saturn_global_data['custom_js'] ) && trim( $saturn_global_data['custom_js'] ) != '' ){
			$js .= '<script>jQuery(document).ready(function(){'. $saturn_global_data['custom_js'] .'});</script>';
		}
		print $js;
	}
	add_action('wp_footer', 'saturn_add_custom_js');
}

if( !function_exists('saturn_show_favicon') ){
	function saturn_show_favicon() {
		global $saturn_global_data;
		if( isset( $saturn_global_data['favicon']['url'] ) && esc_url( $saturn_global_data['favicon']['url'] ) ){
			print '<link rel="shortcut icon" href="'.esc_url( $saturn_global_data['favicon']['url'] ).'">';
		}
	}
	add_action('wp_head', 'saturn_show_favicon');
}

if( !function_exists( 'saturn_remove_jp_related_posts' ) ){
	function saturn_remove_jp_related_posts() {
		if( class_exists( 'Jetpack_RelatedPosts' ) ){
			$jprp = Jetpack_RelatedPosts::init();
			$callback = array( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );			
		}
	}
	add_filter( 'wp', 'saturn_remove_jp_related_posts', 20 );	
}

if( !function_exists( 'saturn_remove_jp_sharing_display' ) ){
	function saturn_remove_jp_sharing_display() {
		global $post;
		if( get_post_format( $post ) == 'quote' && is_single() ){
			remove_filter( 'the_content', 'sharing_display', 19 );
			remove_filter( 'the_excerpt', 'sharing_display', 19 );
		}		
	}
	add_action( 'wp' , 'saturn_remove_jp_sharing_display', 20);
}
/** jetpack related posts **/
if( !function_exists( 'saturn_jetpackme_related_posts_headline' ) ){
	/**
	 * Set the headline of Jetpack related posts feature.
	 * @param string $headline
	 * @return string
	 */
	function saturn_jetpackme_related_posts_headline( $headline ) {
		global $saturn_global_data;
		$new_headline = isset( $saturn_global_data['jetpack_related_posts_headline'] ) ? esc_attr( $saturn_global_data['jetpack_related_posts_headline'] ) : __('Related','long');
		$headline = sprintf('<h3 class="jp-relatedposts-headline"><em>%s</em></h3>',esc_attr( $new_headline ));
		return $headline;
	}
	add_filter( 'jetpack_relatedposts_filter_headline', 'saturn_jetpackme_related_posts_headline', 10, 1);
}

if( !function_exists( 'saturn_jetpackme_more_related_posts' ) ){
	function saturn_jetpackme_more_related_posts( $options ) {
		global $saturn_global_data;
		$showposts = isset( $saturn_global_data['jetpack_related_showposts'] ) ? absint( $saturn_global_data['jetpack_related_showposts'] ) : 3;
		$options['size'] = $showposts;
		return $options;
	}
	add_filter( 'jetpack_relatedposts_filter_options', 'saturn_jetpackme_more_related_posts', 20, 1 );
}

if( !function_exists( 'saturn_jetpackme_exclude_related_post' ) ){
	/**
	 * Exclude the Posts.
	 * @param unknown_type $exclude_post_ids
	 * @param unknown_type $post_id
	 * @return unknown
	 */
	function saturn_jetpackme_exclude_related_post( $exclude_post_ids, $post_id ) {
		global $saturn_global_data;
		$exclude_posts = isset( $saturn_global_data['jetpack_related_exclude_posts'] ) ? esc_attr( $saturn_global_data['jetpack_related_exclude_posts'] ) : null;
		if( empty( $exclude_posts ) )
			return $exclude_post_ids;
		$exclude_posts	=	explode( "," , $exclude_posts);
		if( is_array( $exclude_posts ) ){
			for ($i = 0; $i < count( $exclude_posts ); $i++) {
				$exclude_post_ids[] = $exclude_posts[$i];
			}
		}
		return $exclude_post_ids;
	}
	add_filter( 'jetpack_relatedposts_filter_exclude_post_ids', 'saturn_jetpackme_exclude_related_post', 100, 2);
}

if( !function_exists( 'saturn_jetpackme_filter_exclude_category' ) ){
	/**
	 * Exclude the Category.
	 * @param unknown_type $filters
	 * @return multitype:multitype:multitype:string
	 */
	function saturn_jetpackme_filter_exclude_category( $filters ) {
		global $saturn_global_data;
		$exclude_cat = isset( $saturn_global_data['jetpack_related_exclude_categories'] ) ? absint( $saturn_global_data['jetpack_related_exclude_categories'] ) : null;
		if( empty( $exclude_cat ) )
			return $filters;

		$term = get_term_by('id', $exclude_cat, 'category');

		$filters[] = array( 'not' =>
				array( 'term' => array( 'category.slug' => $term->slug ) )
		);
		return $filters;
	}
	add_filter( 'jetpack_relatedposts_filter_filters', 'saturn_jetpackme_filter_exclude_category', 100, 1 );
}
if( !function_exists( 'saturn_related_products_args' ) ){
	function saturn_related_products_args( $args ) {
		global $woocommerce_loop;
		$args['posts_per_page'] = 4; // 4 related products
		return $args;
	}
	add_filter( 'woocommerce_output_related_products_args', 'saturn_related_products_args' );
}