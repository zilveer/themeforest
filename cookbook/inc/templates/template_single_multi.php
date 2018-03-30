<?php 

	// GET OPTIONS
	$canon_options_post = get_option('canon_options_post'); 

	//GET CMB DATA
	$cmb_single_style = get_post_meta( $post->ID, 'cmb_single_style', true);
    $cmb_multi_intro = get_post_meta( $post->ID, 'cmb_multi_intro', true);
    $cmb_post_show_info = get_post_meta($post->ID, 'cmb_post_show_info', true);
	$cmb_post_show_ratings = get_post_meta( $post->ID, 'cmb_post_show_ratings', true);
	$cmb_post_ratings_overall_score = get_post_meta($post->ID, 'cmb_post_ratings_overall_score', true);
	$cmb_post_show_author = get_post_meta( $post->ID, 'cmb_post_show_author', true);
	$cmb_post_show_related = get_post_meta( $post->ID, 'cmb_post_show_related', true);
	$cmb_post_show_tags = get_post_meta( $post->ID, 'cmb_post_show_tags', true);

	// DEFAULTS
	if (empty($cmb_single_style)) { $cmb_single_style = "multi_sidebar"; };
	if (empty($cmb_post_show_tags)) { $cmb_post_show_tags = "checked"; }


?>

	<!-- BEGIN LOOP -->
	<?php while ( have_posts() ) : the_post(); ?>

    	<!-- Start Outter Wrapper -->
    	<div class="outter-wrapper body-wrapper">		
    		<div class="wrapper clearfix">
    			
    			<!-- Main Column -->
    			<div class="<?php if ($cmb_single_style == 'multi') { echo "col-1-1"; } else { echo "col-3-4"; } ?>">

                    <!-- POST -->
                    <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                        <!-- META, TITLE AND INTRO-->
                        <?php 

                            if ($canon_options_post['show_post_meta'] == 'checked') {

                                // CATEGORIES
                                $cat_string = mb_get_cat_string(get_the_ID(), " | ");

                                // DATE
                                $archive_year  = get_the_time('Y'); 
                                $archive_month = get_the_time('m'); 
                                $archive_day   = get_the_time('d');                             

                                ?>
                                <div class="clearfix multi-meta">

                                    <h6 class="meta right"><a class="date" href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></a></h6>
                                    <h6 class="feat-1 meta"><?php echo wp_kses_post($cat_string); ?></h6>

                                    <!-- TITLE -->
                                    <h1 class="title"><?php the_title(); ?></h1>

                                    <!-- INTRO -->
                                    <?php 
                                        if (!empty($cmb_multi_intro)) { 
                                            echo "<p class='multi-intro lead'>";
                                            echo wp_kses_post($cmb_multi_intro); 
                                            echo "</p>";
                                        }

                                    ?>

                                </div>  


                                <?php   
                            }

                        ?>

                        <!-- THE CONTENT -->
                        <div id="content_container">

                            <div class="multi_nav_control clearfix">
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

                            <div class="multi_content clearfix">

                                <?php the_content(); ?>
                                
                            </div>

                        </div>

                    </div>
    				
                    <!-- INFO BOX -->
                    <?php if ($cmb_post_show_info == "checked") { get_template_part('/inc/templates/components/template_post_component_info'); } ?>
                    
 					<!-- RATINGS -->
					<?php if ($cmb_post_show_ratings == "checked") { get_template_part('/inc/templates/components/template_post_component_ratings'); } ?>
    				
					<!-- TAGS -->
					<?php if ($cmb_post_show_tags == "checked") { get_template_part('/inc/templates/components/template_post_component_tags'); } ?>
   				
                    <!-- POST PAGINATION -->    
                    <?php if ($canon_options_post['show_post_nav'] == "checked") get_template_part('inc/templates/components/template_post_pagination'); ?>

					<!-- ABOUT THE AUTHOR -->
					<?php if ($cmb_post_show_author == "checked") { get_template_part('/inc/templates/components/template_post_component_author'); } ?>

                    <!-- RELATED POSTS -->
					<?php if ($cmb_post_show_related == "checked") { get_template_part('/inc/templates/components/template_post_component_related'); } ?>
    				
    				
					<!-- COMMENTS -->
                    <div class="comments-container"> 
                    	<?php if ($canon_options_post['show_comments'] == "checked") { comments_template( '', true ); } ?>
					</div>
    				
    			
    			</div>
    			<!-- End Main Column -->	
    			
    			
				<!-- SIDEBAR -->
				<?php if ($cmb_single_style == 'multi_sidebar') { get_sidebar(); } ?>

    			
    		</div>
    		<!-- end wrapper -->
    	</div>
    	<!-- end outter-wrapper -->

		
	<?php endwhile; ?>
	<!-- END LOOP -->
