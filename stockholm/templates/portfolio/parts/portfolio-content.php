<?php

global $qode_options;
//init variables
$portfolio_template = 'small-images';

//is portfolio template set for current portfolio?
if(get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true) != "") {
	$portfolio_template = get_post_meta(get_the_ID(), "qode_choose-portfolio-single-view", true);
} elseif($qode_options['portfolio_style'] !== '') {
	//get default portfolio template if set in theme's options
	$portfolio_template = $qode_options['portfolio_style'];
}
?>
<?php if($portfolio_template !== 'fullscreen-slider'){ ?>
	<h3 class="info_section_title"><?php the_title(); ?></h3>
<?php } ?>

<div class="info portfolio_single_content">
	<?php the_content(); ?>
</div> <!-- close div.portfolio_content -->