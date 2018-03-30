<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
if( !function_exists( 'yit_locate_template' ) ) {
    /**
     * Locate the templates and return the path of the file found
     *
     * @param string $path
     * @param array $var
     * @return void
     * @since 1.0.0
     */
    function yit_locate_template( $path, $var = NULL ){
        $path = ltrim( $path, '/' );
    	$theme_path = str_replace( YIT_THEME_PATH . '/', '', YIT_THEME_TEMPLATES_DIR . '/' . $path );    
    	$core_path  = str_replace( YIT_THEME_PATH . '/', '', YIT_CORE_TEMPLATES_DIR  . '/' . $path );
    	
    	// use locate_template for the child theme
    	$located = locate_template( array(            
    	    // theme/templates/$path
            $theme_path,      
            
            // core/templates/$path
            $core_path
        ) );
                               
        return $located;
    }
}
 
if( !function_exists( 'yit_get_template' ) ) {
    /**
     * Display html templates
     *
     * @param string $path
     * @param array $var
     * @param bool $return
     * @return void
     * @since 1.0.0
     */
    function yit_get_template( $path, $var = NULL, $return = false ) {    
        global $yit;
        //yit_debug( $path );
        
        $located = yit_locate_template( $path, $var );
        
        if ( empty( $located ) ) {
            return;
        }     
        
        if ( $var && is_array( $var ) ) 
    		extract( $var );
                               
        if( $return )
            { ob_start(); }   
                                                                     
        // include file located
        include( $located );
        
        if( $return )
            { return ob_get_clean(); }
    }
}

if( !function_exists( 'yit_string' ) ) {
    /** 
     * Simple echo a string, with a before and after string, only if the main string is not empty.
     *  
     * @param string $before What there is before the main string  
     * @param string $string The main string. If it is empty or null, the functions return null.
     * @param string $after What there is after the main string
     * @param bool $echo If echo or only return it
     * @return string The complete string, if the main string is not empty or null
     * @since 1.0.0 
     */ 
    function yit_string( $before = '', $string = '', $after = '', $echo = true ) {
        $html = '';
        
    	if( $string != '' AND !is_null( $string ) ) {
    		$html = $before . $string . $after;
        }
    	
    	if( $echo ) {
    		echo $html;
        }
    	
    	return $html;
    }
} 

if( !function_exists( 'yit_split_title' ) ) {
    /** 
     * Split a string from the words within the brackets
     * 
     * E.G.
     * string: my title [with subtitle]
     * return: array(
     *      [title] => 'my title',
     *      [subtitle] => 'with subtitle' 
     * )    
     *  
     * @param string $title The string to convert
     * @param string $pattern The pattern where decide how split
     * @return array An array with the two string splitted
     * 
     * @since 1.0  
     */ 
    function yit_split_title( $title, $pattern = '/(.*)\[(.*)\]/' )
    {
        $return = array();
        
        if( preg_match($pattern, $title, $t, PREG_OFFSET_CAPTURE) )
        {
            $return['title'] = $t[1][0];
            $return['subtitle'] = $t[2][0];
        }
        else
        {
            $return['title'] = $title;
            $return['subtitle'] = '';   
        }
        
        return $return;
    }   
}     

if( !function_exists( 'yit_title_special_characters' ) ) {
    /** 
     * The chars used in yit_decode_title() and yit_encode_title()
     * 
     * E.G.
     * string: This is [my title] with | a new line
     * return: This is <span class="highlight">my title</span> with <br /> a new line  
     *  
     * @param  string  $title The string to convert
     * @return string  The html 
     * 
     * @since 1.0  
     */ 
    function yit_title_special_characters( $chars )
    {
        return array_merge( $chars, array(
            '/[=\[](.*?)[=\]]/' => '<span class="title-highlight">$1</span>',
            '/\|/' => '<br />',
        ) );
    }   
}   

if( !function_exists( 'yit_decode_title' ) ) {
    /** 
     * Change some special characters to put easily html into a string
     * 
     * E.G.
     * string: This is [my title] with | a new line
     * return: This is <span class="title-highlight">my title</span> with <br /> a new line  
     *  
     * @param  string  $title The string to convert
     * @return string  The html 
     * 
     * @since 1.0  
     */ 
    function yit_decode_title( $title )
    {
        $replaces = apply_filters( 'yit_title_special_characters', array() );
        
        return preg_replace( array_keys( $replaces ), array_values( $replaces ), $title );
    }   
}   

if( !function_exists( 'yit_encode_title' ) ) {
    /** 
     * Change some special characters to put easily html into a string
     * 
     * E.G.
     * string: This is [my title] with | a new line
     * return: This is <span class="title-highlight">my title</span> with <br /> a new line  
     *  
     * @param  string  $title The string to convert
     * @return string  The html 
     * 
     * @since 1.0  
     */ 
    function yit_encode_title( $title )
    {
        $replaces = apply_filters( 'yit_title_special_characters', array() );
        
        return preg_replace( array_values( $replaces ), array_keys( $replaces ), $title );
    }   
}   

if( !function_exists( 'yit_remove_chars_title' ) ) {
    /** 
     * Change some special characters to put easily html into a string
     * 
     * E.G.
     * string: This is [my title] with | a new line
     * return: This is <span class="title-highlight">my title</span> with <br /> a new line  
     *  
     * @param  string  $title The string to convert
     * @return string  The html 
     * 
     * @since 1.0  
     */ 
    function yit_remove_chars_title( $title )
    {
        $replaces = apply_filters( 'yit_title_special_characters', array() );
        
        return preg_replace( array_keys( $replaces ), '$1', $title );
    }   
}                               

if( !function_exists( 'yit_addp' ) ) {
    /**
     * Add the paragraphs to the string, without damage the shortcodes
     * 
     * @param string $str The string to convert
     * @return string The string converted   
     * 
     * @since 1.0                
     */  
    function yit_addp($str) {
        $sc_pattern = '[a-zA-Z0-9_-]+';
        $str = wpautop( $str );
        $str = preg_replace( '/<\/?p>(\[(.*)\])<\/?p>/', '$1', $str );    // <p>[sc]</p>
        $str = preg_replace( '/(\['.$sc_pattern.'\])[ ]*<\/?p>/', '$1', $str );       // [/sc]</p>
        $str = preg_replace( '/(\[(.*)\])<br \/>/', '$1', $str );         // [/sc]<br />
        $str = preg_replace( '/<\/?p>(\['.$sc_pattern.')/', '$1', $str );           // <p>[sc
        $str = preg_replace( '/(=")<br \/>\n/', '$1', $str );           // ="<br />
        $str = preg_replace( '/\n<\/?p>(")/', '$1', $str );           // <p>"
        $str = do_shortcode( $str );

        return apply_filters( 'yit_addp', $str );
    }
}                  

