<?php
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
?>
    <section id="bottom">
		<div class="padding">
			<div class="container">
				<div class="sixteen columns">
				<?php $the_sidebars = wp_get_sidebars_widgets();
				$modules = $the_sidebars['bottom-sidebar'];
				$widget_btm = count($modules);
				?>
					<div class="gutter alpha omega totalWidget-<?php echo $widget_btm; ?>">
						<?php if( is_active_sidebar('bottom-sidebar') ) : ?><?php dynamic_sidebar( 'bottom-sidebar' ); ?>
						<?php endif; ?>
						
					</div><!-- .gutter .alpha .omega -->
				</div><!-- .sixteen .columns -->
			</div><!-- .container -->
		</div><!-- .padding -->
    </section><!-- #bottom -->
	<section id="footer">
		<div class="padding">
			<div class="container">
				<div class="eight columns">
					<div class="gutter alpha">
						<div class="copyright">
						<?php if (of_get_option('use_custom_copy')) : ?>
							<?php echo (of_get_option('custom_copy_text')) ?>
						<?php else : ?>
							Copyright &#169; 2012 Arapah Demo Site. All Rights Reserved. Powered by <a href="http://wordpress.org/" title="wordpress.org">Wordpress</a><br />
							Wordpress Theme Developed by <a href="http://themesoul.com/" title="ThemeSoul.com">ThemeSoul.com</a>
						</div>
						<?php endif; ?>
					</div><!-- .gutter .alpha .omega -->
				</div><!-- .eight .columns -->
				<div class="eight columns">
					<div class="gutter omega">
						<?php if( is_active_sidebar('footnav') ) : ?><?php dynamic_sidebar( 'footnav' ); ?>
						<?php endif; ?>
						
					</div><!-- .gutter .alpha .omega -->
				</div><!-- .eight .columns -->
			</div><!-- .container -->
		</div><!-- .padding -->
    </section><!-- #footer -->
            
</div><!-- .wrapper -->
<?php wp_footer(); ?>
   
</body>
</html>