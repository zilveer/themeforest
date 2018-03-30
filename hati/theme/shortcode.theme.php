<?php

class AThemeShortcodes extends AShortcode {
  
  static function init () {
    
    add_shortcode ('accent', 'AThemeShortcodes::accent');
    add_shortcode ('autobr', 'AThemeShortcodes::autobr');
    add_shortcode ('breakline', 'AThemeShortcodes::breakline');
    add_shortcode ('client', 'AThemeShortcodes::client');
    add_shortcode ('date', 'AThemeShortcodes::date');
    add_shortcode ('folio', 'AThemeShortcodes::folio');
    add_shortcode ('img', 'AThemeShortcodes::img');
    add_shortcode ('title', 'AThemeShortcodes::title');
    add_shortcode ('year', 'AThemeShortcodes::year');
    self::addShortcode ('autocol', 'AThemeShortcodes::autocol');
    self::addShortcode ('heading', 'AThemeShortcodes::heading');
    self::addShortcode ('note', 'AThemeShortcodes::note');
    self::addShortcode ('toleft', 'AThemeShortcodes::pull');
    self::addShortcode ('toright', 'AThemeShortcodes::pull');
    self::addShortcode ('wide', 'AThemeShortcodes::wide');
    
    self::addShortcode ('right', 'AThemeShortcodes::right');
    self::addShortcode ('center', 'AThemeShortcodes::center');
    self::addShortcode ('left', 'AThemeShortcodes::left');
  }

  static function right ( $atts, $content = null ) {
    return '<div class="one-fourth last mobile-centred">'. do_shortcode(trim($content)) .'</div><div class="clear"></div>';
  }

  static function left ( $atts, $content = null ) {
    return '<div class="one-fourth mobile-centred">'. do_shortcode(trim($content)) .'</div>';
  }
  
  static function center ( $atts, $content = null ) {
    return '<div class="one-half content">'. do_shortcode(trim($content)) .'</div>';
  }

  static function folio ( $atts, $content = null ) {
    
    $out = '';
    $query = AExtend::getWorksByPageMeta('posts_per_page=3');
    $setFI = __('Please set Featured Image<br>for', A_DOMAIN);
    
    while ($query->have_posts()) : $query->the_post();
      $perma = get_permalink();
      $thumb = get_the_post_thumbnail();
      $title = get_the_title();

      $inner = $thumb ? "{$thumb} <h2>{$title}</h2>" : "<h4>{$setFI} {$title}</h4>";
      $out .= "<a href='{$perma}' class='item'>{$inner}</a>";
    endwhile; wp_reset_query();

    return "<div class='thumbs group pad'>{$out}</div>";
  }

  static function note ( $atts, $content = null ) {
    
    extract(shortcode_atts(array(
      'dark' => false,
      'light'=> false,
      'pull' => false
    ), $atts));
    
    $classes = array('note');
    if ($light) $classes[] = 'light';
    if ($dark) $classes[] = 'dark';
    if ($pull == 'left') $classes[] = 'pull-left';
    if ($pull == 'right') $classes[] = 'pull-right';
    
    $content = wpautop(trim(do_shortcode($content)));
    $classes = join(' ', $classes);
    if ($content) return "<div class='{$classes}'>{$content}</div>";
  }
  
  static function pull ( $atts, $content = null, $code ) {
    
    $align = ($code == 'toleft') ? 'left' : 'right';
    $content = trim(do_shortcode($content));
    return "<div class='pull-{$align}'>{$content}</div>";
  }

  static function client ( $atts, $content = null ) {
    
    if ( !$client = AExtend::getWorkCategory() ) return;
    
    $link = get_term_link($client);
    $name = $client->name;
    
    return "{$content} <a href='{$link}'>{$name}</a>";
  }

  static function year ( $atts, $content = null ) {
    
    if (!$Y = intval(get_the_time('Y'))) return;
    
    $link = get_year_link($Y);
    
    return "<a href='{$link}'>{$Y}</a>";
  }

  static function img ( $atts, $content = null ) {
    
    extract(shortcode_atts(array(
      'src' => false,
      'link' => false
    ), $atts));
    
    $img = '';
    if ($src) $img = "<img src='{$src}' alt='{$content}'>";
    if ($link && $img) $img = "<a href='{$link}'>{$img}</a>";
    
    return $img;
  }

  static function accent ( $atts, $content = null ) {
    
    $pieces = explode('|', $content);
    foreach ($pieces as $i => &$piece) {
      $even = $i++ %2;
      if ($even) $piece = "<strong>{$piece}</strong>";
    }
    $content = implode($pieces);
    $content = do_shortcode($content);

    return $content;
  }
  
  static function autobr ( $atts, $content = null ) {
    
    $pieces = explode("\n", $content);
    $content = implode('<br>', $pieces);
    $content = do_shortcode($content);

    return $content;
  }

  static function autocol ( $atts, $content = null ) {
    return '<div class="columned">'. do_shortcode(trim($content)) .'</div>';
  }

  static function breakline ( $atts, $content = null ) {
    
    $pieces = explode('|', $content);
    $content = implode('<br>', $pieces);
    $content = do_shortcode($content);

    return $content;
  }

  static function heading ( $atts, $content = null ) {
    
    extract(shortcode_atts(array(
      'rtitle' => false,
      'rlink' => '#'
    ), $atts));

    $link = '';
    if ($rtitle) $link = "<span> <a href='{$rlink}'>{$rtitle}</a> </span>";
    
    return "<h3>{$content}{$link}</h3>";
  }
  
  static function title ( $atts, $content = null ) {
    
    return get_the_title();
  }
  
  static function date ( $atts, $content = null ) {
    
    return get_the_date();
  }
  
  static function wide ( $atts, $content = null ) {
    
    extract(shortcode_atts(array(
      'maxwidth' => 'auto'
    ), $atts));
    
    $maxwidth = ($int = intval($maxwidth)) ? "{$int}px" : 'auto';
    return "<div class='wide' style='max-width:{$maxwidth}'>{$content}</div>";
  }
}

AThemeShortcodes::init();