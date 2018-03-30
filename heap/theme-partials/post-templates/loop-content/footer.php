<footer class="article__meta">
	<?php if ( heap_option( 'blog_show_date' ) ) { ?>
		<span class="meta-box  article__date">
					<i class="icon  icon-clock-o"></i>
					<span class="meta-text"><abbr class="published updated" title="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
			</span>
	<?php }

	if ( heap_option( 'blog_show_comments' ) ) { ?>
		<span class="meta-box  article__comments">
				<a href="<?php echo get_comments_link(); ?>">
					<i class="icon  icon-comment"></i>
					<span class="meta-text">
						<?php
						comments_number(
							esc_html__( '0', 'heap' ),
							esc_html__( '1', 'heap' ),
							'% '
						); ?>
					</span>
				</a>
			</span>
	<?php }

	if ( heap_option( 'blog_show_likes' ) && function_exists( 'get_pixlikes' ) ) :
		//get the pixlikes options
		$options = get_option( 'pixlikes_settings' );

		//now determine if we really need to show it by taking into account the plugin's settings
		//this is a trick to guess whether one has pushed at least once the save button in the plugin's settings page
		if ( ! array_key_exists( "general", $options ) ) {
			$show_pixlikes = true;
		} else {
			$show_pixlikes = false;
			// homepages
			if ( ( is_front_page() || is_home() ) && $options['show_on_hompage'] == '1' ) {
				$show_pixlikes = true;
			}
			// archives
			if ( ( is_archive() || is_search() ) && $options['show_on_archive'] == '1' ) {
				$show_pixlikes = true;
			}
		}

		if ( $show_pixlikes ) : ?>
			<span class="meta-box  article__likes">
				<i class="icon  icon-heart"></i>
				<span class="meta-text">
					<?php echo get_pixlikes( get_the_ID() ); ?>
				</span>
			</span>
		<?php endif;
	endif; ?>
</footer>