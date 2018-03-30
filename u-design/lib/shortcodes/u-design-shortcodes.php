<?php 
/**
 * U-Design Theme Specific Shortcodes
 * 
 */
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



// Allows shortcodes to be used in widgets
if ( !is_admin() ){
    add_filter('widget_text', 'do_shortcode');
}

// Shortcode: "Read More ->" Link.
// Usage: [read_more text="Read more" title="Read More..." url="http://www.some_url_goes_here.com/" align="left" target="_blank"]
function read_more_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more', 'udesign'),
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? '-align-right': '-align-left';
    $more_arrow = ( is_rtl() ) ? '&larr;' : '&rarr;';
    $html = '<a class="read-more'.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span>'.do_shortcode($text).'</span> '.$more_arrow.'</a>';
    return $html;
}
add_shortcode('read_more', 'read_more_func');

// Shortcode: Button.
// Usage: [button text="Read more..." style="light" title="Nice Button" url="http://www.some_url_goes_here.com/" align="left" target="_blank"]
function button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $style_class = ( $style == 'dark' ) ? ' dark-button': ' light-button';
    $align_class = '';
    $before = $after = '<div class="clear"></div>';
    if( $align == 'right' ) {
        $align_class = ' align-btn-right';
    } elseif ( $align == 'left' ) {
        $align_class = ' align-btn-left';
    } else { // catch 'center'
        $before = '<div class="align-btn-center">';
        $after = '</div>';
    }
    $html = '<a class="'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span>'.do_shortcode($text).'</span></a>';
    return $before.$html.$after;
}
add_shortcode('button', 'button_func');

// Shortcode: Small Button.
// Usage: [small_button text="Read more..." style="light" title="Nice Button" url="http://www.some_url_goes_here.com/" align="left" target="_blank"]
function small_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $style_class = ( $style == 'dark' ) ? ' small-dark-button': ' small-light-button';
    $align_class = '';
    $before = $after = '<div class="clear"></div>';
    if( $align == 'right' ) {
        $align_class = ' align-btn-right';
    } elseif ( $align == 'left' ) {
        $align_class = ' align-btn-left';
    } else { // catch 'center'
        $before = '<div class="align-btn-center">';
        $after = '</div>';
    }
    $html = '<a class="'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span>'.do_shortcode($text).'</span></a>';
    return $before.$html.$after;
}
add_shortcode('small_button', 'small_button_func');

// Shortcode: Round Button.
// Usage: [round_button text="Read more..." style="light" title="Nice Button" url="http://www.some_url_goes_here.com/" align="left" target="_blank"]
function round_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));
    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $style_class = ( $style == 'dark' ) ? ' dark-round-button': ' light-round-button';
    $align_class = '';
    $before = $after = '<div class="clear"></div>';
    if( $align == 'right' ) {
        $align_class = ' align-btn-right';
    } elseif ( $align == 'left' ) {
        $align_class = ' align-btn-left';
    } else { // catch 'center'
        $before = '<div class="align-btn-center">';
        $after = '</div>';
    }
    $html = '<a class="'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span>'.do_shortcode($text).'</span></a>';
    return $before.$html.$after;
}
add_shortcode('round_button', 'round_button_func');

// Shortcode: Custom Button.
// Usage: [custom_button text="Read more..." title="Nice Button" url="http://www.some_url_goes_here.com/" size="medium" bg_color="#FF5C00" text_color="#FFFFFF" align="left" target="_blank"]
// Options: align: left, right or center, size: small, medium, large and x-large, the rest are self explanatory...
function custom_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'title' => '',
	    'url' => '#',
	    'size' => 'medium',
	    'bg_color' => '#FF5C00',
	    'text_color' => '#FFFFFF',
	    'align' => 'left',
	    'target' => '',
    ), $atts));
    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = $before = $after = '';
    if( $align == 'right' ) {
        $align_class = ' align-btn-right';
    } elseif ( $align == 'left' ) {
        $align_class = ' align-btn-left';
    } elseif ( $align == 'none' ) {
        $align_class = ' align-btn-none';
    } else { // catch 'center'
        $before = '<div class="align-btn-center">';
        $after = '</div>';
    }
    $html = '<a class="'.strtolower($size).' custom-button'.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span style="background-color:'.$bg_color.'; color:'.$text_color.'">'.do_shortcode($text).'</span></a>';
    return $before.$html.$after;
}
add_shortcode('custom_button', 'custom_button_func');

