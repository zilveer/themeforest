<?php /* The Footer */ ?>

			</div>
		</div><!-- end of Content wrapper -->

	 <?php /* Shortcode section */
			if (handy_get_option('footer_shortcode_section')==true) {
				if (class_exists('Woocommerce')) {
					if ( is_front_page() || is_home() || is_shop() || is_product() || is_page_template( 'page-templates/front-page.php' ) ) {
						if (function_exists('pt_shortcode_section')) pt_shortcode_section();
					}
				} else {
					if ( is_front_page() || is_home() || is_page_template( 'page-templates/front-page.php' ) ) {
					  if (function_exists('pt_shortcode_section')) pt_shortcode_section();
				  }
				}
			} ?>

		<footer class="site-footer"<?php if (function_exists('handy_custom_footer_bg')) handy_custom_footer_bg(); ?> itemscope="itemscope" itemtype="http://schema.org/WPFooter"><!-- Site's Footer -->

			<div class="top-footer-widget"><!-- Extra widget area -->
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<?php if ( is_active_sidebar( 'top-footer-sidebar' ) ) : ?>
                            	<?php dynamic_sidebar( 'top-footer-sidebar' ); ?>
                        	<?php endif; ?>
                    	</div>
					</div>
				</div>
			</div><!-- end of Extra widget area -->

			<div class="footer-widgets"><!-- Footer's widgets -->
				<div class="container">
					<div class="row">

					<div class="col-xs-12 col-sm-6 col-md-3">
                        <?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) : ?>
                            <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
                            <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
                            <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
                            <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
                        <?php endif; ?>
                    </div>

					</div>
				</div>
			</div><!-- end of Footer's widgets -->

			<div class="footer-bottom"><!-- Copyrights -->
				<div class="container">
					<div class="row">
						<div class="site-info col-xs-12 col-sm-12 col-md-12">
							<?php /* Get content from admin panel */
							if ( handy_get_option('site_copyright') && handy_get_option('site_copyright')!='' ) { ?>
								<span itemprop="copyrightYear"><?php echo date("Y"); ?></span>
								<span itemprop="copyrightHolder"><?php echo handy_get_option('site_copyright');?></span>
							<?php } else {
								echo '<span itemprop="copyrightYear">' . date("Y") . '</span>&nbsp;<span itemprop="copyrightHolder">&copy; Handy Store by <a href="http://themes.zone/" itemprop="url">Themes Zone</a></span>';
							}
							?>
						</div>
					</div>
				</div>
			</div><!-- end of Copyrights -->

		</footer><!-- end of Site's Footer -->

		<?php if (function_exists('pt_site_wrapper_end')) pt_site_wrapper_end(); ?>

		<?php wp_footer(); ?>

	</body>

</html>
