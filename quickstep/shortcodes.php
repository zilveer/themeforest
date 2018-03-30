<?php

//Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
@ini_set('pcre.backtrack_limit', 500000);

 
// Register short codes at priority 7 to avoid wp formatting
function strip_shortcode( $content ) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
    
    add_shortcode('one_third', 'column_one_third');
    add_shortcode('one_third_last', 'column_one_third_last');
    add_shortcode('two_third', 'column_two_third');
    add_shortcode('two_third_last', 'column_two_third_last');
    add_shortcode('one_half', 'column_one_half');
    add_shortcode('one_half_last', 'column_one_half_last');
    add_shortcode('one_fourth', 'column_one_fourth');
    add_shortcode('one_fourth_last', 'column_one_fourth_last');
    add_shortcode('three_fourth', 'column_three_fourth');
    add_shortcode('three_fourth_last', 'column_three_fourth_last');
    add_shortcode('one_fifth', 'column_one_fifth');
    add_shortcode('one_fifth_last', 'column_one_fifth_last');
    add_shortcode('two_fifth', 'column_two_fifth');
    add_shortcode('two_fifth_last', 'column_two_fifth_last');
    add_shortcode('three_fifth', 'column_three_fifth');
    add_shortcode('three_fifth_last', 'column_three_fifth_last');
    add_shortcode('four_fifth', 'column_four_fifth');
    add_shortcode('four_fifth_last', 'column_four_fifth_last');
    add_shortcode('one_sixth', 'column_one_sixth');
    add_shortcode('one_sixth_last', 'column_one_sixth_last');
    add_shortcode('five_sixth', 'column_five_sixth');
    add_shortcode('callout', 'qs_callout');
    add_shortcode('accent', 'accent_text');
    add_shortcode('highlight', 'qs_highlight');
    add_shortcode('button', 'qs_button');
    add_shortcode('link', 'qs_link');
    add_shortcode('five_sixth_last', 'column_five_sixth_last');
    add_shortcode('icon', 'qs_icon');
    add_shortcode("googlemap", "qs_google_maps");
    add_shortcode('info', 'info_boxes');
    add_shortcode('clear', 'qs_break');
    add_shortcode( 'accordions', 'qs_accordions' );
    add_shortcode( 'accordion', 'qs_accordion' );
    add_shortcode( 'accordions', 'accordion_open_tag' );
    add_shortcode( 'accordion', 'accordion_section' );
    add_shortcode( 'tabgroup', 'qs_tabgroup' );
    add_shortcode( 'tab', 'qs_tab' );
    add_shortcode( 'togglegroup', 'qs_togglegroup' );
    add_shortcode('toggle', 'qs_toggle');
    add_shortcode('slider', 'qs_slider');
    add_shortcode('feature', 'qs_features');
    add_shortcode('social', 'qs_social');
    
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}
 
add_filter( 'the_content', 'strip_shortcode', 7 );
add_filter( 'qs_footer', 'strip_shortcode', 7 );
add_filter('widget_text', 'strip_shortcode', 7);


/* ---------------------------------------------------------------------- */
/*	Columns
/* ---------------------------------------------------------------------- */

function column_one_third( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_third column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_one_third_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_third column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}

function column_two_third( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="two_third column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_two_third_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="two_third column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}

function column_one_half( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_half column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_one_half_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_half column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}

function column_one_fourth( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_fourth column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_one_fourth_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_fourth column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}

function column_three_fourth( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="three_fourth column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_three_fourth_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="three_fourth column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}

function column_one_fifth( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_fifth column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_one_fifth_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_fifth column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}

function column_two_fifth( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="two_fifth column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_two_fifth_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="two_fifth column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}

function column_three_fifth( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="three_fifth column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_three_fifth_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="three_fifth column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}

function column_four_fifth( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="four_fifth column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_four_fifth_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="four_fifth column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}


