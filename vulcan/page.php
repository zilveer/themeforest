<?php get_header();?>
        <!-- BEGIN OF PAGE TITLE -->
        <?php if (have_posts()) : ?>      
        <div id="page-title">
        	<div id="page-title-inner">
                <div class="title">
                <h1><?php the_title();?></h1>
                </div>
                <div class="dot-separator-title"></div>
                <div class="description">
                  <?php global $post;?>
                  <?php $short_desc = get_post_meta($post->ID, '_short_desc', true ); ?>
                  <p><?php echo $short_desc;?></p>
                </div>
                <div class="clear"></div>
            </div>  
            <div class="clear"></div> 	            
        </div>
        <!-- END OF PAGE TITLE --> 
        
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	<div id="content-left">          
                <div class="maincontent">
                <?php while (have_posts()) : the_post();?>
                <?php the_content();?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'vulcan' ), 'after' => '</div>' ) ); ?>  
                <?php endwhile;?>     
                </div>
            </div>
            <?php endif;?>
          <?php get_sidebar();?>             
                  
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
