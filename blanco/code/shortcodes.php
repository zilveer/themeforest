<?php
add_shortcode('etheme_bestsellers', 'etheme_bestsellers_shortcodes');
function etheme_bestsellers_shortcodes($atts, $content=null){
	if ( !class_exists('WP_eCommerce') ) return false;
	extract(shortcode_atts(array( 
		'image_width' => 220, 
		'image_height' => 220,
        'title' => __('Bestsellers', ETHEME_DOMAIN)
	), $atts));  
	global $wpdb;
    
    $sql = "select prodid, count(prodid) as prodnum from " . $wpdb->prefix. "wpsc_cart_contents group by prodid order by prodnum desc";
    $ids = $wpdb->get_results($sql);
	foreach( $ids as $id ):
	   $post_in[] = $id->prodid;
    endforeach;
        if ( !isset($post_in) && empty($post_in) ) {
            $post_in = '';
        }
    $args = array(
    	'post_type'				=> 'wpsc-product',
    	'ignore_sticky_posts'	=> 1,
    	'no_found_rows' 		=> 1,
    	'posts_per_page' 		=> 20,
        'post__in'              => $post_in
    );  
    
    ob_start();
    etheme_create_slider($args,$title);
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}

add_shortcode('etheme_featured', 'etheme_featured_shortcodes');
function etheme_featured_shortcodes($atts, $content=null){
	global $wpdb;
	if ( !class_exists('Woocommerce') ) return false;
    
	extract(shortcode_atts(array( 
		'image_width' => 220, 
		'image_height' => 220,
		'limit' => 20,
        'title' => __('Featured Products', ETHEME_DOMAIN)
	), $atts)); 
    
    $key = '_featured';
    
    $post_type = 'wpsc-product';
    if(class_exists('Woocommerce')) {
        $args = apply_filters('woocommerce_related_products_args', array(
        	'post_type'				=> 'product',
            'meta_key'              => $key,
            'meta_value'            => 'yes',
        	'ignore_sticky_posts'	=> 1,
        	'no_found_rows' 		=> 1,
        	'posts_per_page' 		=> $limit
        ) );
    }

    ob_start();
    etheme_create_slider($args,$title);
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}
add_shortcode('etheme_new', 'etheme_new_shortcodes');
function etheme_new_shortcodes($atts, $content=null){
	global $wpdb;
	if ( !class_exists('WP_eCommerce') && !class_exists('Woocommerce') ) return false;
    
	extract(shortcode_atts(array( 
		'image_width' => 220, 
		'image_height' => 220,
		'limit' => 20,
        'title' => __('New Products', ETHEME_DOMAIN)
	), $atts)); 
    
    $key = '_etheme_new_label';
    
    $post_type = 'wpsc-product';
    if(class_exists('Woocommerce')) {
        $args = apply_filters('woocommerce_related_products_args', array(
        	'post_type'				=> 'product',
            'meta_key'              => $key,
            'meta_value'            => 1,
        	'ignore_sticky_posts'	=> 1,
        	'no_found_rows' 		=> 1,
        	'posts_per_page' 		=> $limit
        ) );
    }
     
    if (class_exists('WP_eCommerce')){
        $args = array(
        	'post_type'				=> 'wpsc-product',
            'meta_key'              => $key,
            'meta_value'            => 1,
        	'ignore_sticky_posts'	=> 1,
        	'no_found_rows' 		=> 1,
        	'posts_per_page' 		=> 20
        );  
    }
    ob_start();
    etheme_create_slider($args,$title);
    $output = ob_get_contents();
    ob_end_clean();
    
    return $output;
}