// Shortcode: Flat Custom Button.
// Usage: [flat_button text="Flat Button..." title="Flat Button" url="http://www.some_url_goes_here.com/" padding="10px 20px" bg_color="#FF5C00" border_color="#FF5C00" border_width="1px" text_color="#FFFFFF" text_size="14px" align="left" target="_blank"]
// Options: align: left, right or center, the rest are self explanatory...
function flat_custom_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'title' => '',
	    'url' => '#',
	    'padding' => '10px 20px',
	    'bg_color' => '#FF5C00',
	    'border_color' => '#FF5C00',
	    'border_width' => '1px',
	    'text_color' => '#FFFFFF',
	    'text_size' => '14px',
	    'align' => 'left',
	    'target' => '',
    ), $atts));
    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = $before = $after = '';
    if( $align == 'right' ) {
        $align_class = ' align-btn-right';
    } elseif ( $align == 'left' ) {
        $align_class = ' align-btn-left';
    } elseif ( $align == 'none' ) {
        $align_class = ' align-btn-none';
    } else { // catch 'center'
        $before = '<div class="align-btn-center">';
        $after = '</div>';
    }
    $html = '<a class="flat-custom-button'.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span style="padding:'.$padding.'; background-color:'.$bg_color.'; border:'.$border_width.' solid '.$border_color.'; color:'.$text_color.'; font-size:'.$text_size.';">'.do_shortcode($text).'</span></a>';
    return $before.$html.$after;
}
add_shortcode('flat_button', 'flat_custom_button_func');

// Shortcode: Divider with an anchor link to top of page.
// Usage: [divider]
function divider_func( $atts ) {
    return '<div class="divider"></div>';
}
add_shortcode('divider', 'divider_func');

// Shortcode: Divider with an anchor link to top of page.
// Usage: [divider_top]
function divider_top_func( $atts ) {
    return '<div class="divider top-of-page"><a href="#top" title="'.esc_html__('Top of Page', 'udesign').'">'.esc_html__('Back to Top', 'udesign').'</a></div>';
}
add_shortcode('divider_top', 'divider_top_func');

// Shortcode: Clear , used to clear an element of its neighbors, no floating elements are allowed on the left or the right side.
// Usage: [clear]
function clear_func( $atts ) {
    return '<div class="clear"></div>';
}
add_shortcode('clear', 'clear_func');

// Shortcode: Mesage Box. Predefined and custom.
// Usage (pre-defined): [message type="info"]Your info message goes here...[/message]
// there are 4 pre-set message types: "info", "success", "warning", "erroneous"
// Usage (custom): [message type="custom" width="100%" start_color="#FFFFFF" end_color="#EEEEEE" border="#BBBBBB" color="#333333"]Your info message goes here...[/message]
// width could be in pixels as well, e.g. width="250px"
// Usage (simple): [message type="simple" bg_color="#EEEEEE" color="#333333"]Your info message goes here...[/message]
function message_box_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'type' => 'custom',
	    'align' => 'left',
	    'start_color' => '#FFFFFF',
	    'end_color' => '#EEEEEE',
	    'border' => '#BBBBBB',
	    'width' => '100%',
	    'color' => '#333333',
	    'bg_color' => '#F5F5F5',
    ), $atts));
    if ($type == 'custom') {
	if ($align == 'center') {
	    $margin_left = $margin_right = 'auto !important';
	} elseif ($align == 'right') {
	    $margin_left = 'auto !important';
	    $margin_right = '0 !important';
	} else { // default: LEFT
	    $margin_left = $margin_right = '0 !important';
	}
	$html = '<div class="'.$type.'" style="background:-moz-linear-gradient(center top , '.$start_color.', '.$end_color.') repeat scroll 0 0 transparent;
					       background: -webkit-gradient(linear, center top, center bottom, from('.$start_color.'), to('.$end_color.'));
                                               background: -o-linear-gradient(top, '.$start_color.' 0%,'.$end_color.' 99%); /* Opera 11.10+ */
                                               background: -ms-linear-gradient(top, '.$start_color.' 0%,'.$end_color.' 99%); /* IE10+ */
					       margin-left:'.$margin_left.';
					       margin-right:'.$margin_right.';
					       border:1px solid '.$border.';
					       background-color: '.$end_color.';
					       width:'.$width.';
					       color:'.$color.';"><div class="inner-padding">'.do_shortcode($content).'</div></div>';
    } elseif ($type == 'simple') {
	$html = '<div class="'.$type.'" style="background-color:'.$bg_color.'; color:'.$color.';"><div class="inner-padding">'.do_shortcode($content).'</div></div>';
    } else {
	$html = '<div class="'.$type.'"><div class="msg-box-icon">'.do_shortcode($content).'</div></div>';
    }
    return $html;
}
add_shortcode('message', 'message_box_func');

