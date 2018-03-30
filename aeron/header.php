<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) :
	    function theme_slug_render_title() {
			?>
			<title><?php wp_title( ' ', true, 'right' ); ?></title>
			<?php
		}
		add_action( 'wp_head', 'theme_slug_render_title' );
	endif;
?>


<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
global $ABdev_sticky_header;
if ( is_singular() ){
	wp_enqueue_script( "comment-reply" );
}
wp_head();
?>
</head>

<body <?php body_class(); ?>>
<?php echo (get_theme_mod('boxed_body', false)) ? '<div class="boxed_body_wrapper">' : ''; ?>

	<header id="aeron_header" class="<?php echo (!empty($ABdev_sticky_header)) ? 'ABdev_on_sticky_header' : ''; ?><?php echo (get_theme_mod( 'show_announcement_bar', false))? ' with_topbar' : '';?>">

		<?php if(get_theme_mod( 'show_announcement_bar', false)):?>
			<div id="topbar" class="<?php echo (get_theme_mod( 'announcement_bar_menu_position', '') == 'left') ? 'topbar_menu_left' : ''; ?> <?php echo get_theme_mod( 'announcement_bar_style', 'announcement_bar_style_1'); ?>">
				<div class="container">
					<?php echo get_theme_mod( 'announcement_notice', ''); ?>
					<?php if(get_theme_mod( 'show_announcement_menu', false)): ?>
						<?php wp_nav_menu( array( 'container' => false,'menu' => get_theme_mod( 'show_announcement_menu', ''),'menu_id' => 'topbar_menu','menu_class' => '') );?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="container">
			<div class="row">
				<div class="<?php echo (is_page_template('coming-soon.php') || is_page_template('under-maintenance.php')) ? 'span12 coming_soon' : 'span3' ?> logo">
					<a href="<?php echo home_url(); ?>">
						<?php
						$header_logo = get_theme_mod('header_logo', '');
						$header_retina_logo = get_theme_mod('header_retina_logo', '');
						$header_retina_logo_width = get_theme_mod('header_retina_logo_width', '');
						$header_retina_logo_height = get_theme_mod('header_retina_logo_height', '');
						if( $header_logo!='' ):?>
							<img id="main_logo" src="<?php echo $header_logo;?>" alt="<?php bloginfo('name');?>">
						<?php if( $header_retina_logo!='' &&  $header_retina_logo_width!='' && $header_retina_logo_height!='' ):?>
							<?php $pixels ="";
							if(is_numeric($header_retina_logo_width) && is_numeric($header_retina_logo_height)):
							$pixels ="px";
							endif; ?>
							<img id="retina_logo" src="<?php echo $header_retina_logo;?>" alt="<?php bloginfo('name');?>" style="width:<?php echo $header_retina_logo_width.$pixels; ?>;max-height:<?php echo $header_retina_logo_height.$pixels; ?>; height: auto !important;">
						<?php endif; ?>
						<?php else: ?>
							<h1 id="main_logo_textual"><?php bloginfo('name');?></h1>
							<?php $blog_description = get_bloginfo('description');
							if( $blog_description!='' ): ?>
								<h2 id="main_logo_tagline"><?php echo $blog_description;?></h2>
							<?php endif; ?>
						<?php endif; ?>
					</a>
				</div>
				<?php if (!is_page_template('coming-soon.php') && !is_page_template('under-maintenance.php')):?>
					<nav class="span9">
						<?php wp_nav_menu( array( 'theme_location' => 'header-menu','container' => false,'menu_id' => 'main_menu','menu_class' => '','walker'=> new aeron_walker_nav_menu, 'fallback_cb' => false ) );?>
					</nav>
					<i class="ci_icon-menu" id="ABdev_menu_toggle"></i>
			<?php endif; ?>
			</div>
		</div>
	</header>
