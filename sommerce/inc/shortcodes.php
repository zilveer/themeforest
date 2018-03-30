<?php
/**
 * Additional shortcodes for the theme.
 * 
 * To create new shortcode, get for example the shortcode [sample] already written.
 * Replace it with your code for shortcode and for other shortcodes, duplicate the first
 * and continue following.
 * 
 * CONVENTIONS: 
 * - The name of function MUST be: yiw_sc_SHORTCODENAME_func.
 * - All html output of shortcode, must be passed by an hook: apply_filters( 'yiw_sc_SHORTCODENAME_html', $html ).
 * NB: SHORTCODENAME is the name of shortcode and must be written in lowercase.    
 * 
 * For example, we'll add new shortcode [sample], so:
 * - the function must be: yiw_sc_sample_func().
 * - the hooks to use will be: apply_filters( 'yiw_sc_sample_html', $html ).   
 * 
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0 
 */                     


/** 
 * BOXED CONTENT 
 * 
 * @description
 *    show a box with title and optional description, near the main content 
 * 
 * @example
 *   [boxed_content title="" description="" [class=""]]text[/boxed_content]
 * 
 * @attr  
 *   class (optional) - class of container of box call to action (optional) @default: 'call-to-action'
 *   title  - the title of the box
 *   description - the text below title  
**/
function yiw_sc_boxed_content_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'class' => 'boxed-content',
        'title' => null,
        'description' => null,
    ), $atts));        
	
	$html = ''; // this is the var to use for the html output of shortcode
	
	$html .= '<div class="' . $class . ' group">';    
		
		$html .= '<div class="box-title group">';
	
			$html .= yiw_string_( '<h3>', $title, '</h3>', false );
			$html .= yiw_string_( '<p>', $description, '</p>', false ); 
		
		$html .= '</div>';
		
		$html .= '<div class="box-content group">';
		
			$html .= do_shortcode( $content );
		
		$html .= '</div>';
	
	$html .= '</div>';
    
    return apply_filters( 'yiw_sc_boxed_content_html', $html );   // this must be written for each shortcode
}
add_shortcode('boxed_content', 'yiw_sc_boxed_content_func');

/** 
 * CALL TO ACTION 
 * 
 * @description
 *    Shows a box witth an incipit and a number phone   
 * 
 * @example
 *   [call_two label_button="" href=""]
 * 
 * @attr  
 *   class - class of container of box call to action (optional) @default: 'call-to-action'
 *   href  - url of button
 *   title  - the title of call to action
**/
function yiw_sc_call_two_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'class' => 'call-to-action-two',
        'label_button' => null,
        'href' => null
    ), $atts));     
	
	$content = do_shortcode( $content );   
    
    $html = "<div class=\"$class group\">
				<div class=\"incipit\">
					<p class=\"special-font\">$content</p>
				</div>
				<a href=\"$href\" class=\"call-button\">
					$label_button		
				</a>
			</div>";          
    
    return apply_filters( 'yiw_sc_call_two_html', $html );
}           
add_shortcode('call_two', 'yiw_sc_call_two_func'); 

/** 
 * READ MORE 
 * 
 * @description
 *    Show the general read more button   
 * 
 * @example
 *   [read_more href=""]label[/read_more]
**/
function yiw_sc_read_more_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'href' => '#',
        'target' => null
    ), $atts));     
	
	$content = do_shortcode( $content );
    
    if( !is_null( $target ) )
        { $target = "target=\"$target\""; }
    else
        { $target = ''; }   
    
    $html = "<a class=\"read-more\" $target href=\"$href\">$content</a>";          
    
    return apply_filters( 'yiw_sc_read_more_html', $html );
}           
add_shortcode('read_more', 'yiw_sc_read_more_func'); 

/** 
 * CREDIT CARD 
 * 
 * @description
 *    Show the icons for the credit cards   
 * 
 * @example
 *   [credit cards="paypal,visa,mastercard,amex,cirrus"]
**/
function yiw_sc_credit_func($atts, $content = null) 
{
    extract(shortcode_atts(array(
        'cards' => 'paypal,visa,mastercard,amex,cirrus'
    ), $atts));      
    
    $cards = explode( ',', $cards );
    
    $html = '';
    foreach ( $cards as $card ) {
        $card = trim($card);
        $html .= "<img src=\"" . get_template_directory_uri() . "/images/credit-cards/$card.png\" alt=\"$card\" style=\"margin-right:8px\" />"; 
    }         
    
    return apply_filters( 'yiw_sc_credit_html', '<span style="padding-left:10px;">' . $html . '</span>' );
}           
add_shortcode('credit', 'yiw_sc_credit_func'); 

/** 
 * LOGO 
 * 
 * @description
 *    Show a simple text with the same font of logo   
 * 
 * @example
 *   [logo]text[/logo]
**/
function yiw_sc_logo_func($atts, $content = null) 
{
    $html = "<span class=\"logo\">$content</span>";          
    
    return apply_filters( 'yiw_sc_logo_html', $html );
}           
add_shortcode('logo', 'yiw_sc_logo_func'); 

/** 
 * testimonials   
 * 
 * @description
 *    Show all post on testimonials post types    
 * 
 * @example
 *   [testimonials items=""]
 *   
 * @params
 *      items - number of item to show   
 * 
**/

