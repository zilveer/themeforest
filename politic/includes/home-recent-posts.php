<div class="recent-posts full-width">

	<?php $number = get_option( 'icy_recent_posts_slide_number' ); ?>

		<?php 
		$number = get_option ('icy_recent_posts_number');
		$query = new WP_Query();
		$query->query( array(
			'posts_per_page' => $number,
		    'ignore_sticky_posts' => 1,
		    ));
		?>

        <div class="posts-car-controls">
            <a class="posts-car-prev"><div class="work-car-prev-ico"></div></a>
            <a class="posts-car-next"><div class="work-car-next-ico"></div></a>
        </div>		

<div class="posts-carousel">
	<ul>

		<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

			<li class="four columns no-bottom">

				<div class="recent-post-entry blog-post-detail">

					<h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> 
						<?php the_title(); ?>
					</a></h3>					
			        
					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div>

					<div class="meta-comments"><span class="meta-icon date"></span><?php the_time('m/j/y') ?><span class="meta-icon comments"></span><?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?></div>

				</div>

			</li>
			
			<?php endwhile; ?>

		<?php endif; ?>

		<?php wp_reset_query(); ?>

	</ul>
</div>

</div>	