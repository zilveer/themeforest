<section class="entry-footer-section">

	<div class="entry-footer-section-inner">

		<div class="entry-author clearfix" itemprop="author" itemscope itemtype="https://schema.org/Person">

			<figure class="entry-author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 120 ); ?>
			</figure>

			<div class="entry-author-info">

				<h4 class="entry-author-name" itemprop="name">
					<span class="author vcard"><span class="fn"><?php the_author() ?></span></span>
				</h4>

				<div class="entry-author-description" itemprop="description"><?php the_author_meta( 'description' ); ?></div>

				<?php

				$profiles = '';
				if( $url = get_the_author_meta( 'url' ) ) {
					$profiles .= '<li><a href="' . esc_url( $url ) . '" title="' . sprintf( __( '%s\'s website', 'shiroi' ), get_the_author() ) . '" itemprop="url"><i class="fa fa-home"></i></a></li>';
				}
				foreach( shiroi_user_social_profiles() as $key => $profile ) {
					if( $url = get_the_author_meta( $key ) ) {
						$profiles .= '<li><a href="' . esc_url( $url ) . '" title="' . $profile . '"><i class="socicon socicon-' . esc_attr( $key ) . '"></i></a></li>';
					}
				}
				if( $profiles ):
					echo '<div class="entry-author-social"><ul class="plain-list">' . $profiles . '</ul></div>';
				endif; ?>

			</div>

		</div>

	</div>

</section>
