<?php get_header(); ?>
    	
<?php $canon_options_post = get_option('canon_options_post'); ?>

        <!-- start outter-wrapper -->   
        <div class="outter-wrapper">
            <!-- start main-container -->
            <div class="main-container">
                <!-- start main wrapper -->
                <div class="main wrapper clearfix">
                    <!-- start main-content -->
                    <div class="main-content<?php if ($canon_options_post['use_woocommerce_sidebar'] == "checked") { echo ' three-fourths'; }  ?>">

    	
	                	<div class="clearfix">

                            <?php woocommerce_content(); ?> 
	                                                                                               
	                	</div>  

                    </div>
                    <!-- end main-content -->
    					
                    <!-- SIDEBAR -->
                    <?php if ($canon_options_post['use_woocommerce_sidebar'] == "checked") { get_sidebar('woocommerce'); } ?> 
                    					
                </div>
                <!-- end main wrapper -->
            </div>
             <!-- end main-container -->
        </div>
        <!-- end outter-wrapper -->

<?php get_footer(); ?>