if( !function_exists( 'yit_clean_text' ) ) {
    /**
     * Replace the default get_the_content, managing better the shortcodes
     * 
     * @param string $str The string to convert
     * @return string The string converted   
     * 
     * @since 1.0                
     */  
    function yit_clean_text( $str ) {
        $str = yit_addp( stripslashes( $str ) );
        
        $str = prepend_attachment($str);
        
        return $str;
    } 
}      
        
if( !function_exists( 'yit_video_type_by_url' ) ) {
    /** 
     * Retrieve the type of video, by url
     * 
     * @param string $url The video's url 
     * @return mixed A string format like this: "type:ID". Return FALSE, if the url isn't a valid video url.
     * 
     * @since 1.0  
     */ 
    function yit_video_type_by_url( $url ) {
        $parsed = parse_url( esc_url( $url ) );
    
        switch ( $parsed['host'] ) :
        
            case 'www.youtube.com' :
                $id = yit_get_yt_video_id( $url );
                return "youtube:$id";
            
            case 'vimeo.com' :      
                preg_match( '/http:\/\/(\w+.)?vimeo\.com\/(.*)/', $url, $matches );
                $id = $matches[2];
                return "vimeo:$id";
            
            default :
                return false;
        
        endswitch;
    }  
}     
            
if( !function_exists( 'yit_get_yt_video_id' ) ) {
    /** 
     * Retrieve the id video from youtube url
     * 
     * @param string $url The video's url 
     * @return string The youtube id video
     * 
     * @since 1.0  
     */ 
    function yit_get_yt_video_id( $url ) {
        if ( preg_match( '/http:\/\/youtu.be/', $url, $matches) ) {
            $url = parse_url($url, PHP_URL_PATH);
            $url = str_replace( '/', '', $url);
            return $url;
         
        } elseif ( preg_match( '/watch/', $url, $matches) ) {
            $arr = parse_url($url);
            $url = str_replace( 'v=', '', $arr['query'] );
            return $url;
         
        } elseif ( preg_match( '/http:\/\/www.youtube.com\/v/', $url, $matches) ) {
            $arr = parse_url($url);
            $url = str_replace( '/v/', '', $arr['path'] );
            return $url;
         
        } elseif ( preg_match( '/http:\/\/www.youtube.com\/embed/', $url, $matches) ) {
            $arr = parse_url($url);
            $url = str_replace( '/embed/', '', $arr['path'] );
            return $url;
         
        } elseif ( preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=[0-9]/)[^&\n]+|(?<=v=)[^&\n]+#", $url, $matches) ) {
            return $matches[0];
         
        } else {
            return false;
        }
    }
}    

if ( !function_exists( 'yit_post_id' ) ) {
    /**
     * Retrieve the post id
     * 
     * @return integer
     * @since 1.0.0
     */
    function yit_post_id() {
        global $post; 
        
        $post_id = 0;
        if ( is_posts_page() ) $post_id = get_option( 'page_for_posts' );
        elseif ( function_exists( 'is_shop' ) && ( is_shop() || is_product_category() ) ) $post_id = function_exists('wc_get_page_id') ? wc_get_page_id( 'shop' ) : woocommerce_get_page_id( 'shop' );
        elseif ( isset( $post->ID ) ) $post_id = $post->ID;
        
        return $post_id;
    }
}                   

if( !function_exists( 'yit_avoid_duplicate' ) ) {
    /**
     * Check if something exists. If yes, add a -N to the value where N is a number.
     * 
     * @param mixed $value
     * @param array $array
     * @param string $check
     * @return mixed
     * @since 1.0.0
     */
    function yit_avoid_duplicate( $value, $array, $check = 'value' ) {
        $match = array();
        
        if( !is_array( $array ) ) {
            return $value;
        }
     
        if ( ( $check == 'value' && ! in_array( $value, $array ) ) || ( $check == 'key' && ! isset( $array[$value] ) ) ) {
            return $value;
        } else {
            if ( ! preg_match( '/([a-z]+)-([0-9]+)/', $value, $match ) ) {
                $i = 2;
            } else {
                $i = intval( $match[2] ) + 1;
                $value = $match[1];
            }
            
            return yit_avoid_duplicate( $value . '-' . $i, $array, $check );
        }
    }
}

if( !function_exists( 'yit_sidebar_args' ) ) {
    /**
     * Create the standard set of arguments for creating new sidebar
     * 
     * @param string $name The main name of sidebar
     * @param string $description (optional) Description of sidebar
     * @param string $widget_class (optional) The widget class
     * @param string $title (optional) The tag to use for the titles
     * @return array The set of arguments for creating the sidebar
     * 
     * @since 1.0.0            
     */   
    function yit_sidebar_args( $name, $description = '', $widget_class = 'widget', $title = 'h3' ) {   
        $id = strtolower( str_replace( ' ', '-', $name ) );
        
        return array (
            'name' => $name,
            'id' => $id,
            'description' => $description,
            'before_widget' => '<div id="%1$s" class="' . $widget_class . ' %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<' . $title . '>',
            'after_title' => '</' . $title . '>',
        );
    }
}

if( !function_exists( 'yit_get_img' ) ) {
   /** 
 	* Retrieve tag image, get from relative path on param (without slash first)
 	* 
 	* @since 1.0.0  
 	*/ 
	function yit_get_img( $relative_path, $alt = '', $class = '' ) {     
	    $path = YIT_IMAGES . '/' . $relative_path;	    
	    $class = ( $class != '' ) ? 'class="'. $class . '" ' : '';
				
		$url = YIT_THEME_PATH . '/images/' . $relative_path;
    	
		if ( !file_exists($url) ) return false;
	    
	    if ( is_readable($url) && function_exists( 'getimagesize' ) ) {   
	        $img = getimagesize( $path );	    	
			if ( $img ) {
	            return '<img src="' . YIT_IMAGES_URL . '/' . $relative_path . '" alt="'. $alt . '" ' . $class . $img[3] . '/>';
	        }
	    } else
	        return '<img src="' . YIT_IMAGES_URL . '/' . $relative_path . '" alt="'. $alt . '" ' . $class .'/>';
	    
	    return '';
	}
}

