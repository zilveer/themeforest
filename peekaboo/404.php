<?php
/*
 * The template for displaying 404 pages (Not Found).
 */
get_header(); ?>

	<!--Main begin-->
	<div id="main" class="round_8 clearfix row">

	<!-- Page title begin -->
	<div class="large-12 columns">
		<div class="page_title round_6">
			<?php if ( $smof_data['pkb_custom_404_title'] != '' ) {
				echo '<h1 class="replace">';
				echo $smof_data['pkb_custom_404_title'];
				echo '</h1>';
			} else {
				echo '<h1 class="replace">';
				_e( 'OOPS!', 'peekaboo' );
				echo '</h1>';
			} ?>
		</div>
	</div>
	<!-- Page title end -->


	<!-- Content begin-->
	<div id="content" class="large-8 columns">

		<div class="post">
			<h3><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'peekaboo' ) ?></h3>
			<?php if ( function_exists( 'aa_google_404' ) ) {
				aa_google_404();
			} ?>

			<?php if ( $smof_data['pkb_custom_404_msg'] != '' ) {
				echo '<p>';
				echo $smof_data['pkb_custom_404_msg'];
				echo '</p>';
			} else {
				echo '<p>';
				_e( 'The page you\'re looking for has either moved or is no longer on this website. Make sure to delete your old bookmark or favorite for that page and create a new one.', 'peekaboo' );
				echo '</p>';

			} ?>
			<div class="row">
				<div class="large-6 columns">
					<?php get_search_form(); ?>
				</div>
			</div>
			<script type="text/javascript">
				// focus on search field after it has loaded
				document.getElementById( 's' ) && document.getElementById( 's' ).focus();
			</script>
		</div>
	</div>
	<!-- Content end-->

	<!-- Sidebar begin-->
	<div id="sidebar" class="large-4 columns">
		<?php get_sidebar(); ?>
	</div>
	<!-- Sidebar end-->

<?php get_footer();

