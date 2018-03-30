<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package smartfood
 */

?>
<div class="clearfix"></div>

<?php if(tdp_option('back_to_top')) : ?>
	<a id="to-top"><i class="fa fa-chevron-up"></i></a>
<?php endif; ?>
<div class="row">
	<footer <?php tdp_attr( 'footer' ); ?>>
		<?php

		if(is_page() && get_field('footer_layout') && get_field('footer_layout') !== 'Default Footer') :

			if(get_field('footer_layout') == 'Booking Form Footer') : 
				get_template_part( 'templates/footers/footer', 'booking' );
			elseif(get_field('footer_layout') == 'Minimal Footer With Widgets') :
				get_template_part( 'templates/footers/footer', 'widgets' );
			elseif(get_field('footer_layout') == 'Minimal Footer') :
				get_template_part( 'templates/footers/footer', 'minimal' );
			endif;

		else:

			if(tdp_option('footer_layout') == 'booking') : 
				get_template_part( 'templates/footers/footer', 'booking' );
			elseif(tdp_option('footer_layout') == 'minimal_widgets') :
				get_template_part( 'templates/footers/footer', 'widgets' );
			else:
				get_template_part( 'templates/footers/footer', 'minimal' );
			endif;

		endif;

		?>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
