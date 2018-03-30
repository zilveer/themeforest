<?php
/*
Template Name: Team
*/
get_header(); 
?>
				<div id="content">
					<div id="maincontent" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignright\""; endif; ?>>
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
							<ul id="listtestimonial">
							<?php
							$loop = new WP_Query(array('post_type' => 'team', 'posts_per_page' => '-1', 'order' => 'ASC')); 
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php	
							$custom = get_post_custom($post->ID);
							$position = $custom["position"][0];
  							$twitter_url = $custom["twitter_url"][0];
  							$linkedin_url = $custom["linkedin_url"][0];
  							$facebook_url = $custom["facebook_url"][0];
							?>
							<li>
								<div class="imgteam"><?php the_post_thumbnail('team-thumb1'); ?>
									<ul class="listsocteam">
										<?php
										if ( $twitter_url<>'') : ?>
											<li class="icontwitterteam"><a href="<?php echo $twitter_url ?>">Twitter</a></li>
										<?php endif; ?>
										<?php
										if ( $linkedin_url<>'') : ?>
											<li class="iconlinkedinteam"><a href="<?php echo $linkedin_url ?>">Linkedin</a></li>
										<?php endif; ?>
										<?php
										if ( $facebook_url<>'') : ?>
											<li class="iconfacebookteam"><a href="<?php echo $facebook_url ?>">Facebook</a></li>
										<?php endif; ?>
									</ul>
								</div>
								<div class="contentteam">
									<h3 class="titleteam"><?php the_title(); ?></h3>
									<h4 class="subtitleteam"><?php echo $position ?></h4>
									<div class="boxteam">
									<?php the_content(); ?>
									</div>
								</div>
								<div class="clear"></div>
							</li>
							<?php endwhile;?>
							</ul>
							<div class="clear"></div>
						<?php endwhile; ?>
					</div><!-- #maincontent -->
					<div id="nav" <?php if ( get_option('cc_sidebar') == 'Left') : echo "class=\"alignleft\""; endif; ?>>
						<?php get_sidebar(); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>			
			
<?php get_footer(); ?>
