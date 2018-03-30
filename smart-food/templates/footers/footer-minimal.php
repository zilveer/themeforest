<?php
/**
 * The template for displaying the footer.
 *
 * @package smartfood
 */

$email = esc_attr(tdp_option('email'));

?>

<section id="footer-minimal">
	<div class="container">
		<div class="row clearfix">
			<div class="col-md-12 col-sm-12 col-xs-12 column">
				<div class="footer-container">
					<?php tdp_logo(true);?>
					<ul class="footer-contact-details">
						<li><span><?php _e('Visit us:', 'smartfood'); ?></span> <?php echo esc_attr(tdp_option('restaurant_address'));?></li>
						<li><span><?php _e('Email:', 'smartfood'); ?></span> <a href="mailto:<?php echo antispambot($email);?>"><?php echo antispambot($email);?></a></li>
						<li><span><?php _e('Phone:', 'smartfood'); ?></span> <?php echo esc_attr(tdp_option('phone'));?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row clearfix footer-copyright">
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
</section>