<?php 

    //GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

    //GET CMB DATA
    $cmb_single_style = "multi";
    $cmb_feature = get_post_meta( $post->ID, 'cmb_feature', true);
    $cmb_media_link = get_post_meta( $post->ID, 'cmb_media_link', true);
    $cmb_hide_feat_img = get_post_meta( $post->ID, 'cmb_hide_feat_img', true);
    $cmb_multi_intro = get_post_meta( $post->ID, 'cmb_multi_intro', true);

?>

    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>


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

                            <!-- TITLE -->
                            <h1 class="four-fifths right last"><?php the_title(); ?></h1>

                            
                            <!-- META -->
                            <aside class="left-aside left fifth">
                                <ul class="meta">
                                    <?php if (isset($canon_options_post['show_meta_author'])) { if ($canon_options_post['show_meta_author'] == "checked") { ?> <li><?php the_author_posts_link(); ?></li> <?php } } ?>
                                    <?php if (isset($canon_options_post['show_meta_date'])) { if ($canon_options_post['show_meta_date'] == "checked") { ?><li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li> <?php } } ?>
                                    <?php if (isset($canon_options_post['show_meta_comments'])) { if ($canon_options_post['show_meta_comments'] == "checked") { ?> <li><a href="#comments" class="comment"><?php comments_number(__("No comments", "loc_canon"), __("1 comment", "loc_canon"), "% " . __("comments", "loc_canon")); ?></a></li> <?php } } ?>
                                    <?php if (isset($canon_options_post['show_tags'])) { if ($canon_options_post['show_tags'] == "checked") { ?> <li><?php the_tags("",", "); ?></li> <?php } } ?>
                                    	
                                </ul>	
                            </aside> 

                            <!-- INTRO -->
                            <?php 
                                if (!empty($cmb_multi_intro)) { 
                                    echo "<p class='four-fifths right last lead'>";
                                    echo $cmb_multi_intro; 
                                    echo "</p>";
                                }

                            ?>

                            <div class="four-fifths right last">



                                <!-- THE CONTENT -->
                                <div id="content_container">

                                    <div class="multi_nav_control">
                                        <?php

                                            global $page, $pages;

                                            wp_link_pages(array(
                                                'before'            => '<div class="link-multipages">', 
                                                'after'             => '', 
                                                'previouspagelink'  => '<i class="fa fa-chevron-left  multipost_nav_back"></i>', 
                                                'nextpagelink'      => '', 
                                                'next_or_number'    => 'next', 
                                            )); 

                                            echo "<span class='multi_pagenumber'>";
                                            echo( $page.' of '.count($pages) );
                                            echo "</span>";

                                            wp_link_pages(array( 
                                                'before'            => '', 
                                                'after'             => '</div>', 
                                                'previouspagelink'  => '', 
                                                'nextpagelink'      => '<i class="fa  fa-chevron-right  multipost_nav_forward"></i>', 
                                                'next_or_number'    => 'next', 
                                            )); 

                                        ?> 

                                        <span class="multi_navigation_hint">(<?php _e("or use arrow keys to", "loc_canon"); ?> <i class="icon-arrow-left"></i> <?php _e("navigate", "loc_canon"); ?> <i class="icon-arrow-right"></i>)</span>
                                    </div>

                                    <div class="multi_content">

                                        <?php the_content(); ?>
                                        
                                    </div>


                                </div>

                                <hr/>

                                <!-- COMMENTS --> 
                                  
                                <div class="coms"> 
                                	<?php if ($canon_options_post['show_comments'] == "checked") comments_template( '', true ); ?>
								</div>
                            </div>

                        </div>                  


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
