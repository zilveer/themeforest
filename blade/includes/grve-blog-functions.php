<?php

/*
 *	Blog Helper functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


 /**
 * Prints excerpt
 */
function blade_grve_print_post_excerpt() {

	$excerpt_length = blade_grve_option( 'blog_excerpt_length' );
	$excerpt_more = blade_grve_option( 'blog_excerpt_more' );

	if ( 'large' != blade_grve_option( 'blog_style', 'large' ) ) {
		$excerpt_length = blade_grve_option( 'blog_excerpt_length_small' );
		$excerpt_auto = '1';
	} else {
		$excerpt_length = blade_grve_option( 'blog_excerpt_length' );
		$excerpt_auto = blade_grve_option( 'blog_auto_excerpt' );
	}

	if ( '1' == $excerpt_auto ) {
		echo blade_grve_excerpt( $excerpt_length, $excerpt_more  );
	} else {
		if ( '1' == $excerpt_more ) {
			the_content( esc_html__( 'read more', 'blade' ) );
		} else {
			the_content( '' );
		}
	}

}

function blade_grve_isotope_inner_before() {
	$blog_style = blade_grve_option( 'blog_style', 'large' );
	if ( 'large' != $blog_style && 'small' != $blog_style ) {
		echo '<div class="grve-isotope-item-inner">';
	}
}
function blade_grve_isotope_inner_after() {
	$blog_style = blade_grve_option( 'blog_style', 'large' );
	if ( 'large' != $blog_style && 'small' != $blog_style ) {
		echo '</div>';
	}
}
add_action( 'blade_grve_inner_post_loop_item_before', 'blade_grve_isotope_inner_before' );
add_action( 'blade_grve_inner_post_loop_item_after', 'blade_grve_isotope_inner_after' );

function blade_grve_get_loop_title_heading_tag() {

	$heading = blade_grve_option( 'blog_heading_tag', 'auto' );
	$blog_style = blade_grve_option( 'blog_style', 'large' );

	if( 'auto' != $heading ) {
		$title_tag = $heading;
	} else {
		$title_tag = 'h3';
		if( 'large' == $blog_style || 'small' == $blog_style  ) {
			$title_tag = 'h2';
		}
	}
	return $title_tag;
}

function blade_grve_get_loop_title_heading() {

	$heading = blade_grve_option( 'blog_heading', 'auto' );
	$blog_style = blade_grve_option( 'blog_style', 'large' );

	if( 'auto' != $heading ) {
		$heading_class = $heading;
	} else {
		$heading_class = 'h3';
		if( 'large' == $blog_style || 'small' == $blog_style  ) {
			$heading_class = 'h2';
		}
	}
	return $heading_class;
}

function blade_grve_loop_post_title( $class = "grve-post-title" ) {
	$title_tag = blade_grve_get_loop_title_heading_tag();
	$title_class = blade_grve_get_loop_title_heading();
	the_title( '<' . tag_escape( $title_tag ) . ' class="' . esc_attr( $class ). 'grve-' . esc_attr( $title_class ) . '" itemprop="name headline">', '</' . tag_escape( $title_tag ) . '>' );
}function blade_grve_loop_post_title_link() {
	$title_tag = blade_grve_get_loop_title_heading_tag();
	$title_class = blade_grve_get_loop_title_heading();
	the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><' . tag_escape( $title_tag ) . ' class="grve-title grve-text-hover-primary-1 grve-' . esc_attr( $title_class ) . '" itemprop="name headline">', '</' . tag_escape( $title_tag ) . '></a>' );
}
function blade_grve_loop_post_title_hidden() {
	$title_tag = blade_grve_get_loop_title_heading_tag();
	the_title( '<' . tag_escape( $title_tag ) . ' class="grve-hidden" itemprop="name headline">', '</' . tag_escape( $title_tag ) . '>' );
}


