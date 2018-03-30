<?php 
add_filter('wp_title', 'vp_filter_wp_title', 9, 3);
function vp_filter_wp_title( $old_title, $sep, $sep_location ) {
	$ssep = ' ' . $sep . ' ';
	if (is_home() ) {
		return get_bloginfo('name');
	}
	elseif(is_single() || is_page() )
	{
		return get_the_title();
	}
	elseif( is_category() ) $output = $ssep . 'Category';
	elseif( is_tag() ) $output = $ssep . 'Tag';
	elseif( is_author() ) $output = $ssep . 'Author';
	elseif( is_year() || is_month() || is_day() ) $output = $ssep . 'Archives';
	else $output = NULL;
	 
	// get the page number we're on (index)
	if( get_query_var( 'paged' ) )
	$num = $ssep . 'page ' . get_query_var( 'paged' );
	 
	// get the page number we're on (multipage post)
	elseif( get_query_var( 'page' ) )
	$num = $ssep . 'page ' . get_query_var( 'page' );
		 
	// else
	else $num = NULL;
		 
	// concoct and return new title
	return get_bloginfo( 'name' ) . $output . $old_title . $num;
}

//This function shows the top menu using either the menu in Appearance > Menus or the one in the fffolio Options panel
if( !function_exists( 'show_top_menu') )
{
	function show_top_menu() {
		global $fffolio;
		echo '<ul>';

		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object( $locations[ 'top-menu' ] );
		if(isset( $locations[ 'top-menu' ] ) && $menu ) {
			$menu_items = wp_get_nav_menu_items($menu->term_id);

			$pages = array();

			foreach ( (array) $menu_items as $key => $menu_item ) {
				$pages[] = $menu_item;
			}

			for($i=0; $i < (int)(count($pages) / 2); $i++) {
				if($pages[$i]->object == 'page') {
					$vartemp = get_post($pages[$i]->object_id);
					if($i == 0)
						echo '<li class="menu-item-' . $pages[$i]->db_id . '"><a href="'. get_site_url() . '#home_1">' . $pages[$i]->title . '</a></li>'; 
					else
						echo '<li class="menu-item-' . $pages[$i]->db_id . '"><a href="'. get_site_url() . '#' . $vartemp->post_name . '-menu">' . $pages[$i]->title . '</a></li>'; 
				}
				else {
					echo '<li class="menu-item-' . $pages[$i]->db_id . '"><a href="' . $pages[$i]->url . '">' . $pages[$i]->title . '</a></li>'; 
				}
			}

			//code for the middle logo

			if( (isset($fffolio['logo']) && $fffolio['logo'] != '') 
	             || (isset($fffolio['logo_letter']) && $fffolio['logo_letter'] != '') ) { ?>
	            <li>
	                <a href="#intro">
	                    <?php if(isset($fffolio['logo']) && $fffolio['logo'] != '') { ?>
	                        <img class="logoimg" src="<?php echo esc_url($fffolio['logo']);?>" />
	                    <?php } else { ?>
	                        <span class="logo">
	                            <span class="logotext"><?php echo esc_attr($fffolio['logo_letter']);?></span>
	                        </span>
	                    <?php } ?>
	                </a>
	            </li>
	        <?php }

	        for($i=(int)(count($pages) / 2); $i < count($pages); $i++) {
				if($pages[$i]->object == 'page') {
					$vartemp = get_post($pages[$i]->object_id);
					if($i == 0)
						echo '<li class="menu-item-' . $pages[$i]->db_id . '"><a href="'. get_site_url() . '#home_1">' . $pages[$i]->title . '</a></li>'; 
					else
						echo '<li class="menu-item-' . $pages[$i]->db_id . '"><a href="'. get_site_url() . '#' . $vartemp->post_name . '-menu">' . $pages[$i]->title . '</a></li>'; 
				}
				else {
					echo '<li class="menu-item-' . $pages[$i]->db_id . '"><a href="' . $pages[$i]->url . '">' . $pages[$i]->title . '</a></li>'; 
				}
			}
		}
		else {
			if(isset($fffolio['pages_topmenu']) && $fffolio['pages_topmenu'] != '' )
				$pages = get_pages( array('include' => $fffolio['pages_topmenu'], 'sort_column' => 'menu_order', 'sort_order' => 'ASC') );
			else
				$pages = get_pages('number=4&sort_column=menu_order&sort_order=ASC');
			$count = count($pages); //+1 because of the contact page which is automatically added
			$extra = 1;
			if($fffolio['menu_homelink'] == '1')  {
				if(isset($fffolio['blog_page']) && $fffolio['blog_page'] != '')
					$extra = 3;
				else
					$extra = 2;

				echo '<li><a href="' . get_home_url() . '/#intro">Home</a>';
				$start = 1;
			}
			else {
				if(isset($fffolio['blog_page']) && $fffolio['blog_page'] != '')
					$extra = 2;
			}

			//showing an equal number of pages on the left and on the right of the logo
			$limit1 = 0; $limit2 = 0;
			if($count % 2 == 1) {
				if($extra == 1 || $extra == 2)
					$limit1 = floor($count / 2);
				else
					$limit1 = floor($count / 2 + 1);
			}
			else {
				if($extra == 1)
					$limit1 = floor($count / 2 - 1);
				else if($extra == 2 || $extra == 3)
					$limit1 = floor($count / 2);
			}

			for($i = 0; $i < $limit1; $i++)
			{
				if(isset($pages[$i]) )
					echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
			}

			//logo letter or image

			if( (isset($fffolio['logo']) && $fffolio['logo'] != '') 
	             || (isset($fffolio['logo_letter']) && $fffolio['logo_letter'] != '') ) { ?>
	            <li>
	                <a href="#intro">
	                    <?php if(isset($fffolio['logo']) && $fffolio['logo'] != '') { ?>
	                        <img class="logoimg" src="<?php echo esc_url($fffolio['logo']);?>" />
	                    <?php } else { ?>
	                        <span class="logo">
	                            <span class="logotext"><?php echo esc_attr($fffolio['logo_letter']);?></span>
	                        </span>
	                    <?php } ?>
	                </a>
	            </li>
	        <?php }

	        for($i = $limit1; $i < $count; $i++)
			{
				if(isset($pages[$i]) )
					echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
			}

			if(isset($fffolio['blog_page']) && $fffolio['blog_page'] != '')
				echo '<li><a href="' . get_permalink($fffolio['blog_page'][0]) . '">Blog</a></li>';

			echo '<li><a href="' . get_home_url() . '/#contact-menu">Contact</a></li>';
		}

		echo '</ul>';
	}
}

