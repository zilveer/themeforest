<?php
/**
 * @package smartfood
 */
?>

<article id="post-<?php the_ID(); ?>" <?php tdp_attr( 'post' ); ?>>

	<?php if(has_post_thumbnail()) : ?>
		
		<?php 
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb, 'full' ); //get full URL to image (use "large" or "medium" if the images too big)
		?>
		<figure class="post-img media col-md-12 column">
			<div class="mediaholder <?php if(is_singular( )) : ?>lightbox<?php endif;?>">
				<?php if(is_singular( )) : ?>
					<a href="<?php echo $img_url; ?>" title="<?php the_title(); ?>" class="image-link" data-effect="">
				<?php else :?>	
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="image-link" data-effect="">
				<?php endif; ?>
					<img src="<?php echo fImg::resize( $img_url, 780, 350, true ); ?>" alt="<?php the_title();?>"/>
					<div class="hovercover">
			            <div class="hovericon"><i class="fa fa-plus"></i></div>
			         </div>
				</a>
			</div>
		</figure>

	<?php endif; ?>

	<div class="col-md-2 h-np">

	<?php get_template_part( 'templates/blog/posts', 'meta' ); ?>

	</div>

	<div class="col-md-10 column post-content">

		<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h2>

		<?php the_content( __( '<span class="read-more-link">Continue reading <span class="meta-nav">&rarr;</span></span>', 'smartfood' ) ); ?>

		<?php
	 	$defaults = array(
			'before'           => '<p>' . __( 'Pages:', 'smartfood' ),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( 'Next page', 'smartfood' ),
			'previouspagelink' => __( 'Previous page', 'smartfood' ),
			'pagelink'         => '%',
			'echo'             => 1
		);
	 
	    wp_link_pages( $defaults );

		?>

	</div>

	<div class="clearfix"></div>
		
</article><!-- #post-## -->