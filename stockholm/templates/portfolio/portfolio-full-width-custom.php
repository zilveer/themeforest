<?php
//get global variables
global $wp_query;
global $qode_options;

//init variables
$id = $wp_query->get_queried_object_id();

if(get_post_meta($id, "qode_content-top-padding", true) != ""){
	$content_style = get_post_meta($id, "qode_content-top-padding", true);
}else{
	$content_style = "";
}
?>
<div class="full_width">
	<div class="full_width_inner" <?php if($content_style != "") { echo " style='padding-top:". esc_attr($content_style) ."px'";} ?>>
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