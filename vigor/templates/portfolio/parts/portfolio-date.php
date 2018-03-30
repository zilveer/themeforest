<?php
global $edgt_options;

//get portfolio date value
$portfolio_hide_date = "";
if(isset($edgt_options['portfolio_hide_date'])){
	$portfolio_hide_date = $edgt_options['portfolio_hide_date'];
}

if($portfolio_hide_date != "yes"){

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

   ?>


	<div class="info portfolio_single_custom_date">
		<<?php echo esc_attr($portfolio_info_tag); ?> class="info_section_title" <?php edgt_inline_style($portfolio_info_style); ?>><?php _e('Date','edgt'); ?></<?php echo esc_attr($portfolio_info_tag); ?>>
        <p><?php the_time(get_option('date_format')); ?></p>
	</div>
<?php } ?>