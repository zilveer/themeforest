<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $isSingle = is_single(); ?>

<?php while ($content->looping() ) : ?>

	<?php $meta =& $content->meta(); ?>
	<?php $link = get_permalink(); ?>
	<?php $type = $content->type(); ?>
	<?php $hasFeatImage = $content->hasFeatImage(); ?>
	<?php $classes = is_sticky() ? 'post post-single sticky' : 'post post-single'; ?>

	<div <?php post_class($classes); ?>>

		<?php if ($isSingle): ?>

			<span class="date">
				<?php echo get_the_date('d') ?>
				<br>
				<small><?php echo get_the_date('M') ?></small>
			</span>

		<?php else: ?>

			<a href="<?php echo $link ?>">
				<span class="date">
					<?php echo get_the_date('d') ?>
					<br>
					<small><?php echo get_the_date('M') ?></small>
				</span>	
			</a>
			
		<?php endif; ?>
		
		<div class="inner-spacer-right-lrg">

			<?php if ( ! post_password_required( $post->ID ) ) : ?>

				<div class="post-media clearfix">

					<?php 

					switch($content->format()):

						case "gallery": // Gallery post ?>
						
							<?php $t->media->w(560); ?>
							<?php $t->media->h(315); ?>
							<?php $t->gallery->output($meta->gallery->id,'GalleryImages'); ?>

							<?php break; 

						case "video": // Video post ?>

							<?php $videoID = $t->content->meta()->video->id; ?>

								<?php if ($video = $t->video->getInfo($videoID)): ?>

								<div class="embed-container">
									<?php switch($video->type): case "youtube": ?>
									<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $video->id; ?>?autohide=1&modestbranding=1&showinfo=0" class="fullwidth-video" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
									<?php break; case "vimeo": ?>
									<iframe src="http://player.vimeo.com/video/<?php echo $video->id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" class="fullwidth-video" width="560" height="315" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
									<?php endswitch; ?>
								</div>

								<?php endif; ?>

							<?php break; 

						default: // Standard post ?>

							<?php if ($hasFeatImage): ?>

								<?php $content->img(560,315); ?>

							<?php else: ?>

								<?php if ( ! is_singular() && ! get_post_format() ) $nopostmedia = true; ?>

							<?php endif; ?>

					<?php endswitch; ?>

				</div>

			<?php else : $nopostmedia = true; ?>

			<?php endif; ?>

			<div class="post-title <?php echo isset( $nopostmedia ) ? 'nopostmedia' : ''; ?>">

				<?php unset($nopostmedia); ?>

				<?php if ($isSingle): ?>

					<h2><?php $content->title() ?></h2>
					<?php else: ?>
					<h2><a href="<?php echo $link ?>"><?php $content->title() ?></a></h2>

				<?php endif; ?>

				<div class="post-meta">
					<h6>
					<?php _e("Posted by",'Pixelentity Theme/Plugin'); ?> <?php the_author_posts_link(); ?>
						<?php if ($type === "post"): ?>
						/ <?php $content->category(); ?>
						<?php endif; ?>
					</h6>
				</div>

			</div>
			
			
			<div class="post-body pe-wp-default">
				<?php $content->content(); ?>
				<?php $content->linkPages(); ?>
			</div>

			<?php if (has_tag()): ?>

				<div class="tags">
					<?php the_tags('',' ',''); ?>
				</div>

			<?php endif; ?>

			<?php if ($isSingle && is_singular( 'post' )): ?>

				<?php get_template_part("common","prevnext"); ?>

			<?php endif; ?>

		</div>
	</div>

	<?php if ($isSingle): ?>

		<?php comments_template(); ?>

	<?php endif; ?>

<?php endwhile; ?>

<?php if (!$isSingle): ?>

	<?php $t->content->pager(); ?>

<?php endif; ?>