if( !function_exists( 'yit_content' ) ) {
    /**
     * Return post content with read more link (if needed)
     * 
     * @param int|string $limit
     * @param string $more_text
     * 
     * @return string
     */
    function yit_content( $what = 'content', $limit = 25, $more_text = '', $split = '[...]' ) {        
        if ( $what == 'content' )
            { $content = get_the_content('[...]'); } 
        else if ( $what == 'excerpt' )    
            { $content = get_the_excerpt(); }  
        else
            { $content = $what; }
            
        if ( $limit == 0 ) {   
            if ( $what == 'content' ) {      
                $content = preg_replace( '/<img[^>]+./', '', $content ); //remove images
                $content = apply_filters( 'the_content', $content );    
                $content = str_replace( ']]>', ']]&gt;', $content );
            } elseif ( $what == 'excerpt' ) {
                $content = apply_filters('the_excerpt', $content );
            } else {
                $content = yit_addp( $content );
            }
            return $content;
        }
        
        // remove the tag more from the content
        if ( preg_match( "/<(a)[^>]*class\s*=\s*(['\"])more-link\\2[^>]*>(.*?)<\/\\1>/", $content, $matches ) ) {
            
            if( strpos( $matches[0], '[button' ) )
                { $more_link = str_replace( 'href="#"', 'href="' . get_permalink() . '"', do_shortcode( $matches[3] ) ); }
            else
                { $more_link = $matches[0]; }
            
            $content = str_replace( $more_link, '', $content );
            $split = '';
        }
            
        if ( empty( $content ) ) return;
        $content = explode( ' ', $content );
        
        if ( ! empty( $more_text ) && ! isset( $more_link ) ) {
            //array_pop( $content );
            $more_link = strpos( $more_text, '<a class="btn"' ) ? $more_text : '<a class="read-more' . apply_filters( 'yit_simple_read_more_classes', ' ' ) . '" href="' . get_permalink() . '">' . $more_text . '</a>';
            $split = '';
        } elseif ( ! isset( $more_link ) ) {
            $more_link = '';
        }
        
        // split
        if ( count( $content ) >= $limit ) {  
            $split_content = '';
            for ( $i = 0; $i < $limit; $i++ )
                $split_content .= $content[$i] . ' ';
            
            $content = $split_content . $split; 
        } else {
            $content = implode( " ", $content );
        }    
        
        // TAGS UNCLOSED
        $tags = array();
        // get all tags opened
        preg_match_all("/(<([\w]+)[^>]*>)/", $content, $tags_opened, PREG_SET_ORDER);    
        foreach ( $tags_opened as $tag )
            $tags[] = $tag[2];
            
        // get all tags closed and remove it from the tags opened.. the rest will be closed at the end of the content
        preg_match_all("/(<\/([\w]+)[^>]*>)/", $content, $tags_closed, PREG_SET_ORDER);
        foreach ( $tags_closed as $tag )
            unset( $tags[ array_search( $tag[2], $tags ) ] );
        
        // close the tags
        if ( ! empty( $tags ) )
            foreach ( $tags as $tag )
                $content .= "</$tag>";     
                                        
        //$content = preg_replace( '/\[.+\]/', '', $content );
        $content = preg_replace( '/<img[^>]+./', '', $content ); //remove images
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );           // echo str_replace( array( '<', '>' ), array( '&lt;', '&gt;' ), $content );            
        return $content.$more_link;
    }
}         

if ( ! function_exists( 'yit_text_truncate' ) ) {
    /**
     * Truncate the text in base of characters limit
     * 
     * @since 1.0                
     */  
    function yit_text_truncate( $what = 'content', $limit, $split_text = '...' ) {
        if ( $what == 'content' )
            { $content = get_the_content('[...]'); } 
        else if ( $what == 'excerpt' )    
            { $content = get_the_excerpt(); }  
        else
            { $content = $what; }
        
        // don't truncate, if it's not necessary
        if ( strlen( $content ) <= $limit ) {
            return $content;
        }
        
        $content = substr($content, 0, $limit) . ' ' . $split_text;
        
        return $content;
    }       
}

if ( ! function_exists( 'yit_curPageURL' ) ) {
    /**
     * Retrieve the current complete url
     * 
     * @since 1.0                
     */  
    function yit_curPageURL() {
    	$pageURL = 'http';
    	if ( isset( $_SERVER["HTTPS"] ) AND $_SERVER["HTTPS"] == "on" ) 
    		$pageURL .= "s";
    	
    	$pageURL .= "://";
    	
    	if ( isset( $_SERVER["SERVER_PORT"] ) AND $_SERVER["SERVER_PORT"] != "80" ) 
    		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    	else
    		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    	
    	return $pageURL;
    }         
}                

if ( ! function_exists( 'yit_post_id_from_slug' ) ) {
    /**
     * Get the post ID of a post, from its slug
     * 
     * @since 1.0                
     */  
    function yit_post_id_from_slug( $slug, $post_type = 'post' ) {
        global $wpdb;
        
        $ID = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '$slug' AND post_type = '$post_type'" );  
        if ( ! empty( $ID ) ) {
            return $ID;
        } else {
            return 0;
        }
    }         
} 

if ( ! function_exists( 'yit_post_slug_from_id' ) ) {
    /**
     * Get the post ID of a post, from its slug
     * 
     * @since 1.0                
     */  
    function yit_post_slug_from_id( $post_id ) {
        $post = get_post( $post_id );
        if ( isset( $post->post_name ) ) {
            return $post->post_name;
        } else {
            return null;
        }
    }         
}

if ( ! function_exists( 'yit_load_buttons_style' ) ) {
    /**
     * Get the CSS style for button only if is necessary
     * 
     * @since 1.0                
     */  
    function yit_load_buttons_style() {
	    global $post, $wpdb;
                          
        $content = isset( $post->post_content ) ? $post->post_content : '';   
        
        $to_check = array( $content, stripslashes( serialize( yit_get_model('panel')->db_options ) ) );    
        
        // postmeta
        $postmetas = $wpdb->get_col( "SELECT meta_value FROM $wpdb->postmeta" ); //yit_debug($widgets);
        foreach ( $postmetas as $postmeta )
            $to_check[] = $postmeta;  
        
        // widgets
        $widgets = $wpdb->get_col( "SELECT option_value FROM $wpdb->options WHERE option_name LIKE 'widget_%'" ); //yit_debug($widgets);
        foreach ( $widgets as $widget_text )
            $to_check[] = $widget_text;
            
        $to_check = stripslashes_deep( apply_filters( 'yit_sc_button_include_content', $to_check ) );
                                                                             //yit_debug($to_check);
        $content = implode( ' ', $to_check );                                           
                                                           
        $regex = '\[button ([^\[\]]*?)color=["|\']([a-z0-9-]+)["|\']([^\[\]]*?)\]([^\[\]]+)\[\/button\]';
        if ( preg_match_all( "/$regex/", $content, $matches ) ) {
            //yit_debug($matches);
            foreach ( $matches[2] as $color ) {
                if ( ! file_exists( dirname(__FILE__) . "/../core/assets/css/buttons/$color.css" ) ) continue;
                //yit_wp_enqueue_style( 1210, "yit_button-$color", YIT_CORE_ASSETS_URL . "/css/buttons/$color.css" );
				wp_enqueue_style( "button-$color", YIT_CORE_ASSETS_URL . "/css/buttons/$color.css", array('styles-minified'));
            }   
        }
	}
}

