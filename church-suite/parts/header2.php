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


<header id="header"  class="horizontal-w <?php
echo $mobile_sticky;
$webnus_options['webnus_header_menu_icon'] = isset( $webnus_options['webnus_header_menu_icon'] ) ? $webnus_options['webnus_header_menu_icon'] : '';
$webnus_options['webnus_header_menu_type'] = isset( $webnus_options['webnus_header_menu_type'] ) ? $webnus_options['webnus_header_menu_type'] : '';
$webnus_options['webnus_header_color_type'] = isset( $webnus_options['webnus_header_color_type'] ) ? $webnus_options['webnus_header_color_type'] : '';
$webnus_options['webnus_slogan'] = isset( $webnus_options['webnus_slogan'] ) ? $webnus_options['webnus_slogan'] : '';
$webnus_options['webnus_header_logo_alignment'] = isset( $webnus_options['webnus_header_logo_alignment'] ) ? $webnus_options['webnus_header_logo_alignment'] : '';
$webnus_options['webnus_header_logo_rightside'] = isset( $webnus_options['webnus_header_logo_rightside'] ) ? $webnus_options['webnus_header_logo_rightside'] : '';
$webnus_options['webnus_header_email'] = isset( $webnus_options['webnus_header_email'] ) ? $webnus_options['webnus_header_email'] : '';
$webnus_options['webnus_header_phone'] = isset( $webnus_options['webnus_header_phone'] ) ? $webnus_options['webnus_header_phone'] : '';

$menu_icon = $webnus_options['webnus_header_menu_icon'];
$menu_type = $webnus_options['webnus_header_menu_type'];
if(!empty($menu_icon)) echo 'sm-rgt-mn ';
if($menu_type==9) echo 'box-menu ';
echo ($hideheader == 'yes')? 'hi-header ' : '';
echo ' '.$webnus_options['webnus_header_color_type']
 ?>">
	<div  class="container">
		<?php if(!$menu_type==0){
			$logo_alignment = $webnus_options['webnus_header_logo_alignment'];
			if( 1 == $logo_alignment ) {
				echo '<div class="col-md-3 logo-wrap">';
			} elseif( 2 == $logo_alignment ) {
				echo '<div class="col-md-3 cntmenu-leftside"></div><div class="col-md-6 logo-wrap center">';
			} elseif( 3 == $logo_alignment ) {
				echo '<div class="col-md-3 logo-wrap right">';
			}
		}
		else {
			echo '<div class="col-md-12 logo-wrap center">';
		}
		?>
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

if(!empty($transparent_logo)) {
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($transparent_logo).'" width="' . $transparent_logo_width . '" id="img-logo-w2" alt="logo" class="img-logo-w2" style="width: '. $transparent_logo_width . '"></a>';
} else {
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:$logo_width). '" id="img-logo-w2" alt="logo" class="img-logo-w2" style="width: ' . (!empty($transparent_logo_width ) ? $transparent_logo_width : $logo_width) . '"></a>';
}

if(!empty($sticky_logo))
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($sticky_logo).'" width="' . $sticky_logo_width . '" id="img-logo-w3" alt="logo" class="img-logo-w3"></a></span>';
else
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:$logo_width). '" id="img-logo-w3" alt="logo" class="img-logo-w3"></a></span>';


}else{ ?>
<h1 id="site-title"><a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>

<span class="site-slog">
<a href="<?php echo esc_url(home_url( '/' )); ?>">
<?php
	$slogan = $webnus_options['webnus_slogan'];
	if( empty($slogan))
		bloginfo( 'description' );
	else
		echo esc_html($slogan);
?>
</a>
</span></h1>
<?php } ?>
		</div></div>
	<?php if(!$menu_type==0){
		switch($logo_alignment){
			case 1:
				echo '<div class="col-md-9 alignright"><hr class="vertical-space" />';
			break;
			case 2:
				echo '<div class="col-md-3 right-side">';
			break;
			case 3:
				echo '<div class="col-md-9 left-side"><hr class="vertical-space" />';
			break;
			default:
			echo '';
		}
			$logo_rightside = $webnus_options['webnus_header_logo_rightside'];
			if( 1 == $logo_rightside ){
			?>
				<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
				<input name="s" type="text" placeholder="<?php esc_html_e('Search...','webnus_framework') ?>" class="header-saerch" >
				</form>
			<?php }
			elseif(2 == $logo_rightside)
			{ ?>
				<h6><i class="fa-envelope-o"></i> <?php echo esc_html($webnus_options['webnus_header_email']); ?></h6>
				<h6><i class="fa-phone"></i> <?php echo esc_html($webnus_options['webnus_header_phone']); ?></h6>
			<?php }
			elseif(3 == $logo_rightside)
			{
				dynamic_sidebar('header-advert');
				if(is_active_sidebar('woocommerce_header'))
				dynamic_sidebar('woocommerce_header');
			}
			?>
		</div>
		<?php } ?>
	</div>
	<?php
	$menu_alignment ='';
	if(!$menu_type==0){
		if($logo_alignment==3 ){
			$menu_alignment='left ';
		}elseif($logo_alignment==2 ){
			$menu_alignment='center ';
		}
	}
	?>
	<hr class="vertical-space" />
	<nav id="nav-wrap" class="nav-wrap2 <?php echo $menu_alignment;
		switch($menu_type){
			case 2:
				echo 'mn4';
				break;
			case 3:
				echo 'mn4 darknavi';
				break;
			case 5:
				echo 'darknavi';
				break;
			default:
				echo '';
		}
	?>">
		<div class="container">
			<?php
			$onepage_menu = '';
			if(is_page()){
				GLOBAL $webnus_page_options_meta;
				$onepage_menu_meta = isset($webnus_page_options_meta)?$webnus_page_options_meta->the_meta():null;
				$onepage_menu =(isset($onepage_menu_meta) && is_array($onepage_menu_meta) && isset($onepage_menu_meta['webnus_page_options'][0]['webnus_onepage_menu']))?$onepage_menu_meta['webnus_page_options'][0]['webnus_onepage_menu']:null;
			}
			$menu_location = '';
				if($webnus_options['webnus_header_menu_type']==0){
					$menu_location = 'header-top-menu';
				}elseif($onepage_menu=='yes'){
						if ( has_nav_menu( 'onepage-header-menu' ) ) {
							$menu_location = 'onepage-header-menu';
						}
				}else{
						$menu_location = 'header-menu';
				}
				if ( has_nav_menu( $menu_location ) ) {
				wp_nav_menu( array( 'theme_location' => $menu_location, 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker() ) );
				}
			?>
		</div>
	</nav>
	<!-- /nav-wrap -->

</header>
<!-- end-header -->