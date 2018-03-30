<?php 

ob_start();
header("HTTP/1.1 404 Not Found");

get_header(); ?>
	<div class="swm_container">	
		<div class="swm_column swm_one_half first">	
			<?php 
			$swm_error_page_image = (get_theme_mod('swm_error_image') <> '') ? esc_attr(get_theme_mod('swm_error_image')) : get_template_directory_uri().'/framework/images/error-page.jpg'; ?>			
			<img src="<?php echo esc_url($swm_error_page_image); ?>" alt="" />		
		</div>		
		<div class="swm_column swm_one_half">		
			<?php 
			if ( class_exists( 'WPML_String_Translation' ) ) {
				echo icl_translate('Theme Mod', 'swm_error_content', get_theme_mod( 'swm_error_content' ));
			} else {
				echo do_shortcode( get_theme_mod('swm_error_content') ); 
			}
			?>			
		</div>
	</div>
<?php get_footer(); ?>