add_action( 'blade_grve_inner_post_loop_item_title', 'blade_grve_loop_post_title' );
add_action( 'blade_grve_inner_post_loop_item_title_link', 'blade_grve_loop_post_title_link' );
add_action( 'blade_grve_inner_post_loop_item_title_hidden', 'blade_grve_loop_post_title_hidden' );

 /**
 * Prints Single Post Title
 */
if ( !function_exists('blade_grve_print_post_simple_title') ) {
	function blade_grve_print_post_simple_title() {
		the_title( '<h2 class="grve-hidden" itemprop="name headline">', '</h2>' );
	}
}


/**
 * Gets Blog Class
 */
function blade_grve_get_blog_class() {

	$blog_style = blade_grve_option( 'blog_style', 'large' );
	$blog_mode = blade_grve_option( 'blog_mode', 'no-shadow-mode' );
	$blog_item_style = blade_grve_option( 'blog_item_style', '1' );
	switch( $blog_style ) {

		case 'small':
			$grve_blog_style_class = 'grve-blog grve-blog-small grve-non-isotope';
			break;
		case 'masonry':
			$grve_blog_style_class = 'grve-blog grve-blog-columns grve-blog-masonry grve-isotope grve-with-gap';
			break;
		case 'grid':
			$grve_blog_style_class = 'grve-blog grve-blog-columns grve-blog-grid grve-isotope grve-with-gap';
			break;
		case 'large':
		default:
			$grve_blog_style_class = 'grve-blog grve-blog-large grve-non-isotope';
			break;

	}

	if ( 'shadow-mode' == $blog_mode && ( 'masonry' == $blog_style || 'grid' == $blog_style ) ) {
		$grve_blog_style_class .= ' grve-with-shadow';
	}
	if ( 'masonry' == $blog_style || 'grid' == $blog_style ) {
		$grve_blog_style_class .= ' grve-style-' . $blog_item_style;
	}

	return $grve_blog_style_class;

}
/**
 * Gets post class
 */
function blade_grve_get_post_class( $extra_class = '' ) {

	$blog_style = blade_grve_option( 'blog_style', 'large' );
	$post_classes = array( 'grve-blog-item' );
	if ( !empty( $extra_class ) ){
		$post_classes[] = $extra_class;
	}

	switch( $blog_style ) {

		case 'small':
			$post_classes[] = 'grve-small-post';
			$post_classes[] = 'grve-non-isotope-item';
			break;

		case 'masonry':
		case 'grid':
			$post_classes[] = 'grve-isotope-item';
			break;
		default:
			$post_classes[] = 'grve-big-post';
			$post_classes[] = 'grve-non-isotope-item';
			break;
	}

	return implode( ' ', $post_classes );

}

/**
 * Prints post item data
 */
function blade_grve_print_blog_data() {

	$blog_style = blade_grve_option( 'blog_style', 'large' );
	$columns = blade_grve_option( 'blog_columns', '4' );
	$columns_tablet_landscape  = blade_grve_option( 'blog_columns_tablet_landscape', '4' );
	$columns_tablet_portrait  = blade_grve_option( 'blog_columns_tablet_portrait', '2' );
	$columns_mobile  = blade_grve_option( 'blog_columns_mobile', '1' );
	$item_spinner  = blade_grve_option( 'blog_item_spinner', 'no' );


	switch( $blog_style ) {

		case 'masonry':
			echo 'data-columns="' . esc_attr( $columns ) . '" data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '" data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '" data-columns-mobile="' . esc_attr( $columns_mobile ) . '" data-layout="masonry" data-spinner="' . esc_attr( $item_spinner ) . '"';
			break;
		case 'grid':
			echo 'data-columns="' . esc_attr( $columns ) . '" data-columns-tablet-landscape="' . esc_attr( $columns_tablet_landscape ) . '" data-columns-tablet-portrait="' . esc_attr( $columns_tablet_portrait ) . '" data-columns-mobile="' . esc_attr( $columns_mobile ) . '" data-layout="fitRows" data-spinner="' . esc_attr( $item_spinner ) . '"';
			break;
		default:
			break;
	}

}

 /**
 * Prints post feature media
 */
