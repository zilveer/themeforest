<?php get_header(); ?>

    	
<?php $canon_options_post = get_option('canon_options_post'); ?>


    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

   	
        <!-- Start Outter Wrapper -->   
        <div class="outter-wrapper feature">
            <hr>
        </div>
        <!-- End Outter Wrapper --> 
    	
    	
        <!-- start outter-wrapper -->   
        <div class="outter-wrapper">
            <!-- start main-container -->
            <div class="main-container">
                <!-- start main wrapper -->
                <div class="main wrapper clearfix">
                    <!-- start main-content -->
                    <div class="main-content<?php if ($canon_options_post['use_bbpress_sidebar'] == "checked") { echo " three-fourths"; } ?>">

    	
	                	<div class="clearfix">

                            <!-- THE TITLE -->  
                            <h1><?php the_title(); ?></h1>
	                        
                             <!-- THE CONTENT -->
                            <?php the_content(); ?>
                            
                            <!-- WP_LINK_PAGES -->
                            <?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_canon'))); ?>
	                                                                                               
	                	</div>  

                    </div>
                    <!-- end main-content -->
    					
                    <!-- SIDEBAR -->
                    <?php 

                        if ($canon_options_post['use_bbpress_sidebar'] == "checked") {
                            get_sidebar("bbpress");   
                        }

                    ?>
    					
                </div>
                <!-- end main wrapper -->
            </div>
             <!-- end main-container -->
        </div>
        <!-- end outter-wrapper -->

    	
    <?php endwhile; ?>
    <!-- END LOOP -->
  			


<?php get_footer(); ?>