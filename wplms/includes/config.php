<?php

if ( ! defined( 'ABSPATH' ) ) exit;

//Define CONSTANTS
define('THEME_DOMAIN','vibe'); 
define('THEME_SHORT_NAME','wplms');
define('THEME_FULL_NAME','WPLMS');
define('VIBE_PATH',get_theme_root().'/wplms');
define('VIBE_URL',get_template_directory_uri());
define('WPLMS_VERSION','2.2.2');


if ( !defined( 'BP_AVATAR_THUMB_WIDTH' ) )
define( 'BP_AVATAR_THUMB_WIDTH', 150 ); //change this with your desired thumb width

if ( !defined( 'BP_AVATAR_THUMB_HEIGHT' ) )
define( 'BP_AVATAR_THUMB_HEIGHT', 150 ); //change this with your desired thumb height

if ( !defined( 'BP_AVATAR_FULL_WIDTH' ) )
define( 'BP_AVATAR_FULL_WIDTH', 460 ); //change this with your desired full size,weel I changed it to 260 :) 

if ( !defined( 'BP_AVATAR_FULL_HEIGHT' ) )
define( 'BP_AVATAR_FULL_HEIGHT', 460 ); //change this to default height for full avatar

if ( ! defined( 'BP_DEFAULT_COMPONENT' ) )
define( 'BP_DEFAULT_COMPONENT', 'profile' );


$vibe_options = get_option(THEME_SHORT_NAME);
// Auto Update
if(isset($vibe_options['username']) && isset($vibe_options['apikey'])){ 
  require_once(VIBE_PATH."/options/validation/theme-update/class-theme-update.php");
  VibeThemeUpdate::init($vibe_options['username'],$vibe_options['apikey']);
}

add_action('after_setup_theme','wplms_define_constants',10);
function wplms_define_constants(){

	if ( ! defined( 'WPLMS_COURSE_SLUG' ) )
		define( 'WPLMS_COURSE_SLUG', 'course' );

	if ( ! defined( 'BP_COURSE_SLUG' ) )
		define( 'BP_COURSE_SLUG', 'course' );

	if ( ! defined( 'WPLMS_COURSE_CATEGORY_SLUG' ) )
		define( 'WPLMS_COURSE_CATEGORY_SLUG', 'course-cat' );

	if ( ! defined( 'WPLMS_UNIT_SLUG' ) )
		define( 'WPLMS_UNIT_SLUG', 'unit' );

	if ( ! defined( 'WPLMS_QUIZ_SLUG' ) )
		define( 'WPLMS_QUIZ_SLUG', 'quiz' );

	if ( ! defined( 'WPLMS_QUESTION_SLUG' ) )
		define( 'WPLMS_QUESTION_SLUG', 'question' );

	if ( ! defined( 'WPLMS_EVENT_SLUG' ) )
		define( 'WPLMS_EVENT_SLUG', 'event' );

	if ( ! defined( 'WPLMS_ASSIGNMENT_SLUG' ) )
		define( 'WPLMS_ASSIGNMENT_SLUG', 'assignment' );

	if ( ! defined( 'WPLMS_LEVEL_SLUG' ) )
		define( 'WPLMS_LEVEL_SLUG', 'level' );

	if ( ! defined( 'WPLMS_LOCATION_SLUG' ) )
		define( 'WPLMS_LOCATION_SLUG', 'location' );

	if ( ! defined( 'BP_COURSE_RESULTS_SLUG' ) )
		define( 'BP_COURSE_RESULTS_SLUG', 'course-results' );

	if ( !defined( 'BP_COURSE_STATS_SLUG' ) )
 		define( 'BP_COURSE_STATS_SLUG', 'course-stats' );

}
?>