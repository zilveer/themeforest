<?php
/**
 * 404 page.
 */

global $redux_demo; 
if(isset($redux_demo['title-image-bg']['url'])) { $redux_default_img_bg = $redux_demo['title-image-bg']['url']; }

get_header(); ?>

		<div id="page-title">

			<div class="content page-title-container">

				<div class="container box">

					<div class="row">

						<div class="col-sm-12">

							<h1 data-0="opacity:1;margin-top:50px;margin-bottom:50px;" data-290="opacity:0;margin-top:90px;margin-bottom:10px" class="page-title"><?php _e( 'Not found', 'themesdojo' ); ?></h1>

						</div>

					</div>

				</div>

			</div>

			<div class="page-title-bg">

				<?php if(has_post_thumbnail()) { ?>

					<?php $image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' ); ?>

					<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($image_src[0]); ?>" alt="" />

				<?php } elseif(!empty($redux_default_img_bg)) { ?>

					<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo esc_url($redux_default_img_bg); ?>" alt="" />

				<?php } else { ?>

					<img data-0="margin-top:0px;" data-290="margin-top:-50px;" src="<?php echo get_template_directory_uri(); ?>/images/title-bg.jpg" alt="" />

				<?php } ?>

			</div>

		</div>

		<div id="main-wrapper" class="content grey-bg">

			<div class="container box">

				<!--===============================-->
				<!--== Section ====================-->
				<!--===============================-->
				<section class="row">

					<div class="col-sm-8">

						<div class="post">

							<div class="row">

								<div class="col-sm-12">

									<h3><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'themesdojo' ); ?></h3>
									<h4><?php _e( 'It looks like nothing was found at this location.', 'themesdojo' ); ?></h4>

								</div>

								<div class="col-sm-6 search-form-404">

									<?php get_search_form(); ?>

								</div>

							</div>

						</div>

						<div id="ad-comments">

				    		<?php comments_template( '' ); ?>  

				    	</div>

					</div>

					<div class="col-sm-4">

						<?php get_sidebar('page'); ?>

					</div>

				</section>
				<!--==========-->

<?php get_footer(); ?>