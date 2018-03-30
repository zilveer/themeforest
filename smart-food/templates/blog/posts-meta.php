<?php
/**
 * Blog Template Part: Adjacent Links
 * @version 1.0
 */
?>
<ul class="intro-meta">
	<?php if(tdp_option('display_date')) : ?>
		<li>
			<div class="intro-meta-day"><?php the_time( 'd' ); ?></div>
			<div class="intro-meta-month"><?php the_time('M'); ?></div>
		</li>
	<?php endif; ?>
	<?php if(tdp_option('display_author')) : ?>
		<li>
			<strong><?php _e('Author', 'smartfood');?></strong>
			<?php the_author_posts_link(); ?>
		</li>
	<?php endif; ?>
	<?php if(tdp_option('display_comments')) : ?>
		<li>
			<strong><?php _e('Comments', 'smartfood');?></strong>
			<?php comments_popup_link(__('0 Comments', 'smartfood'), __('1 Comment', 'smartfood'), __('% Comments', 'smartfood') ); ?>
		</li>
	<?php endif; ?>
	<?php if(tdp_option('display_categories')) : ?>
		<li class="categories">
			<strong><?php _e('Category', 'smartfood');?></strong>
			<?php the_category(', '); ?>
		</li>
		<?php if(has_tag( )) : ?>
		<li class="tags">
			<strong><?php _e('Tags', 'smartfood');?></strong>
			<?php the_tags(', '); ?>
		</li>
		<?php endif; ?>
	<?php endif; ?>
</ul>