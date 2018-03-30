<?php
/**
 * Shortcode for manage the content of the pages or posts.
 * 
 * @package WordPress
 * @subpackage YIW Themes
 */                


if ( ! function_exists( 'yiw_sc_section_func' ) ) :
/** 
 * BOX SECTION                    
 * 
 * @description
 *    Shows a box, with Title and icons on left and a text of section (you can use HTMl tags)  
 * 
 * @example
 *   [section icon="" [size=""] title="" [class=""] [last=""] [border=""]]text[/section]
 * 
 * @attr  
 *   class - class of container of box (optional) @default: 'box-sections'
 *   icon  - one of set already been in $icons_name array
 *   size  - icons size (32 or 48) (optional) @default: 48 
 *   last  - specifics if this section is the last element (optional) @default: false 
 *   title - the title
 *   text  - text of the section
 *   border  - add border class
**/
function yiw_sc_section_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'class' => 'box-sections',
        'before_title' => '<h3>',
        'title_size' => '',
        'title' => null,          
        'icon' => null,
        'size' => 32,
        'last' => false,
        'border' => false,
        'link' => '',
        'link_title' => ''
    ), $atts));
    
    $a_before = $a_after = '';
    
    if ( ! empty( $before_title ) && empty( $title_size ) ) {
        $before_title = str_replace( '<', '', $before_title );  
        $before_title = str_replace( '>', '', $before_title ); 
        $title_size = $before_title;     
    }
    
    $img = '';
    if( ! is_null( $icon ) ) {
		$img = yiw_get_img( 'images/icons/set_icons/' . $icon . $size . '.png', $title, 'icon' );   
		if ( empty( $img ) )
			$img = yiw_get_img( 'images/icons/set_icons/' . $icon . '.png', $title, 'icon' );	
	}
    
    $last_class = '';
    if($last) $last_class = ' last';
    
    if( $border )
    	$class .= '-border';
    
    if ( ! empty( $link ) ) {
        $link = esc_url( $link );
        if ( ! empty( $link_title ) )
            $link_title = " title=\"$link_title\"";
        $a_before = "<a href=\"$link\"$link_title>";
        $a_after  = "</a>";
    }
    
    $html = "\n";
    $html .= "<div class=\"$class{$last_class}\">\n";
    $html .= "    $a_before\n";
    $html .= "    $img\n";
    $html .= "    <$title_size><span style=\"line-height:{$size}px\">{$title}</span></$title_size>";  
    $html .= "    $a_after\n";
    $html .= "    ".wpautop(do_shortcode($content))."\n";
    $html .= "</div>\n";    
    
    return apply_filters( 'yiw_sc_section_html', $html );
}    
endif;
add_shortcode('section', 'yiw_sc_section_func');


if ( ! function_exists( 'yiw_sc_section_text_func' ) ) :
/** 
 * BOX SECTION TEXT                   
 * 
 * @description
 *    This is the same of above, but for only text.
**/
function yiw_sc_section_text_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'class' => 'box-sections',
        'title' => null,
        'icon' => null,
        'size' => 32,
        'last' => false
    ), $atts));  
    
    $html = do_shortcode("[section icon=\"$icon\" size=\"$size\" title=\"$title\" class=\"$class\" last=\"$last\"]<p>$content</p>[/section]");
    
    return apply_filters( 'yiw_sc_section_text_html', $html );
}    
endif;
add_shortcode('section_text', 'yiw_sc_section_text_func');


if ( ! function_exists( 'yiw_sc_section_caption_func' ) ) :
/** 
 * SECTION CAPTION                   
 * 
 * @description
 *    Show a box with a captions
 * 
 * @example
 * 	  [section_caption title=""]
 * 	  
 *         [caption_text title=""]text[/caption_text]
 *         [caption_text title=""]text[/caption_text]
 *         [caption_text title=""]text[/caption_text]
 *   
 * 	  [/section_caption] 	               
 * 
 * @attr  
 *   title (section_caption) - the title of section captions
 *   title (caption) - the title of single caption
 *   text  - the text of single caption 
**/
function yiw_sc_section_caption_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'title' => null
    ), $atts));                                    
    
    $html  = '<div class="section-caption group">'."\n";
    
    $html .= "    <h5>$title</h5>\n";
    $html .= "    <div class=\"captions group\">\n";
    $html .= "    ".do_shortcode($content)."\n";
    $html .= "    </div>\n";
    
    $html .= '</div>'."\n";
    
    return apply_filters( 'yiw_sc_section_caption_html', $html );
}       
endif;
add_shortcode('section_caption', 'yiw_sc_section_caption_func');


