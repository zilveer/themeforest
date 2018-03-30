<?php global $VAN;?>
<?php if (have_posts()):?>
 <?php while (have_posts()) : the_post(); ?>
 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
               <?php van_posted_on();?>
               <?php if(has_post_thumbnail()):?>
               <div class="thumbnail"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_post_thumbnail('blog_thumbnail',array('alt'=>esc_attr(get_the_title()),'title'=>esc_attr(get_the_title())));?></a></div>
               <?php endif;?>
               <h2><a href="<?php the_permalink();?>" title="<?php echo esc_attr(get_the_title());?>" rel="bookmark"><?php the_title();?></a></h2>
               <div class="entry">
               <?php 
			   if(has_post_thumbnail()){
				 if($post->post_excerpt){ 
				   the_excerpt();
				 }else{
			       echo van_truncate(strip_tags(get_the_content()),200);
				 }
				 echo '<a href="'.get_permalink().'" class="more-link">'.__('Read More &raquo;','SimpleKey').'</a>';
			   }else{
				  if($post->post_excerpt){ 
				   the_excerpt();
				  }else{
			       van_content(true,true);
				  }
			   }
			   ?>
               </div>
               <div class="clearfix"></div>
  </article>
  <?php endwhile;?>
  
  <?php echo van_pagenavi();?>
  
<?php else:?>
  <article class="post">
               <h2><?php _e( 'No Posts Found In This Category', 'SimpleKey' ); ?></h2>
               <div class="entry">
                   <?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'SimpleKey' ); ?>
                   <?php get_search_form(); ?>
               </div>
               <div class="clearfix"></div>
  </article>
<?php endif;?>