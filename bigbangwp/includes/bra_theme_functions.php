<?php
function brankic_titles()
{
        
    $separator="|";
    
    if(is_front_page())
        bloginfo('name');    
        
    else if (is_single() or is_page() or is_home()){
        bloginfo('name'); 
        wp_title($separator,true,'');
    }
    
    else if (is_404()){
        bloginfo('name');    
        echo " $separator ";
        _e('404 error - page not found', BRANKIC_THEME);
    }
    
    else{
        bloginfo('name'); 
        wp_title($separator,true,'');
    }
}

function bra_remove_images($posttext, $echo = true)
{
    $posttext1 = $posttext;
     
    // We will search for the src="" in the post content
    $regular_expression = '~src="[^"]*"~';
    $regular_expression1 = '~<img [^\>]*\ />~';
     
    // WE will grab all the images from the post in an array $allpics using preg_match_all
    preg_match_all( $regular_expression, $posttext, $allpics );
     
    // This time we replace/remove the images from the content
    
    $only_post_text = preg_replace( $regular_expression1, '' , $posttext1);
    $only_post_text = bra_remove_empty_tags($only_post_text);
    
    if ($echo) echo $only_post_text; else return $only_post_text;
}

function bra_remove_empty_tags($html)
{
$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
return preg_replace($pattern, '', $html);
}

function extra_images_exists()
{
    global $post, $query_string;
    $return_value = false;
    $bg_image = false;
    $extra_images_no = of_get_option(BRANKIC_VAR_PREFIX."extra_images_no", of_get_default(BRANKIC_VAR_PREFIX."extra_images_no"));
    if ($extra_images_no == "") $extra_images_no = 20;
    for ($i = 1 ; $i <= $extra_images_no ; $i++)
        {                                                                                          
            if (class_exists('MultiPostThumbnails')  && MultiPostThumbnails::has_post_thumbnail('page', "extra-image-" . $i . "")) :
                 $return_value = true; endif; 
            if (class_exists('MultiPostThumbnails')  && MultiPostThumbnails::has_post_thumbnail('post', "extra-image-" . $i . "")) :
                 $return_value = true; endif; 
            if (class_exists('MultiPostThumbnails')  && MultiPostThumbnails::has_post_thumbnail('portfolio_item', "extra-image-" . $i . "")) :
                 $return_value = true; endif; 
            if (get_post_meta(get_the_ID(), BRANKIC_VAR_PREFIX."background_image", true) == "extra-image-" . $i) $bg_image = true;    
            
        }
        if ($bg_image && $return_value == false) $return_value = false;
        if ($bg_image && $return_value == true) $return_value = true; 
        return $return_value;
}

  function get_portfolio_page_link($post_id)
{
    global $wpdb;
    //$categories = get_the_category($post_id);
    //$category = $categories[0]->cat_name;
    //$parents = get_category_parents(get_cat_ID( $category ), false, ',');
    //$parents = explode(",", $parents);
    
    $page_id = 1;
    $terms = get_the_terms( $post_id, 'portfolio_category' );
                        
    if ( $terms && ! is_wp_error( $terms ) )
    { 

        $parents = array();

        foreach ( $terms as $term ) 
        {
            //$parents[] = $term->term_taxonomy_id;
            $parents[] = $term->parent; 
        }

    }
    //print_r($parents);
    $parent = $parents[0];
    //$parent_id = get_cat_ID( $parent );
    
    $results = $wpdb->get_results("SELECT ID FROM $wpdb->posts
    WHERE post_content LIKE '%[bra_portfolio%' AND post_content LIKE '%cat_id%' AND post_content LIKE '%$parent%' AND post_type='page'");

    foreach ($results as $result) 
    {
        $page_id = $result->ID;
    }
    return get_page_link($page_id);

} 

function bra_is_youtube($video_url)
{
    if (strpos($video_url, "youtube.com") || strpos($video_url, "youtu.be")) return 1; else return 0;
}
function bra_is_vimeo($video_url)
{
    if (strpos($video_url, "vimeo.com")) return 1; else return 0;
}
function bra_is_swf($video_url)
{
    if (strpos($video_url, ".swf")) return 1; else return 0;
}
function bra_is_mov($video_url)
{
    if (strpos($video_url, ".mov")) return 1; else return 0;
}

function bra_get_youtube_id($url)
{
    preg_match('#http://w?w?w?.?youtube.com/watch\?v=([A-Za-z0-9\-_]+)#s', $url, $matches);
    if ($matches[1] == "")
    {
        preg_match('#http://w?w?w?.?youtu.be/([A-Za-z0-9\-_]+)#s', $url, $matches);
    }
    return $matches[1];
}
function bra_get_vimeo_id($url)
{
    preg_match('#https?://w?w?w?.?vimeo.com/([A-Za-z0-9\-_]+)#s', $url, $matches);
    return $matches[1];
}

 function closetags($html) {

  #put all opened tags into an array

  preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);

  $openedtags = $result[1];   #put all closed tags into an array

  preg_match_all('#</([a-z]+)>#iU', $html, $result);

  $closedtags = $result[1];

  $len_opened = count($openedtags);

  # all tags are closed

  if (count($closedtags) == $len_opened) {

    return $html;

  }

  $openedtags = array_reverse($openedtags);

  # close tags

  for ($i=0; $i < $len_opened; $i++) {

    if (!in_array($openedtags[$i], $closedtags)){

      $html .= '</'.$openedtags[$i].'>';

    } else {

      unset($closedtags[array_search($openedtags[$i], $closedtags)]);    }

  }  return $html;}  
  
