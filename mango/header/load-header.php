<?php

/**

 * The template for loading the header

 *

 *

 * @package WordPress

 * @subpackage mango

 * @since mango 1.0

 */

?>

<?php global $mango_settings, $current_header;

get_template_part('inc/menu/mobile-menu');

$current_header = mango_current_header();

get_template_part('header/header',$current_header);

?>