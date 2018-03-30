<?php

class AMetabox extends Acorn {

  protected static $boxes = array();

  static function addBoxes () {

    foreach (self::$boxes as $i => $box) {
      # add unique box id
      $box['id'] = 'theme-metabox-id-'. $i;
      add_meta_box($box['id'], $box['title'], 'AMetabox::render', $box['page'], $box['context'], $box['priority'], $box);
    }
  }

  static function render ($post, $metabox) {
    $box = $metabox['args'];

    $m = new ATemplate(A_THEME .'/metabox.fields.tpl');

    $m->class = isset($box['class']) ? $box['class'] : '';
    $m->desc = isset($box['desc']) ? $box['desc'] : '';
    $m->nonce = wp_create_nonce(basename(__FILE__));

    $fields = array();
    foreach($box['fields'] as $field) {

      if (! isset($field['std'])) $field['std'] = '';

      $field['val'] = isset($field['id']) ?
        get_post_meta($post->ID, $field['id'], true) : null;

      if (! $field['val'])
        $field['val'] = stripslashes(htmlspecialchars($field['std'], ENT_QUOTES));

      $fields[] = $field;
    }

    $m->fields = $fields;
    echo $m->render();
  }

  static function customFootScripts () {

    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

    $html = new ATemplate(A_THEME .'/metabox.tpl');
    echo $html->render();
  }

  static function saveMetas ($post_id) {
    
    # verify boxes
    if (count(self::$boxes) == 0)
      return $post_id;

    # check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $post_id;
    }

    # check for revision update not post
    if ( wp_is_post_revision($post_id) )
      return;

    # verify nonce
    if (!isset($_POST['theme-metabox-nonce'])) {
      return $post_id;
    } 
    if (!wp_verify_nonce($_POST['theme-metabox-nonce'], basename(__FILE__))) {
      return $post_id;
    }

    # check permissions
    if ($_POST['post_type'] == 'page') {
      if (!current_user_can('edit_page', $post_id)) {
        return $post_id;
      }
    } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
    }

    # save metas
    foreach (self::$boxes as $box) {

      # update only the boxes with current post_type
      if ($_POST['post_type'] != $box['page']) continue;

      # fields loop
      foreach ($box['fields'] as $field) {
        
        # skip fields without id
        if (! isset($field['id'])) continue;

        $old = get_post_meta($post_id, $field['id'], true);
        
        # skip 'custom' fields that already created (will be saved by WP as Custom Fields)
        if ($field['type'] == 'custom' && $old) continue;
        
        $new = $_POST[sanitize_key($field['id'])];

        if ($new && $new != $old) {
          update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
        } elseif ($new == '' && $old) {
          delete_post_meta($post_id, $field['id'], $old);
        }
      }
    }
  }
}

/*--------------------------------------------------------------------------
  Add Metaboxes to Page
/*------------------------------------------------------------------------*/

add_action ( 'add_meta_boxes', 'AMetabox::addBoxes' );

/*--------------------------------------------------------------------------
  Save Data when Post is Updated
/*------------------------------------------------------------------------*/

add_action ( 'save_post', 'AMetabox::saveMetas' );

/*--------------------------------------------------------------------------
  Footer Scripts
/*------------------------------------------------------------------------*/

add_action ( 'admin_footer-post.php', 'AMetabox::customFootScripts' );
add_action ( 'admin_footer-post-new.php', 'AMetabox::customFootScripts' );
