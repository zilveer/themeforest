<?php
/************************************************************************
* Footer File
*************************************************************************/

do_action( 'wbc907_before_footer' );

global $wbc907_data;

$wbc907_footer_columns = ( isset( $wbc907_data['opts-footer'] ) && is_numeric( $wbc907_data['opts-footer'] ) ) ? $wbc907_data['opts-footer'] : 4;

$footer_class = ( $wbc907_footer_columns == 4 ) ? 'col-sm-3' : 'col-sm-4';

//Check for enabled states of footer/widget area/copyright area
$wbc907_footer_enable      = apply_filters( 'wbc907_footer_enable' , true );
$wbc907_widget_area_enable = apply_filters( 'wbc907_widget_area_enable' , true );
$wbc907_copy_area_enable   = apply_filters( 'wbc907_copy_area_enable' , true );

//if footer option true
if ( $wbc907_footer_enable ):
?>
		<!-- Begin Footer -->
		<footer class="main-footer">

		<?php if ( $wbc907_widget_area_enable ): ?>

			  <div class="widgets-area">
			    <div class="container">
			      <div class="row">


			        <div class="<?php echo esc_attr( $footer_class); ?>">

			          <?php if ( is_active_sidebar(  'footer-1' ) ){
			          	dynamic_sidebar( 'footer-1' );
			          }else{
			          	?>
			         	<div class="widget">
			              <h4 class="widget-title">
			                <?php esc_html_e( 'Archives', 'ninezeroseven' ); ?>
			              </h4>
			              <ul>
			                <?php wp_get_archives(); ?>
			              </ul>
			            </div>
			          <?php } ?>

			        </div>

					<div class="<?php echo esc_attr( $footer_class); ?>">
			          
			          <?php if ( is_active_sidebar(  'footer-2' ) ){
			          	dynamic_sidebar( 'footer-2' );
			          }else{
			          	?>
			            <div class="widget  widget_pages">
			              <h4 class="widget-title">
			                <?php esc_html_e( 'Pages', 'ninezeroseven' ); ?>
			              </h4>

			              <ul>
			                <?php wp_list_pages( 'sort_column=menu_order&title_li=' ); ?>
			              </ul>

			            </div>
			          <?php } ?>

			       	</div>

					<div class="<?php echo esc_attr( $footer_class); ?>">
			          
			          <?php if ( is_active_sidebar(  'footer-3' ) ){
			          		dynamic_sidebar( 'footer-3' );
			          }else{
			          	?>
			            <div class="widget">
			              <h4 class="widget-title">
			                <?php esc_html_e( 'Categories', 'ninezeroseven' ); ?>
			              </h4>
			              <ul class="categories">
			                <?php wp_list_categories( 'title_li=' ); ?>
			              </ul>
			            </div>
			          <?php } ?>
			        </div>



			        <?php if ( $wbc907_footer_columns == 4 ): ?>
			          <div class="<?php echo esc_attr( $footer_class); ?>">
			            
			            <?php if ( is_active_sidebar(  'footer-4' ) ){
			          		dynamic_sidebar( 'footer-4' );
			          	}else{
			          	?>
			              <div class="widget">
			                <h4 class="widget-title">
			                  <?php esc_html_e( 'Meta', 'ninezeroseven' ); ?>
			                </h4>
			                  <ul>
			                  <?php wp_register(); ?>
			                  <li><?php wp_loginout(); ?></li>
			                  <?php wp_meta(); ?>
			                </ul>
			              </div>
			            <?php } ?>
			          </div>

			        <?php endif; ?>



			      </div>
			    </div> <!-- ./container -->
			  </div>
		  <?php endif; //$wbc907_widget_area_enable ?>

		  <?php if ( $wbc907_copy_area_enable ): ?>

			  <div class="bottom-band">
			    <div class="container">
			      <div class="row">
			        <div class="col-sm-6 copy-info">

			        <?php

						if ( isset( $wbc907_data['opts-footer-credit'] ) && !empty( $wbc907_data['opts-footer-credit'] ) ) {
							
							echo wp_kses_post( do_shortcode( $wbc907_data['opts-footer-credit'] ) );

						}else {
							$footer_text = sprintf( __( '&copy; <a href="%1s">%2s</a> All Rights Reserved %3s - Powered By <a href="http://wordpress.org">WordPress</a>', 'ninezeroseven' ),
								home_url(),
								get_bloginfo( 'name' ),
								date('Y') );

							echo wp_kses_post( $footer_text );
						}

					?>
			        </div>

			        <div class="col-sm-6 extra-info">
			        <?php

						do_action( 'before_extra_info' );

						wp_nav_menu( array(
								'container'       => 'nav',
								'container_class' => 'footer-menu',
								'container_id'    => 'wbc9-footer',
								'menu'            => apply_filters( 'wbc907_page_footer_menu', '' ),
								'menu_id'         => 'footer-menu',
								'menu_class'      => 'wbc_footer_menu',
								'theme_location'  => 'wbc907-footer',
								'fallback_cb'     => ''
							) );

						do_action( 'after_extra_info' );

					?>
			        </div>
			      </div>
			    </div>
			  </div>
		<?php endif; //$copy_area_enable ?>
		</footer>

<?php endif; // wbc907_footer_enable ?>

	</div> <!-- ./page-wrapper -->

<?php

do_action( 'wbc907_after_page_content' );

wp_footer();
?>
</body>
</html>