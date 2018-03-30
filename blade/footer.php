			<?php
				$grve_sticky_footer = blade_grve_visibility( 'sticky_footer' ) ? 'yes' : 'no';
			?>

			<footer id="grve-footer" data-sticky-footer="<?php echo esc_attr( $grve_sticky_footer ); ?>">

				<div class="grve-footer-wrapper">
				<?php blade_grve_print_footer_widgets(); ?>
				<?php blade_grve_print_footer_bar(); ?>
				<?php blade_grve_print_footer_bg_image(); ?>
				</div>

			</footer>

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

			<?php do_action( 'blade_grve_footer_modal_container' ); ?>

			<?php blade_grve_print_back_top(); ?>

		</div> <!-- end #grve-theme-wrapper -->

		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>