function blade_grve_print_post_feature_media( $post_type ) {

	blade_grve_print_post_image_meta();
	if ( !blade_grve_visibility( 'blog_media_area', '1' ) ){
		return;
	}
	$blog_image_prio = blade_grve_option( 'blog_image_prio', 'no' );
	$blog_style = blade_grve_option( 'blog_style', 'large' );

	if ( 'yes' == $blog_image_prio && has_post_thumbnail() ) {
		blade_grve_print_post_feature_image();
	} else {

		switch( $post_type ) {
			case 'audio':
				blade_grve_print_post_audio();
				break;
			case 'video':
				blade_grve_print_post_video();
				break;
			case 'gallery':
				$slider_items = blade_grve_post_meta( 'grve_post_slider_items' );
				switch( $blog_style ) {
					case 'small':
					case 'grid':
						$image_size = 'blade-grve-small-rect-horizontal-wide';
						break;
					case 'masonry' :
						$image_size  = 'blade-grve-small-rect-horizontal';
						break;
					default:
						$image_size = 'blade-grve-large-rect-horizontal';
						break;
				}
				if ( !empty( $slider_items ) ) {
					blade_grve_print_gallery_slider( 'slider', $slider_items, $image_size  );
				}
				break;
			default:
				blade_grve_print_post_feature_image();
				break;
		}
	}

}


 /**
 * Prints post feature image
 */
function blade_grve_print_post_feature_image() {

	$blog_style = blade_grve_option( 'blog_style', 'large' );
	$blog_image_mode = blade_grve_option( 'blog_image_mode', 'auto' );

	switch( $blog_style ) {

		case 'small':
			$image_size = 'blade-grve-small-rect-horizontal';
			 if ( 'resize' == $blog_image_mode ) {
				$image_size  = 'large';
			 }
			break;
		case 'grid':
			$image_size = 'blade-grve-small-rect-horizontal-wide';
			 if ( 'resize' == $blog_image_mode ) {
				$image_size  = 'large';
			 }
			break;
		case 'masonry' :
			$image_size  = 'large';
			break;
		case 'large':
		default:
			$image_size = 'blade-grve-large-rect-horizontal';
			 if ( 'resize' == $blog_image_mode ) {
				$image_size  = 'blade-grve-fullscreen';
			}
			break;
	}

	$image_href = get_permalink();

	if ( has_post_thumbnail() ) {
?>
	<div class="grve-media clearfix">
		<a href="<?php echo esc_url( $image_href ); ?>"><?php the_post_thumbnail( $image_size ); ?></a>
	</div>
<?php
	}

}

 /**
 * Prints post meta area
 */
if ( !function_exists('blade_grve_print_post_meta_top') ) {
	function blade_grve_print_post_meta_top() {

		$blog_style = blade_grve_option( 'blog_style', 'large' );
		$blog_item_style = blade_grve_option( 'blog_item_style', '1' );
		if ( '1' == $blog_item_style || ( 'masonry' != $blog_style && 'grid' != $blog_style ) ) {
?>
			<ul class="grve-post-meta grve-small-text grve-list-divider">
				<?php blade_grve_print_post_author_by( 'list'); ?>
				<?php blade_grve_print_post_date( 'list' ); ?>
				<?php blade_grve_print_post_loop_comments(); ?>
				<?php blade_grve_print_like_counter_overview(); ?>
			</ul>
<?php
		}
	}
}

