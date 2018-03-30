<?php
	global $portfolio_category, $portfolio_layout, $portfolio_about_project, $portfolio_project_date, $portfolio_project_client, $link;
?>
<article id="cs_post_<?php the_ID(); ?>" <?php post_class('single-'.$portfolio_layout.' '); ?>>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div id="cs-portfolio-content" class="cs-portfolio-content">
					<div class="cs-portfolio-details">
						<?php echo cshero_title_render();?>
					</div>
				</div>
				<div class="cs-portfolio-sidebar">
					<div class="cs-portfolio-share">
					    <div class="social-details">
							<h6 class=""><?php _e('Share', THEMENAME); ?></h6>
							<a
								href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
								target="_blank"><i class="fa fa-facebook"></i></a> <a
								href="https://twitter.com/home?status=<?php the_permalink(); ?>"
								target="_blank"><i class="fa fa-twitter"></i></a> <a
								href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
								target="_blank"><i class="fa fa-google-plus"></i></a> <a
								href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source="
								target="_blank"><i class="fa fa-linkedin"></i></a>
						</div>
					</div>
					<div class="cs-portfolio-text">
						<h5 class="cs-portfolio-title-desc"><?php _e('Project Description', THEMENAME); ?></h5>
						<?php if($portfolio_about_project) {?>
							<?php echo $portfolio_about_project;?>
						<?php } else {?>
							<?php the_content(); ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="cs-portfolio-sidebar col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="cs-portfolio-info">
					<?php echo '<div class="cs-portfolio-info-item"><h6>Date</h6>'.$portfolio_project_date.'</div>';?>
					<?php echo '<div class="cs-portfolio-info-item"><h6>Client</h6>'.$portfolio_project_client.'</div>'; ?>
					<div class="cs-portfolio-info-item"><h6><?php _e('Category', THEMENAME); ?></h6><?php the_terms( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?></div>
				</div>
			</div>
		</div>
		<div class="">
			<?php  
	            get_template_part('framework/templates/portfolio/media');
	        ?>
	    </div>
</article>