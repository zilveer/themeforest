<?php get_header();
#Emulate default settings for page without personal ID
$gt3_theme_pagebuilder = gt3_get_default_pb_settings();
$gt3_current_page_sidebar = $gt3_theme_pagebuilder['settings']['layout-sidebars'];
$compile_search = '';
?>

    <div class="content_wrapper">
        <div class="container">
            <div class="content_block <?php echo esc_attr($gt3_theme_pagebuilder['settings']['layout-sidebars']) ?> row">
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <div class="row">
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                            <div class="contentarea">
                                <?php
                                echo '<div class="row-fluid"><div class="span12 module_cont module_blog" style="margin:0">';

                                global $paged;
                                $foundSomething = false;

                                if ($paged < 1) {
                                    $args = array(
                                        'numberposts' => -1,
                                        'post_type' => 'any',
                                        'meta_query' => array(
                                            array(
                                                'key' => 'pagebuilder',
                                                'value' => get_search_query(),
                                                'compare' => 'LIKE',
                                                'type' => 'CHAR'
                                            )
                                        )
                                    );
                                    $query = new WP_Query($args);
                                    while ($query->have_posts()) : $query->the_post();									
										if(get_the_tags() !== '') {
											$posttags = get_the_tags();
										
										}
										if ($posttags) {
											$post_tags = '';
											$post_tags_compile = '<span class="preview_meta_tags">tags:';
											foreach($posttags as $tag) {
												$post_tags = $post_tags . '<a href="?tag='.$tag->slug.'">'.$tag->name .'</a>'. ', ';
											}
											$post_tags_compile .= ' '.trim($post_tags, ', ').'</span>';
										} else {
											$post_tags_compile = '';
										}

										$compile_search .= '<div class="blog_post_preview preview_type2">
												<div class="preview_content">
													<div class="preview_top_wrapper">
														<h4 class="blogpost_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
														<div class="listing_meta">
															'. __('by', 'theme_localization') .' <a href="'.get_author_posts_url( get_the_author_meta('ID')).'">'.get_the_author_meta('display_name').'</a><span class="middot">&middot;</span>
															<span>'. get_the_time("F d, Y") .'</span><span class="middot">&middot;</span>
															<span><a href="' . get_comments_link() . '">'. get_comments_number(get_the_ID()) .' '. __('comments', 'theme_localization') .'</a></span>
															'.$post_tags_compile.'
														</div>
													</div>';		
										$compile_search .= '<article class="contentarea">
														<a href="'. get_permalink() .'" class="preview_read_more">'. __('Read More', 'theme_localization') .'</a>
													</article>
												</div>
										</div><!--.blog_post_preview -->';
                                        $foundSomething = true;										
                                    endwhile;
									echo $compile_search;
                                    wp_reset_query();
                                }

                                $defaults = array('numberposts' => 10, 'post_type' => 'any', 'post_status' => 'publish', 'post_password' => '', 'suppress_filters' => false, 's' => get_search_query(), 'paged' => $paged);
                                $query = http_build_query($defaults);
                                $posts = get_posts($query);

                                foreach ($posts as $post) {
                                    setup_postdata($post);								
									
										$compile_search .= '<div class="blog_post_preview preview_type2">
												<div class="preview_content">
													<div class="preview_top_wrapper">
														<h4 class="blogpost_title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>
														<div class="listing_meta">
															'. __('by', 'theme_localization') .' <a href="'.get_author_posts_url( get_the_author_meta('ID')).'">'.get_the_author_meta('display_name').'</a><span class="middot">&middot;</span>
															<span>'. get_the_time("F d, Y") .'</span><span class="middot">&middot;</span>
															<span><a href="' . get_comments_link() . '">'. get_comments_number(get_the_ID()) .' '. __('comments', 'theme_localization') .'</a></span>
															'.$post_tags_compile.'
														</div>
													</div>';		
										$compile_search .= '<article class="contentarea">
														<a href="'. get_permalink() .'" class="preview_read_more">'. __('Read More', 'theme_localization') .'</a>
													</article>
												</div>
										</div><!--.blog_post_preview -->';
									$foundSomething = true;
                                }
								echo $compile_search;
                                echo gt3_get_theme_pagination();

                                if ($foundSomething == false) {
                                    ?>
										<h1 class="title"><?php echo __('Not Found!', 'theme_localization'); ?></h1>
                                        <div class="search_form_wrap">
                                            <form name="search_field" method="get" action="<?php echo home_url(); ?>"
                                                  class="search_form" style="margin-top: 14px; margin-bottom: 40px;">
                                                <input type="text" name="s"
                                                       value=""
                                                       placeholder="<?php _e('Search the site...', 'theme_localization'); ?>"
                                                       class="field_search">
                                            </form>
                                        </div>
                                <?php
                                }

                                echo '</div><div class="clear"></div></div>';
                                ?>
                            </div>
                        </div>
                        <?php get_sidebar('left'); ?>
                    </div>
                </div>
                <?php get_sidebar('right'); ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>