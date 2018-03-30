<?php get_header(); ?>
<!--Start Top Section -->

<div class="subsection">
        <div class="pagename">
            <h3 class="alignleft">
               <?php if ($projecttitle = get_option('of_portfolio_title')) { echo $projecttitle; } else { echo 'Projects';} ?>
            </h3>
            <p class="alignleft">
                
            </p>
            <?php if(get_post_meta($post->ID, "tagline_value", $single = true) != "") :
				echo '<p class="alignleft">'.get_post_meta($post->ID, "tagline_value", $single = true).'</p>';
			endif; ?>
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
                     <?php $image_id = get_post_thumbnail_id();  
						  $image_url = wp_get_attachment_image_src($image_id,'full');  
						  $image_url = $image_url[0]; ?>
                                           <?php 
			
			$video_url = get_post_meta(get_the_ID(), 'ag_video_url', true);	
						
			$image1 = get_post_meta(get_the_ID(), 'upload_image', true);
						$postid1 = get_attachment_id_from_src ($image1);
						$image_attributes1 = wp_get_attachment_image_src($postid1, 'full');
						$imageattarray[1] = $image_attributes1[2];
			$image2 = get_post_meta(get_the_ID(), 'upload_image2', true);
						$postid2 = get_attachment_id_from_src ($image2);
						$image_attributes2 = wp_get_attachment_image_src($postid2, 'full');
						$imageattarray[2] = $image_attributes2[2];
			$image3 = get_post_meta(get_the_ID(), 'upload_image3', true);
						$postid3 = get_attachment_id_from_src ($image3);
						$image_attributes3 = wp_get_attachment_image_src($postid3, 'full');
						$imageattarray[3] = $image_attributes3[2];
			$image4 = get_post_meta(get_the_ID(), 'upload_image4', true);
						$postid4 = get_attachment_id_from_src ($image4);
						$image_attributes4 = wp_get_attachment_image_src($postid4, 'full');
						$imageattarray[4] = $image_attributes4[2];
			$image5 = get_post_meta(get_the_ID(), 'upload_image5', true);
						$postid5 = get_attachment_id_from_src ($image5);
						$image_attributes5 = wp_get_attachment_image_src($postid5, 'full');
						$imageattarray[5] = $image_attributes5[2];
			$image6 = get_post_meta(get_the_ID(), 'upload_image6', true);
						$postid6= get_attachment_id_from_src ($image6);
						$image_attributes6 = wp_get_attachment_image_src($postid6, 'full');
						$imageattarray[6] = $image_attributes6[2];


  ?>
 
       <div class="pics">
         <?php if ($pgal = get_option('of_prettyphoto_gallery')) { } else { $pgal = 'prettyPhoto';} ?>
            <?php if($image1 != '') : ?>
            	<div class="videocontainer"><?php if ($video_url != '') { ?><img src="<?php echo $image1; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $video_url; ?>" rel="prettyPhoto" class="video"><span>Play</span></a> <?php } else { ?><img src="<?php echo $image1; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $image1; ?>" rel="<?php echo $pgal;?>" class="lightbox"><span class="tooltip black right"><?php _e('Open in Lightbox', 'framework'); ?></span></a><?php  } ?></div>
            <?php endif; ?>
            
            <?php if($image2 != '') : ?>
            	<div class="videocontainer"><?php if ($video_url != '') { ?><img src="<?php echo $image2; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $video_url; ?>" rel="prettyPhoto" class="video"><span>Play</span></a> <?php } else { ?><img src="<?php echo $image2; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $image2; ?>" rel="<?php echo $pgal;?>" class="lightbox"><span class="tooltip black right"><?php _e('Open in Lightbox', 'framework'); ?></span></a><?php  } ?></div>
            <?php endif; ?>
            
            <?php if($image3 != '') : ?>
            	<div class="videocontainer"><?php if ($video_url != '') { ?><img src="<?php echo $image3; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $video_url; ?>" rel="prettyPhoto" class="video"><span>Play</span></a> <?php } else { ?><img src="<?php echo $image3; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $image3; ?>" rel="<?php echo $pgal;?>" class="lightbox"><span class="tooltip black right"><?php _e('Open in Lightbox', 'framework'); ?></span></a><?php  } ?></div>
            <?php endif; ?>
            
             <?php if($image4 != '') : ?>
             	<div class="videocontainer"><?php if ($video_url != '') { ?><img src="<?php echo $image4; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $video_url; ?>" rel="prettyPhoto" class="video"><span>Play</span></a> <?php } else { ?><img src="<?php echo $image4; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $image4; ?>" rel="<?php echo $pgal;?>" class="lightbox"><span class="tooltip black right"><?php _e('Open in Lightbox', 'framework'); ?></span></a><?php  } ?></div>
            <?php endif; ?>
            
             <?php if($image5 != '') : ?>
             	<div class="videocontainer"><?php if ($video_url != '') { ?><img src="<?php echo $image5; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $video_url; ?>" rel="prettyPhoto" class="video"><span>Play</span></a> <?php } else { ?><img src="<?php echo $image5; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $image5; ?>" rel="<?php echo $pgal;?>" class="lightbox"><span class="tooltip black right"><?php _e('Open in Lightbox', 'framework'); ?></span></a><?php  } ?></div>
            <?php endif; ?>
            
             <?php if($image6 != '') : ?>
             	<div class="videocontainer"><?php if ($video_url != '') { ?><img src="<?php echo $image6; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php $video_url ?>" rel="prettyPhoto" class="video"><span>Play</span></a> <?php } else { ?><img src="<?php echo $image6; ?>" width="500" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/><a href="<?php echo $image6; ?>" rel="<?php echo $pgal;?>" class="lightbox"><span>Play</span></a><?php  } ?></div>
            <?php endif; ?>
                  
      </div>

               
                </div>
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
                                <?php _e('Skills:', 'framework') ?>
                                <br />
                                <span>
                                 <?php echo get_the_term_list( $post->ID, 'skills', '', ', ', '' ); ?>
                                </span></h5>
                        </li>
                        <span class="clear"></span>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
                <?php the_tags('Post Tags | ', ', ', '<br />'); ?>

            <div class="clear"></div>
        </div>
	<?php endwhile; ?>
        <div class="sidebar">
            <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Portfolio Sidebar') ) ?>
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
