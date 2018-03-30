<?php
/**
 * Template Name: Simple Builder Blog with sidebar
 *
 * @package WordPress
 * @subpackage simple builder
 * @since 1.0
 */


?>
		<article <?php post_class( 'uou-block-7f'); ?> id="post-<?php the_ID(); ?>" >
		<div class = "row">
			
		          <?php 
		          if ( has_post_thumbnail() ) { ?>
		          	<div class = "col-md-3"> 
		          	<?php
		            $image_id 		= get_post_thumbnail_id( get_the_ID() );
		            $large_image 	= wp_get_attachment_url( $image_id ,'full');  
		            $resize 		= sb_aq_resize( $large_image, 270, 270, true );
		           ?>
		        <img class="thumb" src= "<?php echo esc_url($resize); ?>" alt="">
		    	</div>
		    <div class = "col-md-9"> 

			    <div class="meta">
			      <span class="time-ago"> <a href = "<?php the_permalink(); ?>"> <i class="fa fa-clock-o"></i> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?> </a></span>
			      			<?php if(has_category()): ?>
			                    <span class="category">
			                      Posted in: <?php the_category('&nbsp;,&nbsp;'); ?>
			                    </span>
			                <?php endif; ?>

			                  <span class="comments">
			                  	<i class="fa fa-comments"></i>
			                    <?php 
			                      if(comments_open() && !post_password_required()){
			                        comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
			                      }
			                    ?>            
			                  </span>
			    </div>

			    <h1><a href= "<?php the_permalink(); ?>" > <?php the_title(); ?></a></h1>
				 <?php the_excerpt();  ?> 
				<a href="<?php the_permalink(); ?>" class="btn btn-small btn-primary">Read More</a>
			</div>


			<?php  } else { ?>

			<div class = "col-md-12">

			    <div class="meta">
			      	<span class="time-ago"> <a href = "<?php the_permalink(); ?>"> <i class="fa fa-clock-o"></i> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?> </a></span>
			      			<?php if(has_category()): ?>
			                    <span class="category">
			                      Posted in: <?php the_category('&nbsp;,&nbsp;'); ?>
			                    </span>
			                <?php endif; ?>
			                  <span class="comments">
			                    <?php 
			                      if(comments_open() && !post_password_required()){
			                        comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
			                      }
			                    ?>            
			                  </span>
			    </div>
			    <h1><a href= "<?php the_permalink(); ?>" > <?php the_title(); ?></a></h1>
				 <?php the_excerpt(); ?> 
				<a href="<?php the_permalink(); ?> " class="btn btn-small btn-primary">Read More</a>
				</div>
			<?php } ?>
		
		
		</div>
		</article>