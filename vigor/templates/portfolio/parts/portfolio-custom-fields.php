<?php

global $edgt_options;

$portfolio_info_tag             = 'h6';
$portfolio_info_style           = '';

//set info tag
if (isset($edgt_options['portfolio_info_tag'])) {
    $portfolio_info_tag = $edgt_options['portfolio_info_tag'];
}

//set style for info
if ((isset($edgt_options['portfolio_info_margin_bottom']) && $edgt_options['portfolio_info_margin_bottom'] != '')
    || (isset($edgt_options['portfolio_info_color']) && !empty($edgt_options['portfolio_info_color']))) {

    if (isset($edgt_options['portfolio_info_margin_bottom']) && $edgt_options['portfolio_info_margin_bottom'] != '') {
        $portfolio_info_style .= 'margin-bottom:' . esc_attr($edgt_options['portfolio_info_margin_bottom']) . 'px;';
    }

    if (isset($edgt_options['portfolio_info_color']) && !empty($edgt_options['portfolio_info_color'])) {
        $portfolio_info_style .= 'color:'.esc_attr($edgt_options['portfolio_info_color']).';';
    }

}

$portfolios = get_post_meta(get_the_ID(), "edgt_portfolios", true);
if (is_array($portfolios) && count($portfolios)){
	usort($portfolios, "edgtComparePortfolioOptions");
	foreach($portfolios as $portfolio) {
		?>
		<div class="info portfolio_single_custom_field">
			<?php if($portfolio['optionLabel'] != "") { ?>
				<<?php echo esc_attr($portfolio_info_tag);?> class="info_section_title" <?php edgt_inline_style($portfolio_info_style); ?>><?php echo stripslashes($portfolio['optionLabel']); ?></<?php echo esc_attr($portfolio_info_tag);?>>
			<?php } ?>
			<p>
				<?php if($portfolio['optionUrl'] != "") {  ?>
					<a href="<?php echo esc_url($portfolio['optionUrl']); ?>" target="_blank">
						<?php echo esc_html(stripslashes($portfolio['optionValue'])); ?>
					</a>
				<?php } else { ?>
					<?php echo esc_html(stripslashes($portfolio['optionValue'])); ?>
				<?php } ?>
			</p>
		</div> <!-- close div.info.portfolio_single_custom_field -->
	<?php
	}
}
?>