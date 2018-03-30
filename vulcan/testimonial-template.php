<?php 
/*
Template Name: Testimonial
*/
?>
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
              </div>   	   	            
        </div>
        <!-- END OF PAGE TITLE --> 
        
        <!-- BEGIN OF CONTENT -->
        <div id="content">
        	<div id="content-left">          
                <div class="maincontent">
                <?php 
                query_posts(array( 'post_type' => 'testimonial', 'posts_per_page' => -1,"orderby" => 'date','order'=> 'DESC'));
                while (have_posts()) : the_post();
                ?>
                    <!-- begin of blog post  -->
                    <div class="right-head">
                       <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    </div>
                    <div class="clr"></div>
                    <br />
                    <blockquote><?php the_content();?></blockquote>
                    <div class="clr"></div>
                    <br />
                <?php endwhile;?>     
                <?php wp_reset_query();?>
                </div>
            </div>
            <?php endif;?>
          <?php get_sidebar();?>             
                  
        </div>
        <!-- END OF CONTENT -->
        <?php get_footer();?>
