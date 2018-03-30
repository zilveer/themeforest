<?php get_header(); ?>

<?php the_post(); ?>
<?php blade_grve_print_header_title( 'portfolio' ); ?>
<?php blade_grve_print_header_breadcrumbs( 'portfolio' ); ?>
<?php blade_grve_print_anchor_menu( 'portfolio' ); ?>

<?php
	$grve_disable_portfolio_recent = blade_grve_post_meta( 'grve_disable_recent_entries' );
	$grve_disable_comments = blade_grve_post_meta( 'grve_disable_comments' );
	$grve_portfolio_media = blade_grve_post_meta( 'grve_portfolio_media_selection' );
	$grve_sidebar_layout = blade_grve_post_meta( 'grve_layout', blade_grve_option( 'portfolio_layout', 'none' ) );
	$grve_sidebar_extra_content = blade_grve_check_portfolio_details();
	$grve_portfolio_details_sidebar = false;
	if( $grve_sidebar_extra_content && 'none' == $grve_sidebar_layout ) {
		$grve_portfolio_details_sidebar = true;
	}
?>

<div class="grve-single-wrapper">
	<?php
		if ( $grve_portfolio_details_sidebar && 'none' != $grve_portfolio_media ) {
	?>
		<div id="grve-single-media" class="grve-portfolio-media">
			<div class="grve-container">
				<?php blade_grve_print_portfolio_media(); ?>
			</div>
		</div>
	<?php
		}
	?>
	<!-- CONTENT -->
	<div id="grve-content" class="clearfix <?php echo blade_grve_sidebar_class( 'portfolio' ); ?>">
		<div class="grve-content-wrapper">
			<!-- MAIN CONTENT -->
			<div id="grve-main-content">
				<div class="grve-main-content-wrapper clearfix">

					<article id="post-<?php the_ID(); ?>" <?php post_class('grve-single-porfolio'); ?>>
						<?php
							if ( !$grve_portfolio_details_sidebar && 'none' != $grve_portfolio_media ) {
						?>
							<div id="grve-single-media">
								<div class="grve-container">
									<?php blade_grve_print_portfolio_media(); ?>
								</div>
							</div>
						<?php
							}
						?>
						<div id="grve-post-content">
							<?php the_content(); ?>
						</div>
					</article>

				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<?php
				if ( $grve_portfolio_details_sidebar ) {
			?>
				<aside id="grve-sidebar">
					<?php blade_grve_print_portfolio_details(); ?>
				</aside>
			<?php
				} else {
					blade_grve_set_current_view( 'portfolio' );
					get_sidebar();
				}
			?>
		</div>

	</div>
	<!-- End CONTENT -->


	<?php blade_grve_print_portfolio_bar(); ?>

	<?php if ( blade_grve_visibility( 'portfolio_recents_visibility' ) && 'yes' != $grve_disable_portfolio_recent ) { ?>
		<?php blade_grve_print_recent_portfolio_items(); ?>
	<?php } ?>

	<?php if ( blade_grve_visibility( 'portfolio_comments_visibility' ) && 'yes' != $grve_disable_comments ) { ?>
		<?php comments_template(); ?>
	<?php } ?>
</div>
<?php get_footer();

//Omit closing PHP tag to avoid accidental whitespace output errors.
