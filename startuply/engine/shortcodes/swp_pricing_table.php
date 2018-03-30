<?php

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			$output = '';

			// setup the output of our shortcode
			$output .= '<br />';
			$output .= '[vsc-pricing-table columns="4"] <br />';
			$output .= '[vsc-pricing-column title="BASIC" price="19" currency="$" interval="month"]';
			$output .= '<ul class="list-unstyled">';
			$output .= '<li>24/7 Support</li>';
			$output .= '<li>Free 10GB Storage</li>';
			$output .= '<li>Documentation &amp; Tutorials</li>';
			$output .= '<li>Google Apps Sync</li>';
			$output .= '<li>Up to 10 Projects</li>';
			$output .= '<li>Free Facebook Page</li>';
			$output .= '<li>Up to 3 Users</li>';
			$output .= '</ul>';
			$output .= '[vsc-signup][vsc-button style="" url="#"]Sign Up[/vsc-button][/vsc-signup]<br />';
			$output .= '[/vsc-pricing-column]<br />';
			$output .= '[vsc-pricing-column title="ADVANCED" featured="yes" price="29" currency="$" interval="month"]';
			$output .= '<ul>';
			$output .= '<li>24/7 Support</li>';
			$output .= '<li>Free 20GB Storage</li>';
			$output .= '<li>Documentation &amp; Tutorials</li>';
			$output .= '<li>Google Apps Sync</li>';
			$output .= '<li>Up to 20 Projects</li>';
			$output .= '<li>Free Facebook Page</li>';
			$output .= '<li>Up to 5 Users</li>';
			$output .= '</ul>';
			$output .= '[vsc-signup][vsc-button style="" url="#"]Sign Up[/vsc-button][/vsc-signup]<br />';
			$output .= '[/vsc-pricing-column]<br />';
			$output .= '[vsc-pricing-column title="PROFESSIONAL" price="49" currency="$" interval="month"]';
			$output .= '<ul>';
			$output .= '<li>24/7 Support</li>';
			$output .= '<li>Free 50GB Storage</li>';
			$output .= '<li>Documentation &amp; Tutorials</li>';
			$output .= '<li>Google Apps Sync</li>';
			$output .= '<li>Up to 50 Projects</li>';
			$output .= '<li>Free Facebook Page</li>';
			$output .= '<li>Up to 10 Users</li>';
			$output .= '</ul>';
			$output .= '[vsc-signup][vsc-button style="" url="#"]Sign Up[/vsc-button][/vsc-signup]<br />';
			$output .= '[/vsc-pricing-column]<br />';
			$output .= '[vsc-pricing-column title="ULTIMATE" price="99" currency="$" interval="month"]';
			$output .= '<ul>';
			$output .= '<li>24/7 Support</li>';
			$output .= '<li>Unlimited Storage</li>';
			$output .= '<li>Documentation &amp; Tutorials</li>';
			$output .= '<li>Google Apps Sync</li>';
			$output .= '<li>Unlimited Projects</li>';
			$output .= '<li>Free Facebook Page</li>';
			$output .= '<li>Unlimited Users</li>';
			$output .= '</ul>';
			$output .= '[vsc-signup][vsc-button style="" url="#"]Sign Up[/vsc-button][/vsc-signup]<br />';
			$output .= '[/vsc-pricing-column]<br />';
			$output .= '[/vsc-pricing-table]<br />';


			vc_map(array(
				"name" => __("Pricing Table", "vivaco"),
				"icon" => "icon-table",
				"description" => "Pricing table element",
				"base" => "vsc-table_placebo",
				"weight" => 12,
				"class" => "pricing_extended",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textarea_html",
						"holder" => "div",
						"class" => "",
						"heading" => __("Pricing Table Example", "vivaco"),
						"param_name" => "content",
						"value" => $output,
						"description" => __("This is an example of a pricing table with 4 columns. Edit it and make it your own.", "vivaco")
					)
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Pricing Table 2 VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
/* Initialising shortcodes */
function shortcode_init($atts, $content = null) {
	return '<div class="signup">' . do_shortcode($content) . '</div>';
}
add_shortcode('vsc-signup', 'shortcode_init');


// placebo
function vsc_pricing_table_placebo($atts, $content = null) {
	return do_shortcode($content);
}
add_shortcode('vsc-table_placebo', 'vsc_pricing_table_placebo');

// body
function vsc_pricing_table($atts, $content = null) {
	global $vsc_table;
	extract(shortcode_atts(array(
		'columns' => '4'
	), $atts));

	$columnsNr = '';
	$finished_table = '';

	switch (intval($columns)) {
		case '2':
			$columnsNr .= 'col-sm-6';
			break;
		case '3':
			$columnsNr .= 'col-sm-4';
			break;
		case '4':
			$columnsNr .= 'col-sm-3';
			break;
		case '6':
			$columnsNr .= 'col-sm-2';
			break;
	}

	do_shortcode($content);

	$columnContent = '';
	if (is_array($vsc_table)) {

		for ($i = 0; $i < count($vsc_table); $i++) {
			$columnClass = 'pricing-column';
			$n = $i + 1;
			$columnClass .= ($n % 2) ? '' : ' even-column';
			$columnClass .= ($vsc_table[$i]['featured']) ? ' featured-column' : '';
			$columnClass .= ($n == count($vsc_table)) ? ' last-column' : '';
			$columnClass .= ($n == 1) ? ' first-column' : '';
			$columnContent .= '<div class="' . $columnClass . ' ' . $columnsNr . '">';

			$columnContent .= '<div class="package-column heading-font base_clr_bg">';

			if (($vsc_table[$i]['featured']) == '1') {
				$columnContent .= '<div class="column-shadow"></div>';
			}
			$columnContent .= '<div class="package-title">' . $vsc_table[$i]['title'] . '</div><div class="package-value package-price base_clr_txt"><div class="price"><span class="package-currency currency">' . $vsc_table[$i]['currency'] . '</span>' . $vsc_table[$i]['price'] . '</div><div class="period base_clr_txt"><span class="package-time">' . $vsc_table[$i]['interval'] . '</span></div></div>';
			$columnContent .= '<div class="package-features package-detail">' . str_replace(array(
				"\r\n",
				"\n",
				"\r",
				"<p></p>"
			), array(
				"",
				"",
				"",
				""
			), $vsc_table[$i]['content']) . '</div>';
			$columnContent .= '</div>';

			$columnContent .= '</div>';

		}
		$finished_table = '<div class="pricing-table">' . $columnContent . '</div>';
	}

	$vsc_table = '';

	return $finished_table;

}

add_shortcode('vsc-pricing-table', 'vsc_pricing_table');


// Single Column
function vsc_shortcode_pricing_column($atts, $content = null) {
	global $vsc_table;
	extract(shortcode_atts(array(
		'title' => '',
		'price' => '',
		'currency' => '',
		'interval' => '',
		'featured' => 'false'
	), $atts));

	$featured = strtolower($featured);

	$column['title'] = $title;
	$column['price'] = $price;
	$column['currency'] = $currency;
	$column['interval'] = $interval;
	$column['featured'] = ($featured == 'true' || $featured == 'yes' || $featured == '1') ? true : false;
	$column['content'] = do_shortcode($content);

	$vsc_table[] = $column;

}

add_shortcode('vsc-pricing-column', 'vsc_shortcode_pricing_column');
