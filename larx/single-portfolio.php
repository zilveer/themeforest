<?php
$project_desc=get_post_meta(get_the_ID(),'project_desc',true);
$project_client=get_post_meta(get_the_ID(),'project_client',true);
$project_website=get_post_meta(get_the_ID(),'project_website',true);

$overlay_class = '';
$head_is_overlay = th_theme_data('head_is_overlay');
if( $head_is_overlay !='' && $head_is_overlay == 1){
    $overlay_class = "ws-overlay";
}

$switch_project_client = th_theme_data('switch_project_client');
$switch_project_website = th_theme_data('switch_project_website');
$switch_project_social = th_theme_data('switch_project_social');

$project_alter_bg=get_post_meta(get_the_ID(), 'project_alter_bg', true);

get_header(); ?>

 
	<div class="ws-parallax-header parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url($project_alter_bg); ?>">        
		<div class="<?php echo esc_attr($overlay_class); ?>">            
			<div class="ws-parallax-caption">                
				<div class="ws-parallax-holder">
					<h1><?php the_title() ?></h1>
				</div>
			</div>
		</div>            
	</div>  

	<!-- Site Wrapper -->
	<div class="project-single-wrapper">

		<div class="container">
			<?php
			//get portfolio custom fields
			get_template_part('framework/portfolio/parts/portfolio-media');
			?>
			<div class="row">

				<?php if (have_posts()) : while (have_posts()) : the_post();
					$content = get_the_content();
					$content = apply_filters('the_content', $content);
					if( !empty($content) ): ?>

						<div class="col-md-9 about-caption">
							<div class="general-title">
								<h2><?php echo esc_attr_e('Project Description', 'larx') ?></h2>
								<div class="space-bottom-2x"></div>
							</div>
							<?php echo wpautop($content); ?>
						</div>

					<?php endif; ?>
				<?php endwhile; endif; ?>
				<div class="col-md-3">

					<?php if ( $project_client !== ''  && $switch_project_client == 1 ){ ?>
						<div class="new-project-info">
							<h3><?php esc_html_e("Client", 'larx'); ?></h3>
							<p><?php echo esc_attr($project_client); ?></p>
						</div>
					<?php } ?>

					<?php if ( $project_website !== '' && $switch_project_website == 1 ){ ?>
						<div class="new-project-web">
							<h3><?php esc_html_e("Website", 'larx'); ?></h3>
							<a href="<?php echo esc_url($project_website); ?>"><?php echo esc_attr($project_website); ?></a>
						</div>
					<?php } ?>

					<?php
					//get portfolio custom fields
					get_template_part('framework/portfolio/parts/portfolio-fields');
					?>

					<?php if ( $project_desc !== '' ){ ?>
						<div class="new-project-date">
							<h3><?php esc_html_e("Date", 'larx'); ?></h3>
							<p><?php echo esc_attr($project_desc); ?></p>
						</div>
					<?php } ?>

					<?php
						//get portfolio categories section
						get_template_part('framework/portfolio/parts/portfolio-categories');
					?>

					<?php if ( $switch_project_social == 1 ){ ?>
						<div class="new-project-social">
							<h3><?php esc_html_e("Share This", 'larx'); ?></h3>
							<ul class="contact-social">
								<a href="" class="twitter-sharer" onClick="<?php echo esc_js('twitterSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a>
								<a href="" class="facebook-sharer" onClick="<?php echo esc_js('facebookSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a>
								<a href="" class="pinterest-sharer" onClick="<?php echo esc_js('pinterestSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-stack-1x fa-inverse"></i></span></a>
								<a href="" class="google-sharer" onClick="<?php echo esc_js('googleSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a>
								<a href="" class="delicious-sharer" onClick="<?php echo esc_js('deliciousSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-share fa-stack-1x fa-inverse"></i></span></a>
								<a href="" class="linkedin-sharer" onClick="<?php echo esc_js('linkedinSharer()'); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a>
							</ul>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

	</div><!-- /site-wrapper -->
	<!-- End Site Wrapper -->

<?php get_footer(); ?>