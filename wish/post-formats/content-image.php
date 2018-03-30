<div class="row no-gutter-6 post">


<?php  global $wish; if($wish % 2 == 0){ ?>
				<div class="col-lg-6">
					<div class="image animated" data-animation="fadeInUp" data-animation-delay="100">
						
						<?php if ( has_post_thumbnail() ) { ?>
						<?php $attr = array( 'class' => "img-responsive" ); the_post_thumbnail('post-blog-layout', $attr) ?>
						<?php }else{ ?>
						<img src="<?php echo esc_url( get_template_directory_uri() )  ?>/images/placeholders/blog_large.png" alt="" class="img-responsive">
						<?php } ?>

						<!-- Picture Overlay Starts -->
						<?php if ( has_post_thumbnail() ) { ?>
						<div class="picture-overlay">
							<div class="icons">
								<div><span class="icon"><a href="<?php esc_url( the_permalink() ) ?>"><i class="fa fa-link"></i></a></span><span class="icon"><a class="image-popup-vertical-fit" href="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ); ?>" title="<?php echo get_post(get_post_thumbnail_id())->post_title; ?>"><i class="fa fa-search"></i></a></span></div>
							</div>
						</div>
						<?php } ?>
						<!-- Picture Overlay Ends -->
					</div>
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

						<h1 class="animated wish-post-title" data-animation="fadeInUp" data-animation-delay="300"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title() ?></a></h1>
						<div class="description animated" data-animation="fadeInUp" data-animation-delay="500"><?php the_excerpt(); ?></div>
					</div>
				</div>
				<?php if($wish % 2 != 0){ ?>
				<div class="col-lg-6">
					<div class="image animated" data-animation="fadeInUp" data-animation-delay="100">

						<?php if ( has_post_thumbnail() ) { ?>
						<?php $attr = array( 'class' => "img-responsive" ); the_post_thumbnail('post-blog-layout', $attr) ?>
						<?php }else{ ?>
						<img src="<?php echo esc_url( get_template_directory_uri() ) ?>/images/placeholders/blog_large.png" alt="" class="img-responsive">
						<?php } ?>

						<!-- Picture Overlay Starts -->
						<?php if ( has_post_thumbnail() ) { ?>
						<div class="picture-overlay">
							<div class="icons">
								<div><span class="icon"><a href="<?php esc_url( the_permalink() ) ?>"><i class="fa fa-link"></i></a></span><span class="icon"><a class="image-popup-vertical-fit" href="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ); ?>" title="<?php echo get_post(get_post_thumbnail_id())->post_title; ?>"><i class="fa fa-search"></i></a></span></div>
							</div>
						</div>
						<?php } ?>
						<!-- Picture Overlay Ends -->
					</div>
				</div>
				<?php } ?>
</div>
			<!-- Post Ends -->