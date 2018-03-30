<?php

class contactAWidget extends AWidget {

  private static $i = array();

  static function init() {

    self::$i['name'] = __('Contact', 'contact_widget');

    self::$i['options'] = array(
      'classname'   => 'contact-widget',
      'description' => __( 'A widget that displays minimal &amp; accurate contact form.', 'contact_widget' )
    );

    self::$i['controls'] = array( 'width' => 350 );

    self::$i['fields'] = array(
      
      'title' => array(
        'label' => __('Title', 'contact_widget'),
        'def'   => 'Send a Message'),
        
      'descr' => array(
        'label' => __('Form Description', 'contact_widget'),
        'def'   => ''),
        
      'email' => array(
        'label' => __('Contact Email', 'contact_widget'),
        'def'   => get_option ('admin_email')),
        
      'notext' => array(
        'label' => __('No-Text Response', 'contact_widget'),
        'tags'  => true,
        'def'   => 'Don\'t be shy! Please <strong>type something</strong> and'),
        
      'noemail' => array(
        'label' => __('No-Email Response', 'contact_widget'),
        'tags'  => true,
        'def'   => 'We don\'t Spam. <strong>Add your Email</strong> and')
    );

    parent::register(__CLASS__);
  }

  function contactAWidget() { parent::__construct(self::$i); }

  function widget ( $args, $instance ) {

    extract( $args );
    extract( $instance );

    $title = apply_filters('widget_title', $title );

    // Defined by theme setup file
    echo $before_widget;

    if ( $title ) echo $before_title . $title . $after_title;

    $opts = Acorn::argsToAttr(array(
      'email'   => $email,
      'notext'  => $notext,
      'noemail' => $noemail
    ), $prefix = '');

    if ($descr) $descr = "{$descr}[/contact]";
    echo do_shortcode("[contact {$opts}]{$descr}");

    // Defined by theme setup file
    echo $after_widget;
  }

  function form ($instance) {
    parent::form( $instance, self::$i['fields'] );
  }

  function update ($new_instance, $old_instance) {
    return parent::update( $new_instance, $old_instance, self::$i['fields'] );
  }
}

/*--------------------------------------------------------------------------
  Register Our Widget
/*------------------------------------------------------------------------*/

add_action( 'widgets_init', 'contactAWidget::init' );
