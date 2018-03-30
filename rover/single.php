<?php
/**
 * Single
 * @package by Theme Record
 * @auther: MattMao
 */
get_header();

#Get options
global $tr_config;
$enable_date = $tr_config['enable_blog_date'];
$enable_category = $tr_config['enable_blog_categories'];
$enable_author = $tr_config['enable_blog_author'];
$enable_comments = $tr_config['enable_blog_comments'];

#Get meta
$post_format = get_meta_option('blog_type');
?>
<div id="main" class="right-side clearfix">

<article id="content">
	<?php if (have_posts()) : the_post(); ?>
	<div class="post-blog">
	<div class="post post-blog-single post-<?php echo $post_format; ?> clearfix" id="post-<?php the_ID(); ?>">
	<div class="post-meta clearfix">
		<div class="link"><a href="<?php the_permalink(); ?>" title="" rel="bookmark"><?php the_title(); ?></a></div>
		<div class="entry-header">
			<h2 class="title"><?php the_title(); ?></h2>
			<p class="entry-header-meta meta">
			<?php if($enable_date == true) : ?><b><?php _e('Date', 'TR'); ?>:</b><?php the_time( get_option('date_format') ); ?><span>&#8211;</span><?php endif; ?>
			<?php if($enable_category == true) : ?><b><?php _e('Posted', 'TR'); ?>:</b><?php the_category(', '); ?><span>&#8211;</span><?php endif; ?>
			<?php if($enable_comments == true) : ?><b><?php _e('Comments', 'TR'); ?>:</b><?php comments_popup_link(0, 1, '%'); ?><span>&#8211;</span><?php endif; ?>
			<?php if($enable_author == true) : ?><b><?php _e('Author', 'TR'); ?>:</b><?php the_author_posts_link(); ?><span>&#8211;</span><?php endif; ?>
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
	<div class="post-format"><?php the_content(); ?></div>
	<?php echo get_the_term_list( get_the_ID(), 'post_tag', '<div class="post-tags"><b>'. __('Tags', 'TR') .':</b>', ' , ', '</div>' ); ?>
	</div>
	<!--end entry-->
	</div>
	</div>
	<!--End Blog Single-->

	<?php if(comments_open()) { comments_template( '', true ); } ?>

	<?php endif; ?>

</article>
<!--End Content-->

<?php theme_sidebar('blog');?>

</div>
<!-- #main -->
<?php get_footer(); ?>

