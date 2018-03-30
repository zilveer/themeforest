<?php 
/**
 * @package by Theme Record
 * @auther: MattMao
 *
 * 1- columns
 * 2- br
*/
add_shortcode('column', 'shortcode_column');
add_shortcode('br', 'shortcode_br');
add_shortcode('clear', 'shortcode_clear');
add_shortcode('hr', 'shortcode_hr');
add_shortcode('box', 'shortcode_box');
add_shortcode('button', 'shortcode_button');
add_shortcode('accordions', 'shortcode_accordions');
add_shortcode('accordion', 'shortcode_accordion');
add_shortcode('toggles', 'shortcode_toggles');
add_shortcode('toggle', 'shortcode_toggle');
add_shortcode('tabs', 'shortcode_tabs');
add_shortcode('tab', 'shortcode_tab');
add_shortcode('price_tables', 'shortcode_price_tables');
add_shortcode('price_table', 'shortcode_price_table');
add_shortcode('icon_box', 'shortcode_icon_box');
add_shortcode('map', 'shortcode_map');
add_shortcode('gallery', 'shortcode_gallery');
add_shortcode('pre', 'shortcode_pre');
add_shortcode('section', 'shortcode_section');
add_shortcode('video', 'shortcode_video');
add_shortcode('youtube', 'shortcode_youtube');
add_shortcode('vimeo', 'shortcode_vimeo');


#
# Columns
#
function shortcode_column( $atts, $content = null)
{
	extract(shortcode_atts(
        array(
            'col' => '1/4',
			'last' => 'no'
    ), $atts));
	
	switch($col)
	{
		case '1/2': $col_class = 'shortcode-col-2-1'; break;
		case '1/3': $col_class = 'shortcode-col-3-1'; break;
		case '1/4': $col_class = 'shortcode-col-4-1'; break;
		case '2/3': $col_class = 'shortcode-col-3-2'; break;
		case '3/4': $col_class = 'shortcode-col-4-3'; break;
	}

	if($last == 'yes') { $last_class = ' shortcode-col-last'; } else { $last_class = ''; }

	$output = '<div class="'.$col_class.$last_class.'">' . theme_shortcode_text($content) . '</div>'."\n";

	if($last == 'yes') { $output .= '<div class="clear"></div>'; } 

	return $output;
}



#
# Br
#
function shortcode_br($atts, $content = null)
{
	extract(shortcode_atts(
        array(
            'top' => '0'
    ), $atts));

    $output = '<div style="margin-top: '.$top.'px;"></div>'."\n";

    return $output;
}



#
# Clear
#
function shortcode_clear($atts, $content = null)
{
    $output = '<div class="clearfix"></div>'."\n";

    return $output;
}


#
# Hr
#
function shortcode_hr($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
            'top' => '0',
			'bottom' => '0'
    ), $atts));

    $output = '<div class="shortcode-hr" style="margin-top: '.$top.'px; margin-bottom: '.$bottom.'px;"></div>'."\n";

    return $output;
}


#
# Box
#
function shortcode_box($atts, $content = null)
{
	extract(shortcode_atts(
        array(
            'style' => 'alert',
			'width' => ''
    ), $atts));

	if($width) {
	
		$width_value = $width.'px';
	
	}else{
	
		$width_value = '100%';
	
	}

    $output = '<div class="shortcode-box shortcode-box-'.$style.'" style="width:'.$width_value.';">'."\n";
	$output .= '<p>' . theme_shortcode_text($content) . '</p>'."\n";
	$output .= '</div>'."\n";

    return $output;
}


#
# Button
#
function shortcode_button($atts, $content = null)
{
	extract(shortcode_atts(
        array(
            'color' => 'gray',
			'text' => 'Button Text',
			'link' => 'http://www.google.com',
			'target' => '_self'
    ), $atts));

    $output = '<a href="'.$link.'" class="shortcode-button shortcode-button-'.$color.'" target="'.$target.'">'.$text.'</a>'."\n";

    return $output;
}



