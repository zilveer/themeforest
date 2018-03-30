<?php
/**
 * @package WordPress
 * @subpackage CreativeZodiac_theme
 */  

include 'zodiacbox.php';

function trim_the_content( $the_contents, $read_more_tag = ' READ MORE...', $perma_link_to = '', $all_words = 45 ) {
	// make the list of allowed tags
	$allowed_tags = array( 'a', 'abbr', 'b', 'blockquote', 'b', 'cite', 'code', 'div', 'em', 'fon', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'hr', 'i', 'img', 'label', 'i', 'p', 'pre', 'span', 'strong', 'title', 'ul', 'ol', 'li', 'object', 'embed', 'table', 'tbody', 'tr', 'th', 'td');
	if( $the_contents != '' ) {
		// process allowed tags
		$allowed_tags = '<' . implode( '><', $allowed_tags ) . '>';
		$the_contents = str_replace( ']]>', ']]&gt;', $the_contents );
		$the_contents = strip_tags( $the_contents, $allowed_tags );
		// exclude HTML from counting words
//		if( $all_words > count( preg_split( '/[\s]+/', strip_tags( $the_contents ), -1 ) ) ) return $the_contents;
		// count all
		$all_chunks = preg_split( '/([\s]+)/', $the_contents, -1, PREG_SPLIT_DELIM_CAPTURE );
		$the_contents = '';
		$count_words = 0;
		$enclosed_by_tag = false;
		foreach( $all_chunks as $chunk ) {
			// is tag opened?
			if( 0 < preg_match( '/<[^>]*$/s', $chunk ) ) $enclosed_by_tag = true;
			elseif( 0 < preg_match( '/>[^<]*$/s', $chunk ) ) $enclosed_by_tag = false;
			// get entire word
			if( !$enclosed_by_tag && '' != trim( $chunk ) && substr( $chunk, -1, 1 ) != '>' ) $count_words ++;
			$the_contents .= $chunk;
	//		if( $count_words >= $all_words && !$enclosed_by_tag ) break;
		}
                // note the class named 'more-link'. style it on your own
		//$the_contents = $the_contents . '<a class="more-link" href="' . $perma_link_to . '">' . $read_more_tag . '</a>';
		// native WordPress check for unclosed tags
		$the_contents = force_balance_tags( $the_contents );
	}
	return $the_contents;
}

   
function navigation($toexclude)
{    

 $wpurl = get_bloginfo('url');
 $original = wp_list_pages("echo=0&depth=1&title_li=&exclude=".$toexclude);
 $actual_pos = 1;
 $going = true;
 $replace0 = $original;
while($going)
 {
    $first = strpos($original, "href=\"", $actual_pos);
   // echo $first;
    $second = strpos($original, "\"", $first+6);
    //echo $first."sss".$second."sssss"       ;
     if($actual_pos > $first)$going = false;
     else
     {
        $my_post_url =substr($original, $first+6, $second-1 - $first - 6);
        $my_post_url_with_server = str_replace($wpurl."/", "", $my_post_url);
       // $my_post_url_with_server = str_replace("/", "", $my_post_url_with_server);
        $postid = url_to_postid($my_post_url);
        $replace0 = str_replace($my_post_url, $wpurl."/".$postid."-".$my_post_url_with_server,$replace0);
       // $replace0 = str_replace($my_post_url_with_server."/", $my_post_url_with_server);
     }
   // echo substr($original, $first+6, $second-1 - $first - 6);
   
   
     $actual_pos = $second;
 }
 //echo $original;
 
 $replace0 = ereg_replace("<li[^>]*>", "<li>", $replace0);
 $replace1 = str_replace("<li>", "<li><span class=\"nav_left\"></span><span class=\"nav_right\">", $replace0);
 $replace2 = str_replace("</li>", "</span></li><!-- END \"li\" -->", $replace1);
 $replace3 = str_replace($wpurl, $wpurl."/#", $replace2 );
 echo $replace3;
}

function urlpost($url)
{
  return url_to_postid($url);
}
function get_subpages_array($cat_id)
{
 $to_return = NULL;
 $page_list = wp_list_pages("echo=0&depth=1&child_of=".$cat_id."&title_li=");
 $going = true;
 $actual_pos = 0;
 $number_of_subpages = 0;
 while($going)
 {
    
    $first = strpos($page_list, "href=\"", $actual_pos);
    $second = strpos($page_list, "\"", $first+6);
    if($actual_pos > $first)$going = false;
    else
    {
       $number_of_subpages++;
       $to_return[$number_of_subpages]= substr($page_list, $first+6, $second-1 - $first - 6);
    }
    $actual_pos = $second;    
 }
 $to_return['subpages_count'] = $number_of_subpages;
 return $to_return;
}
 
