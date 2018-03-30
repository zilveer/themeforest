<?php

/*====================================================================================================
Set Up Theme
======================================================================================================*/
if ( ! function_exists( 'indonez_setup' ) ) {
	function indonez_setup() {
		
	//Make theme available for translation
	load_theme_textdomain( 'vulcan', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";

	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	//Define content width
	if(!isset($content_width)) $content_width = 960;

	//This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	//Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
    
    add_theme_support( 'title-tag' );
		
    add_post_type_support( 'page', 'excerpt' );
    
	//This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'topnav' => __( 'Main Navigation','myhosting')
	) );
	
	//This theme uses post thumbnails
	if (function_exists('add_theme_support')) {
		add_theme_support( 'post-thumbnails');
		set_post_thumbnail_size( 200, 200 );
	}
	
	//Use Shortcode on the exceprt
	add_filter( 'the_excerpt', 'do_shortcode');
	
	//Use Shortcode on text widget
	add_filter('widget_text', 'do_shortcode');
	
		
	}
}
add_action( 'after_setup_theme', 'indonez_setup' );


/*---------------------------------------------------------
  Custom post excerpt base on words number 
-----------------------------------------------------------*/
function excerpt($excerpt_length) {
  global $post;
	$content = strip_shortcodes($post->post_content);
	$words = explode(' ', $content, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '...');
		$content = implode(' ', $words);
	endif;
  
  $content = strip_tags($content);
  
	return $content;
}


/*---------------------------------------------------------
  Comment list 
-----------------------------------------------------------*/
function indonez_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
      <div class="avatar"><?php echo get_avatar($comment,$size='60'); ?></div>
      <div class="comment-text" ><h6><?php echo get_comment_author_link(); ?></h6>
      <small>
      <?php printf(__('%1$s at %2$s','prime'), get_comment_date(),  get_comment_time()) ?><?php edit_comment_link(__('(Edit)','prime'),'  ','') ?>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </small>
      <?php if ($comment->comment_approved == '0') : ?>
			<em><?php echo __('Your comment is awaiting moderation.','prime');?></em>
			<div class="clear"></div>
			<?php endif; ?>
		  <?php comment_text() ?>
      </div>
  </li>
<?php
}

// Output the styling for the seperated Pings
function indonez_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>
    <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?></li>
<?php }


