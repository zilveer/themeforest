<?php
/**
 * WP-Church custom functions
 *
 *
 */



/******************************************************************
 *
 * mp3 player color
 *
 ******************************************************************/

function get_playercolor() {

	$theme = get_option('nets_colorscheme');
	
	if ($theme == 'rust'){ 
		$output = 'AB291C';
	} elseif ($theme == 'gold'){
		$output = 'AD7918';
	} elseif ($theme == 'green'){
		$output = '656B31';
	} elseif ($theme == 'teal'){
		$output = '156863';
	} elseif ($theme == 'blue'){
		$output = '1D537A';
	} elseif ($theme == 'purple'){
		$output = '5F4870';
	}
	echo $output;
}



/******************************************************************
 *
 * gallery shortcode
 *
 ******************************************************************/


function reloaded_gallery_shortcode($attr) {
  

	global $post;
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}
	extract(shortcode_atts(array(
		'orderby' => 'menu_order ASC, ID ASC',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
	), $attr));

    $count = 1;
	$id = intval($id);
	$attachments = get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby={$orderby}");

	if ( empty($attachments) ) return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $id => $attachment )
			$output .= wp_get_attachment_link($id, $size, true) . "\n";
		return $output;
	}
	
	$listtag = '';
	$output = '';
	$a_class= '';
	$a_rel= '';
	$g_slide= '';
	$listtag = tag_escape($listtag);
	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;


	$output = apply_filters('gallery_style', "<div class='gbackgr'>");
	$output .= "\n<div class='main_image'></div>\n";
 	$output .= "\n<div class='gholder'><ul class='gallery-thumbs gallery_reloaded'>\n";
	foreach ( $attachments as $id => $attachment ) {
		$a_img = wp_get_attachment_url($id);
		$att_page = get_attachment_link($id);
		$img = wp_get_attachment_image_src($id, $size);
		$img = $img[0];
		$title = $attachment->post_excerpt;
		if($title == '') $title = $attachment->post_title;
		if($count == 1) $output .= "<li class='active'>";
		if($count > 1) $output .= "<li>";
		$link = $a_img;
		$output .= "\t<a href=\"$link\" title=\"$title\" class=\"$a_class\" rel=\"$a_rel\">";
		$output .= "<img src=\"$img\" alt=\"$title\" />";
		$output .= "</a>";
		$output .= "</li>";
		$count++;
	}
	$output .= "\n</ul></div>\n";
	if ($g_slide == 'top') {
		$output .= "<div class='main_image'></div>\n";
	};

	$output .= '<div class="clear" style="clear: both;"></div></div>';
	return $output;
}

remove_shortcode('gallery');
add_shortcode('gallery', 'reloaded_gallery_shortcode');


// Get the Images from the default Gallery
function get_gallery_images( $args = array() ) {
	$defaults = array(
		'custom_key' => array( 'Thumbnail', 'thumbnail' ),
		'post_id' => false,
		'attachment' => true,
		'default_size' => 'thumbnail',
		'default_image' => false,
		'order_of_image' => 1,
		'link_to_post' => true,
		'image_class' => false,
		'image_scan' => false,
		'width' => false,
		'height' => false,
		'format' => 'img',
		'echo' => true
	);
	$args = apply_filters( 'get_gallery_images_args', $args );
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	if ( !is_array( $custom_key ) ) :
		$custom_key = str_replace( ' ', '', $custom_key) ;
		$custom_key = str_replace( array( '+' ), ',', $custom_key );
		$custom_key = explode( ',', $custom_key );
		$args['custom_key'] = $custom_key;
	endif;
	if ( $custom_key && $custom_key !== 'false' && $custom_key !== '0' )
		$image = image_by_custom_field( $args );
	if ( !$image && $attachment && $attachment !== 'false' && $attachment !== '0' )
		$image = image_by_attachment( $args );
	if ( !$image && $image_scan )
		$image = image_by_scan( $args );
	if (!$image && $default_image )
		$image = image_by_default( $args );
	if ( $image )
		$image = display_the_image( $args, $image );
	$image = apply_filters( 'get_gallery_images', $image );
	if ( $echo && $echo !== 'false' && $echo !== '0' && $format !== 'array' )
		echo $image;
	else
		return $image;
}
 

/******************************************************************
 *
 * retrieve the bible verse
 *
 ******************************************************************/
 
 
