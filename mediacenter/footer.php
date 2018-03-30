<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 */
?>
	<footer class="color-bg" id="footer">
	    
	    <div class="container">
	        <div class="row widgets-row">
            <?php 
            	if ( is_active_sidebar( 'footer-widget-area' ) ) {

            		dynamic_sidebar( 'footer-widget-area' );

            	} else {

            		$footer_widget_area_args = array(
						'before_widget' => '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 columns"><aside class="widget clearfix"><div class="body">',
						'after_widget'  => '</div></aside></div>',
						'before_title'  => '<h4 class="widget-title">',
						'after_title'   => '</h4>',
						'widget_id'     => '',
					);

					if( class_exists( 'WC_Widget_Products' ) ) {
						$footer_widget_area_args['widget_id'] = 'featured-products-footer';
						the_widget( 'WC_Widget_Products', array( 'title' => __( 'Featured Products', 'mediacenter' ), 'show' => 'featured', 'number' => '3', 'orderby' => 'DESC', 'order' => 'date', 'id' => 'featured-products-footer' ), $footer_widget_area_args );

						$footer_widget_area_args['widget_id'] = 'special-offers-footer';
						the_widget( 'WC_Widget_Products', array( 'title' => __( 'Special Offers', 'mediacenter' ), 'show' => 'onsale', 'number' => '3', 'orderby' => 'DESC', 'order' => 'date', 'id' => 'onsale-products-footer' ), $footer_widget_area_args );
					}

					if( class_exists( 'WC_Widget_Top_Rated_Products' ) ) {	
						$footer_widget_area_args['widget_id'] = 'top-rated-products-footer';
						the_widget( 'WC_Widget_Top_Rated_Products', array( 'title' => __( 'Top Rated Products', 'mediacenter' ), 'number' => '3', 'id' => 'top-rated-products-footer' ), $footer_widget_area_args );
					}

            	}
            ?>
	        </div><!-- /.widgets-row-->
	    </div><!-- /.container -->

	    <div class="sub-form-row">
	        <div class="container">
	            <div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
	            	<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
						<label class="sr-only screen-reader-text" for="s"><?php  echo __( 'Search for:', 'mediacenter' );?></label>
						<input type="text" value="<?php echo get_search_query();?>" name="s" id="s" placeholder="<?php echo __( 'Search for products', 'mediacenter' );?>" />
						<button type="submit" class="le-button" id="searchsubmit" value="<?php echo esc_attr__( 'Search', 'mediacenter' );?>"><?php echo esc_attr__( 'Search', 'mediacenter' );?></button>
						<input type="hidden" name="post_type" value="product" />
					</form>
	            </div>
	        </div><!-- /.container -->
	    </div><!-- /.sub-form-row -->

	    <div class="link-list-row">
	        <div class="container">
	        	<div class="row">
	        		<div class="col-xs-12 col-md-4 ">
		                <!-- ============================================================= CONTACT INFO ============================================================= -->
						<div class="contact-info">
						    <div class="footer-logo">
								<?php 
									$default_logo_html = '<img alt="logo" src="' . get_template_directory_uri() . '/assets/images/logo.png" width="233" height="54"/>';
									echo apply_filters( 'mc_display_footer_logo', $default_logo_html );
								?>
						    </div><!-- /.footer-logo -->
						    
						    <?php $footer_contact_info_text = apply_filters( 'mc_footer_contact_info_text', '' ); ?>
						    <?php if( ! empty( $footer_contact_info_text ) ) : ?>
						    <p class="regular-bold"><?php echo $footer_contact_info_text; ?></p>
						    <?php endif; ?>

						    <?php $footer_contact_info_address = apply_filters( 'mc_footer_contact_info_address', '' ); ?>
						    <?php if( ! empty( $footer_contact_info_address ) ) : ?>
						    <p>
						        <?php echo $footer_contact_info_address; ?>
						    </p>
							<?php endif; ?>
						    
						    <?php mc_display_footer_social_links(); ?>

						</div><!-- /.contact-info -->
						<!-- ============================================================= CONTACT INFO : END ============================================================= -->
					</div>

		            <div class="col-xs-12 col-md-8">
		                
		                <!-- ============================================================= LINKS FOOTER ============================================================= -->
						
						<div class="footer-bottom-widget-area">
						<?php 
						if ( is_active_sidebar( 'footer-bottom-widget-area' ) ) {

							dynamic_sidebar( 'footer-bottom-widget-area' );

						} else {

							echo '<div class="columns"><aside class="widget clearfix"><div class="body">';
							echo '<h4 class="widget-title">';
							echo __( 'Find it Fast', 'mediacenter' );
							echo '</h4>';
							echo '<ul class="menu-find-it-fast menu">';
							echo wp_list_categories(
					            	array(
						                'title_li'     => '', 
						                'hide_empty'   => 1 , 
						                'taxonomy'     => 'product_cat',
						                'hierarchical' => 1 ,
						                'echo'         => 0 ,
						                'depth'        => 1 ,
						            )
						        );
							echo '</ul></div></aside></div>';

							$footer_bottom_widget_area_args = array(
								'before_widget' => '<div class="columns"><aside class="widget clearfix"><div class="body">',
								'after_widget'  => '</div></aside></div>',
								'before_title'  => '<h4 class="widget-title">',
								'after_title'   => '</h4>',
								'widget_id'     => '',
							);

							$footer_bottom_widget_area_args['widget_id'] = 'meta-footer';
							the_widget( 'WP_Widget_Meta', array( 'title' => __( 'Meta', 'mediacenter' ) ), $footer_bottom_widget_area_args );

		        			$footer_bottom_widget_area_args['widget_id'] = 'pages-footer-footer';
							the_widget( 'WP_Widget_Pages', array( 'title' => __( 'Pages', 'mediacenter') ), $footer_bottom_widget_area_args );
							
							echo '<div class="columns"><aside class="widget clearfix"><div class="body">';
							echo '<h4 class="widget-title">';
							echo __( 'My Account', 'mediacenter' );
							echo '</h4>';
							echo media_center_woocommerce_pages();
							echo '</div></aside></div>';
						}
		        		?>
		        		</div>
						<!-- ============================================================= LINKS FOOTER : END ============================================================= -->
					</div><!-- /.col -->
	        	</div>
	        </div><!-- /.container -->
	    </div><!-- /.link-list-row -->

	    <div class="copyright-bar">
	        <div class="container">
	        	<?php $footer_copyright_text = apply_filters( 'mc_footer_copyright_text', '' ); ?>
	        	<?php if( ! empty( $footer_copyright_text ) ) : ?>
	            <div class="col-xs-12 col-sm-6 no-margin">
	                <div class="copyright">
	            	<?php echo $footer_copyright_text; ?>
	                </div><!-- /.copyright -->
	            </div>
	        	<?php endif ; ?>

	        	<?php $credit_card_icons_gallery = apply_filters( 'mc_credit_card_icons_gallery', '' ); ?>
	        	<?php if( ! empty( $credit_card_icons_gallery ) ): ?>
	            <div class="col-xs-12 col-sm-6 no-margin">
	            	<?php $credit_cart_icons = explode( ',', $credit_card_icons_gallery ); ?>
	                <div class="payment-methods ">
	                    <ul>
	                    	<?php foreach ( $credit_cart_icons as $credit_cart_icon ): ?>
	                    	<?php $credit_cart_image_atts = wp_get_attachment_image_src( $credit_cart_icon ); ?>
	                        <li><img src="<?php echo $credit_cart_image_atts[0];?>" alt="" width="40" height="29"></li>
	                    	<?php endforeach; ?>
	                    </ul>
	                </div><!-- /.payment-methods -->
	            </div>
	        	<?php endif; ?>
	        </div><!-- /.container -->
	    </div><!-- /.copyright-bar -->

	</footer>
</div><!-- /.wrapper -->

<?php wp_footer(); ?>
</body>
</html>