<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 03/12/15
 * Time: 4:00 PM
 */
global $ft_option, $fave_container;
$sticky_nav = isset( $ft_option['desktop_sticky_nav'] ) ? $ft_option['desktop_sticky_nav'] : 0;
$menu_skin = $ft_option['header_6_skin'];
$menu_pos = $ft_option['header_6_menu_position'];
$logo_pos = $ft_option['header_6_logo_position'];

if( $logo_pos == 'center_align' ) {
	$css_class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
	$text_align = 'text-center';
} else {
	$css_class = 'col-xs-4 col-sm-12 col-md-4 col-lg-4';
	$text_align = 'text-left';
}

?>

<div class="header-6 hidden-xs hidden-sm" itemscope itemtype="http://schema.org/WPHeader">
	<?php if( $ft_option['site_top_strip'] != 0 ) { ?>
		<?php get_template_part('inc/header/header-top-menu'); ?>
	<?php } ?>
	<!-- header 1 -->
	<div class="<?php echo $fave_container; ?>">
		<div class="row">
			<div class="<?php echo $css_class; ?>">
				<div class="logo-wrap <?php echo $text_align; ?>">
					<?php get_template_part('inc/header/logo'); ?>
				</div>
			</div>
			<?php if( $logo_pos != 'center_align' ): ?>
			<div class="col-xs-8 col-sm-12 col-md-8 col-lg-8">
				<?php if( !empty( $ft_option['header_ads_right_728_90'] ) ): ?>
					<div class="banner-right"><?php echo $ft_option['header_ads_right_728_90']; ?></div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="<?php echo esc_attr( $fave_container ); ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<nav class="magazilla-main-nav <?php echo $menu_skin.' '.$menu_pos; ?> navbar yamm navbar-header-6" data-sticky="<?php echo $sticky_nav; ?>" >
					<div class="sticky_inner">
						<?php
						// Pages Menu
						if ( has_nav_menu( 'main-menu' ) ) :
							wp_nav_menu( array (
								'theme_location' => 'main-menu',
								'container' => '',
								'container_class' => '',
								'menu_class' => 'nav navbar-nav',
								'menu_id' => 'main-nav',
								'depth' => 4,
								'walker' => new favethemes_Walker()
							));
						endif;
						?>

						<?php if( $ft_option['header_search'] != 0 ){ ?>
							<?php get_template_part('inc/header/search', 'form' ); ?>
						<?php } ?>
					</div>
				</nav><!-- navbar -->
			</div>
		</div>
	</div>

</div><!-- header-6 -->