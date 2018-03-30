<?php
//get global variables
global $wp_query;
global $edgt_options;

//init variables
$id 						= $wp_query->get_queried_object_id();
$container_styles			= '';

//is page background color set for current page?
if(get_post_meta($id, "edgt_page_background_color", true) != ""){
	$container_styles .= 'background-color: '. esc_attr(get_post_meta($id, "edgt_page_background_color", true)).';';
}

//get current portfolio template
$portfolio_template = 'small-images';
if(get_post_meta($id, "edgt_choose-portfolio-single-view", true) != "") {
	$portfolio_template = get_post_meta($id, "edgt_choose-portfolio-single-view", true);
} elseif($edgt_options['portfolio_style'] !== '') {
	$portfolio_template = $edgt_options['portfolio_style'];
}

if(get_post_meta($id, "edgt_content-top-padding", true) != ""){
	$content_style = 'padding-top: '.get_post_meta($id, "edgt_content-top-padding", true).'px';
}else{
	$content_style = "";
}
?>

<div class="container" <?php edgt_inline_style($container_styles); ?>>
	<?php if($edgt_options['overlapping_content'] == 'yes') {?>
		<div class="overlapping_content"><div class="overlapping_content_inner">
	<?php } ?>
	<div class="container_inner default_template_holder clearfix" <?php edgt_inline_style($content_style); ?>>
		<div class="portfolio_single <?php echo esc_attr($portfolio_template); ?>">
			<?php
				if (post_password_required()) {
					echo get_the_password_form();
				} else {
					//load proper portfolio file based on portfolio template
					get_template_part('templates/portfolio/portfolio', $portfolio_template);

					get_template_part('templates/portfolio/parts/portfolio-navigation');

					get_template_part('templates/portfolio/parts/portfolio-comments');
				}
			?>
		</div> <!-- close div.portfolio single -->
	</div> <!-- close div.container inner -->
	<?php if($edgt_options['overlapping_content'] == 'yes') {?>
		</div></div>
	<?php } ?>
</div> <!-- close div.container -->