if( !function_exists( 'yit_theme_get_excluded_categories' ) ) {
    /**
     * Retrieve the escluded categories, set on Theme Options
     * 
     * @return string String with all id categories excluded, separeted by a comma
     * @since 1.0                
     */  
    function yit_theme_get_excluded_categories( $k = 1 ) {
        $cats = yit_get_option( 'blog-cats-exclude' );
        
        if( !is_array( $cats ) || empty( $cats ) || !isset($cats[1]) )
            { return; }
        
        $cats = array_map( 'trim', $cats[$k] );       

        $i = 0; $query = '';
        foreach( $cats as $cat ) {
            $query .= ",-$cat";
            
            $i++;
        }
        
        ltrim( ',', $query );
        
        return $query;
    }
}

if( !function_exists( 'yit_sc_more_link' ) ) {
    /**
     * Replace the simple read more text for the home with a button if needed
     * 
     * @since 1.0
     */  
	function yit_sc_more_link( $more_link, $more_link_text, $more_url = false ) {
		$more_url = $more_url ? $more_url : get_permalink(); 
	    if( substr( $more_link_text, 0, 7 ) == '[button' ) {
	        $more_link_text = str_replace( array( "'", '[button' ), array( '"', '[button class="btn-more-link" href="' . $more_url . '"' ), $more_link_text );
	        
	        return '<br />' . do_shortcode( stripslashes( $more_link_text ) );
	    }
	    
	    return $more_link;
	}
}                       

if ( ! function_exists( 'yit_widget_first_last_classes' ) ) {
    /**
     * Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
     * 
     * @since 1.0.0  
     */
    function yit_widget_first_last_classes($params) {
    
        global $my_widget_num; // Global a counter array
        $this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
        $arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets  
    
        if(!$my_widget_num) {// If the counter array doesn't exist, create it
            $my_widget_num = array();
        }
    
        if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
            return $params; // No widgets in this sidebar... bail early.
        }
    
        if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
            $my_widget_num[$this_id] ++;
        } else { // If not, create it starting with 1
            $my_widget_num[$this_id] = 1;
        }
    
        $class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options
    
        if($my_widget_num[$this_id] == 1) { // If this is the first widget
            $class .= 'widget-first ';
        } elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
            $class .= 'widget-last ';
        }
    
        $params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"
    
        return $params;
    
    }   
}


if( !function_exists( 'yit_browser_body_class' ) ) {
    /**
     * Add the browser class to the body
     * 
     * @param array $classes
     * @return array
     * @since 1.0.0
     */
    function yit_browser_body_class($classes) {
    	global $is_lynx, $is_gecko, $is_opera, $is_NS4, $is_safari, $is_chrome;
    
    	if($is_lynx) $classes[] = 'lynx';
    	elseif($is_gecko) $classes[] = 'gecko';
    	elseif($is_opera) $classes[] = 'opera';
    	elseif($is_NS4) $classes[] = 'ns4';
    	elseif($is_safari) $classes[] = 'safari';
    	elseif($is_chrome) $classes[] = 'chrome';
        
        $yit_mobile = yit_get_model( 'mobile' );
        
        if ( $yit_mobile->isMobile() ) {
    
            $classes[] = 'isMobile';
            if     ( $yit_mobile->isAndroid() )          $classes[] = 'android';
            elseif ( $yit_mobile->isAndroidtablet() )    $classes[] = 'android-tablet';
            elseif ( $yit_mobile->isIphone() )           $classes[] = 'iphone';
            elseif ( $yit_mobile->isIpad() )             $classes[] = 'ipad';
            elseif ( $yit_mobile->isBlackberry() )       $classes[] = 'blackberry';
            elseif ( $yit_mobile->isBlackberrytablet() ) $classes[] = 'blackberry-tablet';
            elseif ( $yit_mobile->isWindows() )          $classes[] = 'windows';
            elseif ( $yit_mobile->isWindowsphone() )     $classes[] = 'windows-phone';
            elseif ( $yit_mobile->isGeneric() )          $classes[] = 'generic';
        
        }
    	return $classes;
    }
}


if( !function_exists( 'yit_body_background' ) ) {
    /**
     * Define the body background for the page. 
     * 
     * First get the setting for the current page. If a setting is not defined 
     * in the current page, will be get the setting from the theme options.
     * All css will be shown in head tag, by the action 'wp_head'                    
     * 
     * @since 1.0.0
     */
    function yit_body_background() {
        $post_id = yit_post_id();
        
        // get color and background from postmeta
        $color = yit_get_post_meta( $post_id, '_bg_color', true );
        $image = yit_get_post_meta( $post_id, '_bg_image', true );
        
        // get the color and background from theme options, if above are empty
        $background = yit_get_option('background-style');
        if ( empty( $image ) && empty( $color ) ) {
            $image = $background['image'];
            if ( $image == 'custom' ) {
                $image = yit_get_option('bg_image');
            }
        }
        
        if ( empty( $color ) ) {
            $color = $background['color'];
        }
                                                        
        $image_repeat     = yit_get_option('bg_image_repeat');
        $image_position   = yit_get_option('bg_image_position');
        $image_attachment = yit_get_option('bg_image_attachment');     
        
        $css = array();

        if ( ! empty( $color ) )                     { $css[] = "background-color: $color;"; }
        if ( ! empty( $image ) && $image != 'none' ) { $css[] = "background-image: url('$image');"; }
        
        if ( ! empty( $image ) && ! empty( $image_repeat ) )     { $css[] = "background-repeat: $image_repeat;"; }
        if ( ! empty( $image ) && ! empty( $image_position ) )   { $css[] = "background-position: $image_position;"; }
        if ( ! empty( $image ) && ! empty( $image_attachment ) ) { $css[] = "background-attachment: $image_attachment;"; }
        
        if ( empty( $css ) ) return;
        
        ?>
        <style type="text/css">
            body { <?php echo implode( ' ', $css ) ?> }      
        </style>
        <?php
    }
}

