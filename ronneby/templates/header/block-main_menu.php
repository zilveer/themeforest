<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
$menu_class = '';
if(isset($dfd_ronneby['enable_menu_titles_delimiter']) && strcmp($dfd_ronneby['enable_menu_titles_delimiter'], 'off') === 0) {
	$menu_class .= 'dfd-disable-menu-delimiters';
}
if(isset($dfd_ronneby['enable_menu_line_animated']) && strcmp($dfd_ronneby['enable_menu_line_animated'], 'off') === 0) {
	$menu_class .= ' dfd-disable-menu-line-animated';
}
if(isset($dfd_ronneby['menu_alignment']) && !empty($dfd_ronneby['menu_alignment'])) {
	$menu_class .= ' '.$dfd_ronneby['menu_alignment'];
} else {
	$menu_class .= ' text-left';
}
?>
<nav class="mega-menu clearfix <?php echo esc_attr($menu_class); ?>" id="main_mega_menu">
	<?php
		wp_nav_menu(array(
			'theme_location' => 'primary_navigation', 
			'menu_class' => 'nav-menu menu-primary-navigation menu-clonable-for-mobiles', 
			'fallback_cb' => 'top_menu_fallback'
		));
	?>
	<i class="carousel-nav prev dfd-icon-left_2"></i>
	<i class="carousel-nav next dfd-icon-right_2"></i>
</nav>
