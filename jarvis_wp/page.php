<?php get_header(); ?> 

<?php
   get_template_part('menu_section'); 
if (have_posts()) : while (have_posts()) : the_post();

    global $post;
    
    $post_name = $post->post_name;
    
    $post_id = get_the_ID();
		
?>  

    <div id="<?php echo $post_name; ?>" class="page<?php echo $post_id; ?> section<?php if((get_post_meta($post_id, "rnr_assign_home") == true) ){ echo ' fullscreen home';} else { echo ' '.$post_name; }?>"><!-- SECTION -->


    <?php if((get_post_meta( get_the_ID(), 'rnr_disable_title', true )!= true) && (get_post_meta($post_id, 'rnr_assign_home', true)!= true) ){ ?>    
		<div class="container">	
           <div class="row">	
			<div class="sixteen columns">            
	            <!-- START TITLE -->	            
				<div class="title">
				  <h1 class="header-text"><?php if(get_post_meta( get_the_ID(), 'rnr_alt_title', true )){ echo get_post_meta( get_the_ID(), 'rnr_alt_title', true ); } else { the_title(); } ?></h1>
                   <?php if(get_post_meta( get_the_ID(), 'rnr_subtitle', true )){ ?>
                  <div class="subtitle">
                      <p><?php echo get_post_meta( get_the_ID(), 'rnr_subtitle', true );  ?></p>
                  </div><!-- END SUBTITLE -->
                  <?php } ?>
                </div><!-- END TITLE -->  	                           
			</div><!-- END SIXTEEN COLUMNS -->  
           </div><!-- END ROW -->         
          </div><!-- END CONTAINER -->       
  <?php } ?>   


      <div class="container">           
           <?php the_content(); ?>
           <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
           <?php comments_template(); ?>  
      </div>	  

				

    </div><!--END SECTION -->
<?php
  
    endwhile;
    endif; 
	wp_reset_query();
?>




<?php get_footer(); ?>
