<?php
//get global variables
global $wp_query;
global $qode_options;

//init variables
$id 						= $wp_query->get_queried_object_id();
$container_styles			= 'style="';

//is page background color set for current page?
if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$container_styles .= 'background-color: '.get_post_meta($id, "qode_page_background_color", true).';';
}

//close style tag. Don't delete this line
$container_styles .= '"';

//get current portfolio template
$portfolio_template = 'small-images';
if(get_post_meta($id, "qode_choose-portfolio-single-view", true) != "") {
	$portfolio_template = get_post_meta($id, "qode_choose-portfolio-single-view", true);
} elseif($qode_options['portfolio_style'] !== '') {
	$portfolio_template = $qode_options['portfolio_style'];
}

if(get_post_meta($id, "qode_content-top-padding", true) != ""){
	$content_style = get_post_meta($id, "qode_content-top-padding", true);
}else{
	$content_style = "";
}

$sidebar = "";
if(get_post_meta(get_the_ID(), "qode_portfolio_show_sidebar", true) != "" && get_post_meta(get_the_ID(), "qode_portfolio_show_sidebar", true) != "default"){
	$sidebar = get_post_meta(get_the_ID(), "qode_portfolio_show_sidebar", true);
}else{
	if(isset($qode_options['portfolio_single_sidebar'])){
		$sidebar = $qode_options['portfolio_single_sidebar'];
	}
}
?>

<div class="container" <?php echo wp_kses($container_styles, array('style')); ?>>
	<div class="container_inner default_template_holder clearfix" <?php if($content_style != "") { echo " style='padding-top:". esc_attr($content_style) ."px'";} ?>>
		<?php if(($sidebar == "default") || ($sidebar == "")) : ?>

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

		<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
			<?php if($sidebar == "1") : ?>
				<div class="two_columns_66_33 portfolio_single_sidebar clearfix">
			<?php elseif($sidebar == "2") : ?>
				<div class="two_columns_75_25 portfolio_single_sidebar clearfix">
			<?php endif; ?>
					<div class="column1">
						<div class="column_inner">

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

						</div>
					</div>
					<div class="column2">
						<?php get_sidebar(); ?>
					</div>
				</div>
		<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
			<?php if($sidebar == "3") : ?>
				<div class="two_columns_33_66 portfolio_single_sidebar clearfix">
			<?php elseif($sidebar == "4") : ?>
				<div class="two_columns_25_75 portfolio_single_sidebar clearfix">
			<?php endif; ?>
					<div class="column1">
						<?php get_sidebar(); ?>
					</div>
					<div class="column2">
						<div class="column_inner">

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

						</div>
					</div>
				</div>
		<?php endif; ?>
	</div> <!-- close div.container inner -->
</div> <!-- close div.container -->