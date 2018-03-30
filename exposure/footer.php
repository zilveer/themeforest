<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */
?>				
				<?php thb_content_end(); ?>

			</section><!-- /#content -->

			<?php thb_content_after(); ?>
		
			<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
				<a href="#" data-icon="+" class="thb-main-sidebar-toggle">Display sidebar</a>
			<?php endif; ?>

			<section id="footer">
				<div id="bottom-footer">
					<p id="copyright">
						<a id="footerlogo" href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<?php $copyright = thb_get_option("copyright"); if( !empty($copyright) ) : ?>
						<span> &mdash; <?php echo thb_text_format($copyright); ?></span>
						<?php endif; ?>
					</p>
				</div>

			</section>

			<div class="thb-full-background-wrapper">
				<?php thb_fullbackground_start(); ?>
			</div>

		</div><!-- /#page -->
		
		<?php thb_body_end(); ?>

		<?php thb_footer(); ?>
		<?php wp_footer(); ?>
	</body>
</html>