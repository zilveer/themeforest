<li <?php post_class( 'row clear' ); ?>  id="article_<?php the_ID(); ?>">

  	<?php if ( has_post_thumbnail() ) : ?>

		<div class="col col-4 tablet-col-4 mobile-full">

			<a href="<?php the_permalink(); ?>">

				<?php the_post_thumbnail(); ?>

			</a>

		</div>

		<div class="col col-8 tablet-col-8 mobile-full">	

	<?php else : ?>

  		<div class="col col-12 tablet-full mobile-full">		  
  
	<?php endif; ?>

    <a class="post-title" href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>

    <h4 class="post-meta">
		<?php __( 'Posted on', 'openframe' ) ?>
			<span class="enbold">
				<time datetime="<?php esc_attr_e( get_the_time( DATE_W3C ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
			</span>
		// <?php __( 'By', 'openframe' ) ?>
			<span class="enbold"><?php the_author_link(); ?></span>
		// <?php __( 'In', 'openframe' ) ?>
			<?php the_category(', ') ?>
			<span class="post-comments"><a href="<?php comments_link(); ?>"><?php comments_number( __( 'No Responses', 'openframe' ), __( '1 Response', 'openframe' ), __( '% Responses', 'openframe' ) ); ?></a></span>
    </h4>

    <hr>

    <div class="post-content">

    	<?php if ( has_excerpt() ) : ?>
    	
	    	<?php the_excerpt(); ?>

	    <?php else : ?>

	    	<?php
	    		// show more link also on pages that use WP_Query (in this case part-section.php)
		    	global $more;
		    	$more = 0;
	    	?>

	    	<?php the_content(); ?>
    	
    	<?php endif; ?>

    </div>

  </div>
  
</li>