if( !function_exists( 'yit_excerpt_text' ) ) {
    /**
     * Cut the text
     * 
     * @param string $text
     * @param int $excerpt_length
     * @param string $excerpt_more
     * @return string
     * @since 1.0.0
     */
    function yit_excerpt_text( $text, $excerpt_length = 50, $excerpt_more = '' ) {
        $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    	if ( count($words) > $excerpt_length ) {
    		array_pop($words);
    		$text = implode(' ', $words);
    		$text = $text . $excerpt_more;
    	} else {
    		$text = implode(' ', $words);
    	}
    	
    	echo $text;
    }
}                

if ( ! function_exists( 'yit_ssl_url' ) ) {     
    /**
     * Force the URL to https://, if we are in SSL
     * 
     * @since 1.0.0
     */                               
    function yit_ssl_url( $url ) {
        if ( is_ssl() )
    		$url = str_replace( 'http://', 'https://', $url );
    	
    	return $url;
    }
} 

if ( ! function_exists( 'yit_is_writable' ) ) {     

    /**
     * Check if a file/folder is writable. If not, the function
	 * tries to make it writable. 
     * 
     * @since 1.0.0
     */                               
    function yit_is_writable( $file, $mode = 'auto' ) {
		if( is_writable( $file ) ) {
			return true;
		} else {
			if( $mode == 'auto' ) {
				if( is_dir($file) ) {
					$mode = 0755;
				} else {
					$mode = 0644;
				}
			}

			return @chmod($file, $mode);
		}
	}
}

if ( ! function_exists( 'yit_file_put_contents' ) ) {     
    /**
     * Write a content into a file
     * 
     * @since 1.0.0
     */                               
    function yit_file_put_contents( $file, $content ) {
    	
		if( yit_is_writable( dirname( $file ) ) ) {
			return file_put_contents( $file, $content );
		} else {
			return false;
		}
		
		/*
        global $wp_filesystem;
        
        if ( ! isset( $wp_filesystem ) ) {
            require_once(ABSPATH . 'wp-admin/includes/admin.php');
        }            
        
        ob_start();
    	$url = wp_nonce_url('admin.php?page=yit_panel','yit-theme-options');
    	if ( false === ($credentials = request_filesystem_credentials($url)) ) {
    		$data = ob_get_contents();
    		ob_end_clean();
    		if ( ! empty($data) ){
    			include_once( ABSPATH . 'wp-admin/includes/screen.php');
    			include_once( ABSPATH . 'wp-admin/admin-header.php');
    			echo $data;
    			include( ABSPATH . 'wp-admin/admin-footer.php');
    			exit;
    		}
    		return;
    	}
    
    	if ( ! WP_Filesystem($credentials) ) {
    		request_filesystem_credentials($url, '', true); //Failed to connect, Error and request again
    		$data = ob_get_contents();
    		ob_end_clean();
    		if ( ! empty($data) ){                              
    			include_once( ABSPATH . 'wp-admin/includes/screen.php');
    			include_once( ABSPATH . 'wp-admin/admin-header.php');
    			echo $data;
    			include( ABSPATH . 'wp-admin/admin-footer.php');
    			exit;
    		}
    		return;
    	}
    	
    	$wp_filesystem->put_contents($file, $content, FS_CHMOD_FILE);
		*/
    }
}

if( !function_exists( 'yit_get_registered_nav_menus' ) ) {
    /**
     * Retireve all registered menus
     * 
     * @return array
     * @since 1.0.0
     */
    function yit_get_registered_nav_menus() {
        $menus = get_terms( 'nav_menu' );
        $return = array();
        
        foreach( $menus as $menu ) {
            array_push( $return, $menu->name );
        }
        
        return $return;
    }
}

if( !function_exists( 'yit_array_splice_assoc' ) ) {
    /**
     * Insert element before of a specific array position
     * 
     * @return array
     * @since 1.0.0
     */
	function yit_array_splice_assoc( &$source, $need, $previous ) {
	    $return = array();
	    
	    foreach( $source as $key => $value ) {
	        if( $key == $previous ) {
                $need_key = array_keys( $need );
                $key_need = array_shift( $need_key );
	            $value_need = $need[$key_need];
	            
	            $return[$key_need] = $value_need;
	        }
	        
	        $return[$key] = $value;
	    }
	    
	    $source = $return;
	}
}


if( !function_exists( 'yit_unregister_post_type' ) ) {
    /**
     * Disable a custom post type
     * 
     * @return array
     * @since 1.0.0
     */
	 function yit_unregister_post_type( $post_type ) {
	        global $wp_post_types;
			global $menu;
			
	        if ( post_type_exists( $post_type ) ) {
	            unset( $wp_post_types[ $post_type ] );
				
				if( $menu != null ) {
					remove_menu_page( 'edit.php?post_type=' . $post_type );
				}
		        
	            return true;
	        }
	        return false;
	 }
}

if( !function_exists( 'yit_enqueue_blog_styles' ) ) {
    /**
     * Enqueue all blog styles
     * 
     * @return void
     * @since 1.0.0
     */
     function yit_enqueue_blog_styles() {
        $dir = get_template_directory() . "/theme/templates/blog/";
        $dir_url = get_template_directory_uri() . "/theme/templates/blog/";
        
        $blogs = scandir( $dir );
        
        // ./ and ../
        unset( $blogs[0], $blogs[1] );
        
        foreach( $blogs as $blog ) {
            if( is_dir( $dir . $blog ) && file_exists( $dir . $blog . '/css/style.css' ) )
                { yit_wp_enqueue_style( 100, 'blog-' . $blog, $dir_url . $blog . '/css/style.css' ); }
        }
     }
}

if( !function_exists( 'yit_get_span_from_width' ) ) {
    /**
     * Return the span class
     * 
     * @return void
     * @since 1.0.0
     */
     function yit_get_span_from_width( $width ) {
            if ( $width < 150  ) return 1;      
        elseif ( $width < 270  ) return 2;       
        elseif ( $width < 370  ) return 3;      
        elseif ( $width < 470  ) return 4;      
        elseif ( $width < 570  ) return 5;      
        elseif ( $width < 670  ) return 6;      
        elseif ( $width < 770  ) return 7;      
        elseif ( $width < 870  ) return 8;      
        elseif ( $width < 970  ) return 9;      
        elseif ( $width < 1070 ) return 10;     
        elseif ( $width < 1170 ) return 11;      
                            else return 12;      
     }
}

