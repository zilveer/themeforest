<?php get_header(); ?>

<div id="preloader"></div>

<div id="container">

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<?php  // Grab the global ProperPagination and WP_Query instances
		global $pp, $wp_query, $wp;
			
		if (!($projectposts = get_option('of_project_posts'))) { $projectposts = 3;}
		$counter = 1;
		wp_reset_query();
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		// Construct the custom WP_Query instance
		$loop = new WP_Query( array( 'post_type' => 'portfolio', 'paged' => $paged, 'posts_per_page' => $projectposts, 'skills'=>$term->slug ) );

	if ( function_exists('pp_has_pagination') ) : 
	
		// Override the number of found posts on the ProperPagination instance
		$pp->found_posts = (int)$loop->found_posts;
		$pp->max_pages = ceil($pp->found_posts / $projectposts);
       
		   if ($counter == 1) {     
				// How many page links do we display at one time?
				$pp->max_page_links = min((int)get_option('pp_max_pagelinks'), $pp->max_pages);
				
				// Derive start and end values for the pagination links
				if ($pp->max_pages <= $pp->max_page_links) {
					// Start at the very beginning, end at the very end
					$pp->start = 1;
					$pp->end = $pp->max_pages;
				} else {
					$pp->start = max(1, $pp->page - floor($pp->max_page_links / 2));
					$pp->end = min($pp->max_pages, $pp->start + $pp->max_page_links - 1);
				}
			$counter++;	
		   }
	endif;

