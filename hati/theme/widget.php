<?php

class AWidget extends WP_Widget {

  protected static function register ($class) { register_widget( $class ); }

  function AWidget($args) {
    extract($args);
    parent::WP_Widget(Acorn::strToID($name), $name, $options, $controls);
  }

  function update ( $new_instance, $old_instance, $options ) {
    $instance = $old_instance;

    foreach($options as $key => $option) {

      if ( isset( $option['tags'] ) && $option['tags'] )
        $instance[$key] = trim($new_instance[$key]);
      else
        $instance[$key] = trim(strip_tags($new_instance[$key]));
    }

    return $instance;
  }

  function form ( $instance, $options ) {
    $fields = array();
    foreach($options as $key => $option) {
      $fields[$key] = $option;
      $val = isset($instance[$key]) ? $instance[$key] : $option['def'];

      $fields[$key]['val'] = $val;
      $fields[$key]['fid'] = $this->get_field_id( $key );
      $fields[$key]['fname'] = $this->get_field_name( $key );
    }

    $w = new ATemplate(A_THEME .'/widget.tpl');
    $w->fields = $fields;
    echo $w->render();
  }
}