// Shortcode: pullquote
// Usage: [pullquote style="left" quote="light"]Text goes here...[/pullquote], style options: 'left', 'right'; quote options: 'light' (optional), otherwise defaults to dark style
function pullquote_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'left',
	    'quote' => 'dark',
    ), $atts));
    $align = ($style == 'right') ? 'alignright' : 'alignleft';
    $quote_color = ($quote === 'light') ? ' bq-light' : '';
    return '<blockquote class="'.$align.$quote_color.'">'.do_shortcode($content).'</blockquote>';
}
add_shortcode('pullquote', 'pullquote_func');

// Shortcode: pullquote2
// Usage: [pullquote2 style="left" quote="light"]Text goes here...[/pullquote2], style options: 'left', 'right'; quote options: 'light' (optional), otherwise defaults to dark style
function pullquote2_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'left',
	    'quote' => 'dark',
    ), $atts));
    $align = ($style == 'right') ? 'alignright' : 'alignleft';
    $quote_color = ($quote === 'light') ? ' bq-light-2' : ' bq-dark-2';
    return '<blockquote class="'.$align.$quote_color.'">'.do_shortcode($content).'</blockquote>';
}
add_shortcode('pullquote2', 'pullquote2_func');

// Shortcode: Dropcap
// Usage: [dropcap]A[/dropcap]
function dropcap_func( $atts, $content = null ) {
    return '<span class="dropcap">'.$content.'</span>';
}
add_shortcode('dropcap', 'dropcap_func');