if (get_option('nets_bibverse') != 'disabled') {

add_filter('the_content', 'the_bible_content');
 
function netstudio_buildLink($reference) {

	$length =5;
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $linkstring = ""; 
    $return = "";   
    
    $linkposts = get_posts('numberposts=100000&post_type=verses');
    foreach($linkposts as $linkentry) :
	$linkvalue = $linkentry->post_title;
	$linknumber = $linkentry->ID;
	if ($linkvalue == $reference){
		$return = get_post_meta($linknumber, 'netlabs_vpassage' , true);
	}				
	endforeach;	

    for ($p = 0; $p < $length; $p++) {
        $linkstring .= $characters[mt_rand(0, strlen($characters))];
    }

	
	if ($return == "") {
		$url = 'http://www.esvapi.org/v2/rest/passageQuery?key=IP&passage='. urlencode($reference) . '&include-footnotes=false';
  		$ch = curl_init($url); 
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  		$return = curl_exec($ch);
  		curl_close($ch);
		$post_id = wp_insert_post( array(
				'post_type' => 'verses',
				'post_status' => 'publish',
				'comment_status' => 'closed',
				'post_title' => $reference,
				'post_author' => '1'
			) );
		add_post_meta($post_id, 'netlabs_vpassage', $return, true); 
	}
	
	$return = str_replace('div', 'span', $return);
	$return = str_replace('h2', 'span', $return);
	$return = strip_tags($return, '<span><object><br><param>');

	$versehref = '<a href="#" class="ttip" rel="' . $linkstring .  '" >' . $reference . '</a><span class="tooltip ' . $linkstring . '" ><a href="#" class="close" rel="' . $linkstring .  '">' .   __('close', 'wp-church')  . '</a>' . $return . '</span>';


	return $versehref;
}
 
function verse_ref($reference = '', $volume = '', $book = '', $verse = '') {

		if ($volume) {
			$volume = str_replace('III','3',$volume);
			$volume = str_replace('Third','3',$volume);
			$volume = str_replace('II','2',$volume);
			$volume = str_replace('Second','2',$volume);
			$volume = str_replace('I','1',$volume);
			$volume = str_replace('First','1',$volume);
			$volume = $volume{0}; // will remove st,nd,and rd (presupposes regex is correct)
		}

		$reference = $volume ." ". $book ." ". $verse;
		$reference = trim($reference);


		return netstudio_buildLink($reference);
}
 
function book_replace($text){
$volume_regex = '1|2|3|I|II|III|1st|2nd|3rd|First|Second|Third';

$book_regex  = 'Genesis|Exodus|Leviticus|Numbers|Deuteronomy|Joshua|Judges|Ruth|Samuel|Kings|Chronicles|Ezra|Nehemiah|Esther';
$book_regex .= '|Job|Psalms?|Proverbs?|Ecclesiastes|Songs? of Solomon|Song of Songs|Isaiah|Jeremiah|Lamentations|Ezekiel|Daniel|Hosea|Joel|Amos|Obadiah|Jonah|Micah|Nahum|Habakkuk|Zephaniah|Haggai|Zechariah|Malachi';
$book_regex .= '|Mat+hew|Mark|Luke|John|Acts?|Acts of the Apostles|Romans|Corinthians|Galatians|Ephesians|Phil+ippians|Colossians|Thessalonians|Timothy|Titus|Philemon|Hebrews|James|Peter|Jude|Revelations?';

$abbrev_regex  = 'Gen|Ex|Exo|Lev|Num|Nmb|Deut?|Josh?|Judg?|Jdg|Rut|Sam|Ki?n|Chr(?:on?)?|Ezr|Neh|Est';
$abbrev_regex .= '|Jb|Psa?|Pr(?:ov?)?|Eccl?|Song?|Isa|Jer|Lam|Eze|Dan|Hos|Joe|Amo|Oba|Jon|Mic|Nah|Hab|Zeph?|Hag|Zech?|Mal';
$abbrev_regex .= '|Mat|Mr?k|Lu?k|Jh?n|Jo|Act|Rom|Cor|Gal|Eph|Col|Phi(?:l?)?|The?|Thess?|Tim|Tit|Phile|Heb|Ja?m|Pe?t|Ju?d|Rev';

$book_regex = '(?:'.$book_regex.')|(?:'.$abbrev_regex.')\.?';

$verse_substr_regex = "(?:[:.][0-9]{1,3})?(?:[-&,;]\s?[0-9]{1,3})*";
$verse_regex = "[0-9]{1,3}(?:". $verse_substr_regex ."){1,2}";

$passage_regex = '/(?:('.$volume_regex.')\s)?('.$book_regex.')\s('.$verse_regex.')/e';
$replacement_regex = "verse_ref('\\0','\\1','\\2','\\3')";

$text = preg_replace($passage_regex, $replacement_regex, $text);


	$text = preg_replace($passage_regex, $replacement_regex, $text);


return $text;

}


function the_bible_content($content) {

return book_replace($content);

}
 
 
} else {

function book_replace($text){
	return $text;
}
}


