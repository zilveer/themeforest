<?php get_header(); ?>

<?php 

    // Code for managing the blog sidebar and other related variables
    $sidebar_location = 'right';
	if ( function_exists( 'ot_get_option' ) ) {
    	$sidebar_location = ot_get_option('uxbarn_to_setting_blog_sidebar');
	}
    
    $content_class ='';
    $sidebar_class = '';
    $content_column_class = ' large-9 ';
    
    global $uxbarn_blog_thumbnail_size;
    $uxbarn_blog_thumbnail_size = 'blog-thumbnail';
    
    if($sidebar_location != '') {
        if($sidebar_location == 'left') {
            
            $content_class =' push-3 ';
            $sidebar_class = ' pull-9 ';
            
        }
        
        $content_class .= ' with-sidebar ';
        
    } else {
        $content_column_class = ' large-12 ';
        $uxbarn_blog_thumbnail_size = 'blog-thumbnail-full-width';
    }
    
?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<!-- Blog Content -->
<div class="grey-bg row">
    <div class="uxb-col <?php echo $content_column_class; ?> columns for-nested <?php echo $content_class; ?>">
        
        <div <?php post_class(); ?> >
        
            <div class="blog-page blog-item single row">
    
                <?php get_template_part('template-blog-thumbnail'); ?>
                
                <div class="uxb-col large-12 columns">
                    
                     <?php get_template_part('template-blog-meta'); ?>
                    
                    <h1 class="blog-title"><?php the_title(); ?></h1>
                    <div id="single-content-wrapper">
                        <?php echo uxbarn_get_final_post_content(); ?>
                    </div>
                    <?php 
                    
                        $post_paging_args = array(
                                                'before' => '<div class="post-paging"><ul><li><strong>' . __('Pages:', 'uxbarn') . ' </strong></li>',
                                                'after' => '</ul></div>',
                                                'link_before' => '<li>',
                                                'link_after' => '</li>',
                                            );
                        
                        wp_link_pages($post_paging_args);
                        
                    ?>
                    
                    <?php
                        
                        $override_with_theme_options = false;
						$show_meta_theme_options = array();
						//echo var_dump(empty($show_meta_theme_options));
						
                        if ( function_exists( 'ot_get_option' ) ) {
	                        	
	                        $override_with_theme_options = ot_get_option('uxbarn_to_setting_override_post_meta_info');
							if ( $override_with_theme_options == '' || $override_with_theme_options == 'false' ) {
								$override_with_theme_options = false;
							} else {
								$override_with_theme_options = true;
							}
	                        
	                        // Meta info settings from Theme Options
	                        $show_meta_theme_options = ot_get_option('uxbarn_to_post_single_post_element_display');
							
						}
						
						
						
                        
                        // Single page's elements
                      	$show_author_box = '';
						$show_tags = '';
						
						if ( $override_with_theme_options ) {
							
							$show_author_box = !empty($show_meta_theme_options) ? (isset($show_meta_theme_options[0]) ? $show_meta_theme_options[0] : '') : '';
							$show_tags = !empty($show_meta_theme_options) ? (isset($show_meta_theme_options[1]) ? $show_meta_theme_options[1] : '') : '';
							
							//echo 'Theme Options: ' . var_dump($override_with_theme_options) . ' ' . var_dump($show_author_box) . ' ' . var_dump($show_tags);
							
						} else {
							
							// Show all info? (New option since the theme v1.7.0)
							$show_all_info = uxbarn_get_array_value( get_post_meta($post->ID, 'uxbarn_post_meta_info_and_elements_display'), 0);
							
							if ( $show_all_info == '' || $show_all_info == 'true' || empty( $show_all_info ) ) {
								
								$show_author_box = 'author';
								$show_tags = 'tags';
								
							} else {
								
								$show_author_box = uxbarn_get_array_value( uxbarn_get_array_value( get_post_meta($post->ID, 'uxbarn_post_single_post_element_display'), 0), 0);
								$show_tags = uxbarn_get_array_value( uxbarn_get_array_value( get_post_meta($post->ID, 'uxbarn_post_single_post_element_display'), 0), 1);
								
							}
		
							//echo 'Meta Box: ' . var_dump($show_all_info) . ' ' . var_dump($show_author_box) . ' ' . var_dump($show_tags);
							
						}
						
                    	
                    ?>
                    
                    <?php if($show_author_box) : ?>
                        
                        <!-- Author Box -->
                        <div id="author-box">
                            <?php echo get_avatar(get_the_author_meta('user_email'), 90, '', get_the_author()); ?>
                            <div id="author-info">
                                <h3>About <?php echo get_the_author(); ?></h3>
                                <p>
                                    <?php echo get_the_author_meta('description'); ?>
                                </p>
                                <ul id="author-social">
                                    <li>&nbsp;</li>
                                    <?php if(get_the_author_meta('twitter') != '') : ?>
                                    <li>
                                        <a href="<?php echo get_the_author_meta('twitter'); ?>"><img src="<?php echo IMAGE_PATH; ?>/social/team/Twitter.png" alt="Twitter" title="Twitter" /></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(get_the_author_meta('facebook') != '') : ?>
                                    <li>
                                        <a href="<?php echo get_the_author_meta('facebook'); ?>"><img src="<?php echo IMAGE_PATH; ?>/social/team/Facebook.png" alt="Facebook" title="Facebook" /></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(get_the_author_meta('google') != '') : ?>
                                    <li>
                                        <a href="<?php echo get_the_author_meta('google'); ?>"><img src="<?php echo IMAGE_PATH; ?>/social/team/Google+.png" alt="Google+" title="Google+" /></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(get_the_author_meta('linkedin') != '') : ?>
                                    <li>
                                        <a href="<?php echo get_the_author_meta('linkedin'); ?>"><img src="<?php echo IMAGE_PATH; ?>/social/team/LinkedIn.png" alt="LinkedIn" title="LinkedIn" /></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(get_the_author_meta('dribbble') != '') : ?>
                                    <li>
                                        <a href="<?php echo get_the_author_meta('dribbble'); ?>"><img src="<?php echo IMAGE_PATH; ?>/social/team/Dribbble.png" alt="Dribbble" title="Dribbble" /></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(get_the_author_meta('forrst') != '') : ?>
                                    <li>
                                        <a href="<?php echo get_the_author_meta('forrst'); ?>"><img src="<?php echo IMAGE_PATH; ?>/social/team/Forrst.png" alt="Forrst" title="Forrst" /></a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(get_the_author_meta('flickr') != '') : ?>
                                    <li>
                                        <a href="<?php echo get_the_author_meta('flickr'); ?>"><img src="<?php echo IMAGE_PATH; ?>/social/team/Flickr.png" alt="Flickr" title="Flickr" /></a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        
                    <?php endif; ?>
                    
                    <?php if($show_tags) : ?>
                        
                        <!-- Tags -->
                        <?php if(get_the_tags($post->ID)) : ?>
                            
                        <div id="tags-wrapper" class="blog-section">
                            <h4 class="blog-section-title">Tags</h4>
                            <?php the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>
                        </div>
                        
                        <?php endif; ?>
                        
                    <?php endif; ?>
                
                    <!-- Comment Section -->
                    <?php comments_template(); ?>
                    
                </div>
                
                
            </div>
            
        </div>
            
    </div>
    
    <?php if($sidebar_location != '') : ?>
        
        <div id="sidebar-wrapper" class="uxb-col large-3 columns for-nested <?php echo $sidebar_class; ?>">
            <?php get_sidebar(); ?>
        </div>
        
    <?php endif; ?>
    
</div>

<?php endwhile; endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>