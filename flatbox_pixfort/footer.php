<?php
global $smof_data;
$footer_widgets = (is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ));
?>
		<?php
		if(!empty($smof_data['color_base'])){ 
			get_template_part('css-loader'); 
		}
		if(!empty($smof_data['color_link'])){ 
			get_template_part('css-loader2'); 
		}
			?>

	<a href="#header" id="top-link"><span></span></a>
	</section>
	</div>
	<div class="wrapper-row">
	<footer id="footer">
		
<?php if ($footer_widgets) : ?>
		<section class="container clearfix">
			<div class="grid3 col">
				<?php if ( is_active_sidebar( 'sidebar-1' )) dynamic_sidebar( 'sidebar-1' ); ?>
			</div>
			<div class="grid3 col">
				<?php if ( is_active_sidebar( 'sidebar-2' )) dynamic_sidebar( 'sidebar-2' ); ?>
			</div>
			<div class="grid3 col">
				<?php if ( is_active_sidebar( 'sidebar-3' )) dynamic_sidebar( 'sidebar-3' ); ?>
			</div>
			<div class="grid3 col">
				<?php if ( is_active_sidebar( 'sidebar-4' )) dynamic_sidebar( 'sidebar-4' ); ?>
			</div>
		</section>
		<div class="bottom">
<?php else : ?>
		<div class="bottom remove-margin">
<?php endif; ?>
			<section class="container">
				<div class="grid5 col alpha">
<?php if(!empty($smof_data['custom_footer_logo'])) { ?>
				<img src="<?php echo $smof_data['custom_footer_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>"/>
<?php } else { ?>
				<?php if(!empty($smof_data['footer_text'])) { ?>
				<p class="footer_left_text"><?php echo do_shortcode($smof_data['footer_text']); ?></p>
				<?php }else{ ?>
				<p class="footer_left_text"><?php echo do_shortcode( __('Copyright &copy; [the-year] ', 'flatbox') ); ?><span class="footer-title"><?php echo do_shortcode( __('[blog-title]', 'flatbox') ); ?></span></p>
				<?php } ?>
<?php } ?>
				</div>
				<div class="grid7 col omega">
