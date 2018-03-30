<?php
session_start(); // DO NOT REMOVE OR THE PAYMENT FEATURE WON'T WORK ANYMORE!!!
$bebel['baseThemeInfos'] = array(
    'themename' => 'Guestlist', // please don't change - you'd break the update notification. (You can change the folder name, if you want. but not this!)
    'themeversion' => '1.7', // do not change
    'themeprefix' => 'bg' // do not change
);


// set environment (important for loading css and js, ...) do not change. can be set before (shortcode bundle)
if(!isset($bebel['environment']))
{
    $bebel['environment'] = 'frontend';
    if(is_admin()) {
      $bebel['environment'] = 'backend';
    }
}

// do not change
$bebel['production_mode'] = 'dev';

// change to true if you want to disable double opt in. AT YOUR OWN RISK, WE WILL NOT BE RESPONSIBLE FOR ANY DAMAGE, LAWSUIT, COMPLAINTS OR TAKEDOWNS WHATSOEVER!
$bebel['disable_double_opt'] = false;


// load autoloader
include_once 'bebelCp2/core/class/BebelAutoloader.class.php';
$bAutoloader = BebelAutoloader::getInstance();
$bAutoloader->register();

// set environment and production mode
BebelUtils::setEnvironment($bebel['environment']);
BebelUtils::setProductionMode($bebel['production_mode']);


// create new settings object and fill with basic theme informations
$bSettings = new BebelSettings();
$bSettings->setBaseInformations($bebel['baseThemeInfos']);

// create WordPress, PostTypeGenerator object
$bWordPress = new BebelWordpress();
$bPostTypes = new BebelPostTypeGenerator($bSettings->getPrefix());


// add all bundles (respect order !!) 
$bBundlesCollection = array(
    // installation bundle
    'bebelOneClickInstallationBundle',
    // our awesome global bundles
    'bebelBaseBundle',
    'bebelBetterCategoriesBundle',
    'bebelShortcodeBundle',
    'bebelPaymentGatewaysBundle',
    'bebelEventsBundle',
    // theme specific bundles
    'simpleBaseBundle',
    
    'bebelUpdateBundle'
    // delete before delivery
    //'bebelDemoBundle'
);

// we have to break out of our settings jail to get to know if the user enabled mailchimp support. dirty hack, I agree.
// sorry about that.

$tmp_settings = get_option($bSettings->getPrefix().'-settings');
if($tmp_settings['events_enable_mailchimp'] == 'on') 
{
    $bBundlesCollection[] = 'bebelMailchimpBundle';
}



$bBundles = new BebelBundle($bSettings, $bWordPress, $bPostTypes);

// now load bundles.
$bBundles->registerMultiple($bBundlesCollection);

// extend the autoloader, so we also have access to the classes inside the bundles.
$bAutoloader->extend($bBundles->loadAutoload());

// continue loading bundles
$bBundles->loadSettings()
         ->loadWordpress()
         ->loadPostTypes()
         ->loadWidgets();



// register all settings into the database, if not yet in it
$bSettings->loadAll()->init();

// if necessary, install bundles (database stuff)
$bTableInstall = new BebelTablesInstall($bBundles, $bSettings, $wp, $wpdb);
$bTableInstall->loadInstallData()->install();

// set all wordpress related stuff
$bWordPress->run();

add_filter( 'post_gallery', array('shortcodeUtils', 'customGallery'), 10, 2 );


// populate singleton, we need access to everything inside the bundles
// TODO: Find other solution
BebelSingleton::addClasses(array(
    'BebelBundle' => $bBundles,
    'BebelSettings' => $bSettings,
    'BebelWordPress' => $bWordPress
));



// run hooks from bundles
$bBundles->runHooks();


// initialize update
$bUpdate = new bebelUpdate();
$bUpdate->checkForUpdate();

// admin hoax
if(is_admin())
{
  
  $bAdmin = new BebelAdmin($bSettings, $bBundles);
  $bAdminPostMeta = new BebelAdminPostMetaPanel($bSettings, $bBundles);
  add_action('admin_menu', array($bAdmin, 'initAdmin'));
  
  
  // check if theme is beeing activated
  bebelOneClickInstallationUtils::checkIfThemeIsActivated(BebelUtils::getCurrentlyBrowsedFile());
  
  
}

// final step: load text domain
load_theme_textdomain($bSettings->getPrefix(), TEMPLATEPATH . '/lang' );

// done :)
// and a final note to all those who say: this is too complicated!
// I cannot find anything, it is too blown and I want my spagetticode back!!!1

// I am sorry to dissapoint you. honestly, I spent a lot of time building this
// to facilitate the work with WordPress. Instead of building every theme
// from scratch with mostly every time the same settings, I decided to write
// a framework for it. A real one.
// Our themes are full of features that actually require php code - so most
// of the existing frameworks are nothing for us. We build websites with
// the symfony framework - we love OOP. Unfortunately, WordPress doesn't
// give us much space to extend and enhance its system, so we needed to build
// this.
// We will probably release this one day on our homepage with a detailed
// documentation, but until then - just ask if you have problems with something.

/// Cheers
/// Bebel


// add post type to rss

function bebel_custom_post_type_to_rss($args) 
{
    global $bSettings;
  if(isset($args['feed']) && !isset($args['post_type']))
  {
      $args['post_type'] = array($bSettings->getPrefix().'_'.'event');
  }
    
  return $args;
}
add_filter('request', 'bebel_custom_post_type_to_rss');


// detect browser

// iphone fix
$browser = BebelUtils::getBrowser();




// very very last step: include "myFunctions.php" to put your functions in.
include('myFunctions.php');
