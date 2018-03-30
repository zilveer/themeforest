<?php
/**
 * Template name: Events Tag Index Page
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

get_header(); ?>

		<?php if(!is_front_page()) { ?>

			<div id="page-title">

				<div class="content page-title-container">

					<div class="container box">

						<div class="row">

							<div class="col-sm-12">

								<?php themesdojo_breadcrumb(); ?>

								<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php the_title(); ?></h1>

							</div>

						</div>

					</div>

				</div>

				<div class="page-title-bg">

					<?php if(has_post_thumbnail()) { ?>

						<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' ); ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($image_src[0]); ?>" alt="" />

					<?php } elseif(!empty($redux_default_img_bg)) { ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($redux_default_img_bg); ?>" alt="" />

					<?php } else { ?>

						<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo get_template_directory_uri(); ?>/images/title-bg.jpg" alt="" />

					<?php } ?>

				</div>

			</div>

		<?php } ?>

		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12">

						<div class="post">

							<div class="row">

								<div class="col-sm-12">

									<span class="post-excerpt">
										
										<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									
										<?php the_content(); ?>
																					
										<?php endwhile; endif; ?>

										<div id="tag-index-page">

											<?php

												/* Begin Tag Index */ 
						 
												// Make an array from A to Z.
												$characters = range('A','Z');
												 
												// Retrieve all tags
												$getTags = get_categories( array('taxonomy' => 'event_tag', 'hide_empty' => false, 'order' => 'ASC') );

												 
												// Retrieve first letter from tag name
												$isFirstCharLetter = ctype_alpha(substr($getTags[0]->name, 0, 1));
												 
												 
																		
												// Special Character and Number Loop
												// Run a check to see if the first tag starts with a letter
												// If it does not, run this
												if ( $isFirstCharLetter == false ){


													global $html;

													$html = "";
												 
													// Print a number container	
													$html .= "<div class='tag-group'>";					
													$html .= "<h3 class='tag-title'>#</h3>";
													$html .= "<ul class='tag-list'>";
													
													// Special Character/Number Loop
													while( $isFirstCharLetter == false ){
													
														// Get the current tag
														$tag = array_shift($getTags);
														
														// Get the current tag link 
														$tag_link = get_term_link( $tag );
														
														// Print List Item
														$html .= "<li class='tag-item'>";
														
														// Check to see how many tags exist for the current letter then print appropriate code
												        if ( $tag->count > 1 ) {
												            $html .= "<a href='{$tag_link}' title='View all {$tag->count} articles with the tag of {$tag->name}' class='{$tag->slug}'>";
												        } else {
												            $html .= "<a href='{$tag_link}' title='View the article tagged {$tag->name}' class='{$tag->slug}'>";
												        }
												        
												        // Print tag name and count then close the list item
														$html .= "<span class='tag-name'>{$tag->name}</span></a><span class='tag-count'>{$tag->count}</span>";								
														$html .= "</li>";
														
														// Retrieve first letter from tag name
														// Need to redefine the global variable since we are shifting the array
														$isFirstCharLetter = ctype_alpha(substr($getTags[0]->name, 0, 1));
														
													}
													
													// Close the containers
													$html .= "</ul>";
													$html .= "</div>";	
												}
												 
												// Letter Loop
												do {
													
													// Get the right letter
													$currentLetter = array_shift($characters);

													$currentLetterAmountTags = 0;

													foreach ( $getTags as $tag ) {

														// Retrieve first letter from tag name
														$firstChar = substr($tag->name, 0, 1);

														if ( strcasecmp($currentLetter, $firstChar) == 0 ){

															$currentLetterAmountTags++;

														}

													}

													if($currentLetterAmountTags != 0) {

														global $html;
														 
														// Print stuff	
														$html .= "<div class='tag-group'>";					
														$html .= "<h3 class='tag-title'>{$currentLetter}</h3>";
														$html .= "<ul class='tag-list'>";
															
														// While we have tags, run this loop
														while($getTags){
															
															// Retrieve first letter from tag name
															$firstChar = substr($getTags[0]->name, 0, 1);
															
															// Does the first letter match the current letter?
															// Check both upper and lowercase characters for true
															if ( strcasecmp($currentLetter, $firstChar) == 0 ){	
																							
																// Get the current tag
																$tag = array_shift($getTags);
																	
																// Get the current tag link 
																$tag_link = get_term_link( $tag );
																	
																// Print stuff
																$html .= "<li class='tag-item'>";
																	
																// Check to see how many tags exist for the current letter then print appropriate code
														        if ( $tag->count > 1 ) {
														            $html .= "<a href='{$tag_link}' title='View all {$tag->count} articles with the tag of {$tag->name}' class='{$tag->slug}'>";
														       	} else {
														            $html .= "<a href='{$tag_link}' title='View the article tagged {$tag->name}' class='{$tag->slug}'>";
														        }
														            
														        // Print more stuff
																$html .= "<span class='tag-name'>{$tag->name}</span></a><span class='tag-count'>{$tag->count}</span>";								
																$html .= "</li>";
																	
															} else {
																break 1;
															}
														}								
														 
														$html .= "</ul>";
														$html .= "</div>";

													}
													
												} while ( $characters ); // Will loop over each character in the array
												 
												// Let's see what we got:
												echo($html);

											?> 

										</div>

									</span>

								</div>

							</div>

						</div>

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>