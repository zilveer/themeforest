<?php if(! defined('ABSPATH')){ return; }

$info = $GLOBALS['lp_info'];
$options = $info['options'];
$post = $info['post'];
// tmp
$__index = 0;
?>
<h3 class="m_title m_title_ext text-custom latest_posts-elm-title" <?php echo WpkPageHelper::zn_schema_markup('title'); ?>><?php echo $info['postTitle'];?></h3>
<div class="row u-mb-0">
	<?php
	// Configure the query
	$args = array(
		'posts_per_page' => $info['num_posts'],
		'orderby' => 'date',
		'order'=> 'ID',
	);

	if( ! empty( $info['blog_category'] ) ){
		$args['cat'] = $info['blog_category'];
	}

	// @since v4.1.6
	// Exclude the current viewed post from the query
	if(is_single() && ('post' == get_post_type())){
		$args['post__not_in'] = array( get_the_ID() );
	}

	$the_query = new WP_Query( $args );


	// Start the loop
	while ( $the_query->have_posts() ) {
		$the_query->the_post();

		echo '<div class="col-sm-6 col-lg-4 post latest_posts-post">';

		$image = '';
		$usePostFirstImage = ( zget_option( 'zn_use_first_image', 'blog_options', false, 'yes' ) == 'yes' );
		// Create the featured image html
		if ( has_post_thumbnail( $post->ID ) ) {
			$thumb   = get_post_thumbnail_id( $post->ID );
			$f_image = wp_get_attachment_url( $thumb );
			$alt = get_post_meta($thumb, '_wp_attachment_image_alt', true);
			$title = get_the_title($thumb);
		}
		elseif( $usePostFirstImage ){
			$f_image = echo_first_image();
			$alt   = ZngetImageAltFromUrl( $f_image );
			$title = ZngetImageTitleFromUrl( $f_image );
		}
		if ( ! empty ( $f_image ) ) {
			$image         = vt_resize( '', $f_image, 370, 200, true );
			$image         = '<a href="' . get_permalink() . '" class="hoverBorder plus latest_posts-link text-custom-parent-hov"><img src="'. $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="'.$alt.'" title="'. $title .'" class="latest_posts-img" /><span class="latest_posts-readon u-trans-all-2s text-custom-child kl-main-bgcolor">' . __( "Read more", 'zn_framework' ). ' +</span></a>';
		}
		echo $image;

		echo '<em class="post-details element-scheme__faded latest_posts-details">';
		the_time( 'd F Y' );
		echo ' ' . __( "By", 'zn_framework' );
		echo ' ' . get_the_author();
		echo ' ' . __( "in", 'zn_framework' ) . ' ';
		the_category( ", " );
		echo '</em>';

			echo '<h3 class="m_title m_title_ext text-custom latest_posts-title" '.WpkPageHelper::zn_schema_markup('title').'><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';

			if($this->opt('lp_def_excerpt','') == 1){
				echo '<div class="latest_posts-desc">'. get_the_excerpt() .'</div>';
			}

		echo '</div>';

		if (($__index + 1) % 2 == 0) {
		   echo '<div class="clearfix hidden-lg"></div>';
		}

		if (($__index + 1) % 3 == 0) {
		   echo '<div class="clearfix visible-lg"></div>';
		}

		$__index++;
		if($__index >= $info['num_posts']){
			break;
		}

	}
	wp_reset_postdata();
	?>
</div>

