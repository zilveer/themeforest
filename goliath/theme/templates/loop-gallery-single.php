<?php get_header(); ?>

<!-- Homepage content -->
<div class="container homepage-content">

    <!-- Photo galleries -->
    <div class="latest-galleries photo-galleries">

        <div class="title-default">
            <a href="<?php echo get_post_type_archive_link('gallery'); ?>" class="active"><?php _e('Photo galleries', 'goliath' ); ?></a>
            <a href="<?php echo get_post_type_archive_link('gallery'); ?>" class="go-back"><?php _e('Go back to photo gallery', 'goliath' ); ?></a>
        </div>
        
        <div class="gallery-item-open">
        <?php
			if(class_exists('Attachments')) :
				$attachments = new Attachments( 'plsh_galleries' );
				if( $attachments->exist() ) :

					?>
					<div class="control">
						<a class="carousel-control left" id="prev" href="#"><i class="fa fa-chevron-left"></i></a>
						<a class="carousel-control right" id="next" href="#"><i class="fa fa-chevron-right"></i></a>
					</div>

					<div class="gallery-slideshow" 
						 data-cycle-swipe="true"
						 data-cycle-swipe-fx="scrollHorz"
						 data-index="1"
						 data-cycle-log="false"
						 data-cycle-fx="scrollHorz"
						 data-cycle-timeout="0"
						 data-cycle-speed="500"
						 data-cycle-pager="#pager"
						 data-cycle-auto-height="calc"
						 data-cycle-pager-active-class="active"
						 data-cycle-pager-template=""
						 data-cycle-slides="> .slider-item-wrapper"
						 data-cycle-prev="#prev"
						 data-cycle-next="#next"
					>
					<?php
					while($attachments->get())
					{
						?>
						<div class="slider-item-wrapper">
							<div class="image">
								<?php
									echo '<span><s>' . $attachments->field( 'caption' ) . '</s></span>';
									echo '<img src="' . esc_url($attachments->src( 'gallery-large' )) . '" width="' . $attachments->width( 'gallery-large' ) . '" height="' . esc_attr($attachments->height( 'gallery-large' )) . '" alt="' . esc_attr($attachments->field( 'caption' )) . '" />';
								?>
							</div>
						</div>
						<?php
					}
				?>
					</div>

				<div class="thumbs" id="pager">
					<?php
					$c = 0;
					$attachments->rewind();

					while($attachments->get())
					{
						echo '<a href="#"';
						if($c == 0)
						{
							echo 'class="active"';
						}
						echo '>' . $attachments->image( 'post-list-1-slider-item-thumb' ) . '</a>';
						$c++;
					}
					?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
            
            <div class="title">
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <p>
                    <span class="legend-default">
                        <?php 
                            $date = get_the_date();
                            if($date)
                            {
                                echo '<i class="fa fa-clock-o"></i>' . $date;
                            }
                        ?>
                        <i class="fa fa-camera"></i>
						<?php if(class_exists('Attachments'))
							{
								echo esc_html($attachments->total());
							}
						?>
                    </span>
                </p>
                <div class="intro">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

    </div>

    <?php echo $banner = plsh_get_banner_by_location('single_gallery_ad', 'container gallery-ad'); ?>

    <?php
        if(plsh_gs('gallery_show_featured_articles') == 'on')
        {
            get_template_part('theme/templates/featured-posts-large');
        }
    ?>

</div>

<?php get_footer(); ?>