if ( !function_exists('blade_grve_print_post_meta_bottom') ) {
	function blade_grve_print_post_meta_bottom() {

		$blog_style = blade_grve_option( 'blog_style', 'large' );
		$blog_item_style = blade_grve_option( 'blog_item_style', '1' );
		if ( '2' == $blog_item_style && ( 'masonry' == $blog_style || 'grid' == $blog_style ) ) {
?>
			<div class="grve-post-meta-wrapper grve-border-top grve-border ">
				<div class="grve-post-icon grve-bg-primary-1"></div>
				<ul class="grve-post-meta grve-small-text grve-list-divider grve-text-content">
					<?php blade_grve_print_post_author_by( 'list'); ?>
					<?php blade_grve_print_post_date( 'list' ); ?>
					<?php blade_grve_print_post_loop_comments(); ?>
					<?php blade_grve_print_like_counter_overview(); ?>
				</ul>
			</div>
<?php
		}
	}
}

 /**
 * Prints post author by
 */
function blade_grve_print_post_author_by( $mode = '') {

	if ( blade_grve_visibility( 'blog_author_visibility', '1' ) ) {

		if( 'list' == $mode ) {
			echo '<li class="grve-post-author" itemprop="author" itemscope="" itemtype="http://schema.org/Person">';
		} else {
			echo '<div class="grve-post-author" itemprop="author" itemscope="" itemtype="http://schema.org/Person">';
		}
?>
			<span><?php esc_html_e( 'By:', 'blade' ) . ' '; ?></span><span itemprop="name"><?php the_author_posts_link(); ?></span>
<?php
		if( 'list' == $mode ) {
			echo '</li>';
		} else {
			echo '</div>';
		}
	}
}

 /**
 * Prints like counter for overview pages
 */
function blade_grve_print_like_counter_overview() {

	if( blade_grve_visibility( 'blog_like_visibility', '1' ) ) {
		blade_grve_print_like_counter();
	}

}

 /**
 * Prints like counter
 */
function blade_grve_print_like_counter() {

	$post_likes = blade_grve_option( 'post_social', '', 'grve-likes' );
	if ( !empty( $post_likes  ) ) {
		global $post;
		$post_id = $post->ID;
?>
		<li class="grve-like-counter <?php echo blade_grve_likes( $post_id, 'status' ); ?>"><i class="fa fa-heart-o"></i><span><?php echo blade_grve_likes( $post_id ); ?></span></li>
<?php
	}

}

/**
 * Prints post date
 */
function blade_grve_print_post_date( $mode = '' ) {
	if ( blade_grve_visibility( 'blog_date_visibility' ) ) {
		if( 'list' == $mode ) {
			echo '<li class="grve-post-date">';
		}
		global $post;
?>
	<time itemprop="datePublished" datetime="<?php echo mysql2date( 'c', $post->post_date ); ?>">
		<?php echo esc_html( get_the_date() ); ?>
	</time>
<?php
		if( 'list' == $mode ) {
			echo '</li>';
		}
	}
}

function blade_grve_print_post_loop_comments() {
	if ( blade_grve_visibility( 'blog_comments_visibility' ) ) {
?>
	<li class="grve-post-comments"><a href="<?php echo esc_url( get_permalink() ); ?>#commentform"><i class="fa fa-comment-o"></i> <?php comments_number( '0' , '1', '%' ); ?></a></li>
<?php
	}
}

/**
 * Prints post date meta
 */
function blade_grve_print_post_date_meta( $fallback = '') {
	global $post;

	if ( !empty( $fallback ) ) {
		if ( !blade_grve_visibility( 'blog_date_visibility' ) ) {
?>
		<meta itemprop="datePublished" content="<?php echo mysql2date( 'c', $post->post_date ); ?>"/>
<?php
		}
	} else {
?>
	<meta itemprop="datePublished" content="<?php echo mysql2date( 'c', $post->post_date ); ?>"/>
<?php
	}
}

/**
 * Prints author avatar
 */
function blade_grve_print_post_author() {
	global $post;
	$post_id = $post->ID;
	$post_type = get_post_type( $post_id );

	if ( 'page' == $post_type ||  'portfolio' == $post_type  ) {
		return;
	}
?>
	<div class="grve-post-author">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
	</div>
<?php

}

/**
 * Prints post image meta
 */