/*---------------------------------------------------------
  Register javascript 
-----------------------------------------------------------*/
function indonez_add_javascripts() {
  wp_enqueue_scripts('jquery');
  wp_enqueue_script( 'jquery.cycle.all', get_template_directory_uri().'/js/jquery.cycle.all.js', array( 'jquery' ), '', true   );
  wp_enqueue_script( 'jquery.corner', get_template_directory_uri().'/js/jquery.corner.js', array( 'jquery' ), '', true   );
  wp_enqueue_script( 'jquery.prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array( 'jquery' ), '', true   );
  wp_enqueue_script( 'jquery.tools.tabs.min', get_template_directory_uri().'/js/jquery.tools.tabs.min.js', array( 'jquery' ), '', true   );
  wp_enqueue_script( 'jquery.gmap.min', get_template_directory_uri().'/js/jquery.gmap.min.js', array('jquery'), '', true   );
  wp_enqueue_script('functions', get_template_directory_uri().'/js/functions.js', array('jquery'), '', true   );
}

if (!is_admin()) {
  add_action( 'wp_print_scripts', 'indonez_add_javascripts' ); 
}

/*====================================================================================================
Load CSS
======================================================================================================*/
function indonez_add_stylesheet() { 
  if (!is_admin()) {
    wp_register_style('vulcan_css', get_bloginfo( 'stylesheet_url' ), '', '', 'all');
  	wp_enqueue_style('vulcan_css');
    
    wp_register_style('vulcan_prettyPhoto', get_template_directory_uri().'/css/prettyPhoto.css', '', '', 'screen, all');
  	wp_enqueue_style('vulcan_prettyPhoto');
    
  }
}

add_action('init', 'indonez_add_stylesheet');


/*---------------------------------------------------------
  Register Nav Menu
-----------------------------------------------------------*/
register_nav_menus( array(
	'topnav' => __( 'Main Navigation','vulcan'),
	'footernav' => __( 'Footer Navigation','vulcan'),
) );

/*---------------------------------------------------------
  Main navigation menu callback
-----------------------------------------------------------*/
function indonez_topmenu_pages() {
  global $excludeinclude_pages;
  
  $excludeinclude_pages = get_option('vulcan_excludeinclude_pages');
  if(is_array($excludeinclude_pages)) {
    $page_exclusions = implode(",",$excludeinclude_pages);
  }
?>
	<ul class="navigation">
  	<li <?php if (is_home() || is_front_page()) echo 'class="current"';?>><a href="<?php echo home_url();?>">Home</a></li>
  	<?php wp_list_pages('title_li=&sort_column=menu_order&depth=4&exclude='.$page_exclusions);?>
  </ul>

<?php
}

/*---------------------------------------------------------
  Footer navigation menu callback
-----------------------------------------------------------*/
function indonez_footermenu_pages() {
  global $excludeinclude_pages;
  
  $excludeinclude_pages = get_option('vulcan_excludeinclude_pages');
  if(is_array($excludeinclude_pages)) {
    $page_exclusions = implode(",",$excludeinclude_pages);
  }
?>
	<ul class="navigation-footer">
  	<li <?php if (is_home() || is_front_page()) echo 'class="current"';?>><a href="<?php echo home_url();?>">Home</a></li>
  	<?php wp_list_pages('title_li=&sort_column=menu_order&depth=1&exclude='.$page_exclusions);?>
  </ul>

<?php
}

/* Remove Default Container for Nav Menu Features */
function indonez_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
} 
add_filter( 'wp_nav_menu_args', 'indonez_nav_menu_args' );


/*---------------------------------------------------------
  Get Vimeo Video ID
-----------------------------------------------------------*/
function vimeo_videoID($url) {
	if ( 'http://' == substr( $url, 0, 7 ) ) {
		preg_match( '#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i', $url, $matches );
		if ( empty($matches) || empty($matches[3]) ) return __('Unable to parse URL', 'ovum');

		$videoid = $matches[3];
		return $videoid;
	}
}

/*---------------------------------------------------------
  Get Youtube Video ID
-----------------------------------------------------------*/
function youtube_videoID($url) {
	preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)#i', $url, $matches );
	if ( empty($matches) || empty($matches[3]) ) return __('Unable to parse URL', 'ovum');
  
  $videoid = $matches[3];
	return $videoid;
}

/*---------------------------------------------------------
  Detext File Extension
-----------------------------------------------------------*/
function detect_ext($file) {
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  return $ext;
}

function is_quicktime($file) {
  $quicktime_file = array("mov","3gp","mp4");
  if (in_array(pathinfo($file, PATHINFO_EXTENSION),$quicktime_file)) {
    return true;
  } else {
    return false;
  }
}

function is_flash($file) {
  if (pathinfo($file, PATHINFO_EXTENSION) == "swf") {
    return true;
  } else {
    return false;
  }
}

function is_youtube($file) {
  if (preg_match('/youtube/i',$file)) {
    return true;
  } else {
    return false;
  }
}

function is_vimeo($file) {
  if (preg_match('/vimeo/i',$file)) {
    return true;
  } else {
    return false;
  }
}

/*---------------------------------------------------------
  Add shortcode to text widget and post excerpt
-----------------------------------------------------------*/
function theme_widget_text_shortcode($content) {
	$content = do_shortcode($content);
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= do_shortcode($piece);
		}
	}

	return $new_content;
}
// Allow Shortcodes in Sidebar Widgets
add_filter('widget_text', 'theme_widget_text_shortcode');


/*---------------------------------------------------------
  Custom thumbnail for portfolio list page
-----------------------------------------------------------*/
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
 
  function fb_AddThumbColumn($cols) {
   
  $cols['thumbnail'] = __('Thumbnail','ebiz');
   
  return $cols;
}
 
