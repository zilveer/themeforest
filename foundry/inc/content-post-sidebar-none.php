<div class="col-sm-10 col-sm-offset-1">

    <div class="post-snippet mb64">
    
        <?php 
        	get_template_part('inc/content-format', get_post_format());
        	get_template_part('inc/content','post-title'); 
        	get_template_part('inc/content','post-meta'); 
        ?>
        
        <hr>
        
        <div class="post-content">
        	<?php
        		the_content();
        		wp_link_pages();
        	?>
        </div>
        
        <?php 
            the_tags('',', ','');
            if( get_option('blog_sharing','no') == 'yes') {
                 get_template_part('inc/content','post-sharing');
            }           
        ?>
        
    </div><!--/post-snippet-->
    
    <?php
    	if( comments_open() )
    		comments_template();
    ?>
    
</div><!--/post-content-->