function bra_excerpt($excerpt_length)
{
        $text = get_the_content('');
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = strip_tags($text, '<em><strong><i><b>');
        
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
        $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
        if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
        } else {
            $text = implode(' ', $words);
        }
        $text = closetags($text); 
    return $text;
}

// if no menu pressent fallback to.... used in wp_nav_menu
function header_fallback() {
              echo '<ul class="menu" id="no_wp_menu">';
              wp_list_pages('title_li=');
              echo '</ul>';
}

function register_my_menus() {
    register_nav_menus(
        array('primary-menu' => __( 'Primary Menu' ))
    );
}
add_action( 'init', 'register_my_menus' );

if ( has_nav_menu( 'primary-menu' ) ) {
     wp_nav_menu( array( 'theme_location' => 'primary-menu' ) );
}



add_filter( 'avatar_defaults', 'newgravatar' );  

function newgravatar ($avatar_defaults) {
     $myavatar = BRANKIC_ROOT . '/images/avatar.jpg';
     $avatar_defaults[$myavatar] = "Big Bang Avatar";
     return $avatar_defaults;
}


function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 45;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function no_wpautop($content) 
{ 
        $content = do_shortcode( shortcode_unautop($content) ); 
        $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
        return $content;
}

//Clean Up WordPress Shortcode Formatting - important for nested shortcodes
//adjusted from http://donalmacarthur.com/articles/cleaning-up-wordpress-shortcode-formatting/
function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

    return $content;
}


//move wpautop filter to AFTER shortcode is processed
//remove_filter( 'the_content', 'wpautop' );
//add_filter( 'the_content', 'wpautop' , 99);
//add_filter( 'the_content', 'shortcode_unautop', 100 );


remove_action('wp_head', 'wp_generator'); 



/*function convert_videos($string) {
    $rules = array(
        '#http://(www\.)?youtube\.com/watch\?v=([^ &\n]+)(&.*?(\n|\s))?#i' => '<object width="425" height="350"><param name="movie" value="http://www.youtube.com/v/$2"></param><embed src="http://www.youtube.com/v/$2" type="application/x-shockwave-flash" width="520" height="380"></embed></object>',
 
        '#http://(www\.)?vimeo\.com/([^ ?\n/]+)((\?|/).*?(\n|\s))?#i' => '<object width="400" height="300"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=$2&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=$2&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="520" height="380"></embed></object>'
    );
 
    foreach ($rules as $link => $player)
        $string = preg_replace($link, $player, $string);
 
    return $string;
} */



if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Default',
		'id' => 'default',
        'description' => 'Default sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));
        
    register_sidebar(array(
        'name' => 'Footer_1st_box',
        'id' => 'Footer_1st_box',
        'descriptiom' => '1st box in footer',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div><!--END widget wrapper-->    ',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Footer_2nd_box',
        'id' => 'Footer_2nd_box',
        'descriptiom' => '2nd box in footer',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div><!--END widget wrapper-->    ',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Footer_3rd_box',
        'id' => 'Footer_3rd_box',
        'descriptiom' => '3rd box in footer',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div><!--END widget wrapper-->    ',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Footer_4th_box',
        'id' => 'Footer_4th_box',
        'descriptiom' => '4th box in footer',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div><!--END widget wrapper-->    ',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Footer_left',
        'id' => 'Footer_left',
        'descriptiom' => 'Bottom Footer left hand side',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Footer_right',
        'id' => 'Footer_right',
        'descriptiom' => 'Bottom Footer right hand side',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'name' => 'Optional 1',
		'id' => 'optional_1',
        'description' => 'Optional sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => 'Optional 2',
		'id' => 'optional_2',
        'description' => 'Optional sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => 'Optional 3',
		'id' => 'optional_3',
        'description' => 'Optional sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="title">',
        'after_title' => '</h3>'
    )); 

}
// end of sidebars

