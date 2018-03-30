<?php
/**
 * The classic template for displaying content. Used for both single and index/archive/search.
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post clearfix' ); ?>>

	<?php 

		// Get featured image

		if ( has_post_thumbnail() ) {

			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_image_src( $thumb, 'full' ); 
			$retina = krown_retina();
			$img_size = $retina === 'true' ? array( 460, 300 ) : array( 230, 150 );

			$img_object = '<img src="' . aq_resize( $img_url[0], $img_size[0], $img_size[1], true ) . '" alt="' . get_the_title() . '">';

		}

		// Get categories

		$post_categories_array = wp_get_post_categories( $post->ID ); 
		$post_categories = '';

		foreach ( $post_categories_array as $cat_id ) {
			$cat = get_category( $cat_id );
			$post_categories .= '<a href="' . get_category_link( $cat_id ) . '">' . get_cat_name( $cat_id ) . '</a><span>, </span>';
		}

	?>

	<a href="<?php the_permalink(); ?>" class="post-image"><?php echo $img_object; ?></a>

	<div class="post-info">

		<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

		<ul class="post-meta clearfix">
			<li><time class="post-time" datetime="<?php the_time( 'c' ); ?>"><?php the_time( __( 'F d, Y', 'krown' ) ); ?></time></li>
			<li><a href="<?php echo get_permalink(); ?>#comments"><?php comments_number( __( '0 Comments', 'krown'), __( '1 Comment', 'krown' ), __( '% Comments', 'krown' ) ); ?></a></li>
			<?php if ( ! empty( $post_categories ) ) : ?><li class="post-cat-list"><?php echo __( 'In', 'krown' ) . ' ' . $post_categories; ?></li><?php endif; ?>
		</ul>

		<p class="post-excerpt"><?php echo krown_excerpt( 'krown_excerptlength_post_big'); ?></p>

	</div>

</div>