// Shortcode: one_fourth
// Usage: [one_fourth]Content goes here...[/one_fourth]
function one_fourth_func( $atts, $content = null ) {
    return '<div class="one_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'one_fourth_func');

// Shortcode: one_fourth_last
// Usage: [one_fourth_last]Content goes here...[/one_fourth_last]
function one_fourth_last_func( $atts, $content = null ) {
    return '<div class="one_fourth last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth_last', 'one_fourth_last_func');

// Shortcode: one_third
// Usage: [one_third]Content goes here...[/one_third]
function one_third_func( $atts, $content = null ) {
    return '<div class="one_third">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'one_third_func');

// Shortcode: one_third_last
// Usage: [one_third_last]Content goes here...[/one_third_last]
function one_third_last_func( $atts, $content = null ) {
    return '<div class="one_third last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third_last', 'one_third_last_func');

// Shortcode: one_half
// Usage: [one_half]Content goes here...[/one_half]
function one_half_func( $atts, $content = null ) {
    return '<div class="one_half">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'one_half_func');

// Shortcode: one_half_last
// Usage: [one_half_last]Content goes here...[/one_half_last]
function one_half_last_func( $atts, $content = null ) {
    return '<div class="one_half last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half_last', 'one_half_last_func');

// Shortcode: two_third
// Usage: [two_third]Content goes here...[/two_third]
function two_third_func( $atts, $content = null ) {
    return '<div class="two_third">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'two_third_func');

// Shortcode: two_third_last
// Usage: [two_third_last]Content goes here...[/two_third_last]
function two_third_last_func( $atts, $content = null ) {
    return '<div class="two_third last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third_last', 'two_third_last_func');

// Shortcode: three_fourth
// Usage: [three_fourth]Content goes here...[/three_fourth]
function three_fourth_func( $atts, $content = null ) {
    return '<div class="three_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'three_fourth_func');

// Shortcode: three_fourth_last
// Usage: [three_fourth_last]Content goes here...[/three_fourth_last]
function three_fourth_last_func( $atts, $content = null ) {
    return '<div class="three_fourth last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth_last', 'three_fourth_last_func');

// Shortcode: toggle_content
// Usage: [toggle_content title="Title"]Your content goes here...[/toggle_content]
function toggle_content_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    $html = '<h4 class="slide_toggle"><a href="#">' .$title. '</a></h4>';
    $html .= '<div class="slide_toggle_content" style="display: none;">'.do_shortcode($content).'</div>';
    return $html;
}
add_shortcode('toggle_content', 'toggle_content_func');

// Shortcode: tab
// Usage: [tab title="title 1"]Your content goes here...[/tab]
function tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $single_tab_array;
    $single_tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $single_tab_array;
}
add_shortcode('tab', 'tab_func');

/* Shortcode: tabs
 * Usage:   [tabs]
 * 		[tab title="title 1"]Your content goes here...[/tab]
 * 		[tab title="title 2"]Your content goes here...[/tab]
 * 	    [/tabs]
 */
function tabs_func( $atts, $content = null ) {
    global $single_tab_array;
    $single_tab_array = array(); // clear the array
    $tabs_content = '';
    
    $tabs_nav = '<div class="clear"></div>';
    $tabs_nav .= '<div class="tabs-wrapper">';
    $tabs_nav .= '<ul class="tabs">';
    @do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content
    $count = 1;
    foreach ($single_tab_array as $tab => $tab_attr_array) {
	$default = ( $tab == 0 ) ? ' class="defaulttab"' : '';
	$tabs_nav .= '<li><a href="javascript:void(0)"'.$default.' id="tab-'.$count.'"><span>'.$tab_attr_array['title'].'</span></a></li>';
	$tabs_content .= '<div class="tab-content" id="tab-'.$count++.'-content"><div class="tabs-inner-padding">'.$tab_attr_array['content'].'</div></div>';
    }
    $tabs_nav .= '</ul>';
    $tabs_output = $tabs_nav . $tabs_content;
    $tabs_output .= '</div><!-- tabs-wrapper end -->';
    $tabs_output .= '<div class="clear"></div>';
    return $tabs_output;
}
add_shortcode('tabs', 'tabs_func');

// Shortcode: accordion_toggle
// Usage: [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
function accordion_toggle_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $single_accordion_toggle_array;
    $single_accordion_toggle_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $single_accordion_toggle_array;
}
add_shortcode('accordion_toggle', 'accordion_toggle_func');

/* Shortcode: accordion
 * Usage:   [accordion scroll_into_view="no"]
 * 		[accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
 * 		[accordion_toggle title="title 2"]Your content goes here...[/accordion_toggle]
 * 	    [/accordion]
 */
function accordion_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'scroll_into_view'      => 'no',
    ), $atts));
    
    if( $scroll_into_view == "yes" ) : ?>
        <script type="text/javascript">
            // <![CDATA[
            // Adjust the accordion headings into view after each click
            jQuery(document).ready(function($){
                $('.accordion-toggle').click(function(){
                    var $this = $(this),
                        offsetElement = 0,
                        prevElHeights = 0;

                    if (!$('body').hasClass('mobile-detected') && $('body').hasClass('u-design-fixed-menu-on')) { offsetElement = 40; }
                    if ($('body').hasClass('admin-bar')) { offsetElement += 32; }

                    $this.prevAll().not(':hidden').each(function() {
                        prevElHeights += $(this).height();
                    });

                    if ($this.length) {
                        $('html,body').animate({
                            scrollTop: $this.offset().top - (offsetElement + prevElHeights)
                        }, 1000);
                    }
                    return false; // Prevents the default action of the event (in this case "click" event)
                });
            });
            // ]]>
        </script>
