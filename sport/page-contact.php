<?php /* Template Name: Contact */ ?>

<?php get_header(); ?>

<?php 

    $canon_options = get_option('canon_options');

    $cmb_pages_contact = get_post_meta($post->ID, 'cmb_pages_contact', true);

    // SET MAIN CONTENT CLASS
    $main_content_class = "main-content three-fourths";
    if ($canon_options['sidebars_alignment'] == 'left') { $main_content_class .= " left-main-content"; }

?>
    	

    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

   	
        <?php 
            // EMBED CODE, FEATURED IMAGE OR HR

            if ( ($cmb_pages_contact['use_embeddable_media'] == "checked") && (!empty($cmb_pages_contact['embed_code'])) ) {
                $feature_class = ($cmb_pages_contact['grayscale'] == "checked") ? "outter-wrapper feature map" : "outter-wrapper feature";
                echo '<div class="' . $feature_class . '">';
                echo '<div class="embed-scroll-protect">';
                echo $cmb_pages_contact['embed_code'];
                echo '</div>';
               echo '</div>';
                    
            } elseif (has_post_thumbnail(get_the_ID())) {
            ?>

                <div class="outter-wrapper feature">
                    <?php the_post_thumbnail(); ?>
                </div>

            <?php
            } else {
            ?>
                <!-- Start Outter Wrapper -->   
                <div class="outter-wrapper feature">
                    <hr/>
                </div>  
                <!-- End Outter Wrapper --> 
                       
            <?php       
            }

        ?>

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
                    <?php  get_sidebar("contact"); ?>

                </div>
                <!-- end main wrapper -->
            </div>
             <!-- end main-container -->
        </div>
        <!-- end outter-wrapper -->

    	
    <?php endwhile; ?>
    <!-- END LOOP -->
  			


<?php get_footer(); ?>