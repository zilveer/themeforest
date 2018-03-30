<?php get_header(); ?>
<!--Start Top Section -->

<div class="subsection">
 <div class="pagename">
            <h3 class="alignleft">
                <?php global $post; $categories = get_the_category($post->ID); echo $categories[0]->cat_name; ?>
                <span><?php  echo $categories[0]->category_description ?></span>
            <?php if(get_post_meta($post->ID, "tagline_value", $single = true) != "") :
				echo '<span>'.get_post_meta($post->ID, "tagline_value", $single = true).'</span>';
			endif; ?>
            </h3>
            
            <div class="clear"></div>
        </div>
    <div class="subheading blog">
        <div class="subcontainer">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="blogpost">
                <!--Blog Post Entry-->
                <h2><?php the_title(); ?></h2>
                <!--Blog Post Title-->
                <div class="featuredimage">
                    <?php /* if the post has a WP 2.9+ Thumbnail */
					if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
                     <?php $image_id = get_post_thumbnail_id();  
						  $image_url = wp_get_attachment_image_src($image_id,'full');  
						  $image_url = $image_url[0]; ?>
                    <div class="hover flush"> <a rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php echo $image_url; ?>">
                        <?php the_post_thumbnail('blog'); /* post thumbnail settings configured in functions.php */ ?>
                        </a> </div>
                    <?php endif; ?>
                </div>
                <h5 class="tags"><?php the_tags('Tags | ', ', ', '<br />'); ?></h5>
                <!--Blog Excerpt-->
                <?php the_content(__('Read more...', 'framework')); ?>
                    <?php edit_post_link( __('Edit Post', 'framework'), '<div class="edit-post"><p>[', ']</p></div>' ); ?>
                <!--Read More Text-->
                <div class="blogfooter">
                    <ul>
                        <li class="postdate">
                            <h5>
                                <?php the_time('Y'); ?>
                                <br />
                                <span>
                                <?php the_time('M j'); ?>
                                </span> </h5>
                        </li>
                        <li class="postauthor">
                            <h5>
                                <?php _e('Posted By:', 'framework') ?>
                                <br />
                                <span>
                                <?php the_author_posts_link(); ?>
                                </span> </h5>
                        </li>
                        <li class="postcomments">
                            <h5>
                                <?php _e('Comments:', 'framework') ?>
                                <br />
                                <span>
                                <?php comments_popup_link(__('No Comments', 'framework'), __('1 Comment', 'framework'), __('% Comments', 'framework')); ?>
                                </span> </h5>
                        </li>
                        <li class="postcategory">
                            <h5>
                                <?php _e('Posted in:', 'framework') ?>
                                <br />
                                <span>
                                <?php the_category(', '); ?>
                                </span></h5>
                        </li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
			<div class="clear"></div>
        </div>
     	<?php endwhile; ?>
        <div class="sidebar">
            <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar') ) ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     <?php comments_template('', true);?>
            <?php endwhile; else :?>
            <!-- Else nothing found -->
            <h2><?php _e('Error 404 - Not found.', 'framework'); ?></h2>
            <p><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></p>
            <!--BEGIN .navigation .page-navigation -->
            <?php endif; endif; ?>
            <?php if ( function_exists('pp_has_pagination') ) : ?>
            <?php if (pp_has_pagination()) : ?>
            <ul id="pagination">
                <!-- the previous page -->
                <?php pp_the_pagination(); if (pp_has_previous_page()) : ?>
                <li class="previous"> <a href="<?php pp_the_previous_page_permalink(); ?>" class="prev">&laquo; <?php _e('Previous', 'framework'); ?></a></li>
                <?php else : ?>
                <li class="previous-off">&laquo; <?php _e('Previous', 'framework'); ?></li>
                <?php endif; pp_rewind_pagination(); ?>
                <!-- the page links -->
                <?php while(pp_has_pagination()) : pp_the_pagination(); ?>
                <?php if (pp_is_current_page()) : ?>
                <li class="active">
                    <?php pp_the_page_num(); ?>
                </li>
                <?php else : ?>
                <li><a href="<?php pp_the_page_permalink(); ?>">
                    <?php pp_the_page_num(); ?>
                    </a></li>
                <?php endif; ?>
                <?php endwhile; pp_rewind_pagination(); ?>
                <!-- the next page -->
                <?php pp_the_pagination(); if (pp_has_next_page()) : ?>
                <li class="next"> <a href="<?php pp_the_next_page_permalink(); ?>"><?php _e('Next', 'framework'); ?> &raquo;</a></li>
                <?php else : ?>
                <li class="next-off"><?php _e('Next', 'framework'); ?> &raquo;</span>
                    <?php endif; pp_rewind_pagination(); ?>
            </ul>
            <?php endif; else: paginate_links(); wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %');  endif;?>
</div>
<?php get_footer(); ?>
