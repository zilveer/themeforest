<?php get_header(); ?>

    	
<?php 

    $canon_options_post = get_option('canon_options_post'); 

    // DEFAULTS
    if (!isset($canon_options_post['use_bbpress_sidebar'])) { $canon_options_post['use_bbpress_sidebar'] = "unchecked"; }

    // SET MAIN COLUMN CLASS
    $main_column_class = ($canon_options_post['use_bbpress_sidebar'] == "checked") ? "col-3-4" : "col-1-1";

?>


    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

   	
        <!-- Start Outter Wrapper -->
        <div class="outter-wrapper body-wrapper">       
            <div class="wrapper clearfix">

                <!-- Main Column -->
                <div class="<?php echo esc_attr($main_column_class); ?>">
                
                    <div class="clearfix">

                        <!-- THE TITLE -->  
                        <h1 class="title"><?php the_title(); ?></h1>

                         <!-- THE CONTENT -->
                        <div class="single-content"><?php the_content(); ?></div>
                        
                        <!-- WP_LINK_PAGES -->
                        <?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_canon'))); ?>

                    </div>
            
                
                </div>
                <!-- End Main Column -->    
                
                <!-- SIDEBAR -->
                <?php if ($canon_options_post['use_bbpress_sidebar'] == "checked") { get_sidebar('bbpress'); } ?> 
                

            </div>
        </div>


    	
    <?php endwhile; ?>
    <!-- END LOOP -->
  			

<?php get_footer(); ?>