if ( ! function_exists( 'yiw_sc_caption_text_func' ) ) :
/** 
 * CAPTION                   
 * 
 * @description
 *    This is linked to above. Read that description
**/
function yiw_sc_caption_text_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'title' => null
    ), $atts));                                     
    
    $content = wpautop( $content);     
    
    $html  = "<div class=\"caption\">\n";
    $html .= "    <h6 class=\"red-normal\">$title</h6>\n";
    $html .= "    $content\n";
    $html .= "</div>\n";
    
    return apply_filters( 'yiw_sc_caption_text_html', $html );
}       
endif;
add_shortcode('caption_text', 'yiw_sc_caption_text_func');  


if ( ! function_exists( 'yiw_sc_success_func' ) ) :
/** 
 * SUCCESS BOX     
 * 
 * @description
 *    Show an example of success box alert    
 * 
 * @example
 *   [success]text[/success]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_success_func($atts, $content = null) {
	$html = "<div class=\"box success-box\">".do_shortcode($content)."</div>";
	
	return apply_filters( 'yiw_sc_success_html', $html );
}      
endif;
add_shortcode("success", "yiw_sc_success_func");    


if ( ! function_exists( 'yiw_sc_arrow_func' ) ) :
/** 
 * ARROW BOX     
 * 
 * @description
 *    Show an example of box alert, with an arrow icon    
 * 
 * @example
 *   [arrow]text[/arrow]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_arrow_func($atts, $content = null) {
	$html = "<div class=\"box arrow-box\">".do_shortcode($content)."</div>";
	
	return apply_filters( 'yiw_sc_arrow_html', $html );
}      
endif;
add_shortcode("arrow", "yiw_sc_arrow_func");    


if ( ! function_exists( 'yiw_sc_alert_func' ) ) :
/** 
 * ALERT BOX     
 * 
 * @description
 *    Show an alert box    
 * 
 * @example
 *   [alert]text[/alert]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_alert_func($atts, $content = null) {
	$html = "<div class=\"box alert-box\">".do_shortcode($content)."</div>";
	
	return apply_filters( 'yiw_sc_alert_html', $html );
}      
endif;
add_shortcode("alert", "yiw_sc_alert_func");    


if ( ! function_exists( 'yiw_sc_error_func' ) ) :
/** 
 * ERROR BOX     
 * 
 * @description
 *    Show an error box    
 * 
 * @example
 *   [error]text[/error]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_error_func($atts, $content = null) {
	$html = "<div class=\"box error-box\">".do_shortcode($content)."</div>";
	
	return apply_filters( 'yiw_sc_error_html', $html );
}      
endif;
add_shortcode("error", "yiw_sc_error_func");    


if ( ! function_exists( 'yiw_sc_notice_func' ) ) :
/** 
 * NOTICE BOX     
 * 
 * @description
 *    Show an notice box    
 * 
 * @example
 *   [notice]text[/notice]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_notice_func($atts, $content = null) {
	$html = "<div class=\"box notice-box\">".do_shortcode($content)."</div>";
	
	return apply_filters( 'yiw_sc_notice_html', $html );
}      
endif;
add_shortcode("notice", "yiw_sc_notice_func");    


if ( ! function_exists( 'yiw_sc_info_func' ) ) :
/** 
 * INFO BOX     
 * 
 * @description
 *    Show an info box    
 * 
 * @example
 *   [info]text[/info]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_info_func($atts, $content = null) {
	$html = "<div class=\"box info-box\">".do_shortcode($content)."</div>";
	
	return apply_filters( 'yiw_sc_info_html', $html );
}       
endif;
add_shortcode("info", "yiw_sc_info_func");               


if ( ! function_exists( 'yiw_sc_button_func' ) ) :
/** 
 * BUTTON     
 * 
 * @description
 *    Show a simple custom button    
 * 
 * @example
 *   [button href="" color="green|blue|magenta|red|orange|yellow" width="large|small"]your text[/button]
 * 
 * @attr  
 *   href - the url of linking 
 *   color - background color of button
 *   width - the size of button    
 *   text - the text
**/
function yiw_sc_button_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"color" => '',
		"width" => 'large',
		"href" => "#"
	), $atts));
	
	$html = "<a href=\"$href\" class=\"$width $color button\">$content</a>";
	
	return apply_filters( 'yiw_sc_button_html', $html );
}      
endif;
add_shortcode("button", "yiw_sc_button_func");       


