<?php

$prev_post = get_adjacent_post();
$next_post = get_adjacent_post( false, '', false );

if( $prev_post || $next_post ) : ?>

<section class="entry-footer-section">

	<div class="entry-footer-section-inner">

		<nav class="entry-adjacent-nav">

			<div class="row"><?php

				if( $prev_post ) {
					previous_post_link(
						'<div class="previous col-sm-6">%link</div>', 
						'<span class="link-icon fa fa-chevron-left"></span>' . 
						'<span class="link-label">' . __( 'Previous Post', 'shiroi' ) . '</span>' . 
						'<h5 class="link-title">%title</h5>'
					);
				}

				if( $prev_post && $next_post ) {
					echo '<div class="spacer-20 hidden-md hidden-lg"></div>';
				}

				if( $next_post ) {
					next_post_link(
						'<div class="next col-sm-6' . ( $prev_post ? '' : ' col-sm-push-6' ) . '">%link</div>', 
						'<span class="link-icon fa fa-chevron-right"></span>' . 
						'<span class="link-label">' . __( 'Next Post', 'shiroi' ) . '</span>' . 
						'<h5 class="link-title">%title</h5>'
					);
				}

			?></div>

		</nav>

	</div>
	
</section>

<?php endif; ?>
