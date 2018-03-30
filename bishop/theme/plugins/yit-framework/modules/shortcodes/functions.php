<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Function for shortcodes
 *
 * @package Yithemes
 * @autor Francesco Licandro  <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */



if( ! function_exists( 'get_button_style' ) ){
    function get_button_style(){
        $style = (glob('../../../assets/css/buttons/*.css'));
        $del = array('../../../assets/css/buttons/', '.css');

        $button_style = array('' => 'Custom color');
        if ($style) {
            foreach ($style as $s) {
                $name = str_replace($del, '', $s);
                $button_style = array_merge( (array) $button_style, array($name => $name) );
            }
        }
        $button_style = array_unique($button_style);
        return $button_style;
    }
}

if( ! function_exists( 'get_awesome_icons' ) ){
    function get_awesome_icons(){
        $config = YIT_Plugin_Common::load();
        return $config['awesome_icons'];
    }
}

if( ! function_exists( 'yit_get_animate_effects' ) ){
    function yit_get_animate_effects(){
        $config = YIT_Plugin_Common::load();
        return $config['animate'];
    }
}

if( ! function_exists( 'get_set_icons' ) ){
    function get_set_icons(){
        $icons = (glob('../../../../images/icons/set_icons/*.png'));
        $del = array('../../../../images/icons/set_icons/', '32.png','48.png','.png');

        $set_icons = array('none' => 'none');
        if ($icons) {
            foreach ($icons as $ic) {
                $name = str_replace($del, '', $ic);
                $set_icons = array_merge( (array) $set_icons, array($name => $name) );
            }
        }
        $set_icons = array_unique($set_icons);
        return $set_icons;
    }
}

if( ! function_exists( 'yit_get_categories' ) ){
    function yit_get_categories( $show_all = false ){
        $cats = get_categories('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0');
        $categories = array();
        if( $show_all ){
            $categories['0'] = __('All categories', 'yit');
        }
        foreach ($cats as $cat) {
            $categories[$cat->slug] = ($cat->cat_name) ? $cat->cat_name : 'ID: '. $cat->cat_name;
        }
        return $categories;
    }
}


//SOUNDCLOUD

if( ! function_exists( 'soundcloud_oembed_params' ) ){
    function soundcloud_oembed_params( $embed, $params ) {
        global $soundcloud_oembed_params;
        $soundcloud_oembed_params = $params;
        return preg_replace_callback( '/src="(https?:\/\/(?:w|wt)\.soundcloud\.(?:com|dev)\/[^"]*)/i', 'soundcloud_oembed_params_callback', $embed );
    }
}

if( ! function_exists( 'soundcloud_oembed_params_callback' ) ){
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


// TWITTER

if( ! function_exists( 'yit_get_tweets' ) ){
    function yit_get_tweets( $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $limit){

        $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

        $oauth = array( 'oauth_consumer_key' => $consumer_key,
                        'oauth_nonce' => time(),
                        'oauth_signature_method' => 'HMAC-SHA1',
                        'oauth_token' => $oauth_access_token,
                        'oauth_timestamp' => time(),
                        'count' => $limit,
                        'oauth_version' => '1.0');

        $base_info = buildBaseString($url, 'GET', $oauth);
        $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature'] = $oauth_signature;


        $header = array(buildAuthorizationHeader($oauth), 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
                          CURLOPT_HEADER => false,
                          CURLOPT_URL => $url . '?count='.$limit,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();

        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);
        return json_decode($json);
    }
}

if( ! function_exists( 'buildBaseString' ) ){
    function buildBaseString($baseURI, $method, $params){
        $r = array();
        ksort($params);
        foreach($params as $key=>$value){
            $r[] = "$key=" . rawurlencode($value);
        }

        return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r)); //return complete base string
    }
}

if( ! function_exists( 'buildAuthorizationHeader' ) ){
    function buildAuthorizationHeader($oauth){
        $r = 'Authorization: OAuth ';
        $values = array();
        foreach($oauth as $key=>$value) {
            $values[] = "$key=\"" . rawurlencode($value) . "\"";
        }
        $r .= implode(', ', $values);
        return $r;
    }
}


if( !function_exists( 'yit_get_img' ) ) {
    /**
     * Retrieve tag image, get from relative path on param (without slash first)
     *
     * @since 1.0.0
     */
    function yit_get_img( $relative_path, $alt = '', $class = '' ) {
        $path = YIT_IMAGES_PATH . '/' . $relative_path;
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

if( !function_exists( 'yit_get_sidebar_layout') ) {
    /**
     * Retrieve sidebar layout for the current post.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_sidebar_layout() {
        global $yit_sidebar_layout, $is_extra_content;

        if ( isset( $is_extra_content ) && $is_extra_content )
        { return 'sidebar-no'; }

        return $yit_sidebar_layout[ 'layout' ];
    }
}

/*
 * print single item of contact info
 *
 * @return void
 * @since 1.0
 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 */
if (! function_exists("yit_get_contact_info_item")){
    function yit_get_contact_info_item($name_icon,$text,$value){
        if ( isset ($value) && $value != '' ){
            ?>
            <li>
                <?php if ( isset ($name_icon) && ($name_icon != '' && $name_icon != 'None' ) ) :  ?>
                    <div class="icon-container"><i class="fa fa-<?php echo $name_icon; ?> shade-1" ></i></div>
                <?php endif; ?>
                <div class="info-container"><?php echo '<strong>' . $text . ':</strong>' .$value ?> </div>
            </li>
        <?php
        }
    }
}

/*
* print single item of contact info
*
* @return void
* @since 2.0
* @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
*/
if (! function_exists("yit_hex2rgb")){
    function yit_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);

        return implode(",", $rgb); // returns the rgb values separated by commas

    }
}

/*
 * print a description of the time elapsed since the argument date
 *
 * @return string
 * @since 2.0
 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 */
if(!function_exists("yit_get_date_diff")){

    function yit_get_date_diff($datetime){

        $time=strtotime($datetime);
        $diff=time()-$time;
        $diff/=60;
        $var1=floor($diff);
        $var=$var1<=1 ? __('min','yit') : __('mins','yit');
        if($diff>=60){
            $diff/=60;
            $var1=floor($diff);
            $var=$var1<=1 ? __('hr','yit') : __('hrs','yit');
        }
        if($diff>=24){
            $diff/=24;
            $var1=floor($diff);
            $var=$var1<=1 ? __('day','yit') : __('days','yit');
        }
        if($diff>=30.4375){
            $diff/=30.4375;
            $var1=floor($diff);
            $var=$var1<=1 ? __('month','yit') : __('months','yit');
        }
        if($diff>=12){
            $diff/=12;
            $var1=floor($diff);
            $var=$var1<=1 ? __('year','yit') : __('years','yit');
        }

        return $var1.' '.$var.' '.__('ago','yit');
    }

}

