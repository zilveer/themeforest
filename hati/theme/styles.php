<?php

class AStyles extends Acorn {
  
  static function editorStyle () {
    add_editor_style ( A_URL .'/editor.css' );
  }

  /*--------------------------------------------------------------------------
    Enqueue Custom CSS
  /*------------------------------------------------------------------------*/

  static function enqueueCustomCSS () {
    wp_enqueue_style( 'custom', A_CUSTOM_CSS_URL );
  }

  /*--------------------------------------------------------------------------
    Building Custom CSS
  /*------------------------------------------------------------------------*/

  # check custom.css file access
  static function isCustomCSSWritable () {

      if ( touch(A_CUSTOM_CSS) ) // try to access, create if none & change time
          chmod(A_CUSTOM_CSS, 0666); // grant access

    return is_writable( A_CUSTOM_CSS );
  }

  # main function (call by adding / updating theme options record)
  static function buildCustomCSS () {

    if ( !self::isCustomCSSWritable() )
      return;

    $f = @fopen(A_CUSTOM_CSS, 'w');
    @fwrite($f, self::renderCustomCSS());
    @fclose($f);

    // self::log('css was created/updated');
  }

  #render custom styles
  static function renderCustomCSS ($o = '') {

    # render template

    $s = new ATemplate(A_THEME .'/styles.tpl');

    # colours

    $s->textC = self::get('text-color');
    $s->hoverC = self::get('link-bg');
    
    $s->textC_L = self::lighten($s->textC, .33);
    $s->textC_SL = self::lighten($s->textC, .75);
    $s->linkC = self::darken($s->textC, .5);
    $s->blend = self::lighten($s->textC, .5);

    # custom css
    
    $s->css = self::get('custom-css');

    # fonts
    
    $types = array('family', 'family-alt'); // admin options settings
    
    $s->fonts = array();
    foreach ($types as $type)
      if ($f = trim(self::get("{$type}-font"))) $s->fonts[$type] = $f;

    # end

    $o .= $s->render();
    return $o;
  }

  /*--------------------------------------------------------------------------
    Color Supply Methods
  /*------------------------------------------------------------------------*/

  static function hexToAColor ( $rrggbb ) {
    $c = hexdec($rrggbb);
    return (object) array(
      'r' => (int)(255 & ($c >> 16)),
      'g' => (int)(255 & ($c >> 8)),
      'b' => (int)(255 & ($c))
    );
  }

  static function aColorToHex ( $c ) {
    $c = ($c->r << 16) + ($c->g << 8) + $c->b;
    $c = dechex($c);
    return "#{$c}";
  }

  static function blendHexColors ( $c1, $c2, $a = .5 ) {
    $c1 = self::hexToAColor($c1);
    $c2 = self::hexToAColor($c2);

    $c = (object) array(
      'r' => (int)(255 & ( $c1->r + ($c2->r - $c1->r)*$a )),
      'g' => (int)(255 & ( $c1->g + ($c2->g - $c1->g)*$a )),
      'b' => (int)(255 & ( $c1->b + ($c2->b - $c1->b)*$a ))
    );

    return self::aColorToHex($c);
  }
  
  static function hexToRGBA ( $rrggbb, $a ) {
    $c = self::hexToAColor($rrggbb);
    return "rgba({$c->r},{$c->g},{$c->b},{$a})";
  }
  
  // quick functions & aliases
  
  static function blend ( $c1, $c2, $a = .5 ) {
    return self::blendHexColors($c1, $c2, $a);
  }
  
  static function lighten ( $c, $a ) {
    return self::blend($c, '#ffffff', $a);
  }
  
  static function darken ( $c, $a ) {
    return self::blend($c,'#000000', $a);
  }
  
  static function rgba ( $c, $a = 1 ) {
    return self::hexToRGBA($c, $a);
  }
}

/*--------------------------------------------------------------------------
  Enqueue Custom CSS
/*------------------------------------------------------------------------*/

add_action ( 'wp_enqueue_scripts', 'AStyles::enqueueCustomCSS' );

/*--------------------------------------------------------------------------
  Build Custom CSS
/*------------------------------------------------------------------------*/

add_action( 'add_option_'. A_THEME_OPTIONS_ID, 'AStyles::buildCustomCSS' );
add_action( 'update_option_'. A_THEME_OPTIONS_ID, 'AStyles::buildCustomCSS' );

/*--------------------------------------------------------------------------
  Replace TinyMCE Styles
/*------------------------------------------------------------------------*/

// add_filter ('admin_init', 'AStyles::editorStyle');
