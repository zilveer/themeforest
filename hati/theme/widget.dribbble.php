<?php

class dribbbleAWidget extends AWidget {

  private static $i = array();

  static function init() {

    self::$i['name'] = __('Dribbble', 'dribbble_widget');

    self::$i['options'] = array(
      'classname'  => 'dribbble-widget',
      'description' => __( 'A widget that displays your latest shots.', 'dribbble_widget' )
    );

    self::$i['controls'] = array();

    self::$i['fields'] = array(
      
      'title' => array(
        'label' => __('Title', 'dribbble_widget'),
        'def'   => 'What I\'m Working On'),
        
      'username' => array(
        'label' => __('Dribbble Username', 'dribbble_widget'),
        'def'   => 'popular'),
        
      'count' => array(
        'label' => __('Number of Shots', 'dribbble_widget'),
        'def'   => '6', 
        'vars'  => array('3','6','9')),
        
      'dribbbletext' => array(
        'label' => __('Follow Text e.g. Watch me on Dribbble', 'dribbble_widget'),
        'def'   => 'Watch me on Dribbble')
    );

    parent::register(__CLASS__);
  }

  function dribbbleAWidget() { parent::__construct(self::$i); }

  function widget ( $args, $instance ) {

    extract( $args );
    extract( $instance );

    $title = apply_filters('widget_title', $title );

    // Defined by theme setup file
    echo $before_widget;

    if ( $title ) echo $before_title . $title . $after_title;

    self::renderTimeline($username, intval($count));

    if ( $dribbbletext ) echo '<a href="http://dribbble.com/'.$username.'" id="dribbble-link">'.$dribbbletext.'</a>';

    // Defined by theme setup file
    echo $after_widget;
  }

  static function renderTimeline($user, $count) {
    
    $id = substr("dribbble_{$user}_24fe73e797f47e5ab000bc7e9b0170a4", 0, 44);
    $exp = 60 * 60 * 1; // 1 hour

    if ( false === ( $res = get_transient( $id ) ) ) {
      // this code runs when there is no valid transient set
      $res = array();

      $url = ( $user == 'popular' ) ?
        "http://dribbble.com/shots/popular.rss" :
        "http://dribbble.com/{$user}/shots.rss";
      
      $response = wp_remote_get( $url );
      $code = intval( wp_remote_retrieve_response_code( $response ) );

      if ( $code == 200 ) {
        $x = new SimpleXmlElement( $response['body'] );

        foreach($x->channel->item as $item) {
          $shot = array();
          $shot['url'] = (string)$item->link;
          $shot['src'] = (string)$item->description;
          $shot['date'] = (string)$item->pubDate;
          $shot['title'] = (string)$item->title;
          $shot = self::parseShot($shot, $user);
          $res[] = $shot;
        }

        // save shots
        set_transient( $id, $res, $exp );
      }
    }

    $o  = '<div id="dribbble-wrapper" class="group">';

    $count = min( $count, 20, count($res) );
    if ($count < 1)
      $o .= '<span>Dribbble should be here, but it&rsquo;s not.</span>';

    for ($i=0; $i < $count; $i++) {
      $shot = $res[$i];
      $o .= "<div><a href=\"{$shot['url']}\"><img src=\"{$shot['img']}\" alt=\"Dribbble Shot\" title=\"{$shot['title']}\"></a></div>";
    }

    $o .= '</div>';
    echo $o;
  }

  static function parseShot($s, $user = '') {
    preg_match("/src=\"(http.*?\.(jpg|jpeg|gif|png))\"/i", $s['src'], $image_url);
    $image = $image_url[1];
    $image = preg_replace('/\.(jpg|jpeg|gif|png)\"/i', '_teaser.$1', $image);
    $s['img'] = $image;
    return $s;
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

add_action( 'widgets_init', 'dribbbleAWidget::init' );