#
# Accordions
#
function shortcode_accordions( $atts, $content = null)
{
	global $accordions_array;
	$accordions_array = array();

	do_shortcode($content);

	$output = '<div class="shortcode-accordions-wrap">';
	$output .= '<ul class="accordions clearfix">';

	foreach( $accordions_array as $accordion )
	{
		$output .= '<li>';
		$output .= '<h2 class="accordion-head"><span class="accordion-head-icon">'. $accordion['title'] .'</span></h2>';
		$output .= '<div class="accordion-content clearfix">'. theme_shortcode_text($accordion['content']) .'</div>';
		$output .= '</li>';
	}

	$output .= '</ul>';
	$output .= '</div>';	
	
	return $output;
}


#
# Accordion
#
function shortcode_accordion($atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' => 'Title goes here'
	), $atts));

	global $accordions_array;

	$accordions_array[] = array(
		'title' => $title,
		'content' => $content
	);
}


#
# Toggles
#
function shortcode_toggles( $atts, $content = null)
{
	global $toggles_array;
	$toggles_array = array();

	do_shortcode($content);

	$output = '<div class="shortcode-toggles-wrap">';
	$output .= '<ul class="toggles clearfix">';

	foreach( $toggles_array as $toggle )
	{
		$active = $toggle['active'];

		if($active == 'yes') { $class = ' active'; } else { $class = ''; }

		$output .= '<li>';
		$output .= '<h2 class="toggle-head"><span class="toggle-head-icon'.$class.'">'. $toggle['title'] .'</span></h2>';
		$output .= '<div class="toggle-content'.$class.'">'. theme_shortcode_text($toggle['content']) .'</div>';
		$output .= '</li>';
	}

	$output .= '</ul>';
	$output .= '</div>';	
	
	return $output;
}


#
#Toggle
#
function shortcode_toggle( $atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' => 'Title goes here',
		'active' => ''
	), $atts));

	global $toggles_array;

	$toggles_array[] = array(
		'title' => $title,
		'active' => $active,
		'content' => $content
	);
}


#
#Tabs
#
function shortcode_tabs( $atts, $content = null)
{
	global $tabs_array;
	$tabs_array = array();

	$tab_count = 0;
	$tab_pane_count = 0;

	do_shortcode($content);

	$output = '<div class="shortcode-tabs-wrap">';
	$output .= '<ul class="tabs clearfix">';
	
	foreach( $tabs_array as $tab )
	{
		$tab_count++;
		if($tab_count == '1')
		{
			$class = 'tab active';
		}
		else
		{
			$class = 'tab';
		}
		$title = strtolower(str_replace(' ', '-', $tab['title']));
		$output .= '<li><a href="#'.$title.'" class="'.$class.'">' . $tab['title'] . '</a></li>';
	}
	
	$output .= '</ul>';
	$output .= '<div class="tabs-content clearfix">';
	
	foreach( $tabs_array as $tab )
	{
		$tab_pane_count++;
		if($tab_pane_count == '1')
		{
			$class = 'pane active';
		}
		else
		{
			$class = 'pane hide';
		}
		$title = strtolower(str_replace(' ', '-', $tab['title']));
		$output .= '<div id="'.$title.'" class="'.$class.'">'.theme_shortcode_text($tab['content']).'</div>';
	}

	$output .= '</div>';		
	$output .= '</div>';
	
	return $output;
}



#
#Tab
#
function shortcode_tab( $atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' => 'Title goes here'
	), $atts));

	global $tabs_array;

	$tabs_array[] = array(
		'title' => $title,
		'content' => $content
	);
}



