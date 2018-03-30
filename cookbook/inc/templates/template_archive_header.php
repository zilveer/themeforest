<?php
							
	//VARS
	$canon_options_post = get_option('canon_options_post'); 

	// DETERMINE PAGE TYPE (home, page or category)
	$page_type = mb_get_page_type();

    // SET TITLE STRING
    switch ($page_type) {
        case 'category':
        	$archive_icon_class = "fa-folder-open";
            $archive_title = __('category', 'loc_canon');
            $archive_subject = single_cat_title('', false);
            $archive_title_string = $archive_subject;
            break;
        case 'tag':
        	$archive_icon_class = "fa-tags";
            $archive_title = __('tag', 'loc_canon');
            $archive_subject = single_tag_title('', false);
            $archive_title_string = $archive_subject;
            break;
        case 'search':
        	$archive_icon_class = "fa-search";
            $archive_title = __('search', 'loc_canon');
            $archive_subject = get_search_query();
            $archive_title_string = $archive_subject;
            break;
        case 'author':
        	$archive_icon_class = "fa-user";
            $archive_title = __('Posts by ', 'loc_canon');
            $archive_subject = get_the_author_meta('display_name',$wp_query->post->post_author);
            $archive_title_string = $archive_title . $archive_subject;
            break;
        case 'day':
        	$archive_icon_class = "fa-calendar";
            $archive_title = __('day', 'loc_canon');
            $archive_subject =  get_the_time('d/m/Y');
            $archive_title_string = $archive_title . " : " .$archive_subject;
            break;
        case 'month':
        	$archive_icon_class = "fa-calendar";
            $archive_title = __('month', 'loc_canon');
            $archive_subject = get_the_time('m/Y');
            $archive_title_string = $archive_title . " : " .$archive_subject;
            break;
        case 'year':
        	$archive_icon_class = "fa-calendar";
            $archive_title = __('year', 'loc_canon');
            $archive_subject = get_the_time('Y');
            $archive_title_string = $archive_title . " : " .$archive_subject;
            break;
        case 'tax':
        	$archive_icon_class = "fa-folder-open";
            $archive_title = __('group', 'loc_canon');
            $archive_subject = get_query_var('term');
            $archive_title_string = $archive_subject;
            break;
        default:
        	$archive_icon_class = "fa-folder-open";
            $archive_title = __('browsing', 'loc_canon');
            $archive_subject = __('Unknown', 'loc_canon');
            $archive_title_string = $archive_title . " : " .$archive_subject;
            break;
    }


    $num_posts_found = $wp_query->found_posts;
    $num_posts_found_postfix = ($num_posts_found =="1") ? __("result", "loc_canon") : __("results", "loc_canon");
    // $num_posts_found_string = ($page_type == "search") ? sprintf('<span class="s-results">%s %s</span>', esc_attr($num_posts_found), esc_attr($num_posts_found_postfix) ) : '';
    $num_posts_found_string = sprintf('<span class="s-results">%s %s</span>', esc_attr($num_posts_found), esc_attr($num_posts_found_postfix) );

?>


						<?php 

							if ( ( $page_type != "home" && $page_type != "page" ) && ( $canon_options_post['show_archive_title'] == "checked" || $canon_options_post['show_cat_description'] == "checked" || $canon_options_post['show_archive_author_box'] == "checked" ) ) { 
							?>

								<div class="archive-header">

                                    <!-- ABOUT THE AUTHOR -->
                                    <?php 

                                        if ( $page_type == "author" && $canon_options_post['show_archive_author_box'] == "checked" ) { 

                                            $author_description = get_the_author_meta('description');
                                            $author_description = (!empty($author_description)) ? $author_description : "This author has not supplied a bio yet."

                                            ?>
                                            
                                            <div class="boxy author clearfix">

                                                <h3><?php echo get_the_author_meta('display_name'); ?></h3>
                                                <div class="left stay"><?php echo get_avatar(get_the_author_meta('ID'), 65, '', 'author-avatar'); ?></div>
                                                <p><?php echo wp_kses_post($author_description); ?></p>

                                                <div class="author-social">
                                                        
                                                    <ul class="social-links">
                                                        <?php if ( get_the_author_meta('user_url') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-globe"></em></a></li>', esc_url(get_the_author_meta('user_url')) ); } ?>
                                                        <?php if ( get_the_author_meta('facebook') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-facebook-square"></em></a></li>', esc_url(get_the_author_meta('facebook')) ); } ?>
                                                        <?php if ( get_the_author_meta('twitter') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-twitter-square"></em></a></li>', esc_url(get_the_author_meta('twitter')) ); } ?>
                                                        <?php if ( get_the_author_meta('googleplus') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-google-plus-square"></em></a></li>', esc_url(get_the_author_meta('googleplus')) ); } ?>
                                                        <?php if ( get_the_author_meta('linkedin') ) { printf( '<li><a href="%s" target="_blank"><em class="fa fa-linkedin-square"></em></a></li>', esc_url(get_the_author_meta('linkedin')) ); } ?>
                                                    </ul>
                                                    
                                                </div>

                                            </div>

                                            <?php

                                        } 

                                    ?>
                    

                                    <!-- PAGE TITLE -->
                                    <?php if ($canon_options_post['show_archive_title'] == "checked") { printf('<div class="page-heading"><em class="fa %s"></em> %s %s</div>', esc_attr($archive_icon_class), esc_attr($archive_title_string), wp_kses_post($num_posts_found_string )); } ?>
									
									<!-- CATEGORY DESCRIPTION -->
									<?php if ( $page_type == "category" && $canon_options_post['show_cat_description'] == "checked" ) { printf('<div class="cat-desription">%s</div>', wp_kses_post(category_description()) ); } ?>	
										
								
                                </div>
						
							<?php 
							}

						?>