<?php if(!empty($smof_data['footer_blocks2'])) { ?>
		
<?php

$footer_blocks = (isset($smof_data['footer_blocks2'])) ? $smof_data['footer_blocks2']['enabled'] : array();
$i = 0;
$scount = count($footer_blocks);
if ($scount > 0)
	foreach ($footer_blocks as $key => $value) :
		$i++;
		switch ($key) :
			case 'facebook': ?>
			<?php if (isset($smof_data['footer-facebook'] )) { ?>
				<a href="<?php echo $smof_data['footer-facebook']; ?>" class="footer_social facebook-c"><img src="<?php echo get_template_directory_uri(); ?>/social/facebook.png" alt="social"></a>
			<?php  }
			break;
			case 'youtube': ?>
			<?php if (isset($smof_data['footer-youtube'] )) { ?>
				<a href="<?php echo $smof_data['footer-youtube']; ?>" class="footer_social youtube-c"><img src="<?php echo get_template_directory_uri(); ?>/social/youtube.png" alt="social"></a>
			<?php }
			break;
			case 'twitter': ?>
			<?php if (isset($smof_data['footer-twitter'] )) { ?>
				<a href="<?php echo $smof_data['footer-twitter']; ?>" class="footer_social twitter-c"><img src="<?php echo get_template_directory_uri(); ?>/social/twitter.png" alt="social"></a>

			<?php }
			break;
			case 'envato': ?>
			<?php if (isset($smof_data['footer-envato'] )) { ?>
				<a href="<?php echo $smof_data['footer-envato']; ?>" class="footer_social envato-c"><img src="<?php echo get_template_directory_uri(); ?>/social/envato.png" alt="social"></a>

			<?php }
			break;
			case 'rss': ?>
			<?php if (isset($smof_data['footer-rss'] )) { ?>
				<a href="<?php echo $smof_data['footer-rss']; ?>" class="footer_social rss-c"><img src="<?php echo get_template_directory_uri(); ?>/social/rss.png" alt="social"></a>

			<?php }
			break;
			case 'amazon': ?>
			<?php if (isset($smof_data['footer-amazon'] )) { ?>
				<a href="<?php echo $smof_data['footer-amazon']; ?>" class="footer_social amazon-c"><img src="<?php echo get_template_directory_uri(); ?>/social/amazon.png" alt="social"></a>

			<?php }
			break;
			case 'behance': ?>
			<?php if (isset($smof_data['footer-behance'] )) { ?>
				<a href="<?php echo $smof_data['footer-behance']; ?>" class="footer_social behance-c"><img src="<?php echo get_template_directory_uri(); ?>/social/behance.png" alt="social"></a>
			<?php }
			break;
			case 'blogger': ?>
			<?php if (isset($smof_data['footer-blogger'] )) { ?>
				<a href="<?php echo $smof_data['footer-blogger']; ?>" class="footer_social blogger-c"><img src="<?php echo get_template_directory_uri(); ?>/social/blogger.png" alt="social"></a>

			<?php }
			break;
			case 'deviantart': ?>
			<?php if (isset($smof_data['footer-deviantart'] )) { ?>
				<a href="<?php echo $smof_data['footer-deviantart']; ?>" class="footer_social deviantart-c"><img src="<?php echo get_template_directory_uri(); ?>/social/deviantart.png" alt="social"></a>

			<?php }
			break;
			case 'digg': ?>
			<?php if (isset($smof_data['footer-digg'] )) { ?>
				<a href="<?php echo $smof_data['footer-digg']; ?>" class="footer_social digg-c"><img src="<?php echo get_template_directory_uri(); ?>/social/digg.png" alt="social"></a>

			<?php }
			break;
			case 'dribbble': ?>
			<?php if (isset($smof_data['footer-dribbble'] )) { ?>
				<a href="<?php echo $smof_data['footer-dribbble']; ?>" class="footer_social dribbble-c"><img src="<?php echo get_template_directory_uri(); ?>/social/dribbble.png" alt="social"></a>

			<?php }
			break;
			case 'dropbox': ?>
			<?php if (isset($smof_data['footer-dropbox'] )) { ?>
				<a href="<?php echo $smof_data['footer-dropbox']; ?>" class="footer_social dropbox-c"><img src="<?php echo get_template_directory_uri(); ?>/social/dropbox.png" alt="social"></a>

			<?php }
			break;
			case 'ebay': ?>
			<?php if (isset($smof_data['footer-ebay'] )) { ?>
				<a href="<?php echo $smof_data['footer-ebay']; ?>" class="footer_social ebay-c"><img src="<?php echo get_template_directory_uri(); ?>/social/ebay.png" alt="social"></a>

			<?php }
			break;
			case 'flickr': ?>
			<?php if (isset($smof_data['footer-flickr'] )) { ?>
				<a href="<?php echo $smof_data['footer-flickr']; ?>" class="footer_social flickr-c"><img src="<?php echo get_template_directory_uri(); ?>/social/flickr.png" alt="social"></a>

			<?php }
			break;
			case 'forrst': ?>
			<?php if (isset($smof_data['footer-forrst'] )) { ?>
				<a href="<?php echo $smof_data['footer-forrst']; ?>" class="footer_social forrst-c"><img src="<?php echo get_template_directory_uri(); ?>/social/forrst.png" alt="social"></a>

			<?php }
			break;
			case 'google': ?>
			<?php if (isset($smof_data['footer-google'] )) { ?>
				<a href="<?php echo $smof_data['footer-google']; ?>" class="footer_social google-c"><img src="<?php echo get_template_directory_uri(); ?>/social/google.png" alt="social"></a>

			<?php }
			break;
			case 'instagram': ?>
			<?php if (isset($smof_data['footer-instagram'] )) { ?>
				<a href="<?php echo $smof_data['footer-instagram']; ?>" class="footer_social instagram-c"><img src="<?php echo get_template_directory_uri(); ?>/social/instagram.png" alt="social"></a>

			<?php }
			break;
			case 'linkedin': ?>
			<?php if (isset($smof_data['footer-linkedin'] )) { ?>
				<a href="<?php echo $smof_data['footer-linkedin']; ?>" class="footer_social linkedin-c"><img src="<?php echo get_template_directory_uri(); ?>/social/linkedin.png" alt="social"></a>

			<?php }
			break;
			case 'myspace': ?>
			<?php if (isset($smof_data['footer-myspace'] )) { ?>
				<a href="<?php echo $smof_data['footer-myspace']; ?>" class="footer_social myspace-c"><img src="<?php echo get_template_directory_uri(); ?>/social/myspace.png" alt="social"></a>

			<?php }
			break;
			case 'paypal': ?>
			<?php if (isset($smof_data['footer-paypal'] )) { ?>
				<a href="<?php echo $smof_data['footer-paypal']; ?>" class="footer_social paypal-c"><img src="<?php echo get_template_directory_uri(); ?>/social/paypal.png" alt="social"></a>

			<?php }
			break;
			case 'pinterest': ?>
			<?php if (isset($smof_data['footer-pinterest'] )) { ?>
				<a href="<?php echo $smof_data['footer-pinterest']; ?>" class="footer_social pinterest-c"><img src="<?php echo get_template_directory_uri(); ?>/social/pinterest.png" alt="social"></a>

			<?php }
			break;
			case 'skype': ?>
			<?php if (isset($smof_data['footer-skype'] )) { ?>
				<a href="<?php echo $smof_data['footer-skype']; ?>" class="footer_social skype-c"><img src="<?php echo get_template_directory_uri(); ?>/social/skype.png" alt="social"></a>

			<?php }
			break;
			case 'soundcloud': ?>
			<?php if (isset($smof_data['footer-soundcloud'] )) { ?>
				<a href="<?php echo $smof_data['footer-soundcloud']; ?>" class="footer_social soundcloud-c"><img src="<?php echo get_template_directory_uri(); ?>/social/soundcloud.png" alt="social"></a>

			<?php }
			break;
			case 'tumblr': ?>
			<?php if (isset($smof_data['footer-tumblr'] )) { ?>
				<a href="<?php echo $smof_data['footer-tumblr']; ?>" class="footer_social tumblr-c"><img src="<?php echo get_template_directory_uri(); ?>/social/tumblr.png" alt="social"></a>

			<?php }
			break;
		
			case 'vimeo': ?>
			<?php if (isset($smof_data['footer-vimeo'] )) { ?>
				<a href="<?php echo $smof_data['footer-vimeo']; ?>" class="footer_social vimeo-c"><img src="<?php echo get_template_directory_uri(); ?>/social/vimeo.png" alt="social"></a>

			<?php }
			break;
			case 'wordpress': ?>
			<?php if (isset($smof_data['footer-wordpress'] )) { ?>
				<a href="<?php echo $smof_data['footer-wordpress']; ?>" class="footer_social wordpress-c"><img src="<?php echo get_template_directory_uri(); ?>/social/wordpress.png" alt="social"></a>

			<?php }
			break;
			case 'yahoo': ?>
			<?php if (isset($smof_data['footer-yahoo'] )) { ?>
				<a href="<?php echo $smof_data['footer-yahoo']; ?>" class="footer_social yahoo-c"><img src="<?php echo get_template_directory_uri(); ?>/social/yahoo.png" alt="social"></a>


			<?php }
			break;
		endswitch;
	endforeach;

?>
<?php } else { ?>
					<p><?php echo do_shortcode( __('Copyright &copy; [the-year] [blog-title] All Rights Reserved', 'flatbox') ); ?></p>
<?php } ?>
				</div>
			</section>
		</div>
	</footer>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>