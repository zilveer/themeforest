<?php global $wp; ?>

<form method="post" action="<?php echo defined( 'DOING_AJAX' ) ? '' : esc_url( remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) ) ); ?>" class="job-manager-form wp-job-manager-bookmarks-form wp-job-manager-bookmarks-form--<?php echo is_single() ? 'single' : 'archive'; ?>">

	<div class="bookmark-action">

		<?php if ( $is_bookmarked ) : ?>
			<a class="remove-bookmark" href="<?php echo wp_nonce_url( add_query_arg( 'remove_bookmark', absint( $post->ID ), get_permalink() ), 'remove_bookmark' ); ?>">
				<?php _e( 'Remove Bookmark', 'wp-job-manager-bookmarks' ); ?>
			</a>

			<a class="bookmark-notice bookmarked" href="#">
				<span class="screen-reader-text"><?php printf( __( 'This %s is bookmarked!', 'wp-job-manager-bookmarks' ), $post_type->labels->singular_name ); ?></span>
			</a>
		<?php else : ?>
			<a class="bookmark-notice" href="#">
				<span class="screen-reader-text"><?php printf( __( 'Bookmark This %s', 'wp-job-manager-bookmarks' ), ucwords( $post_type->labels->singular_name ) ); ?></span>
			</a>
		<?php endif; ?>

		<?php
			global $job_manager_bookmarks;

			$count = $job_manager_bookmarks->bookmark_count( $post->ID );
		?>

		<span class="wp-job-manager-bookmarks-count wp-job-manager-bookmarks-count--<?php echo is_single() ? 'single' : 'archive'; ?>">
			<?php if ( is_singular( 'job_listing' ) && ! did_action( 'single_job_listing_start' ) ) : ?>
				<?php printf( _n( '%d Favorite', '%d Favorites', $count, 'listify' ), absint( $count ) ); ?>
			<?php else : ?>
				<?php echo absint( $count ); ?>
			<?php endif; ?>
		</span>

	</div>

	<div class="bookmark-details">
		<p>
			<label for="bookmark_notes"><?php _e( 'Notes:', 'wp-job-manager-bookmarks' ); ?></label>
			<textarea name="bookmark_notes" id="bookmark_notes" cols="25" rows="3"><?php echo esc_textarea( $note ); ?></textarea></p>

		<p>
			<?php wp_nonce_field( 'update_bookmark' ); ?>
			<input type="hidden" name="bookmark_post_id" value="<?php echo absint( $post->ID ); ?>" />
			<input type="submit" name="submit_bookmark" value="<?php echo $is_bookmarked ? __( 'Update Bookmark', 'wp-job-manager-bookmarks' ) : __( 'Add Bookmark', 'wp-job-manager-bookmarks' ); ?>" />
		</p>
	</div>

</form>
