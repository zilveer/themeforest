<?php
global $smof_data;

if (have_posts()) :
	while(have_posts()) :
		the_post(); ?>

			<div class="<?php $allClasses = get_post_class(); if ( ! in_array('post',$allClasses)) echo 'post'; if ( ! in_array('sticky',$allClasses) && is_sticky()) echo ' sticky'; foreach ($allClasses as $class) { echo " " . $class; } ?>">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="date"><?php echo the_time(get_option('date_format')); _e( ' at ', 'royalgold' ); echo the_time(get_option('time_format')); ?></div>
<?php if( ! empty($smof_data['single_post_meta'])) : ?>
				<div class="meta clearfix">
					<p><span class="permalink"><?php _e('Posted by ', 'royalgold') ?></span> <?php the_author_posts_link(); ?></p>
<?php if (comments_open()) : ?>
					<p><span class="comments"><?php _e('Discussion ', 'royalgold') ?></span> <a href="<?php the_permalink() ?>#comment"><?php comments_number() ?></a></p>
<?php endif; ?>
<?php if (get_the_tags()) : ?>
					<p><?php the_tags('<span class="tags">' . __('Tags:', 'royalgold') . '</span> ') ?></p>
<?php endif; ?>
				</div>
<?php endif; // show meta data information ?>
<?php if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" class="thumb"><span class="overlay"></span><?php echo wp_get_attachment_image( get_post_thumbnail_id(), 'medium'); ?><span class="icon-link"></span></a>
<?php endif; ?>
				<div class="small"><?php the_excerpt(); ?></div>
			</div>
			<div class="sep"><span></span></div>
<?php endwhile; ?>
			<?php pagination_links(); ?>
<?php else:
		get_template_part( 'part-noresult' );
endif; ?>