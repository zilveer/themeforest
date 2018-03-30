<?php get_header(); ?>

<div class="container">

   	<div id="homecontent">
    
    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>
    
	<?php if (have_posts()) : ?>
    

        
		<?php get_template_part('/includes/mag-ticker-random');?> 
        

			<div class="authorarchive">
            
        		<h2 class="heading"><?php _e('Author: ','themnific');?> <?php echo $curauth->nickname; ?></h2>
                 
                <?php echo get_avatar($curauth->user_email, 80 ); ?>
                
                <p style=" margin:0 0 5px 0;"><?php _e('Website: ','themnific');?><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></p>
                
                <p><?php _e('Bio: ','themnific');?><?php echo $curauth->user_description; ?></p>
                
            </div>
            
            <div style="clear: both;"></div>

			<h2 class="heading"><?php _e('Author Posts','themnific');?>: </h2>

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