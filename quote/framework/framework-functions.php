<?php

//==========================================================
// === COLOUR HANDLER
//==========================================================
function dt_hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}


//==========================================================
// === POST COUNTER
//==========================================================
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return '<span class="entry-meta-sep"> &sdot; </span> <i class="el-icon-graph meta-icon"></i><span class="count">'.$count.'</span> Views';
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


//==========================================================
// === SHARING
//==========================================================
function quote_share() { 
	$twitterusername = get_theme_mod('twitter-username'); ?>

<script type="text/javascript">
jQuery(function(){
	jQuery('#twitter').sharrre({
		share: {
			twitter: true
		},
  		urlCurl: '<?php echo get_template_directory_uri(); ?>/framework/dt-sharrre.php',
  		enableHover: false,
		enableTracking: true,
  		buttons: { twitter: {via: '<?php echo $twitterusername; ?>'}},
  		click: function(api, options){
    		api.simulateClick();
    		api.openPopup('twitter');
		}
	});
	jQuery('#facebook').sharrre({
 	share: {
   		facebook: true
 	 },
 	urlCurl: '<?php echo get_template_directory_uri(); ?>/framework/dt-sharrre.php',
 	enableHover: false,
  	enableTracking: true,
  		click: function(api, options){
    	api.simulateClick();
    	api.openPopup('facebook');
	  	}
	});
	jQuery('#googleplus').sharrre({
  	share: {
    	googlePlus: true
  	},
 	urlCurl: '<?php echo get_template_directory_uri(); ?>/framework/dt-sharrre.php',
 	enableHover: false,
  	enableTracking: true,
	  	click: function(api, options){
	    	api.simulateClick();
	    	api.openPopup('googlePlus');
		}
	});
});
</script>

<div id="sharebox" class="btn-group mt gap">
  <div id="twitter" class="btn btn-default btn-lg" data-url="<?php echo get_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="Tweet"></div>
  <div id="facebook" class="btn btn-default btn-lg" data-url="<?php echo get_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="Like"></div>
  <div id="googleplus" class="btn btn-default btn-lg" data-url="<?php echo get_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="+1"></div>
</div>

<?php }


//==========================================================
// === IMAGE ADMIN COLUMNS
//==========================================================
add_filter('manage_posts_columns', 'tcb_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'tcb_add_post_thumbnail_column', 5);

function tcb_add_post_thumbnail_column($cols){
  $cols['tcb_post_thumb'] = __('Featured Image', 'quote' );
  return $cols;
}

add_action('manage_posts_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'tcb_display_post_thumbnail_column', 5, 2);

function tcb_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'tcb_post_thumb':
      if( function_exists('the_post_thumbnail') )
        echo the_post_thumbnail( 'widget-featured' );
      else
        echo 'Not supported in theme';
      break;
  }
}


//==========================================================
// === GALLERY AUTO
//==========================================================
function amethyst_gallery_atts( $out, $pairs, $atts ) {
   
    $atts = shortcode_atts( array(
        'columns' => '3',
        'size' => 'main-featured',
         ), $atts );

    $out['columns'] = $atts['columns'];
    $out['size'] = $atts['size'];

    return $out;

}
add_filter( 'shortcode_atts_gallery', 'amethyst_gallery_atts', 10, 3 );


//==========================================================
// === LIMIT TAG CLOUD
//==========================================================
add_filter('widget_tag_cloud_args', 'tag_widget_limit');

function tag_widget_limit($args){

 if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
  $args['number'] = 15; //Limit number of tags
 }

 return $args;
}


//==========================================================
// === LIMIT TAG CLOUD
//==========================================================
add_action('admin_notices', 'dt_quote_admin_notice');
function dt_quote_admin_notice() {
    global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
    if ( ! get_user_meta($user_id, 'dt_quote_ignore_notice') ) {
        echo '<div class="updated"><p>';
        printf(__('Thanks for choosing Distinctive Themes, to get your new theme all ready to use, please visit the theme customizer page and <strong>hit SAVE immediatley</strong>, this is ensure the new options are setup for you. | <a href="%1$s">Hide Notice</a>'), '?dt_quote_nag_ignore=0');
        echo "</p></div>";
    }
}
add_action('admin_init', 'dt_quote_nag_ignore');
function dt_quote_nag_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['dt_quote_nag_ignore']) && '0' == $_GET['dt_quote_nag_ignore'] ) {
             add_user_meta($user_id, 'dt_quote_ignore_notice', 'true', true);
    }
}

function ebor_portfolio_load_more($pages = '', $range = 2){
  $showitems = ($range * 2)+1;
    
    global $paged;
    if(empty($paged)) $paged = 1;
    
    if($pages == ''){
      global $wp_query;
      $pages = $wp_query->max_num_pages;
        if(!$pages) {
          $pages = 1;
        }
    }
    
    $displays = get_option('dt_portfolio_slug');
    if( $displays ){ $slug = ''; } else { $slug = 'dt_portfolio_cpt'; }
    
    if(1 != $pages){
      echo "<div class='load-more-projects'><ul>";
      
      for ($i=1; $i <= $pages; $i++){
          echo ($paged == $i)? "":"<li><a href='".home_url('/'.$slug.'/page/'.$i)."'>".__('Load More','marble')." <i class='icon-arrows-cw'></i></a></li>";
      }
  
      echo "</ul></div>";
    }
}

function ebor_blog_load_more($pages = '', $range = 2){
  $showitems = ($range * 2)+1;
    
    global $paged;
    if(empty($paged)) $paged = 1;
    
    if($pages == ''){
      global $wp_query;
      $pages = $wp_query->max_num_pages;
        if(!$pages) {
          $pages = 1;
        }
    }
    
    ( get_option('show_on_front') == 'page') ? $permalink = '' : $permalink = trailingslashit( home_url() );
    
    if(1 != $pages){
      echo "<div class='load-more-posts'><ul>";
      
      for ($i=1; $i <= $pages; $i++){
          echo ($paged == $i)? "":"<li><a href='".$permalink.'page/'.$i."'>".__('Load More','marble')."</a></li>";
      }
  
      echo "</ul></div>";
    }
}

//==========================================================
// === FAVICONS
//==========================================================
if(!( function_exists('ebor_load_favicons') )){
    function ebor_load_favicons() {
        if ( get_option('144_favicon') !='' )
            echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . get_option('144_favicon') . '">';
        
        if ( get_option('114_favicon') !='' )
            echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . get_option('114_favicon') . '">';
            
        if ( get_option('72_favicon') !='' )
            echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . get_option('72_favicon') . '">';
            
        if ( get_option('mobile_favicon') !='' )
            echo '<link rel="apple-touch-icon-precomposed" href="' . get_option('mobile_favicon') . '">';
            
        if ( get_option('custom_favicon') !='' )
            echo '<link rel="shortcut icon" href="' . get_option('custom_favicon') . '">';
    }
}

add_action('wp_head', 'ebor_load_favicons');

?>