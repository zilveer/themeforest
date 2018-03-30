<?php
/************************************************************************
* No Results Page :)
*************************************************************************/

?>


<?php if ( is_search() ): ?>

<div id="post" class="clearfix no-results-page">

	<div class="row">
		<div class="col-sm-12">
			<h2 class="entry-title"><?php esc_html_e( 'Whoops! Nothing Found', 'ninezeroseven' ); ?></h2>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ninezeroseven' ); ?></p>
			<p>&nbsp;</p>
		</div>

		<div class="col-sm-4">
			<h5><?php esc_html_e( 'Try new search', 'ninezeroseven' ); ?></h5>
			<?php get_search_form(); ?>
		</div>
	</div>

</div> <!-- ./post -->

<?php else: ?>

<div id="post" class="clearfix no-results-page">

	<div class="row">
		<div class="col-sm-12">
			<h2 class="entry-title"><?php esc_html_e( 'Whoops! Nothing Found', 'ninezeroseven' ); ?></h2>

			<?php if ( current_user_can( 'publish_posts' ) ): ?>

				<p><?php printf( __( 'Ready to build? <a href="%1$s">Get started here</a>.', 'ninezeroseven' ), admin_url( 'post-new.php' ) ); ?></p>
				<p>&nbsp;</p>

			<?php else: ?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ninezeroseven' ); ?></p>

				<p>&nbsp;</p>

			<?php endif; ?>
		</div>

		<div class="col-sm-4">
			<h5><?php esc_html_e( 'Try new search', 'ninezeroseven' ); ?></h5>
			<?php get_search_form(); ?>
		</div>
	</div>

</div> <!-- ./post -->

<?php endif; ?>