#
#Price Table 
#
function shortcode_price_tables( $atts, $content = null)
{
	global $tables_array;
	$tables_array = array();
	$price_item_count = 0;

	do_shortcode($content);

	$output = '<div class="shortcode-price-tables clearfix">';

	foreach( $tables_array as $table )
	{
		$price_item_count ++;

		$col = count($tables_array);

		if($price_item_count == 1) { $class = 'pricing-item-'.$col.'-1 pricing-item-fist pricing-item clearfix'; } else {  $class = 'pricing-item-'.$col.'-1 pricing-item clearfix'; }

		$output .= '<div class="'.$class.'">';
		$output .= '<h5 class="price-title">'.$table['title'].'</h5>';
		$output .= '<p class="price-currency">'.$table['currency'].$table['price'].'<span>'.$table['time'].'</span></p>';
		$output .= $table['content'];

		if($table['button_url'] && $table['button'])
		{
			$output .= '<div class="button-wrap"><a href="'.$table['button_url'].'">'.$table['button'].'</a></div>';
		}

		$output .= '</div>';
	}

	$output .= '</div>';

	return $output;
}



#
#Price Table Item
#
function shortcode_price_table( $atts, $content = null)
{
	extract(shortcode_atts(array(
		'title' => 'Your title',
		'currency' => '',
		'price' => '',
		'time' => '',
		'button' => '',
		'button_url' => ''
	), $atts));

	global $tables_array;

	$tables_array[] = array(
		'title' => $title,
		'currency' => $currency,
		'price' => $price,
		'time' => $time,
		'button' => $button,
		'button_url' => $button_url,
		'content' => $content
	);
}



#
#Icon Box
#
function shortcode_icon_box($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
			'title' => '',
     		'icon' => '',
			'link' => '',
			'show_button' => 'yes',
			'button_text' => 'Read More',
    ), $atts));

	//check wich link base we should use for the icon. by default we take the iconbox folder. if the user sets a path use that path
	if($icon != ""&& strpos('/', $icon) === false) { $icon_url = ASSETS_URI . '/images/shortcodes/icons/'.$icon; }

	if($icon != "") { $icon_img = '<img src="'.$icon_url.'" alt="'.$title.'" />'; }

	$output = '<div class="shortcode-iconbox">'."\n";
	$output .= '<div class="iconbox-header clearfix">'."\n";
	$output .= '<div class="iconbox-img">'.$icon_img.'</div>';

	if($link) {
		$output .= '<h5 class="iconbox-title"><a href="'.$link.'">'.$title.'</a></h5>';
	}else{
		$output .= '<h5 class="iconbox-title">'.$title.'</h5>';
	}

	$output .= '</div>'."\n";
	$output .= '<div class="iconbox-desc">'.theme_shortcode_text($content) .'</div>';

	if($show_button == 'yes' && $link) {
		$output .= '<div class="iconbox-button meta"><a href="'.$link.'">'.$button_text.'</a></div>';
	}

	$output .= '</div>'."\n";

	return $output;
}



#
# Maps
#
function shortcode_map($atts, $content = null)
{
	extract(shortcode_atts(
        array(
            'width' => '100%',
			'height' => '300',
			'zoom' => '8',
			'lat' => '0',
			'lng' => '0',
			'address' => ''
    ), $atts));

	if($address) {
		$output = '<div class="map-canvas" data-lat="'.$lat.'" data-lng="'.$lng.'" data-address="'.$address.'" data-zoom="'.$zoom.'" data-mapTitle="Google, Inc" style="width: '.$width.'; height: '.$height.'px;"></div>'."\n";
	}

    return $output;
}



