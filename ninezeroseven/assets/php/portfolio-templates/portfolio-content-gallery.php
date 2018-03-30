<?php

$id = get_the_id();

$has_gallery = false;

$content = get_the_content();

$post_meta = wbc_get_meta( $id );

$gallery_images = ( isset( $post_meta['wbc-portfolio-gallery-format'] ) && !empty( $post_meta['wbc-portfolio-gallery-format'] ) ) ? $post_meta['wbc-portfolio-gallery-format'] : false;

if ( $gallery_images !== false ) {
	$gallery_ids = explode( ',', $gallery_images );
	$gallery_markup = '';
	if ( is_array( $gallery_ids ) ) {

		$has_gallery = true;

		$gallery_markup .='<div class="flexslider">';

		$gallery_markup .='<ul class="slides">';

		foreach ( $gallery_ids as $image ) {

			$path = wp_get_attachment_image_src( $image, 'large' );

			$gallery_markup .='<li>';
			$gallery_markup .='	<div class="wbc-image-wrap">';
			$gallery_markup .='		<a href="'.esc_attr( get_permalink() ).'"><img src="'.esc_attr( $path[0] ).'" alt="'.esc_attr( get_the_title( $image ) ).'"/></a>';
			if ( !is_single() ) {
				$gallery_markup .='		<a class="item-link-overlay" href="'.esc_attr( get_permalink() ).'"></a>';
			}else {
				$gallery_markup .='		<div class="item-link-overlay"></div>';
			}
			$gallery_markup .='		<div class="wbc-extra-links">';
			$gallery_markup .='			<a data-photo-up="prettyPhoto[gallery-'.$id.']" title="'.esc_attr( get_the_title( $image ) ).'" href="'.esc_attr( $path[0] ).'" class="wbc-photo-up"><i class="fa fa-search"></i></a>';
			if ( ! is_single() ) {$gallery_markup .='			<a href="'.esc_attr( get_permalink() ).'" class="wbc-go-link"><i class="fa fa-link"></i></a>';}
			$gallery_markup .='		</div>';
			$gallery_markup .='	</div>';
			$gallery_markup .='</li>';
		}

		$gallery_markup .='</ul>';

		$gallery_markup .='</div>';
	}
}
?>
<article id="post-<?php the_id();?>" <?php post_class( 'clearfix' );?>>

      <?php

		if ( $has_gallery !== false ) {
			echo '<div class="post-featured gallery-format">';
			$allowed_tags = wp_kses_allowed_html('post');
			$allowed_tags['a']['data-photo-up'] = true;
			echo  wp_kses($gallery_markup, $allowed_tags);
			echo '</div>';
		}

		?>

      <div class="post-contents">

	      	<header class="post-header">
		      	<?php
				if ( is_single() ) {
					echo '<h1 class="entry-title">'.get_the_title().'</h1>';
				}else {
					echo '<h2 class="entry-title"><a href="'.esc_attr( get_permalink() ).'">'.get_the_title().'</a></h2>';
				}

				?>
		        <div class="entry-meta">
					<span class="date"><i class="fa fa-calendar"></i> <?php echo get_the_date( get_option( 'date_format' ) )?></span>
		            <span class="user"><i class="fa fa-user"></i> <?php esc_html_e( 'By', 'ninezeroseven' ); ?> <?php the_author_posts_link(); ?></span>
		           	<?php if ( get_post_type() == 'post' ) { ?> <span class="post-in"><i class="fa fa-pencil"></i> <?php esc_html_e( 'In', 'ninezeroseven' ); ?> <?php the_category( ', ' ) ?></span><?php } ?>
		            <span class="comments"><i class="fa fa-comments"></i> <?php comments_number( esc_html__( 'No Comments', 'ninezeroseven' ), esc_html__( '1 Comment', 'ninezeroseven' ), esc_html__( '% Comments', 'ninezeroseven' ) );?></span>
	        	</div>
	     	</header>

	      <div class="entry-content clearfix">

			<?php
			if ( is_single() ) {

				echo apply_filters( 'the_content', $content );

			}else {

				the_excerpt();

				printf( '<div class="more-link"><a href="%1s" class="button btn-primary">%2s</a></div>',
					get_permalink(),
					esc_html__( 'Read More', 'ninezeroseven' )
				);

			}
			?>

		</div>
    </div>

</article> <!-- ./post -->
