<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
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
		$layout_style = $g5plus_options['single_event_layout'];
	}
}

$sidebar = isset($_GET['sidebar']) ? $_GET['sidebar'] : '';
if (!in_array($sidebar, array('left','right'))) {
	$sidebar = rwmb_meta($prefix.'page_sidebar');
	if (($sidebar === '') || ($sidebar == '-1')) {
		$sidebar = $g5plus_options['single_event_sidebar'];
	}
}

$left_sidebar = rwmb_meta($prefix.'page_left_sidebar');
if (($left_sidebar === '') || ($left_sidebar == '-1')) {
	$left_sidebar = isset($g5plus_options['single_event_left_sidebar']) ? $g5plus_options['single_event_left_sidebar'] : '';
}

$right_sidebar = rwmb_meta($prefix.'page_right_sidebar');
if (($right_sidebar === '') || ($right_sidebar == '-1')) {
	$right_sidebar = isset($g5plus_options['single_event_right_sidebar']) ? $g5plus_options['single_event_right_sidebar'] : '';
}

$sidebar_width = isset($_GET['sidebar_width']) ? $_GET['sidebar_width'] : '';
if (!in_array($sidebar_width, array('small','large'))) {
	$sidebar_width = rwmb_meta($prefix.'sidebar_width');
	if (($sidebar_width === '') || ($sidebar_width == '-1')) {
		$sidebar_width = $g5plus_options['single_event_sidebar_width'];
	}
}
// Calculate sidebar column & content column
$sidebar_col = 'col-md-3';
if ($sidebar_width == 'large') {
	$sidebar_col = 'col-md-4';
}

$content_col_number = 12;
if ($sidebar == 'left') {
	if ($sidebar_width == 'large') {
		$content_col_number -= 4;
	} else {
		$content_col_number -= 3;
	}
}
if ($sidebar == 'right') {
	if ($sidebar_width == 'large') {
		$content_col_number -= 4;
	} else {
		$content_col_number -= 3;
	}
}

$content_col = 'col-md-' . $content_col_number;
if (($content_col_number == 12) && ($layout_style == 'full')) {
	$content_col = '';
}
$main_class = array('single-event-wrap');
if ($content_col_number < 12) {
	$main_class[] = 'has-sidebar';
}
$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();
do_action('g5plus_before_page');
?>
	<main  class="<?php echo join(' ',$main_class) ?>">
		<?php if ($layout_style != 'full'): ?>
		<div class="<?php echo esc_attr($layout_style) ?> clearfix">
			<?php endif;?>
			<?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
			<div class="row clearfix">
				<?php endif;?>
				<?php if (($sidebar == 'left') || ($sidebar == 'both')):?>
					<div class="sidebar left-sidebar tribe-events-single <?php echo esc_attr($sidebar_col) ?> col-sm-12">
						<?php while ( have_posts() ) :  the_post(); ?>
							<div <?php post_class(); ?>>
								<!-- Event meta -->
								<?php tribe_get_template_part( 'modules/meta' ); ?>
							</div> <!-- #post-x -->
						<?php endwhile; ?>
						<div class="widget mg-bottom-60">
							<h4 class="widget-title"><span><?php esc_html_e('Share our event','g5plus-academia') ?></span></h4>
							<?php  g5plus_get_template('social-share'); ?>
						</div>
						<?php if (is_active_sidebar( $left_sidebar )){
							dynamic_sidebar( $left_sidebar );
						}?>
					</div>
				<?php endif;?>
				<div class="<?php echo esc_attr($content_col) ?> col-sm-12 mg-bottom-60">
					<div class="single-post-inner">
						<!-- Notices -->
						<?php tribe_the_notices() ?>
						<!-- #tribe-events-header -->

						<?php while ( have_posts() ) :  the_post(); ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<!-- Event featured image, but exclude link -->
								<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>
								<?php the_title( '<h4 class="tribe-events-single-event-title mg-top-60 fs-25 heading-color">', '</h4>' ); ?>
								<span class="event-author"><?php the_author(); ?></span>
								<span class="event-comment"><?php echo get_comments_number(); ?></span>
								<?php if (function_exists('g5plus_get_post_views') ):?>
									<span class="event-view"><?php echo g5plus_get_post_views(); ?></span>
								<?php endif; ?>
								<!-- Event content -->
								<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
								<div class="tribe-events-single-event-description tribe-events-content">
									<?php the_content(); ?>
									<div class="single-event-tag">
										<?php echo tribe_meta_event_tags( sprintf( esc_html__( '%s Tags:', 'the-events-calendar' ), tribe_get_event_label_singular() ), ', ', false ) ?>
									</div>
								</div>
								<!-- .tribe-events-single-event-description -->
								<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
								<!-- Event meta -->
								<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
								<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
							</div> <!-- #post-x -->
						<?php endwhile; ?>

						<!-- Event footer -->
						<div id="tribe-events-footer">
							<!-- Navigation -->
							<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?></h3>
							<ul class="tribe-events-sub-nav">
								<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
								<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
							</ul>
							<!-- .tribe-events-sub-nav -->
						</div>
						<?php if (get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
						<!-- #tribe-events-footer -->
					</div>
				</div>
				<?php if (($sidebar == 'right') || ($sidebar == 'both')):?>
					<div class="sidebar right-sidebar tribe-events-single <?php echo esc_attr($sidebar_col) ?> col-sm-12">
						<?php while ( have_posts() ) :  the_post(); ?>
							<div <?php post_class(); ?>>
								<!-- Event meta -->
								<?php tribe_get_template_part( 'modules/meta' ); ?>
							</div> <!-- #post-x -->
						<?php endwhile; ?>
						<div class="widget mg-bottom-60">
							<h4 class="widget-title"><span><?php esc_html_e('Share our event','g5plus-academia') ?></span></h4>
							<?php g5plus_get_template('social-share'); ?>
						</div>
						<?php if (is_active_sidebar( $right_sidebar )){
							dynamic_sidebar( $right_sidebar );
						}?>
					</div>
				<?php endif;?>
				<?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
			</div>
		<?php endif;?>
			<?php if ($layout_style != 'full'): ?>
		</div>
	<?php endif;?>
	</main>