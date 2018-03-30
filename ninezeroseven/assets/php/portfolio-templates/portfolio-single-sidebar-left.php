<?php 
/************************************************************************
* Standard Post Template w Left Sidebar
*************************************************************************/
global $wbc907_data;

$wbc907_show_author = (isset($wbc907_data['opts-author-box'])) ? $wbc907_data['opts-author-box'] : true;

$portfolio_content_type = (isset($wbc907_data['opts-portfolio-type'])) ? $wbc907_data['opts-portfolio-type'] : 'default';
?>
		<div class="container">
        
					<div class="row">


						<!-- SideBar -->

						<div class="col-sm-3">
							<?php get_sidebar();?>
						</div>

						<div class="col-sm-9">
							<div class="posts">

								<?php 

									if(have_posts()) : while(have_posts()) : the_post();


											get_template_part( 'assets/php/portfolio-templates/portfolio-content', $portfolio_content_type );  

										endwhile;
								?>
							
								<?php if(has_tag()): ?>

									<div class="tags">
										<?php the_tags(); ?>
									</div>

								<?php endif; ?>


								<!-- BEGIN AUTHOR -->

								<?php if(get_post_type() == 'post' && $wbc907_show_author == true): ?>
							
									<div class="author-block clearfix">
										<h4><?php esc_html_e('About The Author', 'ninezeroseven'); ?></h4>
										<div class="author-wrap">
										
										<?php 

											echo get_avatar( get_the_author_meta('email'), '80');

											echo '<div class="author-name">'.get_the_author().'</div>';

											echo '<div class="author-descritpion">'.the_author_meta( 'description' ).'</div>';

										?>
										</div>
									</div>

								<?php endif; ?>

								<!-- END AUTHOR -->

									<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
										
										<div class="comment-block">

											<?php comments_template(); ?>

										</div>
										
									<?php endif;?>

								<?php endif; ?>

							</div> <!-- ./posts -->

						</div><!-- ./col-sm-9 -->

					</div><!-- ./row -->

				</div><!-- ./container -->