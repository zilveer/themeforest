<?php

class AAdmin extends Acorn {

  static function init ( $relPath = '/3rd/admin/' ) {

    if ( function_exists( 'optionsframework_init' ) ) return;

    define('OPTIONS_FRAMEWORK_DIR', A_DIR . $relPath);
    define('OPTIONS_FRAMEWORK_URL', A_URL . $relPath);

    require_once (OPTIONS_FRAMEWORK_DIR . 'options-framework.php');
  }

  static function customScripts () {
    $adminHtml = new ATemplate(A_THEME .'/admin.tpl');
    echo $adminHtml->render();
  }
}

AAdmin::init();


/*--------------------------------------------------------------------------
  Required Option Framework Functions
/*------------------------------------------------------------------------*/

# Custom Scripts & Styles

add_action ('optionsframework_custom_scripts', 'AAdmin::customScripts');

# A unique identifier is defined to store the options in the database and reference them from the theme. By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.

function optionsframework_option_name() {
  $optionsframework_settings = get_option('optionsframework');
  $optionsframework_settings['id'] = A_THEME_OPTIONS_ID; //A_THEME_KEY .'_options';
  update_option('optionsframework', $optionsframework_settings);
}

# Defines an array of options moved to ../options.php

