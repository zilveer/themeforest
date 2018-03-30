<?php
//get global variables
global $wp_query;
global $edgt_options;

//init variables
$id = $wp_query->get_queried_object_id();

if(get_post_meta($id, "edgt_content-top-padding", true) != ""){
	$content_style = 'padding-top: '.esc_attr(get_post_meta($id, "edgt_content-top-padding", true)).'px';
}else{
	$content_style = "";
}
?>
<div class="full_width">
	<div class="full_width_inner" <?php edgt_inline_style($content_style); ?>>
		<div class="portfolio_single full-width-portfolio">
			<?php
				if (post_password_required()) {
					echo get_the_password_form();
				} else { ?>
					<?php the_content(); ?>

					<div class="container">
						<div class="container_inner clearfix">
							<?php 
								get_template_part('templates/portfolio/parts/portfolio-navigation'); 

								get_template_part('templates/portfolio/parts/portfolio-comments');
							?>
						</div>
					</div>
				<?php }
			?>
		</div>
	</div>
</div>