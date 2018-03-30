<?php

$id = get_the_id();

$content = get_the_content();

$post_meta = wbc_get_meta( $id );

$link_title = ( isset( $post_meta['wbc-link-format-text'] ) && !empty( $post_meta['wbc-link-format-text'] ) ) ? $post_meta['wbc-link-format-text'] : get_the_title();
$link_URL = ( isset( $post_meta['wbc-link-format-link'] ) && !empty( $post_meta['wbc-link-format-link'] ) ) ? $post_meta['wbc-link-format-link'] : get_permalink();

?>
<article id="post-<?php the_id();?>" <?php post_class( 'clearfix' );?>>


      <div class="post-contents">


	      <div class="entry-content clearfix">

	      	<a href="<?php echo esc_attr( esc_url( $link_URL ) ); ?>" class="link-format">

	          <h2 class="entry-title"><?php echo esc_html( $link_title ); ?></h2>

	          <span class="link-url">
	            <?php echo esc_html( $link_URL ); ?>
	          </span>

	        </a>

			<?php
				if ( is_single() ) {

					echo apply_filters( 'the_content', $content );

				}
			?>

			<?php if( is_single() && has_tag() ): ?>

				<div class="tags">
				<?php the_tags(); ?>
				</div>

			<?php endif; ?>

		</div>

    </div>

</article> <!-- ./post -->