<?php 
    endif;
    
    
    global $single_accordion_toggle_array;
    $single_accordion_toggle_array = array(); // clear the array

    $accordion_output = '<div class="clear"></div>';
    $accordion_output .= '<div class="accordion-wrapper">';
    @do_shortcode($content); // execute the '[accordion_toggle]' shortcode first to get the title and content
    foreach ($single_accordion_toggle_array as $tab => $accordion_toggle_attr_array) {
	$accordion_output .= '<h3 class="accordion-toggle"><a href="#">'.$accordion_toggle_attr_array['title'].'</a></h3>';
        $accordion_output .= '<div class="accordion-container">';
        $accordion_output .= '  <div class="content-block">'.$accordion_toggle_attr_array['content'].'</div>';
        $accordion_output .= '</div><!-- end accordion-container -->';
    }
    $accordion_output .= '</div><!-- end accordion-wrapper -->';
    $accordion_output .= '<div class="clear"></div>';
    return $accordion_output;
}
add_shortcode('accordion', 'accordion_func');

// Shortcode: list
// Usage: [custom_list style="list-1"]List html goes here...[/custom_list]
function custom_list_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'list-1',
    ), $atts));
    $content = str_replace('<ul>', '<ul class="'.$style.'">', do_shortcode($content));
    return $content;
}
add_shortcode('custom_list', 'custom_list_func');

// Shortcode: custom_table
// Usage: [custom_table]Table html goes here...[/custom_table]
function custom_table_func( $atts, $content = null ) {
    $content = str_replace('<table', '<table class="custom-table" ', do_shortcode($content));
    return $content;
}
add_shortcode('custom_table', 'custom_table_func');

// Shortcode: custom_frame_left
// Usage: [custom_frame_left]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_left]
// Options: shadow="on"
function custom_frame_left_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return  '<div class="custom-frame-wrapper alignleft'.$shadow_class.'"><div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">' . do_shortcode($content) . '</div></div></div>';
}
add_shortcode('custom_frame_left', 'custom_frame_left_func');

// Shortcode: custom_frame_right
// Usage: [custom_frame_right]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_right]
// Options: shadow="on"
function custom_frame_right_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return  '<div class="custom-frame-wrapper alignright'.$shadow_class.'"><div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">' . do_shortcode($content) . '</div></div></div>';
}
add_shortcode('custom_frame_right', 'custom_frame_right_func');

// Shortcode: custom_frame_center
// Usage: [custom_frame_center]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_center]
// Options: shadow="on"
function custom_frame_center_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return  '<div style="text-align:center;"><div class="custom-frame-wrapper aligncenter'.$shadow_class.'"><div class="custom-frame-inner-wrapper"><div class="custom-frame-padding">' . do_shortcode($content) . '</div></div></div></div>';
}
add_shortcode('custom_frame_center', 'custom_frame_center_func');

/* 
 * Shortcode: udesign_recent_posts
 * Usage: [udesign_recent_posts]
 * Options: title="Recent Posts" category_id="9" num_posts="3" post_offset="0" num_words_limit="23" show_date_author="1" show_more_link="0" more_link_text="Read more" show_thumbs="1" remove_thumb_frame="0" thumb_frame_shadow="1" default_thumb="1" post_thumb_width="120" post_thumb_height="60"
 */
function udesign_recent_posts_func( $atts, $content = null) {
    global $wp_widget_factory;
    extract(shortcode_atts(array(
        'title' => esc_html__('Latest Posts', 'udesign'), 
        'category_id' => '', 
        'num_posts' => 3, 
        'post_offset' => 0, 
        'num_words_limit' => 13,
        'show_date_author' => false,
        'show_more_link' => false,
        'more_link_text' => esc_html__('Read more', 'udesign'), 
        'show_thumbs' => true,
        'remove_thumb_frame' => false,
        'thumb_frame_shadow' => false,
        'default_thumb' => true,
        'post_thumb_width' => 60,
        'post_thumb_height' => 60
    ), $atts));
    $widget_name = esc_html('Latest_Posts_Widget');
    $id = $category_id;
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct", 'udesign'),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;
    ob_start();
    the_widget( $widget_name, 
       array(
            'title' => esc_html($title),
            'category_id' => $category_id,
            'num_posts' => $num_posts,
            'post_offset' => $post_offset,
            'num_words_limit' => $num_words_limit,
            'show_date_author' => $show_date_author,
            'show_more_link' => $show_more_link,
            'more_link_text' => esc_html($more_link_text),
            'show_thumbs' => $show_thumbs,
            'remove_thumb_frame' => $remove_thumb_frame,
            'thumb_frame_shadow' => $thumb_frame_shadow,
            'default_thumb' => $default_thumb,
            'post_thumb_width' => $post_thumb_width,
            'post_thumb_height' => $post_thumb_height
       ), 
       array(
            'widget_id'=>'arbitrary-instance-'.$id,
            'before_widget' => '<div class="widget widget_latest_posts">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>' 
        )
    );
    return ob_get_clean();
    
}
add_shortcode('udesign_recent_posts','udesign_recent_posts_func'); 