function column_one_sixth( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_sixth column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_one_sixth_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="one_sixth column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}


function column_five_sixth( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="five_sixth column" style="float:'.$float.';">' . do_shortcode($content) . '</div>';
}

function column_five_sixth_last( $float, $content = null ) {
	extract(shortcode_atts(array(
  	'float' => ''
  	), $float));
   return '<div class="five_sixth column last" style="float:'.$float.';">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}


/* ---------------------------------------------------------------------- */
/*	Callout Box
/* ---------------------------------------------------------------------- */

function qs_callout( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'width' => '',
		'align' => ''
    ), $atts));
	$style;
	if ($width || $align) {
	 $style .= 'style="';
	 if ($width) $style .= 'width:'.$width.'px;';
	 if ($align == 'left' || 'right') $style .= 'float:'.$align.';';
	 if ($align == 'center') $style .= 'margin:0px auto;';
	 $style .= '"';
	}
   return '<div class="cta" '.$style.'>' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function accent_text( $atts, $content = null ) {
   return '<span class="accent">' . do_shortcode($content) . '</span>';
}


function qs_highlight( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'color' => '',
		'opacity' => '100'
    ), $atts));
   return '<span class="accent-bg" style="background:'.$color.'; opacity:'.($opacity/100).';">' . do_shortcode($content) . '</span>';
}




/* ---------------------------------------------------------------------- */
/*	Buttons 
/* ---------------------------------------------------------------------- */

function qs_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '/',
		'size' => 'medium',
		'color' => '',
		'target' => '_self',
		'caption' => '',
		'align' => 'left',
		'slide' => '',
                'separate' => 'false'
    ), $atts));	
	$button = '';
        $class = 'button';
        $class .= ' '.$size;
        $class .= ' '.$align;
        $class .= ' '.$color;
        if($separate == 'true') { $class .= ' separate'; }
        $data_slide = '';
        if($slide) { $data_slide = 'data-slide="'.$slide.'"'; }
	$button .= '<a class="'.$class.'" target="'.$target.'" href="'.$link.'" '.$data_slide.'>';
	$button .= $content;
	if ($caption != '') {
	$button .= '<br /><span class="btn_caption">'.$caption.'</span>';
	};
	$button .= '</a>';
	return $button;
}

/* ---------------------------------------------------------------------- */
/*	Link
/* ---------------------------------------------------------------------- */

function qs_link( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '/',
		'target' => '_self',
		'align' => 'left',
                'separate' => 'false',
		'slide' => ''
    ), $atts));	
	$button = '';
        $class = '';
        $class .= ' '.$align;
        if($separate == 'true') { $class .= ' separate'; }
        if($slide) { $data_slide = 'data-slide="' .$slide. '"'; }
	$button .= '<a class="'. $class.'" target="'.$target.'" href="'.$link.'" '.$data_slide.'>';
	$button .= do_shortcode($content);
	$button .= '</a>';
	return $button;
}



/* ---------------------------------------------------------------------- */
/*	Icons
/* ---------------------------------------------------------------------- */

function qs_icon( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'size' => '50',
		'color' => '',
		'align' => ''
    ), $atts));	
	$icon = '';
	$icon .= '<span class="icon '. $align.'" style="font-size:'.$size.'px; color:'.$color.';">';
	$icon .= $content;
	$icon .= '</span>';
	return $icon;
}



/* ---------------------------------------------------------------------- */
/*	Tabs
/* ---------------------------------------------------------------------- */

