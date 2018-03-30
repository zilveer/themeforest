<?php get_header(); ?>

<?php 

    //GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

    //GET CMB DATA
    $cmb_single_style = "compact";
	$cmb_title = get_post_meta($post->ID, 'cmb_title', true);
	$cmb_info = get_post_meta($post->ID, 'cmb_info', true);
	$cmb_show_social_links = get_post_meta($post->ID, 'cmb_show_social_links', true);
	$cmb_social_links = get_post_meta($post->ID, 'cmb_social_links', true);

?>

    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

        <!-- Start Outter Wrapper -->   
        <div class="outter-wrapper feature">
            <hr/>
        </div>  
        <!-- End Outter Wrapper --> 
 

        <!-- start outter-wrapper -->   
        <div class="outter-wrapper">
            <!-- start main-container -->
            <div class="main-container">
                <!-- start main wrapper -->
                <div class="main wrapper clearfix">
                    <!-- start main-content -->
                    <div class="main-content">

                        <!-- Start Post --> 
                        <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                            
                            <!-- META -->
                            <aside class="left-aside left fifth">
                                <ul class="meta">
                               		<?php if ($canon_options_post['show_person_position'] == "checked") { if (!empty($cmb_title)) { printf('<li><h3>%s</h3></li>', esc_attr($cmb_title)); } } ?>
                               		<?php if ($canon_options_post['show_person_info'] == "checked") { if (!empty($cmb_info)) { printf('<li class="person-info">%s</li>', $cmb_info); } } ?>
								</ul>	
                                    <?php 

                                        if ($cmb_show_social_links == "checked") {

                                            echo '<ul class="social-link">';

                                            for ($n = 0; $n < count($cmb_social_links); $n++) { 
                                            ?>
                                                <li><a href="<?php echo $cmb_social_links[$n]['link']; ?>" target="_blank"><em class="fa <?php echo $cmb_social_links[$n]['icon']; ?>"></em></a></li>
                                            <?php
                                            }

                                            echo '</ul>';
                                                
                                        }

                                    ?>

                                	
                            </aside> 

                            <div class="four-fifths right last">

                                <!-- TITLE / NAME -->
                                <h1><?php the_title(); ?></h1>

                                <div class="people-content-container clearfix">

                                    <!-- FEATURED IMAGE -->
                                    <?php 

                                        if ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                            $img_post = get_post(get_post_thumbnail_id(get_the_ID()));
                                            printf("<div class='corp-head'><a title='%s' href='%s'><img src='%s' alt='profileimage'></a></div>", esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]));
                                        }
                                    ?>

                                    <!-- THE CONTENT -->
                                    <?php the_content(); ?>
                                    <div class="link-pages"><?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_canon'))); ?></div>

                                </div>

                                <!-- POST PAGINATION -->    
                                <?php if ($canon_options_post['show_person_nav'] == "checked") get_template_part('inc/templates/template_post_pagination'); ?>   

                            </div>

                        </div> 
                        <!-- end post -->                


                    </div>
                    <!-- end main-content -->
                </div>
                <!-- end main wrapper -->
            </div>
             <!-- end main-container -->
        </div>
        <!-- end outter-wrapper -->
    	
    <?php endwhile; ?>
    <!-- END LOOP -->
    	
<?php get_footer(); ?>