<?php get_header();?>
<?php 
global $theme_shortname;
 ?>
<div id="entry-full">
    <div id="left" class="full-width">
        <div class="post-full single">              
                    <div class="post-content not-found"> 
                        <h2 class="not-found-404"><?php _e('404', 'Bonanza'); ?></h2>
    					<span class="not-found-404"><?php _e('Sorry, this page was not found. Try searching.', 'Bonanza'); ?></span>
						<?php get_search_form(); ?>
                    </div>  <!--  end .post-content  -->          
         </div> <!--  end .post  -->
    </div> <!--  end #left  -->

</div> <!--  end #entry-full  -->
<?php get_footer(); ?>