if ( ! function_exists( 'yiw_sc_button_icon_func' ) ) :
/** 
 * BUTTON ICON     
 * 
 * @description
 *    Show a simple custom button, with icon    
 * 
 * @example
 *   [button_icon href="" icon="" icon_file="" icon_path=""]your text[/button_icon]
 * 
 * @attr  
 *   href - the url of linking 
 *   color - background color of button
 *   width - the size of button    
 *   text - the text
**/
function yiw_sc_button_icon_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"icon" => 'arrow',
		"icon_file" => null,
		"icon_path" => FALSE,
		"href" => "#",
		"sense" => "ltr",
		'target' => ''
	), $atts));
	
	if( $icon_path )
		$path = esc_url( $icon_path );
	else
		$path = get_template_directory_uri() . '/images/for_button/';
	
	$style = '';
	if( !is_null($icon_file) )
		$style = " style=\"background-image:url('{$path}{$icon_file}')\"";
		
	if( ! empty($target) )
		$target = " target=\"$target\"";
	
	$html = '';
	//$html .= '<div class="more-button">';
	$html .= "	<a class=\"more-button more-button-$sense\" href=\"$href\" title=\"$content\"$target>$content";
	$html .= "	<span class=\"icon $icon\"$style>&nbsp;</span></a>";
	//$html .= "</div>";
	
	return apply_filters( 'yiw_sc_button_icon_html', $html );
}    
endif;
add_shortcode("button_icon", "yiw_sc_button_icon_func");            


if ( ! function_exists( 'yiw_sc_list_func' ) ) :
/** 
 * LIST BULLET     
 * 
 * @description
 *    Show a simple custom button    
 * 
 * @example
 *   [list type="star|arrow|check|add|info"]
 *       <li>item</li>
 *       <li>item</li>
 *       <li>item</li>
 *   [/list]
 * 
 * @attr  
 *   color - background color of button
 *   width - the size of button    
 *   text - the text
**/  
function yiw_sc_list_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"type" => 'arrow'
	), $atts));
	
	$content = str_replace( '<ul>', '', $content );
	$content = str_replace( '</ul>', '', $content );
	$html = "<ul class=\"short $type\">".do_shortcode($content)."</ul>";
	
	return apply_filters( 'yiw_sc_list_html', $html );
}    
endif;
add_shortcode("list", "yiw_sc_list_func");                


if ( ! function_exists( 'yiw_sc_one_fourth_func' ) ) :
/** 
 * ONE / FORTH     
 * 
 * @description
 *    Create one column of a quarter.    
 * 
 * @example
 *   [one_fourth [last=""]]text[/one_fourth]
 * 
 * @attr  
 *   last - specifics if this element is the last one and undo the margin right (optional) @deafult: false   
 *   text - the text
**/
function yiw_sc_one_fourth_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"last" => false,
		"class" => ''
	), $atts));
	
	$classes = array( 'one-fourth' );
	
    // additional classes
    if( $class != '' )    
        $classes[] = $class;
	
	// last
	if($last) 
        $classes[] = 'last';
        
	$html = "<div class=\"" . implode( $classes, ' ' ) . "\">".yiw_addp( $content )."</div>";
	
	return apply_filters( 'yiw_sc_one_fourth_html', $html );
}     
endif;
add_shortcode("one_fourth", "yiw_sc_one_fourth_func");  


if ( ! function_exists( 'yiw_sc_one_fourth_last_func' ) ) :
/** 
 * ONE / FORTH LAST     
 * 
 * @description
 *    Is the same of above, but it's the last element.
**/
function yiw_sc_one_fourth_last_func($atts, $content = null) {  
	extract(shortcode_atts(array(
		"last" => false,
		"class" => ''
	), $atts));
	      	
    $html = do_shortcode('[one_fourth class="' . $class . '" last="1"]'.$content.'[/one_fourth]');
    
    return apply_filters( 'yiw_sc_one_fourth_last_html', $html );
}   
endif;
add_shortcode("one_fourth_last", "yiw_sc_one_fourth_last_func");  


if ( ! function_exists( 'yiw_sc_one_third_func' ) ) :
/** 
 * ONE / THIRD     
 * 
 * @description
 *    Create one column of a third.    
 * 
 * @example
 *   [one_third [last=""]]text[/one_third]
 * 
 * @attr  
 *   last - specifics if this element is the last one and undo the margin right (optional) @deafult: false   
 *   text - the text
**/
function yiw_sc_one_third_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"last" => false,
		"class" => ''
	), $atts));
	
	$classes = array( 'one-third' );
	
    // additional classes
    if( $class != '' )    
        $classes[] = $class;
	
	// last
	if($last) 
        $classes[] = 'last';
        
	$html = "<div class=\"" . implode( $classes, ' ' ) . "\">".yiw_addp( $content )."</div>";
	
	return apply_filters( 'yiw_sc_one_third_html', $html );
}        
endif;
add_shortcode("one_third", "yiw_sc_one_third_func");          


