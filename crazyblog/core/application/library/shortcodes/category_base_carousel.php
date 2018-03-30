<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_category_base_carousel_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_category_base_carousel_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Category Base Carousel", 'crazyblog' ),
				"base" => "crazyblog_category_base_carousel_outpupt",
				"icon" => crazyblog_URI . '',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "multiselect",
						"class" => "",
						"heading" => esc_html__( 'Select Categories', 'crazyblog' ),
						"param_name" => "cat",
						"value" => crazyblog_get_categories( array( 'taxonomy' => 'recipe_category', 'hide_empty' => true ), true ),
						"description" => esc_html__( 'Choose posts categories for which posts you want to show', 'crazyblog' )
					),
					array(
						"type" => "textarea",
						"class" => "",
						"heading" => esc_html__( 'Short Description', 'crazyblog' ),
						"param_name" => "desc",
						"description" => esc_html__( "Please Enter the short description", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_category_base_carousel_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		echo '<div class="our-recipes">';
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$cats = explode( ',', $cat );
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		?>
		<div class="ourrecipe-content">
			<?php
			if ( !empty( $cats ) && count( $cats ) > 0 ) {
				echo '<ul class="ourrecipe-carousel">';
				foreach ( $cats as $c ) {
					$info = get_term_by( 'slug', $c, 'recipe_category' );
					$key = $info->taxonomy . '_' . $info->term_id;
					$name = $info->name;
					$meta = get_option( $key );
					if ( !empty( $meta ) ) {
						$icoSrc = (crazyblog_set( $meta, 'category_icon_val' ) != '') ? wp_get_attachment_image_src( crazyblog_set( $meta, 'category_icon_val' ), 'full' ) : '';
						$imgSrc = (crazyblog_set( $meta, 'category_image_val' ) != '') ? wp_get_attachment_image_src( crazyblog_set( $meta, 'category_image_val' ), 'crazyblog_770x458' ) : '';
						$category_link = get_term_link( $info->term_id, 'recipe_category' );
						if ( !empty( $imgSrc ) ) {
							?>
							<li>
								<img src="<?php echo esc_url( crazyblog_set( $imgSrc, '0' ) ) ?>" alt="" />
								<div class="currecipe-info">
									<img src="<?php echo esc_url( crazyblog_set( $icoSrc, '0' ) ) ?>" alt="" />
									<h4><a href="<?php echo esc_url( $category_link ) ?>" title=""><?php echo esc_html( $info->name ) ?></a></h4>
								</div>
							</li>
							<?php
						}
					}
				}
				echo '</ul>';
				echo '<p>' . $desc . '</p>';
			}
			?>
		</div>
		<?php
		$ourrecipe_carousel = 'jQuery(document).ready(function ($) {
		        $(".ourrecipe-carousel").owlCarousel({
		            autoplay: true,
		            autoplayTimeout: 2500,
		            smartSpeed: 2000,
		            autoplayHoverPause: true,
		            loop: true,
		            dots: false,
		            nav: true,
		            margin: 20,
		            mouseDrag: true,
		            autoHeight: true,
		            responsiveClass: true,
		            responsive: {
		                1200: {items: 4},
		                980: {items: 3},
		                480: {items: 2},
		                0: {items: 1}
		            }
		        });
		    });';
		wp_add_inline_script( 'crazyblog_df-owl', $ourrecipe_carousel );

		echo '</div>';
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