#
# Gallery
#
function shortcode_gallery($atts, $content = null)
{
	global $post;
	extract(shortcode_atts(
        array(
			'order' => 'ASC',
            'orderby' => 'menu_order',
			'id' => $post->ID,
			'columns' => 4,
			'size' => 'thumbnail',
			'include' => '',
			'exclude' => ''
    ), $atts));

	if ( !empty($include) ) 
	{
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$args = array(
			'post_parent' => $id,
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => 'inherit',
			'order' => $order,
			'orderby' => $orderby,
			'include' => $include,
			'posts_per_page' => -1
		);	
	}
	elseif ( !empty($exclude) )
	{
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$args = array(
			'post_parent' => $id,
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => 'inherit',
			'order' => $order,
			'orderby' => $orderby,
			'exclude' => $exclude,
			'posts_per_page' => -1
		);	
	}
	else
	{
		$args = array(
			'post_parent' => $id,
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => 'inherit',
			'order' => $order,
			'orderby' => $orderby,
			'posts_per_page' => -1
		);	
	}

	$attachments = get_posts( $args );

	if ($attachments)
	{
		$output = "\n";
		$output .= '<ul class="shortcode-gallery clearfix">'."\n";
		$loop_count = 0;
		foreach($attachments as $attachment)
		{
			$loop_count++; 
			if (($loop_count -1) % $columns == 0) 
			{
				$post_class = 'class="post-thumb post-thumb-hover post-thumb-preload col-first"';
			}else{
				$post_class = 'class="post-thumb post-thumb-hover post-thumb-preload"';
			}
			
			$title = trim(strip_tags(apply_filters( 'the_title', $attachment->post_title )));
			$alt = trim(strip_tags(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true)));

			$output .= '<li '.$post_class.'>';
			$output .= '<a href="'.get_image_url($attachment->ID).'" class="loader-icon fancybox" rel="gallery" title="'.$title.'">';
			$output .= get_featured_image($attachment->ID, $size, 'wp-gallery wp-preload-image', $alt);
			$output .= '</a>';
			$output .= '</li>'."\n";
		}
		wp_reset_postdata();
		$output .= '</ul>'."\n";
	}

	return $output;
}



#
#Pre
#
function shortcode_pre($atts, $content = null)
{
	$content = preg_replace('#^<\/p>|^<br\s?\/?>|<p>$|<p>\s*(&nbsp;)?\s*<\/p>#', '', $content);

	$output = '<div class="shortcode-pre">'."\n";
	$output .= shortcode_unautop($content);
	$output .= '</div>'."\n";

	return $output;
}



#
#Section
#
function shortcode_section($atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'top' => '0',
            'bottom' => '0'
    ), $atts));

	$output = '<div class="shortcode-section col-width" style="margin-top: '.$top.'px; margin-bottom: '.$bottom.'px;">'."\n";
	$output .= theme_shortcode_text($content);
	$output .= '</div>'."\n";

	return $output;
}



#
#Video Shortcode
#
function shortcode_video($atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'width' => '',
            'height' => '',
			'ogv' => '',
            'mp4' => '',
			'webm' => '',
			'poster_image' => ''
    ), $atts));

	if($height == '') { $height = $width * 9/16; }

	if($ogv || $mp4 || $webm)
	{
		$output = '<div style="width: '.$width.'px; height: '.$height.'px;">';
		$output .= '<video class="video-js vjs-default-skin" poster="'.$poster_image.'" data-aspect-ratio="1.78" data-setup="{}" controls>'."\n";
		if($mp4) { $output .= '<source src="'.$mp4.'" type="video/mp4" />'."\n"; }
		if($webm) { $output .= '<source src="'.$webm.'" type="video/webm" />'."\n"; }
		if($ogv) { $output .= '<source src="'.$ogv.'" type="video/ogg" />'."\n"; }
		$output .= '</video>'."\n";
		$output .= '</div>'."\n";
	}

	return $output;
}




#
#Youbube Shortcode
#
function shortcode_youtube($atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'id' => '',
			'width' => '',
            'height' => ''
    ), $atts));

	if($height == '') { $height = $width * 9/16; }

	if($id) 
	{ 
		 $output = '<iframe class="video" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>'."\n"; 
	}

	return $output;
}




#
#Vimeo Shortcode
#
function shortcode_vimeo($atts, $content = null)
{
	extract(shortcode_atts(
        array(
			'id' => '',
			'width' => '',
            'height' => ''
    ), $atts));

	if($height == '') { $height = $width * 9/16; }

	if($id) 
	{ 
		 $output = '<iframe class="video" src="http://player.vimeo.com/video/'.$id.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'."\n"; 
	}

	return $output;
}


?>