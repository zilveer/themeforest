<?php if(! defined('ABSPATH')){ return; }
/*
 * Style 2
 */
//global $post, $__index, $num_posts, $options, $blog_category;

$info = $GLOBALS['lp_info'];
$options = $info['options'];
$post = $info['post'];

$placement = $info['placement'];


// tmp
$__index = 0;


// Configure the query
$args = array(
	'posts_per_page' => $info['num_posts'],
	'orderby' => 'date',
	'order'=> 'ID',
	'meta_key' => '_thumbnail_id'
);

if( ! empty( $info['blog_category'] ) ){
	$args['category__in'] = $info['blog_category'];
}

// @since v4.1.6
// Exclude the current viewed post from the query
if(is_single() && ('post' == get_post_type())){
	$args['post__not_in'] = array( get_the_ID() );
}

$the_query = new WP_Query( $args );

$cnt = $the_query->found_posts;

?>
<div class="row gutter-sm">

	<?php
		$el_title = '
		<div class="col-sm-4">
			<div class="lp-title latest_posts-elm-titlew">
				<h3 class="m_title m_title_ext text-custom latest_posts-elm-title">' . $info['postTitle'] . '</h3>
			</div>
		</div>';

	if($placement == 'normal'){
		echo $el_title;
	}

	$posts_count = 4;

	// Start the loop
	while ( $the_query->have_posts() ) {

		$the_query->the_post();

		if(0 == $__index && $placement == 'normal'){

			echo '<div class="clearfix visible-xs"></div>';

			echo '<div class="col-sm-8">';
				echo '<div class="post big-post latest_posts-post">';

			$sizes = array(750, 350);

		} else if($posts_count == $__index && $placement == 'flipped'){

			echo '<div class="clearfix visible-xs"></div>';

			echo '<div class="col-sm-8">';
				echo '<div class="post big-post latest_posts-post">';

			$sizes = array(750, 350);

		}
		else {
			if( 1 == $__index && $placement != 'flipped' ) {
				echo '<div class="clearfix"></div>';
			}
			echo '<div class="col-xs-6 col-sm-3">';
				echo '<div class="post latest_posts-post">';

			$sizes = array(370, 400);

		}

		$image = '';
		// Create the featured image html
		if ( has_post_thumbnail( $post->ID ) ) {
			$thumb   = get_post_thumbnail_id( $post->ID );
			$f_image = wp_get_attachment_url( $thumb );
			$alt = get_post_meta($thumb, '_wp_attachment_image_alt', true);
			$title = get_the_title($thumb);
			if ( ! empty ( $f_image ) ) {


				$image = vt_resize( '', $f_image, $sizes[0], $sizes[1], true );
				$img = '<img src="'. $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" alt="'.$alt.'" title="'.$title.'" class="img-responsive latest_posts-img" />';

				$image = '<a href="' . get_permalink() . '" class="latest_posts-link">'.$img.'</a>';
			}
		}

				echo $image;

				echo '<div class="post-details latest_posts-details">';

					echo '<h3 class="m_title m_title_ext text-custom latest_posts-title"><a class="latest_posts-title-link" href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
					echo '<em class="latest_posts-details-data">';
					the_time( 'd F Y' );
					echo ' ' . __( "By", 'zn_framework' );
					echo ' ' . get_the_author();
					echo ' ' . __( "in", 'zn_framework' ) . ' ';
					the_category( ", " );
					echo '</em>';

				echo '</div>';

			echo '</div>';
		echo '</div>';

		$__index++;
		if($__index >= $info['num_posts']){
			break;
		}
	}


	wp_reset_postdata();


	if($placement == 'flipped'){
		echo $el_title;
	}
	?>

</div>
