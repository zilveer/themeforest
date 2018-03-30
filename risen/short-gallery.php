<?php
/**
 * Short Gallery Content
 *
 * Used in loop-search.php
 */

?>

<article id="<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'gallery-short' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
	<div class="image-frame gallery-short-image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'risen-square-thumb', array( 'title' => '' ) ); ?></a>
	</div>
	<?php endif; ?>
	
	<div class="gallery-short-content">
	
		<header>
			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		</header>
		
		<div class="post-content">
			<?php the_excerpt(); ?>
		</div>
		
		<p>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="button button-small">
				<?php
				if ( 'video' == get_post_meta( $post->ID, '_risen_gallery_type', true ) ) {
					echo _x( 'Watch Video', 'gallery', 'risen' );
				} else {
					echo _x( 'View Photo', 'gallery', 'risen' );
				}
				?>
			</a>
		</p>
			
	</div>	

	<div class="clear"></div>		

</article>
