<?php
/**
 * Textblock
 * Shortcode which creates a text element wrapped in a div
 */

if ( !class_exists( 'avia_sc_social_share' ) )
{
	class avia_sc_social_share extends aviaShortcodeTemplate
	{
			/**
			 * Create the config array for the shortcode button
			 */
			function shortcode_insert_button()
			{
				$this->config['name']			= __('Social Share Buttons', 'avia_framework' );
				$this->config['tab']			= __('Content Elements', 'avia_framework' );
				$this->config['icon']			= AviaBuilder::$path['imagesURL']."sc-social.png";
				$this->config['order']			= 7;
				$this->config['target']			= 'avia-target-insert';
				$this->config['shortcode'] 		= 'av_social_share';
				$this->config['tooltip'] 	    = __('Creates one or more social share buttons ', 'avia_framework' );

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
		                    "name"  => __("Small title", 'avia_framework' ),
		                    "desc"  => __("A small title above the buttons.", 'avia_framework' ),
		                    "id"    => "title",
		                    "type" 	=> "input",
							"std" 	=> __("Share this entry",'avia_framework')
					),
					
					array(
							"name" 	=> __("Style", 'avia_framework' ),
							"desc" 	=> __("How to display the social sharing bar?", 'avia_framework' ),
							"id" 	=> "style",
							"type" 	=> "select",
							"std" 	=> "",
							"subtype" => array( __('Default with border', 'avia_framework' )=>'',
												__('Minimal', 'avia_framework' )=>'minimal'),
					),
					
					
					array(
							"name" 	=> __("Social Buttons", 'avia_framework' ),
							"desc" 	=> __("Which Social Buttons do you want to display? Defaults are set in ", 'avia_framework' ).
							"<a href='".admin_url('admin.php?page=avia#goto_blog')."'>".__('Blog Layout','avia_framework').
							"</a>",
							"id" 	=> "buttons",
							"type" 	=> "select",
							"std" 	=> "",
							"subtype" => array( __('Use Defaults that are also used for your blog', 'avia_framework' )=>'',
												__('Use a custom set', 'avia_framework' )=>'custom'),
					),
										
					
					array(	
							"name" 	=> __("Facebook link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_facebook",
							"std" 	=> "",
							"container_class" => 'av_third av_third_first',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
					
					array(	
							"name" 	=> __("Twitter link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_twitter",
							"std" 	=> "",
							"container_class" => 'av_third ',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
							
					array(	
							"name" 	=> __("Pinterest link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_pinterest",
							"std" 	=> "",
							"container_class" => 'av_third ',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
							
					array(	
							"name" 	=> __("Google Plus link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_gplus",
							"std" 	=> "",
							"container_class" => 'av_third av_third_first',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
					
					array(	
							"name" 	=> __("Reddit link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_reddit",
							"std" 	=> "",
							"container_class" => 'av_third ',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
							
					array(	
							"name" 	=> __("Linkedin link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_linkedin",
							"std" 	=> "",
							"container_class" => 'av_third ',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
							
					array(	
							"name" 	=> __("Tumblr link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_tumblr",
							"std" 	=> "",
							"container_class" => 'av_third av_third_first',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
					
					array(	
							"name" 	=> __("VK link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_vk",
							"std" 	=> "",
							"container_class" => 'av_third ',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
							
					array(	
							"name" 	=> __("Email link", 'avia_framework'),
							"desc" 	=> __("Check to display", 'avia_framework'),
							"id" 	=> "share_mail",
							"std" 	=> "",
							"container_class" => 'av_third ',
							"required" => array("buttons",'equals','custom'),
							"type" 	=> "checkbox"),
					
					
					
				);

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
				$atts = shortcode_atts(array( 
				
				'buttons' => "",
				'share_facebook' => '',
				'share_twitter' => '',
				'share_vk' => '',
				'share_tumblr' => '',
				'share_linkedin' => '',
				'share_pinterest' => '',
				'share_mail' => '',
				'share_gplus' => '',
				'share_reddit' => '',
				'title' => '',
				'style' => ''
				
				), $atts, $this->config['shortcode']);
				
				extract($atts);
				$custom_class 	= !empty($meta['custom_class']) ? $meta['custom_class'] : "";
				$custom_class  .= $meta['el_class'];
				if($style == 'minimal') $custom_class .= " av-social-sharing-box-minimal";
				
                $output 		= '';
                $args			= array();
				$options 		= false;
				$echo 			= false;
				
				if($buttons == "custom")
				{
					foreach($atts as &$att)
					{
						if(empty($att)) $att = "disabled";
					}
					
					$options = $atts;
				}
				
				
                $output .= "<div class='av-social-sharing-box {$custom_class}'>";
                $output .= avia_social_share_links($args, $options, $title, $echo);
                $output .= "</div>";

                return $output;
			}

	}
}
