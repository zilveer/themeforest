<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<?php while ($content->looping() ) : ?>
<section class="content container" id="<?php $content->slug(); ?>">
	
	<div id="ajaxpage" class="container">

		<div class="project-hero grid-full">

			<?php 

				$format = get_post_format();

				switch( $format ) {

					case( false ) :
					?>

					<?php $content->img(941,0); ?>

					<?php
					break;

					case( 'gallery' ) :
					?>
					<!-- Slider -->
					<ul class="slider clearfix">

					<?php $loop = $t->gallery->getSliderLoop($meta->gallery->id); ?>
					<?php if ( $loop ): ?>
					<?php while ($slide =& $loop->next()): ?>

						<li><?php echo $t->image->resizedImg($slide->img,941,519); ?></li>

					<?php endwhile; ?>
					<?php endif; ?>

					</ul>

					<!-- Pager -->
					<div class="slider-pager"></div>
					<div class="small-border"></div>

					<div class="project-gallery-next"><a class="bx-next" href=""><?php _e("Next",'Pixelentity Theme/Plugin'); ?></a></div>
					<div class="project-gallery-prev"><a class="bx-prev" href=""><?php _e("Prev",'Pixelentity Theme/Plugin'); ?></a></div>

					<?php
					break;

					case( 'video' ) :
					?>
					<!-- Video -->
					<div class="video">

					<?php $videoID = $meta->video->id; ?>
					<?php if ($video = $t->video->getInfo($videoID)): ?>
					<div class="embed-container">
						<?php switch($video->type): case "youtube": ?>
						<iframe width="940" height="529" src="http://www.youtube.com/embed/<?php echo $video->id; ?>?autohide=1&modestbranding=1&showinfo=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<?php break; case "vimeo": ?>
						<iframe src="http://player.vimeo.com/video/<?php echo $video->id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="940" height="529" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						<?php endswitch; ?>
					</div>
					<?php endif; ?>

					</div>

					<?php
					break;

				}


			?>
		</div>

		<div class="project-title grid-full">
			<h4><?php $content->title(); ?></h4>
			<h6><em><?php 

			$terms = get_the_terms( get_the_id(), 'prj-category' );
			$output = '';

			if ( $terms && ! is_wp_error( $terms ) ) :

				foreach ( $terms as $term ) {
					$output .= $term->name . ' / ';
				}

				$output = substr( $output, 0, -3 );

				echo $output;

			endif;

			?></em></h6>
		</div>

		<div class="project-info clearfix">
			<?php $content->content(); ?>
		</div>

	</div>

</section>
<?php endwhile; ?>

<?php get_footer(); ?>