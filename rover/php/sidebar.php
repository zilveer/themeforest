<?php
/**
 * @package by Theme Record
 * @auther: MattMao
 */

#
# Theme sidebar
#
if ( !function_exists( 'theme_sidebar' ) )
{
	function theme_sidebar($type) 
	{
		global $tr_config;
		$post_page_id = $tr_config['blog_page_id'];
		$sidebar_id = get_meta_option('custom_sidebar');
		if(is_home() || is_archive()) { $sidebar_id = get_meta_option('custom_sidebar', $post_page_id); }

		echo '<!--Begin Sidebar-->'."\n";
		echo '<aside id="sidebar" class="side-widget-area">'."\n";

		if($sidebar_id) 
		{
			theme_custom_sidebar($sidebar_id);
		}
		else
		{
			theme_side_sidebar($type); 
		}

		echo '</aside>'."\n";
		echo '<!--End Sidebar-->'."\n";
	}
}


#
# Default sidebar
#
if ( !function_exists( 'theme_side_sidebar' ) )
{
	function theme_side_sidebar($type) 
	{
		dynamic_sidebar($type.'-widget-area');
	}
}



#
# Custom sidebar
#
if ( !function_exists( 'theme_custom_sidebar' ) )
{
	function theme_custom_sidebar($id) 
	{
		dynamic_sidebar('custom-widget-area-'.$id);
	}
}


#
# Custom sidebar shortcode
#
if ( !function_exists( 'theme_custom_sidebar_shortcode' ) )
{
	function theme_custom_sidebar_shortcode($atts, $content = null) 
	{
		extract(shortcode_atts(
			array(
            'id' => ''
		), $atts));

		$output = '<div class="custom-widget-area">'."\n";
		ob_start();  theme_custom_sidebar($id); $output .= ob_get_clean();
		$output .= '</div>'."\n";

		return $output;
	}

	add_shortcode('sidebar', 'theme_custom_sidebar_shortcode');
}

 ?>