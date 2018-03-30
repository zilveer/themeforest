<?php
/*
Template Name: Testimonial
*/
get_header(); 
?>
				<div id="content">
					<div id="maincontent" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignright\""; endif; ?>>
						<h1><?php the_title(); ?></h1>
							<ul id="listtestimonial">
							<?php
							$loop = new WP_Query(array('post_type' => 'testimonial', 'posts_per_page' => '-1')); 
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php	
							$custom = get_post_custom($post->ID);
							$screenshot_url = isset($custom["screenshot_url"][0]) ? $custom["screenshot_url"][0] : false;
							$website_url_testimonial = isset($custom["website_url_testimonial"][0]) ? $custom["website_url_testimonial"][0] : false;
							$company_name = isset($custom["company_name"][0]) ? $custom["company_name"][0] : false;
							?>
							<li>
								<div class="imgtestimonial"><?php the_post_thumbnail('testimonial-thumb1'); ?></div>
								<div class="contenttestimonial">
									<h3 class="titletestimonial"><?php the_title(); ?></h3> <a href="<?php echo $website_url_testimonial ?>" class="urltestimonial"><?php echo $company_name?></a>
									<div class="clear"></div>
									<div class="boxtestimonial">
									<?php the_content(); ?>
									</div>
								</div>
								<div class="clear"></div>
							</li>
							<?php endwhile;?>
							</ul>
							<div class="clear"></div>
					</div><!-- #maincontent -->
					<div id="nav" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignleft\""; endif; ?>>
						<?php get_sidebar(); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>			
			
<?php get_footer(); ?>