add_shortcode('etheme_contacts', 'etheme_contacts_shortcodes');
function etheme_contacts_shortcodes($atts, $content=null){
    $a = shortcode_atts( array(
       'gmap' => 1
   ), $atts );
if(isset($_GET['contactSubmit'])){
	$emailFrom = strip_tags($_GET['contactEmail']);
	$emailTo = etheme_get_option('contacts_email');
	$subject = strip_tags($_GET['contactSubject']);

	$name = strip_tags($_GET['contactName']); 
	$email = strip_tags($_GET['contactEmail']); 
	$message = strip_tags(stripslashes($_GET['contactMessage'])); 

	$body = "Name: ".$name."\n";
	$body .= "Email: ".$email."\n";
	$body .= "Message: ".$message."\n";
	$body .= $name.", ".$emailFrom."\n";

	$headers = "From $emailFrom ". PHP_EOL;
	$headers .= "Reply-To: $emailFrom". PHP_EOL;
	$headers .= "MIME-Version: 1.0". PHP_EOL;
	$headers .= "Content-type: text/plain; charset=utf-8". PHP_EOL;
	$headers .= "Content-Transfer-Encoding: quoted-printable". PHP_EOL;

	if(isset($_GET['contactSubmit'])){
		$success = wp_mail($emailTo, $subject, $body, $headers);
		if ($success){
		echo '<p class="yay">All is well, your e&ndash;mail has been sent.</p>';
		} 
	} else {
		echo '<p class="oops">Something went wrong</p>';
	}
} else {
    if($a['gmap'] == 1):
    wp_enqueue_script('google.maps', 'http://maps.google.com/maps/api/js?sensor=false');
    wp_enqueue_script('gmap', get_template_directory_uri().'/js/jquery.gmap.min.js');
?>

    <div id="map">
        <p>Enable your JavaScript!</p>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function(){
        	var $map = jQuery('#map');    
        	if( $map.length ) {    
        		$map.gMap({
        			address: '<?php etheme_option('google_map'); ?>',
        			zoom: 16,
        			markers: [
        				{ 'address' : '<?php etheme_option('google_map'); ?>' }
        			]
        		});    
        	}  
        });
    </script>
    <?php endif; ?>
    <?php if(etheme_option('contacts_custom_html') != ''): ?>
    <div class="custom-html">
        <?php echo etheme_option('contacts_custom_html') ?>
    </div>
    <?php endif; ?>
    <div class="one-third">      
        <div id="contactsMsgs"></div>  
        <form action="<?php the_permalink(); ?>" method="POST" class="form" id="ethemeContactForm">   
            <div class="formField">
                <label for="contactName"><?php _e('Name', ETHEME_DOMAIN); ?> <span class="required">*</span></label>
                <input type="text" class="textField required-field" name="contactName" id="contactName" />
                <div class="clear"></div>
            </div>
            <div class="formField">
                <label for="contactEmail"><?php _e('Email', ETHEME_DOMAIN); ?> <span class="required">*</span></label>
                <input type="text" class="textField required-field email" name="contactEmail" id="contactEmail" />
                <div class="clear"></div>
            </div>
            <div class="formField">
                <label for="contactSubject"><?php _e('Subject', ETHEME_DOMAIN); ?></label>
                <input type="text" class="textField" name="contactSubject" id="contactSubject" />
                <div class="clear"></div>
            </div>
            <div class="formField">
                <label for="contactMessage"><?php _e('Message', ETHEME_DOMAIN); ?> <span class="required">*</span></label>
                <textarea class="textField required-field" name="contactMessage" id="contactMessage" cols="30" rows="10"></textarea>
                <div class="clear"></div>
            </div>
            <div class="formField ">
                <button class="button" name="contactSubmit" type="submit"><span><?php _e('Send Request', ETHEME_DOMAIN); ?></span></button>
                <div class="contactSpinner"></div>
            </div>
        </form>      
    </div>
    <div class="one-third last fl-r">
        <div class="block non-line contats">
            <?php etheme_option('contacts_info'); ?>
        </div>
    </div>
<?php
}
}


add_shortcode('etheme_template_url', 'etheme_template_url_shortcode');
function etheme_template_url_shortcode(){
    return get_template_directory_uri();
}

add_shortcode('etheme_base_url', 'etheme_base_url_shortcode');
function etheme_base_url_shortcode(){
    return home_url();
}



/** ------------------------------------------------- 
/*	Typography shortcodes 
/* -------------------------------------------------- */

/**	Buttons */

