<?php
/**
 * @package WordPress
 * @subpackage Fast_Blog_Theme
 * @since Fast Blog 1.0
 */
?>

					<div class="clear"></div>

				</div>
				<!-- // Main section -->

				<div class="line full"></div>

				<!-- Footer -->
				<div id="footer" class="container">
					<p id="copyright">
						<?php
							if ($footer = fastblog_get_option('footer')) {
								echo $footer;
							} else {
								printf('&copy; %s <a href="%s" title="%s" rel="home">%s</a>', date('Y'), home_url('/'), esc_attr(get_bloginfo('name')), get_bloginfo('name'));
							}
						?>
					</p>
					<?php wp_nav_menu(array(
						'theme_location' => 'nav-menu-footer',
						'container'      => '',
						'menu_class'     => '',
						'depth'          => 1,
						'fallback_cb'    => create_function('', 'fastblog_nav_menu("'.fastblog_get_option('menu/content/footer').'", 1);')
					)); ?>
				</div>
				<!-- // Footer -->

			</div>
			<!-- // Inner wrapper -->

		</div>
		<!-- // Wrapper -->

		<?php wp_footer(); ?>

	</body>
	<!-- // Body section -->

</html>