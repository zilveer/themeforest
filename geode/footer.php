<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */
?>

<?php $gridder = geode_check_gridder(get_the_id()); ?>


		<?php echo geode_get_scroll_down(); ?>

		<?php if(get_option('pix_style_scroll_button')) { ?>
			<a href="#" id="scroll-up"></a>
		<?php } ?>

			<?php $main_class = apply_filters('geode_main_class', $classes='');
			if ( $main_class != '') echo '</div><!-- ' . $main_class . ' -->'; ?>
		</div><!-- #main -->

<?php
	$top_sliding_id = get_option( 'pix_content_top_sliding_page' );
	if ( $top_sliding_id!='' ) {
		if ( function_exists('icl_object_id'))
			$top_sliding_id = icl_object_id( $top_sliding_id, 'page', false, ICL_LANGUAGE_CODE );
		$top_sliding_query = new WP_Query( "page_id=$top_sliding_id" );
?>
		<div id="top_sliding_bar" class="alternative_content_panel">
			<a href="#" id="top_sliding_toggle"></a>
			<div>
				<div>
					<?php if ( $top_sliding_query->have_posts() ) : while ( $top_sliding_query->have_posts() ) : $top_sliding_query->the_post(); ?>

						<?php $gridder = geode_check_gridder(get_the_id());
						if ( !isset($gridder) || $gridder!=true ) { ?>
							<div class="row">
								<div class="row-inside">
					<?php } ?>
						<?php the_content(); ?>
					<?php if ( !isset($gridder) || $gridder!=true ) { ?>
							</div><!-- .row-inside -->
						</div><!-- .row -->
					<?php } ?>
					<?php endwhile; endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</div>
		</div><!-- #top_sliding_bar -->
<?php } ?>


<?php
	$footer_id = get_option( 'pix_content_footer_page' );
	if ( $footer_id!='' ) {
		if ( function_exists('icl_object_id'))
			$footer_id = icl_object_id( $footer_id, 'page', false, ICL_LANGUAGE_CODE );
		$footer_query = new WP_Query( "page_id=$footer_id" );
?>
		<footer id="colophon" class="site-footer alternative_content_panel <?php echo apply_filters('geode_fx_footer_onscroll',''); ?>" role="contentinfo">
			<div class="footer-widgets">

			<?php if ( $footer_query->have_posts() ) : while ( $footer_query->have_posts() ) : $footer_query->the_post(); ?>

				<?php $gridder = geode_check_gridder(get_the_id());
				if ( !isset($gridder) || $gridder!=true ) { ?>
					<div class="row">
						<div class="row-inside">
			<?php } ?>
				<?php the_content(); ?>
			<?php if ( !isset($gridder) || $gridder!=true ) { ?>
					</div><!-- .row-inside -->
				</div><!-- .row -->
			<?php } ?>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
			</div><!-- .footer-widgets -->
		</footer><!-- #colophon -->
<?php } ?>

	</div><!-- #page -->

	<div id="geode-social-overlay">
		<span class="close-geode-overlay"></span>
		<div class="social-wrap">
			<div>
			</div>
		</div>
	</div><!-- #geode-social-overlay -->

	<div id="ghost-layout"></div>

	<?php wp_footer(); ?>
</body>
</html>