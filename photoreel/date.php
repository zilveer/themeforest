<?php get_header(); ?>

<div class="container">

   	<div id="homecontent">
    
	<?php if (have_posts()) : ?>
    
		<?php $post = $posts[0]; ?>
        
			<?php if (is_category()) { ?>
            
            <h2 class="heading"><?php _e('Archive for the','themnific');?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category','themnific');?></h2>
            
            <?php } elseif( is_tag() ) { ?>
            
            <h2 class="heading"><?php _e('Posts Tagged','themnific');?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>
            
            <?php } elseif (is_day()) { ?>
            
            <h2 class="heading"><?php _e('Archive for','themnific');?> <?php the_time('F jS, Y'); ?></h2>
            
            <?php } elseif (is_month()) { ?>
            
            <h2 class="heading"><?php _e('Archive for','themnific');?> <?php the_time('F, Y'); ?></h2>
            
            <?php } elseif (is_year()) { ?>
            
            <h2 class="heading"><?php _e('Archive for','themnific');?> <?php the_time('Y'); ?></h2>
            
            <?php } elseif (is_author()) { ?>
            
            <h2 class="heading"><?php _e('Author Archive','themnific');?></h2>
            
            <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
            
            <h2 class="heading"><?php _e('Blog Archives','themnific');?></h2>
            
            <?php } ?>

      		<ul class="archivepost">
          
    			<?php while (have_posts()) : the_post(); ?>
                                              		
            		<?php get_template_part('/includes/post-types/archivepost');?>
                    
   				<?php endwhile; ?>   <!-- end post -->
                    
     		</ul><!-- end latest posts section-->
            
            <div style="clear: both;"></div>
            
					<div class="pagination"><?php pagination('&laquo;', '&raquo;'); ?></div>

					<?php else : ?>
			

                        <h1>Sorry, no posts matched your criteria.</h1>
                        <?php get_search_form(); ?><br/>
					<?php endif; ?>

        </div><!-- end #homecontent-->
        
</div>

<?php get_footer(); ?>