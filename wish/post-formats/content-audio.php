<!-- <div class="blog-page"> -->
			<!-- Post Starts -->
			<div class="row no-gutter-6 post">
			<?php  global $wish; if($wish % 2 == 0){ ?>
				<div class="col-lg-6">

				<?php if( get_post_meta($post->ID, 'wish_audio', true) != "" ){ ?>
					<div class="wish-audio video animated" data-animation="fadeInUp" data-animation-delay="100">
						<?php echo do_shortcode('[audio src="'.get_post_meta($post->ID, 'wish_audio', true).'"]'); ?>
					</div>
				<?php }else{ ?>


						<div class="image animated" data-animation="fadeInUp" data-animation-delay="100">
							<img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/blog_large.png" alt="" class="img-responsive">
						</div>


				<?php } ?>

				</div>
				<?php } ?>
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
						<div class="post-aside description animated" data-animation="fadeInUp" data-animation-delay="500"><?php the_excerpt(); ?></div>
					</div>
				</div>
				<?php  global $wish; if($wish % 2 != 0){ ?>
			
				<div class="col-lg-6">

				<?php if( get_post_meta($post->ID, 'wish_audio', true) != "" ){ ?>
					<div class="wish-audio video animated" data-animation="fadeInUp" data-animation-delay="100">
						<?php echo do_shortcode('[audio src="'.get_post_meta($post->ID, 'wish_audio', true).'"]'); ?>
					</div>
				<?php }else{ ?>


						<div class="image animated" data-animation="fadeInUp" data-animation-delay="100">
							<img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/blog_large.png" alt="" class="img-responsive">
						</div>


				<?php } ?>







				</div>
				<?php } ?>
				</div>
<!-- </div> -->
			<!-- Post Ends -->