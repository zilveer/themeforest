<?php


class bebelShortcodeBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelShortcodeBundle';
  }


  public function getAutoload()
  {
    $a = array(
      'bebelshortcodebundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelShortcodeBundleAdminConfig.class.php',
      'shortcodeutils' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/shortcodeUtils.class.php',
      'bebelshortcodes' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelShortcodes.class.php',
      'bebelshortcodefunctions' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelShortcodeFunctions.class.php',
    );

    return $a;
  }

  public function getWordpress()
  {
    
    $w = array(
        'theme_support' => array(
            'menus',
            'post-thumbnails',
            'automatic-feed-links'
         ),
        'actions' => array(),
        'filters' => array('widget_text' => 'do_shortcode'),
        'enqueue_styles' => array(
            'shortcode-styles' => array(
                'path' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/assets/css/shortcodes.css',
                'environment' => 'frontend'
            ),
        ),
        'image_sizes' => array(
            'background-header'   => array(950, 200, true),
            'post-single-wide'   => array(499, 153, true),
        )
    );

    return $w;
  }

  public function runHook()
  {
    
    $bShortcodes = new bebelShortcodes();
    BebelSingleton::addClass('BebelShortcodes', 'bShortcodes');
    
  }

}