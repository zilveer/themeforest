<?php get_header(); ?>
<?php if (has_nav_menu('category-menu')) {  ?><div id="nav-secondary"><?php if ( function_exists( 'get_option_tree') && is_string(get_option_tree( 'sec_menu_info' )) ) { echo '<div id="sec-info">'.get_option_tree( 'sec_menu_info' ).'</div>'; } ?><?php wp_nav_menu( array( 'theme_location' => 'category-menu','depth'=>'2','menu_class'=>'middle-menu','container_class'=>'middle-menu-container','items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>' ) ); ?><?php if ( ! dynamic_sidebar( 'Menu Social Icons' )) : endif; ?></div><?php } ?>
	<div class="mobilemenu"><?php dropdown_menu( array( 'theme_location' => 'category-menu','depth'=>'2','dropdown_title' => '-- Navigate to --','indent_string' => '- ','indent_after' => '') ); ?></div>
<div id="content">
	<div id="error404" class="post">
	<div class="post-single">
	<div class="post-wrapper">
			<div class="post-header">
				<h1><?php _e('Error 404 - Not Found', 'satori'); ?></h1>
				</div><div class="clearleft"></div><!--.postHeader-->
	<div class="post-content">
		<div id="error-text">
			<h4><?php _e('The page cannot be found!', 'satori'); ?></h4>
			<p><?php _e('You could try the following:', 'satori'); ?></p>
			<ol class="error-list">
			<li><?php _e('Go back to the ', 'satori'); ?><a href="<?php echo home_url(); ?>"><?php _e('homepage.', 'satori'); ?></a></li>
			<li><?php _e('Check your URL in the address bar.', 'satori'); ?></li>
			<li><?php _e('Use the search form below:', 'satori'); ?></li>
			</ol>
			<?php get_search_form(); /* outputs the default Wordpress search form */ ?><div class="clearboth"></div></div>
			<div id="error-archives"><h4><?php _e('Categories', 'satori'); ?></h4><?php wp_list_categories('title_li=&hierarchical=false'); ?></div>
			<div id="error-archives"><h4><?php _e('Archives', 'satori'); ?></h4><?php wp_get_archives('type=monthly&limit=8'); ?></div>
			<div class="clearboth"></div>
		</div><!--.post-content--></div></div>
	</div><!--#error404 .post-->
</div><!--#content-->
<?php get_footer(); ?>