/* 
 * Shortcode: Content Block Shortcode
 * Usage:     [content_block bg_image="http://your_image_url" max_bg_width="yes" bg_fixed="yes" bg_position="center top" bg_repeat="repeat-x" bg_size="auto" parallax_scroll="no" bg_color="#969696" content_padding="40px 0" font_color="#FFFFFF" class="class-name"]Your content goes here...[/content_block]
 * 
 */
function content_block_func($atts, $content = null) {
    global $udesign_options;
    extract(shortcode_atts(array(
                    'bg_image' => '',
                    'bg_position' => '50% 0',
                    'bg_repeat' => 'repeat',
                    'parallax_scroll' => 'yes',
                    'bg_color' => 'transparent',
                    'bg_fixed' => 'no',
                    'bg_size' => 'auto',
                    'font_color' => 'inherit',
                    'max_bg_width' => 'yes',
                    'content_padding' => '40px 0',
                    'class' => ''
                ), $atts)
            );
    $bg_fixed = ( $bg_fixed == 'yes' ) ? 'fixed': 'scroll';
    $unique_id = rand(1000,2000);
    // Grab just the X bg position value from the user shortcode
    $bg_pos_X = explode(' ', $bg_position);
    $bg_pos_X = $bg_pos_X[0]; 
    
    ob_start(); ?>
            <style type="text/css">
                #content-block-background-<?php echo $unique_id; ?> { background-image: url(<?php echo $bg_image; ?>); background-position: <?php echo $bg_position; ?>; background-repeat: <?php echo $bg_repeat; ?>; background-color: <?php echo $bg_color; ?>; background-attachment: <?php echo $bg_fixed; ?>; background-size: <?php echo $bg_size; ?>; }
                #content-block-body-<?php echo $unique_id; ?> { padding: <?php echo $content_padding; ?>; color: <?php echo $font_color; ?>; }
                .content-block-body { margin-left: auto; margin-right: auto; position: relative; }
            </style>
<?php       if( $max_bg_width == "yes" ) : ?>
                <style type="text/css">
                    #wrapper-1 { overflow-x: hidden; }
                    #content-block-background-<?php echo $unique_id; ?> { margin: 0 -10000px; padding: 0 10000px; }
                </style>
<?php       endif; ?>
            
<?php       if( $parallax_scroll == "yes" ) : ?>
                <script type="text/javascript">
                    // <![CDATA[
                    jQuery(document).ready(function($){
                        if( ! $("body").hasClass( "mobile-detected" ) ){
                            $("#content-block-background-"+<?php echo $unique_id; ?>).each(function(){
                                var $bgobj = $(this); // assigning the object
                                var xPos = '<?php echo $bg_pos_X; ?>'; // x bg position value from the user shortcode
                                $(window).scroll(function() {
                                    var yPos = -($(window).scrollTop() / 3);
                                    // Put together our final background position
                                    var coords = xPos+' '+yPos+'px';
                                    // Move the background
                                    $bgobj.css({ backgroundPosition: coords });
                                });
                            });
                        }
                    });
                    // ]]>
                </script>
<?php       endif; ?>
                
            <div class="clear"></div>
            <div id="content-block-background-<?php echo $unique_id; ?>" class="content-block-background <?php echo $class; ?>">
                <div id="content-block-body-<?php echo $unique_id; ?>" class="content-block-body">
                    <div class="clear"></div>
                    <?php echo do_shortcode($content); ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
<?php
    return ob_get_clean();
}
add_shortcode('content_block', 'content_block_func');


