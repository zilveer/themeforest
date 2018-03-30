<?php get_header(); ?> 

<?php  get_template_part('menu_section');  

if (have_posts()) : while (have_posts()) : the_post();

    global $post;
    
    $post_name = $post->post_name;
    
    $post_id = get_the_ID();
		
?>  


    <div class="section post-single"><!-- SECTION -->


		<div class="container">	
           <div class="row">	
			<div class="sixteen columns">            
	            <!-- START TITLE -->	            
				<div class="title">
				  <h1 class="header-text"><?php if(get_post_meta( get_the_ID(), 'rnr_alt_title', true )){ echo get_post_meta( get_the_ID(), 'rnr_alt_title', true ); } else { the_title(); } ?></h1>
                </div><!-- END TITLE -->  	                           
			</div><!-- END SIXTEEN COLUMNS -->  
           </div><!-- END ROW -->         
          </div><!-- END CONTAINER -->  
  


      <div class="container">   
            <div class="row">        
                <div class="twelve columns">                

                    <?php 

                    if(get_query_var('paged')){
                        $paged = get_query_var('paged');
                    } elseif ( get_query_var('page') ) { 
                        $paged = get_query_var('page');
                    } else {
                        $paged = 1;
                    }

                    $args = array( 
                        'post_type' => 'post',
                        'posts_per_page' => '2',
                        'paged' => $paged 
                    );

                    if(is_page()){
                        query_posts($args);
                    }else{
                        global $wp_query;
                        $query_args = array_merge( $wp_query->query, $args );
                        query_posts($query_args);
                    } 

                    if (have_posts()) : while (have_posts()) : the_post();  

                        get_template_part( 'post-format/single', get_post_format() );  ?>
     
     
             <div class="posts-nav clearfix">
                <div class="right next"><?php next_post_link('%link',  '%title <i class="fa fa-arrow-right"></i>', FALSE); ?> </div>        
                <div class="left prev"><?php previous_post_link('%link',  '<i class="fa fa-arrow-left"></i> %title', FALSE); ?></div>
             </div>            
			
			
			<?php if($smof_data['rnr_blog_socialshare'] == true) { ?>
				<?php get_template_part( 'includes/share' ); ?>
			<?php } ?>
			

			<?php if($smof_data['rnr_blog_authorinfo'] == true) { ?>
			<div id="author-info" class="clearfix">
				    <div class="author-image">
				    	<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_avatar( get_the_author_meta('user_email'), '50', '' ); ?></a>
				    </div>   
				    <div class="author-bio">
				        <h4><?php _e('About the Author', 'rocknrolla'); ?></h4>
				        <?php the_author_meta('description'); ?>
				    </div>
			</div>
			<?php } ?>

			
		
		
		<div class="comments"><?php comments_template(); ?></div>
								

                  <?php  endwhile; 


                     else : ?>

                    <h2><?php _e('No Post Found', 'rocknrolla') ?></h2>

                    <?php

                    endif; 

                    wp_reset_query();

                    ?>

                </div><!-- END SPAN8 -->
                <?php get_sidebar(); ?>
             </div>   
      </div>	
		

    </div><!--END SECTION -->
<?php
  
    endwhile;
    endif; 
	wp_reset_query();
?>




<?php get_footer(); ?>