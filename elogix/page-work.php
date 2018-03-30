<?php
/*
Template Name: Work
*/
?>

<?php get_header(); ?>
	
<div id="page" class="border-top clearfix">

	<div class="color-hr2"></div>
	
	<div id="subtitle">
		
		<h2><span><?php the_title(); ?>.</span> <?php echo get_post_meta( get_the_ID( ), 'minti_subtitle', true ); ?></h2>

	</div>
	
	<ul id="filters" class="clearfix">
			<li><a href="#" data-filter="*" class="active"><?php _e('Show All', 'framework'); ?></a></li>
			<?php wp_list_categories(array('title_li' => '', 'taxonomy' => 'filters', 'walker' => new Works_Walker())); ?>
	</ul>
	
	<div id="content-full" class="clearfix">
	
	<div id="container">
		<?php $args = array( 'post_type' => 'work', 'posts_per_page' => 999 );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
			<?php $terms = get_the_terms( get_the_ID(), 'filters' ); ?>              	
			<div class="<?php if($terms) : foreach ($terms as $term) { echo 'term'.$term->term_id.' '; } endif; ?>">
				
				<div class="work-item">
				<?php if ( has_post_thumbnail()) { ?> 
				
					<?php if( get_post_meta( get_the_ID(), 'minti_lightbox', true ) == "yes" AND  get_post_meta( get_the_ID(), 'minti_embed', true ) != "") { ?>

						<?php if ( get_post_meta( get_the_ID(), 'minti_source', true ) == 'youtube' ) {  ?>
						
								<a href="http://www.youtube.com/watch?v=<?php echo get_post_meta( get_the_ID(), 'minti_embed', true ); ?>" class="prettyPhoto" title="<?php the_title(); ?>">
									<?php the_post_thumbnail('work-thumb'); ?>
								</a>
	    				
	    				<?php } else if ( get_post_meta( get_the_ID(), 'minti_source', true ) == 'vimeo' ) { ?>
	    				
	    						<a href="http://vimeo.com/<?php echo get_post_meta( get_the_ID(), 'minti_embed', true ); ?>" class="prettyPhoto" title="<?php the_title(); ?>">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    						</a>
	
	    				<?php } else if ( get_post_meta( get_the_ID(), 'minti_source', true ) == 'own' ) {?>
	
	
	    						<a href="#embedd-video" class="prettyPhoto" title="<?php the_title(); ?>">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    						</a>
	    						
	    						<div id="embedd-video">
									<p><?php echo get_post_meta( get_the_ID(), 'minti_embed', true ); ?></p>
								</div>
								
						<?php } ?>
					
				<?php } else if ( get_post_meta( get_the_ID(), 'minti_lightbox', true ) == "yes" AND  get_post_meta( get_the_ID(), 'minti_embed', true ) == "") { ?>
				
						<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="prettyPhoto" title="<?php the_title(); ?>">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    				</a>
				
				<?php } else if ( get_post_meta( get_the_ID(), 'minti_lightbox', true ) == "no" AND  get_post_meta( get_the_ID(), 'minti_embed', true ) == "") { ?>
				
						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="pic">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    				</a>
				
				<?php } else if ( get_post_meta( get_the_ID(), 'minti_lightbox', true ) == "no" AND  get_post_meta( get_the_ID(), 'minti_embed', true ) != "") { ?>
				
						<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="video">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    				</a>
				
				<?php } else { ?>
					
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="pic">
	    							<?php the_post_thumbnail('work-thumb'); ?>
	    				</a>
				
				<?php } ?>
				
				<?php } ?>
				
					<div class="work-description">
						<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
						<span><?php echo get_post_meta( get_the_ID(), 'minti_description', true ); ?></span>
					</div>
				</div>
			
			</div> <!-- end of terms -->	
			
		<?php endwhile; ?>
	</div>
	
	</div>
	
	

</div>

<?php get_footer(); ?>