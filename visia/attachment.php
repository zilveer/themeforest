<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<section class="content padded container blog" id="<?php $content->slug(); ?>">

	<div class="title grid-full">
		<h2><?php $content->title(); ?></h2>
		<span class="border"></span>
	</div>

	<div class="grid-6">
		<?php while ($content->looping() ) : ?>

			<div <?php post_class( 'post post-single' ); ?>>
				<div class="inner-spacer-right-lrg">

						<?php if ( wp_attachment_is_image( $post->id ) ) : ?>
							<div class="post-media clearfix">
								<?php $img = wp_get_attachment_image_src( $post->id, "full"); ?>
								<?php $content->img(960,0,$img[0]); ?>
							</div>
						<?php endif; ?>

				</div>
			</div>

		<?php endwhile; ?>
	</div>
</section>

<?php get_footer(); ?>