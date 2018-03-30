<?php get_header(); ?>
    
    
    <?php 
    
        //VARS
        $canon_options_post = get_option('canon_options_post'); 

        $page_type = mb_get_page_type();

        //var_dump($wp_query);
        // var_dump(mb_get_page_type());

        switch ($page_type) {
            case 'category':
                $archive_title = __('category', 'loc_canon');
                $archive_subject = single_cat_title('', false);
                break;
            case 'tag':
                $archive_title = __('tag', 'loc_canon');
                $archive_subject = single_tag_title('', false);
                break;
            case 'search':
                global $query_string;
                $archive_title = __('search', 'loc_canon');
                $archive_subject = get_search_query();
                break;
            case 'author':
                $archive_title = __('author', 'loc_canon');
                $archive_subject = get_the_author_meta('display_name',$wp_query->post->post_author);
                break;
            case 'day':
                $archive_title = __('day', 'loc_canon');
                $archive_subject =  get_the_time('d/m/Y');
                break;
            case 'month':
                $archive_title = __('month', 'loc_canon');
                $archive_subject = get_the_time('m/Y');
                break;
            case 'year':
                $archive_title = __('year', 'loc_canon');
                $archive_subject = get_the_time('Y');
                break;
            case 'tax':
                $archive_title = __('group', 'loc_canon');
                $archive_subject = get_query_var('term');
                break;
            default:
                $archive_title = __('browsing', 'loc_canon');
                $archive_subject = __('Unknown', 'loc_canon');
                break;
        }

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
                            ?>

                            <div id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                                <!-- THE TITLE -->
                                <h1 class="four-fifths right last"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                                <!-- META -->
                                <aside class="left-aside left fifth">
                                    <ul class="meta">


                                        <?php if (isset($canon_options_post['show_meta_author'])) { if ($canon_options_post['show_meta_author'] == "checked") { ?> <li><?php the_author_posts_link(); ?></li> <?php } } ?>
                                        <?php if (isset($canon_options_post['show_meta_date'])) { if ($canon_options_post['show_meta_date'] == "checked") { ?><li><?php echo mb_localize_datetime(get_the_time(get_option('date_format'))); ?></li> <?php } } ?>
                                        <?php if (isset($canon_options_post['show_meta_comments'])) { if ($canon_options_post['show_meta_comments'] == "checked") { ?> <li><a href="<?php the_permalink(); ?>#comments" class="comment"><?php comments_number(__("No comments", "loc_canon"), __("1 comment", "loc_canon"), "% " . __("comments", "loc_canon")); ?></a></li> <?php } } ?>
                                        <?php if (isset($canon_options_post['show_tags'])) { if ($canon_options_post['show_tags'] == "checked") { ?> <li><?php the_tags("",", "); ?></li> <?php } } ?>

                                    </ul> 
                                </aside> 

                                <!-- EXTRACT -->
                                <div class="four-fifths right last">
                                    <?php echo do_shortcode($the_excerpt); ?>
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