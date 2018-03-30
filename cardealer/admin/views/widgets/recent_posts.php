<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$query = new WP_Query(array(
	'post_type' => 'post',
	'showposts' => $instance['post_number'],
	'cat' => $instance['category']
		));

global $post;
?>

<div class="widget widget_latest">

	<?php if ($instance['title'] != '') { ?>
		<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
	<?php } ?>

    <ul class="clearfix">

		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

				<?php
				$title = get_the_title();
				if(isset($instance['truncate_title']) && $instance['truncate_title']){
					$title_after = strlen($title) > (int) $instance['truncate_title_symbols_count'] ? ' ...' : '';
					$title = mb_substr($title, 0, (int) $instance['truncate_title_symbols_count']) . $title_after;
				}
				?>

				<li>
					<?php if ($instance['show_thumbnail']) : ?>
						<a href="<?php the_permalink(); ?>" class="thumb single-image">
							<img alt="<?php echo $title; ?>" src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '80*70'); ?>">
						</a>
					<?php endif; ?>

					<div class="table-entry">

						<h4>
							<a href="<?php the_permalink(); ?>">
								<?php echo $title; ?>
							</a>
						</h4>

						<a class="entry-date icon-calendar" href="<?php echo(site_url() . '/' . get_the_time('Y') . '/' . get_the_time('m')) ?>">
							<?php the_time('M d, Y'); ?>
						</a>

						<?php if(isset($instance['show_comments_number']) && $instance['show_comments_number']){ ?>
							<a class="entry-comments icon-comment-6" href="<?php the_permalink() ?>#comments">
								<?php echo get_comments_number($post->ID); ?>
							</a>
						<?php } ?>

						<p>
							<?php if ($instance['show_exerpt']) : ?>

								<?php $exerpt = get_the_excerpt(); ?>
								<?php if (!empty($exerpt)): ?>
									<?php
									if ((int) $instance['exerpt_symbols_count'] > 0) {
										echo mb_substr(strip_tags($exerpt), 0, (int) $instance['exerpt_symbols_count']) . " ...";
									} else {
										the_excerpt();
									}
									?>
								<?php else : ?>
									<?php echo mb_substr(strip_tags(get_the_content($post->ID)), 0, (int) $instance['exerpt_symbols_count']) . " ..."; ?>
								<?php endif; ?>

							<?php endif; ?>
						</p>

					</div><!--/ .table-entry-->
				</li>

				<?php
			endwhile;
		endif;

		wp_reset_postdata();
		?>

    </ul>

	<?php if ($instance['show_see_all_button'] == "true"): ?>
		<?php if ($instance['category'] > 0): ?>
			<a class="button orange" href="<?php echo get_category_link((int) $instance['category']); ?>"><?php _e('See all posts', 'cardealer'); ?></a>
		<?php else: ?>
			<a class="button orange" href="<?php echo home_url() . '/' . date('Y') ?>"><?php _e('See all posts', 'cardealer'); ?></a>
		<?php endif; ?>
	<?php endif; ?>

</div><!--/ .widget-->