function qs_tabgroup( $atts, $content ){
	

if( !isset($GLOBALS['tabs_groups']) )
        $GLOBALS['tabs_groups'] = 0;

$GLOBALS['tabs_groups']++;

$GLOBALS['tab_count'] = 0;

$tabs_count = 1;

do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ) {

        foreach( $GLOBALS['tabs'] as $tab ) {

                $tabs[] = '<li><a href="#tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count . '">' . $tab['title'] . '</a></li>';
                $panes[] = '<li id="tab-' . $GLOBALS['tabs_groups'] . '-' . $tabs_count++ . 'Tab" class="tab-content">' . do_shortcode( $tab['content'] ) . '</li>';

        }

        $return = "\n". '<ul class="tabs">' . implode( "\n", $tabs ) . '</ul>' . "\n" . '<ul class="tabs-content">' . implode( "\n", $panes ) . '</ul>' . "\n";
}

$GLOBALS['tabs'] = null;

return $return;
$GLOBALS['tab_count'] = 0;
do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
	
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
}
$return = "".'<ul class="tabs">'.implode( "\n", $tabs ).'</ul><ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
}
return $return;
}

function qs_tab( $atts, $content ){
extract(shortcode_atts(array(
	'title' => '%d',
	'id' => '%d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array(
	'title' => sprintf( $title, $GLOBALS['tab_count'] ),
	'content' =>  do_shortcode($content),
	'id' =>  $id );

$GLOBALS['tab_count']++;
}


/* ---------------------------------------------------------------------- */
/*	Toggles
/* ---------------------------------------------------------------------- */
function qs_togglegroup( $atts, $content ){
	
	$output = '<div class="toggles-container">'.do_shortcode($content).'</div>';
	
	return $output;

}

function qs_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
		 'title' => '',
		 'style' => 'list'
    ), $atts));
	$output = '';
	$output .= '<div class="'.$style.'"><p class="trigger"><a href="#">' .$title. '</a></p>';
	$output .= '<div class="toggle_container"><div class="block">';
	$output .= do_shortcode($content);
	$output .= '</div></div></div>';

	return $output;
	}



/* ---------------------------------------------------------------------- */
/*	Latest Posts  @TODO
/* ---------------------------------------------------------------------- */
function qs_latest($atts, $content = null) {
	extract(shortcode_atts(array(
	"offset" => '',
	"num" => '5',
	"thumbs" => 'false',
	"excerpt" => 'false',
	"length" => '50',
	"morelink" => '',
	"width" => '100',
	"height" => '100',
	"type" => 'post',
	"parent" => '',
	"cat" => '',
	"orderby" => 'date',
	"order" => 'ASC'
	), $atts));
	global $post;
	
	$do_not_duplicate[] = $post->ID;
	$args = array(
	  'post__not_in' => $do_not_duplicate,
		'cat' => $cat,
		'post_type' => $type,
		'post_parent'	=> $parent,
		'showposts' => $num,
		'orderby' => $orderby,
		'offset' => $offset,
		'order' => $order
		);
	// query
	$myposts = new WP_Query($args);
	
	// container
	$result='<div id="category-'.$cat.'" class="latestposts">';

	while($myposts->have_posts()) : $myposts->the_post();
		// item
		$result.='<div class="latest-item clearfix">';
		// title
		if ($excerpt == 'true') {
			$result.='<h4><a href="'.get_permalink().'">'.the_title("","",false).'</a></h4>';
		} else {
			$result.='<div class="latest-title"><a href="'.get_permalink().'">'.the_title("","",false).'</a></div>';			
		}
		
		
		// thumbnail
		if (has_post_thumbnail() && $thumbs == 'true') {
			$result.= '<img alt="'.get_the_title().'" class="alignleft latest-img" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$height.'&amp;w='.$width.'"/>';
		}

		// excerpt		
		if ($excerpt == 'true') {
			// allowed tags in excerpts
			$allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<blockquote>,<img>,<span>,<p>';
		 	// filter the content
			$text = preg_replace('/\[.*\]/', '', strip_tags(get_the_excerpt(), $allowed_tags));
			// remove the more-link
			$pattern = '/(<a.*?class="more-link"[^>]*>)(.*?)(<\/a>)/';
			// display the new excerpt
			$content = preg_replace($pattern,"", $text);
			$result.= '<div class="latest-excerpt">'.qs_limit_words($content,$length).'</div>';
		}
		
		// excerpt		
		if ($morelink) {
			$result.= '<a class="more-link" href="'.get_permalink().'">'.$morelink.'</a>';
		}
		
		// item close
		$result.='</div>';
  
	endwhile;
		wp_reset_postdata();
	
	// container close
	$result.='</div>';
	return $result;
}
add_shortcode("latest", "qs_latest");

