<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $post, $authordata, $comments_count;

$id             = get_the_id();
$author         = get_the_author();
$comments_count = wp_count_comments($id)->approved;

$posts_url      = get_author_posts_url($authordata->ID);
$user_url       = $authordata->user_url;

if($author_info):

	if( ! $user_url)
		$user_url = $posts_url;

	$author_link = '<a href="' . $user_url . '">' . get_the_author() . '</a>';

	?>
	<div class="author-post">

		<div class="author-img">
			<a href="<?php echo $user_url; ?>"><?php echo get_avatar($authordata->ID); ?></a>
		</div>

		<div class="author-description">
			<span class="author-name">
				<?php echo sprintf(__("About the author: %s", 'aurum'), $author_link); ?>
			</span>

			<p class="author-about">
				<?php echo $authordata->description ? nl2br($authordata->description) : __('No other information about this author.', 'aurum'); ?>
			</p>
		</div>
	</div>
	<?php

endif;