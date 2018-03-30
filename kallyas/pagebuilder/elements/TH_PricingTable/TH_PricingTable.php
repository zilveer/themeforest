<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Pricing Tables
 Description: Create and display a Pricing Table element
 Class: TH_PricingTable
 Category: content
 Level: 3
*/
/**
 * Class HT_Accordion
 *
 * Create and display an Accordion element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author Team Hogash
 * @since 3.8.0
 */
class TH_PricingTable extends ZnElements
{
	public static function getName(){
		return __( "Pricing Tables", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){

		//print_z($this);
		$uid = $this->data['uid'];
		$css = '';

		$pt_color = $this->opt('pt_color') ? $this->opt('pt_color') : '';
		//** Set background color of the section
		if (!empty($pt_color))
		{
			$css .= ".$uid .btn-fullcolor, .$uid .plan-column.featured .subscription-price .inner-cell{background-color:$pt_color}";
			$css .= ".$uid .btn-fullcolor:hover{background-color:".adjustBrightness($pt_color, 20)."}";
			$css .= ".$uid .plan-column .plan-title {color:$pt_color}";
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 * @return void
	 */
	function element()
	{
		$options = $this->data['options'];

		$elm_classes=array();
		$elm_classes[] = $this->data['uid'];
		$elm_classes[] = zn_get_element_classes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$elm_classes[] = 'prt--'.$color_scheme;
		$elm_classes[] = 'element-scheme--'.$color_scheme;

		$numItems = (isset($options['pt_num_items']) && !empty($options['pt_num_items']) ) ? $options['pt_num_items'] : 4;

		// Don't display anything if the element is not configured
		if( empty($options['pricing_tables_single']) ){ return; }

		$responsive_type = 'table-responsive-normal';
		if( $this->opt('pt_resptype','normal') == 'overflow' ){
			$responsive_type = 'table-responsive pr-table-responsive';
		}

		echo '<div class="'.$responsive_type.'">';

			echo '<div class="pricing-table-element prc-table '.implode(' ', $elm_classes).'" '.zn_get_element_attributes($options).' data-columns="'.$numItems.'">';

			// Features Column
			if($this->opt('pt_feature_titles','') == 'yes'){
				echo '<div class=" features-column prc-table-featcol hidden-sm hidden-xs"><ul class="prc-table-featcol-list">';
					$feature_titles_list = $this->opt('pt_feature_titles_features','');
					if( !empty($feature_titles_list) ){
						$feature_titles_list = explode("\n", $feature_titles_list);
						foreach($feature_titles_list as $feature_titles_item){
							echo '<li class="prc-table-featcol-item"><div class="inner-cell prc-table-featcol-cell">'.$feature_titles_item.'</div></li>';
						}
					}
				echo '</ul></div>';
			}

			if(isset($options['pricing_tables_single']) && !empty($options['pricing_tables_single']))
			{

				foreach($options['pricing_tables_single'] as $entry)
				{
					$featured = (isset($entry['pt_single_featured']) && $entry['pt_single_featured'] != 'no' ? '': 'featured');
					$features = (isset($entry['pt_single_features']) && !empty($entry['pt_single_features']) ? $entry['pt_single_features'] : '');
					$title = (isset($entry['pt_single_title']) ? $entry['pt_single_title'] : '');
					$price = (isset($entry['pt_single_price']) ? $entry['pt_single_price'] : '');
					$pt_single_currency = (isset($entry['pt_single_currency']) ? $entry['pt_single_currency'] : '$');
					$period = (isset($entry['pt_single_plan_period']) ? $entry['pt_single_plan_period'] : '');
					$caButtonText = (isset($entry['pt_single_ca_btn_text']) ? $entry['pt_single_ca_btn_text'] : '');
					$caButtonLink = '';

					$pt_single_ca_btn_link = zn_extract_link($entry['pt_single_ca_btn_link'], 'btn btn-fullcolor prc-table-btn');
					if(!empty($caButtonText)){
						$caButtonLink = $pt_single_ca_btn_link['start'] . $caButtonText . $pt_single_ca_btn_link['end'];
					}

					$featured_mostpopular = ($featured == 'featured') ? 'data-featuredtitle="'. esc_attr( __( 'MOST POPULAR', 'zn_framework' ) ) .'"' : '';


					$curr_html = '<span class="currency">'.$pt_single_currency.'</span>';
					$price_html = '<span class="price kl-font-alt">'.$price.'</span>';

					// Reposition currency
					if($this->opt('pt_curr_pos','') == '1'){
						$price_curr = $price_html.$curr_html;
					} else {
						$price_curr = $curr_html.$price_html;
					}

					echo '<div class="plan-column prc-table-col '.$featured.' ">';
					echo '<ul class="prc-table-col-list">
							<li class="plan-title prc-table-col-title text-custom">
								<div class="inner-cell prc-table-col-title-cell kl-font-alt" '.$featured_mostpopular.'>'.$title.'</div>
							</li>
							<li class="subscription-price prc-table-col-price">
								<div class="inner-cell prc-table-col-title">
									'.$price_curr.'<br>
									'.__('per', 'zn_framework').' '.$period.'</div>
							</li>';

					if(! empty($features)){
						$features = explode("\n", $features);
						foreach($features as $feature){
							echo '<li><div class="inner-cell">'.$feature.'</div></li>';
						}
					}

					if(! empty($caButtonLink)){
						echo '<li><div class="inner-cell">'.$caButtonLink.'</div></li>';
					}
					echo '</ul>';
					echo '</div>';
				}
			}
			echo '</div>';
		echo '</div>';
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$extra_options = array (
			"name"           => __( "Pricing Tables", 'zn_framework' ),
			"description"    => __( "Here you can create your desired pricing tables.", 'zn_framework' ),
			"id"             => "pricing_tables_single",
			"std"            => "",
			"type"           => "group",
			"add_text"       => __( "Pricing Table", 'zn_framework' ),
			"remove_text"    => __( "Pricing Table", 'zn_framework' ),
			"group_sortable" => true,
			"element_title" => "pt_single_title",
			"subelements"    => array (
				array (
					"name"        => __( "Featured", 'zn_framework' ),
					"description" => __( "Please select yes if you want this plan to be featured.", 'zn_framework' ),
					"id"          => "pt_single_featured",
					'type'          => 'toggle2',
					'std'           => '',
					'value'         => 'no'
				),
				array (
					"name"        => __( "Title", 'zn_framework' ),
					"description" => __( "Please specify title for this plan", 'zn_framework' ),
					"id"          => "pt_single_title",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Price", 'zn_framework' ),
					"description" => __( "Select specify the price for this plan. Prices will use the dollar currency by default", 'zn_framework' ),
					"id"          => "pt_single_price",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Currency", 'zn_framework' ),
					"description" => __( "Add the currency simbol you want to use", 'zn_framework' ),
					"id"          => "pt_single_currency",
					"std"         => "$",
					"type"        => "text"
				),
				array (
					"name"        => __( "Plan Period", 'zn_framework' ),
					"description" => __( "Please specify the plan period", 'zn_framework' ),
					"id"          => "pt_single_plan_period",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Call to action button text", 'zn_framework' ),
					"description" => __( "Please specify the call to action button text.", 'zn_framework' ),
					"id"          => "pt_single_ca_btn_text",
					"std"         => "",
					"type"        => "text"
				),
				array (
					"name"        => __( "Button link", 'zn_framework' ),
					"description" => __( "Please choose the link you want to use.", 'zn_framework' ),
					"id"          => "pt_single_ca_btn_link",
					"std"         => "",
					"type"        => "link",
					"options"     => zn_get_link_targets(),
				),
				array (
					"name"        => __( "Features", 'zn_framework' ),
					"description" => __( "Please specify each feature on its own line", 'zn_framework' ),
					"id"          => "pt_single_features",
					"std"         => "",
					"type"        => "textarea"
				),
			)
		);

		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(
					array (
						"name"        => __( "Columns", 'zn_framework' ),
						"description" => __( "Please select the number of pricing tables to display.", 'zn_framework' ),
						"id"          => "pt_num_items",
						"std"         => "4",
						"options"     => array (
							'1'        => 1,
							'2'        => 2,
							'3'        => 3,
							'4'        => 4,
							'5'        => 5,
						),
						"type"        => "select",
					),

					array (
						"name"        => __( "Enable Feature Titles column?", 'zn_framework' ),
						"description" => __( "If you want the first column to contain the list of features titles, please enable this option.", 'zn_framework' ),
						"id"          => "pt_feature_titles",
						'type'          => 'toggle2',
						'std'           => '',
						'value'         => 'yes'
					),

					array (
						"name"        => __( "Feature Titles List", 'zn_framework' ),
						"description" => __( "Please specify each feature on its own line, after each one pressing Enter key (or Return)", 'zn_framework' ),
						"id"          => "pt_feature_titles_features",
						"std"         => "",
						"type"        => "textarea",
						'dependency' => array( 'element' => 'pt_feature_titles' , 'value'=> array('yes') )
					),

					array (
						"name"        => __( "Colors", 'zn_framework' ),
						"description" => __( "Please select a color theme for the table elements.", 'zn_framework' ),
						"id"          => "pt_color",
						'type'        => 'colorpicker',
						'std'         => '',
						'live' => array(
								'multiple' => array(
									array(
										'type'      => 'css',
										'css_class' => '.'.$this->data['uid'].' .btn-fullcolor, .'.$this->data['uid'].' .plan-column.featured .subscription-price .inner-cell ',
										'css_rule'  => 'background-color',
										'unit'      => ''
									),
									array(
										'type'      => 'css',
										'css_class' => '.'.$this->data['uid'].' .plan-column .plan-title',
										'css_rule'  => 'color',
										'unit'      => ''
									),
								)
							)
					),

					array (
						"name"        => __( "Columns - Responsive Behaviour", 'zn_framework' ),
						"description" => __( "Please select the behaviour of the table for responsive view under 767px (devices). Normal will just display table columns one after another. Overflow will permit users to horizontally scroll the table. ", 'zn_framework' ),
						"id"          => "pt_resptype",
						'type'        => 'select',
						'std'         => 'normal',
						'options'        => array(
							'normal' => 'Normal',
							'overflow' => 'Overflow Horizontally'
						),
					),

					array(
						'id'          => 'element_scheme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'prt--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),
					array (
						"name"        => __( "Move currency after price", 'zn_framework' ),
						"description" => __( "Enable this if you want to move the currency after the right side of the price.", 'zn_framework' ),
						"id"          => "pt_curr_pos",
						"std"         => "",
						"value"         => "1",
						"type"        => "toggle2"
					),

					$extra_options,
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#nB-eNrqr_cQ',
				'docs'    => 'http://support.hogash.com/documentation/pricing-table/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}
