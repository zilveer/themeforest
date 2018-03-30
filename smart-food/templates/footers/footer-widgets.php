<?php
/**
 * The template for displaying the footer.
 *
 * @package smartfood
 */
?>

<section id="footer-widgets">
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12 col-sm-12 col-xs-12 column" id="footer-info-area">
			
			<?php if(tdp_option('display_logo_in_footer')) { 
				tdp_logo(false);
			} ?>

			<?php if(tdp_option('footer_about_title')) : ?>
			<h2><?php echo esc_attr( do_shortcode( tdp_option('footer_about_title') ) );?></h2>
			<?php endif; ?>

			<p><?php echo wp_kses( tdp_option('footer_about'), array(
				    'a' => array(
				        'href' => array(),
				        'title' => array()
				    ),
				    'br' => array(),
				    'p' => array(),
				    'em' => array(),
				    'strong' => array(),
			) ); ?></p>

			</div>
		</div><!-- end row -->

		<div class="row clearfix" id="footer-widgets-area">
			<div class="col-md-4 col-sm-12 col-xs-12 column">
			<?php dynamic_sidebar( 'Footer Widget Area 1' ); ?>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12 column">
			<?php dynamic_sidebar( 'Footer Widget Area 2' ); ?>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12 column">
			<?php dynamic_sidebar( 'Footer Widget Area 3' ); ?>
			</div>
		</div><!-- end row -->
	</div>
	<div class="copyright-container">
		<div class="container">
			<div class="row clearfix">
				<div class="col-md-6 col-sm-12 col-xs-12 column">
					<nav id="footer-nav" class="site-navigation footer-navigation" <?php tdp_attr( 'menu', 'footer' ); ?>>
							<?php wp_nav_menu(
								array(
									'theme_location'  => 'footer',
									'container'       => '',
									'fallback_cb'     => '',
									'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
								)
							); ?>
					</nav>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12 column">
				<?php echo wp_kses( tdp_option('copyright_notice'), array(
					    'a' => array(
					        'href' => array(),
					        'title' => array()
					    ),
					    'br' => array(),
					    'em' => array(),
					    'strong' => array(),
					) ); ?>
				</div>
			</div>
		</div>
	</div>
</section>