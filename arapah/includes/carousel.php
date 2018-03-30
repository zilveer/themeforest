<?php 
	$post_query = 'cat='.of_get_option('dcarousel_cat').'&posts_per_page='.of_get_option('dcarousel_shown').''; 
?>

	<div id="arapah-carousel" class="container">
		<div class="sixteen columns"><!-- start -->
			<div class="gutter alpha omega">
				<div class="carousel-posts">
					<ul>
						<?php query_posts( $post_query ); if( have_posts() ) : while( have_posts() ) : the_post(); ?>
						<li>
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink()  ?>" ><?php the_post_thumbnail( 'medium', array('class' => 'car_thumb') ) ?></a>
							<?php else : ?>
								<img width="300" height="201" src="<?php get_template_directory_uri()  ?>/images/thumbnail-default.jpg" />
							<?php endif ?>
							<h4> 
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="Car-PostTitle" >
									<?php $short_title = substr(the_title('','',FALSE),0,25);
									echo $short_title; if (strlen($short_title) >24){ echo '...'; } ?>	
								</a>
							</h4>
							<div class="post-meta">
								<span class="date"><?php the_time('j-m-Y'); ?></span>
								<span class="cate"><?php the_category(', '); ?></span>
							</div>
							<div class="post-content">
								<p>
								<?php 
									$content = get_the_content();
									$content = strip_tags($content);
									echo substr($content, 0, 104). '...';
								?>				
								</p>
							</div>
						</li>
						
						<?php endwhile; endif;?>
						<?php wp_reset_query();?>
					</ul>
				</div>
			</div>
				<span class="CarNext"></span>
				<span class="CarPrev"></span>
		</div><!-- end -->
	</div>