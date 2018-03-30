<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
 */


if ( has_post_thumbnail( get_the_ID() ) ) {
	$attachment = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	$post_thumbnail = $attachment[0];
} else {
	$post_thumbnail = get_template_directory_uri().'/images/no-image.png';
}

?>


<article id="post-<?php the_ID(); ?>" <?php post_class('blog-wrapper'); ?>>
	<div class="blog-media">
		<img src="<?php echo crum_theme_thumb($post_thumbnail,'360','225', true, 't');  ?>" alt="<?php echo esc_attr(get_the_title()) ?>"/>
	</div><!-- end media -->
	<div class="blog-desc text-left">
		<header class="entry-header">

			<?php omni_entry_categories(); ?>

			<?php the_title( sprintf( '<h2 class="entry-title blog-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php omni_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php
			global $post;
			if($pos=strpos($post->post_content, '<!--more-->')){
				the_content();
			}else{
				the_excerpt();
			} ?>
		</div><!-- .entry-content -->
	</div><!-- end blog-desc -->
</article><!-- #post-## -->