function yiw_sc_testimonials_func($atts, $content = null) {        
    extract(shortcode_atts(array(
        "items" => null
    ), $atts));    

    wp_reset_query();    

    $args = array(
        'post_type' => 'bl_testimonials'  
    );

    $args['posts_per_page'] = ( !is_null( $items ) ) ? $items : -1;

    $tests = new WP_Query( $args );   

    $html = '';

    if( !$tests->have_posts() ) return $html;

    //loop         
    $html = '';
    while( $tests->have_posts() ) : $tests->the_post();

        $title = the_title( '<span class="title">', '</span>', false );
        $website = get_post_meta( get_the_ID(), '_testimonial_website', true ); 
        $label = get_post_meta( get_the_ID(), '_testimonial_label', true ) ? get_post_meta( get_the_ID(), '_testimonial_label', true ) : str_replace('http://', '', $website); 
        if ( ! empty( $website ) )
            $website = "<a href=\"" . esc_url( $website ) . "\">". $label  ."</a>"; 
        else
            $website = $label;    
        
        $thumb = get_the_post_thumbnail( null, 'thumb_testimonial' );
        $class_thumb = ( has_post_thumbnail() && ! empty( $thumb ) ) ? '' : ' no-thumb';  

        $html .= '<div class="testimonials-list' . $class_thumb . ' group">'; 

        $html .= '  <div class="thumb-testimonial group">';    
        $html .= '      ' . $thumb;   
        //$html .= '      <div class="shadow-thumb"></div>'; 
        $html .= '      <p class="name-testimonial group">' . $title . '<br /><span class="website">' . $website . '</span></p>'; 
        $html .= '  </div>'; 

        $content = wpautop( get_the_content() );

        $html .= '  <div class="the-post group">';    
        $html .= '      ' . $content; 
        $html .= '  </div>';               

        $html .= '</div>';

    endwhile;          

    return apply_filters( 'yiw_sc_testimonials_html', $html );
}       
add_shortcode("testimonials", "yiw_sc_testimonials_func");

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
	
	$html = "<a href=\"$href\" class=\"$width $color sc-button\">$content</a>";
	
	return apply_filters( 'yiw_sc_button_html', $html );
}     

/** 
 * TABS     
 * 
 * @description
 *    Create a content with tabs.    
 * 
 * @example
 *   [tabs {ID}1={TITLE}1 {ID}2={TITLE} ... {ID}n={TITLE}n]
 *       [tab id="{ID}"]Text[/tab]
 *       [tab id="{ID}"]Text[/tab]
 *   [/tabs]
 * 
 * @attr  
 *   {ID} - the ID of tab
 *   {TITLE} - the title of tab
 *   id - the id of each tab    
 *   text - the text
**/
function yiw_sc_tabs_func($atts, $content = null) {       
    
    $html = '<div class="tabs-container">'."\n";
    $html .= '    <ul class="tabs">'."\n";
    
    $i = 1;
    foreach($atts as $id => $title)
    {
        //if( !preg_match('/tab([0-9]{2})/', $attr) ) continue;
        
        $html .= '<li><a href="#'.$id.'" title="'.$title.'">'.$title.'</a></li>'."\n";
        
        $i++;
    }
    
    $html .= '    </ul>'."\n";
    
    $html .= '<div class="border-box group">' . do_shortcode($content) . '</div>';
    
    $html .= '</div>'."\n";
    
    return apply_filters( 'yiw_sc_tabs_html', $html );
}

/**
 * SHARE
 *
 * @description
 *    Scroll to the latest slide
 *
 * @example
 *   [share socials="facebook, twitter, googleplus, pinterest"]
 *
 * @params
 *      title - the title to show after the arrow icon
 *
**/
function yiw_sc_share_func($atts, $content = null) {
    extract(shortcode_atts(array(
        'title'   => yiw_get_option( 'share_title', __( 'love it, share it!', 'yiw' ) ),
        'socials' => yiw_get_option( 'share_socials', 'facebook, twitter' /* 'facebook, twitter, google, pinterest, bookmark' */ ),
    ), $atts));    
    
    ob_start();
    
    echo '<div class="socials">';
    if ( ! empty( $title ) ) echo '<h2>' . $title . '</h2>';
                                                 
    $socials = array_map( 'trim', explode( ',', $socials ) );        
    $socials_accepted = array( 'facebook', 'twitter'/* , 'google', 'pinterest' , 'bookmark' */ );
                                                        
    foreach ( $socials as $i => $social ) {
        if ( in_array( $social, $socials_accepted ) ) {     
                
            $url = $script = $attrs = '';
            
            $title_post = urlencode( get_the_title() );
            $permalink = urlencode( get_permalink() );
            $excerpt = urlencode( get_the_excerpt() );
                
            if ( $social == 'facebook' ) {
                $url = apply_filters( 'yiw_share_facebook', 'https://www.facebook.com/sharer.php?u=' . $permalink . '&t=' . $title_post . '' );
                
            } else if ( $social == 'twitter' ) {
                $url = apply_filters( 'yiw_share_twitter', 'https://twitter.com/share?url=' . $permalink . '&text=' . $title_post . '' );
                
            }/*  else if ( $social == 'google' ) {
                $url = apply_filters( 'yiw_share_google', 'https://plus.google.com/share?url=' . $permalink . '&title=' . $title_post . '' ); 
                
            } else if ( $social == 'pinterest' ) {
                $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url = apply_filters( 'yiw_share_pinterest', 'http://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $src[0] . '&description=' . $excerpt );
                $attrs = ' onclick="window.open(this.href); return false;"';
                   
            } else if ( $social == 'bookmark' ) {
                $url = get_permalink();
                $attrs = ' title="' . urldecode( $title_post ) . '"';
            } */
            
            echo do_shortcode( '[social type="' . $social . '" href="' . $url . '"' . $attrs . ' target="_blank"]' );
            echo $script;
        }
    }                         
    echo '</div>';
    
    $html = ob_get_clean();

    return apply_filters( 'yiw_sc_share_html', $html );
}
add_shortcode("share", "yiw_sc_share_func");
?>