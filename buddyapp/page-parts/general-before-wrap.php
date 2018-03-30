<?php
/**
 * Before content wrap
 * Used in all templates
 */
?>

<?php
/**
 * Before main content - action
 */
do_action('kleo_before_content');
?>

<?php

if ( kleo_has_shortcode( 'kleo_bp_' ) ) {
	$section_class = 'buddypress';
}	else {
	$section_class = '';
}

?>

<div id="content" <?php echo kleo_main_section_class( $section_class ); ?>>
	<div id="main-container" class="clearfix">

		<div class="main" role="main">
			<div class="content-wrap">

			<?php
			/**
			 * Before main content - action
			 */
			do_action('kleo_before_main_content');
			?>