<?php get_header(); ?>
    
<?php $canon_options_post = get_option('canon_options_post'); ?>
    
        <!-- Start Outter Wrapper -->	
        <div class="outter-wrapper feature">
    		<hr/>
        </div>	
        <!-- End Outter Wrapper -->	    	
    	
    	
    	
        <!-- start Outter Wrapper -->  
        <div class="outter-wrapper">    
            <!-- start main-container -->
            <div class="main-container">
                <!-- start main wrapper -->
                <div class="main wrapper clearfix">
                    <!-- start main-content -->

    	
                        <div class="main-content three-fourths">
                            <h1 class="super"><span>404</span></h1>
                            <h1><?php echo $canon_options_post['404_title']; ?></h1>
                            <p class="lead"><?php echo $canon_options_post['404_msg'] ?></p>                       
                            
                                <?php get_search_form(); ?>

                        </div>
                        <!-- Finish Main Content -->
                        
                        <!-- SIDEBAR -->
                        <?php get_sidebar('404'); ?>
                        
                        <!-- Vertical Spacer -->
                        <div class="vertical-spacer"></div>

                </div>
                <!-- end main wrapper -->
            </div>
             <!-- end main-container --> 
        </div>
        <!-- end outter-wrapper -->
    	
        
<?php get_footer(); ?>