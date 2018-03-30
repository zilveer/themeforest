				<div id="footer-wrapper">
					<div id="footer-top">
						<ul>
							<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget Area')): endif; ?>
						</ul>
					</div><!--footer-top-->
					<div id="footer-bottom">
						<p><?php echo get_option('ht_copyright'); ?></p><?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>
					</div><!--footer-bottom-->
				</div><!--footer-wrapper-->
			</div><!--content-wrapper-->
		</div><!--main-->
	</div><!--wrapper-->
	</div><!--bot-wrap-->
</div><!--site-->

<?php wp_footer(); ?>

</body>
</html>