<?php
/**
 * Shortcodes for formatting the text on the pages.
 * 
 * @package WordPress
 * @subpackage YIW Themes
 */                                    


if ( ! function_exists( 'yiw_sc_clear_func' ) ) :
/** 
 * PRINT CLEAR     
 * 
 * @description
 *    Print a clear, to undo the floating   
 * 
 * @example
 *   [clear]
**/
function yiw_sc_clear_func($atts, $content = null) {
	$html = '<div class="clear"></div>';
	
	return apply_filters( 'yiw_sc_clear_html', $html );
}                          
endif;
add_shortcode("clear", "yiw_sc_clear_func");


if ( ! function_exists( 'yiw_sc_space_func' ) ) :
/** 
 * PRINT SPACE     
 * 
 * @description
 *    Print a clear, to undo the floating   
 * 
 * @example
 *   [space]
**/
function yiw_sc_space_func($atts, $content = null) {
	$html = '<div class="clear space"></div>';
	
	return apply_filters( 'yiw_sc_space_html', $html );
}                              
endif;
add_shortcode("space", "yiw_sc_space_func");


if ( ! function_exists( 'yiw_sc_border_func' ) ) :
/** 
 * PRINT BORDER     
 * 
 * @description
 *    Print a clear, to undo the floating   
 * 
 * @example
 *   [border]
**/
function yiw_sc_border_func($atts, $content = null) {
	$html = '<div class="border-line"></div>';
	
	return apply_filters( 'yiw_sc_border_html', $html );
}                       
endif;
add_shortcode("border", "yiw_sc_border_func");


if ( ! function_exists( 'yiw_sc_line_func' ) ) :
/** 
 * PRINT LINE     
 * 
 * @description
 *    Print a clear, to undo the floating   
 * 
 * @example
 *   [line]
**/
function yiw_sc_line_func($atts, $content = null) {
	$html = '<div class="clear line"></div>';
	
	return apply_filters( 'yiw_sc_line_html', $html );
}                      
endif;
add_shortcode("line", "yiw_sc_line_func");


