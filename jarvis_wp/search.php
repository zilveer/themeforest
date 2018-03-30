<?php get_header(); ?> 

<?php  get_template_part('menu_section');   ?>

  <div class="section post-single"><!-- SECTION -->


        <div class="container"> 
               <div class="row">  
          <div class="sixteen columns">            
                  <!-- START TITLE -->              
            <div class="title">
              <h1 class="header-text"><?php echo __('Results For', 'rocknrolla'); ?><span>"<?php the_search_query(); ?>"</span></h1>

                    </div><!-- END TITLE -->                               
          </div><!-- END SIXTEEN COLUMNS -->  
               </div><!-- END ROW -->         
              </div><!-- END CONTAINER -->       
 



      <div class="container">   
            <div class="row">        
                <div class="twelve columns">                


					<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
						

							
							<?php if( get_post_type($post->ID) == 'post' ){ ?>
								<article class="result-item">
									<span class="result-box">
									<?php if(has_post_thumbnail( $post->ID )) {	
										echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
									} ?>
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Blog Post', 'rocknrolla'); ?></span></h2></span>
								</article><!--/search-result-->	
							<?php }
							
							else if( get_post_type($post->ID) == 'page' ){ ?>
								<article class="result-item">
									<span class="result-box">
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Page', 'rocknrolla'); ?></span></h2></span>	
								
									<?php if(has_excerpt()) the_excerpt(); ?>
								</article><!--/search-result-->	
							<?php }
							
							else if( get_post_type($post->ID) == 'portfolio' ){ ?>
								<article class="result-item">
										<span class="result-box">
									<?php if(has_post_thumbnail( $post->ID )) {	
										echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
									} ?>
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Portfolio Item', 'rocknrolla'); ?></span></h2></span>
								
								</article><!--/search-result-->		
							<?php }
							
							else if( get_post_type($post->ID) == 'product' ){ ?>
								<article class="result">
									<span class="result-box">
									<?php if(has_post_thumbnail( $post->ID )) {	
										echo '<a href="'.get_permalink().'">'. get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
									} ?>
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <span><?php echo __('Product', 'rocknrolla'); ?></span></h2></span>	
								
								</article><!--/search-result-->	
							<?php } else { ?>
								<article class="result">
									<span class="result-box">
									<?php if(has_post_thumbnail( $post->ID )) {	
										echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'full', array('title' => '')).'</a>'; 
									} ?>
									<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2></span>
								</article><!--/search-result-->	
							<?php } ?>
							
						
						
					<?php endwhile; 
					
					else: echo "<p>" . __('No results found', 'rocknrolla') . "</p>";
					
					endif;

                    wp_reset_query();


                    ?>

                </div><!-- END SPAN8 -->
                <?php get_sidebar(); ?>
             </div>   
      </div>	
		

    </div><!--END SECTION -->





<?php get_footer(); ?>