function blade_grve_print_post_image_meta() {
	//Microdata for image
	$feat_image_url = "";
	if ( has_post_thumbnail() ) {
		$feat_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
	} else {
		$feat_image_url = get_template_directory_uri() . '/images/empty/thumbnail.jpg';
	}
?>
	<meta itemprop="image" content="<?php echo esc_url( $feat_image_url ); ?>"/>
<?php
}

/**
 * Prints audio shortcode of post format audio
 */
function blade_grve_print_post_audio() {
	global $wp_embed;

	$audio_mode = blade_grve_post_meta( 'grve_post_type_audio_mode' );
	$audio_mp3 = blade_grve_post_meta( 'grve_post_audio_mp3' );
	$audio_ogg = blade_grve_post_meta( 'grve_post_audio_ogg' );
	$audio_wav = blade_grve_post_meta( 'grve_post_audio_wav' );
	$audio_embed = blade_grve_post_meta( 'grve_post_audio_embed' );

	blade_grve_print_post_image_meta();

	$audio_output = '';

	if( empty( $audio_mode ) && !empty( $audio_embed ) ) {
		echo '<div class="grve-media">';
		echo wp_kses_post( $audio_embed );
		echo '</div>';
	} else {
		if ( !empty( $audio_mp3 ) || !empty( $audio_ogg ) || !empty( $audio_wav ) ) {

			$audio_output .= '[audio ';

			if ( !empty( $audio_mp3 ) ) {
				$audio_output .= 'mp3="'. esc_url( $audio_mp3 ) .'" ';
			}
			if ( !empty( $audio_ogg ) ) {
				$audio_output .= 'ogg="'. esc_url( $audio_ogg ) .'" ';
			}
			if ( !empty( $audio_wav ) ) {
				$audio_output .= 'wav="'. esc_url( $audio_wav ) .'" ';
			}

			$audio_output .= ']';

			echo '<div class="grve-media">';
			echo  do_shortcode( $audio_output );
			echo '</div>';
		}
	}

}

/**
 * Prints video of the video post format
 */
function blade_grve_print_post_video() {

	$video_mode = blade_grve_post_meta( 'grve_post_type_video_mode' );
	$video_webm = blade_grve_post_meta( 'grve_post_video_webm' );
	$video_mp4 = blade_grve_post_meta( 'grve_post_video_mp4' );
	$video_ogv = blade_grve_post_meta( 'grve_post_video_ogv' );
	$video_poster = blade_grve_post_meta( 'grve_post_video_poster' );
	$video_embed = blade_grve_post_meta( 'grve_post_video_embed' );

	blade_grve_print_post_image_meta();
	blade_grve_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed, $video_poster );
}

/**
 * Prints a bar with tags and categories ( Single Post Only )
 */
function blade_grve_print_blog_meta_bar() {
	global $post;
	$post_id = $post->ID;
?>
	<?php if ( blade_grve_visibility( 'post_tag_visibility', '1' ) || blade_grve_visibility( 'post_category_visibility', '1' ) ) { ?>

		<!-- META -->
		<div id="grve-single-post-meta-bar" class="grve-singular-section clearfix grve-align-center grve-border grve-border-top">
			<div class="grve-container grve-padding-top-md grve-padding-bottom-md">
				<div class="grve-wrapper">

					<?php if ( blade_grve_visibility( 'post_category_visibility', '1' ) ) { ?>

					<div class="grve-single-post-meta grve-categories">
					 <?php
						$post_terms = wp_get_object_terms( $post_id, 'category', array( 'fields' => 'ids' ) );
						if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
							$term_ids = implode( ',' , $post_terms );
							echo '<ul class="grve-small-text">';
							echo wp_list_categories( 'title_li=&style=list&echo=0&hierarchical=0&taxonomy=category&include=' . $term_ids );
							echo '</ul>';
						}
					?>
					</div>

					<?php } ?>

					<?php if ( blade_grve_visibility( 'post_tag_visibility', '1' ) ) { ?>

					<div class="grve-single-post-meta grve-tags">
						<?php the_tags('<ul class="grve-small-text"><li>','</li><li>','</li></ul>'); ?>
					</div>

					<?php } ?>
				</div>
			</div>
		</div>
		<!-- END META -->


	<?php } ?>

