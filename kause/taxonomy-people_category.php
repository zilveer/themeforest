<?php get_header(); ?>
    
    
    <?php 

        //GET OPTIONS
        $canon_options_post = get_option('canon_options_post'); 

        $archive_title = __('group', 'loc_canon');
        $archive_subject = get_query_var('term');

        $excerpt_length = 660;

    ?>


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
                    <div class="main-content three-fourths">

                        <!-- RESULTS SUMMARY -->
                        <h3><?php echo $wp_query->found_posts; ?> <?php if (count($wp_query->posts) !== 1) {_e('results','loc_canon');} else {_e('result','loc_canon');} ?> <?php _e("for", "loc_canon"); ?> <span><?php printf("%s: %s", esc_attr($archive_title), esc_attr($archive_subject)); ?></span></h3>

                        <hr/>

                        <!-- MAIN LOOP -->
                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php 
                                $cmb_excerpt = get_post_meta(get_the_ID(), 'cmb_excerpt', true); 
                                $the_excerpt = (!empty($cmb_excerpt)) ? $cmb_excerpt :  mb_make_excerpt(get_the_content(), $excerpt_length, true);
                                $the_excerpt = mb_tag_search_string($the_excerpt, $archive_subject, "<span class='highlight'>","</span>", false);

                                $cmb_title = get_post_meta(get_the_ID(), 'cmb_title', true);
                                $cmb_tagline = get_post_meta(get_the_ID(), 'cmb_tagline', true);
                                $cmb_show_social_links = get_post_meta(get_the_ID(), 'cmb_show_social_links', true);
                                $cmb_social_links = get_post_meta(get_the_ID(), 'cmb_social_links', true);

                            ?>

                            <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                                <!-- THE TITLE -->
                                <h1 class="four-fifths right last"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                                <!-- META -->
                                <aside class="left-aside left fifth">
                                    <ul class="meta">

                                        <?php if ($canon_options_post['show_person_position'] == "checked") { if (!empty($cmb_title)) { printf('<li>%s</li>', esc_attr($cmb_title)); } } ?>
                                        <?php if ($canon_options_post['show_person_tagline'] == "checked") { if (!empty($cmb_tagline)) { printf('<li class="meta_tagline">%s</li>', esc_attr($cmb_tagline)); } } ?>
                                        
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

                                    </ul> 
                                </aside> 

                                <!-- EXTRACT -->
                                <div class="four-fifths right last">
                                    
                                    <?php echo do_shortcode($the_excerpt); ?>

                                    <!-- read more -->
                                    <p><a href="<?php the_permalink(); ?>" class="btn"><?php _e('Read More', 'loc_canon'); ?></a></p>

                                </div>

                             </div>
                             
                             <hr/>
                    	 
                        <?php endwhile; ?>
                        <!-- END LOOP -->

                        <!-- PAGINATION -->
                        <?php get_template_part("inc/templates/template_paginate_links"); ?>
        	                                                                                               
                    </div>
                    <!-- end main-content -->

        					
                    <!-- SIDEBAR -->
                    <?php get_sidebar('search'); ?>

        					
                </div>
                <!-- end main wrapper -->
            </div>
             <!-- end main-container -->
        </div>
        <!-- end outter-wrapper -->


<?php get_footer(); ?>