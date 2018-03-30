<?php
/**
 * @package Wish
 */
?>

					<div class="row">
						<!-- Column 1 Starts -->
						<div class="col-lg-6">
							<div class="row">
                            <?php $format = get_post_format();?>
                            
                            <?php if(empty($format)){
								
								get_template_part( 'post-formats/single/content', 'image' ); 
							} else {
							 get_template_part( 'post-formats/single/content', get_post_format() ); 
							 
							 }
							 
							 ?>
								
								<!-- User Comments Starts -->
				<div class="col-lg-12 col-md-6 col-sm-6">
				
 <?php

				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				
			?>
	
	
	

		<?php endif; ?>
	</div>
			<!-- Leave a Reply Ends -->
							</div>
						</div>
						<!-- Column 1 Ends -->
						<!-- Column 2 Starts -->
						<div class="col-lg-6">
							<div class="info">
							<?php $term_list = wp_get_post_terms($post->ID, 'category', array("fields" => "all")); ?>
								<div class="meta animated" data-animation="fadeInUp" data-animation-delay="100">


								<span class="colored-text">
								<?php if( array_key_exists(0, $term_list) ) { ?>
								<?php echo esc_attr( $term_list[0]->name ); ?>
								<?php 
										}else{
										echo __("Uncategorized", "wish");	
										} 
								?>
								</span>  

								/  <?php wish_posted_on(); ?>
								</div>
								


								<h1 class="animated" data-animation="fadeInUp" data-animation-delay="300"><?php the_title() ?></h1>
								<div class="description animated" data-animation="fadeInUp" data-animation-delay="500">
									<?php the_content(); ?>									
								</div>
							</div>
						</div>
						<!-- Column 2 Ends -->
					</div>
			