if( !function_exists( 'yit_width_of_span' ) ) {
    /**
     * Return the width of span, relative to 1170px screen size
     * 
     * @return void
     * @since 1.0.0
     */
     function yit_width_of_span( $span ) {
        switch( $span ) {
        
            case 1  : return 70;
            case 2  : return 170;
            case 3  : return 270;
            case 4  : return 370;
            case 5  : return 470;
            case 6  : return 570;
            case 7  : return 670;
            case 8  : return 770;
            case 9  : return 870;
            case 10 : return 970;
            case 11 : return 1070;
            case 12 : return 1170;
        
        }     
     }
}

if( !function_exists( 'yit_delete_cache_ajax' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_delete_cache_ajax() {
        ?>
        <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            
            $( '#delete-cache' ).click( function( e ) {
                e.preventDefault();
                $('#add-items-ajax-loading-1').css('visibility', 'visible');
                
                var data = {
                    action : 'delete_cache',
                    die: 1
                };
                
                //console.log( 'Deleting cache...' );
                
                $.post( ajaxurl, data, function( response ) {
                    $('#add-items-ajax-loading-1').hide();
                    $( 'body' ).append( response );
                    $( '.messages-global').css( {
            	       'position' : 'fixed',
                       'top' : '50%',
                       'left': '37%',
                       'z-index' : '9999',
                       'padding' : '30px'
            	    } );
                    
                    $( '.messages-global' ).fadeIn().delay( 3000 ).fadeOut();
                } );
            } );
        } );
        </script>
        <?php
    }   
}

if( !function_exists( 'yit_delete_cache_callback' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_delete_cache_callback() {
        $dir = get_template_directory() . '/cache/';
        
        $echo = true;
        if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'install_sampledata' ) $echo = false;
        
        if( is_dir( $dir ) ) {
            
            $files = scandir( $dir );
            
            unset( $files[0], $files[1] );

            foreach( $files as $file ) {
                if( !@unlink( $dir . $file ) && $echo ) {
                    yit_get_model( 'message' )->addMessage( __( 'Error. Unable to delete the cache!', 'yit' ), 'error' );
                    yit_get_model( 'message' )->printGlobalMessages();

                    if( isset($_POST['die'])) {
                        die();
                    }
                }
            }
        }
		
		//regenerate the custom.css file
		yit_save_css();
		
		if ( $echo ) {
            if( isset($_POST['die'])) {
            	//ajax call
    	        yit_get_model( 'message' )->addMessage( __( 'Cache deleted successfully!', 'yit' ) );
    	        yit_get_model( 'message' )->printGlobalMessages();
    
              	die();
            } else {
            	//theme update
    	        yit_get_model( 'message' )->addMessage( __( 'Theme updated successfully!', 'yit' ) );
    	        yit_get_model( 'message' )->printGlobalMessages();
            }
        }
    }
}

if( !function_exists( 'yit_reset_theme_options_ajax' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_reset_theme_options_ajax() {
        ?>
        <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            
            $( '#reset-theme-options' ).click( function( e ) {
                e.preventDefault();
                $('#add-items-ajax-loading-2').css('visibility', 'visible');
                
                var data = {
                    action : 'reset_theme_options'
                };
                
                console.log( 'Deleting theme options...' );
                
                $.post( ajaxurl, data, function( response ) {
                    $('#add-items-ajax-loading-2').hide();
                    $( 'body' ).append( response );
                    $( '.messages-global').css( {
            	       'position' : 'fixed',
                       'top' : '50%',
                       'left': '37%',
                       'z-index' : '9999',
                       'padding' : '30px'
            	    } );
                    
                    $( '.messages-global' ).fadeIn().delay( 3000 ).fadeOut();
                } );
            } );
        } );
        </script>
        <?php
    }   
}

if( !function_exists( 'yit_reset_theme_options_callback' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_reset_theme_options_callback() {
        global $wpdb;
        
        $options = $wpdb->get_row( "SELECT `option_value` FROM `{$wpdb->options}` WHERE `option_name` = 'yit_panel_options_" . YIT_THEME_NAME . "'", ARRAY_N );
        $options = maybe_unserialize( $options[0] );
        
        $custom_sidebars = array();
        $custom_sidebars['custom-sidebars'] = $options['custom-sidebars'];
        
        if( $wpdb->update( $wpdb->options, array( 'option_value' => maybe_serialize( $custom_sidebars ) ), array( 'option_name' => 'yit_panel_options_' . YIT_THEME_NAME ) ) ) {
            yit_get_model( 'message' )->addMessage( __( 'Theme Options resetted successfully!', 'yit' ) );
        } else {
            yit_get_model( 'message' )->addMessage( __( 'Error. Unable to reset the theme options!', 'yit' ) . ' SQL ERROR: ' . $wpdb->last_error, 'error' );
        }

		yit_save_css();
        
        yit_get_model( 'message' )->printGlobalMessages();
        die();
    }
}

if( !function_exists( 'yit_delete_custom_sidebars_ajax' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_delete_custom_sidebars_ajax() {
        ?>
        <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            
            $( '#delete-custom-sidebars' ).click( function( e ) {
                e.preventDefault();
                $('#add-items-ajax-loading-3').css('visibility', 'visible');
                
                var data = {
                    action : 'delete_custom_sidebars'
                };
                
                console.log( 'Deleting custom sidebars...' );
                
                $.post( ajaxurl, data, function( response ) {
                    $('#add-items-ajax-loading-3').hide();
                    $( 'body' ).append( response );
                    $( '.messages-global').css( {
            	       'position' : 'fixed',
                       'top' : '50%',
                       'left': '37%',
                       'z-index' : '9999',
                       'padding' : '30px'
            	    } );
                    
                    $( '.messages-global' ).fadeIn().delay( 3000 ).fadeOut();
                } );
            } );
        } );
        </script>
        <?php
    }   
}

if( !function_exists( 'yit_delete_resized_images_ajax' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_delete_resized_images_ajax() {
        ?>
        <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            
            $( '#delete-resized-images' ).click( function( e ) {
                e.preventDefault();
                $('#add-items-ajax-loading-4').css('visibility', 'visible');
                
                var data = {
                    action : 'delete_resized_images'
                };
                
                //console.log( 'Deleting resized images...' );
                
                $.post( ajaxurl, data, function( response ) {
                    $('#add-items-ajax-loading-4').hide();
                    $( 'body' ).append( response );
                    $( '.messages-global').css( {
            	       'position' : 'fixed',
                       'top' : '50%',
                       'left': '37%',
                       'z-index' : '9999',
                       'padding' : '30px'
            	    } );
                    
                    $( '.messages-global' ).fadeIn().delay( 3000 ).fadeOut();
                } );
            } );
        } );
        </script>
        <?php
    }   
}

