<?php
$hideheader = '';
$webnus_options = webnus_options();
if( is_page())
{
GLOBAL $webnus_page_options_meta;
@$hideheader_meta = (isset($webnus_page_options_meta))?$webnus_page_options_meta->the_meta():null;
$hideheader =(isset($hideheader_meta) && is_array($hideheader_meta) && isset($hideheader_meta['webnus_page_options'][0]['maxone_hideheader']))?$hideheader_meta['webnus_page_options'][0]['maxone_hideheader']:null;
}
$mobile_sticky = isset( $webnus_options['webnus_header_sticky_phone'] ) && $webnus_options['webnus_header_sticky_phone'] == '1' ? ' mobistky ' : '' ;
?>


<header id="header"  class="duplex-hd horizontal-w <?php
echo $mobile_sticky;
$webnus_options['webnus_header_menu_icon'] = isset( $webnus_options['webnus_header_menu_icon'] ) ? $webnus_options['webnus_header_menu_icon'] : '';
$webnus_options['webnus_header_color_type'] = isset( $webnus_options['webnus_header_color_type'] ) ? $webnus_options['webnus_header_color_type'] : '';
$webnus_options['webnus_slogan'] = isset( $webnus_options['webnus_slogan'] ) ? $webnus_options['webnus_slogan'] : '';


$menu_icon = $webnus_options['webnus_header_menu_icon'];
if(!empty($menu_icon)) echo ' sm-rgt-mn ';
echo ($hideheader == 'yes')? ' hi-header ' : '';
echo ' '.$webnus_options['webnus_header_color_type']
 ?>">
	<div class="container">
		<nav class="nav-wrap1 col-md-4 duplex-menu dm-left">
			<div class="container">
				<?php
					if ( has_nav_menu( 'duplex-menu-left' ) ) {
						wp_nav_menu( array( 'theme_location' => 'duplex-menu-left', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul class="duplex-menu" id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker() ) );}
				?>
			</div>
		</nav>
	<div class="col-md-4 logo-wrap center">
			<div class="logo">
<?php
$logo 					= isset( $webnus_options['webnus_logo']['url'] ) ? $webnus_options['webnus_logo']['url'] : '';
$logo_width 			= isset( $webnus_options['webnus_logo_width'] ) ? $webnus_options['webnus_logo_width'] . 'px' : '';
$transparent_logo 		= isset( $webnus_options['webnus_transparent_logo']['url'] ) ? $webnus_options['webnus_transparent_logo']['url'] : '';
$transparent_logo_width = isset( $webnus_options['webnus_transparent_logo_width'] ) ? $webnus_options['webnus_transparent_logo_width'] . 'px' : '150px';
$sticky_logo 			= isset( $webnus_options['webnus_sticky_logo']['url'] ) ? $webnus_options['webnus_sticky_logo']['url'] : '';
$sticky_logo_width 		= isset( $webnus_options['webnus_sticky_logo_width'] ) ? $webnus_options['webnus_sticky_logo_width'] . 'px' : '150px';
$has_logo				= false; /* Check if there is one logo exists at least. */

if( !empty($logo) || !empty($transparent_logo) || !empty($sticky_logo) ) $has_logo = true;
if((TRUE === $has_logo))
{

if(!empty($logo))
echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="' . $logo_width . '" id="img-logo-w1" alt="logo" class="img-logo-w1" style="width: ' . $logo_width . '"></a>';

if(!empty($transparent_logo))
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($transparent_logo).'" width="' . $transparent_logo_width . '" id="img-logo-w2" alt="logo" class="img-logo-w2" style="width: '. $transparent_logo_width . '"></a>';
else
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:$logo_width). '" id="img-logo-w2" alt="logo" class="img-logo-w2" style="width: ' . (!empty($transparent_logo_width ) ? $transparent_logo_width : $logo_width) . '"></a>';

if(!empty($sticky_logo))
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($sticky_logo).'" width="' . $sticky_logo_width . '" id="img-logo-w3" alt="logo" class="img-logo-w3"></a></span>';
else
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:$logo_width). '" id="img-logo-w3" alt="logo" class="img-logo-w3"></a></span>';

}else{ ?>
<h1 id="site-title"><a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>
<span class="site-slog"><a href="<?php echo esc_url(home_url( '/' )); ?>">
<?php
	$slogan = $webnus_options['webnus_slogan'];
	if( empty($slogan))
		bloginfo( 'description' );
	else
		echo esc_html($slogan);
?>
</a></span></h1>
<?php } ?>
		</div></div>

	<nav class="nav-wrap1 col-md-4 duplex-menu dm-right">
		<div class="container">
			<?php
				if ( has_nav_menu( 'duplex-menu-right' ) ) {
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-right', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul class="duplex-menu" id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker() ) );}
			?>
		</div>
	</nav>
	<!-- /nav-wrap -->

	<nav id="nav-wrap" class="full-menu-duplex">
		<div class="container">
		<ul id="nav" class="main-menu"><?php
				if ( has_nav_menu( 'duplex-menu-left' ) ) {
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-left', 'container' => 'false', 'depth' => '5', 'items_wrap' => '%3$s', 'fallback_cb' => 'wp_page_menu', 'walker' => new webnus_description_walker() ) );}
				if ( has_nav_menu( 'duplex-menu-right' ) ) {
					wp_nav_menu( array( 'theme_location' => 'duplex-menu-right', 'container' => 'false', 'depth' => '5', 'items_wrap' => '%3$s', 'fallback_cb' => 'wp_page_menu', 'walker' => new webnus_description_walker() ) );}
			?></ul>
		</div>
	</nav>
</div>
</header>

<!-- end-header -->