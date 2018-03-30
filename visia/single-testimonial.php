<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $hasFeatImage = $content->hasFeatImage(); ?>
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

					<?php if ( ! post_password_required( $post->ID ) ) : ?>

						<?php if ( $hasFeatImage ) : ?>
							<div class="post-media clearfix">
								<?php $content->img(960,0); ?>
							</div>
						<?php endif; ?>

						<div class="post-body pe-wp-default">
							<?php $content->content(); ?>
						</div>

					<?php endif; ?>
				</div>
			</div>

		<?php endwhile; ?>
	</div>
</section>

<?php get_footer(); ?>