/******************************************************************
 *
 * custom page titles
 *
 ******************************************************************/


add_filter('wp_title', 'adminace_title' , 10, 2);

function adminace_title( $the_title, $sep = '', $sep_location = '', $postid = '' ){
global $post, $wp_query;


//if we are on a single post or page show the title and page name
if ( is_singular() ) {
   $the_title =  $post->post_title.' - '.get_bloginfo('name');
 
 
//if we are on a category, taxonomy page or tag show the term name blog name and description
} else if ( is_category() || is_tag() || is_tax()) {

  $term = $wp_query->get_queried_object();
  $the_title = ucfirst($term->name) . ' - ' . get_bloginfo('name') .' - '.get_bloginfo('description');

  
//if we are on the frontpage or index page show the site name and description
   } elseif  ( is_home() || is_front_page() ) {
  $the_title = get_bloginfo('name').' - '.get_bloginfo('description');

  
//if we are on a search page show a search message and sitename;
   } elseif ( is_search() ) { 
    $the_title = ' ' . __('Search results for', 'wp-church')  .  ' ' .  get_search_query() . ' - ' . $blog_name;

	
//if we are on a page not found show a message and sitename;
   } elseif ( is_404() ) {
  $the_title = __('Page not Found', 'wp-church')  .  ' ' .get_bloginfo('name'); 
   } else { 

   
//none of the above show the page title and the sitename
   $the_title =  get_bloginfo('name') .' - '.get_bloginfo('description');
}
return esc_html( stripslashes( trim( $the_title ) ) );
}

 
 
/******************************************************************
 *
 * custom meta page descriptions
 *
 ******************************************************************/
 
 
function the_meta_description() {
global $post;
if ( (is_home()) || (is_front_page()) ) {
    echo (get_option('nets_seodescr'));
} elseif(is_category()) {
    echo strip_tags(category_description());
} elseif(is_tag()) {
    echo __('-tag archive page for', 'wp-church')  .  ' ' . single_tag_title();
} elseif(is_month()) {
    echo __('archive page for this blog', 'wp-church')  .  ' ' . the_time('F, Y');
} else {
    echo get_post_meta($post->ID, 'netlabs_codebox', true);
}
}

/* Define the custom box */
add_action('add_meta_boxes', 'netlabs_metadesc_box');

/* Do something with the data entered */
add_action('save_post', 'netlabs_save_metadesc');

/* Adds a box to the main column on the Post and Page edit screens */
function netlabs_metadesc_box() {
    add_meta_box( 'netlabsmetadesc_sectionid', __( 'Meta page descriptions', 'metadesc_textdomain' ), 
                'netlabs_metadesc_custom_box', 'post' );
    add_meta_box( 'netlabsmetadesc_sectionid', __( 'Meta page descriptions', 'metadesc_textdomain' ), 
                'netlabs_metadesc_custom_box', 'page' );
    add_meta_box( 'netlabsmetadesc_sectionid', __( 'Meta page descriptions', 'metadesc_textdomain' ), 
                'netlabs_metadesc_custom_box', 'messages' );
    add_meta_box( 'netlabsmetadesc_sectionid', __( 'Meta page descriptions', 'metadesc_textdomain' ), 
                'netlabs_metadesc_custom_box', 'group' );
    add_meta_box( 'netlabsmetadesc_sectionid', __( 'Meta page descriptions', 'metadesc_textdomain' ), 
                'netlabs_metadesc_custom_box', 'members' );
}

$prefix = 'netlabs_';

