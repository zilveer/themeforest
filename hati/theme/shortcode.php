<?php

class AShortcode extends Acorn {

  # WPAutoP-safe Shortcodes ('earlier shortcoding')

  protected static $shortcodes = array();

  static function addShortcode ($code, $cb) {
    if ( is_callable($cb) ) self::$shortcodes[$code] = $cb;
  }

  static function add ($code, $cb) { self::addShortcode($code, $cb); }

  static function doShortcode ($content) {

    global $shortcode_tags;

    $shortcode_tags_orig = $shortcode_tags;
    $shortcode_tags = self::$shortcodes;

    $content = do_shortcode( $content );

    $shortcode_tags = $shortcode_tags_orig;
    return $content;
  }

  # Default Theme Shortcodes

  static function init () {

    // Columns
    $columns = array('one_half', 'one_third', 'two_third', 'one_fourth', 'three_fourth', 'one_fifth', 'two_fifth', 'three_fifth', 'four_fifth', 'one_sixth', 'five_sixth');

    foreach ($columns as $column) {
      self::addShortcode ($column, 'AShortcode::column');
      self::addShortcode ($column.'_last', 'AShortcode::columnLast');
    }

    // Content
    add_shortcode ('br', 'AShortcode::br');
    add_shortcode ('dropcap', 'AShortcode::dropcap');
    add_shortcode ('hr', 'AShortcode::hr');
    add_shortcode ('label', 'AShortcode::label');
    add_shortcode ('list', 'AShortcode::listType');
    add_shortcode ('tweet', 'AShortcode::tweet');

    // UI Elements
    add_shortcode ('alert', 'AShortcode::alert');
    add_shortcode ('button', 'AShortcode::button');
    self::addShortcode ('tab', 'AShortcode::tab');
    self::addShortcode ('tabs', 'AShortcode::tabs');
    self::addShortcode ('toggle', 'AShortcode::toggle');
    self::addShortcode ('accordion', 'AShortcode::toggle');
  }

  static function brCodes ( $content ) {
    return preg_replace( "/\](\s)*\[/im", "]\n[", $content );
  }

/*--------------------------------------------------------------------------
  Columns
/*------------------------------------------------------------------------*/

  static function column ( $atts, $content = null, $code) {

    $code = str_replace('_', '-', $code); // abc_xyz -> abc-xyz
    
    extract(shortcode_atts(array('mod' => ''), $atts));
    
    return "<div class='{$code} {$mod}'>". do_shortcode(trim($content)) .'</div>';
  }

  static function columnLast ( $atts, $content = null, $code ) {

    $code = str_replace('_last', ' last', $code); // abc_xyz_last -> abc_xyz last
    $code = str_replace('_', '-', $code); // abc_xyz last -> abc-xyz last
    
    extract(shortcode_atts(array('mod' => ''), $atts));
    
    return "<div class='{$code} {$mod}'>". do_shortcode(trim($content)) .'</div><div class="clear"></div>';
  }

/*--------------------------------------------------------------------------
  Content
/*------------------------------------------------------------------------*/

  static function br ( $atts, $content = null ) { return '<br>'; }

  static function dropcap ( $atts, $content = null ) {

    extract(shortcode_atts(array(
      'style' => 'white'
    ), $atts));

    return "<span class=\"dropcap {$style}\">". trim($content) ."</span>";
  }

  static function hr ( $atts, $content = null ) {

    extract(shortcode_atts(array(
      'title' => false,
      'top'   => false
    ), $atts));

    $out = '<hr>';
    if ($top) $out .= "<p class=\"alignright\"><a href=\"#top\">{$top}</a></p>";
    if ($title) $out .= "<h5>{$title}</h5>";

    return $out;
  }

  static function label ( $atts, $content = null ) {

    extract(shortcode_atts(array(
      'style'   => 'gray'
    ), $atts));

    return "<span class=\"label {$style}\">". trim($content) ."</span>";
  }

  static function listType ( $atts, $content = null ) {
   
    extract(shortcode_atts(array(
      'img'   => false,
      'type'  => 'list'
    ), $atts));

    if ($img)
      $opt = "style=\"list-style-image: url('{$img}')\"";
    else
      $opt = "class=\"{$type}\"";

    $content = do_shortcode($content);
    $content = str_replace('<ul>', "<ul {$opt}>", $content);
    $content = str_replace('<ol>', "<ol {$opt}>", $content);
    return $content;
  }

  static function tweet ( $atts, $content = null ) { 

    extract(shortcode_atts(array(
      'name'  => 'helloalaja'
    ), $atts));
    
    if (!$content) {
      $codeword = __('Visit us on twitter', A_DOMAIN);
      $content = "{$codeword} <a href='http://twitter.com/{$name}' title='{$codeword}'>@{$name}</a>";
    }
    
    $content = "Here should be the Twitter line but it's not since Twitter has discontinued its unauthenticated v1.0 API :(";

    return "<ins class=\"tweet\" cite=\"{$name}\">". $content ."</ins>";
  }

/*--------------------------------------------------------------------------
  UI Elements
/*------------------------------------------------------------------------*/

  static function alert ( $atts, $content = null ) {
    
    extract(shortcode_atts(array(
      'style' => 'white'
    ), $atts));

    return "<div class=\"alert {$style}\">". do_shortcode($content) .'</div>';
  }

  static function button ( $atts, $content = null ) {

    extract(shortcode_atts(array(
      'size'  => 'small',
      'style' => 'white',
      'target'=> false,
      'url'   => '#'
    ), $atts));

    $target = $target ? " target=\"{$target}\"" : '';

    return "<a class=\"{$style} {$size} button\" href=\"{$url}\"{$target}>{$content}</a>";
  }

  static function tab ( $atts, $content = null ) {
    global $tab_counter_b;
    global $tab_counter_c;
    $class = ($tab_counter_b == $tab_counter_c) ? 'active tab' : 'tab';

    $out = '<div class="'.$class.'" id="tab-'. $tab_counter_b++ .'">' . do_shortcode($content) .'</div>';
    
    return $out;
  }

  static function tabs ( $atts, $content = null ) {

    extract(shortcode_atts(array(), $atts));

    $out = '<div class="tabs"><ul>';

    global $tab_counter_a;
    global $tab_counter_b;
    global $tab_counter_c;
    $tab_counter_a++;
    $tab_counter_b++;
    $tab_counter_c = $tab_counter_b;

    foreach ($atts as $tab) {

      $first = isset($first) ? '' : ' class="active"';

      $out .= '<li'. $first .'><a title="'. $tab .'" href="#tab-'. $tab_counter_a++ .'">'. $tab .'</a></li>';
    }

    $out .= '</ul>';
    $out .= do_shortcode($content) .'</div>';

    return $out;
  }

  static function toggle ( $atts, $content = null, $code ) {

    $acc = ( $code == 'accordion' ) ? 'acc' : '';

    extract(shortcode_atts(array(
      'state' => 'close',
      'title' => 'Title goes here'
    ), $atts));

    $out = "<div class=\"{$state} {$acc} toggle\"><h4>{$title}</h4><div class=\"toggle-inner\">". do_shortcode($content) ."</div></div>";

    return $out;
  }
}

AShortcode::init();

/*--------------------------------------------------------------------------
  Register Custom Shortcode Handler
/*------------------------------------------------------------------------*/

add_action ( 'the_content', 'AShortcode::doShortcode', 7 ); // 7 = before wpautop