add_shortcode('etheme_btn', 'etheme_btn_shortcode');
function etheme_btn_shortcode($atts){
    $a = shortcode_atts( array(
       'title' => 'Button',
       'url' => '#',
       'class' => '',
       'big' => 0,
       'active' => 0
   ), $atts );
   $class = $a['class'];
   if ($a['big'] == 1) $class .= ' big';
   if ($a['active'] == 1) $class .= ' active';
    return '<a class="button ' . $class . '" href="' . $a['url'] . '"><span>' . $a['title'] . '</span></a>';
}

/**	Blockquote */

add_shortcode('etheme_blockquote', 'etheme_blockquote_shortcode');
function etheme_blockquote_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'align' => 'left'
    ), $atts);
    switch($a['align']) {

        case 'right':
            $align = 'fl-r';
        break;
        case 'center':
            $align = 'fl-none';
        break;
        default:
            $align = 'fl-l';        
    }
    return '<blockquote class="' . $align . '">' . $content . '</blockquote>';
}

/**	Lists */
add_shortcode('etheme_list', 'etheme_list_shortcode');
function etheme_list_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'style' => 'circle'
    ), $atts);
    switch($a['style']) {
        case 'arrow':
            $class = 'arrow dotted';
        break;
        case 'arrow_2':
            $class = 'arrow-2 dotted';
        break;
        case 'circle':
            $class = 'circle dotted';
        break;
        case 'check':
            $class = 'check dotted';
        break;
        case 'square':
            $class = 'list-square dotted';
        break;
        case 'star':
            $class = 'star dotted';
        break;
        case 'plus':
            $class = 'plus dotted';
        break;
        case 'dash':
            $class = 'dash dotted';
        break;
        default:
            $class = 'circle dotted';
    }
    return '<ul class="' . $class . '">' . $content . '</ul>';
}

/**	Alert Boxes */

add_shortcode('etheme_alert', 'etheme_alert_shortcode');
function etheme_alert_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'type' => 'success',
        'title' => 'Success!'
    ), $atts);
    switch($a['type']) {
        case 'error':
            $class = 'error';
        break;
        case 'success':
            $class = 'success';
        break;
        case 'info':
            $class = 'info';
        break;
        case 'notice':
            $class = 'notice';
        break;
        default:
            $class = 'success';
    }
    return '<p class="' . $class . '"><strong>' . $a['title'] . '</strong>' . $content . '</p>';
}

/**	Dropcap */

add_shortcode('etheme_dropcap', 'etheme_dropcap_shortcode');
function etheme_dropcap_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'class' => ''
   ), $atts );
   
    return '<span class="dropcap ' . $a['class'] . '">' . $content . '</span>';
}

/**	Columns */

add_shortcode('etheme_column', 'etheme_column_shortcode');
function etheme_column_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'size' => 'one_half',
        'last' => 1
    ), $atts);
    switch($a['size']) {
        case 'one_half':
            $class = 'one-half';
        break;
        case 'one_third':
            $class = 'one-third';
        break;
        case 'two_third':
            $class = 'two-third';
        break;
        case 'one_fourth':
            $class = 'one-fourth';
        break;
        case 'three_fourth':
            $class = 'three-fourth';
        break;
        default: 
            $class = 'one-half';
        }
        if ($a['last'] == 1) $class .= ' last';
        
        return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
}

/**	Tabs */

add_shortcode('etheme_tabs', 'etheme_tabs_shortcode');
function etheme_tabs_shortcode($atts, $content = null) {
    return '<ul id="tabs" class="product-tabs">' . do_shortcode($content) . '</ul><div class="clear"></div>';
}

add_shortcode('etheme_tab', 'etheme_tab_shortcode');

function etheme_tab_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'title' => 'Tab'
    ), $atts);
    return '<li><a href="#">' . $a['title'] . '</a><section>' . $content . '</section></li>';
}

add_shortcode('etheme_youtube', 'etheme_youtube_shortcode');
function etheme_youtube_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'src' => '',
        'height' => '500',
        'width' => '900'
    ), $atts);
    if ($a['src'] == '') return;
    return '<div class="youtube-video" style="width=:' . $a['width'] . 'px; height:' . $a['height'] . 'px;"><iframe width="' . $a['width'] . '" height="' . $a['height'] . '" src="' . $a['src'] . '" frameborder="0" allowfullscreen></iframe></div>';
}

?>