if ( ! function_exists( 'yiw_sc_dropcap_func' ) ) :
/** 
 * DROPCAP     
 * 
 * @description
 *    Format content, with big first letter     
 * 
 * @example
 *   [dropcap]text[/dropcap]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_dropcap_func($atts, $content = null) {
	$html = "<p class=\"dropcap\">".do_shortcode($content)."</p>";
	
	return apply_filters( 'yiw_sc_dropcap_html', $html );
}                      
endif;
add_shortcode("dropcap", "yiw_sc_dropcap_func");


if ( ! function_exists( 'yiw_sc_quote_func' ) ) :
/** 
 * QUOTE     
 * 
 * @description
 *    Adds the content into a box quote    
 * 
 * @example
 *   [quote]text[/quote]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_quote_func($atts, $content = null) {
	$html = "<blockquote><p>".do_shortcode($content)."</p></blockquote>";
	
	return apply_filters( 'yiw_sc_quote_html', $html );
}                      
endif;
add_shortcode("quote", "yiw_sc_quote_func");


if ( ! function_exists( 'yiw_sc_highlight_func' ) ) :
/** 
 * HIGHLIGHT     
 * 
 * @description
 *    Text highlight    
 * 
 * @example
 *   [highlight]text[/highlight]
 * 
 * @attr  
 *   text - the text
**/
function yiw_sc_highlight_func($atts, $content = null) {
	$html = "<span class=\"highlight\">".do_shortcode($content)."</span>";
	
	return apply_filters( 'yiw_sc_highlight_html', $html );
}                      
endif;
add_shortcode("highlight", "yiw_sc_highlight_func");     

        
if ( ! function_exists( 'yiw_sc_b_func' ) ) :
/** 
 * BOLD       
 * 
 * @example
 *   [b]text[/b]
**/
function yiw_sc_b_func($atts, $content = null) {      
	$html = "<b>{$content}</b>";
	
	return apply_filters( 'yiw_sc_bhtml', $html );
}                 
endif;                                      
add_shortcode("b", "yiw_sc_b_func"); 

        
if ( ! function_exists( 'yiw_sc_strong_func' ) ) :
/** 
 * STRONG       
 * 
 * @example
 *   [strong]text[/strong]
**/
function yiw_sc_strong_func($atts, $content = null) {      
	$html = "<strong>{$content}</strong>";
	
	return apply_filters( 'yiw_sc_strong_html', $html );
}                   
endif;                                    
add_shortcode("strong", "yiw_sc_strong_func"); 

        
if ( ! function_exists( 'yiw_sc_i_func' ) ) :
/** 
 * ITALIC       
 * 
 * @example
 *   [i]text[/i]
**/
function yiw_sc_i_func($atts, $content = null) {      
	$html = "<i>{$content}</i>";
	
	return apply_filters( 'yiw_sc_i_html', $html );
}          
endif;                                             
add_shortcode("i", "i_func"); 

        
if ( ! function_exists( 'yiw_sc_em_func' ) ) :
/** 
 * ITALIC EM      
 * 
 * @example
 *   [em]text[/em]
**/
function yiw_sc_em_func($atts, $content = null) {      
	$html = "<em>{$content}</em>";
	
	return apply_filters( 'yiw_sc_em_html', $html );
}                
endif;                                       
add_shortcode("em", "yiw_sc_em_func"); 

        
if ( ! function_exists( 'yiw_sc_url_func' ) ) :
/** 
 * URL      
 * 
 * @example
 *   [url href="" title=""]text[/url]
**/
function yiw_sc_url_func($atts, $content = null) {       
	extract(shortcode_atts(array(
		"href" => '#',
		"title" => null
	), $atts));
	
	$href = esc_url( $href );
	    
	$html = "<a href=\"$href\" title=\"$title\">{$content}</a>";
	
	return apply_filters( 'yiw_sc_url_html', $html );
}                 
endif;                                      
add_shortcode("url", "yiw_sc_url_func"); 

        
if ( ! function_exists( 'yiw_sc_img_func' ) ) :
/** 
 * IMG      
 * 
 * @example
 *   [img src="" alt="" width="" height=""]
**/
function yiw_sc_img_func($atts, $content = null) {       
	extract(shortcode_atts(array(
		"src" => null,
		"alt" => false,
		"width" => false,
		"height" => false
	), $atts));
	
	if ( $width )
	   $width = ' width="'.$width.'"';
	
	if ( $height )
	   $height = ' height="'.$height.'"';
	
	$src = esc_url( $src );
	    
	$html = "<img src=\"$src\" alt=\"$alt\"{$width}{$height} />";
	
	return apply_filters( 'yiw_sc_img_html', $html );
}                 
endif;                                      
add_shortcode("img", "yiw_sc_img_func"); 

        
if ( ! function_exists( 'yiw_sc_size_func' ) ) :
/** 
 * IMG      
 * 
 * @example
 *   [size px="" perc="" em=""]text[/size]
**/
function yiw_sc_size_func($atts, $content = null) {       
	extract(shortcode_atts(array(
		"px" => null,
		"perc" => null,
		"em" => null
	), $atts));
	
	$size = '';
	
	if ( ! is_null( $px ) )
		$size = "{$px}px";
	
	if ( ! is_null( $perc ) )
		$size = "{$perc}%";
	
	if ( ! is_null( $em ) )
		$size = "{$em}em";
	    
	$html = '<span style="font-size:' . $size . ';">' . do_shortcode( $content ) . '</span>';
	                                   
	return apply_filters( 'yiw_sc_size_html', $html );
}                 
endif;                                      
add_shortcode("size", "yiw_sc_size_func"); 

        
if ( ! function_exists( 'yiw_sc_special_font_func' ) ) :
/** 
 * SPECIAL FONT   
 * 
 * @example
 *   [special_font size="" unit=""]text[/special_font]
**/
function yiw_sc_special_font_func($atts, $content = null) {             
	extract(shortcode_atts(array(
		"size" => null,
		"unit" => 'px'
	), $atts));
	
	$style = '';
	if ( ! is_null( $size ) )
		$style = ' style="font-size:' . $size . $unit . ';"';
	
	$html = '<span class="special-font"' . $style . '>' . do_shortcode( $content ) . '</span>';
	                                   
	return apply_filters( 'yiw_sc_special_font_html', $html );
}                 
endif;                                      
add_shortcode("special_font", "yiw_sc_special_font_func");  

?>