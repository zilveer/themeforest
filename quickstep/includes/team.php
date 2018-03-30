<div class="row">

			<?php if(qs_get_meta('qs_remove_page_title', get_the_ID()) != '1') { ?>
			<header class="twelve columns entry-title">
				<h1 class="">  
					<?php 
						$page_title = qs_get_meta('qs_page_title', get_the_ID()) ? qs_get_meta('qs_page_title', get_the_ID()) : get_the_title();
						echo $page_title; 
					?>
                </h1>
                <h2 class="subtitle"><?php echo qs_get_meta('qs_page_subtitle', get_the_ID()); ?></h2>
            </header>
            <?php } ?>
	
    	<section class="twelve columns">	
				
				<div id="team-container">
			
					<?php 
						// Set the page to be pagination
						$paged = get_query_var('paged') ? get_query_var('paged') : 1;
						$count = 1;
						// Prepare social networks array
						$social_array = array('email', 'rss', 'facebook', 'twitter', 'pinterest', 'github', 'path', 'linkedin', 'dribbble', 'stumble-upon', 'behance', 'reddit', 'google-plus', 'youtube', 'vimeo', 'flickr', 'slideshare', 'picassa', 'skype', 'instagram', 'foursquare', 'delicious', 'chat', 'tumblr', 'video-chat', 'digg', 'wordpress');
						

						$args = array(
							  'post_type'      => 'team',
							  'orderby'		   => 'menu_order',
							  'order'		   => 'ASC',
							  'posts_per_page' => '100'						  
						  );


						$members = get_posts( $args );
			
			
						foreach ($members as $member) : setup_postdata($member); 
	
					?>
					
							<div class="team-member one_fourth column <?php if ($count % 4 == 0) { echo 'last'; } ?>">
								
                                	<ul class="team-social">
                                    	<?php
											foreach ($social_array as $social_media) {
												if( qs_get_meta( 'qs_social_' . $social_media, $member->ID ) ) {
													$url = '';
													if ($social_media == 'email') { $url .= 'mailto:'; }
													$url .= qs_get_meta('qs_social_' .$social_media, $member->ID);
													echo '<li class="'.$social_media.'"><a href="'. $url . '" target="_blank"><i class="foundicon-'.$social_media.'"></i></a></li>';
												}
											}
                                        ?>
                                     </ul>
                                
									<?php 
										$src = wp_get_attachment_image_src(get_post_thumbnail_id($member->ID), 'team');	
									?>
										
										<?php if($src): ?>
											<img src="<?php echo $src[0]; ?>" class="member-image" alt="<?php echo $member->post_title; ?>" />						
										<?php endif; ?>									
									
                                    
									<h4 class="name"><?php echo $member->post_title; ?></h4>
                                    <h5 class="title"><?php echo qs_get_meta('qs_job_title', $member->ID); ?></h5>
                                    <div class="desc"><?php echo apply_filters( 'the_content', $member->post_content); ?></div>

									
							</div>
							
                            <?php $count++; ?>
					
					
							<?php endforeach; wp_reset_postdata(); ?>
                            
			
				</div>
                
                	<div class="entry-content">
                		<?php 
                	    
	                    the_content();
						
	                    edit_post_link(__('Edit', 'qs_framework'),'<span class="edit-link">','</span>'); 
						
						comments_template(); 
						
						?>
                     </div>
	
    	</section>
                
</div>