function my_scripts_method() {
    //global $root, $post, $var_prefix;
	
	//wp_register_script("isotope", BRANKIC_ROOT."/javascript/jquery.isotope.min.js");
	
    
    wp_enqueue_style("default_stylesheet", BRANKIC_ROOT."/style.css");
 
    wp_enqueue_style("style", BRANKIC_ROOT."/css/style.css");
    wp_enqueue_style("css_color_style", BRANKIC_ROOT."/css/colors/color-".of_get_option(BRANKIC_VAR_PREFIX."color", of_get_default(BRANKIC_VAR_PREFIX."color")).".css");
    wp_enqueue_style("blog", BRANKIC_ROOT."/css/blog.css");
    
    wp_enqueue_style("socialize-bookmarks", BRANKIC_ROOT."/css/socialize-bookmarks.css");
    
    wp_enqueue_script('jquery');
     
    wp_enqueue_script("custom", BRANKIC_ROOT."/javascript/custom.js");

    wp_enqueue_style("prettyPhoto", BRANKIC_ROOT."/css/prettyPhoto.css");
    wp_enqueue_script("prettyPhoto", BRANKIC_ROOT."/javascript/prettyPhoto.js");
    
    wp_enqueue_script("isotope", BRANKIC_ROOT."/javascript/jquery.isotope.min.js"); 
    
    wp_enqueue_script("jquery_flexslider", BRANKIC_ROOT."/javascript/jquery.flexslider.js");
    wp_enqueue_style("jquery_flexslider", BRANKIC_ROOT."/css/flexslider.css");  
    
    wp_enqueue_script("backstretch", BRANKIC_ROOT."/javascript/jquery.backstretch.min.js"); 
    
    $layout = of_get_option(BRANKIC_VAR_PREFIX."boxed_stretched", of_get_default(BRANKIC_VAR_PREFIX."boxed_stretched"));
    if (isset($_GET["layout"])) 
    {
        if ($_GET["layout"] == "stretched") $layout = "stretched" ;
        if ($_GET["layout"] == "boxed") $layout = "boxed" ;
    }
    
    if ($layout == "stretched") wp_enqueue_style("style-stretched", BRANKIC_ROOT."/css/style-stretched.css");
    
    $disable_responsive = of_get_option(BRANKIC_VAR_PREFIX."disable_responsive", of_get_default(BRANKIC_VAR_PREFIX."disable_responsive"));
    if ($disable_responsive != "yes") 
    {
        wp_enqueue_style("media_queries", BRANKIC_ROOT."/css/media_queries.css");
        
        add_action('wp_head', 'responsive_meta_tags');
        function responsive_meta_tags()
        {
           echo '<meta name="viewport" content="initial-scale=1, maximum-scale=1" />';
           echo '<meta name="viewport" content="width=device-width" />'; 
        }
    }
    
    wp_enqueue_script("google_map_api", "http://maps.googleapis.com/maps/api/js?sensor=false");
    wp_enqueue_script("google_map_plugin", BRANKIC_ROOT."/javascript/google_map_plugin.js"); 
     

    wp_enqueue_script("bra_photostream", BRANKIC_ROOT."/javascript/bra.photostream.js");
    
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
    

    
    if (of_get_option(BRANKIC_VAR_PREFIX."pinned_menu", of_get_default(BRANKIC_VAR_PREFIX."pinned_menu")) != "no") 
    {   
        wp_enqueue_script("bra_header", BRANKIC_ROOT."/javascript/header.js");
    }
    
     
  
}    

add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');
 
add_action('wp_enqueue_scripts', 'my_scripts_method');

add_theme_support( 'automatic-feed-links' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'portfolio_item',
        array(
            'labels' => array(
                'name' => __( 'Portfolio Items' ),
                'singular_name' => __( 'Portfolio Item' ),
                'add_item' => __('New Portfolio Item'),
                'add_new_item' => __('Add New Portfolio Item'),
                'edit_item' => __('Edit Portfolio Item') 
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'portfolio'),
            'menu_position' => 5,
            'show_ui' => true,
            'supports' => array('author', 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'post-formats', 'comments')
            
        )
    );
    flush_rewrite_rules();
}




