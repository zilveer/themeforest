<?php

include(locate_template('templates/post/header.php'));

$meta_author   = wpv_get_optionb( 'show-post-author' );
$meta_tax      = wpv_get_optionb( 'meta_posted_in' );
$meta_date     = wpv_get_optionb( 'meta_posted_on' );
$meta_comments = wpv_get_optionb( 'meta_comment_count' );

?><div class="post-content-outer single-post">

	<?php if ( $meta_author || $meta_date || ( $meta_comments && comments_open() ) ) : ?>
		<div class="meta-top clearfix">
			<?php if ( $meta_author ) : ?>
				<span class="author"><?php the_author_posts_link()?></span>
			<?php endif ?>
			<?php if ( $meta_date ) : ?>
				<span class="post-date" itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?> </span>
			<?php endif ?>
			<?php if ( $meta_comments && comments_open() ): ?>
				<div class="comment-count">
					<a href="<?php comments_link() ?>" class="icon theme"><?php wpv_icon('comments')?></a><?php comments_popup_link(__('0 <span class="comment-word visuallyhidden">Comments</span>', 'health-center'), __('1 <span class="comment-word visuallyhidden">Comment</span>', 'health-center'), __('% <span class="comment-word visuallyhidden">Comments</span>', 'health-center')); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif ?>

	<?php if (isset($post_data['media'])):?>
		<div class="post-media">
			<div class='media-inner'>
				<?php echo $post_data['media']; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php include(locate_template('templates/post/content.php')); ?>

	<?php if ( $meta_tax ) : ?>
		<div class="meta-bottom clearfix">
			<div><span class="icon"><?php wpv_icon('folder1'); ?></span><span class="visuallyhidden"><?php _e('Category', 'health-center') ?></span><?php the_category(', '); ?></div>
			<?php the_tags('<div class="the-tags"><span class="icon">' . wpv_get_icon('tag') . '</span><span class="visuallyhidden">'.__('Tags', 'health-center').'</span>', ', ', '</div>')?>
		</div>
	<?php endif ?>

	<?php WpvTemplates::share('post'); ?>

</div>