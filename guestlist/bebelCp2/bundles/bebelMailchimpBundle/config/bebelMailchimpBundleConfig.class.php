<?php


class bebelMailchimpBundleConfig  extends BebelBundleConfig
{

  public function __construct()
  {
    $this->bundleDir = 'bebelMailchimpBundle';
  }


  public function getAutoload()
  {
    $a = array(
        'bebelmailchimpbundleadminconfig' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/config/bebelMailchimpBundleAdminConfig.class.php',
        'bebelmailchimputils' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelMailchimpUtils.class.php',
        'bebelmailchimp' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/class/bebelMailchimp.class.php',
        
        
        // mailchimp api
        'mcapi' => '%BCP_BUNDLE_PATH%/'.$this->bundleDir.'/vendor/MCAPI.class.php',


    );

    return $a;
  }


  public function getSettings()
  {
    $s = array(
        'mailchimp_apikey' => '',
        'mailchimp_default_list' => ''
    );

    return $s;
  }

  public function getWordpress()
  {

    $w = array(
    );

    return $w;
  }

  // admin stuff
  public function getAdmin()
  {

    $modules = array(
        'mailchimp' => array(
            'title' => 'Mailchimp',
            'submenu' => array(
                'general' => array(
                    'title' => 'General',
                    'description' => 'Set up the Api Key'
                ),
            ),
            'widgets' => array(
                'mailchimp_apikey' => array(
                    'title' => 'Api Key',
                    'description' => 'Enter the mailchimp Api Key here. You can generate one in your mailchimp backend.<br /><b>Make sure you test the key before saving. This will save you a lot of trouble, believe me. If the key is valid you will see a green square, if its invalid, you will see a red one.</b>',
                    'help' => '',
                    'template' => 'mailchimp_apikey',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
                'mailchimp_default_list' => array(
                    'title' => 'Default Mailing List',
                    'description' => 'Choose a default mailing list. It will be used for all the events that are running but have not yet a valid list selected. For changing the list for past events, edit the event and select a list in the post options below the textarea.<br /> Also, this list will be used for the newsletter form if no valid event is left to display.<br /><b>requires a valid api key!</b>',
                    'help' => '',
                    'template' => 'mailchimp_lists',
                    'permission' => 'edit_theme_options',
                    'submenu' => 'general',
                    'options' => array()
                ),
            ),
            'bundle' => $this->bundleDir
          ),
      );

    
    $timeinoneweek = time() + 604800;
    $timeinoneweekandaday = $timeinoneweek+86400;
    

    $post_modules = array(
        'add_scope' => array('event'),
        'menu_items' => array(
          'mailchimp' => array(
              'title' => 'Mailchimp',
              'scope' => array('event'),
              'bundle' => 'bebelMailchimpBundle'
          ),
        ),
        'widgets' => array(
            'mailchimp_list' => array(
                'menu_item' => 'mailchimp',
                'title' => 'Mailchimp List',
                'description' => 'Select the mailchimp list you want to connect this event to.',
                'help' => '',
                'template' => 'mailchimp_lists',
                'permission' => 'edit_post',
                'scope' => array('event'),
                'options' => array('button_text' => 'Upload Video'),
                'bundle' => 'bebelMailchimpBundle'

            ),
        )
    );

    $pages = array(
        
      );
    
    return array('modules' =>$modules, 'pages' => $pages, 'post_modules' => $post_modules);
  }

  public function getTemplates()
  {
    $t = array(
       
    );

    return $t;
  }


  public function getBundleSettings()
  {
    
    $bs = array();

    return $bs;
  }

  
  public function getWidgets()
  {
    $w = array();

    return $w;
  }

}