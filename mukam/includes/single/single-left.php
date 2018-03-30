      	            <?php get_sidebar();
                    $after = "";	
                    ?>
					<div class="col-sm-9 col-md-9 blog-wrapper">
					<div class="blog-style-2">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<!-- Loop Start -->
						<article <?php post_class('blog-item pull-right') ?>>
                            <div class="blog-thumbnail">
								<?php 
									if ( has_post_format( 'video' )) {
											mukam_video('453');?>
											<div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
											<div class="blog-type-logo"><div class="half-round"><i class="mukam-image"></i></div></div><?php
									} 

									else if ( has_post_format( 'audio' )) {
											mukam_audio();
											?>
											<div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
											<div class="blog-type-logo"><div class="half-round"><i class="mukam-image"></i></div></div><?php
									}

									else if ( has_post_format( 'gallery' )) {
											mukam_gallery($id);
											?>
											<div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
											<div class="blog-type-logo"><div class="half-round"><i class="mukam-image"></i></div></div><?php
									}		
									else if (has_post_thumbnail()) { 
									  	$thumb = get_post_thumbnail_id(); 
									  	$image = vt_resize( $thumb, '', 805, 503, true );
									  	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
									  	?><img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" />
											<div class="blog-date"><p class="day"><?php the_time('j')?></p><p class="monthyear"><?php the_time('M, Y')?></p></div>
											<div class="blog-type-logo"><div class="half-round"><i class="mukam-image"></i></div></div>
									  	<?php } 
								?>
							</div>
							<div class="blog-content">
							<h4 class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							<p class="blog-meta"><?php echo __('By', 'mukam');?>: <?php the_author_posts_link(); ?> | <?php echo __('Tags', 'mukam');?>: <?php the_tags( '', ', ', $after ); ?> | <?php echo __('Comments', 'mukam');?>: <a href="<?php comments_link(); ?>">
					<?php comments_number( __('0', 'mukam'), __('1', 'mukam'), __('%', 'mukam') ); ?></a></p>
							<?php the_content(); ?>
							
							</div>
						</article>
						<?php endwhile; else: ?>
						<p><?php echo __('Sorry, no posts matched your criteria.', 'mukam');?></p>
 						<?php endif; ?>
 						<?php wp_link_pages(); ?>
					</div>
					<div id="comment" class="comments-wrapper">
							<?php comments_template(); ?>
					</div>
				</div>