// Example Use: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]

/*-----------------------------------------------------------------------------------*/
// Creates an additional hook to limit the excerpt
/*-----------------------------------------------------------------------------------*/

function qs_limit_words($string, $word_limit) {
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
	$words = explode(' ', $string);
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
	return implode(' ', array_slice($words, 0, $word_limit));
}


/* ---------------------------------------------------------------------- */
/*	Related Posts
/* ---------------------------------------------------------------------- */
add_shortcode('related_posts', 'qs_related_posts');
function qs_related_posts( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<div class="qs_relatedposts">';
		$retval .= '<h4>Related Posts</h4>';
		$retval .= '<ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		$retval .= '</div>';
		return $retval;
	}
	return;
}

/* ---------------------------------------------------------------------- */
/*	Line Break 
/* ---------------------------------------------------------------------- */
function qs_break( $atts, $content = null ) {
	return '<div class="clear"></div>';
}

/* ---------------------------------------------------------------------- */
/*	Accordions
/* ---------------------------------------------------------------------- */


function qs_accordions( $atts, $content ){
	
$GLOBALS['tab_count'] = 0;
do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
	
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
}
$return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
}
return $return;

}



function qs_accordion( $atts, $content ){
extract(shortcode_atts(array(
	'title' => '%d',
	'id' => '%d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array(
	'title' => sprintf( $title, $GLOBALS['tab_count'] ),
	'content' =>  do_shortcode($content),
	'id' =>  $id );

$GLOBALS['tab_count']++;
}


function accordion_open_tag( $atts, $content=null ) {
  return '<div class="accordion">'.do_shortcode($content).'</div>';
}
function accordion_section( $atts, $content=null ) {
  $atts = shortcode_atts( array(
    'title' => 'default title'
  ), $atts );

  return "<h3><a href=\"#\">".$atts['title']."</a></h3>" . 
         "<div>".do_shortcode($content)."</div>";
}



/* ---------------------------------------------------------------------- */
/*	Info Boxes
/* ---------------------------------------------------------------------- */

function info_boxes( $atts, $content = null ) {
	extract(shortcode_atts(array(
  	'type' => 'type'
  	), $atts));
	if ($atts['type']) {
   		return '<div class="'.$type.'">' . do_shortcode($content) . '</div>';
	}
	else {
		return '<div class="info">' . do_shortcode($content) . '</div>';
	}
}


/* ---------------------------------------------------------------------- */
/*	Google Maps
/* ---------------------------------------------------------------------- */

function qs_google_maps($atts, $content = null) {
	extract(shortcode_atts(array(
      "width" => '100%',
      "height" => '300',
      "src" => ''
   ), $atts));
	
return '<div class="google-map"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&output=embed"></iframe></div>';
}


/* ---------------------------------------------------------------------- */
/*	Slider 
/* ---------------------------------------------------------------------- */

function qs_slider( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'id' => ''
		), $atts ) );

	global $post;

	$args = array('name'           => esc_attr( $id ),
				  'post_type'      => 'slider',
				  'posts_per_page' => '1'
			  );

	$sliders = get_posts( $args );

	foreach ($sliders as $slider) : setup_postdata($slider); 
	

		$output = '<section id="slider-' . $slider->ID . '" class="flexslider slider-' . $slider->ID .'">';
			$output .= '<ul class="slides">';

			$slides = get_post_meta( $slider->ID, 'qs_slider_slides' );

			if( !$slides || !$slides[0] )
				return;

			foreach ( $slides[0] as $slide ) :

				$output .= '<li class="slide">';
				
				
					if($slide['slide-img-src'] != ''):
						$output .= '<img src="' . $slide['slide-img-src'] . '" alt="' . $slider->post_title . '" />';	
					endif;

					if( isset( $slide['slide-content'] ) ):
						$output .= '<div class="flex-caption">' . do_shortcode( $slide['slide-content'] ) . '</div>';
					endif;

				$output .= '</li>';

			endforeach;

			$output .= '</ul>';
		$output .= '</section>';

	endforeach;
	wp_reset_postdata();


	return $output;

}


