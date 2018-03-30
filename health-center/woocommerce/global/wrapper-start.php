<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	wpv
 * @subpackage  health-center
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

?>

<div class="row page-wrapper">
	<?php WpvTemplates::left_sidebar() ?>

	<article class="<?php echo WpvTemplates::get_layout(); ?>">
		<?php
			global $wpv_has_header_sidebars;
			if( $wpv_has_header_sidebars) WpvTemplates::header_sidebars();
		?>
		<div class="page-content no-image">