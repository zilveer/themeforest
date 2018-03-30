<?php 
/* 
Template Name: Blog - Big thumbnail fullwidth
*/ ?>
<?php get_header();?>
<?php 
global $theme_shortname;
$location = icore_get_location();   
$meta = icore_get_multimeta(array('Subheader'));
?>
<div id="entry-full">
    <div id="left" class="blog-page-big-thumb full-width">
		<div id="head-line"> 
	    <h1 class="title"><?php  the_title();  ?></h1>
		</div>
        <?php
	    $args = array(
	    	'paged' => $paged
	    );
	    $wp_query = null;
	    $wp_query = new WP_Query();
	    $wp_query->query( $args );
	    ?>

	    <?php if ( $wp_query->have_posts() ) : ?>
				
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
    	 	
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="post-content">

							<?php if( isset($theme_options['blog_style']) && $theme_options['blog_style'] == '1' ) { ?>

								<h2 class="blog-style"><a href="<?php the_permalink() ?>" class="title" title="Read <?php the_title_attribute(); ?>"><?php the_title();  ?></a></h2> 
								<div class="meta">
						                <?php the_time('M j, Y');?> <?php  _e('by ','Bonanza');  the_author_posts_link(); ?> <?php _e('in ','Bonanza');  the_category(', ') ?> <?php comments_popup_link(__('0 comments','Bonanza'), __('1 comment','Bonanza'), '% '.__('comments','Bonanza')); ?>
						        </div>  <!-- .meta  -->

					            <?php the_content(); ?>

							<?php } else { ?>
									<!-- Print Thumbnail -->
					            	<?php if ( has_post_thumbnail() && isset($theme_options[$location . '_thumb']) && $theme_options[$location . '_thumb'] == '1' ) : ?>				<div class="entry-left">
					                		<div class="index-thumb"> 
					            				<a href="<?php the_permalink() ?>" title="Read <?php the_title_attribute(); ?>">
													<?php the_post_thumbnail("post-thumb-big"); ?>
												</a>
					            			</div> 
									</div> <!-- .entry-left  -->
					            	<?php endif; ?>
									<div class="entry-right<?php if ( has_post_thumbnail() && isset($theme_options[$location . '_thumb']) && $theme_options[$location . '_thumb'] == '1' )  echo ' has-thumb'; ?>">		
									<h2><a href="<?php the_permalink() ?>" class="title" title="Read <?php the_title_attribute(); ?>"><?php the_title();  ?></a></h2>		
									<div class="meta">
							                <?php the_time('M j, Y');?> <?php  _e('by ','Bonanza');  the_author_posts_link(); ?> <?php _e('in ','Bonanza');  the_category(', ') ?> <?php comments_popup_link(__('0 comments','Bonanza'), __('1 comment','Bonanza'), '% '.__('comments','Bonanza')); ?>
							        </div>  <!-- .meta  -->

						            <div class="post-desc">
						            	<?php  the_excerpt(); ?>
					 				</div>



						    		</div>   <!--  .entry-right  --> 
							<?php } ?>  


						</div><!-- .post-content  -->         
					</article>
					
			<?php endwhile;?>
			
			<?php if(function_exists('wp_pagenavi')) { ?>
				 
					<?php wp_pagenavi(); ?>
				
				<?php } else { ?> 
						
					<?php get_template_part( 'navigation', 'index' ); ?>
						 
				<?php } else : ?>
			
					<?php get_template_part( 'no-results', 'index' ); ?>
			
				<?php endif; wp_reset_query(); ?>
    </div> <!--  end #left  -->
</div> <!--  end #entry-full  -->
<?php get_footer(); ?>
