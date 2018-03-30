<?php
/**
 * @package smartfood
 */
?>

<article id="post-<?php the_ID(); ?>" <?php tdp_attr( 'post' ); ?>>
	
		<div class="media col-md-12 column link-container">
			<div class="link-wrapper">
				<i class="fa fa-link"></i><a href="<?php echo esc_url(get_field('link_url'));?>"><?php echo esc_attr(get_field('link_label'));?></a>
			</div>
		</div>

	<div class="col-md-2 h-np">

		<?php get_template_part( 'templates/blog/posts', 'meta' ); ?>

	</div>

	<div class="col-md-10 column post-content">

		<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h2>

		<?php the_content( __( '<span class="read-more-link">Continue reading <span class="meta-nav">&rarr;</span></span>', 'smartfood' ) ); ?>

	</div>

	<div class="clearfix"></div>
	
</article><!-- #post-## -->