if ( ! function_exists( 'yiw_sc_one_third_last_func' ) ) :
/** 
 * ONE / THIRD LAST     
 * 
 * @description
 *    Is the same of above, but it's the last element.
**/
function yiw_sc_one_third_last_func($atts, $content = null) {  
	extract(shortcode_atts(array(
		"last" => false,
		"class" => ''
	), $atts));      	
    $html = do_shortcode('[one_third class="' . $class . '" last="1"]'.$content.'[/one_third]');
    
    return apply_filters( 'yiw_sc_one_third_last_html', $html );
}       
endif;
add_shortcode("one_third_last", "yiw_sc_one_third_last_func"); 


if ( ! function_exists( 'yiw_sc_two_third_func' ) ) :
/** 
 * TWO / THIRD     
 * 
 * @description
 *    Create a content in two column of a third.    
 * 
 * @example
 *   [two_third [last=""]]text[/two_third]
 * 
 * @attr  
 *   last - specifics if this element is the last one and undo the margin right (optional) @deafult: false   
 *   text - the text
**/
function yiw_sc_two_third_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"last" => false,
		"class" => ''
	), $atts));
	
	$classes = array( 'two-third' );
	
    // additional classes
    if( $class != '' )    
        $classes[] = $class;
	
	// last
	if($last) 
        $classes[] = 'last';
        
	$html = "<div class=\"" . implode( $classes, ' ' ) . "\">".yiw_addp( $content )."</div>";
	
	return apply_filters( 'yiw_sc_two_third_html', $html );
}            
endif;
add_shortcode("two_third", "yiw_sc_two_third_func");       


if ( ! function_exists( 'yiw_sc_two_third_last_func' ) ) :
/** 
 * TWO / THIRD LAST     
 * 
 * @description
 *    Is the same of above, but it's the last element.
**/
function yiw_sc_two_third_last_func($atts, $content = null) {  
	extract(shortcode_atts(array(
		"last" => false,
		"class" => ''
	), $atts));      	      	
    $html = do_shortcode('[two_third class="' . $class . '" last="1"]'.$content.'[/two_third]');
    
    return apply_filters( 'yiw_sc_one_third_last_html', $html );
}      
endif;
add_shortcode("two_third_last", "yiw_sc_two_third_last_func");      


if ( ! function_exists( 'yiw_sc_two_fourth_func' ) ) :
/** 
 * TWO / FORTH     
 * 
 * @description
 *    Create a content in two column of a quarter.    
 * 
 * @example
 *   [two_fourth [last=""]]text[/two_fourth]
 * 
 * @attr  
 *   last - specifics if this element is the last one and undo the margin right (optional) @deafult: false   
 *   text - the text
**/
function yiw_sc_two_fourth_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"last" => false,
		"class" => '' 
	), $atts));
	
	$classes = array( 'two-fourth' );
	
    // additional classes
    if( $class != '' )    
        $classes[] = $class;
	
	// last
	if($last) 
        $classes[] = 'last';
        
	$html = "<div class=\"" . implode( $classes, ' ' ) . "\">".yiw_addp( $content )."</div>";
	
	return apply_filters( 'yiw_sc_two_fourth_html', $html );
}             
endif;
add_shortcode("two_fourth", "yiw_sc_two_fourth_func");       


if ( ! function_exists( 'yiw_sc_two_fourth_last_func' ) ) :
/** 
 * TWO / FOURTH LAST     
 * 
 * @description
 *    Is the same of above, but it's the last element.
**/
function yiw_sc_two_fourth_last_func($atts, $content = null) { 
	extract(shortcode_atts(array(
		"last" => false,
		"class" => ''
	), $atts));      	       	
    $html = do_shortcode('[two_fourth class="' . $class . '" last="1"]'.$content.'[/two_fourth]');
    
    return apply_filters( 'yiw_sc_two_fourth_last_html', $html );
}            
endif;
add_shortcode("two_fourth_last", "yiw_sc_two_fourth_last_func");     