if( !function_exists( 'yit_delete_custom_sidebars_callback' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_delete_custom_sidebars_callback() {
        global $wpdb;
        
        $options = $wpdb->get_row( "SELECT `option_value` FROM `{$wpdb->options}` WHERE `option_name` = 'yit_panel_options_" . YIT_THEME_NAME . "'", ARRAY_N );
        $options = maybe_unserialize( $options[0] );
        $options['custom-sidebars'] = array();
        
        if( $wpdb->update( $wpdb->options, array( 'option_value' => maybe_serialize( $options ) ), array( 'option_name' => 'yit_panel_options_' . YIT_THEME_NAME ) ) ) {
            yit_get_model( 'message' )->addMessage( __( 'Custom Sidebars deleted successfully!', 'yit' ) );
        } else {
            yit_get_model( 'message' )->addMessage( __( 'Error. Unable to delete custom sidebars!', 'yit' ) . ' SQL ERROR: ' . $wpdb->last_error, 'error' );
        }
        
        yit_get_model( 'message' )->printGlobalMessages();
        die();
    }
}

if( !function_exists( 'yit_delete_resized_images_callback' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_delete_resized_images_callback() {
        global $wpdb;
        
        $count = array( 'success' => 0, 'error' => 0 );
        $uploads = wp_upload_dir();
        $uploads_dir = $uploads['basedir'];
        foreach ( scandir($uploads_dir) as $yfolder ) {
            if ( ! ( is_dir( "$uploads_dir/$yfolder" ) && ! in_array( $yfolder, array( '.', '..' ) ) ) ) continue;
            
            $yfolder = basename( $yfolder );
            foreach ( scandir("$uploads_dir/$yfolder") as $mfolder ) {
                if ( ! ( is_dir( "$uploads_dir/$yfolder/$mfolder" ) && ! in_array( $mfolder, array( '.', '..' ) ) ) ) continue;
                
                $mfolder = basename( $mfolder );
                $images = (array)glob("$uploads_dir/$yfolder/$mfolder/*-*x*.*");
                foreach ( $images as $image ) {
                    $filename = basename( $image );
                    if ( ! preg_match( '/([0-9]{1,4})x([0-9]{1,4}).(jpg|jpeg|png|gif)/', $filename ) ) continue;
                    
                    if ( unlink( $image ) ) {
                        $count['success']++;
                    } else {
                        $count['error']++;
                    }
                }
            }
        }
        
        if( $count['error'] == 0 ) {
            yit_get_model( 'message' )->addMessage( __( $count['success'] . ' images deleted!', 'yit' ) );
        } else {
            yit_get_model( 'message' )->addMessage( __( 'Error. Unable to delete the images!', 'yit' ), 'error' );
        }
        
        yit_get_model( 'message' )->printGlobalMessages();
        die();
    }
}

if( !function_exists( 'yit_install_sampledata_ajax' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_install_sampledata_ajax() {
        ?>
        <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            
            $( '#install-sampledata' ).click( function( e ) {
                var accept = confirm('<?php _e( 'Are you sure you want to install sample data? All current data entered on your site will be overwritten/lost', 'yit' ) ?>');
                if ( accept ) {

                    //console.log( 'Importing sample data' );

                    e.preventDefault();
                    $('.ajax-loading').css('visibility', 'visible');

                    var data = {
                        action : 'install_sampledata'
                    };

                    $.post( ajaxurl, data, function( response ) {
                        console.log( response );

                        $('.ajax-loading').hide();
                        $( 'body' ).append( response );
                        $( '.messages-global').css( {
                           'position' : 'fixed',
                           'top' : '50%',
                           'left': '37%',
                           'z-index' : '9999',
                           'padding' : '30px'
                        } );

                        $( '.messages-global' ).fadeIn().delay( 3000 ).fadeOut();
                    } );
                }
                else {
                    return false;
                }
            } );
        } );
        </script>
        <?php
    }   
}

if( !function_exists( 'yit_install_sampledata_callback' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
    function yit_install_sampledata_callback() {
    	global $wpdb;
        $gz = YIT_THEME_ASSETS_DIR . '/sample-data/' . YIT_THEME_NAME . '.gz';
        
        if( file_exists( $gz ) ) {
            require_once( YIT_CORE_LIB . '/yit/Backup/Backup.php' );
            
            if( YIT_Backup::import_backup( $gz ) ) {
                yit_get_model( 'message' )->addMessage( __( 'Sample data installed correctly!', 'yit' ) );
            } else {
                yit_get_model( 'message' )->addMessage( __( 'Error. Unable to install sample data!', 'yit' ) . ' SQL ERROR: ' . $wpdb->last_error, 'error' );
            }
        } else {
            yit_get_model( 'message' )->addMessage( __( 'Error. The file ' . $gz . ' does not exists!', 'yit' ), 'error' );   
        }
        
        yit_get_model( 'message' )->printGlobalMessages();
        die();
    }
}

if( !function_exists( 'yit_confirm_sample_data' ) ) {
    /**
     * @return void
     * @since 1.0.0
     */
function yit_confirm_sample_data() {
    ?>
    <script type="text/javascript">
        jQuery( document ).ready( function( $ ) {
            $( '#yit_tabs_backup_backup_import .button' ).click( function( e ) {
                var accept = confirm('<?php _e( 'Are you sure you want to install sample data? All current data entered on your site will be overwritten/lost', 'yit' ) ?>');
                return accept;
            });
        } );
    </script>
<?php
}
}

if( !function_exists( 'soundcloud_oembed_params' ) ) {
    /**
     * @return string
     * @since 1.0.0
     */
    function soundcloud_oembed_params( $embed, $params ) {
	    global $soundcloud_oembed_params;
	    $soundcloud_oembed_params = $params;
	    return preg_replace_callback( '/src="(https?:\/\/(?:w|wt)\.soundcloud\.(?:com|dev)\/[^"]*)/i', 'soundcloud_oembed_params_callback', $embed );
	}
}

if( !function_exists( 'soundcloud_oembed_params_callback' ) ) {
    /**
     * @return string
     * @since 1.0.0
     */
    function soundcloud_oembed_params_callback( $match ) {
	    global $soundcloud_oembed_params;
	    
	    // Convert URL to array
	    $url = parse_url( urldecode( $match[1] ) );
	    // Convert URL query to array
	    parse_str( $url['query'], $query_array );
	    // Build new query string
	    $query = http_build_query( array_merge( $query_array, $soundcloud_oembed_params ) );
	    
	    $search  = array( 'show_artwork=0', 'show_artwork=1', 'auto_play=0', 'auto_play=1', 'show_comments=0', 'show_comments=1' );
	    $replace = array( 'show_artwork=false', 'show_artwork=true', 'auto_play=false', 'auto_play=true', 'show_comments=false', 'show_comments=true' );
	    
	    $query = str_replace( $search, $replace, $query );
	    
	    return 'src="' . $url['scheme'] . '://' . $url['host'] . $url['path'] . '?' . $query;
	}
}


if( !function_exists('yit_user_roles') ) {
	/**
	 * Returns the roles of the user
	 *
	 * @param int $user_id (Optional) The ID of a user. Defaults to the current user.
	 * @return array()
	 * @since 1.0.0
	 */
	function yit_user_roles( $user_id = null ) {
	    if ( is_numeric( $user_id ) )
			$user = get_userdata( $user_id );
	    else
	        $user = wp_get_current_user();
	 
	    if ( empty( $user ) )
			return false;
	 
	    return (array) $user->roles;
	}
}

if( !function_exists('yit_wp_roles') ) {
	/**
	 * Returns the roles of the site.
	 *
	 * @return array
	 * @since 1.0.0
	 */
	function yit_wp_roles() {
		global $wp_roles;
		
		if ( ! isset( $wp_roles ) ) $wp_roles = new WP_Roles();
		
		$roles = array();
        if( isset( $wp_roles->roles ) && is_array( $wp_roles->roles ) ) {
            foreach( $wp_roles->roles as $k=>$role ) {
                $roles[$k] = $role['name'];
            }
        }
		
		return $roles;
	}
}

if( !function_exists( 'yit_get_admin_post_type' ) ) {
    /**
     * Return the current post type of the admin.
     *
     * @return null|string
     */
    function yit_get_admin_post_type() {
        global $post, $typenow, $current_screen;

        //we have a post so we can just get the post type from that
        if ( $post && $post->post_type ) {
            return $post->post_type;
        }
        //check the global $typenow - set in admin.php
        elseif( $typenow ) {
            return $typenow;
        }
        //check the global $current_screen object - set in sceen.php
        elseif( $current_screen && $current_screen->post_type ) {
            return $current_screen->post_type;
        }
        //lastly check the post_type querystring
        elseif( isset( $_REQUEST['post_type'] ) ) {
            return sanitize_key( $_REQUEST['post_type'] );
        }

        return null;
    }
}

if( !function_exists( 'shortcode_exists' ) ) {
    /**
     * Whether a registered shortcode exists named $tag
     * (this function will be added in the wordpress 3.6 version)
     *
     * @global array $shortcode_tags
     * @param string $tag
     * @return boolean
     */
    function shortcode_exists($tag) {
        global $shortcode_tags;
        return array_key_exists($tag, $shortcode_tags);
    }
}

if( !function_exists( 'yit_strip_protocol' ) ) {
    /**
     * Remove the protocol from an URL.
     * This is to avoid conflicts with SSL
     *
     * @param string $url
     * @param bool $esc_url
     * @return string
     */
    function yit_strip_protocol( $url, $esc_url = true ) {
        if( $esc_url ) { $url = esc_url( $url ); }

        return preg_replace( '/http(s)?:/', '', $url );
    }
}

if( !function_exists( 'yit_is_safari_on_mavericks' ) ) {
    function yit_is_safari_on_mavericks() {
        if( isset( $_SERVER["HTTP_USER_AGENT"] ) ) {
            $user_agent = $_SERVER["HTTP_USER_AGENT"];
            $is_mavericks = strpos( $user_agent, 'Intel Mac OS X 10_9') !== false;
            $is_safari = strpos( $user_agent, 'Safari' ) !== false;
            $is_chrome = strpos( $user_agent, 'Chrome' ) !== false;

            return $is_mavericks && $is_safari && !$is_chrome;
        }
    }
}

if ( ! function_exists( 'yit_is_blog' ) ) {
    /**
     * Detect if the current page is a blog page
     *
     * @author   Andrea Frascaspata  <andrea.frascaspata@yithemes.com>
     * *
     * @return boolean
     * @since 2.5.0
     */
    function yit_is_blog() {
        return ( ( is_page_template( 'blog.php' ) || is_home() || is_archive() || is_search() || is_category() || is_tag() ) && get_post_type( get_the_ID() ) != 'forum' ) ? true : false;
    }
}

if( !function_exists( 'yit_remove_wp_admin_bar' ) ) {
    /**
     * Remove the wp admin bar in frontend if user is logged in
     *
     *
     * @return string  The html
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @since 2.0
     */
    function yit_remove_wp_admin_bar() {

        if ( yit_get_option( 'general-lock-down-admin' ) == 1 &&  ( ( defined('YIT_DEBUG') && ! YIT_DEBUG ) ) || ! defined( 'YIT_DEBUG' )  || ! current_user_can( 'manage_options' )  ){
            //if ( yit_get_option( 'general-lock-down-admin' ) == 1 &&  ! current_user_can( 'manage_options' ) ){
            add_filter( 'show_admin_bar', '__return_false' );
        }
    }
}

if ( ! function_exists( 'yit_wpml_register_string' ) ) {
    /**
     * Register a string in wpml trnslation
     *
     * @param string
     * @param string
     * @param string
     *
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yit_wpml_register_string( $context , $name , $value  ) {
        // wpml string translation
        do_action( 'wpml_register_single_string', $context, $name, $value );
    }
}

if ( ! function_exists( 'yit_wpml_string_translate' ) ) {
    /**
     * Get a string translation
     *
     * @param string
     * @param string
     * @param string
     *
     * @return string the string translated
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yit_wpml_string_translate( $context, $name, $default_value ) {
        return apply_filters( 'wpml_translate_single_string', $default_value, $context, $name );
    }
}

if ( !function_exists( 'yit_theme_remove_unused_template' ) ) {

    /**
     * @param $dir
     * @param $option
     * @param $files
     *
     * @authot Andrea Frascaspata
     */
    function yit_theme_remove_unused_template( $dir, $option, $files ) {

        if ( get_option( $option ) === false ) {

            $error_removed = false;

            $path = get_template_directory();

            foreach ( $files as $file ) {

                $file = $path . '/' . $dir . '/' . $file;

                if ( file_exists( $file ) ) {
                    if ( !unlink( $file ) ) {
                        $error_removed = true;
                        break;
                    }
                }

            }

            if ( !$error_removed ) {
                add_option( $option, 'yes' );
            }

        }

    }
}
