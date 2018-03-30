<?php 
add_filter('wp_title', 'vp_filter_wp_title', 9, 3);
function vp_filter_wp_title( $old_title, $sep, $sep_location ) {
	if (is_home() ) {
		return get_bloginfo('name');
	}
}

//This function shows the top menu if the user didn't create the menu in Appearance -> Menus.
if( !function_exists( 'show_top_menu') )
{
	function show_top_menu() {
		global $tharsis;
		echo '<ul>';
		if(isset($tharsis['pages_topmenu']) && $tharsis['pages_topmenu'] != '' )
			$pages = get_pages( array('include' => $tharsis['pages_topmenu'], 'sort_column' => 'menu_order', 'sort_order' => 'ASC') );
		else
			$pages = get_pages('number=4&sort_column=menu_order&sort_order=ASC');
		$count = count($pages);
		echo '<li><a href="' . get_home_url() . '/#intro">Home</a>';
		for($i = 0; $i < $count; $i++)
		{
			echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
		}
		if(isset($tharsis['blog_page']) && $tharsis['blog_page'] != '')
			echo '<li><a href="' . get_permalink($tharsis['blog_page'][0]) . '">Blog</a></li>';
		echo '<li><a href="' . get_home_url() . '/#contact-layout">Contact</a></li>';
		echo '</ul>';
	}
}

add_action('wp_head', 'vp_customization');
//This function handles the Colorization tab of the theme options
if(! function_exists('vp_customization'))
{
	function vp_customization() {
		//favicon
		global $tharsis;

		//Loading the google web fonts on the page.
		$loaded[] = 'Open+Sans';
		if(!in_array($tharsis['pagetitle_font'], $loaded))
		{
			echo '<link id="' . $tharsis['pagetitle_font'] . '" href="http://fonts.googleapis.com/css?family=' . $tharsis['pagetitle_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $tharsis['pagetitle_font'];
		}

		if(!in_array($tharsis['headline_font'], $loaded))
		{
			echo '<link id="' . $tharsis['headline_font'] . '" href="http://fonts.googleapis.com/css?family=' . $tharsis['headline_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $tharsis['headline_font'];
		}

		if(!in_array($tharsis['h3_font'], $loaded))
		{
			echo '<link id="' . $tharsis['h3_font'] . '" href="http://fonts.googleapis.com/css?family=' . $tharsis['h3_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $tharsis['h3_font'];
		}

		if(!in_array($tharsis['h4_font'], $loaded))
		{
			echo '<link id="' . $tharsis['h4_font'] . '" href="http://fonts.googleapis.com/css?family=' . $tharsis['h4_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $tharsis['h4_font'];
		}

		if(!in_array($tharsis['testimonial_font'], $loaded))
		{
			echo '<link id="' . $tharsis['testimonial_font'] . '" href="http://fonts.googleapis.com/css?family=' . $tharsis['testimonial_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;	
			$loaded[] = $tharsis['testimonial_font'];
		}

		if(!in_array($tharsis['footer_font'], $loaded))
		{
			echo '<link id="' . $tharsis['footer_font'] . '" href="http://fonts.googleapis.com/css?family=' . $tharsis['footer_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $tharsis['footer_font'];
		}	

		if($tharsis['favicon'] != '')
			echo '<link rel="shortcut icon" href="' . $tharsis['favicon'] . '" />';
		//add custom CSS as per the theme options only if custom colorization was enabled.
		if($tharsis['enable_colorization'] == 1)
		{
			$loaded = array();
			echo "\n<style type='text/css'> \n";
			if($tharsis['bg_image'] != '')
			{ 
				echo "#intro { background-image: url('" . $tharsis['bg_image'] . "'); } \n";
			}
			if($tharsis['separator_bg'] != '')
			{ 
				echo ".separator { background-image: url('" . $tharsis['separator_bg'] . "'); } \n";
			}
			if($tharsis['bg_color'] != '') 
			{
				echo "#intro { background-image: none; background-color: " . $tharsis['bg_color'] . "; } \n";
			}
			echo '
			p, body { font-size: ' . $tharsis['body_size'] . 'px; color: ' . $tharsis['body_color'] . '; font-family: \'' . str_replace('+', ' ', $tharsis['body_font']) . '\',sans-serif; }
			h1 { font-size: ' . $tharsis['top_headertext_size'] . 'px; color: ' . $tharsis['top_headertext_color'] . '; }
			h1.small { font-size: ' . $tharsis['top_smalltext_size'] . 'px; color: ' . $tharsis['top_smalltext_color'] . '; }
			.title p { font-size: ' . $tharsis['top_smallertext_size'] . 'px; color: ' . $tharsis['top_smallertext_color'] . '; }
			nav a { font-size: ' . $tharsis['nav_size'] . 'px; color: ' . $tharsis['nav_color'] . ' !important; }
			nav a:hover { color: ' . $tharsis['nav_hovercolor'] . ' !important; }
			p.logo { font-size: ' . $tharsis['logo_size'] . 'px; color: ' . $tharsis['logo_color'] . '; }
			h2 { font-size: ' . $tharsis['pagetitle_size'] . 'px; color: ' . $tharsis['pagetitle_color'] . '; font-family: \'' . str_replace('+', ' ', $tharsis['pagetitle_font']) . '\',sans-serif; }
			.headline p { font-size: ' . $tharsis['headline_size'] . 'px; color: ' . $tharsis['headline_color'] . '; font-family: \'' . str_replace('+', ' ', $tharsis['headline_font']) . '\',sans-serif; }
			h3 { font-size: ' . $tharsis['h3_size'] . 'px; font-family: \'' . str_replace('+', ' ', $tharsis['h3_font']) . '\',sans-serif; }
			h4 { font-size: ' . $tharsis['h4_size'] . 'px; font-family: \'' . str_replace('+', ' ', $tharsis['h4_font']) . '\',sans-serif; }
			.testimonials p { font-size: ' . $tharsis['testimonial_size'] . 'px !important; color: ' . $tharsis['testimonial_color'] . ' !important; font-family: \'' . str_replace('+', ' ', $tharsis['testimonial_font']) . '\',sans-serif !important; }
			.separator p { font-size: ' . $tharsis['separator_size'] . 'px !important; color: ' . $tharsis['separator_color'] . ' !important; font-family: \'' . str_replace('+', ' ', $tharsis['separator_font']) . '\',sans-serif !important; }
			.footer p, .footer a { font-size: ' . $tharsis['footer_size'] . 'px; color: ' . $tharsis['footer_color'] . '; font-family: \'' . str_replace('+', ' ', $tharsis['footer_font']) . '\',sans-serif; }
			';
			echo '</style>';
		}
	}
}
?>