if ( ! function_exists( 'yiw_sc_table_func' ) ) :
/** 
 * TABLE     
 * 
 * @description
 *    Create a toggle content.    
 * 
 * @example
 *   [table color="white|red|grey|blue"]
 *       <table width="100%" cellpadding="0" cellspacing="0">
 *       	<thead>
 *       	    <tr>
 *       	    	<th style="width:20%"></th>
 *       	    	<th style="width:20%">Free</th>
 *       	    	<th style="width:20%">Mini</th>
 *       	    	<th style="width:20%">Standard</th>
 *       	    	<th style="width:20%">Premium</th>
 *       	    </tr>
 *       	</thead>
 *       	
 *       	<tbody>
 *       	    <tr>
 *       	    	<th class="features">Features 1</th>
 *       	    	<td>1</td>
 *       	    	<td>unlimited</td>
 *       	    	<td>[x]</td>
 *       	    	<td>-</td>
 *       	    </tr>
 *       	</tbody>
 *       </table>
 *   [/table]
 * 
 * @attr                 
 *   color - the color   
 *   markup - the html markup of table
**/
function yiw_sc_table_func($atts, $content = null) {        
	extract(shortcode_atts(array( 
		"color" => null
	), $atts));                                                                                             
	
	$html = '<div class="short-table '.$color.'">' . do_shortcode($content) . '</div>';
	
	return apply_filters( 'yiw_sc_table_html', $html );
}           
endif;
add_shortcode("table", "yiw_sc_table_func");    


if ( ! function_exists( 'yiw_sc_x_func' ) ) :
/** 
 * TICK     
 * 
 * @description
 *    Insert a tick on the content   
 * 
 * @example
 *   [x]
 * 
**/
function yiw_sc_x_func($atts, $content = null) {    
	$html = '<img src="'.get_template_directory_uri().'/images/bg/yes.png" alt="yes" />';
	
	return apply_filters( 'yiw_sc_x_html', $html );
}          
endif;
add_shortcode("x", "yiw_sc_x_func");             


if ( ! function_exists( 'yiw_sc_price_func' ) ) :
/** 
 * TABLES PRICES    
 * 
 * @description
 *    Create a box of prices.    
 * 
 * @example
 *   [price title="" price="" href="" buttontext="" color="white|red|grey|blue|green|yellow" [last="0|1"]]
 *       <li>feature 1</li>
 *       <li>feature 2</li>
 *       <li>feature 3</li>
 *       <li>feature 4</li> 
 *   [/price] 
 * 
 * @attr  
 *   title - title of box
 *   price - price, showed below title
 *   buttontext - the text of button 
 *   href - hyperlink of button More Info
 *   text - list of features    
 *   color - the color   
**/
function yiw_sc_price_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"title" => '',
		"price" => '',
		"buttontext" => 'More info',
		"nobutton" => false,
		"href" => '#',
		"color" => null,
		"last" => 0
	), $atts));
	
	if( $last ) $last = ' last';
	else $last = '';                   
    
    $content = str_replace( '<ul>', '', $content );
	$content = str_replace( '</ul>', '', $content );
	                                     
	$html  = '<div class="one-third'.$last.'">';
	$html .= '	<div class="price-table">';
	$html .= '	  <div class="head '.$color.'">';
	$html .= '	   	<p>'.$title.'</p>';
	$html .= '		<h2 class="price">'.$price.'</h2>';
	$html .= '	  </div>';
	$html .= '	  <div class="body">';
	$html .= '		<ul>';
	$html .= '			'.do_shortcode($content);
	$html .= '		</ul>';
	$html .= '';		
	if ( ! $nobutton ) $html .= '		<p class="more"><a href="'.$href.'">'.$buttontext.'</a></p>';
	$html .= '	  </div>';
	$html .= '  </div>';
	$html .= '</div>';
	
	return apply_filters( 'yiw_sc_price_html', $html );
}          
endif;
add_shortcode("price", "yiw_sc_price_func");     


if ( ! function_exists( 'yiw_sc_price_last_func' ) ) :
/** 
 * TABLES PRICES LAST    
 * 
 * @description
 *    Create a box of prices.    
 * 
 * @example
 *   [price_last title="" price="" href="" buttontext="" color="white|red|grey|blue|green|yellow"]
 *       <li>feature 1</li>
 *       <li>feature 2</li>
 *       <li>feature 3</li>
 *       <li>feature 4</li> 
 *   [/price_last]   
**/
function yiw_sc_price_last_func($atts, $content = null) {        
	extract(shortcode_atts(array(
		"title" => '',
		"price" => '',
		"buttontext" => 'More info',
		"href" => '#',
		"color" => null
	), $atts));
	
	$html = do_shortcode("[price title=\"$title\" price=\"$price\" href=\"$href\" buttontext=\"$buttontext\" color=\"$color\" last=\"1\"]{$content}[/price]");
	
	return apply_filters( 'yiw_sc_price_last_html', $html );
}        
endif;
add_shortcode("price_last", "yiw_sc_price_last_func");          

?>