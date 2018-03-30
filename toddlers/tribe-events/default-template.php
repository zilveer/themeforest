<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header(); ?>
<?php global $unf_options; ?>

<div id="content-wrapper" class="row clearfix">
	<div id="content" class="col-md-8 column">
		<div class="article clearfix">

			<?php if (tribe_is_past() || tribe_is_upcoming() && !is_tax()){
				if( !empty($unf_options['unf_eventshomepageimage']['url'])){?>
					<div class="post-featured-image">
						<img src="<?php echo esc_url($unf_options['unf_eventshomepageimage']['url']);?>" class='events-home-image'>


						<div class="overlay"></div>
					</div>
			<?php
				}
			}?>

			<div id="tribe-events-pg-template">
				<?php tribe_events_before_html(); ?>
				<?php tribe_get_view(); ?>
				<?php tribe_events_after_html(); ?>
			</div> <!-- #tribe-events-pg-template -->


		</div>
	</div>
	<?php get_sidebar('events'); ?>
</div>

<?php get_footer(); ?>