function fb_AddThumbValue($column_name, $post_id) {
   
  $width = (int) 100;
  $height = (int) 100;
   
  if ( 'thumbnail' == $column_name ) {
    // thumbnail of WP 2.9
    $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
    // image from gallery
    $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
    if ($thumbnail_id)
    $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
    elseif ($attachments) {
      foreach ( $attachments as $attachment_id => $attachment ) {
        $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
      }
    }
      if ( isset($thumb) && $thumb ) {
      echo $thumb;
      } else {
      echo __('None','ebiz');
      }
    }
  }
 
  // for posts
  add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
  add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
   
  // for Portfolio
  add_filter( 'manage_portfolio_columns', 'fb_AddThumbColumn' );
  add_action( 'manage_portfolio_custom_column', 'fb_AddThumbValue', 10, 2 );
}

add_filter('manage_edit-portfolio_columns', 'portfolio_columns');
function portfolio_columns($columns) {
    $columns['category'] = 'Portfolio Category';
    return $columns;
}

add_action('manage_posts_custom_column',  'portfolio_show_columns');
function portfolio_show_columns($name) {
    global $post;
    switch ($name) {
        case 'category':
            $cats = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' );
            echo $cats;
    }
}

/*====================================================================================================
Display tweets with api 1.1
======================================================================================================*/
function idz_func_buildBaseString($baseURI, $method, $params) {
	$r = array();
	ksort($params);
	foreach($params as $key=>$value){
		$r[] = "$key=" . rawurlencode($value);
	}
	return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function idz_func_buildAuthorizationHeader($oauth) {
	$r = 'Authorization: OAuth ';
	$values = array();
	foreach($oauth as $key=>$value)
		$values[] = "$key=\"" . rawurlencode($value) . "\"";
	$r .= implode(', ', $values);
	return $r;
}

function indonez_get_twitter_timeline($title="",$twitter_id, $max_tweets=1, $consumer_key, $consumer_secret, $user_token, $user_secret){
  $out ='';
  if ($title !="") {
    $out .= $title;
  }
	$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
	$oauth_access_token = $user_token;
	$oauth_access_token_secret = $user_secret;
	$consumer_key = $consumer_key;
	$consumer_secret = $consumer_secret;
	$oauth = array( 'screen_name' => $twitter_id,
					'count' => $max_tweets,
					'oauth_consumer_key' => $consumer_key,
					'oauth_nonce' => time(),
					'oauth_signature_method' => 'HMAC-SHA1',
					'oauth_token' => $oauth_access_token,
					'oauth_timestamp' => time(),
					'oauth_version' => '1.0');

	$base_info = idz_func_buildBaseString($url, 'GET', $oauth);
	$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
	$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
	$oauth['oauth_signature'] = $oauth_signature;

	// Make Requests
	$header = array(idz_func_buildAuthorizationHeader($oauth), 'Expect:');
	$options = array( CURLOPT_HTTPHEADER => $header,
					  //CURLOPT_POSTFIELDS => $postfields,
					  CURLOPT_HEADER => false,
					  CURLOPT_URL => $url . '?screen_name='.$twitter_id.'&count='.$max_tweets, 
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_SSL_VERIFYPEER => false);

	$feed = curl_init();
	curl_setopt_array($feed, $options);
	$json = curl_exec($feed);
	curl_close($feed);

	$twitter_data = json_decode($json);
  
  $out .= '<div id="twitter"><ul class="tweet_list">';
	foreach ($twitter_data as $key=>$value) {
  	$regex = '@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.\,]*(\?\S+)?)?)*)@';
  	$text  = $value->text;
  	$text  = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\./-]*(\?\S+)?)?)?)@', '<a target="blank" title="$1" href="$1">$1</a>', $text);
  	$text  = preg_replace('/#([0-9a-zA-Z_-]+)/', "<a target='blank' title='$1' href=\"http://twitter.com/search?q=$1\">#$1</a>",  $text);
  	$text  = preg_replace("/@([0-9a-zA-Z_-]+)/", "<a target='blank' title='$1' href=\"http://twitter.com/$1\">@$1</a>", $text);
  
  	$out  .='<li>' . $text . '</li>';
	};
  $out .='</ul></div>';
  
	return $out;
}       

