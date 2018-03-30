<?php 
global $theme_options;
$location = icore_get_location();
?>

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
            	<?php if ( has_post_thumbnail() && isset($theme_options[$location . '_thumb']) && $theme_options[$location . '_thumb'] == '1' ) : ?>
					<div class="entry-left">
                		<div class="index-thumb"> 
            				<a href="<?php the_permalink() ?>" title="Read <?php the_title_attribute(); ?>">
								<?php the_post_thumbnail("post-thumb"); ?>
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