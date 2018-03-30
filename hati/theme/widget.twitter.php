<?php

class twitterAWidget extends AWidget {

  private static $i = array();

  static function init() {

    self::$i['name'] = __('Twitter', 'twitter_widget');

    self::$i['options'] = array(
      'classname'   => 'twitter-widget',
      'description' => __( 'A widget that displays your latest tweets.', 'twitter_widget' )
    );

    self::$i['controls'] = array();

    self::$i['fields'] = array(
      
      'title' => array(
        'label' => __('Title', 'twitter_widget'),
        'def'   => 'Latest Tweets'),
        
      'username' => array(
        'label' => __('Twitter Username e.g. helloalaja', 'twitter_widget'),
        'def'   => 'helloalaja'),
        
      'count' => array(
        'label' => __('Number of Tweets (max 20)', 'twitter_widget'),
        'def'   => '5'),
        
      'tweettext' => array(
        'label' => __('Follow Text e.g. Follow on Twitter', 'twitter_widget'),
        'def'   => 'Follow on Twitter')
    );

    parent::register(__CLASS__);
  }

  function twitterAWidget() { parent::__construct(self::$i); }

  function widget ( $args, $instance ) {

    extract( $args );
    extract( $instance );

    $title = apply_filters('widget_title', $title );

    // Defined by theme setup file
    echo $before_widget;

    if ( $title ) echo $before_title . $title . $after_title;

    self::renderTimeline($username, intval($count));

    if ( $tweettext ) echo '<a href="http://twitter.com/'.$username.'" id="twitter-link">'.$tweettext.'</a>';

    // Defined by theme setup file
    echo $after_widget;
  }

  static function renderTimeline($user, $count) {
    
    $id = substr("twitter_{$user}_dc445c580ed694be718e9c2e0c7821c5", 0, 44);
    $exp = 60 * 15; // 15 minutes

    if ( false === ( $res = get_transient( $id ))) {
      // this code runs when there is no valid transient set
      $res = array();

      $url = "http://twitter.com/status/user_timeline/{$user}.rss?count=20";
      
      $response = wp_remote_get( $url );
      $code = intval( wp_remote_retrieve_response_code( $response ) );

      if ( $code == 200 ) {
        $x = new SimpleXmlElement( $response['body'] );

        foreach($x->channel->item as $item) {
          $tweet = array();
          $tweet['url'] = (string)$item->link;
          $tweet['src'] = (string)$item->description;
          $tweet['date'] = (string)$item->pubDate;
          $tweet = self::parseTweet($tweet, $user);
          $res[] = $tweet;
        }

        // save tweets
        set_transient( $id, $res, $exp );
      }
    }

    $o  = '<div id="twitter-wrapper" class="group"><ul>';

    $count = min( $count, 20, count($res) );
    if ($count < 1)
      $o .= '<li><span>Twitter should be here, but it&rsquo;s not.</span></li>';

    for ($i=0; $i < $count; $i++) {
      $tweet = $res[$i];
      $o .= "<li><span>{$tweet['html']}</span> <small><a href=\"{$tweet['url']}\">{$tweet['since']}</a></small></li>";
    }

    $o .= '</ul></div>';
    echo $o;
  }

  static function parseTweet($t, $user = '') {
    $pattern = array(
      '/[^(:\/\/)](www\.[^ \n\r]+)/i',
      '/(https?:\/\/[^ \n\r]+)/i',
      '/@(\w+)/',
      '/^'.$user.':\s*/i'
    );
    $replace = array(
      '<a href="http://$1" rel="nofollow">$1</a>',
      '<a href="$1" rel="nofollow">$1</a>',
      '@<a href="http://twitter.com/$1" rel="nofollow">$1</a>',
      ''
    );
    
    $t['html'] = preg_replace($pattern, $replace, $t['src']);
    $t['since'] = self::getHumanRelative($t['date']);

    return $t;
  }

  static function getHumanRelative($date) {
    $timestamp = strtotime($date);
    $seconds = time() - $timestamp;
    
    $units = array(
      'second'  => 1,
      'minute'  => 60,
      'hour'    => 3600,
      'day'     => 86400,
      'month'   => 2629743,
      'year'    => 31556926
    );
    
    foreach ($units as $k => $v) {
      if ($seconds >= $v) {
        $results = floor($seconds/$v);
        if ($k == 'year')
          $timeago = date('d M y', $timestamp);
        else
          $timeago = ($results >= 2) ? 'about '.$results.' '.$k.'s ago' : 'about '.$results.' '.$k.' ago';
      }
    }

    return $timeago;
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

add_action( 'widgets_init', 'twitterAWidget::init' );
