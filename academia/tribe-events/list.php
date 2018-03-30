<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';

$layout_style = isset($_GET['layout']) ? $_GET['layout'] : '';
if (!in_array($layout_style, array('full','container','container-fluid'))) {
	$layout_style = rwmb_meta($prefix.'page_layout');
	if (($layout_style === '') || ($layout_style == '-1')) {
		$layout_style = $g5plus_options['archive_event_layout'];
	}
}
$main_class = array('site-content-archive-event');
do_action('g5plus_before_archive_event');
?>
	<main  class="<?php echo join(' ',$main_class) ?>">
		<?php if ($layout_style != 'full'): ?>
		<div class="<?php echo esc_attr($layout_style) ?> clearfix">
			<?php endif;?>
			<?php
			do_action( 'tribe_events_before_template' );
			?>

			<!-- Tribe Bar -->
			<?php tribe_get_template_part( 'modules/bar' ); ?>

			<!-- Main Events Content -->
			<?php tribe_get_template_part( 'list/content' ); ?>

			<div class="tribe-clear"></div>

			<?php
			do_action( 'tribe_events_after_template' );
			?>
			<?php if ($layout_style != 'full'): ?>
		</div>
	<?php endif;?>
	</main>