<?php
/**
 * Template part for displaying Default theme header.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
 */

?>

<?php
$header_soc_buttons = cs_get_customize_option( 'show_soc_networks' );
$search_field       = cs_get_customize_option( 'show_search' );
$sliding_sidebar    = cs_get_customize_option( 'show_sliding_sidebar' );
$menu_position      = cs_get_customize_option( 'menu_position' );
$disble_preloader   = cs_get_customize_option( 'disable_preloader' ) ? cs_get_customize_option( 'disable_preloader' ) : false;


$page_meta = get_post_meta( get_the_ID(), 'custom_sidebar_options', true );
if ( isset( $page_meta['meta-menu-position'] ) && ! ( empty( $page_meta['meta-menu-position'] ) ) && ! ( 'default' === $page_meta['meta-menu-position'] ) ) {
	$menu_position = $page_meta['meta-menu-position'];
}

if ( 'menu-vertical' === $menu_position ) {
	$menu_align_class = '';
} else {
	if ( isset( $page_meta['header_transparent'] ) && ( true === $page_meta['header_transparent'] ) ) {
		$menu_align_class = '';
	} else {
		$menu_align_class = 'act default-act';
	}
}

$custom_header = get_custom_header();
if ( isset( $custom_header->url ) && ! ( empty( $custom_header->url ) ) ) {
	$custom_header_style = 'style="';
	$custom_header_style .= 'background-image:url(' . esc_url( $custom_header->url ) . ');';
	$custom_header_style .= '"';
} else {
	$custom_header_style = '';
}

if ( isset( $page_meta['menu_stick_to_bottom'] ) && true === $page_meta['menu_stick_to_bottom'] ) {
	$menu_placement_class = 'bottom-fixed-control-class bottom-fixed ';
} else {
	$menu_placement_class = '';
}
$logo_retina_style = $sticky_logo_retina_style = $preloader_logo_retina_style = '';

$header_logo            = cs_get_customize_option( 'header_logo' );
$sticky_header_logo     = cs_get_customize_option( 'sticky_header_logo' );
$custom_preloader_image = cs_get_customize_option( 'custom_preloader_logo' );

$logo_retina = cs_get_customize_option( 'header_logo_retina' );
if ( true === $logo_retina && isset( $header_logo ) && ! empty( $header_logo ) ) {
	$logo_retina_style = omni_build_retina_style( $header_logo );
}
$sticky_logo_retina = cs_get_customize_option( 'sticky_header_logo_retina' );
if ( true === $sticky_logo_retina && isset( $sticky_header_logo ) && ! empty( $sticky_header_logo ) ) {
	$sticky_logo_retina_style = omni_build_retina_style( $sticky_header_logo );
}
$preloader_logo_retina = cs_get_customize_option( 'custom_preloader_logo_retina' );
if ( true === $preloader_logo_retina && isset( $custom_preloader_image ) && ! empty( $custom_preloader_image ) ) {
	$preloader_logo_retina_style = omni_build_retina_style( $custom_preloader_image );
}
?>


<!-- HEADER -->

<header class="<?php echo esc_attr( $menu_align_class ) . ' ' . esc_attr( $menu_placement_class ); ?> " id="header">
<div class="header-content__wrap">

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="logo">
		<img src="<?php echo esc_url( cs_get_customize_option( 'header_logo' ) ) ? esc_url( cs_get_customize_option( 'header_logo' ) ) : esc_url( get_template_directory_uri() . '/img/theme-1/logo.png' ); ?>"
		     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>" <?php echo $logo_retina_style; ?>>
		<img class="act" src="<?php echo esc_url( cs_get_customize_option( 'sticky_header_logo' ) ) ? esc_url( cs_get_customize_option( 'sticky_header_logo' ) ) : esc_url( get_template_directory_uri() . '/img/theme-1/logo-act.png' ); ?>"
		     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>" <?php echo $sticky_logo_retina_style; ?>>
	</a>

	<div class="mob-icon">
		<span></span>
	</div>
	<?php
	$show_search = cs_get_customize_option( 'enable_search_button' );?>
	<nav id="nav">
		<?php if ( true === $show_search ) { ?>

			<ul class="menu-search">
				<li>
					<div class="open-search "><i class="fa fa-search"></i></div>
					<div class="screen-search-popup">

						<div class="close-layer"></div>

                        <div class="form-wrap">
                            <?php echo '<h2 class="menu-search-heading">' . esc_html__( 'Enter search request and press Enter', 'omni' ) . '</h2>'; ?>
	                        <?php get_search_form(); ?>
                        </div>

						<div class="close-popup"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span>
						</div>

					</div>
				</li>
			</ul>


		<?php } ?>

		<?php crum_main_menu(); ?>

	</nav>
	</div>
</header>


<?php
if ( true !== $disble_preloader ) {
	?>
	<!-- LOADER -->
	<div id="loader-wrapper">
		<?php if ( isset( $custom_preloader_image ) && ! empty( $custom_preloader_image ) ) { ?>
			<img src="<?php echo esc_url( $custom_preloader_image ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>" <?php echo $preloader_logo_retina_style; ?>>
		<?php } else { ?>
			<img src="<?php echo esc_url( cs_get_customize_option( 'header_logo' ) ) ? esc_url( cs_get_customize_option( 'header_logo' ) ) : esc_url( get_template_directory_uri() . '/img/theme-1/logo.png' ); ?>"
			     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>" <?php echo $logo_retina_style; ?>>
		<?php } ?>
		<span></span>
	</div>
<?php } ?>

<div id="content-wrapper">

	<div class="blocks-container">