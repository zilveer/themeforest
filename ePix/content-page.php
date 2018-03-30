<?php
/**
 * The template for displaying Page format
 *
 * @package WordPress
 */ ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>           

        <?php 
		
		if( !is_page() )
		{
			echo '<header class="post-titles '. $columns .'">';
				include(NV_FILES .'/inc/classes/post-title-class.php'); // Style Post Titles
			echo '</header><!-- / .post-titles -->';
		} ?>
         
        <section class="entry">
            <?php 
			global $more;
			$more = 0;
			
			the_content( __('<p class="serif">Read the rest of this page &raquo;</p>') ); ?>
                    
            <?php wp_link_pages(array('before' => '<ul class="paging"><li class="pages">'.__('Pages', 'themeva' ).':</li> ', 'after' => '</ul>','link_before'=> '<li class="pagebutton">',  'next_or_number' => 'number', 'link_after'=> '</li>',)); ?>
            <div class="clear"></div>
        </section><!-- /entry -->  
		
    </article>