add_action('wp_head', 'vp_customization');
//This function handles the Colorization tab of the theme options
if(! function_exists('vp_customization'))
{
	function vp_customization() {
		//favicon
		global $fffolio;

		//Loading the google web fonts on the page.
		$loaded[] = 'Open+Sans';
		if(!in_array($fffolio['body_font'], $loaded))
		{
			echo '<link id="' . $fffolio['body_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['body_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['body_font'];
		}

		if(isset($fffolio['top_slogantext_font']) && !in_array($fffolio['top_slogantext_font'], $loaded))
		{
			echo '<link id="' . $fffolio['top_slogantext_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['top_slogantext_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['top_slogantext_font'];
		}

		if(isset($fffolio['top_primarytext_font']) && !in_array($fffolio['top_primarytext_font'], $loaded))
		{
			echo '<link id="' . $fffolio['top_primarytext_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['top_primarytext_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['top_primarytext_font'];
		}

		if(isset($fffolio['top_secondarytext_font']) && !in_array($fffolio['top_secondarytext_font'], $loaded))
		{
			echo '<link id="' . $fffolio['top_secondarytext_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['top_secondarytext_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['top_secondarytext_font'];
		}

		if(isset($fffolio['nav_font']) && !in_array($fffolio['nav_font'], $loaded))
		{
			echo '<link id="' . $fffolio['nav_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['nav_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;	
			$loaded[] = $fffolio['nav_font'];
		}

		if(isset($fffolio['pagetitle_font']) && !in_array($fffolio['pagetitle_font'], $loaded))
		{
			echo '<link id="' . $fffolio['pagetitle_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['pagetitle_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['pagetitle_font'];
		}	
		if(isset($fffolio['h3_font']) && !in_array($fffolio['h3_font'], $loaded))
		{
			echo '<link id="' . $fffolio['h3_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['h3_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['h3_font'];
		}
		if(isset($fffolio['h4_font']) && !in_array($fffolio['h4_font'], $loaded))
		{
			echo '<link id="' . $fffolio['h4_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['h4_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['h4_font'];
		}
		if(isset($fffolio['h5_font']) && !in_array($fffolio['h5_font'], $loaded))
		{
			echo '<link id="' . $fffolio['h5_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['h5_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['h5_font'];
		}
		if(isset($fffolio['footer_font']) && !in_array($fffolio['footer_font'], $loaded))
		{
			echo '<link id="' . $fffolio['footer_font'] . '" href="http://fonts.googleapis.com/css?family=' . $fffolio['footer_font'] . '" rel="stylesheet" type="text/css" />' . PHP_EOL;
			$loaded[] = $fffolio['footer_font'];
		}

		if(isset($fffolio['favicon']) && $fffolio['favicon'] != '')
			echo '<link rel="shortcut icon" href="' . $fffolio['favicon'] . '" />';

		echo "\n<style type='text/css'> \n";

		if(isset($fffolio['bg_image']) && $fffolio['bg_image'] != '')
			echo '#intro, .copyright, .separator { background-image: url("' . esc_url($fffolio['bg_image']) . '"); } ';
		if(isset($fffolio['bg2_image']) && $fffolio['bg2_image'] != '') 
			echo '.copyright, .separator { background-image: url("' . esc_url($fffolio['bg2_image']) . '"); } ';

		//add custom CSS as per the theme options only if custom colorization was enabled.
		if(isset($fffolio['enable_colorization']) && $fffolio['enable_colorization'] == 1)
		{
			$loaded = array();
			echo '
			p, body { font-size: ' . $fffolio['body_size'] . 'px; color: ' . $fffolio['body_color'] . '; font-family: \'' . str_replace('+', ' ', $fffolio['body_font']) . '\',sans-serif; }
			h1 { font-size: ' . $fffolio['top_secondarytext_size'] . 'px; color: ' . $fffolio['top_secondarytext_color'] . '; font-family: \'' . str_replace('+', ' ', $fffolio['top_secondarytext_font']) . '\',sans-serif; }
			span.small { font-size: ' . $fffolio['top_primarytext_size'] . 'px; color: ' . $fffolio['top_primarytext_color'] . '; font-family: \'' . str_replace('+', ' ', $fffolio['top_primarytext_font']) . '\',sans-serif; }
			span.cursive { font-size: ' . $fffolio['top_slogantext_size'] . 'px; color: ' . $fffolio['top_slogantext_color'] . '; font-family: \'' . str_replace('+', ' ', $fffolio['top_slogantext_font']) . '\',sans-serif; }
			nav ul a { font-size: ' . $fffolio['nav_size'] . 'px; color: ' . $fffolio['nav_color'] . ' !important; font-family: \'' . str_replace('+', ' ', $fffolio['nav_font']) . '\',sans-serif; }
			nav ul a:hover { color: ' . $fffolio['nav_hovercolor'] . ' !important; }
			h2 { font-size: ' . $fffolio['pagetitle_size'] . 'px; color: ' . $fffolio['pagetitle_color'] . '; font-family: \'' . str_replace('+', ' ', $fffolio['pagetitle_font']) . '\',sans-serif; }
			h3 { color: ' . $fffolio['h3_color'] . '; font-size: ' . $fffolio['h3_size'] . 'px; font-family: \'' . str_replace('+', ' ', $fffolio['h3_font']) . '\',sans-serif; }
			h4 { color: ' . $fffolio['h4_color'] . '; font-size: ' . $fffolio['h4_size'] . 'px; font-family: \'' . str_replace('+', ' ', $fffolio['h4_font']) . '\',sans-serif; }
			h5 { color: ' . $fffolio['h5_color'] . '; font-size: ' . $fffolio['h5_size'] . 'px; font-family: \'' . str_replace('+', ' ', $fffolio['h5_font']) . '\',sans-serif; }
			.copyright  p, .copyright a { font-size: ' . $fffolio['footer_size'] . 'px; color: ' . $fffolio['footer_color'] . '; font-family: \'' . str_replace('+', ' ', $fffolio['footer_font']) . '\',sans-serif; }
			';
		}

		echo '</style>';
	}
}
?>