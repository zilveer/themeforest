<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.1
 *
 */

global $mpcth_sidebar_options;

if(isset($GLOBALS['post']->ID))
	$page_id = $GLOBALS['post']->ID;

// check if custom sidebar is turned on and get the sidebar id
if(isset($page_id) && isset($mpcth_sidebar_options['custom_sidebars']) && isset($mpcth_sidebar_options['custom_sidebars']['sidebar'])) {
	if(isset($mpcth_sidebar_options['custom_sidebars']['sidebar']['id_' . $page_id])) {
		$custom_sidebar = true;
		$custom_sidebar_id = 'custom_sidebar_' . $page_id;
	} else {
		$custom_sidebar = false;
	}
} else {
	$custom_sidebar = false;
}

?>
	<aside id="mpcth_sidebar">
		<ul>
			<?php
			if($custom_sidebar && dynamic_sidebar($custom_sidebar_id) ) {
				// displays custom sidebar
			} elseif(dynamic_sidebar('mpcth_main_sidebar') ) {
				// displays regular sidebar when there are no widgets in custom Sidebar
			} else {	
				// display premade widgets when nothing is specified ?>
				<li class="widget"><h2 class="widget_title sidebar_widget_title">Pages</h2>
					<ul>
						<?php wp_list_pages('title_li=' ); ?>
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
	</aside><!-- #mpcth_sidebar -->