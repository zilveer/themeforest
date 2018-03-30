<?php
/*
Template Name: Header and Feature Only
*/
?>
<?php get_header(); ?>

<?php the_post(); ?>

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