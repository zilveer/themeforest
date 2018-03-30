<?php
$permalink      = isset( $GLOBALS['post-carousel'] ) ? get_permalink()   : ss_framework_get_featured_image_link('full');
$thumbnail_size = isset( $GLOBALS['post-carousel'] ) ? 'blog-post-thumb' : 'blog-post';
$lightbox       = isset( $GLOBALS['post-carousel'] ) ? null              : 'class="single-image"';
?>

<?php if( has_post_thumbnail() ): ?>

	<?php $post_thumbnail_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumbnail_size ); ?>
	<?php $post_thumbnail_data = ss_framework_get_the_post_thumbnail_data( $post->ID ); ?>

	<a href="<?php echo $post_thumbnail_data['src']; ?>" title="<?php echo the_title(); ?>" <?php echo $lightbox; ?>>
		<img src="<?php echo $post_thumbnail_img[0]; ?>" alt="<?php echo $post_thumbnail_data['alt']; ?>" class="entry-image <?php echo $post_thumbnail_data['class']; ?>">
	</a>

<?php endif; ?>

<div class="entry-body">

	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'ss_framework'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
		<h1 class="title"><?php the_title(); ?></h1>
	</a>

	<?php echo ss_framework_post_content(); ?>

</div><!-- end .entry-body -->

<div class="entry-meta">

	<?php echo ss_framework_post_meta(); ?>

</div><!-- end .entry-meta -->