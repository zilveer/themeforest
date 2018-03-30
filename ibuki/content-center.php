<?php 
$options_ibuki = get_option('ibuki'); 
$options_ibuki['blog_type'] = 'center-blog';
$blog_type = $options_ibuki['blog_type'];

$img_thumb_listed = wp_get_attachment_image_src( get_post_thumbnail_id(), 'listed-blog-thumb' );
$img_thumb_center = wp_get_attachment_image_src( get_post_thumbnail_id(), 'center-blog-thumb' );
?>

<?php if( !is_single() ) { ?>

<?php if($blog_type == 'listed-blog') { ?>
<div class="blog-post-thumb-listed">
	<a class="blog-photo" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
		<div class="blog-post-image" style="background-image: url('<?php echo $img_thumb_listed[0]; ?>');">
			<span class="overlay-bg-blog"><i class="read-icon"></i></span>
		</div>
		<div class="blog-post-description">
			<div class="blog-naming">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<span class="line"></span>
				<h3 class="published"><?php the_time( get_option('date_format') ); ?> / <?php comments_number( 'no comments', 'one comment', '% comments' ); ?></h3>
			</div>
		</div>
	</a>
</div>
<?php } else if($blog_type == 'center-blog') { ?>
<div class="blog-post-thumb-center" style="background-image: url('<?php echo $img_thumb_center[0]; ?>');">
	<span class="overlay-bg-blog"></span>
	<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
		<div class="blog-post-box">
			<div class="blog-naming">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<span class="line"></span>
				<h3 class="published"><?php the_time( get_option('date_format') ); ?> / <?php comments_number( 'no comments', 'one comment', '% comments' ); ?></h3>
			</div>
		</div>
	</a>
</div>
<div class="blog-post-content-center">
	<div class="entry-content">
		<?php the_content( __("Continue Reading...", AZ_THEME_NAME) );?>
	</div>
</div>
<?php } ?>

<?php } ?>

<?php if( is_single() ) { ?>

<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
<div class="post-thumb">
	<?php the_post_thumbnail(); ?>
</div>
<?php } ?>

<div class="entry-content">
    <?php the_content( __("Continue Reading...", AZ_THEME_NAME) );?>
    <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', AZ_THEME_NAME).'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>

<?php get_template_part( 'content', 'meta-footer' ); ?>

<?php } ?>