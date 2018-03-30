<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if( theme_options('advance', 'enable_responsive') != 'off' ) : ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php endif; ?>

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>  >
<div id="layout" class="<?php echo theme_options('appearance', 'site_layout'); ?> <?php if(isset($_REQUEST['layout'])) echo $_REQUEST['layout']; ?> <?php if( theme_options('appearance', 'enable_responsive') == 'off' ) echo 'boxed non-responsive'; ?>">

<header class="<?php echo theme_options('header', 'style'); ?>">
<div class="container">

	<div id="branding" role="banner">
		<div id="site-title">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php if( theme_options('header', 'logo') || theme_options('header', 'logo_2x') ): ?>
					
					<?php if( theme_options('header', 'logo') && theme_options('header', 'logo_2x') ): 
						$logo = wp_get_attachment_image_src( theme_options('header', 'logo'), 'full' );
						$logo_2x = wp_get_attachment_image_src( theme_options('header', 'logo_2x'), 'full' );
					?>
						<img src="<?php echo $logo[0]; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" class="x1" width="<?php echo $logo[1]; ?>" height="<?php echo $logo[2]; ?>" />
						<img src="<?php echo $logo_2x[0]; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" class="x2" width="<?php echo $logo_2x[1]/2; ?>" height="<?php echo $logo_2x[2]/2; ?>" />
					<?php elseif( theme_options('header', 'logo') && !theme_options('header', 'logo_2x') ):
						$logo = wp_get_attachment_image_src( theme_options('header', 'logo'), 'full' );
					?>
						<img src="<?php echo $logo[0]; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="<?php echo $logo[1]; ?>" height="<?php echo $logo[2]; ?>" />
					<?php elseif( !theme_options('header', 'logo') && theme_options('header', 'logo_2x') ): 
						$logo_2x = wp_get_attachment_image_src( theme_options('header', 'logo_2x'), 'full' );
					?>
						<img src="<?php echo $logo_2x[0]; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="<?php echo $logo_2x[1]/2; ?>" height="<?php echo $logo_2x[2]/2; ?>" />
					<?php endif; ?>
					
				<?php elseif( theme_options('header', 'style') == 'light' ): ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/stack-logo.png" alt="<?php echo get_bloginfo( 'name' ); ?>" class="x1" />
					<img src="<?php echo get_template_directory_uri(); ?>/images/stack-logo@2x.png" alt="<?php echo get_bloginfo( 'name' ); ?>" class="x2" style="width: 171px;" />
				<?php else: ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/stack-logo-white.png" alt="<?php echo get_bloginfo( 'name' ); ?>" class="x1" />
					<img src="<?php echo get_template_directory_uri(); ?>/images/stack-logo-white@2x.png" alt="<?php echo get_bloginfo( 'name' ); ?>" class="x2" style="width: 171px;" />
				<?php endif; ?>
			</a>
		</div>

		<div id="site-description"><?php bloginfo( 'description' ); ?></div>
	</div><!-- #branding -->

	<nav id="primary-nav">
		<?php wp_nav_menu( array( 'container' => '', 'menu_id' => 'primary-nav-list', 'menu_class' => false, 'theme_location' => 'primary', 'fallback_cb' => '' ) ); ?>
		<div class="theme-form" id="tiny-nav">
		<div class="select-wrap input-wrap">
			<i class="icon icon-angle-down"></i>			
		</div>
		</div>
	</nav>

	<div id="social-box">
		<ul>
			<?php if( theme_options('header', 'phone') ): ?><li class="phone"><a href="tel://<?php echo preg_replace('/[^0-9]/', '', theme_options('header', 'phone') ); ?>"><i class="icon icon-phone"></i> <span><?php echo theme_options('header', 'phone'); ?></span></a></li><?php endif; ?>

			<?php if( theme_options('header', 'pinterest') ): ?><li class="pinterest"><a href="<?php echo theme_options('header', 'pinterest'); ?>"><i class="icon icon-pinterest"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'dribbble') ): ?><li class="dribbble"><a href="<?php echo theme_options('header', 'dribbble'); ?>"><i class="icon icon-dribbble"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'tumblr') ): ?><li class="tumblr"><a href="<?php echo theme_options('header', 'tumblr'); ?>"><i class="icon icon-tumblr"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'flickr') ): ?><li class="flickr"><a href="<?php echo theme_options('header', 'flickr'); ?>"><i class="icon icon-flickr"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'instagram') ): ?><li class="instagram"><a href="<?php echo theme_options('header', 'instagram'); ?>"><i class="icon icon-instagram"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'youtube') ): ?><li class="youtube"><a href="<?php echo theme_options('header', 'youtube'); ?>"><i class="icon icon-youtube"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'linkedin') ): ?><li class="linkedin"><a href="<?php echo theme_options('header', 'linkedin'); ?>"><i class="icon icon-linkedin"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'twitter') ): ?><li class="twitter"><a href="<?php echo theme_options('header', 'twitter'); ?>"><i class="icon icon-twitter"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'facebook') ): ?><li class="facebook"><a href="<?php echo theme_options('header', 'facebook'); ?>"><i class="icon icon-facebook"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'google-plus') ): ?><li class="google"><a href="<?php echo theme_options('header', 'google-plus'); ?>"><i class="icon icon-google-plus"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'email') ): ?><li class="email"><a href="mailto:<?php echo theme_options('header', 'email'); ?>"><i class="icon icon-envelope"></i></a></li><?php endif; ?>
			
			<?php if( theme_options('header', 'rss') == 'on' ): ?><li class="rss"><a href="<?php bloginfo('rss2_url'); ?>"><i class="icon icon-rss"></i></a></li><?php endif; ?>

			<?php if( theme_options('header', 'search') == 'on' ): ?>
				<li class="search">
					<a href="#"><i class="icon icon-search"></i></a>
					<form action="<?php echo home_url( '/' ); ?>"><input type="text" name="s" /></form>
				</li>
			<?php endif; ?>
			
		</ul>

		<?php if (function_exists('qts_language_menu') ) qts_language_menu('image'); ?>
	</div>

	<div class="clear"></div>
</div><!-- .container -->
</header>


