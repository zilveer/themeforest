<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_vendor_intro_and_products_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_vendor_intro_and_products_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Vendor Intro And Products", 'crazyblog' ),
				"base" => "crazyblog_vendor_intro_and_products_outpupt",
				"icon" => crazyblog_URI . '',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Title', 'crazyblog' ),
						"param_name" => "title",
						"description" => esc_html__( 'Enter the vendor title for this section', 'crazyblog' )
					),
					array(
						"type" => "attach_image",
						"class" => "",
						"heading" => esc_html__( 'Avatar', 'crazyblog' ),
						"param_name" => "avatar",
						"description" => esc_html__( 'Upload vendor avatar', 'crazyblog' )
					),
					array(
						"type" => "attach_image",
						"class" => "",
						"heading" => esc_html__( 'Image', 'crazyblog' ),
						"param_name" => "image",
						"description" => esc_html__( 'Upload vendor image', 'crazyblog' )
					),
					array(
						"type" => "textarea",
						"class" => "",
						"heading" => esc_html__( 'About', 'crazyblog' ),
						"param_name" => "about",
						"description" => esc_html__( 'Enter the short note about vendor', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Products Title', 'crazyblog' ),
						"param_name" => "p_title",
						"description" => esc_html__( 'Enter the vendor products title', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Number', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter the number of show vendor categories', 'crazyblog' )
					),
					array(
						"type" => "multiselect",
						"class" => "",
						"heading" => esc_html__( 'Vendor Categories', 'crazyblog' ),
						"param_name" => "cat",
						"value" => crazyblog_get_categories( array( 'taxonomy' => 'product_cat', 'hide_empty' => true ), true ),
						"description" => esc_html__( 'Choose vendor categories for which products you want to show', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Order', 'crazyblog' ),
						"param_name" => "order",
						"value" => array(
							esc_html__( 'Ascending', 'crazyblog' ) => 'ASC',
							esc_html__( 'Descending', 'crazyblog' ) => 'DESC'
						),
						"description" => esc_html__( "Select sorting order ascending or descending for posts listing", 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Order By", 'crazyblog' ),
						"param_name" => "orderby",
						"value" => array_flip(
								array(
									'date' => esc_html__( 'Date', 'crazyblog' ),
									'title' => esc_html__( 'Title', 'crazyblog' ),
									'name' => esc_html__( 'Name', 'crazyblog' ),
									'author' => esc_html__( 'Author', 'crazyblog' ),
									'comment_count' => esc_html__( 'Comment Count', 'crazyblog' ),
									'random' => esc_html__( 'Random', 'crazyblog' )
								)
						),
						"description" => esc_html__( "Select order by method for posts listing", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_vendor_intro_and_products_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$fullSrc = wp_get_attachment_image_src( $image, 'crazyblog_1170x590' );
		$avatarSrc = wp_get_attachment_image_src( $avatar, 'crazyblog_200x200' );
		?>
		<div class="shopping-blog">
			<div class="shop-post">
				<div class="shop-post-title">
					<span><img src="<?php echo esc_url( crazyblog_set( $avatarSrc, '0' ) ) ?>" alt="" /></span>
					<h3><a href="javascript:void(0)" title=""><?php echo wp_kses_post( $title ) ?></a></h3>
				</div>
				<a class="shop-post-img" href="javascript:void(0)" title="">
					<img src="<?php echo esc_url( crazyblog_set( $fullSrc, '0' ) ) ?>" alt="" />
				</a>
				<p><?php echo wp_kses_post( $about ) ?></p>
				<div class="shop-products">
					<?php if ( !empty( $p_title ) ): ?>
						<h4 class="subtitle"><i class="fa fa-shopping-bag"></i> <?php echo esc_html( $p_title ) ?></h4>
					<?php endif; ?>
					<div class="row">
						<?php
						$args = array(
							'post_type' => 'product',
							'post_status' => 'publish',
							'orderby' => $orderby,
							'order' => $order,
							'showposts' => $number,
						);
						if ( !empty( $cat ) ) {
							$args["tax_query"] = array(
								array(
									"taxonomy" => "product_cat",
									"field" => "slug",
									"terms" => explode( ',', $cat )
								)
							);
						}

						$query = new WP_Query( $args );
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								global $product;
								?>
								<div class="col-md-4">
									<div class="product-post">
										<div class="product-img">
											<?php the_post_thumbnail( 'crazyblog_454x344' ) ?>
											<span>
												<?php
												echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><i class="fa fa-shopping-cart"></i></a>', esc_url( $product->add_to_cart_url() ), esc_attr( isset( $quantity ) ? $quantity : 1  ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( isset( $class ) ? $class : ''  )
														), $product );
												?>
											</span>
										</div>
										<h5><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h5>
										<?php echo wp_kses_post( $product->get_price_html() ) ?>
									</div>
								</div>
								<?php
							}
							wp_reset_postdata();
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