<?php
}

/**
 * Prints related posts ( Single Post )
 */
function blade_grve_print_related_posts() {

	$grve_tag_ids = array();
	$grve_max_related = 3;

	$grve_tags_list = get_the_tags();
	if ( ! empty( $grve_tags_list ) ) {

		foreach ( $grve_tags_list as $tag ) {
			array_push( $grve_tag_ids, $tag->term_id );
		}

	}

	$exclude_ids = array( get_the_ID() );
	$tag_found = false;

	$query = array();
	if ( ! empty( $grve_tag_ids ) ) {
		$args = array(
			'tag__in' => $grve_tag_ids,
			'post__not_in' => $exclude_ids,
			'posts_per_page' => $grve_max_related,
			'paged' => 1,
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			$tag_found = true;
		}
	}

	if ( $tag_found ) {
?>

	<div id="grve-related-post" class="grve-singular-section grve-fullwidth clearfix">
		<div class="grve-container grve-padding-top-md grve-border grve-border-top">
			<div class="grve-subtitle"><?php esc_html_e( 'YOU MIGHT ALSO LIKE', 'blade' ); ?></div>
			<h2 class="grve-related-title grve-h4"><?php esc_html_e( 'ONE OF THE FOLLOWING', 'blade' ); ?></h2>
			<div class="grve-related-post-wrapper">
				<?php blade_grve_print_loop_related( $query ); ?>
			</div>
		</div>
	</div>
<?php
	}
}


/**
 * Prints single related item ( used in related posts )
 */
function blade_grve_print_loop_related( $query, $filter = ''  ) {

	if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

		$grve_link = get_permalink();
		$grve_target = '_self';

		if ( 'link' == get_post_format() ) {
			$grve_link = get_post_meta( get_the_ID(), 'grve_post_link_url', true );
			$new_window = get_post_meta( get_the_ID(), 'grve_post_link_new_window', true );
			if( empty( $grve_link ) ) {
				$grve_link = get_permalink();
			}

			if( !empty( $new_window ) ) {
				$grve_target = '_blank';
			}
		}


?>
		<article id="grve-related-post-<?php the_ID(); ?>" <?php post_class( 'grve-related-item' ); ?> itemscope itemType="http://schema.org/BlogPosting">

			<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>">
				<div class="grve-content">
					<h5 class="grve-title" itemprop="name headline"><?php the_title(); ?></h5>
					<div class="grve-caption grve-small-text"><?php blade_grve_print_post_date(); ?></div>
				</div>
			</a>
			<?php
				blade_grve_print_post_image_meta();
				if ( has_post_thumbnail() ) {
			?>
				<div class="grve-background-wrapper">
					<?php
						$image_size = 'blade-grve-small-rect-horizontal';
						$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
						$attachment_src = wp_get_attachment_image_src( $post_thumbnail_id, $image_size );
						$image_src = $attachment_src[0];
					?>
					<div class="grve-bg-image" style="background-image: url(<?php echo esc_url( $image_src ); ?>);"></div>
				</div>
			<?php
				}
			?>
		</article>
<?php

	endwhile;
	else :
	endif;

	wp_reset_postdata();

}

/**
 * Likes ajax callback ( used in Single Post )
 */
function blade_grve_likes_callback( $post_id ) {

	$likes = 0;
	$status = "";

	if ( isset( $_POST['grve_likes_id'] ) ) {
		$post_id = $_POST['grve_likes_id'];
		$response = blade_grve_likes( $post_id, 'update' );
	} else {
		$response = array(
			'status' => $status,
			'likes' => $likes,
		);
	}
	wp_send_json( $response );

	die();
}

