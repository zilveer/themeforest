<?php
if (!defined('ABSPATH')) die('No direct access allowed');

if ( is_home() && ! is_front_page() ) {
	$id = get_option('page_for_posts');
	$post = get_post($id);
}

/* Display/hide page header */
$headerbg_hide = $post ? (int) get_post_meta($post->ID, 'headerbg_hide', true) : false;

if (!$headerbg_hide) { ?>

	<div class="large-12 columns">
		<div class="page-title">

			<?php if (is_404()): ?>
				<h1><?php _e("Page not Found", 'diplomat') ?></h1>
			<?php else:

				if (is_single() || is_page() || is_home()){

					$page_title = $post->post_title;
					$another_page_title = get_post_meta($post->ID, 'another_page_title', true);
					$another_page_description = get_post_meta($post->ID, 'another_page_description', true);
					if (!empty($another_page_title)) {
						$page_title = $another_page_title;
					}

					if (get_post_type() === 'event' && TMM::get_option('tmm_single_event_title')) {
						$page_title = TMM::get_option('tmm_single_event_title');
					}
					?>

					<h1 <?php echo ((strlen($post->post_title) > 23) ? "class='font-small'" : '') ?>><?php echo esc_html($page_title); ?></h1>

					<?php if (!empty($another_page_description)){ ?>
						<h2><?php echo esc_html($another_page_description); ?></h2>
					<?php } ?>
				<?php } ?>

				<?php if (is_search()): ?>
					<h1><?php printf(__('Search Results for: %s', 'diplomat'), '<span>' . get_search_query() . '</span>'); ?></h1>
				<?php endif; ?>



				<?php
				$queried_object = get_queried_object();
				$is_defined = false;
				?>

				<?php if (is_object($queried_object)): ?>
					<?php if (isset($queried_object->taxonomy) && $queried_object->taxonomy == 'skills'): $is_defined = true; ?>
						<h1><?php printf(__('Folios by Skills: %s', 'diplomat'), '<span>' . $queried_object->name . '</span>'); ?></h1>
					<?php elseif (isset($queried_object->taxonomy) && $queried_object->taxonomy == 'clients'):$is_defined = true; ?>
						<h1><?php printf(__('Folios by Clients: %s', 'diplomat'), '<span>' . $queried_object->name . '</span>'); ?></h1>
					<?php endif; ?>
				<?php endif; ?>


				<?php if (is_archive() AND !$is_defined): ?>

					<?php if (class_exists('woocommerce') && is_woocommerce()) {
						?>

						<h1><?php woocommerce_page_title(); ?></h1>

					<?php
					}else{
						?>

						<?php if (is_object($queried_object)): ?>
							<?php if (@$queried_object->taxonomy == 'category'):$is_defined = true; ?>
								<h1><?php printf(__('Category: %s', 'diplomat'), '<span>' . $queried_object->name . '</span>'); ?></h1>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ($is_defined == false): ?>
							<h1>
								<?php if (is_day()) : ?>
									<?php printf(__('Daily Archives: %s', 'diplomat'), '<span>' . get_the_date() . '</span>'); ?>

								<?php elseif (is_month()) : ?>
									<?php printf(__('Monthly Archives: %s', 'diplomat'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'diplomat')) . '</span>'); ?>

								<?php elseif (is_year()) : ?>
									<?php printf(__('Yearly Archives: %s', 'diplomat'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'diplomat')) . '</span>'); ?>

								<?php elseif (is_author()) : ?>
									<?php printf(__('Author Archives: %s', 'diplomat'), '<span>' . get_the_author_meta( 'display_name' ) . '</span>'); ?>

								<?php elseif (is_tag()): ?>
									<?php printf(__('Tag Archives: %s', 'diplomat'), '<span>' . single_tag_title('', false) . '</span>'); ?>

								<?php elseif (is_post_type_archive('forum')): ?>
									<?php _e('Forums', 'diplomat'); ?>

								<?php else : ?>
									<?php _e('Blog Archives', 'diplomat'); ?>
								<?php endif; ?>
							</h1>

						<?php endif; ?>

					<?php
					}
					?>

				<?php endif; ?>
			<?php endif; ?>


			<?php
			if (!TMM::get_option("hide_breadcrumb")) {

				if (!is_404()) {
					?>

					<div class="breadcrumbs">
						<?php TMM_Helper::draw_breadcrumbs() ?>
					</div><!--/ .breadcrumbs-->

					<?php
				}
			}
			?>

		</div>
	</div>

<?php } ?>
