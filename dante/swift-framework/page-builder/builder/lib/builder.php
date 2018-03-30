<?php
	
	/*
	*
	*	Swift Page Builder - Builder Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	class SwiftPageBuilder extends SFPageBuilderAbstract {
	    private $is_plugin = true;
	    private $is_theme = false;
	    private $postTypes;
	    private $layout;
	    protected $shortcodes, $images_media_tab;
	
	    public static function getInstance() {
	        static $instance=null;
	        if ($instance === null)
	            $instance = new SwiftPageBuilder();
	        return $instance;
	    }
	    public function createImagesMediaTab() {
	        $this->images_media_tab = new SwiftPageBuilderImagesMediaTab();
	        return $this->images_media_tab;
	    }
	
	    public function setPlugin() {
	        $this->is_plugin = true;
	        $this->is_theme = false;
	        $this->postTypes = null;
	    }
	
	    public function setTheme() {
	        $this->is_plugin = false;
	        $this->is_theme = true;
	        $this->postTypes = null;
	    }
	
	    public function isPlugin() {
	        return $this->is_plugin;
	    }
	
	    public function isTheme() {
	        return $this->is_theme;
	    }
	
	    public function getPostTypes() {
	        if(is_array($this->postTypes)) return $this->postTypes;
	
	        $pt_array = get_option('spb_js_theme_content_types');
	                    
            $options = get_option('sf_dante_options');
            if (isset($options['enable_pb_product_pages'])) {
            	$enable_pb_product_pages = $options['enable_pb_product_pages'];
            } else {
            	$enable_pb_product_pages = false;
            }
            if ($enable_pb_product_pages) {
            $this->postTypes = $pt_array ? $pt_array : array('page', 'post', 'portfolio', 'product', 'team', 'jobs', 'ajde_events');
            } else {
            $this->postTypes = $pt_array ? $pt_array : array('page', 'post', 'portfolio', 'team', 'jobs', 'ajde_events');	            
            }
            
            $pt_array = apply_filters('spb_pt_array', $this->postTypes);
            
	        return $pt_array;
	    }
	
	    public function getLayout() {
	        if($this->layout==null)
	            $this->layout = new SPBLayout();
	        return $this->layout;
	    }
	
	    /* Add shortCode to plugin */
	    public function addShortCode($shortcode, $function = false) {
	        $name = 'SwiftPageBuilderShortcode_' . $shortcode['base'];
	        if( class_exists( $name ) && is_subclass_of( $name, 'SwiftPageBuilderShortcode' ) ) $this->shortcodes[$shortcode['base']] = new $name($shortcode);
	    }
	
	    public function createShortCodes() {
	        remove_all_shortcodes();
	        foreach( SPBMap::getShortCodes() as $sc_base => $el) {
	            $name = 'SwiftPageBuilderShortcode_' . $el['base'];
	            if( class_exists( $name ) && is_subclass_of( $name, 'SwiftPageBuilderShortcode' ) ) $this->shortcodes[$sc_base] = new $name($el);
	        }
	
	        $this->createColumnShortCode();
	    }
	
	    /* Save generated shortcodes, html and builder status in post meta
	    ---------------------------------------------------------- */
	    public function saveMetaBoxes($post_id) {
	        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
	        $value = $this->post( 'spb_js_status' );
	        if ($value !== null) {
	            //var_dump(sf_get_post_meta($post_id, '_spb_js_status'));
	            // Get the value
	            //var_dump($value);
	
	            // Add value
	            if ( sf_get_post_meta( $post_id, '_spb_js_status' ) == '' ) { add_post_meta( $post_id, '_spb_js_status', $value, true );	}
	            // Update value
	            elseif ( $value != sf_get_post_meta( $post_id, '_spb_js_status', true ) ) { update_post_meta( $post_id, '_spb_js_status', $value ); }
	            // Delete value
	            elseif ( $value == '' ) { delete_post_meta( $post_id, '_spb_js_status', sf_get_post_meta( $post_id, '_spb_js_status', true ) ); }
	        }
	    }
	
	    public function elementBackendHtmlJavascript_callback() {
	        $output = '';
	        $element = $this->post( 'element' );
	        $data_element = $this->post( 'data_element' );
	
	        if ( $data_element == 'spb_column' && $this->post( 'data_width' )!==null ) {
	            $output = do_shortcode( '[spb_column width="'. $this->post( 'data_width' ).'"]' );
	            echo $output;
	        }else  if ( $data_element == 'spb_text_block'){
				         $output = do_shortcode( '[spb_text_block]'.__("<p>This is a text block. Click the edit button to change this text.</p>", "swiftframework").'[/spb_text_block]' );
	            	echo $output;
	        }
			 else {
	            $output = do_shortcode( '['.$data_element.']' );
	            echo $output;
	        }
	        die();
	    }
	
	    public function spbShortcodesJS_callback() {
	        $content = $this->post( 'content' );
	
	        $content = stripslashes( $content );
	        $output = spb_js_remove_wpautop( $content );
	        echo $output;
	        die();
	    }
	
	
	    public function showEditFormJavascript_callback() {
	        $element = $this->post( 'element' );
	        $shortCode = $this->post( 'shortcode' );
	        $shortCode = stripslashes( $shortCode );
	
	        $this->removeShortCode($element);
	        $settings = SPBMap::getShortCode($element);
	
	        new SwiftPageBuilderShortcode_Settings($settings);
	
	        echo do_shortcode($shortCode);
	
	        die();
	    }
	
	    public function saveTemplateJavascript_callback() {
	        $output = '';
	        $template_name = $this->post( 'template_name' );
	        $template = $this->post( 'template' );
	
	        if ( !isset($template_name) || $template_name == "" || !isset($template) || $template == "" ) { echo 'Error: TPL-01'; die(); }
	
	        $template_arr = array( "name" => $template_name, "template" => $template );
	
	        $option_name = 'spb_js_templates';
	        $saved_templates = get_option($option_name);
	
	        /*if ( $saved_templates == false ) {
	            update_option('spb_js_templates', $template_arr);
	        }*/
	
	        $template_id = sanitize_title($template_name)."_".rand();
	        if ( $saved_templates == false ) {
	            $deprecated = '';
	            $autoload = 'no';
	            //
	            $new_template = array();
	            $new_template[$template_id] = $template_arr;
	            //
	            add_option( $option_name, $new_template, $deprecated, $autoload );
	        } else {
	            $saved_templates[$template_id] = $template_arr;
	            update_option($option_name, $saved_templates);
	        }
	
	        echo $this->getLayout()->getNavBar()->getTemplateMenu();
	
	        //delete_option('spb_js_templates');
	
	        die();
	    }
	
	    public function loadTemplateJavascript_callback() {
	        $output = '';
	        $template_id = $this->post( 'template_id' );
	
	        if ( !isset($template_id) || $template_id == "" ) { echo 'Error: TPL-02'; die(); }
	
	        $option_name = 'spb_js_templates';
	        $saved_templates = get_option($option_name);
	
	        $content = $saved_templates[$template_id]['template'];
	        $content = str_ireplace('\"', '"', $content);
	        //echo $content;
	        echo do_shortcode($content);
	
	        die();
	    }
	   
	    public function deleteTemplateJavascript_callback() {
	        $output = '';
	        $template_id = $this->post( 'template_id' );
	
	        if ( !isset($template_id) || $template_id == "" ) { echo 'Error: TPL-03'; die(); }
	
	        $option_name = 'spb_js_templates';
	        $saved_templates = get_option($option_name);
	
	        unset($saved_templates[$template_id]);
	        if ( count($saved_templates) > 0 ) {
	            update_option($option_name, $saved_templates);
	        } else {
	            delete_option($option_name);
	        }
	
	        echo $this->getLayout()->getNavBar()->getTemplateMenu();
	
	        die();
	    }
	
	        public function showSmallEditFormJavascript_callback() {

            $element_name = $this->post( 'element_name' );
            $tab_name     = $this->post( 'tab_name' );
            $icon         = $this->post( 'icon' );

            if ( $element_name == 'Tabs' ) {
                $singular_name = __( "Tab", 'swiftframework' );
            } else {
                $singular_name = __( "Section", 'swiftframework' );
            }

            echo '<div class="edit-small-modal"><h2>Edit ' . $element_name . ' Header</h2><div class="edit_form_actions"><a href="#" id="cancel-small-form-background">Cancel</a><a href="#" id="save-small-form" class="spb_save_edit_form button-primary">Save</a></div></div><div class="row-fluid"><div class="span4 spb_element_label">' . $singular_name . ' title</div><div class="span8 edit_form_line"><input name="small_form_title"  value="' . $tab_name . '" class="spb_param_value spb-textinput small_form_title textfield" type="text" value=""><p><span class="description">What text use as Tab title. Leave blank if no title is needed.</span></p></div></div><div class="row-fluid"><div class="span4 spb_element_label">' . $singular_name . ' Icon (FA/Gizmo)</div><div class="span8 edit_form_line"><input name="small_form_icon" class="spb_param_value spb-textinput small_form_icon textfield" type="text" value="' . $icon . '"><p><span class="description">Specify your icon.</span></p></div></div>';

            die();
        }
        
		 
	     public function loadSFTemplateJavascript_callback() {
	        $output = $content = '';
	        $template_id = $this->post( 'template_id' );
	
	        if ( !isset($template_id) || $template_id == "" ) { echo 'Error: TPL-02'; die(); }
			
			$template_code = "";
			
			if ($template_id == "sf-home") {
				
				$template_code = "[blank_spacer height='70px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='first']
				
				[sf_iconbox image='ss-like' type='standard' title='Powerful yet simple' animation='pop-up' animation_delay='200'] Built for all levels of expertise, whether you need simple pages or complex ones, creating something incredible with Dante is an effortless and intuitive process.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3']
				
				[sf_iconbox image='ss-view' type='standard' title='Next-level features' animation='pop-up' animation_delay='400'] Dante comes packed with exciting &amp; unique features. Including full-screen native video, stunning fonts &amp; icons and a myriad of slick elements and animations.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='last']
				
				[sf_iconbox image='ss-man' type='standard' title='Fit for any purpose' animation='pop-up' animation_delay='600']Create anything; with 7 header types, 7 Portfolio layouts, 10 Blog layouts, lots of beautifully crafted standard pages, &amp; our robust page builder packing 44 elements.[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='20px' width='1/1' el_position='first last'] [portfolio_showcase title='Latest Projects' category='All' item_count='5' alt_background='alt-four' el_class='bb0 bt0 mb0' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-four' el_class='pb0 mt0 bt0 bb0 mb0 no-arrow' width='1/1' el_position='first last']
				<p style='text-align: center;'>[sf_button colour='transparent-dark' type='sf-icon-stroke' size='medium' link='/portfolio-one-column-standard-style/portfolio-three-standard/' target='_self' icon='ss-layergroup' dropshadow='no' extraclass='']VIEW ALL PROJECTS[/sf_button]</p>
				[/fullwidth_text] [blank_spacer height='86px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4' el_position='first']
				<p style='text-align: center;'>[icon image='ss-bezier' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='301873' speed='1000' refresh='25' textstyle='h6' subject='Pixels pushed.']
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4']
				<p style='text-align: center;'>[icon image='ss-mug' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='1448' speed='1500' refresh='25' textstyle='h6' subject='Cups of coffee consumed.']
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4']
				<p style='text-align: center;'>[icon image='ss-pizza' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='265' speed='2000' refresh='25' textstyle='h6' subject='Pizza's eaten.']
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4' el_position='last']
				<p style='text-align: center;'>[icon image='ss-write' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='95999' speed='2500' refresh='25' textstyle='h6' subject='Lines of code written.']
				
				[/spb_text_block] [blank_spacer height='46px' width='1/1' el_position='first last'] [spb_parallax parallax_type='video' bg_image='11555' bg_type='cover' bg_video_mp4='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_600_b_med.mp4' parallax_video_height='content-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='none' el_class='bt0 bb0 mt0 mb0 no-shadow' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Beautifully crafted with technical excellence </span>
				<span style='color: #ffffff;'>and exceptional attention to detail.</span></p>
				&nbsp;
				<p style='text-align: center;'>[sf_button colour='transparent-light' type='stroke-to-fill' size='large' link='/features/' target='_self' icon='' dropshadow='no' extraclass='']TELL ME MORE[/sf_button]</p>
				[/spb_parallax] [blank_spacer height='86px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/3' el_position='first']
				<p class='impact-text'><span style='color: #999999;'>A few things about Dante...</span></p>
				&nbsp;
				
				[sf_iconbox image='' character='1' type='left-icon' title='It's Mobile Ready' animation='fade-from-left' animation_delay='0']
				Built using the sleek, intuitive, and powerful Bootstrap framework. Its responsive, mobile first fluid grid system scales up to 12 columns as the device or viewport size increases.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='' character='2' type='left-icon' title='It's Retina-Ready' animation='fade-from-left' animation_delay='200']
				Designed &amp; built to look beautiful on any display, it's twice as nice on a retina device!
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='' character='3' type='left-icon' title='It's Well Supported' animation='fade-from-left' animation_delay='400']
				Whatever your level of expertise, our experienced support team are here to help you with any questions you might have.
				[/sf_iconbox]
				
				[/spb_text_block] [spb_single_image image='11129' image_size='full' frame='noframe' intro_animation='fade-from-right' full_width='no' lightbox='no' link_target='_self' width='2/3' el_position='last'] [spb_parallax parallax_type='image' bg_image='11444' bg_type='cover' parallax_video_height='content-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='none' el_class='bt0 bb0 mt0 mb0 no-shadow' width='1/1' el_position='first last']
				<p style='text-align: center;'>[sf_fullscreenvideo type='icon-button' btntext='' imageurl='' videourl='http://vimeo.com/35396305']</p>
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Full-screen video.</span></p>
				
				<h3 class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Dante supports native video playback for parallax backgrounds,</span>
				<span style='color: #ffffff;'> and it also allows you to play your videos full-screen.</span></h3>
				[hr]
				<p style='text-align: center;'>[sf_button colour='transparent-light' type='stroke-to-fill' size='large' link='/pages/about/' target='_self' icon='' dropshadow='no' extraclass='']ABOUT OUR COMPANY[/sf_button][sf_button colour='transparent-light' type='stroke-to-fill' size='large' link='/pages/contact/' target='_self' icon='' dropshadow='no' extraclass='']SAY HELLO[/sf_button]</p>
				[/spb_parallax] [fullwidth_text alt_background='alt-ten' el_class='mt0 mb0 bt0 bb0 no-shadow' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>A few of Dante's core features</h1>
				[/fullwidth_text] [blank_spacer height='75px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/3' el_position='first']
				
				[sf_iconbox image='ss-mouse' character='' type='left-icon-alt' title='Gizmo icons worth $50!' animation='fade-in' animation_delay='0']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-rows' character='' type='left-icon-alt' title='7 header layouts' animation='fade-in' animation_delay='600']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-layergroup' character='' type='left-icon-alt' title='Premium sliders' animation='fade-in' animation_delay='1200']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/3']
				
				[sf_iconbox image='ss-globe' character='' type='left-icon-alt' title='100% Translatable' animation='fade-in' animation_delay='200']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-cart' character='' type='left-icon-alt' title='Full shop functionality' animation='fade-in' animation_delay='800']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-write' character='' type='left-icon-alt' title='Swift Page Builder' animation='fade-in' animation_delay='1400']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/3' el_position='last']
				
				[sf_iconbox image='ss-columns' character='' type='left-icon-alt' title='Mega menu' animation='fade-in' animation_delay='400']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-newspaper' character='' type='left-icon-alt' title='10 blog layouts' animation='fade-in' animation_delay='1000']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-picture' character='' type='left-icon-alt' title='7 portfolio layouts' animation='fade-in' animation_delay='1600']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='0px' width='1/1' el_position='first last'] [fullwidth_text alt_background='none' el_class='pb0 pt0 mt0 mb0 bt0 bb0 no-shadow no-arrow' width='1/1' el_position='first last']
				
				[hr]
				<p style='text-align: center;'>[sf_button colour='gold' type='sf-icon-reveal' size='standard' link='/features/' target='_self' icon='ss-pointright' dropshadow='no' extraclass='']TAKE THE TOUR TO FIND OUT MORE[/sf_button]</p>
				[/fullwidth_text] [blank_spacer height='30px' width='1/1' el_position='first last'] [testimonial_slider title='What others are saying' text_size='large' item_count='6' order='rand' category='All' autoplay='no' alt_background='alt-four' el_class='bt0 bb0 mt0' width='1/1' el_position='first last'] [blank_spacer height='41px' width='1/1' el_position='first last'] [spb_text_block title='Meet our team' pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4' el_position='first']
				
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringill torquent per conubia nostra.
				
				[sf_button colour='accent' type='sf-icon-reveal' size='standard' link='/pages/meet-the-team/' target='_self' icon='ss-users' dropshadow='no' extraclass='ml0']FIND OUT MORE ABOUT US[/sf_button]
				
				&nbsp;
				
				[/spb_text_block] [team item_columns='3' item_count='3' category='All' pagination='no' el_class='mb0 pb0 mt0 pt0' width='3/4' el_position='last'] [blank_spacer height='13px' width='1/1' el_position='first last'] [divider type='thin' text='Go to top' full_width='yes' width='1/1' el_position='first last'] [blank_spacer height='53px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4' el_position='first']
				
				[sf_iconbox image='ss-signpost' character='' type='animated' title='Fully Documented' animation='none' animation_delay='200']
				Whether you're the kind of person who reads instruction manuals or not, we've written one that explains all of Dante's capabilities in intimate detail.
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4']
				
				[sf_iconbox image='ss-lightning' character='' type='animated' title='Lightning Quick' animation='none' animation_delay='200']Dante has been built to be incredibly rapid. The lightning quick Swift Framework has been optimised from the ground up, which means it's loved by users &amp; search engines alike.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4']
				
				[sf_iconbox image='ss-video' character='' type='animated' title='Tutorial Videos' animation='none' animation_delay='200']
				We've created a number of video tutorials to guide you through the finer points of how to get the best out of Dante.
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/4' el_position='last']
				
				[sf_iconbox image='ss-stopwatch' character='' type='animated' title='Quick &amp; Easy' animation='none' animation_delay='200']
				Getting started is easy. Install our demo content and you'll be on your way in no time at all.
				[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='73px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-home-2") {
			
				$template_code = "[blank_spacer height='70px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='first']
				
				[sf_iconbox image='ss-like' type='left-icon' title='Powerful yet simple' animation='fade-in' animation_delay='200']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3']
				
				[sf_iconbox image='ss-view' type='left-icon' title='Next-level features' animation='fade-in' animation_delay='400']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='last']
				
				[sf_iconbox image='ss-man' type='left-icon' title='Fit for any purpose' animation='fade-in' animation_delay='600']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='30px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='first']
				
				[sf_iconbox image='ss-chat' type='left-icon' title='Free Support &amp; updates' animation='fade-in' animation_delay='800']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3']
				
				[sf_iconbox image='ss-hand' type='left-icon' title='Gizmo icons worth $50!' animation='fade-in' animation_delay='1000']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='last']
				
				[sf_iconbox image='ss-write' type='left-icon' title='Swift Page Builder' animation='fade-in' animation_delay='1200']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='20px' width='1/1' el_position='first last'] [spb_parallax parallax_type='video' bg_image='11555' bg_type='cover' bg_video_mp4='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_600p.mp4' bg_video_webm='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_600p.webmhd.webm' bg_video_ogg='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_600p.ogv' parallax_video_height='content-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='none' el_class='bt0 bb0 no-shadow' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Beautifully crafted with technical excellence</span>
				<span style='color: #ffffff;'> and exceptional attention to detail.</span></p>
				&nbsp;
				<p style='text-align: center;'>[sf_button colour='white' type='standard' size='standard' link='/features/' target='_self' icon='' dropshadow='no' extraclass='']TELL ME MORE[/sf_button]  [sf_button colour='transparent-light' type='standard' size='standard' link='http://' target='_self' icon='' dropshadow='no' extraclass='']BUY NOW[/sf_button]</p>
				[/spb_parallax] [blank_spacer height='24px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>Our Latest Work</h1>
				[hr]
				
				[/spb_text_block] [portfolio display_type='gallery' columns='3' show_title='yes' show_subtitle='yes' show_excerpt='no' excerpt_length='20' item_count='6' category='All' portfolio_filter='no' pagination='no' el_class='mb0 pb0' width='1/1' el_position='first last'] [fullwidth_text alt_background='none' el_class='mt0 pb0 mb0 bt0 bb0 no-arrow' width='1/1' el_position='first last']
				<p style='text-align: center;'>[sf_button colour='accent' type='sf-icon-reveal' size='standard' link='/portfolio-one-column-standard-style/portfolio-three-gallery/' target='_self' icon='ss-view' dropshadow='no' extraclass='']VIEW OUR PORTFOLIO[/sf_button]</p>
				[/fullwidth_text] [blank_spacer height='40px' width='1/1' el_position='first last'] [clients_featured title='Selected Client List:' category='featured' alt_background='alt-four' el_class='mt0 mb0 bt0 bb0' width='1/1' el_position='first last'] [spb_parallax parallax_type='video' bg_image='11561' bg_type='cover' bg_video_mp4='http://dante.swiftideas.net/wp-content/uploads/2013/10/stars_600p.mp4' bg_video_webm='http://dante.swiftideas.net/wp-content/uploads/2013/10/stars_600p.webmhd.webm' bg_video_ogg='http://dante.swiftideas.net/wp-content/uploads/2013/10/stars_600p.ogv' parallax_video_height='content-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='none' el_class='bt0 bb0 mt0 mb0' width='1/1' el_position='first last']
				
				[one_third]
				
				[sf_iconbox image='ss-mouse' character='' type='boxed-one' title='Gizmo Icons worth $50!' animation='grow' animation_delay='0']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				[/one_third]
				[one_third]
				
				[sf_iconbox image='ss-layergroup' character='' type='boxed-one' title='Premium Sliders' animation='grow' animation_delay='200']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				[/one_third]
				[one_third_last]
				
				[sf_iconbox image='ss-globe' character='' type='boxed-one' title='100% Translatable' animation='grow' animation_delay='400']
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				[/sf_iconbox]
				
				[/one_third_last]
				
				[/spb_parallax] [blank_spacer height='85px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='first']
				<h1 class='mt0' style='text-align: left;'>Our Latest Articles</h1>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac.
				
				[sf_button colour='accent' type='sf-icon-reveal' size='standard' link='/blog-timeline-full-width/blog-masonry-effect-four/' target='_self' icon='ss-file' dropshadow='no' extraclass='']READ MORE ARTICLES[/sf_button]
				
				[/spb_text_block] [recent_posts item_columns='2' item_count='2' category='All' excerpt_length='23' width='2/3' el_position='last'] [blank_spacer height='30px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-home-3") {
			
				$template_code = "[blank_spacer height='72px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'>Latest Projects</p>
				<p class='impact-text' style='text-align: center;'>[hr]</p>
				<p style='text-align: center;'>Showing off your work has never been easier or more fun. Dante has 10 different
				Portfolio elements, capable of an even larger amount of variation.</p>
				[/spb_text_block] [blank_spacer height='40px' width='1/1' el_position='first last'] [portfolio display_type='standard' columns='3' show_title='yes' show_subtitle='yes' show_excerpt='no' excerpt_length='20' item_count='3' category='All' portfolio_filter='no' pagination='no' width='1/1' el_position='first last'] [blank_spacer height='40px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/1' el_position='first last']
				<p style='text-align: center;'>[sf_button colour='accent' type='sf-icon-reveal' size='large' link='/portfolio-one-column-standard-style/portfolio-three-standard/' target='_self' icon='ss-view' dropshadow='no' extraclass='']SEE MORE OF OUR WORK[/sf_button]</p>
				[/spb_text_block] [fullwidth_text alt_background='alt-four' el_class='bb0 mb0 no-shadow no-arrow' width='1/1' el_position='first last']
				<h3 class='impact-text-large' style='text-align: center;'></h3>
				<p class='impact-text-large' style='text-align: center;'>Brands &amp; Clients</p>
				<p style='text-align: center;'>[hr]</p>
				<p style='text-align: center;'>We work together with brands to craft strategies along with a unique and innovative digital approach.
				We thrive on collaborating with clients who are looking to push the limits and think outside the box.</p>
				[spb_single_image image='11316' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4' el_position='first'] [spb_single_image image='11315' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4'] [spb_single_image image='11322' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4'] [spb_single_image image='11318' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4' el_position='last'] [spb_single_image image='11317' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4' el_position='first'] [spb_single_image image='11323' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4'] [spb_single_image image='11324' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4'] [spb_single_image image='11320' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4' el_position='last']
				
				[/fullwidth_text] [spb_parallax parallax_type='image' bg_image='11444' bg_type='cover' parallax_video_height='video-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='alt-five' el_class='mt0 mb0 bt0 bb0' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>What we're about</span></p>
				&nbsp;
				
				[one_third]
				<p style='text-align: center;'><img class='alignnone size-full wp-image-11424' alt='about_3_col_icons_trans3' src='http://dante.swiftideas.net/wp-content/uploads/2013/06/about_3_col_icons_trans3.png' width='100' height='98' /></p>
				
				<h3 style='text-align: center;'>Strategy</h3>
				[hr]
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit.</p>
				<p style='text-align: center;'>[sf_button colour='white' type='sf-icon-reveal' size='standard' link='/pages/about/' target='_self' icon='ss-user' dropshadow='yes' extraclass='']ABOUT[/sf_button]</p>
				[/one_third]
				
				[one_third]
				<p style='text-align: center;'><img class='alignnone size-full wp-image-11425' alt='about_3_col_icons_trans2' src='http://dante.swiftideas.net/wp-content/uploads/2013/06/about_3_col_icons_trans2.png' width='100' height='98' /></p>
				
				<h3 style='text-align: center;'>Creativity</h3>
				[hr]
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit.</p>
				<p style='text-align: center;'>[sf_button colour='white' type='sf-icon-reveal' size='standard' link='/pages/services/' target='_self' icon='ss-write' dropshadow='yes' extraclass='']SERVICES[/sf_button]</p>
				[/one_third]
				
				[one_third_last]
				<p style='text-align: center;'><img class='alignnone size-full wp-image-11426' alt='about_3_col_icons_trans' src='http://dante.swiftideas.net/wp-content/uploads/2013/06/about_3_col_icons_trans.png' width='100' height='98' /></p>
				
				<h3 style='text-align: center;'>Technology</h3>
				[hr]
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit.</p>
				<p style='text-align: center;'>[sf_button colour='white' type='sf-icon-reveal' size='standard' link='http://dante.swiftideas.net/careers/' target='_self' icon='ss-man' dropshadow='yes' extraclass='']CAREERS[/sf_button]</p>
				[/one_third_last]
				
				[/spb_parallax] [blank_spacer height='72px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'>But wait, there's more</p>
				<p class='impact-text' style='text-align: center;'>[hr]</p>
				<p style='text-align: center;'>Showing off your work has never been easier or more fun. Dante has 10 different
				Portfolio elements, capable of an even larger amount of variation.</p>
				[/spb_text_block] [blank_spacer height='40px' width='1/1' el_position='first last'] [recent_posts item_columns='3' item_count='3' category='All' excerpt_length='22' el_class='mb0 pb0' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-home-4") {
			
				$template_code = "[blank_spacer height='70px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/3' el_position='first']
				
				[sf_iconbox image='ss-mouse' character='' type='left-icon-alt' title='Gizmo icons worth $50!' animation='fade-from-left' animation_delay='0']
				
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-rows' character='' type='left-icon-alt' title='7 header layouts' animation='fade-from-left' animation_delay='600']
				
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/3']
				
				[sf_iconbox image='ss-globe' character='' type='left-icon-alt' title='100% Translatable' animation='fade-from-bottom' animation_delay='200']
				
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-cart' character='' type='left-icon-alt' title='Full shop functionality' animation='fade-from-bottom' animation_delay='800']
				
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/3' el_position='last']
				
				[sf_iconbox image='ss-columns' character='' type='left-icon-alt' title='Mega menu' animation='fade-from-right' animation_delay='400']
				
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-newspaper' character='' type='left-icon-alt' title='10 blog layouts' animation='fade-from-right' animation_delay='1000']
				
				Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.
				
				[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='20px' width='1/1' el_position='first last'] [spb_parallax parallax_type='image' bg_image='11444' bg_type='cover' parallax_video_height='video-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='alt-five' el_class='bt0 bb0 no-shadow' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Who we are &amp; what we want</span></p>
				<p class='impact-text-large' style='text-align: center;'>[hr]</p>
				[/spb_parallax] [blank_spacer height='30px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				[one_third]
				
				[chart percentage='75' size='170' barcolour='#1dc6df' trackcolour='#f7f7f7' content='ss-share' align='left']
				<p style='text-align: center;'>[hr]</p>
				
				<h4 style='text-align: center;'>Strategy</h4>
				[/one_third]
				[one_third]
				
				[chart percentage='100' size='170' barcolour='#22d1c5' trackcolour='#f7f7f7' content='ss-lightbulb' align='left']
				<p style='text-align: center;'>[hr]</p>
				
				<h4 style='text-align: center;'>Creativity</h4>
				[/one_third]
				[one_third_last]
				
				[chart percentage='85' size='170' barcolour='#34ba87' trackcolour='#f7f7f7' content='ss-laptop' align='left']
				<p style='text-align: center;'>[hr]</p>
				
				<h4 style='text-align: center;'>Technology</h4>
				[/one_third_last]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='pt0 mt0' width='1/2' el_position='last']
				
				[dropcap3]L[/dropcap3] orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit.
				
				In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc , vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus.
				
				[sf_button colour='transparent-dark' type='standard' size='standard' link='/pages/about/' target='_self' icon='' dropshadow='no' extraclass='']ABOUT OUR COMPANY[/sf_button]
				
				[/spb_text_block] [blank_spacer height='4px' width='1/1' el_position='first last'] [spb_parallax parallax_type='image' bg_image='11449' bg_type='cover' parallax_video_height='video-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='alt-five' el_class='bt0 bb0 no-shadow' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Services we offer</span></p>
				<p style='text-align: center;'><span style='color: #ffffff;'>[hr]</span></p>
				[/spb_parallax] [blank_spacer height='34px' width='1/1' el_position='first last'] [spb_tabs width='1/1' el_position='first last'] [spb_tab title='Overview'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='pt0 mt0' width='1/2' el_position='first']
				
				[dropcap3]S[/dropcap3] orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate.
				
				Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit.
				
				[sf_button colour='transparent-dark' type='standard' size='standard' link='/pages/services/' target='_self' icon='' dropshadow='no' extraclass='']OUR SERVICES[/sf_button]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				[progress_bar percentage='100' name='Service One' value='100%' type='' colour='#1dc6df']
				
				[progress_bar percentage='90' name='Service Two' value='90%' type='' colour='#00d1c5']
				
				[progress_bar percentage='80' name='Service Three' value='80%' type='' colour='#37ba85']
				
				[progress_bar percentage='100' name='Service Four' value='100%' type='' colour='#1dc6df']
				
				[/spb_text_block] [/spb_tab] [spb_tab title='In-depth'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				[progress_bar percentage='100' name='Service One' value='100%' type='' colour='#1dc6df']
				
				[progress_bar percentage='90' name='Service Two' value='90%' type='' colour='#00d1c5']
				
				[progress_bar percentage='80' name='Service Three' value='80%' type='' colour='#37ba85']
				
				[progress_bar percentage='100' name='Service Four' value='100%' type='' colour='#1dc6df']
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='pt0 mt0' width='1/2' el_position='last']
				
				[dropcap3]G[/dropcap3] orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate.
				
				Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit.
				
				[/spb_text_block] [/spb_tab] [spb_tab title='Why choose us?'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='pt0 mt0' width='1/3' el_position='first']
				
				[dropcap3]F[/dropcap3] orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus.
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='pt0 mt0' width='1/3']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus.
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='pt0 mt0' width='1/3' el_position='last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus.
				
				[/spb_text_block] [/spb_tab] [/spb_tabs] [blank_spacer height='14px' width='1/1' el_position='first last'] [spb_parallax parallax_type='image' bg_image='11440' bg_type='cover' parallax_video_height='video-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='alt-five' el_class='mt0 bt0 bb0 no-shadow' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Where we work</span></p>
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>[hr]</span></p>
				[/spb_parallax] [blank_spacer height='34px' width='1/1' el_position='first last'] [sf_gallery gallery_id='11099' slider_transition='slide' show_captions='yes' width='1/2' el_position='first'] [spb_accordion active_section='0' width='1/2' el_position='last'] [spb_accordion_tab title='Section One'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0 pb0' width='1/1' el_position='first last']
				
				[dropcap3]Z[/dropcap3] orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante.
				
				[/spb_text_block] [/spb_accordion_tab] [spb_accordion_tab title='Section Two'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				[dropcap3]Z[/dropcap3] orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante.
				
				[/spb_text_block] [/spb_accordion_tab] [spb_accordion_tab title='Section Three'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				[dropcap3]Z[/dropcap3] orem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante.
				
				[/spb_text_block] [/spb_accordion_tab] [/spb_accordion] [blank_spacer height='44px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-home-5") {
			
				$template_code = "[blank_spacer height='20px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'>Hot News.</p>
				&nbsp;
				
				[/spb_text_block] [recent_posts item_columns='3' item_count='3' category='All' excerpt_length='23' width='1/1' el_position='first last'] [blank_spacer height='60px' width='1/1' el_position='first last'] [spb_parallax parallax_type='video' bg_image='11555' bg_type='cover' bg_video_mp4='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_600p.mp4' bg_video_webm='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_600p.webmhd.webm' bg_video_ogg='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_600p.ogv' parallax_video_height='content-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='none' el_class='mt0 bt0 mb0 bb0' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Choose your corner, pick away at it
				carefully, intensely and to the best of your ability
				and that way you might change the world.</span></p>
				[hr]
				<h3 style='text-align: center;'><span style='color: #ffffff;'>Ray Eames</span></h3>
				[/spb_parallax] [blank_spacer height='86px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'>Our Work.</p>
				&nbsp;
				
				[/spb_text_block] [portfolio display_type='gallery' columns='3' show_title='yes' show_subtitle='yes' show_excerpt='no' excerpt_length='20' item_count='9' category='All' portfolio_filter='no' pagination='no' el_class='mb0 pb0' width='1/1' el_position='first last'] [fullwidth_text alt_background='none' el_class='mt0 pb0 mb0 bt0 bb0 no-arrow' width='1/1' el_position='first last']
				<p style='text-align: center;'>[sf_button colour='accent' type='sf-icon-reveal' size='standard' link='/portfolio-one-column-standard-style/portfolio-three-gallery/' target='_self' icon='ss-view' dropshadow='no' extraclass='']VIEW OUR PORTFOLIO[/sf_button]</p>
				[/fullwidth_text] [blank_spacer height='40px' width='1/1' el_position='first last'] [clients_featured title='Selected Client List:' category='featured' alt_background='alt-four' el_class='mt0 mb0 bt0 bb0' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-five' el_class='mt0 mb0 bt0 bb0 no-shadow' width='1/1' el_position='first last']
				
				&nbsp;
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Our Approach</span></p>
				
				<h3 style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam
				massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis
				Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla.</h3>
				&nbsp;
				
				[/fullwidth_text] [blank_spacer height='86px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='first']
				
				[sf_iconbox image='' character='1' type='standard' title='Brief' animation='pop-up' animation_delay='0'] Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='' character='2' type='standard' title='Analysis' animation='pop-up' animation_delay='200']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='' character='3' type='standard' title='Planning' animation='pop-up' animation_delay='400']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='last']
				
				[sf_iconbox image='' character='4' type='standard' title='Execution' animation='pop-up' animation_delay='600']Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nunc dui, tristique in semper vel.[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='76px' width='1/1' el_position='first last'] [spb_parallax parallax_type='image' bg_image='11431' bg_type='cover' parallax_video_height='video-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='none' el_class='mt0 mb0 bt0 bb0 no-arrow' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Solutions &amp; Services.</span></p>
				
				<h3 style='text-align: center;'>[icon image='fa-angle-down' character='' size='large' cont='no' float='none']</h3>
				[/spb_parallax] [fullwidth_text alt_background='alt-ten' el_class='mt0 mb0 bt0 bb0 no-arrow' width='1/1' el_position='first last']
				
				&nbsp;
				
				[one_fourth]
				
				[sf_iconbox image='ss-share' character='' type='animated' title='Strategy' animation='none' animation_delay='200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-smartphone' character='' type='animated' title='Mobile' animation='none' animation_delay='200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				[/sf_iconbox]
				
				[/one_fourth]
				[one_fourth]
				
				[sf_iconbox image='ss-mouse' character='' type='animated' title='Technology' animation='none' animation_delay='200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-usergroup' character='' type='animated' title='Marketing' animation='none' animation_delay='200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				[/sf_iconbox]
				
				[/one_fourth]
				[one_fourth]
				
				[sf_iconbox image='ss-video' character='' type='animated' title='Motion' animation='none' animation_delay='200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-piechart' character='' type='animated' title='Analytics' animation='none' animation_delay='200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				[/sf_iconbox]
				
				[/one_fourth]
				[one_fourth_last]
				
				[sf_iconbox image='ss-chat' character='' type='animated' title='Social' animation='none' animation_delay='200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-bezier' character='' type='animated' title='Design &amp; UX' animation='none' animation_delay='200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				[/sf_iconbox]
				
				[/one_fourth_last]
				
				&nbsp;
				
				[/fullwidth_text] [blank_spacer height='46px' width='1/1' el_position='first last'] [blank_spacer height='46px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0 no-arrow' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'>Our Team.</p>
				&nbsp;
				
				[/spb_text_block] [team item_columns='3' item_count='3' category='All' pagination='no' width='1/1' el_position='first last'] [blank_spacer height='26px' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-five' el_class='bt0 bb0 no-arrow mb0' width='1/1' el_position='first last']
				
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-bezier' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='301873' speed='1000' refresh='25' textstyle='h6' subject='Pixels pushed.']
				
				[/one_fourth]
				
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-mug' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='1448' speed='1500' refresh='25' textstyle='h6' subject='Cups of coffee consumed.']
				
				[/one_fourth]
				
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-pizza' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='265' speed='2000' refresh='25' textstyle='h6' subject='Pizza's eaten.']
				
				[/one_fourth]
				
				[one_fourth_last]
				<p style='text-align: center;'>[icon image='ss-write' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='95999' speed='2500' refresh='25' textstyle='h6' subject='Lines of code written.']
				
				[/one_fourth_last]
				
				[/fullwidth_text] [testimonial_slider title='What our clients say' text_size='large' item_count='6' order='date' category='All' autoplay='yes' alt_background='alt-four' el_class='bt0 bb0 mb0 mt0 no-arrow' width='1/1' el_position='first last'] [blank_spacer height='96px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'>Get In Touch.</p>
				
				<h3 style='text-align: center;'>[hr]</h3>
				&nbsp;
				
				[/spb_text_block] [spb_gmaps address='London' size='400' type='roadmap' zoom='14' color='#02759b' saturation='color' pin_image='11338' fullscreen='yes' el_class='mb0' width='1/1' el_position='first last'] [blank_spacer height='81px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='yes' pb_border_bottom='no' width='3/4' el_position='first']
				
				[contact-form-7 id='1183' title='Contact form 1']
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='last']
				<h3 class='mt0'>Address</h3>
				<p class='mt0'>Apple Computer Inc
				1 Infinite Loop
				Cupertino CA
				95014</p>
				
				<h3>Contact details</h3>
				Email: <a href='#' target='_blank'>youremail@yourdomain.com
				</a>Twitter: <a href='https://twitter.com/swiftIdeas'>@SwiftIdeas
				</a>Phone: +44 (0) 208 0000 000
				Fax: +44 (0) 208 0000 001
				<h3>Stay social</h3>
				[social]
				
				[/spb_text_block] [blank_spacer height='57px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-home-6") {
			
				$template_code = "[blank_spacer height='60px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='first']
				
				[sf_iconbox image='ss-like' type='standard-title' title='Powerful yet simple' animation='fade-from-bottom' animation_delay='200'] Built for all levels of expertise, whether you need simple pages or complex ones, creating something incredible with Dante is an effortless and intuitive process.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-view' type='standard-title' title='Next-level features' animation='fade-from-bottom' animation_delay='400'] Dante comes packed with exciting &amp; unique features. Including full-screen native video, stunning fonts &amp; icons and lots of slick elements &amp; animations.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-man' type='standard-title' title='Fit for any purpose' animation='fade-from-bottom' animation_delay='600']Create anything; with 7 header types, 7 Portfolio layouts, 10 Blog layouts, lots of beautifully crafted standard pages, &amp; our robust page builder packing 44 elements.[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='last']
				
				[sf_iconbox image='ss-chat' type='standard-title' title='Free Support &amp; updates' animation='fade-from-bottom' animation_delay='800']Our experienced support team prides itself on quick response times. Whatever your level of expertise, we're here to help you with any questions you might have.[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='30px' width='1/1' el_position='first last'] [portfolio_carousel title='Recent Work' item_count='6' category='All' alt_background='alt-four' el_class='bt0 bb0' width='1/1' el_position='first last'] [blank_spacer height='43px' width='1/1' el_position='first last'] [impact_text include_button='yes' button_style='standard' title='PURCHASE NOW' color='accent' target='_self' position='cta_align_right' alt_background='none' el_class='mt0 bt0 bb0' width='1/1' el_position='first last']
				<h1 class='mt0 mb0'>Dante has been painstakingly crafted with technical
				excellence and exceptional attention to detail.</h1>
				[/impact_text] [blank_spacer height='74px' width='1/1' el_position='first last'] [posts_carousel title='Latest Articles' item_count='6' category='All' show_title='yes' show_excerpt='yes' show_details='yes' excerpt_length='17' width='3/4' el_position='first'] [testimonial_carousel title='Testimonials' item_count='6' order='date' category='All' page_link='no' width='1/4' el_position='last'] [blank_spacer height='40px' width='1/1' el_position='first last'] [clients_featured title='Selected Client List' category='featured' alt_background='alt-four' el_class='mb0 bt0 bb0' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-home-7") {
			
				$template_code = "[fullwidth_text alt_background='alt-four' el_class='bt0 bb0 mb0 mt0 no-arrow' width='1/1' el_position='first last']
				
				[sf_countdown year='2014' month='4' day='13' fontsize='large' displaytext='Until our amazing sale begins!']
				
				[/fullwidth_text] [blank_spacer height='70px' width='1/1' el_position='first last'] [spb_products title='New Arrivals' asset_type='latest-products' carousel='yes' product_size='standard' item_count='6' width='1/1' el_position='first last'] [blank_spacer height='72px' width='1/1' el_position='first last'] [supersearch el_class='mt0 mb0 bt0 bb0' width='1/1' el_position='first last'] [blank_spacer height='66px' width='1/1' el_position='first last'] [spb_products_mini title='Best Sellers' asset_type='best-sellers' item_count='3' width='1/4' el_position='first'] [spb_products_mini title='Top Rated' asset_type='top-rated' item_count='3' width='1/4'] [spb_products_mini title='Sale Items' asset_type='sale-products' item_count='3' width='1/4'] [posts_carousel title='Latest Articles' item_count='2' category='All' show_title='yes' show_excerpt='yes' show_details='no' excerpt_length='12' width='1/4' el_position='last'] [blank_spacer height='26px' width='1/1' el_position='first last'] [tweets_slider title='Tweets from the shop floor' twitter_username='@swiftideas' text_size='large' tweets_count='6' autoplay='yes' alt_background='alt-four' el_class='mb0 bt0 bb0' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-home-8") {
			
				$template_code = "[spb_parallax parallax_type='video' bg_image='11558' bg_type='cover' bg_video_mp4='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_1080p1.mp4' bg_video_webm='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_1080p.webmhd.webm' bg_video_ogg='http://dante.swiftideas.net/wp-content/uploads/2013/10/crafted_1080p.ogv' parallax_video_height='video-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='none' el_class='mt0 bt0 mb0 bb0' width='1/1' el_position='first last']
				<div style='width: 100%; height: 80px;'></div>
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Beautifully crafted with technical excellence</span>
				<span style='color: #ffffff;'>and exceptional attention to detail.</span></p>
				[hr]
				<p style='text-align: center;'>[sf_button colour='transparent-light' type='stroke-to-fill' size='large' link='/features/' target='_self' icon='' dropshadow='no' extraclass='']TELL ME MORE[/sf_button]</p>
				&nbsp;
				
				[/spb_parallax] [blank_spacer height='70px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mt0 pt0' width='1/1' el_position='first last']
				
				&nbsp;
				<p class='impact-text-large' style='text-align: center;'>Our Work</p>
				<p class='impact-text' style='text-align: center;'>[hr]</p>
				
				<h3 style='text-align: center;'>We partner with entrepreneurs, visionaries and business leaders to develop
				and design values-driven brands. We are strategically led, with a focus on
				expressing a core idea from start to finish.</h3>
				&nbsp;
				
				[/spb_text_block] [blank_spacer height='50px' width='1/1' el_position='first last'] [portfolio_showcase category='graphic-design' item_count='5' alt_background='none' el_class='bb0 bt0 mb0 pb0 mb0 no-shadow' width='1/1' el_position='first last'] [portfolio_showcase category='logo-design' item_count='5' alt_background='none' el_class='bb0 bt0 mb0 mt0 pt0 no-shadow' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-five' el_class='mt0 mb0 bt0 bb0 no-shadow no-arrow' width='1/1' el_position='first last']
				
				&nbsp;
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Our Approach</span></p>
				[hr]
				<h3 style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam
				massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis
				Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis.
				Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst.
				Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue,
				quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel.</h3>
				&nbsp;
				
				[/fullwidth_text] [spb_parallax parallax_type='image' bg_image='11423' bg_type='cover' parallax_video_height='video-height' parallax_video_overlay='none' parallax_image_height='window-height' alt_background='none' el_class='bt0 bb0 mb0 mt0 no-shadow' width='1/1' el_position='first last']
				
				&nbsp;
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>If you want to take it to the next level,</span>
				<span style='color: #ffffff;'>you came to the right place.</span></p>
				<p style='text-align: center;'><span style='color: #ffffff;'>[hr]</span></p>
				<p style='text-align: center;'><span style='color: #ffffff;'>[sf_button colour='transparent-light' type='standard' size='large' link='/features/' target='_self' icon='' dropshadow='no' extraclass='']TELL ME MORE[/sf_button]</span></p>
				&nbsp;
				
				[/spb_parallax] [fullwidth_text alt_background='none' el_class='mt0 mb0 bt0 bb0 no-shadow no-arrow' width='1/1' el_position='first last']
				
				&nbsp;
				<p class='impact-text-large' style='text-align: center;'><span style='color: #888888;'>Our Beliefs</span></p>
				[hr]
				<h3 style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam
				massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis
				Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis.
				Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst.
				Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue,
				quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel.</h3>
				&nbsp;
				
				[/fullwidth_text] [fullwidth_text alt_background='alt-five' el_class='mt0 mb0 bt0 bb0 no-shadow no-arrow' width='1/1' el_position='first last']
				
				&nbsp;
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Our Services</span></p>
				&nbsp;
				
				[one_fourth]
				[sf_iconbox image='ss-share' character='' type='animated' title='Strategy' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-smartphone' character='' type='animated' title='Mobile' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/one_fourth]
				[one_fourth]
				
				[sf_iconbox image='ss-bezier' character='' type='animated' title='Design &amp; UX' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-video' character='' type='animated' title='Motion' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/one_fourth]
				[one_fourth]
				
				[sf_iconbox image='ss-mouse' character='' type='animated' title='Technology' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-usergroup' character='' type='animated' title='Marketing' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/one_fourth]
				[one_fourth_last]
				
				[sf_iconbox image='ss-chat' character='' type='animated' title='Social' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='ss-piechart' character='' type='animated' title='Analytics' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/one_fourth_last]
				
				&nbsp;
				
				[/fullwidth_text] [spb_parallax parallax_type='image' bg_image='11429' bg_type='cover' parallax_video_height='video-height' parallax_video_overlay='none' parallax_image_height='content-height' alt_background='none' el_class='mb0 mt0 bt0 bb0 no-shadow no-arrow' width='1/1' el_position='first last']
				
				&nbsp;
				<p style='text-align: center;'>[sf_fullscreenvideo type='icon-button' btntext='' imageurl='' videourl='http://vimeo.com/35396305' extraclass='']</p>
				<p class='impact-text-large' style='text-align: center;'><span style='color: #ffffff;'>Watch Our Demo Reel</span></p>
				<p style='text-align: center;'><span style='color: #ffffff;'>[hr]</span></p>
				
				<h3 style='text-align: center;'><span style='color: #ffffff;'>Suspendisse bibendum cursus luctus. Donec consequat malesuada</span>
				<span style='color: #ffffff;'>felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit.</span></h3>
				&nbsp;
				
				[/spb_parallax] [fullwidth_text alt_background='alt-four' el_class='bb0 bt0 mt0 mb0 no-shadow no-arrow' width='1/1' el_position='first last']
				<h3 class='impact-text-large' style='text-align: center;'></h3>
				&nbsp;
				<p class='impact-text-large' style='text-align: center;'>Brands &amp; Clients</p>
				<p style='text-align: center;'>[hr]</p>
				
				<h3 style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam
				massa quis mauris sollicitudin commodo venenatis ligula commodo.</h3>
				&nbsp;
				
				[spb_single_image image='11316' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4' el_position='first'] [spb_single_image image='11315' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4'] [spb_single_image image='11322' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4'] [spb_single_image image='11318' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4' el_position='last'] [spb_single_image image='11317' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4' el_position='first'] [spb_single_image image='11323' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4'] [spb_single_image image='11324' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4'] [spb_single_image image='11320' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' width='1/4' el_position='last']
				
				&nbsp;
				
				[/fullwidth_text]";
				
			} else if ($template_id == "sf-about") {
			
				$template_code = "[blank_spacer height='3px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>Engaging with your audience,
				that's what we're here for.</h1>
				[hr]
				[one_third]
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna.
				
				[/one_third]
				
				[one_third]
				
				Quisque nec nisi tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non.
				
				[/one_third]
				
				[one_third_last]
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna.
				
				[/one_third_last]
				
				[/spb_text_block] [fullwidth_text alt_background='alt-four' el_class='bt0 bb0 no-arrow' width='1/1' el_position='first last']
				
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-bezier' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='301873' speed='1000' refresh='25' textstyle='h6' subject='Pixels pushed.']
				
				[/one_fourth]
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-mug' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='1448' speed='1500' refresh='25' textstyle='h6' subject='Cups of coffee consumed.']
				
				[/one_fourth]
				
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-pizza' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='265' speed='2000' refresh='25' textstyle='h6' subject='Pizza's eaten.']
				
				[/one_fourth]
				
				[one_fourth_last]
				<p style='text-align: center;'>[icon image='ss-write' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='95999' speed='2500' refresh='25' textstyle='h6' subject='Lines of code written.']
				
				[/one_fourth_last]
				
				[/fullwidth_text] [blank_spacer height='60px' width='1/1' el_position='first last'] [spb_text_block title='Industries served' pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0 pb0' width='3/4' el_position='first']
				
				[progress_bar percentage='70' name='Food &amp; Beverage' value='' type='' colour='#1dc6df']
				
				[progress_bar percentage='85' name='Education' value='' type='' colour='#1dc6df']
				
				[progress_bar percentage='100' name='Fashion' value='' type='' colour='#1dc6df']
				
				[progress_bar percentage='80' name='Entertainment' value='' type='' colour='#1dc6df']
				
				[progress_bar percentage='70' name='Health' value='' type='' colour='#1dc6df']
				
				[progress_bar percentage='100' name='Publishing' value='' type='' colour='#1dc6df']
				
				[progress_bar percentage='100' name='Technology' value='' type='' colour='#1dc6df']
				
				[progress_bar percentage='50' name='Travel' value='' type='' colour='#1dc6df]
				
				[progress_bar percentage='35' name='Financial' value='' type='' colour='#1dc6df']
				
				&nbsp;
				
				[sf_button colour='white' type='sf-icon-stroke' size='large' link='http://' target='_self' icon='ss-barchart' dropshadow='no' extraclass='']SEE OUR STATISTICS[/sf_button]
				
				[/spb_text_block] [fullwidth_text alt_background='none' el_class='mt0 pt0 mb0 pb0' width='1/4' el_position='last']
				
				[sf_iconbox image='ss-users' character='' type='standard' title='50 People' animation='fade-from-bottom' animation_delay='0']
				[/sf_iconbox]
				
				[sf_iconbox image='ss-location' character='' type='standard' title='5 Locations' animation='fade-from-bottom' animation_delay='400']
				[/sf_iconbox]
				
				[sf_iconbox image='ss-lightbulb' character='' type='standard' title='Infinite Ideas' animation='fade-from-bottom' animation_delay='800']
				[/sf_iconbox]
				
				[/fullwidth_text] [blank_spacer height='20px' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-four' el_class='mb0 btw bb0 pb0 no-arrow' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>6 Reasons for us to work together</h1>
				[one_third]
				[sf_iconbox image='' character='1' type='boxed-two' title='Clients become friends' animation='pop-up' animation_delay='0']
				Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat.
				[/sf_iconbox]
				
				[/one_third]
				[one_third]
				[sf_iconbox image='' character='2' type='boxed-two' title='We're 100% Independent' animation='pop-up' animation_delay='200']
				Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat.
				[/sf_iconbox]
				
				[/one_third]
				[one_third_last]
				[sf_iconbox image='' character='3' type='boxed-two' title='We know how to party' animation='pop-up' animation_delay='400']
				Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat.
				[/sf_iconbox]
				[/one_third_last]
				[one_third]
				
				[sf_iconbox image='' character='4' type='boxed-two' title='We're diligent' animation='pop-up' animation_delay='600']Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat.
				
				[/sf_iconbox]
				[/one_third]
				[one_third]
				[sf_iconbox image='' character='5' type='boxed-two' title='We're talented' animation='pop-up' animation_delay='800']Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat.
				
				[/sf_iconbox]
				[/one_third]
				[one_third_last]
				[sf_iconbox image='' character='6' type='boxed-two' title='We intelligent' animation='pop-up' animation_delay='1000']Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat.
				
				[/sf_iconbox]
				[/one_third_last]
				
				&nbsp;
				
				[/fullwidth_text] [fullwidth_text alt_background='alt-ten' el_class='mt0 bt0 bb0 no-shadow' width='1/1' el_position='first last']
				
				[sf_countdown year='2014' month='1' day='24' fontsize='large' displaytext='Until our team releases our next project.']
				
				[/fullwidth_text] [blank_spacer height='44px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>We are Dante</h1>
				<p style='text-align: center;'>This is our dedicated team who work day-in and day-out together to
				bring our clients the most amazing projects for a digitally connected world.</p>
				<p style='text-align: center;'>[hr]</p>
				[/spb_text_block] [team item_columns='3' item_count='6' category='All' pagination='no' width='1/1' el_position='first last'] [blank_spacer height='43px' width='1/1' el_position='first last'] [testimonial_slider title='What are clients say about us' text_size='large' item_count='6' order='date' category='All' autoplay='yes' alt_background='alt-four' el_class='mt0 bb0 bt0 no-arrow' width='1/1' el_position='first last'] [blank_spacer height='13px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>Brands &amp; Clients</h1>
				<p style='text-align: center;'>[hr]</p>
				[/spb_text_block] [clients item_count='12' category='carousel' carousel_auto='no' pagination='no' width='1/1' el_position='first last'] [blank_spacer height='80px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-about-2") {
			
				$template_code = "[blank_spacer height='80px' width='1/1' el_position='first last'] [sf_gallery gallery_id='11099' slider_transition='slide' show_captions='yes' width='1/2' el_position='first'] [spb_text_block title='Welcome to Dante' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna.
				
				Quisque nec nisi tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor.
				
				[/spb_text_block] [fullwidth_text alt_background='alt-four' el_class='bt0 bb0 pt0 no-arrow' width='1/1' el_position='first last']
				
				[one_fourth]
				<p style='text-align: center;'>[chart percentage='85' size='170' barcolour='#1dc6df' trackcolour='#e4e4e4' content='95,000' align='center']</p>
				
				<h6 style='text-align: center;'>Click throughs.</h6>
				[/one_fourth]
				[one_fourth]
				<p style='text-align: center;'>[chart percentage='75' size='170' barcolour='#1dc6df' trackcolour='#e4e4e4' content='ss-view' align='center']</p>
				
				<h6 style='text-align: center;'>95k Page Views</h6>
				[/one_fourth]
				[one_fourth]
				<p style='text-align: center;'>[chart percentage='60%' size='170' barcolour='#1dc6df' trackcolour='#e4e4e4' content='ss-like' align='center']</p>
				
				<h6 style='text-align: center;'>Projects complete.</h6>
				[/one_fourth]
				[one_fourth_last]
				<p style='text-align: center;'>[chart percentage='50' size='170' barcolour='#1dc6df' trackcolour='#e4e4e4' content='15%' align='center']</p>
				
				<h6 style='text-align: center;'>Referral rate.</h6>
				[/one_fourth_last]
				
				[/fullwidth_text] [blank_spacer height='60px' width='1/1' el_position='first last'] [spb_tabs tab_asset_title='Why choose us?' width='1/3' el_position='first'] [spb_tab title='Approach'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie, nulla orci consequat leo, vitae commodo odio lectus vitae lacus. Morbi sed dictum diam. Aenean et ipsum eget leo auctor dignissim. Maecenas tincidunt dictum nibh.
				
				[/spb_text_block] [/spb_tab] [spb_tab title='Support'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
				
				[/spb_text_block] [/spb_tab] [spb_tab title='Capabilities'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie, nulla orci consequat leo, vitae commodo odio lectus vitae lacus. Morbi sed dictum diam. Aenean et ipsum eget leo auctor dignissim. Maecenas tincidunt dictum nibh, at interdum lorem interdum ut.
				
				[/spb_text_block] [/spb_tab] [spb_tab title=''] [/spb_tab] [/spb_tabs] [spb_accordion widget_title='More about us' width='1/3'] [spb_accordion_tab title='Who we are'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
				
				[/spb_text_block] [/spb_accordion_tab] [spb_accordion_tab title='What we do'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
				
				[/spb_text_block] [/spb_accordion_tab] [spb_accordion_tab title='Why we do it'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
				
				[/spb_text_block] [/spb_accordion_tab] [spb_accordion_tab title='Where we do it'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
				
				[/spb_text_block] [/spb_accordion_tab] [/spb_accordion] [spb_text_block title='Capabilities' pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='last']
				
				[progress_bar percentage='100' name='Illustration' value='100%' type='' colour='#1dc6df']
				
				[progress_bar percentage='80' name='Photoshop' value='80%' type='' colour='#1dc6df']
				
				[progress_bar percentage='70' name='After Effects' value='70%' type='' colour='#1dc6df']
				
				[progress_bar percentage='100' name='Branding' value='100%' type='' colour='#1dc6df']
				
				[progress_bar percentage='100' name='Marketing' value='100%' type='' colour='#1dc6df']
				
				[/spb_text_block] [blank_spacer height='20px' width='1/1' el_position='first last'] [testimonial_slider title='What our clients say about us' text_size='large' item_count='6' order='rand' category='All' autoplay='yes' alt_background='alt-four' el_class='mt0 bt0 no-arrow' width='1/1' el_position='first last'] [blank_spacer height='20px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>We are Dante</h1>
				<p style='text-align: center;'>This is our dedicated team who work day-in and day-out together to
				bring our clients the most amazing projects for a digitally connected world.</p>
				[hr]
				
				[/spb_text_block] [team_carousel category='All' excerpt_length='16' width='1/1' el_position='first last'] [blank_spacer height='23px' width='1/1' el_position='first last'] [clients_featured title='Selected Client List' category='featured' alt_background='alt-four' el_class='bb0 mb0 no-shadow' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-careers") {
			
				$template_code = "[blank_spacer height='10px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				&nbsp;
				<h1 style='text-align: center;'>Meet a few of our team members
				and find out what it's like to work here.</h1>
				[hr]
				
				&nbsp;
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='first']
				
				&nbsp;
				
				[sf_fullscreenvideo type='image-button' btntext='' imageurl='http://dante.swiftideas.net/wp-content/uploads/2013/10/dante_career_video_1d.jpg' videourl='http://vimeo.com/35396305' extraclass='']
				<h3>Oliver Matthews
				<span style='color: #999999;'>Technical Director</span></h3>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque
				
				&nbsp;
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3']
				
				&nbsp;
				
				[sf_fullscreenvideo type='image-button' btntext='' imageurl='http://dante.swiftideas.net/wp-content/uploads/2013/10/dante_career_video_2.jpg' videourl='http://vimeo.com/35396305' extraclass='']
				<h3>Claire Cosgrove
				<span style='color: #999999;'>Marketing Director</span></h3>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque
				
				&nbsp;
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='last']
				
				&nbsp;
				
				[sf_fullscreenvideo type='image-button' btntext='' imageurl='http://dante.swiftideas.net/wp-content/uploads/2013/10/dante_career_video_3.jpg' videourl='http://vimeo.com/35396305' extraclass='']
				<h3>Melissa Munari
				<span style='color: #999999;'>Account Director</span></h3>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque
				
				&nbsp;
				
				[/spb_text_block] [blank_spacer height='10px' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-four' el_class='bt0 bb0 no-arrow' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>Welcome to the big time.</h1>
				<h3 class='mt0' style='text-align: center;'>A few of the things you can expect from working here.</h3>
				[hr]
				<div style='height: 20px;'></div>
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-star' character='' size='large' cont='no' float='none']</p>
				
				<h3 style='text-align: center;'>Present Money</h3>
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula.</p>
				[/one_fourth]
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-sun' character='' size='large' cont='no' float='none']</p>
				
				<h3 style='text-align: center;'>Summer Hours</h3>
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula.</p>
				[/one_fourth]
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-globe' character='' size='large' cont='no' float='none']</p>
				
				<h3 style='text-align: center;'>Travel Budget</h3>
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula.</p>
				[/one_fourth]
				[one_fourth_last]
				<p style='text-align: center;'>[icon image='ss-egg' character='' size='large' cont='no' float='none']</p>
				
				<h3 style='text-align: center;'>Breakfast Daily</h3>
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula.</p>
				[/one_fourth_last]
				
				[/fullwidth_text] [blank_spacer height='65px' width='1/1' el_position='first last'] [spb_text_block title='Work in one of 4 amazing locations' pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0' width='2/3' el_position='first']
				
				&nbsp;
				
				[one_half]
				[spb_gmaps address='London' size='270' type='roadmap' zoom='15' saturation='color' pin_image='11338' fullscreen='no' width='1/1' el_position='first last']
				[spb_gmaps address='Berlin' size='270' type='roadmap' zoom='15' saturation='color' pin_image='11338' fullscreen='no' width='1/1' el_position='first last']
				
				[/one_half]
				[one_half_last]
				
				[spb_gmaps address='New York' size='270' type='roadmap' zoom='15' saturation='color' pin_image='11338' fullscreen='no' width='1/1' el_position='first last']
				[spb_gmaps address='Shanghai' size='270' type='roadmap' zoom='15' saturation='color' pin_image='11338' fullscreen='no' width='1/1' el_position='first last']
				
				[/one_half_last]
				
				&nbsp;
				
				[/spb_text_block] [jobs title='Current Job Openings' item_count='3' order='date' category='All' pagination='no' el_class='mb0' width='1/3' el_position='last'] [blank_spacer height='15px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-contact") {
			
				$template_code = "[spb_gmaps address='London' size='450' type='roadmap' zoom='14' saturation='color' pin_image='11338' fullscreen='yes' width='1/1' el_position='first last'] [blank_spacer height='60px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='yes' pb_border_bottom='no' width='2/3' el_position='first']
				
				[contact-form-7 id='9150' title='Contact form 1']
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='last']
				<h3 class='mt0'>Address</h3>
				Apple Computer Inc
				1 Infinite Loop
				Cupertino CA
				95014
				<h3>Contact details</h3>
				Email: <a href='#' target='_blank'>youremail@yourdomain.com
				</a>Twitter: <a href='https://twitter.com/swiftIdeas'>@SwiftIdeas</a>
				Phone: +44 (0) 208 0000 000
				Fax: +44 (0) 208 0000 001
				<h3>Stay social</h3>
				[social size='large']
				
				[/spb_text_block] [blank_spacer height='31px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-contact-2") {
			
				$template_code = "[spb_gmaps address='London' size='550' type='roadmap' zoom='14' color='#02759b' saturation='color' pin_image='11338' fullscreen='yes' el_class='mb0' width='1/1' el_position='first last'] [spb_parallax parallax_type='image' bg_image='10986' bg_type='cover' parallax_video_height='video-height' parallax_image_height='content-height' alt_background='alt-three' el_class='mt0 bt0 bb0 no-shadow no-arrow' width='1/1' el_position='first last']
				
				[one_third]
				
				[sf_iconbox image='ss-chat' character='' type='boxed-three' title='Live chat' animation='pop-up' animation_delay='200']
				Weekdays 9am to 6pm GMT
				<a href='#'>Join live chat
				</a>[/sf_iconbox]
				
				[/one_third]
				[one_third]
				
				[sf_iconbox image='ss-mail' character='' type='boxed-three' title='Email Us' animation='pop-up' animation_delay='600']
				Email <a href='#'>youremail@yourdomain.com</a>
				Or fill out the form below.
				[/sf_iconbox]
				
				[/one_third]
				[one_third_last]
				
				[sf_iconbox image='ss-phone' character='' type='boxed-three' title='Call Us' animation='pop-up' animation_delay='1000']
				Call +44 (0) 208 0000 000
				Weekdays 9am to 6pm GMT
				[/sf_iconbox]
				
				[/one_third_last]
				
				[/spb_parallax] [blank_spacer height='41px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='yes' pb_border_bottom='no' width='3/4' el_position='first']
				
				[contact-form-7 id='1183' title='Contact form 1']
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='last']
				<h3 class='mt0'>Address</h3>
				Apple Computer Inc
				1 Infinite Loop
				Cupertino CA
				95014
				<h3>Contact details</h3>
				Email: <a href='#' target='_blank'>youremail@yourdomain.com
				</a>Twitter: <a href='https://twitter.com/swiftIdeas'>@SwiftIdeas
				</a>Phone: +44 (0) 208 0000 000
				Fax: +44 (0) 208 0000 001
				<h3>Stay social</h3>
				[social]
				
				&nbsp;
				
				[/spb_text_block] [blank_spacer height='57px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-delivery") {
			
				$template_code = "[spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				<h3>Dante maintains full ownership of the products until full payment has been obtained.</h3>
				It is possible to cancel your order if it hasn't been sent. Contact us and we will help you. If your order has been sent, you will have to return the products in order to receive a refund. The freight will not be refunded. It is not possible to change your order once it has been submitted. This also includes changing the size or color of a product, removing an item, changing the delivery address or payment method. All packages are sent via UPS from our warehouse in London. Your order will be sent within 3 working days after it has been placed.
				
				The normal delivery time from the package has left our warehouse is:
				
				[list]
				[list_item icon='ss-right']1 working day to the United Kingdom[/list_item]
				[list_item icon='ss-right']3 working days to Europe[/list_item]
				[list_item icon='ss-right']6 working days to the remaining destinations[/list_item]
				[/list]
				
				If nobody is at the address when UPS makes the delivery, a note is left in the mailbox and UPS leaves with the package. Another attempt to deliver will be made the next day. A total of three attempts to deliver will be made. If delivery is not possible, the package will be returned to us. When you find the UPS note in your mailbox, contact them to arrange another delivery address,time or tell them the package can be left in your back yard etc.
				
				You can have your package delivered to your work address if this is more convenient for you. This should just be included as Delivery Address. Please note that it is not possible to make a delivery to a PO box.
				
				The freight charge depends on your delivery address.
				
				[hr]
				<h3>How much is the freight charge?</h3>
				We ship all over the world, and the freight charge depends on your delivery address and your purchase amount. Find your delivery zone below and see the freight charges - as well as your freight free limit.
				<h4>Europe</h4>
				Freight Charges: EUR 15 / USD 20 / GBP 13
				Free delivery over: EUR 135 / USD 175 / GBP 115
				<h4>Rest of the world</h4>
				Freight Charges: EUR 30 / USD 40 / GBP 25
				Free delivery over: EUR 200 / USD 265 / GBP 170
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				<h3>Returns policy</h3>
				We want all our customers to receive high quality products. If there is something wrong with the product you have received or if your delivery is not identical to your order (wrong product or if a product is missing), please contact our customer service. If you send us a mail, please include as many details as possible including your order number as well as a picture if there is something wrong with one of the products.
				
				If you are not completely satisfied with your product, simply return the unused product(s) in its original unbroken packaging within 14 days of receipt for a refund.
				
				When we receive the product, we will refund the value of the purchased the product, but not the original freight.
				All products must be returned in their original packaging with all enclosed documentation and the packaging cannot be broken or in any other way damaged - neither can the product. Otherwise it will not be possible to obtain a refund.
				
				[hr]
				
				You must pay for the freight to return the goods and this must also be arranged by yourself. The goods are your responsibility until they reach our warehouse. Please ensure you pack the return safely to prevent any damage to the products or boxes.
				
				You always have a 24 months warranty period if something is wrong with the product. Your claim should be send to us as soon as possible.If your claim is justified we will refund your reasonable freight expenses.
				
				[hr]
				<h3>How to return a product</h3>
				Please note that when you return a product it is very important to state the order number as well as your name and address. Without these details we will not be able to process your refund. Furthermore, a detailed description of the problem is necessary - if you have a claim. Remember to provide us with a receipt for your freight charges if we have to reimburse them.
	
				Please enclose a return form with the returned products. You can download the return form here.
				
				Our return address is:
				Apple Computer Inc,
				1 Infinite Loop, Cupertino
				CA, 95014
				
				It can take up to 14 days for us to receive your return, depending on which postal service you use. Once we have received the returned products, we will inspect them and process the refund within 48 hours.
				
				[/spb_text_block]";
				
			} else if ($template_id == "sf-help-faq") {
			
				$template_code = "[faqs width='1/1' el_position='first last'] [blank_spacer height='20px' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-meet-team") {
			
				$template_code = "[blank_spacer height='30px' width='1/1' el_position='first last'] [team item_columns='3' item_count='3' category='All' pagination='no' el_class='pb0 mb0' width='1/1' el_position='first last'] [blank_spacer height='40px' width='1/1' el_position='first last'] [impact_text include_button='yes' button_style='standard' title='SEE OUR WORK' href='#' color='accent' size='normal' type='standard' target='_self' position='cta_align_right' alt_background='none' width='1/1' el_position='first last']
				<p class='impact-text'>Dante has been painstakingly crafted with technical
				excellence and exceptional attention to detail.</p>
				[/impact_text] [blank_spacer height='80px' width='1/1' el_position='first last'] [team_carousel category='All' excerpt_length='25' width='1/1' el_position='first last'] [blank_spacer height='30px' width='1/1' el_position='first last'] [tweets_slider title='Latest tweets from the team' twitter_username='@swiftideas' text_size='large' tweets_count='6' autoplay='yes' alt_background='alt-four' el_class='bt0 bb0 mb0 no-arrow' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-our-offices") {
			
				$template_code = "[blank_spacer height='10px' width='1/1' el_position='first last'] [spb_slider layerslider_shortcode='1' width='1/1' el_position='first last'] [blank_spacer height='65px' width='1/1' el_position='first last'] [spb_text_block title='Welcome to Dante' pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='first']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna. Quisque nec nisi tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdie.
				
				[/spb_text_block] [spb_accordion widget_title='More about us' width='1/3'] [spb_accordion_tab title='Who we are'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
				
				[/spb_text_block] [/spb_accordion_tab] [spb_accordion_tab title='What we do'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
				
				[/spb_text_block] [/spb_accordion_tab] [spb_accordion_tab title='Why we do it'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
				
				[/spb_text_block] [/spb_accordion_tab] [spb_accordion_tab title='Where we do it'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
				
				[/spb_text_block] [/spb_accordion_tab] [/spb_accordion] [spb_tabs tab_asset_title='Why choose us?' width='1/3' el_position='last'] [spb_tab title='Approach'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie, nulla orci consequat leo, vitae commodo odio lectus vitae lacus. Morbi sed dictum diam. Aenean et ipsum eget leo auctor dignissim. Maecenas tincidunt dictum nibh.
				
				[/spb_text_block] [/spb_tab] [spb_tab title='Support'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
				
				[/spb_text_block] [/spb_tab] [spb_tab title='Capabilities'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie, nulla orci consequat leo, vitae commodo odio lectus vitae lacus. Morbi sed dictum diam. Aenean et ipsum eget leo auctor dignissim. Maecenas tincidunt dictum nibh, at interdum lorem interdum ut.
				
				[/spb_text_block] [/spb_tab] [spb_tab title=''] [/spb_tab] [/spb_tabs] [blank_spacer height='30px' width='1/1' el_position='first last'] [testimonial_slider title='Testimonials' text_size='large' item_count='6' order='rand' category='All' autoplay='yes' alt_background='alt-four' el_class='no-arrow bb0 bt0 mt0' width='1/1' el_position='first last'] [blank_spacer height='35px' width='1/1' el_position='first last'] [spb_gmaps title='London Office' address='London' size='270' type='roadmap' zoom='15' saturation='color' pin_image='11338' fullscreen='no' width='1/4' el_position='first'] [spb_gmaps title='Berlin Office' address='Berlin' size='270' type='roadmap' zoom='15' saturation='color' pin_image='11338' fullscreen='no' width='1/4'] [spb_gmaps title='New York Office' address='New York' size='270' type='roadmap' zoom='15' saturation='color' pin_image='11338' fullscreen='no' width='1/4'] [spb_gmaps title='Shanghai Office' address='Shanghai' size='270' type='roadmap' zoom='15' saturation='color' pin_image='11338' fullscreen='no' width='1/4' el_position='last'] [blank_spacer height='24px' width='1/1' el_position='first last'] [clients_featured title='Selected Client List' category='featured' alt_background='alt-four' el_class='bb0 mb0 no-shadow' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-pricing") {
			
				$template_code = "[blank_spacer height='20px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				[labelled_pricing_table columns='5']
				
				[lpt_label_column]
				
				[lpt_row_label alt='yes'] Feature 1 [/lpt_row_label]
				
				[lpt_row_label] Feature 2[/lpt_row_label]
				
				[lpt_row_label alt='yes'] Feature 3 [/lpt_row_label]
				
				[lpt_row_label] Feature 4 [/lpt_row_label]
				
				[lpt_row_label alt='yes'] Feature 5 [/lpt_row_label]
				
				[lpt_row_label] Feature 6 [/lpt_row_label]
				
				[lpt_row_label alt='yes'] Feature 7 [/lpt_row_label]
				
				[lpt_row_label] Feature 8 [/lpt_row_label]
				
				[/lpt_label_column]
				
				[lpt_column]
				
				[lpt_price]$100<span>/ mo.</span>[/lpt_price]
				
				[lpt_package]Basic Package[/lpt_package]
				
				[lpt_row_label alt='yes'] LABEL 0 [/lpt_row_label]
				
				[lpt_row alt='yes'] - [/lpt_row]
				
				[lpt_row_label] LABEL 1 [/lpt_row_label]
				
				[lpt_row] 10 [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 2 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 3 [/lpt_row_label]
				
				[lpt_row] - [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 4 [/lpt_row_label]
				
				[lpt_row alt='yes'] 100[/lpt_row]
				
				[lpt_row_label] LABEL 5 [/lpt_row_label]
				
				[lpt_row] - [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 6 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 7 [/lpt_row_label]
				
				[lpt_row] yes [/lpt_row]
				
				[lpt_button link='#' target='_self']BUY NOW[/lpt_button]
				
				[/lpt_column]
				
				[lpt_column]
				
				[lpt_price]$150<span>/ mo.</span>[/lpt_price]
				
				[lpt_package]Standard Package[/lpt_package]
				
				[lpt_row_label alt='yes'] LABEL 0 [/lpt_row_label]
				
				[lpt_row alt='yes'] - [/lpt_row]
				
				[lpt_row_label] LABEL 1 [/lpt_row_label]
				
				[lpt_row] 25 [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 2 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 3 [/lpt_row_label]
				
				[lpt_row] - [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 4 [/lpt_row_label]
				
				[lpt_row alt='yes'] 150 [/lpt_row]
				
				[lpt_row_label] LABEL 5 [/lpt_row_label]
				
				[lpt_row] - [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 6 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 7 [/lpt_row_label]
				
				[lpt_row] yes [/lpt_row]
				
				[lpt_button link='#' target='_self']BUY NOW[/lpt_button]
				
				[/lpt_column]
				
				[lpt_column highlight='yes']
				
				[lpt_price]$200<span>/ mo.</span>[/lpt_price]
				
				[lpt_package]Premium Package[/lpt_package]
				
				[lpt_row_label alt='yes'] LABEL 0 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 1 [/lpt_row_label]
				
				[lpt_row] 50 [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 2 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 3 [/lpt_row_label]
				
				[lpt_row] yes [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 4 [/lpt_row_label]
				
				[lpt_row alt='yes'] 200 [/lpt_row]
				
				[lpt_row_label] LABEL 5 [/lpt_row_label]
				
				[lpt_row] - [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 6 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 7 [/lpt_row_label]
				
				[lpt_row] yes [/lpt_row]
				
				[lpt_button link='#' target='_self']BUY NOW[/lpt_button]
				
				[/lpt_column]
				
				[lpt_column]
				
				[lpt_price]$250<span>/ mo.</span>[/lpt_price]
				
				[lpt_package]Pro Package[/lpt_package]
				
				[lpt_row_label alt='yes'] LABEL 0 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 1 [/lpt_row_label]
				
				[lpt_row] 100 [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 2 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 3 [/lpt_row_label]
				
				[lpt_row] yes [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 4 [/lpt_row_label]
				
				[lpt_row alt='yes'] 250 [/lpt_row]
				
				[lpt_row_label] LABEL 5 [/lpt_row_label]
				
				[lpt_row] yes [/lpt_row]
				
				[lpt_row_label alt='yes'] LABEL 6 [/lpt_row_label]
				
				[lpt_row alt='yes'] yes [/lpt_row]
				
				[lpt_row_label] LABEL 7 [/lpt_row_label]
				
				[lpt_row] yes [/lpt_row]
				
				[lpt_button link='#' target='_self']BUY NOW[/lpt_button]
				
				[/lpt_column]
				
				[/labelled_pricing_table]
				
				[/spb_text_block] [testimonial_slider title='What our customers say' text_size='large' item_count='6' order='rand' category='all' autoplay='yes' alt_background='alt-five' width='1/1' el_position='first last'] [blank_spacer height='20px' width='1/1' el_position='first last'] [spb_text_block title='Am I going to be tied into a contract?' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. In porta facilisis quam eu interdum. Quisque volutpat erat eget arcu malesuada porttitor. Maecenas vel nunc turpis, tempor vulputate nisi. Sed vel.
				
				[/spb_text_block] [spb_text_block title='How do I sign up?' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				Mauris malesuada elementum mauris, in posuere justo ornare nec. Nam ornare, nulla nec venenatis posuere, libero velit blandit mauris, a vestibulum urna lectus vitae dui. Nunc tellus mi, mollis at.
				
				[/spb_text_block] [blank_spacer height='40px' width='1/1' el_position='first last'] [spb_text_block title='How much is unlimited?' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				Fusce enim sapien, porttitor eget auctor ac, mollis vel augue. Aliquam erat volutpat. Vivamus at sapien a justo consequat egestas. Suspendisse hendrerit mauris at sapien sodales sit amet eleifend dolor.
				
				[/spb_text_block] [spb_text_block title='Can I upgrade at a later date?' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				Vestibulum ac tempor magna. Nulla consequat ornare lorem, accumsan ultrices sem placerat et. Donec felis mi, ultrices et tristique eu, pretium vel ligula. Nulla facilisi. Nulla fermentum, sapien eu varius.
				
				[/spb_text_block] [blank_spacer height='40px' width='1/1' el_position='first last'] [spb_text_block title='How do I cancel my agreement?' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				Nunc dignissim varius quam vitae sollicitudin. Phasellus odio felis, bibendum vitae egestas eu, congue et orci. Nam sed eros augue, eu dignissim lacus. Curabitur et tortor ultricies diam condimentum iaculis.
				
				[/spb_text_block] [spb_text_block title='Do I get a free t-shirt?' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				Morbi elementum consectetur rutrum. Nullam quam velit, posuere eget convallis bibendum, mattis at velit. Etiam blandit, diam sed accumsan gravida, arcu ligula vestibulum ante, a molestie est dui ut velit.
				
				[/spb_text_block] [fullwidth_text alt_background='alt-four' el_class='mb0 bb0 pb0 no-arrow' width='1/1' el_position='first last']
				<h1 style='text-align: center; margin-bottom: 20px;'>Ready to experience the next generation?</h1>
				<p style='text-align: center;'>[sf_button colour='gold' type='standard' size='standard' link='http://' target='_self' icon='' dropshadow='yes' extraclass='']SIGN UP TODAY![/sf_button]</p>
				[/fullwidth_text]";
				
			} else if ($template_id == "sf-payment") {
			
				$template_code = "[spb_text_block title='Website security' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				To help ensure that your shopping experience is safe, simple and secure Dante uses Secure Socket Layer (SSL) technology. This encrypts and protects the data you send to us over the internet. If SSL is enabled then you will see a padlock at the top of your browser and you can click on this to find out information about the SSL digital certificate registration.
				
				You will also notice that when you look at the location (URL) field at the top of the browser you will see it begin with 'https:' instead of the normal 'http:'. This means that you are in secure mode.
				
				[/spb_text_block] [spb_text_block title='Payment methods' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				We accept Visa, MasterCard, American Express, Delta, and Maestro credit and debit cards. Payment is only debited from your card at time of dispatch. We also accept Paypal and direct Bank transfers.
				
				Dante is registered with Cybertrust as an authentic site. This ensures that your information is kept private while in transit between your web browser and our web server.
				
				[/spb_text_block] [blank_spacer height='30px' width='1/1' el_position='first last'] [spb_text_block title='Mastercard&reg; Securecode' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				To give you even more confidence in shopping online with Dante, we have introduced MasterCard&reg; SecureCodeTM. This service protects your existing card account from unauthorised use when you shop with us.
				
				To use this service, you must first register with the bank or other organisation that issued your card. To find out more, please visit the <a href='http://www.mastercard.us/support/securecode.html' target='_blank'>MasterCard&reg; SecureCode website</a>.
				
				Once you have registered and created your own private password with your card issuer, you will be automatically prompted at checkout to provide this password each time you make a purchase. This means that even if someone knows your debit card number, they will be unable to complete a purchase without your private password.
				
				Please note: Your MasterCard&reg; SecureCode password is not your Dante account password. Dante does not have access to your MasterCard&reg; SecureCode password.
				
				[/spb_text_block] [spb_text_block title='Faster Shopping' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				Dante also provides the option for you to safely store your credit card details, making it quicker and simpler to shop with us. Your full card details will never be displayed, except for the last four digits so that you know which of your cards you are using. You can delete your card details by unchecking the box 'remember my payment details' on the payment page.
				
				Please note that you will need to re-enter card details if you change or add a new address. This means that if someone guesses your password and tries to place an order using your account, they will be unable to do so to any address other than those you have already saved. We hope you understand that this is a valuable precaution designed to protect your personal information.
				
				[/spb_text_block]";
				
			} else if ($template_id == "sf-privacy") {
			
				$template_code = "[spb_text_block title='Privacy policy' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				All information provided by you is only used to ensure the best possible shopping experience. All information is strictly confidential. Your personal information will not be shared, circulated, nor modified in any way without your previous consent.
				
				If you place an order with us, we request certain personal information. You must provide contact information (such as name, email and delivery address) and financial information (such as credit card number, expiration date and the 3 digit security code). We use this information for billing purposes and to complete your order. If we have trouble processing an order, we will use your contact information. Your telephone number is required for shipping purposes in case UPS needs to contact you regarding the delivery.
				
				We use third-party web beacons (Google Analytics) from Google to help analyze where visitors go and what they do while visiting our website. We reserve the right to modify this privacy policy at any time, so please review it frequently. If we make significant changes to this policy, we will notify you here and by a notice on the website in general.
				
				This was last updated on May 15 2013.
				
				[/spb_text_block] [spb_text_block title='Use of Cookies' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				Cookies are pieces of information which a website transfers to your computers hard disk for record-keeping purposes. Cookies can make a web site more useful by personalizing information for visitors and by storing information about your preferences on our site. The use of cookies is an industry standard, and many major websites use them to provide useful features for their customers. It is our policy to use cookies only for the following purposes:
				
				[list]
				[list_item icon='ss-right']To identify you[/list_item]
				[list_item icon='ss-right']To customize our site for you[/list_item]
				[list_item icon='ss-right']To help improve navigation[/list_item]
				[/list]
				
				Most browsers are initially set up to accept cookies. If you prefer, you can set your browser to reject cookies. However, you will not be able to take full advantage of our web site if you do so.
				
				We use tracking technology to better understand site traffic patterns and use. However, none of the information collected via tracking technology is personally identifiable information.
				
				[/spb_text_block] [blank_spacer height='30px' width='1/1' el_position='first last'] [spb_text_block title='Disclaimer' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				Dante strives, to the fullest extent possible, to provide accurate and updated content on this website. Unfortunately, there may occasionally be price changes, sold out goods and other unintentional errors on our site. We reserve the right not to be liable for these errors or changes and neither Dante, nor any employee or representative of Dante will be liable for damages arising from the use of this website or the products sold here.
				
				[/spb_text_block] [spb_text_block title='Applicable Law' pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				Any dispute arising between a customer and Dante will be settled in accordance with British Legislation.
				
				[/spb_text_block]";
				
			} else if ($template_id == "sf-services") {
			
				$template_code = "[fullwidth_text alt_background='alt-four' el_class='mt0 bt0 bb0 no-arrow' width='1/1' el_position='first last']
				
				[one_third]
				<p style='text-align: center;'><img class='alignnone size-full wp-image-11233' alt='services_strat3' src='http://dante.swiftideas.net/wp-content/uploads/2012/08/services_strat3.png' width='720' height='369' /></p>
				
				<h3 style='text-align: center;'>Strategy</h3>
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.</p>
				[/one_third]
				[one_third]
				<p style='text-align: center;'><img class='alignnone size-full wp-image-11232' alt='services_creat3' src='http://dante.swiftideas.net/wp-content/uploads/2012/08/services_creat3.png' width='720' height='369' /></p>
				
				<h3 style='text-align: center;'>Creativity</h3>
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.</p>
				[/one_third]
				[one_third_last]
				<p style='text-align: center;'><img class='alignnone size-full wp-image-11231' alt='services_tech3' src='http://dante.swiftideas.net/wp-content/uploads/2012/08/services_tech3.png' width='720' height='369' /></p>
				
				<h3 style='text-align: center;'>Technology</h3>
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.</p>
				[/one_third_last]
				
				[/fullwidth_text] [blank_spacer height='34px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>Our Services</h1>
				<p style='text-align: center;'>Suspendisse bibendum cursus luctus. Donec consequat malesuada
				felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis.</p>
				[hr]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='first']
				
				[sf_iconbox image='ss-share' character='' type='animated' title='Strategy' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-bezier' character='' type='animated' title='Design &amp; UX' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-mouse' character='' type='animated' title='Technology' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='last']
				
				[sf_iconbox image='ss-chat' character='' type='animated' title='Social' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='20px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='first']
				
				[sf_iconbox image='ss-smartphone' character='' type='animated' title='Mobile' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-video' character='' type='animated' title='Motion' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-usergroup' character='' type='animated' title='Marketing' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='last']
				
				[sf_iconbox image='ss-piechart' character='' type='animated' title='Analytics' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='30px' width='1/1' el_position='first last'] [spb_parallax parallax_type='image' bg_image='11354' bg_type='cover' parallax_video_height='video-height' parallax_image_height='content-height' alt_background='none' el_class='bt0 bb0 no-shadow no-arrow' width='1/1' el_position='first last']
				<p style='text-align: center;'>[sf_fullscreenvideo type='icon-button' btntext='' imageurl='' videourl='http://vimeo.com/35396305' extraclass='']</p>
				<p class='impact-text-large' style='text-align: center;'>How we work</p>
				<p style='text-align: center;'>[hr]</p>
				
				<h3 style='text-align: center;'>Suspendisse bibendum cursus luctus. Donec consequat malesuada
				felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis.</h3>
				[/spb_parallax] [blank_spacer height='13px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<h1 style='text-align: center;'>What Makes Us Special</h1>
				<p style='text-align: center;'>Suspendisse bibendum cursus luctus. Donec consequat malesuada
				felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis.</p>
				[hr]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				[sf_iconbox image='' character='1' type='left-icon' title='We're great people' animation='fade-from-left' animation_delay='0']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='' character='2' type='left-icon' title='We're dedicated' animation='fade-from-left' animation_delay='600']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='' character='3' type='left-icon' title='We're diligent' animation='fade-from-left' animation_delay='1200']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie.
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				[sf_iconbox image='' character='4' type='left-icon' title='We're caring' animation='fade-from-right' animation_delay='300']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='' character='5' type='left-icon' title='We're talented' animation='fade-from-right' animation_delay='900']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie.
				[/sf_iconbox]
				
				&nbsp;
				
				[sf_iconbox image='' character='6' type='left-icon' title='We're intelligent' animation='fade-from-right' animation_delay='1500']
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie.
				[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='23px' width='1/1' el_position='first last'] [testimonial_slider title='What our clients say about us' text_size='large' item_count='6' order='rand' category='All' autoplay='yes' alt_background='alt-four' el_class='mb0 bt0 bb0 no-arrow' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-services-2") {
			
				$template_code = "[blank_spacer height='34px' width='1/1' el_position='first last'] [spb_single_image image='11357' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' caption='mb0' width='1/3' el_position='first'] [spb_single_image image='11355' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' caption='mb0' width='1/3'] [spb_single_image image='11356' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='no' link_target='_self' caption='mb0' width='1/3' el_position='last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0 pb0' width='1/3' el_position='first']
				<h3 class='mt0'>Powerful yet simple</h3>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit.
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0 pb0' width='1/3']
				<h3 class='mt0'>Next-level features</h3>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit.
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0 pb0' width='1/3' el_position='last']
				<h3 class='mt0'>Fit for any purpose</h3>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit.
				
				[/spb_text_block] [blank_spacer height='52px' width='1/1' el_position='first last'] [divider type='dotted' text='Go to top' full_width='yes' width='1/1' el_position='first last'] [blank_spacer height='54px' width='1/1' el_position='first last'] [spb_text_block title='Our Services' pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0 pb0' width='1/4' el_position='first']
				<p style='text-align: left;'>Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate.</p>
				<p style='text-align: left;'>[sf_button colour='gold' type='sf-icon-reveal' size='standard' link='http://' target='_self' icon='ss-phone' dropshadow='no' extraclass='']HIRE US TODAY![/sf_button]</p>
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-share' character='' type='animated' title='Strategy' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-bezier' character='' type='animated' title='Design &amp; UX' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='last']
				
				[sf_iconbox image='ss-mouse' character='' type='animated' title='Technology' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='first']
				
				[sf_iconbox image='ss-smartphone' character='' type='animated' title='Mobile' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-video' character='' type='animated' title='Motion' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4']
				
				[sf_iconbox image='ss-usergroup' character='' type='animated' title='Marketing' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/4' el_position='last']
				
				[sf_iconbox image='ss-piechart' character='' type='animated' title='Analytics' animation='none' animation_delay='200']
				
				Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero.
				
				[/sf_iconbox]
				
				[/spb_text_block] [blank_spacer height='34px' width='1/1' el_position='first last'] [spb_parallax parallax_type='image' bg_image='11354' bg_type='cover' parallax_video_height='video-height' parallax_image_height='content-height' alt_background='none' el_class='mb0 bt0 bb0 no-shadow no-arrow' width='1/1' el_position='first last']
				<p style='text-align: center;'>[sf_fullscreenvideo type='icon-button' btntext='' imageurl='' videourl='http://vimeo.com/35396305' extraclass='']</p>
				<p class='impact-text-large' style='text-align: center;'>View our Demo Reel</p>
				[/spb_parallax] [blank_spacer height='84px' width='1/1' el_position='first last'] [impact_text include_button='yes' button_style='standard' title='FIND OUT HOW WE CAN HELP' href='#' color='accent' target='_self' position='cta_align_right' alt_background='none' width='1/1' el_position='first last']
				<p class='impact-text'>Dante has been painstakingly crafted with technical
				excellence and exceptional attention to detail.</p>
				[/impact_text] [blank_spacer height='70px' width='1/1' el_position='first last'] [spb_tabs tab_asset_title='Our core capabilities' el_class='mb0' width='1/2' el_position='first'] [spb_tab title='Capability One'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit. Praesent gravida mi et mauris sollicitudin ultricies. Duis molestie quam sem, ac faucibus velit. Curabitur dolor dolor, fringilla vel fringilla tempor, ultricies sed tellus. Cras aliquet, nulla a feugiat adipiscing, mi enim ornare nisl.
				
				[/spb_text_block] [/spb_tab] [spb_tab title='Capability Two'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0' width='1/1' el_position='first last']
				
				Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit. Praesent gravida mi et mauris sollicitudin ultricies. Duis molestie quam sem, ac faucibus velit. Curabitur dolor dolor, fringilla vel fringilla tempor, ultricies sed tellus. Cras aliquet, nulla a feugiat adipiscing, mi enim ornare nisl.
				
				[/spb_text_block] [/spb_tab] [spb_tab title='Capability Three'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit. Praesent gravida mi et mauris sollicitudin ultricies. Duis molestie quam sem, ac faucibus velit. Curabitur dolor dolor, fringilla vel fringilla tempor, ultricies sed tellus. Cras aliquet, nulla a feugiat adipiscing, mi enim ornare nisl.
				
				[/spb_text_block] [/spb_tab] [spb_tab title='Capability Four'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0' width='1/1' el_position='first last']
				
				Consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit. Praesent gravida mi et mauris sollicitudin ultricies. Duis molestie quam sem, ac faucibus velit. Curabitur dolor dolor, fringilla vel fringilla tempor, ultricies sed tellus. Cras aliquet, nulla a feugiat adipiscing, mi enim ornare nisl.
				
				[/spb_text_block] [/spb_tab] [/spb_tabs] [spb_text_block title='Industries served' pb_margin_bottom='no' pb_border_bottom='no' el_class='mb0 pb0' width='1/2' el_position='last']
				
				[progress_bar percentage='100' name='Entertainment' value='100%' type='' colour='#1dc6df']
				
				[progress_bar percentage='70' name='Health' value='70%' type='' colour='#1dc6df']
				
				[progress_bar percentage='100' name='Publishing' value='100%' type='' colour='#1dc6df']
				
				[progress_bar percentage='100' name='Technology' value='100%' type='' colour='#1dc6df']
				
				[progress_bar percentage='50' name='Travel' value='50%' type='' colour='#1dc6df]
				
				[progress_bar percentage='35' name='Financial' value='35%' type='' colour='#1dc6df']
				
				[/spb_text_block]";
				
			} else if ($template_id == "sf-stores") {
			
				$template_code = "[spb_gmaps address='London' size='655' type='roadmap' zoom='14' color='#222222' saturation='mono' pin_image='11163' fullscreen='no' width='1/2' el_position='first'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				<h3 class='mt0'>Welcome to the Dante flagship store</h3>
				From its beginning in November 2005 as an innovative lifestyle store, the Dante Flagship Store has grown to become one of the best shops in the world.
				
				The Flagship Store consists of 1700 m2 pure design pleasure that delights all senses. The philosophy of the Flagship Store is to offer an inspiring place. A place where you find your personal fashion style. The store holds a wide variety of contemporary lifestyle products within furniture, lighting, music, fashion, perfume and various home accessories.
				
				The Flagship Store is featured as a must-visit location in several magazines and guidebooks such as the Wallpaper City Guide and the Louis Vuitton City Guide
				
				[hr]
				<h3>Opening hours:</h3>
				Monday to Friday: 10am to 6pm
				Saturday: 10 am to 4pm
				Sunday: Closed
				
				[hr]
				<h3>Address:</h3>
				Apple Computer Inc,
				1 Infinite Loop, Cupertino
				CA, 95014
				
				[/spb_text_block]";
				
			} else if ($template_id == "sf-portfolio") {
			
				$template_code = "[portfolio display_type='masonry' columns='3' show_title='yes' show_subtitle='yes' show_excerpt='no' excerpt_length='20' item_count='9' category='All' portfolio_filter='yes' pagination='yes' width='1/1' el_position='first last']";
			
			} else if ($template_id == "sf-portfolio-example") {
			
				$template_code = "[blank_spacer height='30px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='first']
				<p class='impact-text-large' style='text-align: center;'>The Brief.</p>
				[hr]
				<p style='text-align: center;'>Illustration by <a href='http://dribbble.com/kump' target='_blank'>Matt Kump</a>.</p>
				<p style='text-align: center;'>Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere.</p>
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3']
				<p class='impact-text-large' style='text-align: center;'>The Plan.</p>
				[hr]
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa.
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='last']
				<p class='impact-text-large' style='text-align: center;'>Skills Used.</p>
				[hr]
				
				[progress_bar percentage='100' name='Illustration' value='100%' type='' colour='#007ef3']
				
				[progress_bar percentage='80' name='Photoshop' value='80%' type='' colour='#00a0f3']
				
				[progress_bar percentage='70' name='After Effects' value='70%' type='' colour='#1dc6df']
				
				[/spb_text_block] [blank_spacer height='70px' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-eight' el_class='bt0 bb0 pb0 mt0 mb0 no-shadow no-arrow' width='1/1' el_position='first last']
				
				[one_third]
				
				&nbsp;
				
				&nbsp;
				
				[sf_iconbox image='ss-view' character='' type='standard' title='999K Views' animation='fade-from-bottom' animation_delay='0']
				
				[/sf_iconbox]
				
				[sf_iconbox image='ss-like' character='' type='standard' title='60k Likes' animation='fade-from-bottom' animation_delay='200']
				
				[/sf_iconbox]
				
				[sf_iconbox image='ss-downloadcloud' character='' type='standard' title='50k Downloads' animation='fade-from-bottom' animation_delay='400']
				
				[/sf_iconbox]
				
				[/one_third]
				
				[two_third_last]
				
				<img class='sf-animation' alt='drib-highres' src='http://dante.swiftideas.net/wp-content/uploads/2013/11/drib-highres.jpg' width='1140' height='1086' data-animation='fade-from-right' data-delay='200' />
				
				[/two_third_last]
				
				[/fullwidth_text] [blank_spacer height='90px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'>Deliverables.</p>
				[hr]
				
				&nbsp;
				
				[/spb_text_block] [spb_single_image image='11530' image_size='full' frame='noframe' intro_animation='pop-up' full_width='no' lightbox='yes' link_target='_self' width='1/3' el_position='first'] [spb_single_image image='11529' image_size='full' frame='noframe' intro_animation='pop-up' full_width='no' lightbox='yes' link_target='_self' width='1/3'] [spb_single_image image='11528' image_size='full' frame='noframe' intro_animation='pop-up' full_width='no' lightbox='yes' link_target='_self' width='1/3' el_position='last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='first']
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa.</p>
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3']
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa.</p>
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/3' el_position='last']
				<p style='text-align: center;'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa.</p>
				[/spb_text_block] [blank_spacer height='90px' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-eight' el_class='bt0 bb0 mb0 mt0' width='1/1' el_position='first last']
				
				[sf_countdown year='2013' month='12' day='25' fontsize='large' displaytext='Until the project launches!']
				
				[/fullwidth_text] [blank_spacer height='90px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				<p class='impact-text-large' style='text-align: center;'>How It Went Down.</p>
				[hr]
				
				&nbsp;
				
				[/spb_text_block] [spb_video link='http://vimeo.com/35396305' full_width='yes' width='1/1' el_position='first last'] [blank_spacer height='100px' width='1/1' el_position='first last'] [fullwidth_text alt_background='alt-seven' el_class='mt0 mb0 bt0 bb0 no-arrow pb0 pt0' width='1/1' el_position='first last']
				
				[one_half]
				
				&nbsp;
				
				&nbsp;
				<h1>'Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante.'</h1>
				<h3>[/one_half]
				[one_half_last]</h3>
				[spb_single_image image='11531' image_size='full' frame='noframe' intro_animation='fade-from-right' full_width='no' lightbox='no' link_target='_self' width='1/1' el_position='first'][/one_half_last]
				
				[/fullwidth_text] [fullwidth_text alt_background='alt-five' el_class='mt0 mb0 bt0 bb0 no-arrow' width='1/1' el_position='first last']
				
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-bezier' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='301873' speed='1000' refresh='25' textstyle='h6' subject='Pixels pushed.']
				
				[/one_fourth]
				
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-mug' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='1448' speed='1500' refresh='25' textstyle='h6' subject='Cups of coffee consumed.']
				
				[/one_fourth]
				
				[one_fourth]
				<p style='text-align: center;'>[icon image='ss-pizza' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='265' speed='2000' refresh='25' textstyle='h6' subject='Pizza's eaten.']
				
				[/one_fourth]
				
				[one_fourth_last]
				<p style='text-align: center;'>[icon image='ss-write' character='' size='medium' cont='no' float='none']</p>
				[sf_count from='0' to='95999' speed='2500' refresh='25' textstyle='h6' subject='Lines of code written.']
				
				[/one_fourth_last]
				
				[/fullwidth_text]";
				
			} else if ($template_id == "sf-blog") {
			
				$template_code = "[blog show_blog_aux='no' blog_type='masonry' masonry_effect_type='effect-4' item_count='6' category='All' show_title='yes' show_excerpt='yes' show_details='yes' excerpt_length='20' content_output='excerpt' show_read_more='yes' pagination='infinite-scroll' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-blog-example") {
			
				$template_code = "[blank_spacer height='12px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='first']
				
				Illustration by <a href='http://dribbble.com/shots/735335-Geo-Field?list=users' target='_blank'>Jeremiah Shaw</a>.
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit. Praesent gravida mi et mauris sollicitudin ultricies. Duis molestie quam sem, ac faucibus velit. Curabitur dolor dolor, fringilla vel fringilla tempor, ultricies sed tellus. Curabitur dolor dolor, fringilla vel fringilla tempor
				
				[/spb_text_block] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/2' el_position='last']
				
				&nbsp;
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit. Praesent gravida mi et mauris sollicitudin ultricies. Duis molestie quam sem, ac faucibus velit. Curabitur dolor dolor, fringilla vel fringilla tempor, ultricies sed tellus. Cras aliquet, nulla a feugiat adipiscing, mi enim ornare nisl, eu pellen.
				
				[/spb_text_block] [blank_spacer height='27px' width='1/1' el_position='first last'] [spb_single_image image='11411' image_size='full' frame='noframe' intro_animation='fade-in' full_width='no' lightbox='yes' link_target='_self' width='1/1' el_position='first last'] [blank_spacer height='9px' width='1/1' el_position='first last'] [spb_text_block pb_margin_bottom='no' pb_border_bottom='no' width='1/1' el_position='first last']
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel imperdiet vel, aliquet sit amet risus. Maecenas nec tempus velit. Praesent gravida mi et mauris sollicitudin ultricies. Duis molestie quam sem, ac faucibus velit. Curabitur dolor dolor, fringilla vel fringilla tempor, ultricies sed tellus. Cras aliquet, nulla a feugiat adipiscing, mi enim ornare nisl, eu pellen.
				
				[/spb_text_block] [blank_spacer height='30px' width='1/1' el_position='first last'] [spb_video link='https://vimeo.com/1084537' full_width='no' width='1/1' el_position='first last']";
				
			} else if ($template_id == "sf-maintenance-mode") {
				
				$template_code = '[blank_spacer height="120px" width="1/1" el_position="first last"] [fullwidth_text alt_background="none" el_class="pb0" width="1/1" el_position="first last"]
				<p class="impact-text-large" style="text-align: center;"><span style="color: #222222; line-height: 1.5em;">Maintenance Mode.</span></p>
				<p style="text-align: center;">Sorry for the inconvenience. Our site is currently undergoing scheduled maintenance.</p>
				[hr]
				
				[/fullwidth_text] [fullwidth_text alt_background="alt-five" el_class="mt0" width="1/1" el_position="first last"]
				
				[one_third]
				
				[sf_iconbox image="ss-clock" character="" type="boxed-one" title="How long will it take?" animation="pop-up" animation_delay="200"]
				Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat pellentesque nibh ut varius. Morbi aliquet.
				[/sf_iconbox]
				
				[/one_third]
				[one_third]
				
				[sf_iconbox image="ss-phone" character="" type="boxed-one" title="Give us a call" animation="pop-up" animation_delay="600"]
				Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat pellentesque nibh ut varius. Morbi aliquet.
				[/sf_iconbox]
				
				[/one_third]
				[one_third_last]
				
				[sf_iconbox image="ss-chat" character="" type="boxed-one" title="Access support forum" animation="pop-up" animation_delay="1000"]
				Vestibulum ante ipsum primis in fauc ibus orci luctus et ultrices posuere cubilia Curae; Integer in enim dui. Suspendisse potenti. Sed placerat pellentesque nibh ut varius. Morbi aliquet.
				[/sf_iconbox]
				
				[/one_third_last]
				
				[/fullwidth_text] [fullwidth_text alt_background="none" el_class="pb0" width="1/1" el_position="first last"]
				<p style="text-align: center;">Please try back again later, <span style="line-height: 1.5em;">thanks for your understanding.</span></p>
				[/fullwidth_text] [blank_spacer height="120px" width="1/1" el_position="first last"]';
			
			} else if ($template_id == "sf-coming-soon") {
			
				$template_code = '[blank_spacer height="120px" width="1/1" el_position="first last"] [fullwidth_text alt_background="none" width="1/1" el_position="first last"]
				<p class="impact-text-large" style="text-align: center;"><span style="color: #1dc6df; line-height: 1.5em;">Coming soon.</span></p>
				[/fullwidth_text] [fullwidth_text alt_background="alt-four" el_class="mt0 no-shadow no-arrow" width="1/1" el_position="first last"]
				
				[sf_countdown year="2014" month="10" day="24" fontsize="large" displaytext="Until our new site launches."]
				
				[/fullwidth_text] [fullwidth_text title="We are nearly there" alt_background="none" width="1/3" el_position="first"]
				
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam massa quis mauris sollicitudin commodo venenatis ligula commodo. Sed blandit convallis dignissim. Pellentesque pharetra velit eu velit elementum et convallis erat vulputate. Sed in nulla ut elit mollis posuere. Praesent a felis accumsan neque interdum molestie ut id massa. In hac habitasse platea dictumst. Nulla ut lorem ante. In convallis, felis eget consequat faucibus, mi diam consequat augue, quis porta nibh leo a massa. Sed quam nunc, vulputate vel.
				
				[/fullwidth_text] [fullwidth_text title="New Site Progress" alt_background="none" width="1/3"]
				
				[progress_bar percentage="100" name="Design" value="100%" type="" colour="#1dc6df"]
				
				[progress_bar percentage="100" name="Development" value="100%" type="" colour="#1dc6df"]
				
				[progress_bar percentage="80" name="Test" value="80%" type="" colour="#1dc6df"]
				
				[progress_bar percentage="50" name="Iterations" value="50%" type="" colour="#1dc6df"]
				
				[/fullwidth_text] [fullwidth_text title="Keep me informed" alt_background="none" width="1/3" el_position="last"]
				
				[contact-form-7 id="11876" title="Subscribe"]
				
				[/fullwidth_text] [blank_spacer height="120px" width="1/1" el_position="first last"]';
			
			} else if ($template_id == "sf-parallax-demo") {
			
				$template_code = '[blank_spacer height="0px" spacer_id="intro" spacer_name="Intro" width="1/1" el_position="first last"] [spb_parallax parallax_type="image" bg_image="11423" bg_type="cover" parallax_video_height="video-height" parallax_video_overlay="none" parallax_image_height="window-height" parallax_image_movement="stellar" parallax_image_speed="0.5" alt_background="none" el_class="mt0 mb0 bt0 bb0 no-shadow" width="1/1" el_position="first last"]
				<p class="impact-text-large" style="text-align: center;"><span style="color: #ffffff;">Introduction.</span></p>
				
				<h3 style="text-align: center;"><span style="color: #ffffff;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></h3>
				&nbsp;
				<p style="text-align: center;">[sf_button colour="transparent-light" type="standard" size="large" link="http://" target="_self" icon="" dropshadow="no" extraclass=""]PARALLAX BUTTON ONE[/sf_button]</p>
				[/spb_parallax] [blank_spacer height="0px" spacer_id="step1" spacer_name="Step 1" width="1/1" el_position="first last"] [spb_parallax parallax_type="image" bg_image="11431" bg_type="cover" parallax_video_height="video-height" parallax_video_overlay="none" parallax_image_height="window-height" parallax_image_movement="stellar" parallax_image_speed="0.5" alt_background="none" el_class="mt0 mb0 bt0 bb0 no-shadow" width="1/1" el_position="first last"]
				<p class="impact-text-large" style="text-align: center;"><span style="color: #ffffff;">Step One.</span></p>
				
				<h3 style="text-align: center;"><span style="color: #ffffff;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></h3>
				&nbsp;
				<p style="text-align: center;">[sf_button colour="transparent-light" type="standard" size="large" link="http://" target="_self" icon="" dropshadow="no" extraclass=""]PARALLAX BUTTON TWO[/sf_button]</p>
				[/spb_parallax] [blank_spacer height="0px" spacer_id="step2" spacer_name="Step 2" width="1/1" el_position="first last"] [spb_parallax parallax_type="image" bg_image="11429" bg_type="cover" parallax_video_height="video-height" parallax_video_overlay="none" parallax_image_height="window-height" parallax_image_movement="stellar" parallax_image_speed="0.5" alt_background="none" el_class="mt0 mb0 bt0 bb0 no-shadow" width="1/1" el_position="first last"]
				<p class="impact-text-large" style="text-align: center;"><span style="color: #ffffff;">Step Two.</span></p>
				
				<h3 style="text-align: center;"><span style="color: #ffffff;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></h3>
				&nbsp;
				<p style="text-align: center;">[sf_button colour="transparent-light" type="standard" size="large" link="http://" target="_self" icon="" dropshadow="no" extraclass=""]PARALLAX BUTTON THREE[/sf_button]</p>
				[/spb_parallax] [blank_spacer height="0px" spacer_id="step3" spacer_name="Step 3" width="1/1" el_position="first last"] [spb_parallax parallax_type="image" bg_image="11430" bg_type="cover" parallax_video_height="content-height" parallax_video_overlay="none" parallax_image_height="window-height" parallax_image_movement="stellar" parallax_image_speed="0.5" alt_background="none" el_class="mt0 mb0 bt0 bb0 no-shadow" width="1/1" el_position="first last"]
				<p class="impact-text-large" style="text-align: center;"><span style="color: #ffffff;">Step Three.</span></p>
				
				<h3 style="text-align: center;"><span style="color: #ffffff;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></h3>
				&nbsp;
				<p style="text-align: center;">[sf_button colour="transparent-light" type="standard" size="large" link="http://" target="_self" icon="" dropshadow="no" extraclass=""]PARALLAX BUTTON FOUR[/sf_button]</p>
				[/spb_parallax] [blank_spacer height="0px" spacer_id="end" spacer_name="The End" width="1/1" el_position="first last"] [spb_parallax parallax_type="image" bg_image="11428" bg_type="cover" parallax_video_height="content-height" parallax_video_overlay="none" parallax_image_height="window-height" parallax_image_movement="stellar" parallax_image_speed="0.5" alt_background="none" el_class="mt0 mb0 bt0 bb0 no-shadow" width="1/1" el_position="first last"]
				<p class="impact-text-large" style="text-align: center;"><span style="color: #ffffff;">The End.</span></p>
				
				<h3 style="text-align: center;"><span style="color: #ffffff;">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></h3>
				&nbsp;
				<p style="text-align: center;">[sf_button colour="transparent-light" type="standard" size="large" link="http://" target="_self" icon="" dropshadow="no" extraclass=""]PARALLAX BUTTON FIVE[/sf_button]</p>
				[/spb_parallax]';
			
			}
								
			echo do_shortcode($template_code);
	
	        die();
	    }
	}
	
?>
