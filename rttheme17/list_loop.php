<?php
# 
# rt-theme loop
#

global $args;
add_filter('excerpt_more', 'no_excerpt_more'); 

if ($args) query_posts($args);

if ( have_posts() ) : while ( have_posts() ) : the_post(); 
?> 


    <!-- blog box-->
    <div id="post-<?php the_ID(); ?>" <?php post_class('box one box-shadow '); ?>>

	    <!-- blog box-->
	    <div class="box full blog">
	    
			<!-- blog headline-->
			<h5><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"> 
				<?php
					$the_title = search_highlight(trim(get_search_query()), get_the_title());
					echo $the_title;
				?> 
			</a></h5>
			<!-- / blog headline--> 
			
				<?php if(get_the_excerpt()):?>
				<!-- blog text-->
					<?php
					$the_excerpt = apply_filters('the_content',(get_the_excerpt())); 	 
					$the_excerpt = search_highlight(trim(get_search_query()), $the_excerpt);
					echo $the_excerpt;
					?> 
				<!-- /blog text-->
				<?php endif;?>
		
	    	</div>
	 
	<div class="clear"></div>  
	</div>
	
	<div class="space margin-b20"></div> 

	<!-- blog box-->
     
    
<?php endwhile; ?> 

<div class="clear"></div>
		
    <?php
    //get page and post counts
    $page_count=get_page_count();
    
    //show pagination if page count bigger then 1
    if ($page_count['page_count']>1):
    ?>  

    <!-- paging-->
    <div class="paging_wrapper">
	   <ul class="paging">
		  <?php get_pagination(); ?>
	   </ul>
    </div>			
    <!-- / paging-->
    
    <?php endif;?>

<?php wp_reset_query();?>

<?php else: ?>
<p><?php _e( 'Sorry, no posts matched your criteria.', 'rt_theme'); ?></p> 
<?php endif; ?>
