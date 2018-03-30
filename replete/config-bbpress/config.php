<?php


function avia_bbpress_enabled()
{
	if (class_exists( 'bbPress' )) { return true; }
	return false;
}

//check if the plugin is enabled, otherwise stop the script
if(!avia_bbpress_enabled()) { return false; }


global $avia_config;


//register my own styles
if(!is_admin()){ add_action('bbp_enqueue_scripts', 'avia_bbpress_register_assets',15); }


function avia_bbpress_register_assets()
{
	global $bbp;

	if(empty($bbp))
	{
		$bb  = bbpress();
		$bbpV = $bb->__get('version');
	}
	else
	{
		$bbpV = 2.0;
		if(isset($bbp->version)) $bbpV = $bbp->version;
	}

	//bbp_theme_compat_enqueue_css	
	if (version_compare($bbpV, '2.1') >= 0)
	{
		wp_dequeue_style( 'bbp-default-bbpress' );
		wp_enqueue_style( 'avia-bbpress', AVIA_BASE_URL.'config-bbpress/bbpress-mod-21.css');
	}
	else
	{
		wp_dequeue_style( 'bbpress-style' );
		wp_enqueue_style( 'avia-bbpress', AVIA_BASE_URL.'config-bbpress/bbpress-mod.css');
	}


}




//remove forum and single topic summaries at the top of the page
add_filter('bbp_get_single_forum_description', 'avia_bbpress_filter_form_message',10,2 );
add_filter('bbp_get_single_topic_description', 'avia_bbpress_filter_form_message',10,2 );



add_filter('avia_style_filter', 'avia_bbpress_forum_colors');
/* add some color modifications to the forum table items */
function avia_bbpress_forum_colors($config)
{
	
	return $config;
}


function avia_bbpress_filter_form_message( $retstr, $args )
{
	//removes forum summary, voices count etc
	return false;
}



/*modify default breadcrumb to work better with bb forums*/

if(!function_exists('avia_bbpress_breadcrumb'))
{
	//fetch bb trail and set the bb breadcrum output to false
	function avia_fetch_bb_trail($trail, $breadcrumbs, $r)
	{
		global $avia_config;
		$avia_config['bbpress_trail'] = $breadcrumbs;
		
		return false;
	}
	
	add_filter('bbp_get_breadcrumb','avia_fetch_bb_trail',10,3);
}

if(!function_exists('avia_bbpress_breadcrumb'))
{
	//if we are viewing a forum page set the avia breadcrumb output to match the forum breadcrumb output
	function avia_bbpress_breadcrumb($trail)
	{ 
		global $avia_config;
	
		if((isset($avia_config['currently_viewing']) && $avia_config['currently_viewing'] == 'forum') || get_post_type() === "forum" || get_post_type() === "topic")
		{
			$bc = bbp_get_breadcrumb();
			
			if(isset($avia_config['bbpress_trail'] )) $trail = $avia_config['bbpress_trail'] ;
			
			if((bbp_is_single_user_edit() || bbp_is_single_user()))
			{
				$user_info = get_userdata(bbp_get_displayed_user_id());
				$title = __("Profile for User:","avia_framework")." ".$user_info->display_name;
				array_pop($trail);
				$trail[] = $title;
			}
		}			
		return $trail;
	}
	
	
	add_filter('avia_breadcrumbs_trail','avia_bbpress_breadcrumb');
}




	register_sidebar(array(
		'name' => 'Forum',
		'before_widget' => '<div id="%1$s" class="widget %2$s">', 
		'after_widget' => '<span class="seperator extralight-border"></span></div>', 
		'before_title' => '<h3 class="widgettitle">', 
		'after_title' => '</h3>', 
		'id'	=> 	"forum-sidebar-1"
	));
	
	
	add_filter('bbp_view_widget_title', 'avia_widget_title');
	add_filter('bbp_login_widget_title', 'avia_widget_title');
	add_filter('bbp_forum_widget_title', 'avia_widget_title');
	add_filter('bbp_topic_widget_title', 'avia_widget_title');
	add_filter('bbp_replies_widget_title', 'avia_widget_title');


