<?php

	/* ---------------------------------------------------------------------------
	 * Create new post type for managing layouts
	 * --------------------------------------------------------------------------- */
	function zn_pb_templates_manager(){

		$labels = array(
			'name' 					=> __('Page Builder Smart Areas','zn_framework'),
			'singular_name' 		=> __('Page Builder Smart Area','zn_framework'),
			'add_new'				=> __('Add New','zn_framework'),
			'add_new_item' 			=> __('Add New Page Builder Smart Area','zn_framework'),
			'edit_item' 			=> __('Edit Page Builder Smart Area','zn_framework'),
			'new_item' 				=> __('New Page Builder Smart Area','zn_framework'),
			'view_item' 			=> __('View Page Builder Smart Area','zn_framework'),
			'search_items' 			=> __('Search Page Builder Smart Areas','zn_framework'),
			'not_found' 			=> __('No Page Builder Smart Areas found','zn_framework'),
			'not_found_in_trash'	=> __('No Page Builder Smart Areas found in Trash','zn_framework'),
			'parent_item_colon' 	=> '',
		);

		$icon = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA4NSA3NSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgODUgNzUiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxnPjxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBmaWxsPSIjRkZGRkZGIiBkPSJNODAsMEg1QzIuMiwwLDAsMi4yLDAsNXY2NWMwLDIuOCwyLjIsNSw1LDVoNzVjMi44LDAsNS0yLjIsNS01VjVDODUsMi4yLDgyLjgsMCw4MCwweiBNMTAsNDVsNSwwdjVsLTUsMFY0NXogTTEwLDY1VjU1bDUsMHY1aDQuOWwwLjEsNUgxMHogTTIwLDM1aC01djVsLTUsMFYzMGgxMFYzNXogTTI1LDY1di01aDVsMCw1SDI1eiBNMjUsMzBjMCwwLDEuNSwwLDUsMGwwLDVjLTMuNiwwLTUsMC01LDBMMjUsMzB6IE00MCw2NWgtNXYtNWg1VjY1eiBNMzUsMzVsMC01aDVsMCw1SDM1eiBNNTAsNjVoLTV2LTVoNVY2NXogTTUwLDQ5aC02djZoLTN2LTZoLTZ2LTNoNnYtNmgzdjZoNlY0OXogTTQ1LDM1di01aDQuOWwwLDVINDV6IE02MCw2NWgtNXYtNWg1VjY1eiBNNTUsMzV2LTVoNC45bDAsNUg1NXogTTc1LDY1SDY1di01aDV2LTVsNSwwVjY1eiBNNzUsNDkuOUw3MCw1MFY0NWg1VjQ5Ljl6IE03NSw0MGgtNXYtNWgtNWwwLTVoMTBWNDB6IE03NSwyM0gxMFYxMGg2NVYyM3oiLz48L2c+PC9nPjwvc3ZnPg==";

		$args = array(
			'labels' 				=> $labels,
			'menu_icon'				=> $icon,
			'public' 				=> false,
			'publicly_queryable'	=> true,
			'show_ui' 				=> true,
			'query_var' 			=> true,
			'capability_type' 		=> 'post',
			'hierarchical' 			=> false,
			'menu_position' 		=> 106,
			'supports' 				=> array( 'title' ),
			'show_in_menu'=> true
		);

		register_post_type( 'znpb_template_mngr', $args );

	}
	add_action( 'init', 		'zn_pb_templates_manager', 99 );

	function zn_pb_override_template( $template ){
		$post_type = get_post_type();
		if( $post_type === 'znpb_template_mngr' ){
			do_action( 'znpb:templates:edit' );
		}

		return $template;
	}
	add_action( 'wp' , 'zn_pb_override_template' );

	function zn_pbsmartareas_infonotice(){
		$screen = get_current_screen();
		// print_z($screen);
		if($screen->id == 'edit-znpb_template_mngr'){

			?>
			<div class="notice notice-info is-dismissible">
		        <p><?php
		        	echo sprintf( __('Page builder Smart Areas are predefined blocks of page builder elements you can insert in your website\'s pages, globally or per page. <a href="%s" target="_blank">Read more</a>.' , 'zn_framework'), esc_url( 'http://support.hogash.com/documentation/page-builder-smart-areas/' ) );
	        	?></p>
		    </div>
			<?php
		}
	}
	add_action('admin_notices', 'zn_pbsmartareas_infonotice');