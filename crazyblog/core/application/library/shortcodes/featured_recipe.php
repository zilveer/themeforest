<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_featured_recipe_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_featured_recipe_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Featured Recipe", 'crazyblog' ),
				"base" => "crazyblog_featured_recipe_outpupt",
				"icon" => crazyblog_URI . '',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Select Recipe', 'crazyblog' ),
						"param_name" => "recipe",
						"value" => array_flip( crazyblog_posts( 'crazyblog_recipe', true ) ),
						"description" => esc_html__( 'Choose recipe that you want to show', 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_featured_recipe_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		echo '<div class="ourrecipe2">';
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		if ( !empty( $recipe ) ):
			$args = array(
				'post_type' => 'crazyblog_recipe',
				'name' => $recipe,
				'post_status' => 'publish'
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$meta = get_post_meta( get_the_ID(), 'crazyblog_recipe_meta', true );
					$recipeMeta = crazyblog_set( crazyblog_set( $meta, 'crazyblog_recipe_options' ), '0' );
					$recipeInfo = crazyblog_set( $recipeMeta, 'crazyblog_recipe_info' );
					?>
					<div class="toprecipes">
						<?php if ( has_post_thumbnail() ): ?>
							<div class="recipeimg-area">
								<?php the_post_thumbnail( 'crazyblog_462x343' ) ?>
								<?php if ( crazyblog_set( $recipeMeta, 'crazyblog_recipe_video' ) != '' ): ?>
									<a href="javascript:void(0)" title="VIDEO" class="video-icon"><i class="fa fa-play"></i></a>
									<div class="recipevideo">
										<iframe src="<?php echo esc_url( crazyblog_set( $recipeMeta, 'crazyblog_recipe_video' ) ) ?>"></iframe>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<div class="recipedetail">
							<ul class="recipe-chief">
								<li><span><img src="<?php echo esc_url( crazyblog_set( $recipeMeta, 'crazyblog_chief_avatar' ) ) ?>" alt="" /></span></li>
								<?php if ( crazyblog_set( $recipeMeta, 'crazyblog_chief_name' ) != '' ): ?>
									<li><strong><?php esc_html_e( 'CHIEF: ', 'crazyblog' ) ?></strong><a href="javascript:void(0)" title=""><?php echo esc_html( crazyblog_set( $recipeMeta, 'crazyblog_chief_name' ) ) ?></a></li>
								<?php endif; ?>
							</ul>
							<h2><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
							<p><?php echo wp_trim_words( get_the_content(), 35, null ) ?></p>
							<?php if ( !empty( $recipeInfo ) && count( $recipeInfo ) > 0 ): ?>
								<ul class="recipeinfo">
									<?php foreach ( $recipeInfo as $r ) { ?>
										<li>
											<span>
												<img src="<?php echo esc_url( crazyblog_set( $r, 'crazyblog_recipe_info_img' ) ) ?>" alt="">
												<?php echo esc_html( crazyblog_set( $r, 'crazyblog_recipe_quantity' ) ) ?>
											</span>
											<?php echo esc_html( crazyblog_set( $r, 'crazyblog_recipe_name' ) ) ?>
										</li>
									<?php } ?>
								</ul>
							<?php endif; ?>
							<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php esc_html_e( 'Read More', 'crazyblog' ) ?></a>
						</div>
					</div>
					<?php
				}
				wp_reset_postdata();
			}
		endif;
		echo '</div>';
		?>
		<?php 
                    $custom_script = 'jQuery(document).ready(function ($) {
				$(".video-icon").on("click", function () {
					$(".video-icon, .recipevideo").toggleClass("open");
					return false;
				});
			});';
                    wp_add_inline_script('crazyblog_df-script', $custom_script);
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
