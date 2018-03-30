<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

global $allaround_data;
if ( $allaround_data['footer-twitter'] == 1 ) echo '<div id="footer-twitter" class="static_banner_wrapper twitter_banner customColorBg">' . do_shortcode('[aa_twitter user="' . $allaround_data['footer-twitter-user'] . '"]') . '</div>';
?>
	<footer>
		<div class="footer_wrapper no-sidebar">
			<div class="footer_inner_wrapper padding-top48">
				<div class="footer_text">
					<span class="footer_header"><?php bloginfo('name'); ?></span>
					<span><?php bloginfo('description'); ?></span>
					</div><!-- footer_text -->
				<?php if ( isset($allaround_data['footer-links']) ) : ?>
				<div class="footer_carousel">
					<div class="car_wrap">
						<div id="mycarousel">
							<?php
								$footer_slides = $allaround_data['footer-links'];
								foreach ( $footer_slides as $footer_slide ) {
									echo "<a href='". $footer_slide['link'] ."'><img src='". $footer_slide['url'] ."' alt='image'/></a>";
								}
							?>
						</div>
						<a href="#" id="ui-carousel-next"></a>
						<a href="#" id="ui-carousel-prev"></a>
							</div><!-- car_wrap -->
				</div><!-- footer_carousel -->
				<div class="clear"></div><!--clear -->
				<?php endif; ?>
				<?php
					$footer_sidebar = $allaround_data['footer_sidebar'];
					switch( $footer_sidebar ) {
					case '1' :
						echo '<div class="column-1-1 column">';
						echo '<div class="separator3 margin-bottom24 margin-top24"></div>';
						dynamic_sidebar('footer-1');
						echo '</div>';
						break;
					case '2' :
						for( $i = 1; $i <=2; $i++ ) {
							if ( $i == 2 ) : $last = ' column-last'; else :  $last = ''; endif;
							echo '<div class="column-1-2 column' . $last . '">';
							echo '<div class="separator3 margin-bottom24 margin-top24"></div>';
							dynamic_sidebar( 'footer-' . $i );
							echo '</div>';
						}
						break;
					case '3' :
						for( $i = 1; $i <=3; $i++ ) {
							if ( $i == 3 ) : $last = ' column-last'; else :  $last = ''; endif;
							echo '<div class="column-1-3 column' . $last . '">';
							echo '<div class="separator3 margin-bottom24 margin-top24"></div>';
							dynamic_sidebar( 'footer-' . $i );
							echo '</div>';
						}		
						break;
					case '4' :
						for( $i = 1; $i <=4; $i++ ) {
							if ( $i == 4 ) : $last = ' column-last'; else :  $last = ''; endif;
							echo '<div class="column-1-4 column' . $last . '">';
							echo '<div class="separator3 margin-bottom24 margin-top24"></div>';
							dynamic_sidebar( 'footer-' . $i );
							echo '</div>';
						}	
						break;
					}
				?>
				<div class="clear margin-bottom24"></div><!--clear -->
			</div><!-- footer_inner_wrapper -->
		</div><!-- footer_wrapper -->
					<div class="subfooter_wrapper">
				<nav class="subfooter_inner_wrapper">
					<div class="copyright"><?php echo $allaround_data['after_footer']; ?></div><!-- copyright -->
					<?php
						wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '1', 'fallback_cb' => 'wp_list_pages_custom',  'container' => false, 'menu_id' => 'footer-menu', 'menu_class' => 'footer_navigation' ) );
					?>
						<div class="clear"></div><!--clear -->
					</nav><!-- subfooter_inner_wrapper -->
				</div><!-- subfooter_wrapper -->
					<div class="clear"></div><!--clear -->
	</footer>
<?php wp_footer(); ?>
</body>
</html>