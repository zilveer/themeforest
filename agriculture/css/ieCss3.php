<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * CSS 3 Rules for IE < 9
 * Created by CMSMasters
 * 
 */


header('Content-type: text/css');


require('../../../../wp-load.php');

?>


#slide_top {
	behavior:url(<?php echo get_template_directory_uri(); ?>/css/pie.htc);
}

