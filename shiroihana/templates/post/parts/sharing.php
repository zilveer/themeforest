<?php

$sharing_buttons = Youxi()->option->get( 'addthis_sharing_buttons' );
$sharing_buttons = array_map( 'trim', explode( ',', $sharing_buttons ) );

if( ! empty( $sharing_buttons ) ) : ?>

<section class="entry-footer-section">

	<div class="entry-footer-section-inner">

		<div class="entry-sharing clearfix">

			<div class="entry-sharing-label"><?php _e( 'Share This', 'shiroi' ); ?></div>

			<div class="entry-sharing-items">
				
				<div class="addthis_toolbox addthis_default_style addthis_20x20_style" addthis:url="<?php the_permalink(); ?>" addthis:title="<?php the_title_attribute(); ?>">
					<?php array_walk( $sharing_buttons, 'shiroi_sharing_button' ); ?>
				</div>

			</div>

		</div>

	</div>

</section>

<?php endif; ?>
