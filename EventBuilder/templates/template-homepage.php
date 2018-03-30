<?php
/**
 * Template name: Homepage
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

get_header(); ?>

		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-12">

						<div class="row">

							<div class="col-sm-12">

								<div class="post-excerpt">
										
									<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									
									<?php the_content(); ?>
																					
									<?php endwhile; endif; ?> 

								</div>

							</div>

						</div>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>