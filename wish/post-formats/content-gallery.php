<!-- Post Starts -->
			<div class="row no-gutter-6 post">
			<?php  global $wish; if(($wish % 2) != 0){ ?>
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




						<h1 class="animated wish-post-title" data-animation="fadeInUp" data-animation-delay="300"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h1>
						<div class="description animated" data-animation="fadeInUp" data-animation-delay="500"><?php the_excerpt(); ?></div>
					</div>
				</div>
				<?php } ?>
				<div class="col-lg-6">
				<?php  
					if(function_exists("rwmb_meta")){
						$slides = rwmb_meta( 'wish_gallery_gal', 'type=image&size=full' );
					}else{
						$slides = array();
					}


					if(!empty($slides)){
						$carousel_class = "pictures-carousel";
					}else{
						$carousel_class = "";
					}
				?>
					<div class="image <?php echo sanitize_html_class($carousel_class); ?>  animated" data-animation="fadeInUp" data-animation-delay="100">
					<?php 
					 

					if(!empty($slides)){
					foreach($slides as $slide){
						if($slide['url']){
					?>
						<div><img src="<?php echo esc_url($slide['url']); ?>" class="img-responsive" alt="slide"></div>
						<?php } ?>
						<?php } ?>
					<?php }else{ ?>	
							<img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/blog_large.png" alt="" class="img-responsive">
					<?php } ?>
					</div>




				</div>
				<?php if($wish % 2 == 0){ ?>
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



						<h1 class="animated wish-post-title" data-animation="fadeInUp" data-animation-delay="300"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h1>
						<div class="description animated" data-animation="fadeInUp" data-animation-delay="500"><?php the_excerpt(); ?></div>
					</div>
				</div>
				<?php } ?>
			</div>
			<!-- Post Ends -->