// Loop through your posts...
while ( $loop->have_posts() ) : $loop->the_post();   ?>

                    <?php $image_id = get_post_thumbnail_id();  
						  $image_url = wp_get_attachment_image_src($image_id,'large');  
						  $image_url = $image_url[0]; ?>
                            <?php 
			
			$video_url = get_post_meta(get_the_ID(), 'ag_video_url', true);	
						
			$image1 = get_post_meta(get_the_ID(), 'upload_image', true);
						$postid1 = get_attachment_id( $image1 );
						$image_attributes1 = wp_get_attachment_image_src($postid1, 'full');
						if ($image_attributes1[1] > 500 ) { //if width is more than 500
								$subtraction1 = 500 / $image_attributes1[1]; //find out how much more the width is than 500
							} else { 
								$subtraction1 = 1;
							}  
						$imageattarray[1] = $image_attributes1[2] * $subtraction1;
			$image2 = get_post_meta(get_the_ID(), 'upload_image2', true);
						$postid2 = get_attachment_id($image2);
						$image_attributes2 = wp_get_attachment_image_src($postid2, 'full');
						if ($image_attributes2[1] > 500 ) { //if width is more than 500
								$subtraction2 = 500 / $image_attributes2[1]; //find out how much more the width is than 500
							} else { 
								$subtraction2 = 1;
							}  
						$imageattarray[2] = $image_attributes2[2] * $subtraction2;
			$image3 = get_post_meta(get_the_ID(), 'upload_image3', true);
						$postid3 = get_attachment_id($image3);
						$image_attributes3 = wp_get_attachment_image_src($postid3, 'full');
						if ($image_attributes3[1] > 500 ) { //if width is more than 500
								$subtraction3 = 500 / $image_attributes3[1]; //find out how much more the width is than 500
							} else { 
								$subtraction3 = 1;
							}  
						$imageattarray[3] = $image_attributes3[2] * $subtraction3;
			$image4 = get_post_meta(get_the_ID(), 'upload_image4', true);
						$postid4 = get_attachment_id($image4);
						$image_attributes4 = wp_get_attachment_image_src($postid4, 'full');
						if ($image_attributes4[1] > 500 ) { //if width is more than 500
								$subtraction4 = 500 / $image_attributes4[1]; //find out how much more the width is than 500
							} else { 
								$subtraction4 = 1;
							}  
						$imageattarray[4] = $image_attributes4[2] * $subtraction4;
			$image5 = get_post_meta(get_the_ID(), 'upload_image5', true);
						$postid5 = get_attachment_id($image5);
						$image_attributes5 = wp_get_attachment_image_src($postid5, 'full');
						if ($image_attributes5[1] > 500 ) { //if width is more than 500
								$subtraction5 = 500 / $image_attributes5[1]; //find out how much more the width is than 500
							} else { 
								$subtraction5 = 1;
							}  
						$imageattarray[5] = $image_attributes5[2] * $subtraction5;
			$image6 = get_post_meta(get_the_ID(), 'upload_image6', true);
						$postid6= get_attachment_id($image6);
						$image_attributes6 = wp_get_attachment_image_src($postid6, 'full');
							if ($image_attributes6[1] > 500 ) { //if width is more than 500
								$subtraction6 = 500 / $image_attributes6[1]; //find out how much more the width is than 500
							} else { 
								$subtraction6 = 1;
							}  
						$imageattarray[6] = $image_attributes6[2] * $subtraction6;
		
		global $theheight;
		$theheight = max($imageattarray); //get the image with the maxiumum height  ?>
 

    <div class="item" id="itemdiva<?php echo $counter; ?>">
        <div class="postcontainer">
            <div class="postphoto"onload="$(this).fadeIn();"><a class="thumb" href="#" onclick="javascript:changer('a<?php echo $counter; ?>','#itemdiva<?php echo $counter; ?>', '<?php echo $theheight; ?>'); return false;" title="<?php the_title(); ?>">
                       <span class="portfoliopreload">  <?php the_post_thumbnail('portfoliosmall', array('id' => 'a'.$counter)); ?> </span>
                        </a>  </div>
        </div>
        <div id="arrowa<?php echo $counter;?>" style="display:none;" class="posttext">
        
            <div class="pics">
     
            <?php if($image1 != '') : ?>
            		<div style="height:<?php echo $imageattarray[1]; ?>px"><div class="videocontainer"><img src="<?php echo $image1; ?>" alt="<?php the_title(); ?>" width="500" height="<?php echo $imageattarray[1]; ?>" title="<?php the_title(); ?>" class="largeport"/><?php if ($video_url != '') { echo '<a href="'.$video_url.'" rel="prettyPhoto" class="video"></a>'; } ?></div></div>
            <?php endif; ?>
            
            <?php if($image2 != '') : ?>
            		<div style="height:<?php echo $imageattarray[2]; ?>px"><div class="videocontainer"><img src="<?php echo $image2; ?>" alt="<?php the_title(); ?>" width="500" height="<?php echo $imageattarray[2]; ?>" title="<?php the_title(); ?>" class="largeport"/><?php if ($video_url != '') { echo '<a href="'.$video_url.'" rel="prettyPhoto" class="video"><span>Play</span></a>'; } ?></div></div>
            <?php endif; ?>
            
            <?php if($image3 != '') : ?>
            		<div style="height:<?php echo $imageattarray[3]; ?>px"><div class="videocontainer"><img src="<?php echo $image3; ?>" alt="<?php the_title(); ?>" width="500" height="<?php echo $imageattarray[3]; ?>" title="<?php the_title(); ?>" class="largeport"/><?php if ($video_url != '') { echo '<a href="'.$video_url.'" rel="prettyPhoto" class="video"></a>'; } ?></div></div>
            <?php endif; ?>
            
             <?php if($image4 != '') : ?>
             	<div style="height:<?php echo $imageattarray[4]; ?>px"><div class="videocontainer"><img src="<?php echo $image4; ?>" alt="<?php the_title(); ?>" width="500" height="<?php echo $imageattarray[4]; ?>" title="<?php the_title(); ?>" class="largeport"/><?php if ($video_url != '') { echo '<a href="'.$video_url.'" rel="prettyPhoto" class="video"><span>Play</span></a>'; } ?></div></div>
            <?php endif; ?>
            
             <?php if($image5 != '') : ?>
             	<div style="height:<?php echo $imageattarray[5]; ?>px"><div class="videocontainer"><img src="<?php echo $image5; ?>" alt="<?php the_title(); ?>" width="500" height="<?php echo $imageattarray[5]; ?>" title="<?php the_title(); ?>" class="largeport"/><?php if ($video_url != '') { echo '<a href="'.$video_url.'" rel="prettyPhoto" class="video"><span>Play</span></a>'; } ?></div></div>
            <?php endif; ?>
            
             <?php if($image6 != '') : ?>
             	<div style="height:<?php echo $imageattarray[6]; ?>px"><div class="videocontainer"><img src="<?php echo $image6; ?>" alt="<?php the_title(); ?>" width="500" height="<?php echo $imageattarray[6]; ?>" title="<?php the_title(); ?>" class="largeport"/><?php if ($video_url != '') { echo '<a href="'.$video_url.'" rel="prettyPhoto" class="video"><span>Play</span></a>'; } ?></div></div>
            <?php endif; ?>
            
           <?php  $terms = get_the_terms( get_the_ID(), 'skills' );  ?>
           </div>
            <div class="icons"><a href="<?php comments_link(); ?>"><img src="<?php echo get_template_directory_uri();?>/images/comment-icon.png" alt="comments" /><span class="tooltip black right"><?php comments_number( __('No Comments', 'framework'), __('One Comment', 'framework'), __('% Comments', 'framework') ); ?></span></a>
            <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/tag-icon.png" alt="Tags" /><span class="tooltip black right"><?php if ($terms != null) { foreach ($terms as $term) { echo $term->name .', '; }}else { echo __('No Tags', 'framework');} ?></span></a>
            <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/calendar-icon.png" alt="date"/><span class="tooltip black right"><?php _e('Added on', 'framework'); ?> <?php the_time( get_option('date_format') ); ?></span></a>
            </div>
            <div class="portfoliocontent">
                  <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
                    <?php the_title(); ?>
                    </a></h2>
                    <?php global $more; $more = 0; ?>
                <?php the_content(__('Read more...', 'framework')); ?>
                <div class="xout"><a href="#" onclick="javascript:xout('a<?php echo $counter; ?>', '#itemdiva<?php echo $counter; ?>'); return false;">Close</a></div>
            </div>
        </div>
        <div style="clear:both;"></div>
          
    </div>
    <?php $counter++; ?>
    <?php endwhile; ?>
    <?php if (get_option('of_project_pagination') == 'On') : ?>
    <?php $maxpages = $pp->max_pages; ?>
    <div class="item pageitem">
            <?php if ( function_exists('pp_has_pagination') ) : ?>
        <div class="pagination_container">
        <ul id="pagination">
            <!-- the previous page -->
            <?php pp_the_pagination(); if (pp_has_previous_page()) : ?>
            <li class="previous"> <a href="<?php pp_the_previous_page_permalink(); ?>" class="prev">&laquo;
                <?php _e('Previous', 'framework'); ?>
                </a></li>
            <?php else : ?>
            <li class="previous-off">&laquo;
                <?php _e('Previous', 'framework'); ?>
            </li>
            <?php endif; pp_rewind_pagination(); ?>
            <!-- the page links -->
            <?php while(pp_has_pagination()) : pp_the_pagination(); 
            if (!($maxpages == 1)) : ?>
            <?php if (pp_is_current_page()) : ?>
            <li class="active">
                <?php pp_the_page_num(); ?>
            </li>
            <?php else : ?>
            <li><a href="<?php pp_the_page_permalink(); ?>">
                <?php pp_the_page_num(); ?>
                </a></li>
            <?php endif; endif; ?>
            <?php endwhile; pp_rewind_pagination(); ?>
            <!-- the next page -->
            <?php pp_the_pagination(); if (pp_has_next_page()) : ?>
            <li class="next"> <a href="<?php pp_the_next_page_permalink(); ?>">
                <?php _e('Next', 'framework'); ?>
                &raquo;</a></li>
            <?php else : ?>
            <li class="next-off">
                <?php _e('Next', 'framework'); ?>
                &raquo;</span>
                <?php endif; pp_rewind_pagination(); ?>
                
        </ul>
        </div>
        <?php  else:  ?>
        <div class="pagination_container">
		 <div class="alignleft"><?php previous_posts_link('&larr; Previous') ?></div>
  		 <div class="alignright"><?php next_posts_link('More &rarr;', $loop->max_num_pages ) ?></div>
         </div>
		<?php endif; ?>
        </div>
       <?php endif; ?>
</div>
<?php get_footer(); ?>