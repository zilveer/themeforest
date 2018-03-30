<?php


class simpleBaseBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'simpleBaseBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'simplebasebundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/simpleBaseBundleAdminConfig.class.php',
        'simpleutils' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/simpleUtils.class.php',
        'simplecontactmailer' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/simpleContactMailer.class.php',
        
        // widgets
        'simplewidgetmailchimp' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetMailchimp.class.php',
        
        'simplewidgetblog' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetBlog.class.php',
        'simplewidgetdualcontent' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetDualContent.class.php',
        'simplewidgetcontentslider' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetContentSlider.class.php',
        'simplewidgeticontext' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetIconText.class.php',
        'simplewidgetad125' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetAd125.class.php',
        'simplewidgetsocialize' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetSocialize.class.php',
        'simplewidgettaketourbutton' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetTakeTourButton.class.php',
        'simplewidgetdualiconcontent' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetDualIconContent.class.php',
        'simplewidgetmaplinks' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/widgets/class/simpleWidgetMapLinks.class.php',

    );

    return $a;
  }

  public function getWordpress()
  {

    $w = array(
        'image_sizes' => array(
            'widget-content-slider' => array(231, 137, true),
            'page-detail-thumbnail' => array(561, 153, true),
            'post-gallery-big' => array(500, 384, true),
            'category-thumbnail' => array(153, 153, true),
        ),
        'enqueue_styles' => array(
            'ext-boilerplate' => array(
                'path' => get_stylesheet_directory_uri().'/css/boilerplate.css',
                'environment' => 'frontend'
            ),
            'bebel-global' => array(
                'path' => get_stylesheet_directory_uri().'/css/style.css',
                'environment' => 'frontend'
            ),
            'ext-colorbox' => array(
                'path' => get_stylesheet_directory_uri().'/css/colorbox.css',
                'environment' => 'frontend'
            ),
            'ext-supersized' => array(
                'path' => get_stylesheet_directory_uri().'/css/supersized.css',
                'environment' => 'frontend'
            ),
            'bebel-custom' => array(
                'path' => get_stylesheet_directory_uri().'/css/custom.css',
                'dependency' => 'bebel-global',
                'environment' => 'frontend'
            ),
        ),
        'enqueue_scripts' => array(
           
            
            'bebel-global' => array(
                'path' => get_stylesheet_directory_uri().'/js/bebel.global.js',
                'dependency' => 'jquery',
                'environment' => 'frontend'
            ),
            
            'bebel-nav' => array(
                'path' => get_stylesheet_directory_uri().'/js/bebel.nav.js',
                'dependency' => 'jquery',
                'environment' => 'frontend'
            ),
            
            'ext-modernizr' => array(
                'path' => get_stylesheet_directory_uri().'/js/modernizr-2.0.6.min.js',
                'dependency' => 'jquery',
                'environment' => 'frontend'
            ),
            
            'ext-supersized' => array(
                'path' => get_stylesheet_directory_uri().'/js/supersized.3.2.6.min.js',
                'dependency' => 'jquery',
                'environment' => 'frontend'
            ),
            
            'jquery-actual' => array(
                'path' => get_stylesheet_directory_uri().'/js/jquery.actual.min.js',
                'dependency' => 'jquery',
                'environment' => 'frontend'
            ),
            
            'jquery-easing' => array(
                'path' => get_stylesheet_directory_uri().'/js/jquery.easing.min.js',
                'dependency' => 'jquery',
                'environment' => 'frontend'
            ),
            
            'jquery-tinyscrollbar' => array(
                'path' => get_stylesheet_directory_uri().'/js/jquery.tinyscrollbar.min.js',
                'dependency' => 'jquery',
                'environment' => 'frontend'
            ),
            
            'jquery-colorbox' => array(
                'path' => get_stylesheet_directory_uri().'/js/jquery.colorbox.min.js',
                'dependency' => 'jquery',
                'environment' => 'frontend'
            ),
            
        )
        
    );

    return $w;
  }

  public function getSettings()
  {
    $s = array(
        'simple_base_bundle_version' => '1.0'
    );

    return $s;
  }


  public function getWidgets()
  {
      
          $w = array();
      
      
    return $w;
  }
  
  
  public function runHook()
  {
      // set current theme
      add_action('wp_enqueue_scripts', array($this, 'addStylesToWordpress'));
      
  }
  
  
  public function addStylesToWordpress()
  {
      $settings = BebelSingleton::getInstance('BebelSettings');
      $style = $settings->get('theme_color_schema');
      wp_enqueue_style('current-theme', get_stylesheet_directory_uri().'/css/colors/'.trim($style).'.css', array());
  }

}