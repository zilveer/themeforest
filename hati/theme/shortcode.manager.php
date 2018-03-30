<?php

class AShortcodeManager extends Acorn {

  static function setup() {
    
    if ( current_user_can('edit_pages') && current_user_can('edit_posts') ) {
      add_action ('admin_footer-post.php', 'AShortcodeManager::customFootScripts');
      add_action ('admin_footer-post-new.php', 'AShortcodeManager::customFootScripts');
    }
    
    add_filter( 'tiny_mce_before_init', 'AShortcodeManager::setTinyMCEInitFunction' );
  }
  
  static function setTinyMCEInitFunction ($args) {
    $args['init_instance_callback'] = 'ShortcodeManager.init';
    return $args;
  }

  static function customFootScripts () {
    $html = new ATemplate( A_THEME .'/shortcode.manager.tpl' );
    
    // shortcode manager vars
    global $post;
    $html->postType = $post->post_type;
    $html->customShortcode = self::get('custom-shortcode');
    
    echo $html->render();
  }
}

AShortcodeManager::setup();
