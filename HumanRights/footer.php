<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WPCharming
 */

global $wpc_option;
?>

	</div><!-- #content -->
	
	<div class="clear"></div>
	
	<?php if ( $wpc_option['footer_newsletter'] ) { ?>
	<div class="footer-connect">
		<div class="container">

			<?php if ( wpcharming_option('footer_newsletter') && wpcharming_option('newsletter_type') == 'feedburner' ) { ?>
			<div class="footer-subscribe">
				<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="_blank" >
						<?php if ( $wpc_option['newsletter_text'] ) { ?> <label for="email_subscribe"><?php echo esc_attr($wpc_option['newsletter_text']); ?></label> <?php } ?>
						<input type="email" placeholder="<?php echo __('Enter your e-mail address', 'wpcharming') ?>" value="" name="email" id="email_subscribe" class="subs_email_input" required="required">
						<input type="submit" value="<?php _e('Subscribe','wpcharming'); ?>" class="btn btn-light">
						<input type="hidden" value="<?php echo esc_attr($wpc_option['feedburner_id']); ?>" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
				</form>
			</div>
			<?php } ?>

			<?php if ( wpcharming_option('footer_newsletter') && wpcharming_option('newsletter_type') == 'mailchimp' ) { ?>
			<div class="footer-subscribe">
				<form action="<?php echo esc_url($wpc_option['mailchimp_url']); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="" target="_blank" novalidate>
					<?php if ( $wpc_option['newsletter_text'] ) { ?> <label for="email_subscribe"><?php echo esc_attr($wpc_option['newsletter_text']); ?></label> <?php } ?>
					<input type="text" value="" name="EMAIL" class="subs_input" id="mce-EMAIL" placeholder="<?php echo __('Enter your e-mail address', 'wpcharming') ?>" required="true">
					<input type="submit" name="subscribe" value="<?php _e('Subscribe','wpcharming'); ?>" class="btn btn-light">
				 </form>
			</div>
			<?php } ?>

			<?php if ( $wpc_option['footer_social'] ) { ?>
			<div class="footer-social">
				<?php if ( $wpc_option['social_text'] ) { ?> <label for=""><?php echo esc_attr($wpc_option['social_text']); ?></label> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['twitter']) && $wpc_option['footer_use_social']['twitter'] == 1 && $wpc_option['twitter'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['twitter']); ?>" title="Twitter"><i class="fa fa-twitter"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['facebook']) && $wpc_option['footer_use_social']['facebook'] == 1 && $wpc_option['facebook'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['facebook']); ?>" title="Facebook"><i class="fa fa-facebook-official"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['linkedin']) && $wpc_option['footer_use_social']['linkedin'] == 1 && $wpc_option['linkedin'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['linkedin']); ?>" title="Linkedin"><i class="fa fa-linkedin-square"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['yelp']) && $wpc_option['footer_use_social']['yelp'] == 1 && $wpc_option['yelp'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['yelp']); ?>" title="Yelp"><i class="fa fa-yelp"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['pinterest']) && $wpc_option['footer_use_social']['pinterest'] == 1 && $wpc_option['pinterest'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['pinterest']); ?>" title="Pinterest"><i class="fa fa-pinterest"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['google']) && $wpc_option['footer_use_social']['google'] == 1 && $wpc_option['google'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['google']); ?>" title="Google Plus"><i class="fa fa-google-plus"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['instagram']) && $wpc_option['footer_use_social']['instagram'] == 1 && $wpc_option['instagram'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['instagram']); ?>" title="Instagram"><i class="fa fa-instagram"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['flickr']) && $wpc_option['footer_use_social']['flickr'] == 1 && $wpc_option['flickr'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['flickr']); ?>" title="Flickr"><i class="fa fa-flickr"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['youtube']) && $wpc_option['footer_use_social']['youtube'] == 1 && $wpc_option['youtube'] !== '' ) { ?><a target="_blank" href="<?php echo esc_url($wpc_option['youtube']); ?>" title="Youtube"><i class="fa fa-youtube-play"></i></a> <?php } ?>
				<?php if ( !empty( $wpc_option['footer_use_social']['email']) && $wpc_option['footer_use_social']['email'] == 1 && $wpc_option['email'] !== '' ) { ?><a target="_blank" href="<?php echo wp_kses_post($wpc_option['email']); ?>" title="Email"><i class="fa fa-envelope"></i></a> <?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			
			<?php if ( $wpc_option['footer_widgets'] ) { ?>
			<div class="footer-widgets-area">
				<?php $footer_columns = $wpc_option['footer_columns']; ?>
				<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) { ?>
					<div class="sidebar-footer footer-columns footer-<?php echo $footer_columns ?>-columns clearfix">
						<?php 
						for ( $count = 1; $count <= $footer_columns; $count++ ) {
							?>
							<div id="footer-<?php echo $count ?>" class="footer-<?php echo $count ?> footer-column widget-area" role="complementary">
								<?php dynamic_sidebar('footer-'.$count);?>
							</div>
							<?php
						}
						?>
					</div>
				<?php } ?>
			</div>
			<?php } ?>

			<div class="site-info clearfix">
				<div class="copy_text">
					<?php
					if ( wpcharming_option('footer_copyright') == '' ) {
						printf( __( 'Copyright &copy; 2015 %1$s. Theme by %2$s.', 'wpcharming' ), get_bloginfo('name'), '<a href="'. esc_url( __( 'http://www.wpcharming.com/', 'wpcharming' ) ) .'" rel="designer">WPCharming</a>' ); 
					} else {
						echo wp_kses_post( wpcharming_option('footer_copyright') );
					}
					?>
				</div>
				<div class="footer-menu">
					<ul class="footer-menu">
						<?php wp_nav_menu( array('theme_location' => 'footer', 'container' => '', 'items_wrap' => '%3$s', 'fallback_cb' => false ) ); ?>
					</ul>
				</div>
			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( wpcharming_option('page_back_totop') ) { ?>
<div id="btt"><i class="fa fa-angle-double-up"></i></div>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>