function get_js_permalink()
{
  $blog_url = get_bloginfo('url');
}
function get__permalink($id)
{
  $original = get_permalink($id);
    $original = str_replace( get_bloginfo('url')."/", "", $original);
    $original = get_bloginfo('url')."/#/".$original;
        return $original;
} 
function get__name($id)
{
    $original = get_permalink($id);
    $original = str_replace( get_bloginfo('url')."/", "", $original);
  //  $original = $id."-".$original;
    $original = str_replace("/", "", $original);
    return $original;
}
automatic_feed_links();
       //  <li[^>]*>   
 $new_meta_boxes_page =
 array(   
   "category_id" => array(  
   "name" => "category_id",  
   "std" => "",  
   "title" => "Category ID",  
   "description" => "Id of category which correspondents with actual page"),
   
   "actualpost_id" => array(  
   "name" => "actualpost_id",  
   "std" => "",  
   "title" => "Actual Blogpost ID",  
   "description" => "Id of blogpost which appear on the blog page. Leave it blank to appear lastest blogpost.")
 ); 
       
 $new_meta_boxes =  
   array(  
    "GALLERY POST SETTINGS / BLOG POST THUMBNAIL" => array(  
   "name" => "GALLERY POST SETTINGS / BLOG POST THUMBNAIL",  
   "type" => "divider"),
   
   "portfolio_image_small" => array(  
   "name" => "portfolio_image_small",  
   "std" => "",  
   "title" => "Post small image",  
   "description" => "Small image, usually 54 * 54px"),  
   
    "portfolio_image_medium" => array(  
   "name" => "portfolio_image_medium",  
   "std" => "",  
   "title" => "Post medium image",  
   "description" => "Medium image, usually 402 * 272px"),
   
    "portfolio_image_large" => array(  
   "name" => "portfolio_image_large",  
   "std" => "",  
   "title" => "Post large image - If you want to use the automatic image resizing post your image URL here only:",  
   "description" => "Post large image - If you want to use the automatic image resizing post your image URL here only:"),   


   "portfolio_image_video" => array(  
   "name" => "portfolio_image_video",  
   "std" => "false",
   "type" => "checkbox",  
   "title" => "Is Video?",  
   "description" => "If you check this option - please insert video code to 'Large Image'"),
   
    "BLOG POST SETTINGS" => array(  
   "name" => "BLOG POST SETTINGS",  
   "type" => "divider"),
   
     "blog_display_category" => array(  
     "name" => "blog_display_category",  
     "std" => "true",  
     "type" => "checkbox",  
     "title" => "Display category ?",
     "description" => "If you check this option the category will be hidden"),
     
      "blog_display_date" => array(  
     "name" => "blog_display_date",  
     "std" => "true",  
     "type" => "checkbox",  
     "title" => "Display Date ?",
     "description" => "If you check this option the date will be hidden"),
     
     "blog_display_metabix" => array(  
     "name" => "blog_display_metabox",  
     "std" => "true",  
     "type" => "checkbox",  
     "title" => "Display Metabox ?",
     "description" => "Metabox contains blog category and date"),
     
     "blog_display_navigationimg" => array(  
     "name" => "blog_display_navigationimg",  
     "std" => "true",  
     "type" => "checkbox",  
     "title" => "Display Navigation image ?",
     "description" => "Navigation image is located in blogpost list in navigation"),
     
     "blog_display_mediumimg" => array(  
     "name" => "blog_display_mediumimg",  
     "std" => "true",  
     "type" => "checkbox",  
     "title" => "Display Medium image ?",
     "description" => "Medium image is located in blogpost"),
     
     "blog_display_commentdates" => array(  
     "name" => "blog_display_commentdates",  
     "std" => "true",  
     "type" => "checkbox",  
     "title" => "Display Comment date ?",
     "description" => "Displays dates in comments")
   );  
   
   function new_meta_boxes_page() {
       global $post, $new_meta_boxes_page;
      
    foreach($new_meta_boxes_page as $meta_box) {
    $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
    
    if($meta_box_value == "")
    $meta_box_value = $meta_box['std'];
    $meta_box_value = stripslashes($meta_box_value);
    if($meta_box["type"] == "divider")
    {
       echo '<h1>'.$meta_box['name'].'</h1>';
    }
    else
    {
    
    
    echo '<div id="'.$meta_box['name'].'_div">';
    echo'<input type="hidden"  name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    
    echo'<h2>'.$meta_box['title'].'</h2>';
    
    if($meta_box['type'] == "textarea")
    {
       echo '<textarea name="'.$meta_box['name'].'" size="55" width="400px" />'.$meta_box_value.'</textarea><br />';
    }
    else if($meta_box['type'] == "checkbox")
    {
       echo '<select name="'.$meta_box['name'].'" id="'.$meta_box['name'].'">';
       if($meta_box_value == "true" )
       {
        echo   '<option value="true" selected>yes</option>';
        echo   '<option value="false" >no</option>';
       
       }
       else
       {
        echo   '<option value="true"  >yes</option>';
        echo   '<option value="false" selected>no</option>';
       }
      
       echo '</select>';
    
      // echo'<input type="checkbox" name="'.$meta_box['name'].'" value="ssss" checked size="55" /><br />';
        }
        else
        {            
          echo'<input type="text" id="'.$meta_box['name'].'" name="'.$meta_box['name'].'" value="'.$meta_box_value.'" size="55" /><br />';
        }
        echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
        echo '</div>';
     
        }
     }
    }
   
   
   function new_meta_boxes() {
    global $post, $new_meta_boxes;
      
    foreach($new_meta_boxes as $meta_box) {

    if($meta_box["type"] == "divider")
    {
       echo '<h1>'.$meta_box['name'].'</h1>';
    }
    else
    {
      $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
      
      if($meta_box_value == "")
      $meta_box_value = $meta_box['std'];
      $meta_box_value = stripslashes($meta_box_value);
    
    echo '<div id="'.$meta_box['name'].'_div">';
    echo'<input type="hidden"  name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    
    echo'<h2>'.$meta_box['title'].'</h2>';
    
    if($meta_box['type'] == "textarea")
    {
       echo '<textarea name="'.$meta_box['name'].'" size="55" width="400px" />'.$meta_box_value.'</textarea><br />';
    }
    else if($meta_box['type'] == "checkbox")
    {
       echo '<select name="'.$meta_box['name'].'" id="'.$meta_box['name'].'">';
       if($meta_box_value == "true" )
       {
        echo   '<option value="true" selected>yes</option>';
        echo   '<option value="false" >no</option>';
       
       }
       else
       {
        echo   '<option value="true"  >yes</option>';
        echo   '<option value="false" selected>no</option>';
       }
      
       echo '</select>';
    
      // echo'<input type="checkbox" name="'.$meta_box['name'].'" value="ssss" checked size="55" /><br />';
        }
        else
        {            
          echo'<input type="text" id="'.$meta_box['name'].'" name="'.$meta_box['name'].'" value="'.$meta_box_value.'" size="55" /><br />';
        }
        echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
        echo '</div>';
     
        }
     }
    }
    
    function create_meta_box() {
    global $theme_name;
        if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', 'Post settings', 'new_meta_boxes', 'post', 'normal', 'high' );
        add_meta_box( 'new-meta-boxes-page', 'Page settings', 'new_meta_boxes_page', 'page', 'normal', 'high' );
        }
    }
        
    function save_postdata( $post_id ) {
    
    if ( 'page' == $_POST['post_type'] )
    {
         global $post, $new_meta_boxes_page;
        
        foreach($new_meta_boxes_page as $meta_box) {
        if($meta_box['type'] != "divider"){
        // Verify
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
        return $post_id;
        }
        
        if ( 'post' == $_POST['post_type'] ) {
          if ( !current_user_can( 'edit_page', $post_id ))
          return $post_id;
        } else {
        if ( !current_user_can( 'edit_post', $post_id ))
        return $post_id;
        }
 
        $data = $_POST[$meta_box['name']];
        $data = addslashes($data);
        if(get_post_meta($post_id, $meta_box['name']) == "")
        add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
        update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
        delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
        }
        }
     }
     
    else         
    {  
        
        global $post, $new_meta_boxes;
        
        foreach($new_meta_boxes as $meta_box) {
        if($meta_box['type'] != "divider"){
        // Verify
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
        return $post_id;
        }
        
        if ( 'page' == $_POST['post_type'] ) {
          if ( !current_user_can( 'edit_page', $post_id ))
          return $post_id;
        } else {
        if ( !current_user_can( 'edit_post', $post_id ))
        return $post_id;
        }
        $data = $_POST[$meta_box['name']];
        $data = addslashes($data);
        if(get_post_meta($post_id, $meta_box['name']) == "")
        add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
        update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
        delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
        }
        }
    }
    }          
    
    add_action('admin_menu', 'create_meta_box');  
    add_action('save_post', 'save_postdata');  

       
       
       
                ?>