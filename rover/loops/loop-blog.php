<?php
/**
 * Blog loop
 * @package by Theme Record
 * @auther: MattMao
 */

#Get options
global $tr_config;
$enable_date = $tr_config['enable_blog_date'];
$enable_category = $tr_config['enable_blog_categories'];
$enable_author = $tr_config['enable_blog_author'];
$enable_comments = $tr_config['enable_blog_comments'];
?>
<div class="blog-list post-blog">
<ul>
<?php 
	while (have_posts()) : the_post();

	#Get meta
	$post_format = get_meta_option('blog_type');
?>
<!--Begin Item-->

<li class="post post-<?php echo $post_format; ?> clearfix">
	<div class="post-meta clearfix">
		<div class="link"><a href="<?php the_permalink(); ?>" title="" rel="bookmark"><?php the_title(); ?></a></div>
		<div class="entry-header">
			<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p class="entry-header-meta meta">
			<?php if($enable_date == true) : ?><?php the_time( get_option('date_format') ); ?><span>&#8211;</span><?php endif; ?>
			<?php if($enable_comments == true) : ?><?php comments_popup_link(__('0 Comment', 'TR'), __('1 Comment', 'TR'), __('% Comments', 'TR')); ?><span>&#8211;</span><?php endif; ?>
			<?php if($enable_category == true) : ?><b><?php _e('In', 'TR'); ?>:</b><?php the_category(', '); ?><span>&#8211;</span><?php endif; ?>
			<?php if($enable_author == true) : ?><b><?php _e('By', 'TR'); ?>:</b><?php the_author_posts_link(); ?><span>&#8211;</span><?php endif; ?>
			<?php edit_post_link( __('Edit', 'TR'), '', '<span>&#8211;</span>' ); ?>
			</p>
		</div>
	</div>
	<!--end meta-->


	<div class="post-entry clearfix">
	<?php 
	switch($post_format)
	{
		case 'image':
		theme_content_image();
		break;

		case 'slideshow':
		theme_content_gallery();
		break;

		case 'audio':
		theme_content_audio();
		break;

		case 'video':
		theme_content_video();
		break;

		case 'link':
		 theme_content_link();
		break;

		case 'quote':
		theme_content_quote();
		break;
	}
	?>
	<div class="post-format clearfix">
	<?php 
		global $more;
		$more = 0;
		the_content(__('Read more', 'TR'));
	?>
	</div>
	<!--end format-->
	</div>
	<!--end entry-->
</li>

<!--End Item-->
<?php endwhile; ?>
</ul>
</div>