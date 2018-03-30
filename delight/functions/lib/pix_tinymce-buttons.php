<?php
/*------------------ TINYMCE BUTTONS ------------------*/
function add_delight_plugin() {
  global $typenow, $pagenow;
  if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
    if ( empty( $typenow ) && !empty( $_GET['post'] ) ) {
          $post = get_post( $_GET['post'] );
          $typenow = $post->post_type;
      } elseif ( empty( $typenow ) && !empty( $_GET['post_type'] ) ) {
          $typenow = $_GET['post_type'];
      } else {
          $typenow = 'post';
    }
    
    if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
      return;
    if ( get_user_option('rich_editing') == 'true') {
      add_filter('mce_external_plugins', 'add_delight_js');
      add_filter('mce_buttons_3', 'register_delight_buttons');
     }

  }
}

add_action('init', 'add_delight_plugin');


function add_delight_js($plugin_array) {
  global $pagenow;
  if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
    $plugin_array['delight'] = get_template_directory_uri().'/functions/scripts/shortcode_buttons.js';
    return $plugin_array;
  }
}

function register_delight_buttons($buttons) {
   array_push(
    $buttons, 
    "pix_slideshow_sc",
    "pix_googlemap_sc",
    "pix_contactform_sc",
    "pix_tooltip_sc",
    "pix_video_sc",
    "pix_audio_sc",
    "pix_accordion_sc",
    "pix_tab_sc",
    "pix_column_sc",
    "pix_sitemap_sc",
    "pix_box_sc",
    "pix_list_sc",
    "pix_dropcap_sc",
    "pix_button_sc",
    "pix_pricetable_sc",
    "pix_span_sc",

    "pix_hr_sc",
    "pix_totop_sc",
    "pix_clear_sc"
  );
   return $buttons;
}

/*------------------ ### ------------------*/

function pix_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}

add_filter( 'tiny_mce_version', 'pix_refresh_mce');