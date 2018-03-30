<?php
/**
 * @package smartfood
 */
?>
<article id="post-<?php the_ID(); ?>" <?php tdp_attr( 'post' ); ?>>

	<figure class="post-img media">
			<div class="mediaholder flexslider">
				<?php 
					if(is_singular( )) :
						get_template_part( 'templates/blog/gallery', 'single' );
					else:
						get_template_part( 'templates/blog/gallery', 'regular' );
					endif;
				?>
          	</div>
    </figure>

	<div class="col-md-2 h-np">

		<?php get_template_part( 'templates/blog/posts', 'meta' ); ?>

	</div>

	<div class="col-md-10 column post-content">

		<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h2>

		<?php the_content( __( '<span class="read-more-link">Continue reading <span class="meta-nav">&rarr;</span></span>', 'smartfood' ) ); ?>

	</div>

	<div class="clearfix"></div>
	
</article><!-- #post-## -->