add_action( 'wp_ajax_blade_grve_likes_callback', 'blade_grve_likes_callback' );
add_action( 'wp_ajax_nopriv_blade_grve_likes_callback', 'blade_grve_likes_callback' );

function blade_grve_likes( $post_id, $action = 'get' ) {

	$status = '';

	if( !is_numeric( $post_id ) ) {
		$likes = 0;
	} else {
		$likes = get_post_meta( $post_id, 'grve_likes', true );
	}

	if( !$likes || !is_numeric( $likes ) ) {
		$likes = 0;
	}

	if ( 'update' == $action ) {

		if( is_numeric( $post_id ) ) {
			if ( isset( $_COOKIE['grve_likes_' . $post_id] ) ) {

				unset( $_COOKIE['grve_likes_' . $post_id] );
				setcookie( 'grve_likes_' . $post_id, "", 1, '/' );
				if( 0 != $likes ) {
					$likes--;
					update_post_meta( $post_id, 'grve_likes', $likes );
				}

			} else {
				$likes++;
				update_post_meta( $post_id, 'grve_likes', $likes );
				setcookie('grve_likes_' . $post_id, $post_id, time()*20, '/');
				$status = 'active';
			}
		}

		return $response = array(
			'status' => $status,
			'likes' => $likes,
		);

	} elseif ( 'status' == $action ) {
		if( is_numeric( $post_id ) ) {
			if ( isset( $_COOKIE['grve_likes_' . $post_id] ) && 0 != $likes) {
				$status = 'active';
			}
		}
		return $status;
	}

	return $likes;
}


 /**
 * Prints Navigation Bar ( Post )
 */
if ( !function_exists('blade_grve_print_post_bar') ) {
	function blade_grve_print_post_bar() {

		$post_socials = blade_grve_option( 'post_social');
		if ( is_array( $post_socials ) ) {
			$post_socials = array_filter( $post_socials );
		} else {
			$post_socials = '';
		}

		$grve_in_same_term = blade_grve_visibility( 'post_nav_same_term', '0' );
		$prev_post = get_adjacent_post( $grve_in_same_term, '', true);
		$next_post = get_adjacent_post( $grve_in_same_term, '', false);

		if ( ( blade_grve_visibility( 'post_nav_visibility', '1' )  && ( is_a( $prev_post, 'WP_Post' ) || is_a( $next_post, 'WP_Post' ) ) ) || !empty( $post_socials ) ) {

?>
			<!-- POST BAR -->
			<div id="grve-post-bar" class="grve-navigation-bar grve-singular-section grve-fullwidth clearfix">
				<div class="grve-container">
					<div class="grve-wrapper">

						<div class="grve-post-bar-item">
							<?php if ( blade_grve_visibility( 'post_nav_visibility', '1' ) && is_a( $prev_post, 'WP_Post' ) ) { ?>

							<a class="grve-nav-item grve-prev" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
								<div class="grve-arrow grve-icon-arrow-left-alt"></div>
								<div class="grve-nav-content">
									<div class="grve-nav-title grve-small-text"><?php esc_html_e( 'Read Previous', 'blade' ); ?></div>
									<h6 class="grve-title"><?php echo get_the_title( $prev_post->ID ); ?></h6>
								</div>
							</a>

							<?php } ?>
						</div>

						<div class="grve-post-bar-item grve-post-socials grve-list-divider grve-link-text grve-align-center">
							<?php blade_grve_print_post_social(); ?>
						</div>

						<div class="grve-post-bar-item">
							<?php if ( blade_grve_visibility( 'post_nav_visibility', '1' ) && is_a( $next_post, 'WP_Post' ) ) { ?>

							<a class="grve-nav-item grve-next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
								<div class="grve-nav-content">
									<div class="grve-nav-title grve-small-text"><?php esc_html_e( 'Read Next', 'blade' ); ?></div>
									<h6 class="grve-title"><?php echo get_the_title( $next_post->ID ); ?></h6>
								</div>
								<div class="grve-arrow grve-icon-arrow-right-alt"></div>
							</a>

							<?php } ?>
						</div>

					</div>
				</div>
			</div>
			<!-- END POST BAR -->
<?php
		}
	}
}

 /**
 * Prints social icons ( Post )
 */
