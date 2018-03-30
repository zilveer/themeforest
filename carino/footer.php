<?php
/**
*
* The template for displaying the footer.
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/
?>
<div class="clear"></div>
</div><!-- #main-wrap -->



<footer id="main-footer">

	<?php get_sidebar( 'footer' ); ?>

	<?php if ( van_get_option( 'footer-copyright' ) || van_get_option("footer_menu") ): ?>
		
		<div id="footer-bottom">

			<div class="container clearfix">

				<?php if ( van_get_option("footer-copyright") ): ?>
					<div class="footer-copyrights">
						<p><?php echo van_get_option( 'footer-copyright', true ); ?></p>
					</div>
				<?php endif; ?>

				<?php if ( van_get_option("footer_menu") ): ?>
					<div class="footer-nav-wrap">
						<nav  id="footer-navigation" role="navigation">
							<?php wp_nav_menu( array('theme_location' => 'FooterNav', 'menu_class'  => 'FooterNav','fallback_cb' => 'van_nav_alert') );?>
						</nav>
					</div><!-- #footer-menu -->
				<?php endif; ?>

			</div><!-- .container -->

		</div><!-- #footer-bottom -->

	<?php endif; ?>

</footer><!-- #main-footer -->

<?php if( van_get_option("back-to-Top") ): ?>
	<a class="scrolltop"><i class="icon-angle-up icon"></i></a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>