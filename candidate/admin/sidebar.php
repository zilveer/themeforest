<?php
/**
 * @package by Theme Record
 * @auther: MattMao
 * @Sidebar
*/




/********************************************
 Theme sidebar
********************************************/
if ( !function_exists( 'candidat_mm_sidebar' ) )
{
	function candidat_mm_sidebar($type, $sidebar_id) 
	{
		//$sidebar_id = get_meta_option('custom_sidebar');


		
		echo '<aside id="sidebar" class="side-widget-area four column">'."\n";
		echo '<div class="inner">';

		if($sidebar_id) 
		{
			if($sidebar_id == 'shop') {
				dynamic_sidebar($sidebar_id); 
			} else {
				dynamic_sidebar('custom-widget-area-'.$sidebar_id);
			}
		}
		else
		{
			dynamic_sidebar($type.'-widget-area'); 
		}

		echo '</div>';
		echo '</aside>'."\n";
	}
}






/********************************************
 Custom sidebar shortcode
********************************************/
if ( !function_exists( 'theme_sidebar_shortcode' ) )
{
	function theme_sidebar_shortcode($atts, $content = null) 
	{
		extract(shortcode_atts(
			array(
            'id' => ''
		), $atts));

		$output = '';
		if($id)
		{
			$output .= '<div class="custom-widget-area">'."\n";
			ob_start();  dynamic_sidebar('custom-widget-area-'.$id); $output .= ob_get_clean();
			$output .= '</div>'."\n";
		}

		return $output;
	}

	add_shortcode('sidebar', 'theme_sidebar_shortcode');
}


?>