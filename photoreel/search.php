<?php get_header(); ?>

<div class="container">

   	<div id="homecontent">

			<h2 class="heading"><?php _e('Search Results for','themnific');?> "<?php echo $s; ?>"</h2>

		<?php if (have_posts()) : ?>

      		<ul class="archivepost">
          
    			<?php while (have_posts()) : the_post(); ?>
                                              		
            		<?php get_template_part('/includes/post-types/archivepost');?>
                    
   				<?php endwhile; ?>   <!-- end post -->
                    
     		</ul><!-- end latest posts section-->
            
            <div style="clear: both;"></div>
            
					<div class="pagination"><?php pagination('&laquo;', '&raquo;'); ?></div>

					<?php else : ?>
                    
						<!-- Not Found Handling -->
                        
                        <div class="hrlineB"><span></span></div>
                        
                        <h3 class="heading"><?php _e('Sorry, no posts matched your criteria.','themnific');?></h3>
                        
           				<h4><?php _e('Perhaps You will find something interesting form these lists...','themnific');?></h4>
                        
            			<div class="hrline"></div>
                        
						<?php get_template_part('/includes/uni-404-content');?>
                        
                        
					<?php endif; ?>

        </div><!-- end #homecontent-->
        
</div>

<?php get_footer(); ?>