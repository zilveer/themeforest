<?php
$excerpt_length=th_theme_data('excerpt_length');
if (!$excerpt_length) { $excerpt_length = 70; } ?>
<?php
    if ( have_posts() ) :
        // Start the Loop.
        while ( have_posts() ) : the_post();
?>
			<div <?php post_class() ?> >
				<a href="<?php the_permalink()?>"><?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?></a>
				 <div class="i-blog-content">
				 
					<div class="i-blog-info">
						<span class="i-blog-author"><?php esc_html_e( 'By', 'larx' ); ?> <a rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_the_author(); ?></a></span>
						<span class="i-blog-date"><?php echo get_the_date(); ?></span>
					</div>
					
					<div class="i-blog-title">
						<h2><a href="<?php the_permalink()?>"><?php the_title()?></a></h2>
					</div>
					
					<?php echo content('excerpt', $excerpt_length); ?>
					
					<?php $switch_continue_reading_button = th_theme_data('switch_continue_reading_button');
						if($switch_continue_reading_button == ''){
							$switch_continue_reading_button = 1;
						}
					?>
					<?php if ($switch_continue_reading_button == 1){ ?>
						<br>
						<a class="btn gold-btn" href="<?php the_permalink()?>"><?php  esc_html_e('Read More', 'larx'); ?></a>
					<?php } else{} ?>
				</div>
			</div>
<?php
        endwhile;
    else :
        echo esc_html('No posts found', 'larx' );
    endif;
?>