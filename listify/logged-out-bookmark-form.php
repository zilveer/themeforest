<div class="job-manager-form wp-job-manager-bookmarks-form">
	<div class="bookmark-action">
		<a class="bookmark-notice" href="<?php echo apply_filters( 'job_manager_bookmark_form_login_url', wp_login_url( get_permalink() ) ); ?>">
			<span class="screen-reader-text"><?php printf( __( 'Login to bookmark this %s', 'wp-job-manager-bookmarks' ), $post_type->labels->singular_name ); ?></span>
		</a>

		<?php
			global $job_manager_bookmarks;

			$count = $job_manager_bookmarks->bookmark_count( $post->ID );
		?>

		<span class="wp-job-manager-bookmarks-count wp-job-manager-bookmarks-count--<?php echo is_single() ? 'single' : 'archive'; ?>">
			<?php if ( is_singular( 'job_listing' ) ) : ?>
				<?php printf( _n( '%d Favorite', '%d Favorites', $count, 'listify' ), absint( $count ) ); ?>
			<?php else : ?>
				<?php echo absint( $count ); ?>
			<?php endif; ?>
		</span>
	</div>
</div>
