<?php global $wp; ?>
<form method="post" action="<?php echo defined( 'DOING_AJAX' ) ? '' : esc_url( remove_query_arg( array(
	'page',
	'paged'
), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) ) ); ?>" class="action  job-manager-form  wp-job-manager-bookmarks-form">
	<div class="add_to_favorite_wrap  tooltip-container">
		<?php if ( $is_bookmarked ) { ?>
			<a class="bookmark-notice bookmarked action  action--favorite" href="#">
				<span class="action__icon">
					<?php get_template_part( 'assets/svg/add-to-favorites-icon-svg' ); ?>
				</span>
				<span class="action__text"><?php printf( esc_html__( 'Favorited', 'listable' ), $post_type->labels->singular_name ); ?></span>
				<span class="action__text--mobile"><?php printf( esc_html__( 'Favorited', 'listable' ) ); ?></span>
			</a>
		<?php } else { ?>
			<a href="#" class="action  action--favorite bookmark-notice  tooltip-trigger  js-tooltip-trigger">
				<span class="action__icon">
					<?php get_template_part( 'assets/svg/add-to-favorites-icon-svg' ); ?>
				</span>
				<span class="action__text"><?php esc_html_e( 'Add to favorites', 'listable' ); ?></span>
				<span class="action__text--mobile"><?php esc_html_e( 'Favorite', 'listable' ); ?></span>
			</a>
		<?php } ?>
		<div class="tooltip">
			<span class="bookmark_notes">
				<label for="bookmark_notes">
					<?php esc_html_e( 'Notes:', 'listable' ); ?>
				</label>
				<textarea name="bookmark_notes" id="bookmark_notes" cols="25" rows="3"><?php echo esc_textarea( $note ); ?></textarea>
			</span>
			<span class="bookmark_submit">
				<?php wp_nonce_field( 'update_bookmark' ); ?>
				<input type="hidden" name="bookmark_post_id" value="<?php echo absint( $post->ID ); ?>"/>
				<input class="btn" type="submit" name="submit_bookmark" value="<?php echo $is_bookmarked ? esc_html__( 'Update Bookmark', 'listable' ) : esc_html__( 'Add Bookmark', 'listable' ); ?>"/>
				<?php if ( $is_bookmarked ) { ?>
					<a class="remove-bookmark btn" href="<?php echo wp_nonce_url( add_query_arg( 'remove_bookmark', absint( $post->ID ), get_permalink() ), 'remove_bookmark' ); ?>">
						<?php esc_html_e( 'Clear', 'listable' ); ?>
					</a>
				<?php } ?>
			</span>
		</div>
	</div>
</form>