/*---------------------------------------------------------
  Client List
-----------------------------------------------------------*/
function indonez_clientslist($number=-1,$title="",$orderby="",$home=true) {
  global $post;
  
  if ($title != "") echo $title;
  ?>
  <ul class="client-list">
    <?php 
      $counter= 0;
      
      query_posts(array( 'post_type' => 'client', 'posts_per_page' => $number,"orderby" => $orderby,'order'=> 'DESC'));
      
			while (have_posts()) : the_post();
      $thumb   = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $image   = aq_resize( $img_url, 64, 64, true ); //resize & crop the image
      $custom_url = get_post_meta( $post->ID,'_custom_url',true ); 
			$counter++;
      
      if ($home == true) {
        if ($counter %4 == 0) {
          echo '<li class="client-last">';
        } else {
          echo '<li>';
        }
      } else {
        if ($counter %3 == 0) {
          echo '<li class="client-last">';
        } else {
          echo '<li>';
        }
      }
    ?>  
      <?php if ($custom_url) { ?>
        <a href="<?php echo $custom_url;?>">
          <img src="<?php echo $image;?>" alt="" />
        </a>
      <?php } else { ?>
          <img src="<?php echo $image;?>" alt="" />
      <?php } ?>
      </li>
      <?php endwhile;?>
      <?php wp_reset_query();?>
  </ul>  
  <?php
}

/*---------------------------------------------------------
  Latest Portfolio
-----------------------------------------------------------*/
function indonez_latest_portfolio($number=-1,$title="",$home=true) {
  
  if ($title != "") echo $title;
  ?>
  <ul class="client-list">
    <?php 
      $counter= 0;
      
      $portfolio = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' => $number));
			while ($portfolio->have_posts()) : $portfolio->the_post();
      $thumb   = get_post_thumbnail_id();
      $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
      $image   = aq_resize( $img_url, 64, 64, true ); //resize & crop the image
			$counter++;
      
      if ($home == true) {
        if ($counter %4 == 0) {
          echo '<li class="client-last">';
        } else {
          echo '<li>';
        }
      } else {
        if ($counter %3 == 0) {
          echo '<li class="client-last">';
        } else {
          echo '<li>';
        }
      }
    ?>
      <a href="<?php the_permalink();?>">
        <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
          <img src="<?php echo $image;?>" alt="" />
        <?php } ?>      
      </a>
      </li>
      <?php endwhile;?>
      <?php wp_reset_query();?>
  </ul>  
  <?php
}


/*---------------------------------------------------------
  Testimonial List
-----------------------------------------------------------*/
function indonez_testimonials($number=1,$title="",$orderby="date") {
  
  echo $title;
  
  ?>
  <?php  
  query_posts(array( 'post_type' => 'testimonial', 'posts_per_page' => $number,"orderby" => $orderby,'order'=> 'DESC'));
  while (have_posts()) : the_post(); 
  ?>
  <blockquote>
  <?php the_content();?>
  </blockquote>
  <p><strong><?php the_title();?></strong></p>
  <br />
  <?php endwhile;?>
  <?php wp_reset_query();?>    
  <?php
}

/*---------------------------------------------------------
  Latest News
-----------------------------------------------------------*/
function indonez_latestnews($blog_cat,$number=4,$title="",$sidebar=1) { 

    echo $title;
    ?>
    <ul class="<?php if ($sidebar == 1) echo 'itemlist'; else echo 'list-bottom';?>">
    <?php
    $listblog = new WP_Query('cat='.$blog_cat.'&showposts='.$number);
    while ($listblog->have_posts()) : $listblog->the_post();
    ?>                               
    <li><a href="<?php the_permalink();?>"><?php the_title();?> - <strong><?php the_time('d F Y');?></strong></a></li>
    <?php endwhile;wp_reset_query();?>
    </ul>
  <?php
}

