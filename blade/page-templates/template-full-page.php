<?php
/*
Template Name: Scrolling Full Screen Sections
*/
?>
<?php get_header(); ?>

<?php the_post(); ?>

<?php $responsive_scrolling_page = blade_grve_option( 'responsive_scrolling_page_visibility', 'yes' ); ?>

			<!-- CONTENT -->
			<div id="grve-content" class="clearfix">
				<div class="grve-content-wrapper">
					<!-- MAIN CONTENT -->
					<div id="grve-main-content">
						<div class="grve-main-content-wrapper clearfix" style="padding: 0;">

							<!-- PAGE CONTENT -->
							<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div id="grve-fullpage" data-device-scrolling="<?php echo esc_attr( $responsive_scrolling_page ); ?>">
									<?php the_content(); ?>
								</div>
							</div>
							<!-- END PAGE CONTENT -->

						</div>
					</div>
					<!-- END MAIN CONTENT -->

				</div>
			</div>
			<!-- END CONTENT -->

			<!-- SIDE AREA -->
			<?php
				$grve_sidearea_data = blade_grve_get_sidearea_data();
				blade_grve_print_side_area( $grve_sidearea_data );
			?>
			<!-- END SIDE AREA -->

			<!-- HIDDEN MENU -->
			<?php blade_grve_print_hidden_menu(); ?>
			<!-- END HIDDEN MENU -->

			<!-- CART AREA -->
			<?php blade_grve_print_cart_area(); ?>
			<!-- END CART AREA -->

			<?php blade_grve_print_search_modal(); ?>
			<?php blade_grve_print_form_modals(); ?>
			<?php blade_grve_print_language_modal(); ?>
			<?php blade_grve_print_social_modal(); ?>

		</div> <!-- end #grve-theme-wrapper -->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>