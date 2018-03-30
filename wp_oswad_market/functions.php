<?php
/**
 * @package WordPress
 * @subpackage Oswad Market
 * @since WD_Responsive
 **/

$_template_path = get_template_directory();
require_once $_template_path."/theme/theme.php";
$theme = new Theme(array(
	'theme_name'	=>	"OswadMarket",
	'theme_slug'	=>	'oswadmarket'
));
$theme->init();

/**
 * Slightly Modified Options Framework
 */
require_once ('admin/index.php');

?>