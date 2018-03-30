<?php
$webnus_options = webnus_options();
$webnus_options['webnus_header_menu_type'] = isset( $webnus_options['webnus_header_menu_type'] ) ? $webnus_options['webnus_header_menu_type'] : '';
$mobile_sticky = isset( $webnus_options['webnus_header_sticky_phone'] ) && $webnus_options['webnus_header_sticky_phone'] == '1' ? ' mobistky ' : '' ;
<div id="vertical-header-wrapper"  style="<?php echo (7 == $webnus_options['webnus_header_menu_type'])? 'left : -250px;' : ''; ?>">

<?php if (7 == $webnus_options['webnus_header_menu_type']) { ?>
	<div id="toggle-icon">
		<span class="mn-ext1"></span>
		<span class="mn-ext2"></span>
		<span class="mn-ext3"></span>
	</div>
<?php }
	$header_background = isset($webnus_options['webnus_header_background']['url']) ? 'style="background-size:cover; background-image: url(\''.$webnus_options['webnus_header_background']['url'].'\')"' : '';
	$webnus_options['webnus_header_menu_icon'] = isset( $webnus_options['webnus_header_menu_icon'] ) ? $webnus_options['webnus_header_menu_icon'] : '';
	$menu_icon = ($webnus_options['webnus_header_menu_icon'])? 'sm-rgt-mn ':'';
?>
	<header id="header" <?php echo $header_background; ?> class="vertical-w <?php echo $mobile_sticky . $menu_icon ;?>">
	<div class="container vheader-container">
	<div class="col-md-3 col-sm-3 logo-wrap">
	<div class="logo">
	<?php
	$logo 		= isset( $webnus_options['webnus_logo']['url'] ) ? $webnus_options['webnus_logo']['url'] : '';
	$logo_width = isset( $webnus_options['webnus_logo_width'] ) ? $webnus_options['webnus_logo_width'] . 'px' : '150px';
	$has_logo	= false; /* Check if there is one logo exists at least. */

	if( !empty($logo) ) $has_logo = true;
	if((TRUE === $has_logo)){
	if(!empty($logo))
		echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="' . $logo_width . '" id="img-logo-w1" alt="logo" class="img-logo-w1" style="width: ' . $logo_width . '"></a>';
	}else{ ?>
	<h1 id="site-title"><a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>
	<span class="site-slog">
	<a href="<?php echo esc_url(home_url( '/' )); ?>">
	<?php
	$webnus_options['webnus_slogan'] = isset( $webnus_options['webnus_slogan'] ) ? $webnus_options['webnus_slogan'] : '';
		$slogan = $webnus_options['webnus_slogan'];
		if( empty($slogan))
			bloginfo( 'description' );
		else
			echo esc_html($slogan);
	?>
	</a></span>
	</h1>
	<?php } ?></div></div>
	<nav id="nav-wrap" class="col-md-9 col-sm-9 nav-wrap3">
		<div class="container">
			<?php // OnePage Menu
			$onepage_menu = '';
			if(is_page()){
				GLOBAL $webnus_page_options_meta;
				$onepage_menu_meta = isset($webnus_page_options_meta)?$webnus_page_options_meta->the_meta():null;
				$onepage_menu =(isset($onepage_menu_meta) && is_array($onepage_menu_meta) && isset($onepage_menu_meta['webnus_page_options'][0]['webnus_onepage_menu']))?$onepage_menu_meta['webnus_page_options'][0]['webnus_onepage_menu']:null;
			}

				if($onepage_menu=='yes'){
					if ( has_nav_menu( 'onepage-header-menu' ) ) {
						wp_nav_menu( array( 'theme_location' => 'onepage-header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker()) );
					}
				}else{
					if ( has_nav_menu( 'header-menu' ) )
					{
						wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker()) );
					}
				}
			?>
		</div>
	</nav>
	<!-- /nav-wrap -->

	<?php
	$webnus_options['webnus_header_search_enable'] = isset( $webnus_options['webnus_header_search_enable'] ) ? $webnus_options['webnus_header_search_enable'] : '';
	if($webnus_options['webnus_header_search_enable']) {
	?>
	<div id="search-form">
		<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
			<input type="text" class="search-text-box" id="search-box" name="s">
		</form>
	</div>
	<?php } ?>
	<!-- /search -->
	</div>
	</header>
</div>
<!-- end-header -->