add_action( 'init', 'create_portfolio_category_taxonomies', 0 );
function create_portfolio_category_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => __( 'Portfolio Categories', 'taxonomy general name' ),
    'singular_name' => __( 'Portfolio Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Portfolio Categories' ),
    'all_items' => __( 'All Portfolio Categories' ),
    'parent_item' => __( 'Parent Portfolio Category' ),
    'parent_item_colon' => __( 'Parent Portfolio Category:' ),
    'edit_item' => __( 'Edit Portfolio Category' ), 
    'update_item' => __( 'Update Portfolio Category' ),
    'add_new_item' => __( 'Add New Portfolio Category' ),
    'new_item_name' => __( 'New Portfolio Category Name' ),
    'menu_name' => __( 'Portfolio Categories' ),
  );     

  register_taxonomy('portfolio_category',array('portfolio_item'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portfolio_category' ),
  ));
  
  //require_once (BRANKIC_INCLUDES . 'bra_create_portfolio_select.php');
}


function bra_contact_page_create_field($bra_contact_page_field, $bra_contact_page_field_title, $bra_contact_page_field_required, $bra_contact_page_field_select)
{
    global $_POST;
    $required = "";
    $required_class = "";
    if ($bra_contact_page_field != "Nothing")
    {
        if ($bra_contact_page_field_required == "yes") 
        {
            $required = "<em>(".__('*', BRANKIC_THEME_SHORT).")</em>";
            $required_class = "requiredField";
        }
        if ($bra_contact_page_field_required == "yes_email") 
        {
            $required = "<em>(".__('*', BRANKIC_THEME_SHORT).")</em>";
            $required_class = "requiredField email";
        }
        
        $field_name = "bra_".only_characters($bra_contact_page_field_title);
    ?>
                <li <?php if ($bra_contact_page_field == "textarea") echo "class='textarea'" ?>>
                    <p><strong><?php echo $bra_contact_page_field_title; ?></strong> <?php echo $required; ?></p>
                    <?php 
                    if ($bra_contact_page_field == "text")
                    {
                    ?>
                    <input name="<?php echo $field_name; ?>" type="text" class="<?php echo $required_class; ?> bra_c_form" />
                    <?php
                    }
                    ?>
                    
                    <?php 
                    if ($bra_contact_page_field == "textarea")
                    {
                    ?>
                    <textarea name="<?php echo $field_name; ?>" rows="20" cols="30" class="<?php echo $required_class; ?> bra_c_form"></textarea>    
                    <?php
                    }
                    ?>
                    
                    <?php 
                    if ($bra_contact_page_field == "select")
                    {
                        $bra_contact_page_field_select_array = explode(",", $bra_contact_page_field_select);
                    ?>              
                    <select name="<?php echo $field_name; ?>" class="<?php echo $required_class; ?> bra_c_form">
                    <option></option>
                      <?php
                      foreach ($bra_contact_page_field_select_array as $option)
                      {
                      ?>
                      <option><?php echo $option; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                    <?php
                    }
                    ?>
                    
                                      
                    
                    
                </li>
    <?php
    }
}

function only_characters($string)
{
    $pattern = '/[^A-Za-z0-9:.\/_-]/';
    $clean = preg_replace($pattern,'',$string);
    return $clean;
}

function bra_get_images($posttext)
{
    // We will search for the src="" in the post content
    $regular_expression = '~src="[^"]*"~';
    $regular_expression1 = '~<img [^\>]*\ />~';
     
    // WE will grab all the images from the post in an array $allpics using preg_match_all
    preg_match_all( $regular_expression, $posttext, $allpics );
     
    // Count the number of images found.
    $NumberOfPics = count($allpics[0]);
    
    $images_src = $allpics[0];
    
    foreach($images_src as $image_src)
    {
        $image = ltrim($image_src, 'src="');
        $image = rtrim($image, '"');
        $images[] = $image;
    } 
    
    if (isset($images)) return $images; else return array();
}

/**
Validate an email address.
Provide email address (raw input)
Returns true if the email address has the email 
address format and the domain exists.
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if
(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',
                 str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
/*      if ($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
      {
         // domain not found in DNS
         $isValid = false;
      }*/
   }
   return $isValid;
}



?>