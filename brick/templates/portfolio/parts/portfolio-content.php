<?php

global $qode_options;

$portfolio_title_tag            = 'h3';
$portfolio_title_style          = '';

//set title tag
if (isset($qode_options['portfolio_title_tag'])) {
$portfolio_title_tag = $qode_options['portfolio_title_tag'];
}

//set style for title
if ((isset($qode_options['portfolio_title_margin_bottom']) && $qode_options['portfolio_title_margin_bottom'] != '')
	|| (isset($qode_options['portfolio_title_color']) && !empty($qode_options['portfolio_title_color']))){

	if (isset($qode_options['portfolio_title_margin_bottom']) && $qode_options['portfolio_title_margin_bottom'] != '') {
		$portfolio_title_style .= 'margin-bottom:'.esc_attr($qode_options['portfolio_title_margin_bottom']).'px;';
	}

	if (isset($qode_options['portfolio_title_color']) && !empty($qode_options['portfolio_title_color'])) {
		$portfolio_title_style .= 'color:'.esc_attr($qode_options['portfolio_title_color']).';';
	}

}

?>

<<?php echo esc_attr($portfolio_title_tag);?> class="info_section_title" <?php qode_inline_style($portfolio_title_style); ?>><?php the_title(); ?></<?php echo esc_attr($portfolio_title_tag);?>>
<div class="info portfolio_single_content">
	<?php the_content(); ?>
</div> <!-- close div.portfolio_content -->