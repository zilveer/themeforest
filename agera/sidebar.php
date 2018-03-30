<?php

/**
 * @package WordPress
 * @subpackage Agera
 */

$mp_option = agera_get_global_options();
global $page_id;

if(isset($mp_option['agera_example_portfolio']['portfolio_columns_' .$page_id]))
	$portfolio_column = $mp_option['agera_example_portfolio']['portfolio_columns_' .$page_id];
	
if(isset($mp_option['agera_sidebar_position']['radio_sb_' .$page_id]))
	$sidebar_position = $mp_option['agera_sidebar_position']['radio_sb_' .$page_id];

// check if custom sidebar is turned on and get the sidebar name
if(isset($mp_option['agera_sidebar_position']['sidebar_' .$page_id]))
	$custom_sb = $mp_option['agera_sidebar_position']['sidebar_' .$page_id];
else
	$custom_sb = "off";	

$custom_sb_id = get_the_title($page_id).' Sidebar';
?>

<ul>
	<?php	
	if($custom_sb == 'on' && dynamic_sidebar($custom_sb_id) ) {
		// displays custom sidebar
	} elseif(dynamic_sidebar('Main Sidebar') ) {
		// displays regular sidebar when there are no widgets in custom Sidebar
	} else {	
		// display premate widgets when nothing is specified ?>
		<li class="widget"><h2 class="widget_title sidebar_widget_title">Pages</h2>
			<ul>
				<?php wp_list_pages('title_li=' ); ?>
			</ul>
		</li>
		<li class="widget"><h2 class="widget_title sidebar_widget_title">Archives</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</li>
		<li class="widget"><h2 class="widget_title sidebar_widget_title">Categories</h2>
			<ul>
				<?php wp_list_categories('show_count=1&title_li='); ?>
			</ul>
		</li>	
		<li class="widget"><h2 class="widget_title sidebar_widget_title">Meta</h2>
			<ul>
				<?php wp_register(); ?>
				<li>
					<?php wp_loginout(); ?>
				</li>
				<?php wp_meta(); ?>
			</ul>
		</li>
	<?php
	}?>
</ul>
