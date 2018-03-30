				<div class="clear"></div>
			</div><!-- end div.container, begins in header.php -->
		</div><!-- end div.wrapper, begins in header.php -->
		<div id="footer" class="wrapper">
			<div class="container">
				<div class="left" id="footer_menu">
					<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'depth' => '1' ) ); ?>
					<div class="clear"></div>
					<?php if ((of_get_option('twitter') != '') || (of_get_option('facebook') != '') || (of_get_option('google') != '') || (of_get_option('flickr') != '') || (of_get_option('vimeo') != '') || (of_get_option('forrst') != '') || (of_get_option('dribbble') != '') || (of_get_option('tumblr') != '') ) { ?>
					&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>
					<?php if (of_get_option('give_credit') == '1') { ?>
						&nbsp;&nbsp;::&nbsp;&nbsp;&nbsp;<?php $string = sprintf( __('<a href="%1$s">Stored Theme</a> by <a href="%2$s">Design Crumbs</a>', 'designcrumbs'), 'http://themes.designcrumbs.com', 'http://designcrumbs.com' ); echo $string; ?></a>
					<?php } else { ?>
						&nbsp;&nbsp;::&nbsp;&nbsp;&nbsp;<?php bloginfo('description'); ?>
					<?php } ?>
					<?php } ?>
				</div>
				<div class="right">
					<?php if ((of_get_option('twitter') != '') || (of_get_option('facebook') != '') || (of_get_option('google') != '') || (of_get_option('flickr') != '') || (of_get_option('vimeo') != '') || (of_get_option('forrst') != '') || (of_get_option('dribbble') != '') || (of_get_option('tumblr') != '') ) { ?>
						<div id="socnets">
								<?php if (of_get_option('twitter') != '') { ?>
							<a href="<?php echo stripslashes(of_get_option('twitter')); ?>" title="Twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/twitter.png" alt="Twitter" /></a>
								<?php } if (of_get_option('facebook') != '') { ?>
							<a href="<?php echo stripslashes(of_get_option('facebook')); ?>" title="Facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/facebook.png" alt="Facebook" /></a>
								<?php } if (of_get_option('google') != '') { ?>
							<a href="<?php echo stripslashes(of_get_option('google')); ?>" title="Google+"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/google.png" alt="Google+" /></a>
								<?php } if (of_get_option('flickr') != '') { ?>
							<a href="<?php echo stripslashes(of_get_option('flickr')); ?>" title="Flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/flickr.png" alt="Flickr" /></a>
								<?php } if (of_get_option('forrst') != '') { ?>
							<a href="<?php echo stripslashes(of_get_option('forrst')); ?>" title="Forrst"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/forrst.png" alt="Forrst" /></a>
								<?php } if (of_get_option('dribbble') != '') { ?>
							<a href="<?php echo stripslashes(of_get_option('dribbble')); ?>" title="Dribbble"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/dribbble.png" alt="Dribbble" /></a>
								<?php } if (of_get_option('tumblr') != '') { ?>
							<a href="<?php echo stripslashes(of_get_option('tumblr')); ?>" title="Tumblr"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/tumblr.png" alt="Tumblr" /></a>
								<?php } if (of_get_option('vimeo') != '') { ?>
							<a href="<?php echo stripslashes(of_get_option('vimeo')); ?>" title="Vimeo"><img src="<?php echo get_template_directory_uri(); ?>/images/socnets/vimeo.png" alt="Vimeo" /></a>
								<?php } ?>
							<div class="clear"></div>
						</div>
					<?php } else { ?>
					&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>
					<?php if (of_get_option('give_credit') == '1') { ?>
						&nbsp;&nbsp;::&nbsp;&nbsp;&nbsp;<?php $string = sprintf( __('<a href="%1$s">Stored Theme</a> by <a href="%2$s">Design Crumbs</a>', 'designcrumbs'), 'http://themes.designcrumbs.com', 'http://designcrumbs.com' ); echo $string; ?></a>
					<?php } else { ?>
						&nbsp;&nbsp;::&nbsp;&nbsp;&nbsp;<?php bloginfo('description'); ?>
					<?php } ?>
					<?php } ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php echo stripslashes(of_get_option('analytics')); ?>
		<?php wp_footer(); //leave for plugins ?>
	</body>
</html>
