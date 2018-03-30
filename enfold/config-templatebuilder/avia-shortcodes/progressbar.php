<?php
/**
 * Sidebar
 * Displays one of the registered Widget Areas of the theme
 */

if ( !class_exists( 'avia_sc_progressbar' ) )
{
	class avia_sc_progressbar extends aviaShortcodeTemplate
	{
			/**
			 * Create the config array for the shortcode button
			 */
			function shortcode_insert_button()
			{
				$this->config['name']		= __('Progress Bars', 'avia_framework' );
				$this->config['tab']		= __('Content Elements', 'avia_framework' );
				$this->config['icon']		= AviaBuilder::$path['imagesURL']."sc-progressbar.png";
				$this->config['order']		= 30;
				$this->config['target']		= 'avia-target-insert';
				$this->config['shortcode'] 	= 'av_progress';
				$this->config['shortcode_nested'] = array('av_progress_bar');
				$this->config['tooltip'] 	= __('Create some progress bars', 'avia_framework' );
			}

			/**
			 * Popup Elements
			 *
			 * If this function is defined in a child class the element automatically gets an edit button, that, when pressed
			 * opens a modal window that allows to edit the element properties
			 *
			 * @return void
			 */
			function popup_elements()
			{
				$this->elements = array(


						array(
							"name" => __("Add/Edit Progress Bars", 'avia_framework' ),
							"desc" => __("Here you can add, remove and edit the various progress bars.", 'avia_framework' ),
							"type" 			=> "modal_group",
							"id" 			=> "content",
							"modal_title" 	=> __("Edit Progress Bars", 'avia_framework' ),
							"std"			=> array(

													array('title'=>__('Skill or Task', 'avia_framework' ), 'icon'=>'43', 'progress'=>'100', 'icon_select'=>'no'),

													),

							'subelements' 	=> array(

									array(
									"name" 	=> __("Progress Bars Title", 'avia_framework' ),
									"desc" 	=> __("Enter the Progress Bars title here", 'avia_framework' ) ,
									"id" 	=> "title",
									"std" 	=> "",
									"type" 	=> "input"),

									array(
										"name" 	=> __("Progress in &percnt;", 'avia_framework' ),
										"desc" 	=> __("Select a number between 0 and 100", 'avia_framework' ),
										"id" 	=> "progress",
										"type" 	=> "select",
										"std" 	=> "100",
										"subtype" => AviaHtmlHelper::number_array(0,100,1)
										),

									array(
										"name" 	=> __("Bar Color", 'avia_framework' ),
										"desc" 	=> __("Choose a color for your progress bar here", 'avia_framework' ),
										"id" 	=> "color",
										"type" 	=> "select",
										"std" 	=> "theme-color",
										"subtype" => array(
												__('Theme Color', 'avia_framework' )=>'theme-color',
												__('Blue', 'avia_framework' )=>'blue',
												__('Red',  'avia_framework' )=>'red',
												__('Green', 'avia_framework' )=>'green',
												__('Orange', 'avia_framework' )=>'orange',
												__('Aqua', 'avia_framework' )=>'aqua',
												__('Teal', 'avia_framework' )=>'teal',
												__('Purple', 'avia_framework' )=>'purple',
												__('Pink', 'avia_framework' )=>'pink',
												__('Silver', 'avia_framework' )=>'silver',
												__('Grey', 'avia_framework' )=>'grey',
												__('Black', 'avia_framework' )=>'black',
												)),

									array(
									"name" 	=> __("Icon", 'avia_framework' ),
									"desc" 	=> __("Should an icon be displayed at the left side of the progress bar", 'avia_framework' ),
									"id" 	=> "icon_select",
									"type" 	=> "select",
									"std" 	=> "no",
									"subtype" => array(
									__('No Icon',  'avia_framework' ) =>'no',
									__('Yes, display Icon',  'avia_framework' ) =>'yes')),

									array(
										"name" 	=> __("List Item Icon",'avia_framework' ),
										"desc" 	=> __("Select an icon for your list item below",'avia_framework' ),
										"id" 	=> "icon",
										"type" 	=> "iconfont",
										"required" => array('icon_select','equals','yes'),
										"std" 	=> "",
										),
									)
								),
								
								array(
									"name" 	=> __("Progress Bar Style", 'avia_framework' ),
									"desc" 	=> __("Chose the styling of the progress bar here", 'avia_framework' ),
									"id" 	=> "bar_styling",
									"type" 	=> "select",
									"std" 	=> "av-striped-bar",
									"subtype" => array(
									__('Striped',  'avia_framework' ) =>'av-striped-bar',
									__('Single Color',  'avia_framework' ) =>'av-flat-bar')),
								
							
							array(
									"name" 	=> __("Progress Bar Animation enabled?", 'avia_framework' ),
									"desc" 	=> __("Chose if you want to enable the continuous animation of the progress bar", 'avia_framework' ),
									"id" 	=> "bar_animation",
									"type" 	=> "select",
									"std" 	=> "av-animated-bar",
									"required" => array('bar_styling','not','av-flat-bar'),
									"subtype" => array(
									__('Enabled',  'avia_framework' ) 	=>'av-animated-bar',
									__('Disabled',  'avia_framework' )	=>'av-fixed-bar')),
							
							);
			}

			/**
			 * Editor Sub Element - this function defines the visual appearance of an element that is displayed within a modal window and on click opens its own modal window
			 * Works in the same way as Editor Element
			 * @param array $params this array holds the default values for $content and $args.
			 * @return $params the return array usually holds an innerHtml key that holds item specific markup.
			 */
			function editor_sub_element($params)
			{
				$template = $this->update_template("title","{{title}}: ");
				$template_percent= $this->update_template("progress", "{{progress}}%");
				
				extract(av_backend_icon($params)); // creates $font and $display_char if the icon was passed as param "icon" and the font as "font" 

				if(empty($params['args']['icon_select'])) $params['args']['icon_select'] = "no";

				$params['innerHtml']  = "";
				$params['innerHtml'] .= "<div class='avia_title_container'>";
				$params['innerHtml'] .= "	<span ".$this->class_by_arguments('icon_select' ,$params['args']).">";
				$params['innerHtml'] .= "		<span ".$this->class_by_arguments('font' ,$font).">";
				$params['innerHtml'] .= "			<span data-update_with='icon_fakeArg' class='avia_tab_icon'>".$display_char."</span>";
				$params['innerHtml'] .= "		</span>";
				$params['innerHtml'] .= "		<span {$template} >".$params['args']['title'].": </span>";
				$params['innerHtml'] .= "		<span {$template_percent} >".$params['args']['progress']."%</span>";
				$params['innerHtml'] .= "	</span>";
				$params['innerHtml'] .= "</div>";

				return $params;
			}



			/**
			 * Frontend Shortcode Handler
			 *
			 * @param array $atts array of attributes
			 * @param string $content text within enclosing form of shortcode element
			 * @param string $shortcodename the shortcode found, when == callback name
			 * @return string $output returns the modified html string
			 */
			function shortcode_handler($atts, $content = "", $shortcodename = "", $meta = "")
			{
				extract(shortcode_atts(array(	'position'		=>	'left', 
												'bar_styling'	=>	'av-striped-bar', 
												'bar_animation'	=>	'av-animated-bar' ), $atts, $this->config['shortcode']));

				$bars = ShortcodeHelper::shortcode2array($content);
				$extraClass = $bar_styling." ".$bar_animation;
				$output		= "";

				if(!empty($bars))
				{
					$output .= "<div class='avia-progress-bar-container avia_animate_when_almost_visible ".$meta['el_class']." {$extraClass}'>";

						$defaults = array('color' => 'theme-color', 'progress' => "100", 'title'=>"", 'icon'=>'','font'=>'', "icon_select"=>"no");

						foreach($bars as $bar)
						{
							$bar['attr'] 	= array_merge($defaults, $bar['attr']);
							$display_char 	= av_icon($bar['attr']['icon'], $bar['attr']['font']);
							
							$output .= "<div class='avia-progress-bar ".$bar['attr']['color']."-bar icon-bar-".$bar['attr']['icon_select']."'>";

							if($bar['attr']['icon_select'] == "yes" || $bar['attr']['title'])
							{
								$output .="<div class='progressbar-title-wrap'>";
								$output .="<div class='progressbar-icon'><span class='progressbar-char' {$display_char}></span></div>";
								$output .="<div class='progressbar-title'>".$bar['attr']['title']."</div>";
								$output .="</div>";
							}

							$output .= 		"<div class='progress'><div class='bar-outer'><div class='bar' style='width: ".$bar['attr']['progress']."%' data-progress='".$bar['attr']['progress']."'></div></div></div>";
							$output .= "</div>";
						}

					$output .= "</div>";
				}

				return $output;
			}


	}
}
