<?php get_header(); ?>

    	
<?php 

    $canon_options = get_option('canon_options');
    $canon_options_post = get_option('canon_options_post'); 

    // DEFAULTS
    if (!isset($canon_options_post['use_buddypress_sidebar'])) { $canon_options_post['use_buddypress_sidebar'] = "unchecked"; }

    // SET MAIN CONTENT CLASS
    $main_content_class = "main-content";
    if ($canon_options_post['use_buddypress_sidebar'] == "checked") { 
        $main_content_class .= " three-fourths"; 
        if ($canon_options['sidebars_alignment'] == 'left') { $main_content_class .= " left-main-content"; }
    }

?>


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
                    <div class="<?php echo $main_content_class; ?>">

    	
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

                        if ($canon_options_post['use_buddypress_sidebar'] == "checked") {
                            get_sidebar("buddypress");   
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