/* ---------------------------------------------------------------------- */
/*	Features
/* ---------------------------------------------------------------------- */

function qs_features( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'id' => ''
		), $atts ) );

	global $post;

	$args = array('name'           => esc_attr( $id ),
				  'post_type'      => 'features',
				  'posts_per_page' => '1'
			  );


	$features = get_posts( $args );
			
			
	foreach ($features as $feature) : setup_postdata($feature); 
		
		$icon = qs_get_meta('qs_icon_char', $feature->ID);
		if($icon)
		{
			$icon_size = qs_get_meta('qs_icon_size', $feature->ID);
			$icon_color = qs_get_meta('qs_icon_color', $feature->ID);
			$src = wp_get_attachment_image_src(get_post_thumbnail_id($feature->ID), 'full');
			$image = '<span class="feature-icon icon" style="font-size:'.$icon_size.'px; color:'.$icon_color.';">'.$icon.'</span>';	
		}
		else
		{
			$src = wp_get_attachment_image_src(get_post_thumbnail_id($feature->ID), 'full');
			if($src) $image = '<img src="'.$src[0].'" class="feature-image" alt="'.$feature->post_title.'" />';
			else $image = '';
		}
		
		$output =  '<article id="feature-' . $feature->ID . '" class="feature">';
		$output .= $image;
		$output .= '<h3 class="feature-title">'.$feature->post_title.'</h3>';
		$output .= '<span class="feature-desc">'.$feature->post_content.'</span>';
		$output .= '</article>';

	endforeach;
	wp_reset_postdata();

	return do_shortcode($output);

}


/* ---------------------------------------------------------------------- */
/*	Social Media
/* ---------------------------------------------------------------------- */

function qs_social( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'float' => ''
		), $atts ) );

		$social_array = array(
			'behance'     => 'Behance',
			'delicious'   => 'Delicious',
			'deviantart'  => 'deviantART',
			'digg'        => 'Digg',
			'digg2'       => 'Digg',
			'dribbble'    => 'Dribbble',
			'facebook'    => 'Facebook',
			'flickr'      => 'Flickr',
			'forrst'      => 'Forrst',
			'google'      => 'Google',
			'google2'     => 'Google',
			'grooveshark' => 'Grooveshark',
			'lastfm'      => 'Last.fm',
			'linkedin'    => 'LinkedIn',
			'myspace'     => 'MySpace',
			'pinterest'   => 'Pinterest',
			'rss'         => 'RSS',
			'skype'       => 'Skype',
			'tumblr'      => 'Tumblr',
			'twitter'     => 'Twitter',
                        'twitter2'     => 'Twitter',
			'vimeo'       => 'Vimeo',
			'youtube'     => 'YouTube'
			);

		$output = '<ul class="social" style="float:'.$float.';">';

		if( $social_array ) {

			foreach( $social_array as $social_id => $name ) {
				
				if( $name && of_get_option( 'qs_social_' . $social_id ) ) {

						$output .= '<li class="' . $social_id . '"><a href="' . of_get_option( 'qs_social_' . $social_id ) . '" target="_blank">' . $name . '</a></li>';
			

				}

			}

		}

		$output .= '</ul>';		

	return $output;

}


		


?>