/*---------------------------------------------------------
  Staff List
-----------------------------------------------------------*/
function indonez_stafflist($num=4, $orderby="date", $title="") {  
  global $post;
  
  $post_num = ($num) ? $num : 4;
  $counter = 0;
  
  query_posts(array( 'post_type' => 'staff', 'posts_per_page' => $num,"orderby" => $orderby,'order'=> 'DESC'));
  
  $out = "";
  $out .= ($title) ? "<h3>".$title."</h3>" : "";
  $out .= '<ul class="teamlist">';
  while (have_posts()) : the_post();
    $thumb   = get_post_thumbnail_id();
    $img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
    $image   = aq_resize( $img_url, 60, 60, true ); //resize & crop the image
    
    $counter++;
    if ($counter%2 ==0) {
      $out .= '<li class="last">';  
    } else {
      $out .= '<li>';
    }
    
    $out .= '<div class="about-team">';
    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
      $out .= '<img src="'.$image.'" alt="" class="imgleft border" />';
    }    
    $out .= '</div>';
    $out .= '<strong><a href="'.get_permalink().'">'.get_the_title().'</a></strong><p>'.excerpt(30).'</p>';
    $out .= '</li>';
    endwhile;
    $out .= '</ul>';
    wp_reset_query();
  return $out;
}

/*---------------------------------------------------------
  Pagination
-----------------------------------------------------------*/
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1; 
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
 
     if(1 != $pages)
     {
         echo "<div class=\"pages blogpages\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."'>".$i."</a>";
             }
         }
 
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

/*---------------------------------------------------------
  Post Type Pagination
-----------------------------------------------------------*/

// Set number of posts per page for taxonomy pages
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
	global $option_posts_per_page;
	
	// Get theme panel admin
    if(get_option('vulcan_porto_num')) {
		  $portfolio_number_per_page = get_option('vulcan_porto_num');
		} else {
		  $portfolio_number_per_page = '-1';
		}
	
    if (is_tax( 'portfolio_category') ) {
        return $portfolio_number_per_page;
    } else {
        return $option_posts_per_page;
    }
}

/*---------------------------------------------------------
  Add excerpt for page
-----------------------------------------------------------*/
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

/*-----------------------------------------------------------------------------------*/
/*	Output Custom CSS Into Header
/*-----------------------------------------------------------------------------------*/

function indonez_custom_css() {
  global $data;
  
  $vulcan_style = get_option('vulcan_style'); 
  $custom_css_box = get_option('vulcan_custom_css');
  $custom_body_text = get_option('vulcan_custom_body_text');
  
  $custom_css = '';
  
  if ($vulcan_style != "") {
    if ($vulcan_style == "green.css") {
      $custom_css .= '@import url("'.get_template_directory_uri().'/css/styles/green.css");';
    } else if ($vulcan_style == "blue.css") {
      $custom_css .='@import url("'.get_template_directory_uri().'/css/styles/blue.css");';
    } else if ($vulcan_style == "orange.css") {
      $custom_css .='@import url("'.get_template_directory_uri().'/css/styles/orange.css");';
    } else if ($vulcan_style == "purple.css") {
      $custom_css .='@import url("'.get_template_directory_uri().'/css/styles/purple.css");';
    } else if ($vulcan_style == "default.css") {
      $custom_css .='@import url("'.get_template_directory_uri().'/css/styles/default.css");';
    }
  } 
  
  if ($custom_body_text !== "") {
    $custom_css .= '
      body{
      	font-family:'.$custom_body_text['face'].';	
      	font-size:'.$custom_body_text['size'].'px;	
      	color:'.$custom_body_text['color'].';
      }    
      p, ul, ol, blockquote{
      	font-size:'.$custom_body_text['size'].'px;
      	color:'.$custom_body_text['color'].';
      }      
    ';
  }
  
  if ($custom_css_box !="") {
    $custom_css .= $custom_css_box."\n";
  }
  
	/**echo all css**/
	$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css . "\n</style>";
	
	if(!empty($custom_css)) {
		echo $css_output;
	}
}

add_action('wp_head', 'indonez_custom_css');
?>