if ( !function_exists('blade_grve_print_post_social') ) {
	function blade_grve_print_post_social() {

		$post_socials = blade_grve_option( 'post_social');
		if ( is_array( $post_socials ) ) {
			$post_socials = array_filter( $post_socials );
		} else {
			$post_socials = '';
		}

		if ( !empty( $post_socials ) ) {
			global $post;
			$post_id = $post->ID;

			$post_email = blade_grve_option( 'post_social', '', 'email' );
			$post_facebook = blade_grve_option( 'post_social', '', 'facebook' );
			$post_twitter = blade_grve_option( 'post_social', '', 'twitter' );
			$post_linkedin = blade_grve_option( 'post_social', '', 'linkedin' );
			$post_googleplus = blade_grve_option( 'post_social', '', 'google-plus' );
			$post_reddit = blade_grve_option( 'post_social', '', 'reddit' );
			$post_likes = blade_grve_option( 'post_social', '', 'grve-likes' );
			$grve_permalink = get_permalink( $post_id );
			$grve_title = get_the_title( $post_id );

			$post_email_string = 'mailto:?subject=' . $grve_title . '&body=' . $grve_title . ': ' . $grve_permalink;
?>
			<!-- SOCIALS -->
			<ul class="grve-bar-socials">
				<?php if ( !empty( $post_email  ) ) { ?>
				<li><a href="<?php echo esc_url( $post_email_string ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-email"><?php echo esc_html__( 'E-mail', 'blade' ); ?></a></li>
				<?php } ?>
				<?php if ( !empty( $post_facebook  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-facebook">Facebook</a></li>
				<?php } ?>
				<?php if ( !empty( $post_twitter  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-twitter">Twitter</a></li>
				<?php } ?>
				<?php if ( !empty( $post_linkedin  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-linkedin">Linkedin</a></li>
				<?php } ?>
				<?php if ( !empty( $post_googleplus  ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-googleplus">Google +</a></li>
				<?php } ?>
				<?php if ( !empty( $post_reddit ) ) { ?>
				<li><a href="<?php echo esc_url( $grve_permalink ); ?>" title="<?php echo esc_attr( $grve_title ); ?>" class="grve-social-share-reddit">reddit</a></li>
				<?php } ?>
				<?php if ( !empty( $post_likes  ) ) { ?>
				<li><a href="#" class="grve-like-counter-link <?php echo blade_grve_likes( $post_id, 'status' ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>"><i class="fa fa-heart-o"></i><span class="grve-like-counter"><?php echo blade_grve_likes( $post_id ); ?></span></a></li>
				<?php } ?>
			</ul>
			<!-- END SOCIALS -->
<?php
		}
	}
}

 /**
 * Prints About Author ( Post )
 */
 if ( !function_exists('blade_grve_print_post_about_author') ) {
	function blade_grve_print_post_about_author() {
?>
		<!-- ABOUT AUTHOR -->
		<div id="grve-about-author" class="grve-singular-section grve-smallwidth grve-align-center clearfix">
			<div class="grve-container grve-padding-top-md grve-padding-bottom-md grve-border grve-border-top">
				<div class="grve-author-image">
					<?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
				</div>
				<div class="grve-author-info">
					<h3 class="grve-title"><?php the_author_link(); ?></h3>
					<p><?php echo get_the_author_meta( 'user_description' ); ?></p>
					<a class="grve-small-text" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php esc_html_e( 'All stories by:', 'blade' ) . '  '; ?><?php the_author(); ?> </a>
				</div>
			</div>
		</div>
		<!-- ABOUT AUTHOR -->
<?php
	}
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
