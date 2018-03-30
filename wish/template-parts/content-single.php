<?php

/**

 * @package Wish

 *

 *

 *

*/

$post_width = 0;
if(function_exists("rwmb_meta")){
	$post_width = rwmb_meta( 'wish_post_width', $post->ID );
}

	$redux_wish = wish_redux();

	$layout = $redux_wish['wish-blog-single-layout'];

	//$layout = 1 => 3 columns (default)

	//$layout = 2 => Full Width

	//$layout = 3 => Right Column

	//$layout = 4 => Left Column

?>

				<?php if($layout != 3){ ?>

					<div class="row">

						<!-- Column 1 Starts -->

						

					

		<?php } ?>	







						<!-- Column 1 Ends -->

						<!-- Column 2 Starts -->
<?php if(!$post_width){ ?>
						<div class="col-lg-6 col-lg-push-6">
                        <div class="row hidden-lg">
                         <?php $format = get_post_format();?>
		                            <?php if(empty($format)){
										get_template_part( 'post-formats/single/content', 'image' ); 
									} else {
									 	get_template_part( 'post-formats/single/content', get_post_format() );
									 }
								 ?>
                        </div><!-- post thumbnail row for mobile devices -->
							<div class="info">
							<?php $term_list = wp_get_post_terms($post->ID, 'category', array("fields" => "all")); ?>
								<div class="meta animated" data-animation="fadeInUp" data-animation-delay="100"><span class="colored-text"><?php echo esc_attr($term_list[0]->name); ?></span>  /  <?php wish_posted_on(); ?></div>
								<h1 class="animated" data-animation="fadeInUp" data-animation-delay="300"><?php the_title() ?></h1>
								<div class="description animated" data-animation="fadeInUp" data-animation-delay="500">
									<?php the_content(); ?>									
								</div>
							</div>
						</div>

						<!-- Column 2 Ends -->                                                                                                                   
                        <div class="col-lg-6 col-lg-pull-6">
							<div class="row">
								<div class="visible-lg">
	                            <?php $format = get_post_format();?>	            
		                            <?php if(empty($format)){
										get_template_part( 'post-formats/single/content', 'image' ); 
									} else {
									 	get_template_part( 'post-formats/single/content', get_post_format() );
									 }
								 ?>
							</div>
								<!-- User Comments Starts -->
							<div class="col-lg-12 col-md-12 col-sm-12">
					 			<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || get_comments_number() ) :
										comments_template();
								?>
								<?php endif; ?>
							</div>
			<!-- Leave a Reply Ends -->
							</div><!-- row ends -->
						</div><!-- col-6 ends -->
                        
                        
<?php }else{ ?>                        
                        <!-- full width  -->
        
						<div class="col-lg-12">
							<div class="info">
							<?php $term_list = wp_get_post_terms($post->ID, 'category', array("fields" => "all")); ?>
								<div class="meta animated" data-animation="fadeInUp" data-animation-delay="100"><span class="colored-text"><?php echo esc_attr($term_list[0]->name); ?></span>  /  <?php wish_posted_on(); ?></div>
								<h1 class="animated" data-animation="fadeInUp" data-animation-delay="300"><?php the_title() ?></h1>
								<div class="description animated" data-animation="fadeInUp" data-animation-delay="500">
									<?php the_content(); ?>									
								</div>
							</div>
						</div>

						<!-- Column 2 Ends -->                                                                                                                   
                        <div class="col-lg-12">
							<div class="row">
								<!-- User Comments Starts -->
							<div class="col-lg-12 col-md-12 col-sm-12">
					 			<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || get_comments_number() ) :
										comments_template();
								?>
								<?php endif; ?>
							</div>
			<!-- Leave a Reply Ends -->
							</div><!-- row ends -->
						</div><!-- col-12 ends -->



            
<?php } ?>
</div>

			