$netlabs_metdesc = array(
	'id' => 'netlabs-metadesc-box',
	'title' => 'Meta Descriptions',
	'page' => 'posts',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Descriptions',
			'desc' => 'Meta Page Description.',
			'id' => $prefix . 'codebox',
			'type' => 'textarea',
			'size' => 5,
			'std' => ''
		)
	)
);

/* Prints the box content */
function netlabs_metadesc_custom_box() {

	global $netlabs_metdesc, $post;

  // Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'netlabsmeta_noncename' );

  echo '<table class="form-table">';

	foreach ($netlabs_metdesc['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br />', $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="' , $field['size'], '" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

/* When the post is saved, saves our custom data */
function netlabs_save_metadesc( $post_id ) {

	global $netlabs_metdesc, $post;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times

  if ( !wp_verify_nonce( $_POST['netlabsmeta_noncename'], plugin_basename(__FILE__) )) {
    return $post_id;
  }

  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
  // to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
    return $post_id;

  
  // Check permissions
  if ( 'post' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
      return $post_id;
  } 
  
 foreach ($netlabs_metdesc['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = htmlentities($_POST[$field['id']]);		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}


}


/******************************************************************
 *
 * social function
 *
 ******************************************************************/
 
 function netstudio_get_social() {
 
global $post;
$netstudio_social_permlink = get_permalink($post->ID);
$netstudio_social_enclink = urlencode($netstudio_social_permlink);
$netstudio_social_title = urlencode(get_the_title($post->ID) );
$socontent = '<div class="netstudiosoc">';
 
 
if (get_option('nets_facebook_posts') == 'true') {
$socontent .= '<iframe src="http://www.facebook.com/plugins/like.php?href='.$netstudio_social_enclink.'&layout=standard&show_faces=false&width=450&action=like&colorscheme=light&height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:25px;" allowTransparency="true"></iframe>';
}

if (get_option('nets_twitter_posts') == 'true') {
$socontent .= '<a href="http://twitter.com/share" data-url="'.$netstudio_social_permlink.'" data-text="'.$netstudio_social_title.'" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
}
			
if (get_option('nets_stumble_posts') == 'true') {
$socontent .= '<a target="_blank"  href="http://www.stumbleupon.com/submit?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'""><img src="' . get_template_directory_uri() . '/social_icons/stumble.png"></a>';
}
			
if (get_option('nets_rss_posts') == 'true') {
$socontent .= '<a target="_blank"  href="'.get_settings('home').'/?feed=rss2"><img src="' . get_template_directory_uri() . '/social_icons/rss.png"></a>';
}
			
if (get_option('nets_email_posts') == 'true') { 
$socontent .= '<a target="_blank"  href="http://www.freetellafriend.com/tell/?heading=Share+This+Article&bg=1&option=email&url='.$netstudio_social_enclink.'"><img src="' . get_template_directory_uri() . '/social_icons/email.png"></a>';
}
			
if (get_option('nets_blogger_posts') == 'true') {
$socontent .= '<a target="_blank"  href="http://www.blogger.com/blog_this.pyra?t&u='.$netstudio_social_enclink.'&n='.$netstudio_social_title.'&pli=1"><img src="' . get_template_directory_uri() . '/social_icons/blogger.png"></a>';
}

if (get_option('nets_digg_posts') == 'true') {
$socontent .= '<a target="_blank"  href="http://digg.com/submit?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/social_icons/digg.png"></a>';
}
			
if (get_option('nets_delicious_posts') == 'true') {
$socontent .= '<a target="_blank"  href="http://del.icio.us/post?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/social_icons/delicious.png"></a>';
}
			
if (get_option('nets_buzz_posts') == 'true') {
$socontent .= '<a target="_blank"  href=http://buzz.yahoo.com/buzz?targetUrl='.$netstudio_social_enclink.'&headline='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/social_icons/buzz.png"></a>';
}
			
if (get_option('nets_technorati_posts') == 'true') {
$socontent .= '<a target="_blank"  href="http://technorati.com/faves?sub=favthis&add='.$netstudio_social_enclink.'"><img src="' . get_template_directory_uri() . '/social_icons/technorati.png"></a>';
}
			
if (get_option('nets_blinklist_posts') == 'true') {
$socontent .= '<a target="_blank"  href="http://www.blinklist.com/index.php?Action=Blink/addblink.php&Url='.$netstudio_social_enclink.'&Title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/social_icons/blinklist.png"></a>';
}
			
if (get_option('nets_reddit_posts') == 'true') {
$socontent .= '<a target="_blank"  href="http://reddit.com/submit?url='.$netstudio_social_enclink.'&title='.$netstudio_social_title.'"><img src="' . get_template_directory_uri() . '/social_icons/reddit.png"></a>';
}
			
if (get_option('nets_designfloat_posts') == 'true') {
$socontent .= '<a target="_blank"  href="http://www.designfloat.com/submit/?url='.$netstudio_social_enclink.'"><img src="' . get_template_directory_uri() . '/social_icons/designfloat.png"></a>';
}
 
echo $socontent . '</div>';
 
}
 

/******************************************************************
 *
 * wp-ajax functions (newsletter & message center)
 *
 ******************************************************************/



function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
	(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
	?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
	$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
		(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
		?([A-Za-z0-9]+))$",
		$domain_array[$i])) {
			return false;
      }
    }
  }
  return true;
}




add_action('wp_ajax_netlabs_get_ajaxdata', 'netlabs_ajax_callback');
add_action('wp_ajax_nopriv_netlabs_get_ajaxdata', 'netlabs_ajax_callback');


function netlabs_ajax_callback() {
global $wpdb;

	if(isset($_POST['type'])){
	$action_identifier = $_POST['type'];
	}
	if(isset($_POST['mail'])){
	$signup_email = $_POST['mail'];
	}
	if(isset($_POST['name'])){
	$signup_name = $_POST['name'];
	}
	if(isset($_POST['location'])){
	$location = $_POST['location'];
	}
	if(isset($_POST['mstring'])){
	$mstring = $_POST['mstring'];
	}
	if(isset($_POST['senddata'])){
		$thedata = $_POST['senddata'];
	}
	
	$output = '';
	
	if($action_identifier == 'get_newssignup'){
		$pass = check_email_address($signup_email);
		if (!$pass) {
		$output .= 'mailerr';
		} 
		if (!$signup_email) {
		$output .= 'nameerr';
		}
		if ($location) {
		$output .= 'boterr';
		}
		if (!$output) {
		$output .= __('Success', 'wp-church');
		$message =  __('Hi Admin', 'wp-church');
		$message .= "\r\n \r\n " . __('You have a newsletter signup', 'wp-church');
		$message .= "\r\n \r\n " . __('Name:', 'wp-church') . $signup_name;
		$message .= "\r\n \r\n " . __('Email:', 'wp-church') . $signup_email;
		$admin_email = get_option('admin_email');
		$subject = __('New newsletter signup', 'wp-church');
		wp_mail($admin_email, $subject, $message);
		}
	}
	if($action_identifier == 'get_mp3'){
		$output = '<p id="audioplayer_1">Alternative content</p>';  
		$output .= '<script type="text/javascript">';  
        $output .= 'AudioPlayer.embed("audioplayer_1", {soundFile: "'. $mstring .'"});'; 
        $output .= '</script>'; 

	}
	
	if($action_identifier == 'get_pcontent'){
		$postkey = get_post($post_id);
		$content = $postkey->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		$output = $content; 

	}
	
	if($action_identifier == 'get_cal'){
		$monthdata = explode('/', $thedata);
		$month = $monthdata[0];
		$year = $monthdata[1];
		$content = '<div id="post" class="hentry">';
		$content .= '<div class="calmonth"><div class="monthselect">';
		$content .= prevlink($month , $year);
		$content .= '<span>|</span>';
		$content .= nextlink($month , $year);
		$content .= '</div>';
		$content .= '<h1>' . monthname($month,$year) . '</h1>';
		$content .= '</div><div class="calentries">';
		$content .= get_the_calendar($month,$year) . '</div></div>';	
		$output = $content; 

	}
	
	if($action_identifier == 'get_map'){
		$output = '<iframe name="framename" frameBorder="0" id="myframe" ALLOWTRANSPARENCY="true" src="' . get_template_directory_uri() . '/maptype2.php?latlong=' . get_option('nets_latlong') . '&mzoom=' . get_option('nets_mapzoom') . '&szoom=' . get_option('nets_strzoom') . '&pan=' . get_option('nets_orien') . '&measure=' . get_option('nets_mapmetric') . '&streetview=' . get_option('nets_mapview') . '"></iframe>';

	}	
	
	echo $output;
	exit;

}



add_action('wp_head', 'netlabs_jquery_header');


function netlabs_jquery_header() {
?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
		$('.reset').val('');
		$('input.newssubmit').click(function(event) {
			event.preventDefault();
			$('.loadimg').show();
			$('#valmess').removeClass('newslError').removeClass('newslSuccess').html('');
			var newslname = $('.netlabs_newsname').val();
			var newslmail = $('.netlabs_newsmail').val();
			var newslloc = $('.netlabs_newsloc').val();
			if (!newslname || !newslmail) {
				$('#valmess').addClass('newslError').html('Please fill all the fields');
				$('.loadimg').hide();
				return;		
			} else {
				var data = { action: 'netlabs_get_ajaxdata', type: 'get_newssignup', mail: newslmail, name: newslname, location: newslloc};
				$.post(ajax_url, data, function(response) {	
					$('.loadimg').hide();
					if (response == 'mailerr') {
						$('#valmess').addClass('newslError').html('Invalid email supplied');
					}
					if (response == 'nameerr') {
						$('#valmess').addClass('newslError').html('No name supplied');
					}
					if (response == 'boterr') {
						$('#valmess').addClass('newslError').html('Please leave the location field open. It is only there to fight spam');
					}
					if (response == 'success') {
						$('#valmess').addClass('newslSuccess').html('Thank you for submitting. Your first newsletter will arrive shortly.');
						$('form#newslettersignup').fadeOut(2000);
					}
				});					
			}
		});
	});
	</script>	
