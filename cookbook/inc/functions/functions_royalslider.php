<?php

/**************************************
FUNCTIONS ROYALSLIDER

ROYAL SLIDER CUSTOM SKINS
ROYAL SLIDER CUSTOM TEMPLATES
ROYAL SLIDER CUSTOM VARIABLES

***************************************/




/**************************************
ROYAL SLIDER CUSTOM SKINS
***************************************/

	add_filter('new_royalslider_skins', 'canon_royalslider_custom_skins', 10, 2);

	function canon_royalslider_custom_skins($skins) {
	      $skins['cookbookDefault'] = array(
	           'label' => 'Cookbook: Default',
	           'path' => get_template_directory_uri() . '/css/royalslider-custom-skins/cookbook-default/cookbook-default.css'  // get_stylesheet_directory_uri returns path to your theme folder
	      );
	      // $skins['cookbook2ndSkin'] = array(
	      //      'label' => 'Cookbook: 2nd Skin',
	      //      'path' => get_template_directory_uri() . '/css/royalslider-custom-skins/cookbook-default/cookbook-2ndskin.css'  // get_stylesheet_directory_uri returns path to your theme folder
	      // );
	      return $skins;
	}
	
	
	
/**************************************
ROYAL SLIDER CUSTOM TEMPLATES
***************************************/
	
	add_filter('new_royalslider_templates', 'canon_royalslider_custom_templates', 10, 2);

	function canon_royalslider_custom_templates($templates) {

		$templates['Canon_Slider_1'] = array(
			'label' => __('Content slider with tabs', 'loc_canon'),
			'template-css' => get_template_directory_uri() . '/css/royalslider-custom-skins/cookbook-default/cookbook-default.css',
			'template-css-class' => 'Canon_Slider_1 canonSlider',
			'b-pos' => '-133px -165px',
			'template-html' =>
	                     
				'<div class="rsContent canon_rst_1">
					<div class="feat-title-container">
					{{cmb_post_ratings_overall_score_conditional_output}}
					<div class="feat-title">
						<h6 class="meta">{{categories}}</h6>	
						<h2><a href="{{permalink}}">{{title}}</a></h2>
					</div>
					</div>	
					{{image_tag}}
					{{html}}
					{{thumbnail}}
					{{cmb_post_ratings_overall_score_conditional_output_small}}
					<div class="rsTmb canon_rst_1_thumb_title">
						<h6 class="meta">{{date}}</h6>
						<h3>{{title}}</h3>
					</div>
					{{animated_blocks}}
					{{#link_url}}
					<a class="rsLink" href="{{link_url}}">{{title}}</a>
					{{/link_url}}
				</div>',
	
            'options' => array(
                
                "sopts" => array(
                    "width" => "100%",
                    "height" => "500",
					"controlNavigation" => "thumbnails",
                    "autoScaleSlider" => "false",
                    "loop" => "true",
                    "numImagesToPreload" => "4",
					"autoHeight" => "false",
					"arrowsNav" => "true",
                    "arrowsNavAutohide" => "false",
                    "arrowsNavHideOnTouch" => "false",
					"slidesOrientation" => "horizontal",
					"keyboardNavEnabled" => "true",
                    "transitionType" => "move",
                    "fadeinLoadedSlide" => "false",
                    "imageScaleMode" => "none",
                    "imageAlignCenter" => "false",
                    "imageScaleMode" => "fill",
                    "globalCaptionInside" => "true"
                ),
                "thumbs" => array(
                	"orientation" => "vertical",
                	"paddingBottom" => 0,
                	"spacing" => 0,
                	"thumbContent" => 'thumbnail, categories, title',
                	"appendSpan" => "false",
                	"autoCenter" => "true"
                ),
            )

        );
        
        
        $templates['Canon_Slider_2'] = array(
			'label' => __('Content slider with tabs', 'loc_canon'),
			'template-css' => get_template_directory_uri() . '/css/royalslider-custom-skins/cookbook-default/cookbook-default.css',
			'template-css-class' => 'Canon_Slider_2 canonSlider',
			'b-pos' => '-133px -165px',
			'template-html' =>
        	                     
        	'<div class="rsContent canon_rst_2">
        		<div class="feat-title-container">
        		{{cmb_post_ratings_overall_score_conditional_output}}
				<div class="feat-title">
					<h6 class="meta">{{categories}}</h6>	
					<h2><a href="{{permalink}}">{{title}}</a></h2>
					<p class="feat-contents">{{content40}}</p>
				</div>
				</div>	
				{{image_tag}}
				{{html}}
				{{cmb_post_ratings_overall_score_conditional_output_small}}
				{{thumbnail}}
				{{animated_blocks}}
				{{#link_url}}
				<a class="rsLink" href="{{link_url}}">{{title}}</a>
				{{/link_url}}
			</div>',
        	
            'options' => array(
                
                "sopts" => array(
                    "width" => "100%",
                    "height" => "500",
					"controlNavigation" => "thumbnails",
                    "autoScaleSlider" => "true",
                    "loop" => "true",
                    "numImagesToPreload" => "9",
					"autoHeight" => "false",
					"arrowsNav" => "true",
                    "arrowsNavAutohide" => "false",
                    "arrowsNavHideOnTouch" => "false",
					"slidesOrientation" => "horizontal",
					"keyboardNavEnabled" => "true",
                    "transitionType" => "move",
                    "fadeinLoadedSlide" => "false",
                    "imageScaleMode" => "none",
                    "imageAlignCenter" => "false",
                    "imageScaleMode" => "fill",
                    "globalCaptionInside" => "true"
                ),
                "thumbs" => array(
                	"orientation" => "vertical",
                	"paddingBottom" => 0,
                	"spacing" => 0,
                	"thumbContent" => 'thumbnail, categories, title',
                	"appendSpan" => "false",
                	"autoCenter" => "true"
                ),
            )

        );
        
        
        $templates['Canon_Slider_3'] = array(
        			'label' => __('Content slider with tabs', 'loc_canon'),
        			'template-css' => get_template_directory_uri() . '/css/royalslider-custom-skins/cookbook-default/cookbook-default.css',
        			'template-css-class' => 'Canon_Slider_3 canonSlider',
        			'b-pos' => '-133px -165px',
        			'template-html' =>
                	                     
                	'<div class="rsContent canon_rst_3">
                		<div class="feat-title-container-2">
                		
                		<div class="feat-title">
                			{{cmb_post_ratings_overall_score_conditional_output}}
                			<h6 class="meta">{{categories}}</h6>	
                			<h2><a href="{{permalink}}">{{title}}</a></h2>
                			<p class="feat-contents">{{content30}}</p>
                		</div>
                		</div>	
                		{{image_tag}}
                		{{html}}
                		{{thumbnail}}
                		{{cmb_post_ratings_overall_score_conditional_output_small}}
                		<div class="rsTmb canon_rst_3_thumb_title">
                			<h6 class="meta">{{date}}</h6>
                			<h3>{{title}}</h3>
                		</div>
                		{{animated_blocks}}
                		{{#link_url}}
                		<a class="rsLink" href="{{link_url}}">{{title}}</a>
                		{{/link_url}}
        			</div>',
                	
                    'options' => array(
                        
                        "sopts" => array(
                            "width" => "100%",
                            "height" => "550",
        					"controlNavigation" => "thumbnails",
                            "autoScaleSlider" => "true",
                            "loop" => "true",
                            "numImagesToPreload" => "9",
        					"autoHeight" => "false",
        					"arrowsNav" => "true",
                            "arrowsNavAutohide" => "false",
                            "arrowsNavHideOnTouch" => "false",
        					"slidesOrientation" => "horizontal",
        					"keyboardNavEnabled" => "true",
                            "transitionType" => "move",
                            "fadeinLoadedSlide" => "false",
                            "imageScaleMode" => "none",
                            "imageAlignCenter" => "false",
                            "imageScaleMode" => "fill",
                            "globalCaptionInside" => "true"
                        ),
                        "thumbs" => array(
                        	"orientation" => "horizontal",
                        	"paddingBottom" => 0,
                        	"spacing" => 1,
                        	"thumbContent" => 'thumbnail, categories, title',
                        	"appendSpan" => "true",
                        	"autoCenter" => "false"
                        ),
                    )
        
                );
                
                
                
                $templates['Canon_Slider_4'] = array(
                			'label' => __('Content slider with tabs', 'loc_canon'),
                			'template-css' => get_template_directory_uri() . '/css/royalslider-custom-skins/cookbook-default/cookbook-default.css',
                			'template-css-class' => 'Canon_Slider_4 canonSlider',
                			'b-pos' => '-133px -165px',
                			'template-html' =>
                        	                     
                        	'<div class="rsContent canon_rst_4">
                        		  <div class="feat-title-container">
                        		  {{cmb_post_ratings_overall_score_conditional_output}}
                        		  <div class="feat-title">
                        		  	<h6 class="meta">{{categories}}</h6>	
                        		  	<h2><a href="{{permalink}}">{{title}}</a></h2>
                        		  	<p class="feat-contents">{{content40}}</p>
                        		  </div>
                        		  </div>	
                        		  {{image_tag}}
                        		  {{html}}
                        		  {{#link_url}}
                        		  <a href="{{link_url}}">{{title}}</a>
                        		  {{/link_url}}
                        		  {{animated_blocks}}
                			</div>',
                        	
                            'options' => array(
                                
                                "sopts" => array(
                                    "width" => "100%",
                                    "height" => "500",
                					"controlNavigation" => "none",
                                    "autoScaleSlider" => "false",
                                    "loop" => "true",
                                    "numImagesToPreload" => "9",
                					"autoHeight" => "false",
                					"arrowsNav" => "true",
                                    "arrowsNavAutohide" => "false",
                                    "arrowsNavHideOnTouch" => "false",
                					"slidesOrientation" => "horizontal",
                					"keyboardNavEnabled" => "true",
                                    "transitionType" => "move",
                                    "fadeinLoadedSlide" => "false",
                                    "imageScaleMode" => "none",
                                    "imageAlignCenter" => "false",
                                    "imageScaleMode" => "fill",
                                    "globalCaptionInside" => "true"
                                ),
                                "thumbs" => array(
                                	"orientation" => "horizontal",
                                	"paddingBottom" => 0,
                                	"spacing" => 1,
                                	"thumbContent" => 'thumbnail, categories, title',
                                	"appendSpan" => "true",
                                	"autoCenter" => "false"
                                ),
                            )
                
                        );

		return $templates;

	}

/**************************************
ROYAL SLIDER CUSTOM VARIABLES
***************************************/

	class canonRoyalSliderRendererHelper {
	    private $post;
	    private $options;

	    function __construct( $data, $options ) {
	        // $data variable holds WordPress post object only for Posts Slider
	        // for other types sliders it holds just data associated with slide, print it to see what's inside
	        $this->post = $data;

	        // slider options (that you choose in right sidebar)
	        $this->options = $options;
	    }

	    function cmb_post_ratings_overall_score() {
			$cmb_post_ratings_overall_score = get_post_meta($this->post->ID, 'cmb_post_ratings_overall_score', true);
	        return $cmb_post_ratings_overall_score;
	    }

	    function cmb_post_ratings_overall_score_conditional_output() {
	    	$output = "";
			$cmb_post_show_ratings = get_post_meta($this->post->ID, 'cmb_post_show_ratings', true);
			$cmb_post_ratings_overall_score = get_post_meta($this->post->ID, 'cmb_post_ratings_overall_score', true);
			if ( $cmb_post_show_ratings == "checked" && !empty($cmb_post_ratings_overall_score)) { $output .= sprintf('<div class="rate-tab rate-big feat-block-1"><strong>%s</strong><i>%s</i></div>', esc_attr($cmb_post_ratings_overall_score), __('Score', 'loc_canon')); }	        
			return $output;
	    }

	    function cmb_post_ratings_overall_score_conditional_output_small() {
	    	$output = "";
			$cmb_post_show_ratings = get_post_meta($this->post->ID, 'cmb_post_show_ratings', true);
			$cmb_post_ratings_overall_score = get_post_meta($this->post->ID, 'cmb_post_ratings_overall_score', true);
	        if ( $cmb_post_show_ratings == "checked" && !empty($cmb_post_ratings_overall_score) ) { $output .= sprintf('<div class="rsTmb rate-tab rate-small feat-block-1"><strong>%s</strong></div>', esc_attr($cmb_post_ratings_overall_score)); }
			return $output;
	    }

	}

	/**
	 * @param  [object] $m       Mustache_Engine object 
	 * @param  [object] $data    Object with slide data (for example for posts slider it's WordPress Post Object)
	 * @param  [object] $options Array of RoyalSlider options
	 */
	function canon_royalslider_custom_variables($m, $data, $options) {

	    // initialize helper class
	    $helper = new canonRoyalSliderRendererHelper($data, $options);

	    // custom
	    $m->addHelper('cmb_post_ratings_overall_score', array($helper, 'cmb_post_ratings_overall_score') );
	    $m->addHelper('cmb_post_ratings_overall_score_conditional_output', array($helper, 'cmb_post_ratings_overall_score_conditional_output') );
	    $m->addHelper('cmb_post_ratings_overall_score_conditional_output_small', array($helper, 'cmb_post_ratings_overall_score_conditional_output_small') );

	}

	add_filter('new_rs_slides_renderer_helper', 'canon_royalslider_custom_variables', 10, 4);
