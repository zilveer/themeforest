<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta content='IE=edge' http-equiv='X-UA-Compatible'/>
<title><?php if ( is_category() ) {
	echo __('Category Archive for', 'satori').' &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
} elseif ( is_tag() ) {
	echo __('Tag Archive for', 'satori').' &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
} elseif ( is_archive() ) {
	wp_title(''); echo ' '.__('Archive', 'satori').' | '; bloginfo( 'name' );
} elseif ( is_search() ) {
	echo __('Search for', 'satori').' &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
} elseif ( is_home() ) {
	bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
}  elseif ( is_404() ) {
	echo __('Error 404 Not Found', 'satori').' | '; bloginfo( 'name' );
} elseif ( is_single() ) {
	wp_title('');
} else {
	wp_title(' | ', 1, 'right'); bloginfo( 'name' );
} ?></title>
	
<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<meta name="viewport" content="width=device-width, initial-scale=1"/><?php /* Add "maximum-scale=1" to fix the Mobile Safari auto-zoom bug on orientation changes, but keep in mind that it will disable user-zooming completely. Bad for accessibility. */ ?>

<link rel="shortcut icon" href="<?php if ( function_exists( 'get_option_tree' ) ) { if (is_string(get_option_tree( 'favicon' )))  { echo get_option_tree( 'favicon' ); } else { echo get_stylesheet_directory_uri().'/images/favicon.png'; } } ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />	

<?php if ( is_singular() && get_option( 'thread_comments' ) )  wp_enqueue_script( 'comment-reply' );  ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_reset_query(); ?>
<div id="page-background"><?php if ( function_exists( 'get_option_tree' ) ) { if (get_option_tree( 'background' ) == "Stretched image" && is_string(get_option_tree( 'background_image' )))  { echo '<img src="'.get_option_tree( 'background_image' ).'" width="100%" height="100%"  />'; }} ?></div>
<div class="none">
	<p><a href="#content"><?php _e('Skip to Content', 'satori'); ?></a></p><?php /* used for accessibility, particularly for screen reader applications */ ?>
</div><!--.none-->
<div id="main"><!-- this encompasses the entire Web site -->
	<div id="top-line"></div>
	<header><div id="header">
		<div id="header-inner">
			<div id="logo-wrap">
				<div id="logo">
					<a href="<?php echo home_url(); ?>"></a>
					<?php if (has_nav_menu('main-menu')) { ?><div id="menu-label"><?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree('sec_menu_label'))) { echo get_option_tree('sec_menu_label'); } else { echo 'Show Menu'; } ?></div><?php } ?>
				</div><!--#logo-->
			</div>
			<?php if (has_nav_menu('main-menu')) {  ?><div id="nav-primary" class="nav"><nav>
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu','depth'=>'2','menu_class'=>'main-menu','container_class'=>'main-menu-container','items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>','fallback_cb' => 'false' ) ); ?>
			</nav></div><!--#nav-primary-->
			<?php } ?>
		<div class="container">
			<?php if (has_nav_menu('main-menu')) { ?><div class="mobilemenu"><?php dropdown_menu( array( 'theme_location' => 'main-menu','depth'=>'2','dropdown_title' => '-- Top Menu --','indent_string' => '- ','indent_after' => '') ); ?></div><?php } ?>
			<div class="clear"></div>
		</div><!--.container-->
		</div>
	</div></header><!--#header-->
	<div id="main-body" class="container">