<?php
}



/******************************************************************
 *
 * paging function
 *
 ******************************************************************/
 
function adminace_paging( $args = array(), $query = '' ) {
		global $wp_rewrite, $wp_query;
		
		do_action( 'nets_pagination_start' );
				
		if ( $query ) {$wp_query = $query;} 
	
		if ( 1 >= $wp_query->max_num_pages ) return;
	
		$current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
	
		$max_num_pages = intval( $wp_query->max_num_pages );
	
		$defaults = array(
			'base' => add_query_arg( 'paged', '%#%' ),
			'format' => '',
			'total' => $max_num_pages,
			'current' => $current,
			'prev_next' => true,
			'prev_text' => __( '&laquo;', 'feast' ), 
			'next_text' => __( '&raquo;', 'feast' ), 
			'show_all' => false,
			'end_size' => 1,
			'mid_size' => 1,
			'add_fragment' => '',
			'type' => 'plain',
			'before' => '<div class="pagination">', 
			'after' => '</div>',
			'echo' => true,
		);
	
		if( $wp_rewrite->using_permalinks() )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );
	
		if ( is_search() ) {
			if ( class_exists( 'BP_Core_User' ) ) {
				
				$search_query = get_query_var( 's' );
				$paged = get_query_var( 'paged' );				
				$base = user_trailingslashit( home_url() ) . '?s=' . $search_query . '&paged=%#%';
				
				$defaults['base'] = $base;
			} else {
				$search_permastruct = $wp_rewrite->get_search_permastruct();
				if ( !empty( $search_permastruct ) )
					$defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
			}
		}
	
		$args = wp_parse_args( $args, $defaults );
	
		if ( 'array' == $args['type'] )
			$args['type'] = 'plain';
	
		$page_links = paginate_links( $args );	
		$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );	
		$page_links = $args['before'] . $page_links . $args['after'];		
		do_action( 'nets_pagination_end' );
		
		if ( $args['echo'] )
			echo $page_links;
		else
			return $page_links;
			
	} 

	add_action('wp_head', 'adminace_stylesheet');

	function adminace_stylesheet() {
	?>
	<style>
	a.nextpostslink{display: none;}
	a.previouspostslink{display: none;}
	.pagination a{padding: 5px 10px; margin-right: 10px; background: #F9FAFC; border: 1px solid #DEE1E5; font-weight: bold; text-decoration: none; color: #4C4C4C; }
	.pagination span{background: #3D3E30; border: 0px solid #3D3E30; color: #fff; font-weight: bold;padding: 5px 10px; margin-right: 10px;}
	#adminace_paging a:hover{color: #000;}
	#adminace_paging a.current:hover{color: #fff;}
	.pagination {text-align: center; margin: 40px 0;}
	</style>
	
	<?php
}


?>