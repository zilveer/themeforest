<?php
/**
 * WPBakery Visual Composer main class
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryVisualComposer extends SwiftPageBuilderAbstract {
    private $is_plugin = true;
    private $is_theme = false;
    private $postTypes;
    private $layout;
    protected $shortcodes, $images_media_tab;

    public static function getInstance() {
        static $instance=null;
        if ($instance === null)
            $instance = new WPBakeryVisualComposer();
        return $instance;
    }
    public function createImagesMediaTab() {
        $this->images_media_tab = new WPBakeryImagesMediaTab();
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

        if ( $this->isPlugin() ) {
            $pt_array = get_option('wpb_js_content_types');
            $this->postTypes = $pt_array ? $pt_array : array('page');
        } else {
            $pt_array = get_option('wpb_js_theme_content_types');
            
            $options = get_option('sf_flexform_options');
            if (isset($options['enable_pb_product_pages'])) {
            	$enable_pb_product_pages = $options['enable_pb_product_pages'];
            } else {
            	$enable_pb_product_pages = false;
            }
            if ($enable_pb_product_pages) {
            $this->postTypes = $pt_array ? $pt_array : array('page', 'post', 'portfolio', 'product');
            } else {
            $this->postTypes = $pt_array ? $pt_array : array('page', 'post', 'portfolio');	            
            }
            
        }
        return $this->postTypes;
    }

    public function getLayout() {
        if($this->layout==null)
            $this->layout = new WPBakeryVisualComposerLayout();
        return $this->layout;
    }

    /* Add shortCode to plugin */
    public function addShortCode($shortcode, $function = false) {
        $name = 'WPBakeryShortCode_' . $shortcode['base'];
        if( class_exists( $name ) && is_subclass_of( $name, 'WPBakeryShortCode' ) ) $this->shortcodes[$shortcode['base']] = new $name($shortcode);
    }

    public function createColumnShortCode() {
        $this->shortcodes['vc_column'] = new WPBakeryShortCode_VC_Column( array('base' => 'vc_column') );
    }

    public function createShortCodes() {
        remove_all_shortcodes();
        foreach( WPBMap::getShortCodes() as $sc_base => $el) {
            $name = 'WPBakeryShortCode_' . $el['base'];
            if( class_exists( $name ) && is_subclass_of( $name, 'WPBakeryShortCode' ) ) $this->shortcodes[$sc_base] = new $name($el);
        }

        $this->createColumnShortCode();
    }

    /* Save generated shortcodes, html and visual composer
      status in posts meta
   ---------------------------------------------------------- */
    public function saveMetaBoxes($post_id) {
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $value = $this->post( 'wpb_vc_js_status' );
        if ($value !== null) {
            //var_dump(get_post_meta($post_id, '_wpb_vc_js_status'));
            // Get the value
            //var_dump($value);

            // Add value
            if ( get_post_meta( $post_id, '_wpb_vc_js_status' ) == '' ) { add_post_meta( $post_id, '_wpb_vc_js_status', $value, true );	}
            // Update value
            elseif ( $value != get_post_meta( $post_id, '_wpb_vc_js_status', true ) ) { update_post_meta( $post_id, '_wpb_vc_js_status', $value ); }
            // Delete value
            elseif ( $value == '' ) { delete_post_meta( $post_id, '_wpb_vc_js_status', get_post_meta( $post_id, '_wpb_vc_js_status', true ) ); }
        }
    }

    public function elementBackendHtmlJavascript_callback() {
        $output = '';
        $element = $this->post( 'element' );
        $data_element = $this->post( 'data_element' );

        if ( $data_element == 'vc_column' && $this->post( 'data_width' )!==null ) {
            $output = do_shortcode( '[vc_column width="'. $this->post( 'data_width' ).'"]' );
            echo $output;
        } else {
            $output = do_shortcode( '['.$data_element.']' );
            echo $output;
        }
        die();
    }

    public function shortCodesVisualComposerJavascript_callback() {
        $content = $this->post( 'content' );

        $content = stripslashes( $content );
        $output = wpb_js_remove_wpautop( $content );
        echo $output;
        die();
    }


    public function showEditFormJavascript_callback() {
        $element = $this->post( 'element' );
        $shortCode = $this->post( 'shortcode' );
        $shortCode = stripslashes( $shortCode );

        $this->removeShortCode($element);
        $settings = WPBMap::getShortCode($element);

        new WPBakeryShortCode_Settings($settings);

        echo do_shortcode($shortCode);

        die();
    }

    public function saveTemplateJavascript_callback() {
        $output = '';
        $template_name = $this->post( 'template_name' );
        $template = $this->post( 'template' );

        if ( !isset($template_name) || $template_name == "" || !isset($template) || $template == "" ) { echo 'Error: TPL-01'; die(); }

        $template_arr = array( "name" => $template_name, "template" => $template );

        $option_name = 'wpb_js_templates';
        $saved_templates = get_option($option_name);

        /*if ( $saved_templates == false ) {
            update_option('wpb_js_templates', $template_arr);
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

        //delete_option('wpb_js_templates');

        die();
    }

    public function loadTemplateJavascript_callback() {
        $output = '';
        $template_id = $this->post( 'template_id' );

        if ( !isset($template_id) || $template_id == "" ) { echo 'Error: TPL-02'; die(); }

        $option_name = 'wpb_js_templates';
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

        $option_name = 'wpb_js_templates';
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

     public function loadSFTemplateJavascript_callback() {
        $output = '';
        $template_id = $this->post( 'template_id' );

        if ( !isset($template_id) || $template_id == "" ) { echo 'Error: TPL-02'; die(); }
		
		if ($template_id == "sf-home") {
		
		    $content = '[blank_spacer height="40px" width="1/1" el_position="first last"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="first"]
		    
		    [chart percentage="80" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-mobile-phone" align="center"]
		    <h3 style="text-align: center;">Incredibly Responsive</h3>
		    <p style="text-align: center;">Flexform is completely responsive. And when we say responsive, we mean it won’t only work on mobile devices; it’ll look damn good too!</p>
		    <p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
		    [/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
		    
		    [chart percentage="66" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-pencil" align="center"]
		    <h3 style="text-align: center;">Swift Page Builder</h3>
		    <p style="text-align: center;">Quickly &amp; easily create beautiful pages. Choose any combination of 37 elements to create unique pages that do your content justice.</p>
		    <p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
		    [/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
		    
		    [chart percentage="55" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-font" align="center"]
		    <h3 style="text-align: center;">Superior Typography</h3>
		    <p style="text-align: center;">Flexform includes pro Font Deck support. Or you can choose from 600+ Google Web fonts &amp; control the colour, size &amp; line height.</p>
		    <p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
		    [/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
		    
		    [chart percentage="88" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-eye-open" align="center"]
		    <h3 style="text-align: center;">Stunning Sliders</h3>
		    <p style="text-align: center;">Flexform comes with 3 sliders included. The ever popular Revolution Slider, Woo Slider and our own innovative and stunning Swift Slider.</p>
		    <p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
		    [/vc_column_text] [blank_spacer height="40px" width="1/1" el_position="first last"] [impact_text include_button="yes" title="Take the tour" color="accent" size="standard" type="roundedarrow" target="_self" position="cta_align_right" alt_background="alt-one" el_class="mt0 mb0" width="1/1" el_position="first last"]
		    <h2>Flexform: A responsive, retina-ready &amp; wide multipurpose Word Press theme.</h2>
		    [/impact_text] [blank_spacer height="50px" width="1/1" el_position="first last"] [posts_carousel title="Latest articles" item_count="4" category="all" show_title="yes" show_excerpt="yes" show_details="yes" excerpt_length="16" width="1/2" el_position="first"] [vc_accordion widget_title="More about us" width="1/4"] [vc_accordion_tab title="Who we are"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
		    
		    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend.
		    
		    [/vc_column_text] [/vc_accordion_tab] [vc_accordion_tab title="What we do"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
		    
		    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
		    
		    [/vc_column_text] [/vc_accordion_tab] [vc_accordion_tab title="Why we do it"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
		    
		    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
		    
		    [/vc_column_text] [/vc_accordion_tab] [vc_accordion_tab title="Where we do it"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
		    
		    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
		    
		    [/vc_column_text] [/vc_accordion_tab] [/vc_accordion] [vc_column_text title="Our Capabilities" pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
		    
		    [progress_bar percentage="75" name="User Interface Design" value="75%" type="" colour="#fb3c2d"]
		    
		    [progress_bar percentage="95" name="Photography" value="95%" type="progress-striped active" colour="#fb3c2d"]
		    
		    [progress_bar percentage="85" name="Branding &amp; Identity" value="85%" type="" colour="#fb3c2d"]
		    
		    [progress_bar percentage="80" name="Project Management" value="80%" type="" colour="#fb3c2d"]
		    
		    [progress_bar percentage="60" name="Marketing" value="60%" type="" colour="#fb3c2d"]
		    
		    [progress_bar percentage="50" name="Logistics" value="50%" type="" colour="#fb3c2d"]
		    
		    [/vc_column_text] [blank_spacer height="33px" width="1/1" el_position="first last"] [testimonial_slider title="Testimonials" text_size="large" item_count="6" order="date" category="all" animation="slide" autoplay="yes" alt_background="alt-two" el_class="mt0 mb0 bb0" width="1/1" el_position="first last"]';
		
		} else if ($template_id == "sf-home-2") {
			
			$content = '[fullwidth_text title="Welcome to Flexform" alt_background="alt-seven" el_class="mb0 mt0 bb0 bt0 no-arrow" width="1/1" el_position="first last"]
			<h1 style="text-align: center;">Flexform is a sleek, wide &amp; incredibly responsive multi-purpose WordPress theme. It is fully translatable, has built WooCommerce support, 14 prebuilt pages, 12 Blog Options, 7 Portfolio Options, 5 Headers + more. It has everything you need to build something exceptional.</h1>
			[/fullwidth_text] [blank_spacer height="10px" width="1/1" el_position="first last"] [portfolio_carousel title="Recent Projects" item_count="6" category="all" alt_background="alt-ten" el_class="bb0 bt0 mb0 mt0" width="1/1" el_position="first last"] [testimonial_slider title="Testimonials" text_size="large" item_count="6" order="date" category="all" animation="fade" autoplay="yes" alt_background="alt-four" el_class="mt0 mb0 bt0 bb0" width="1/1" el_position="first last"] [blank_spacer height="50px" width="1/1" el_position="first last"] [posts_carousel title="Latest Articles" item_count="6" category="all" show_title="yes" show_excerpt="yes" show_details="yes" excerpt_length="16" width="1/1" el_position="first last"] [blank_spacer height="40px" width="1/1" el_position="first last"] [clients_featured title="FEATURED CLIENTS" category="all" alt_background="alt-one" el_class="mt0 mb0 bb0" width="1/1" el_position="first last"]';
		
		} else if ($template_id == "sf-home-3") {
			
			$content = '[blank_spacer height="40px" width="1/1" el_position="first last"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="first"]
			
			[chart percentage="80" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-mobile-phone" align="center"]
			<h3 style="text-align: center;">Incredibly Responsive</h3>
			<p style="text-align: center;">Flexform is completely responsive. And when we say responsive, we mean it won’t only work on mobile devices; it’ll look damn good too!</p>
			<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
			[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
			
			[chart percentage="66" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-pencil" align="center"]
			<h3 style="text-align: center;">Swift Page Builder</h3>
			<p style="text-align: center;">Quickly &amp; easily create beautiful pages. Choose any combination of 37 elements to create unique pages that do your content justice.</p>
			<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
			[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
			
			[chart percentage="55" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-font" align="center"]
			<h3 style="text-align: center;">Superior Typography</h3>
			<p style="text-align: center;">Flexform includes pro Font Deck support. Or you can choose from 600+ Google Web fonts &amp; control the colour, size &amp; line height.</p>
			<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
			[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
			
			[chart percentage="88" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-eye-open" align="center"]
			<h3 style="text-align: center;">Stunning Sliders</h3>
			<p style="text-align: center;">Flexform comes with 3 sliders included. The ever popular Revolution Slider, Woo Slider and our own innovative and stunning Swift Slider.</p>
			<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
			[/vc_column_text] [blank_spacer height="40px" width="1/1" el_position="first last"] [impact_text include_button="yes" title="Take the tour" color="accent" size="standard" type="roundedarrow" target="_self" position="cta_align_right" alt_background="alt-five" el_class="mt0 mb0 bb0 bt0" width="1/1" el_position="first last"]
			<h2>Flexform: A responsive, retina-ready &amp; wide multipurpose Word Press theme.</h2>
			[/impact_text] [blank_spacer height="20px" width="1/1" el_position="first last"] [fullwidth_text title="Meet our team" alt_background="none" el_class="mb0 mt0 bt0 bb0 no-arrow" width="1/1" el_position="first last"] [/fullwidth_text] [team item_count="4" category="all" social_icon_type="dark" pagination="no" el_class="mb0 mt0" width="1/1" el_position="first last"] [vc_gmaps address="London" size="300" type="roadmap" zoom="14" pin_image="6222" fullscreen="yes" el_class="mb0 mt0" width="1/1" el_position="first last"] [testimonial_slider title="Testimonials" text_size="large" item_count="6" order="date" category="all" animation="slide" autoplay="no" alt_background="alt-one" el_class="mt0 mb0 bb0 bt0" width="1/1" el_position="first last"]';
		
		} else if ($template_id == "sf-home-4") {
			
			$content = '[fullwidth_text alt_background="alt-ten" el_class="mb0 mt0 bt0 pb0 no-arrow" width="1/1" el_position="first last"]
			
			[three_fourth]
			
			[slider slide_page="ff-about-office" slider_type="slides"]
			
			[/three_fourth]
			[one_fourth_last]
			
			[chart percentage="90" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="90%" align="center"]
			
			[/one_fourth_last]
			
			[/fullwidth_text] [blank_spacer height="35px" width="1/1" el_position="first last"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
			<h1 style="text-align: center;">Flexform is a sleek, wide &amp; incredibly responsive multi-purpose WordPress theme. It’s fully translatable, has built WooCommerce support, <span style="color: #fb3c2d;">14 prebuilt pages, 12 Blog Options, 7 Portfolio Options, 5 Headers</span> + more. It has everything you need to build something exceptional.</h1>
			[/vc_column_text] [blank_spacer height="20px" width="1/1" el_position="first last"] [divider type="thin" text="Go to top" full_width="no" width="1/1" el_position="first last"] [blank_spacer height="10px" width="1/1" el_position="first last"] [recent_posts title="News &amp; events" item_count="2" category="all" excerpt_length="48" width="1/2" el_position="first"] [team_carousel title="Meet our people" category="circular" social_icon_type="dark" width="1/4"] [vc_column_text title="Get in touch" pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
			
			[vc_gmaps address="London" size="202" type="roadmap" zoom="14" pin_image="6222" fullscreen="no" el_class="ml0" width="1/4"]
			
			Apple Computer Inc
			1 Infinite Loop
			Cupertino CA
			95014
			
			Email: <a href="http://themes.swiftpsd.com/test/flexform/contact/#" target="_blank">youremail@yourdomain.com
			</a>Twitter: <a href="https://twitter.com/swiftIdeas">@SwiftIdeas</a>
			Phone: +44 (0) 208 0000 000
			Fax: +44 (0) 208 0000 001
			
			[/vc_column_text] [blank_spacer height="30px" width="1/1" el_position="first last"]';
		
		} else if ($template_id == "sf-home-5") {
			
			$content = '[impact_text include_button="yes" title="Buy now" color="accent" size="standard" type="roundedarrow" target="_self" position="cta_align_right" alt_background="alt-seven" el_class="mb0 mt0 bt0" width="1/1" el_position="first last"]
			<h2>Hi, I&#39;m Flexform. A responsive, flexible &amp; minimal multipurpose Word Press theme.</h2>
			[/impact_text] [blank_spacer height="60px" width="1/1" el_position="first last"] [vc_column_text title="Incredibly Responsive" icon="icon-mobile-phone" pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="first"]
			
			Flexform is completely responsive. And when we say responsive, we mean it won’t only work on mobile devices; it’ll look damn good too!
			
			<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
			
			[/vc_column_text] [vc_column_text title="Swift Page Builder" icon="icon-pencil" pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
			
			Quickly &amp; easily create beautiful pages. Choose any combination of 37 elements to create unique pages that do your content justice.
			
			<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
			
			[/vc_column_text] [vc_column_text title="Superior Typography" icon="icon-font" pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
			
			Flexform includes pro Font Deck support. Or you can choose from 600+ Google Web fonts &amp; control the colour, size &amp; line height.
			
			<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
			
			[/vc_column_text] [vc_column_text title="Stunning Sliders" icon="icon-eye-open" pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
			
			Flexform comes with 3 sliders included. The ever popular Revolution Slider, Woo Slider and our own innovative and stunning Swift Slider.
			
			<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
			
			[/vc_column_text] [blank_spacer height="36px" width="1/1" el_position="first last"] [portfolio_carousel title="Recent Projects" item_count="6" category="all" alt_background="alt-one" el_class="mt0 mb0" width="1/1" el_position="first last"] [testimonial_slider title="What our clients say" text_size="large" item_count="6" order="date" category="all" animation="fade" autoplay="no" alt_background="alt-seven" el_class="mt0 mb0 bt0" width="1/1" el_position="first last"]';
		
		} else if ($template_id == "sf-home-6") {
			
			$content = '[impact_text include_button="yes" title="Take the tour" color="accent" size="small" type="roundedarrow" target="_self" position="cta_align_right" alt_background="alt-five" el_class="mb0 mt0 bt0 bb0" width="1/1" el_position="first last"]
			<h2>Flexform: A responsive, retina-ready &amp; wide multipurpose Word Press theme.</h2>
			[/impact_text] [blank_spacer height="60px" width="1/1" el_position="first last"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="first"]
			
			[chart percentage="80" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-mobile-phone" align="center"]
			<h3 style="text-align: center;">Incredibly Responsive</h3>
			<p style="text-align: center;">Flexform is completely responsive. And when we say responsive, we mean it won’t only work on mobile devices; it’ll look damn good too!</p>
			<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
			[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
			
			[chart percentage="66" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-pencil" align="center"]
			<h3 style="text-align: center;">Swift Page Builder</h3>
			<p style="text-align: center;">Quickly &amp; easily create beautiful pages. Choose any combination of 37 elements to create unique pages that do your content justice.</p>
			<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
			[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
			
			[chart percentage="88" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-eye-open" align="center"]
			<h3 style="text-align: center;">Stunning Sliders</h3>
			<p style="text-align: center;">Flexform comes with 3 sliders included. The ever popular Revolution Slider, Woo Slider and our own innovative and stunning Swift Slider.</p>
			<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
			[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
			
			[chart percentage="55" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-font" align="center"]
			<h3 style="text-align: center;">Superior Typography</h3>
			<p style="text-align: center;">Flexform includes pro Font Deck support. Or you can choose from 600+ Google Web fonts &amp; control the colour, size &amp; line height.</p>
			<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
			[/vc_column_text] [blank_spacer height="36px" width="1/1" el_position="first last"] [portfolio_carousel title="Recent Projects" item_count="5" category="all" alt_background="alt-one" el_class="mt0 mb0 bb0" width="1/1" el_position="first last"] [testimonial_slider title="Testimonials" text_size="large" item_count="6" order="date" category="all" animation="slide" autoplay="no" alt_background="alt-four" el_class="mt0 bt0" width="1/1" el_position="first last"] [blank_spacer height="20px" width="1/1" el_position="first last"] [recent_posts title="Latest From Our Blog" item_count="4" category="all" excerpt_length="16" width="1/1" el_position="first last"] [blank_spacer height="31px" width="1/1" el_position="first last"]';	
			
		} else if ($template_id == "sf-about-us") {
	 		
	 		$content = '[vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	 		
	 		<span style="text-align: center;"><img class="size-full wp-image-6534 aligncenter" alt="f_about_logo2" src="http://themes.swiftpsd.com/test/flexform/wp-content/uploads/2013/01/f_about_logo2.png" width="100" height="100" /></span>
	 		<h2 style="text-align: center;">Our mission</h2>
	 		<p style="text-align: center;">[hr]</p>
	 		<span style="color: #222222;">[one_half]</span><span style="color: #222222;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed.</span>
	 		
	 		[/one_half]
	 		
	 		[one_half_last]
	 		
	 		Quisque nec nisi tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
	 		
	 		[/one_half_last]
	 		
	 		[/vc_column_text] [blank_spacer height="20px" width="1/1" el_position="first last"] [fullwidth_text alt_background="alt-eight" el_class="mb0 no-arrow" width="1/1" el_position="first last"]
	 		<h2 style="text-align: center;">Services &amp; Capabilities</h2>
	 		<p style="text-align: center;">[hr]</p>
	 		[one_third]
	 		
	 		[chart percentage="85" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-eye-open" align="center"]
	 		<h3 style="text-align: center;">Branding &amp; Identity: <span style="color: #fb3c2d;">85%</span></h3>
	 		<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.</p>
	 		&nbsp;
	 		
	 		[chart percentage="80" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-tasks" align="center"]
	 		<h3 style="text-align: center;">Project Management: <span style="color: #fb3c2d;">80%</span></h3>
	 		<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.</p>
	 		[/one_third]
	 		
	 		[one_third]
	 		
	 		[chart percentage="60" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-bullhorn" align="center"]
	 		<h3 style="text-align: center;">Marketing: <span style="color: #fb3c2d;">60%</span></h3>
	 		<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.</p>
	 		 [chart percentage="50" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-truck" align="center"]
	 		<h3 style="text-align: center;">Logistics: <span style="color: #fb3c2d;">50%</span></h3>
	 		<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.</p>
	 		[/one_third]
	 		
	 		[one_third_last]
	 		
	 		[chart percentage="75" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-sitemap" align="center"]
	 		<h3 style="text-align: center;">User Interface Design: <span style="color: #fb3c2d;">75%</span></h3>
	 		<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.</p>
	 		 [chart percentage="95" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-camera" align="center"]
	 		<h3 style="text-align: center;">Photography: <span style="color: #fb3c2d;">95%</span></h3>
	 		<p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.</p>
	 		[/one_third_last]
	 		
	 		&nbsp;
	 		<p style="text-align: center;">[button colour="black" type="roundedarrow" size="medium" link="http://" target="_self" extra_class="mr0"]Browse our work[/button]</p>
	 		[/fullwidth_text] [fullwidth_text title="Our offices" alt_background="alt-four" el_class="mb0 mt0 bt0 bb0 no-arrow" width="1/1" el_position="first last"]
	 		<p style="text-align: center;">[slider slide_page="ff-about-office" slider_type="slides"]</p>
	 		[/fullwidth_text] [clients_featured title="Featured Clients" category="all" alt_background="alt-two" el_class="mt0 bt0 no-arrow" width="1/1" el_position="first last"] [blank_spacer height="20px" width="1/1" el_position="first last"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	 		<h2 style="text-align: center;">Meet our team</h2>
	 		<p style="text-align: center;">[hr]</p>
	 		[/vc_column_text] [team item_count="12" category="all" social_icon_type="dark" pagination="no" width="1/1" el_position="first last"] [blank_spacer height="20px" width="1/1" el_position="first last"]';
	 	
        } else if ($template_id == "sf-about-us-alt") {
        
	        $content = '[vc_column_text title="Hello and welcome" pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="first"]
	        
	        [slider slide_page="ff-about-office" slider_type="slides"]
	        
	        [/vc_column_text] [vc_tabs tab_asset_title="Why choose us?" width="1/2" el_position="last"] [vc_tab title="Approach"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        
	        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
	        
	        Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
	        
	        [/vc_column_text] [/vc_tab] [vc_tab title="Support"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        
	        Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
	        
	        [/vc_column_text] [/vc_tab] [vc_tab title="Services"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        
	        Suspendisse bibendum cursus luctus. Donec consequat malesuada felis at faucibus. Nulla dapibus malesuada libero, ut iaculis elit mattis quis. Sed nec dui tortor, ut venenatis libero. Etiam venenatis, nisl sit amet vestibulum molestie, nulla orci consequat leo, vitae commodo odio lectus vitae lacus. Morbi sed dictum diam. Aenean et ipsum eget leo auctor dignissim. Maecenas tincidunt dictum nibh, at interdum lorem interdum ut.
	        
	        [/vc_column_text] [/vc_tab] [vc_tab title="Capabilities"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        
	        Ut lobortis malesuada urna nec egestas. In eget magna vitae est elementum placerat. Suspendisse gravida vulputate purus, eu pulvinar diam scelerisque quis. Maecenas sed leo in velit malesuada ullamcorper. Donec dictum hendrerit erat et ultricies. Mauris nulla neque, sodales in ultrices vel, porta id orci. Maecenas tortor nulla, eleifend id mollis nec, iaculis eu arcu. Mauris placerat molestie convallis. Morbi vitae scelerisque quam. Duis vel posuere ipsum. Mauris a nisi magna. Nam ut nulla a elit viverra commodo vestibulum vel purus. Maecenas aliquam arcu sed mi congue sollicitudin.
	        
	        [/vc_column_text] [/vc_tab] [/vc_tabs] [blank_spacer height="20px" width="1/1" el_position="first last"] [divider type="thin" text="Go to top" full_width="yes" width="1/1" el_position="first last"] [blank_spacer height="20px" width="1/1" el_position="first last"] [vc_accordion widget_title="More about us" width="1/2" el_position="first"] [vc_accordion_tab title="Who we are"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        
	        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio.
	        
	        [/vc_column_text] [/vc_accordion_tab] [vc_accordion_tab title="What we do"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        
	        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
	        
	        [/vc_column_text] [/vc_accordion_tab] [vc_accordion_tab title="Why we do it"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        
	        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
	        
	        [/vc_column_text] [/vc_accordion_tab] [vc_accordion_tab title="Where we do it"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        
	        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi tortor. Etiam at mauris sit amet magna suscipit hend merit non sed ligula. Vivamus purus odio, mollis.
	        
	        [/vc_column_text] [/vc_accordion_tab] [/vc_accordion] [vc_column_text title="Our Capabilities" pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="last"]
	        
	        [progress_bar percentage="75" name="User Interface Design" value="75%" type="" colour="#fb3c2d"]
	        
	        [progress_bar percentage="95" name="Photography" value="95%" type="progress-striped active" colour="#fb3c2d"]
	        
	        [progress_bar percentage="85" name="Branding &amp; Identity" value="85%" type="" colour="#fb3c2d"]
	        
	        [progress_bar percentage="80" name="Project Management" value="80%" type="" colour="#fb3c2d"]
	        
	        [progress_bar percentage="60" name="Marketing" value="60%" type="" colour="#fb3c2d"]
	        
	        [progress_bar percentage="50" name="Logistics" value="50%" type="" colour="#fb3c2d"]
	        
	        [/vc_column_text] [blank_spacer height="20px" width="1/1" el_position="first last"] [clients_featured title="Featured Clients" category="all" alt_background="alt-seven" el_class="mb0 bb0 no-arrow" width="1/1" el_position="first last"] [testimonial_slider title="What our clients say about us" text_size="large" item_count="6" order="rand" category="all" animation="slide" autoplay="yes" alt_background="alt-five" el_class="mt0 bt0 no-arrow" width="1/1" el_position="first last"] [blank_spacer height="20px" width="1/1" el_position="first last"] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
	        <h3 style="text-align: center;">Meet the team</h3>
	        <p style="text-align: center;">[hr]</p>
	        [/vc_column_text] [team item_count="12" category="all" social_icon_type="dark" pagination="no" width="1/1" el_position="first last"] [blank_spacer height="20px" width="1/1" el_position="first last"]';
        
        } else if ($template_id == "sf-contact") {
        
            $content = '[vc_gmaps address="London" size="400" type="roadmap" zoom="14" pin_image="6222" fullscreen="yes" width="1/1" el_position="first last"] [blank_spacer height="20px" width="1/1" el_position="first last"] [vc_column_text pb_margin_bottom="yes" pb_border_bottom="no" width="3/4" el_position="first"]
            
            [contact-form-7 id="1183" title="Contact form 1"]
            
            [/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
            <h3>Want to talk to a human being? Hit the button below to call us on Skype.</h3>
            [button colour="black" type="rounded" size="large" link="#" target="_self]+44 (0) 800 123 4567[/button]
            
            &nbsp;
            
            Apple Computer Inc
            1 Infinite Loop
            Cupertino CA
            95014
            
            Email: <a href="#" target="_blank">youremail@yourdomain.com
            </a>Twitter: <a href="https://twitter.com/swiftIdeas">@SwiftIdeas</a>
            Phone: +44 (0) 208 0000 000
            Fax: +44 (0) 208 0000 001
            
            [/vc_column_text] [blank_spacer height="11px" width="1/1" el_position="first last"]';
        
        } else if ($template_id == "sf-contact") {
        
            $content = '[vc_column_text title="Send us a message" pb_margin_bottom="yes" pb_border_bottom="no" width="1/2" el_position="first"]
            
            [contact-form-7 id="1183" title="Contact form 1"]
            
            [/vc_column_text] [vc_gmaps address="London" size="534" type="roadmap" zoom="14" pin_image="6222" width="1/2" el_position="last"] [blank_spacer height="11px" width="1/1" el_position="first last"]';
        
        } else if ($template_id == "sf-contact-alt") {
        
            $content = '[vc_column_text title="Send us a message" pb_margin_bottom="yes" pb_border_bottom="no" width="1/2" el_position="first"]
            
            [contact-form-7 id="1183" title="Contact form 1"]
            
            [/vc_column_text] [vc_gmaps address="London" size="534" type="roadmap" zoom="14" pin_image="6222" width="1/2" el_position="last"] [blank_spacer height="11px" width="1/1" el_position="first last"]';
        
        } else if ($template_id == "sf-help-faq") {
        
        	$content = '[faqs width="1/1" el_position="first last"] [blank_spacer height="20px" width="1/1" el_position="first last"]';
        
        } else if ($template_id == "sf-our-offices") {

        	$content = '[fullwidth_text alt_background="alt-four" el_class="mt0 mb0 bt0 bb0 no-arrow" width="1/1" el_position="first last"]
        	<p style="text-align: center;">[slider slide_page="ff-about-office" slider_type="slides"]</p>
        	[/fullwidth_text] [portfolio_carousel title="Recent Projects" item_count="6" category="all" show_title="yes" show_client="no" show_excerpt="no" excerpt_length="14" alt_background="alt-eight" el_class="bt0 mt0 mb0" width="1/1" el_position="first last"]';
        
        } else if ($template_id == "sf-services") {

        	$content = '[vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="first"]
        	
        	[chart percentage="100" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-mobile-phone" align="center"]
        	<h3 style="text-align: center;">Incredibly Responsive</h3>
        	<p style="text-align: center;">Flexform is completely responsive. And when we say responsive, we mean it won’t only work on mobile devices; it’ll look damn good too!</p>
        	<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
        	[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
        	
        	[chart percentage="100" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-pencil" align="center"]
        	<h3 style="text-align: center;">Swift Page Builder</h3>
        	<p style="text-align: center;">Quickly &amp; easily create beautiful pages. Choose any combination of 37 elements to create unique pages that do your content justice.</p>
        	<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
        	[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
        	
        	[chart percentage="100" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-font" align="center"]
        	<h3 style="text-align: center;">Superior Typography</h3>
        	<p style="text-align: center;">Flexform includes pro Font Deck support. Or you can choose from 600+ Google Web fonts &amp; control the colour, size &amp; line height.</p>
        	<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
        	[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
        	
        	[chart percentage="100" size="170" barcolour="#fb3c2d" trackcolour="#fececa" content="icon-eye-open" align="center"]
        	<h3 style="text-align: center;">Stunning Sliders</h3>
        	<p style="text-align: center;">Flexform comes with 3 sliders included. The ever popular Revolution Slider, Woo Slider and our own innovative and stunning Swift Slider.</p>
        	<p style="text-align: center;"><a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a></p>
        	[/vc_column_text] [blank_spacer height="40px" width="1/1" el_position="first last"] [divider type="thin" text="Go to top" full_width="yes" width="1/1" el_position="first last"] [blank_spacer height="18px" width="1/1" el_position="first last"] [vc_column_text title="Our Capabilities" pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
        	
        	[progress_bar percentage="75" name="User Interface Design" value="75%" type="" colour="#fb3c2d"]
        	
        	[progress_bar percentage="95" name="Photography" value="95%" type="progress-striped active" colour="#fb3c2d"]
        	
        	[progress_bar percentage="85" name="Branding &amp; Identity" value="85%" type="" colour="#fb3c2d"]
        	
        	[progress_bar percentage="80" name="Project Management" value="80%" type="" colour="#fb3c2d"]
        	
        	[progress_bar percentage="60" name="Marketing" value="60%" type="" colour="#fb3c2d"]
        	
        	[progress_bar percentage="50" name="Logistics" value="50%" type="" colour="#fb3c2d"]
        	
        	[/vc_column_text] [blank_spacer height="28px" width="1/1" el_position="first last"] [clients_featured title="Our Amazing Clients" category="all" alt_background="alt-two" el_class="no-arrow" width="1/1" el_position="first last"] [blank_spacer height="28px" width="1/1" el_position="first last"] [vc_column_text title="Unlimited Colors" icon="icon-tint" pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="first"]
        	
        	Lorem ipsum dolor sit amet, cons tet ur adipisicing et elit, sed mod. incidid un ut out labore et dolore magna minim veniam, quis.
        	
        	<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
        	
        	[/vc_column_text] [vc_column_text title="Extensive Options" icon="icon-wrench" pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
        	
        	Lorem ipsum dolor sit amet, cons tet ur adipisicing et elit, sed mod. incidid un ut out labore et dolore magna minim veniam, quis.
        	
        	<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
        	
        	[/vc_column_text] [vc_column_text title="Shortcode Library" icon="icon-cog" pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
        	
        	Lorem ipsum dolor sit amet, cons tet ur adipisicing et elit, sed mod. incidid un ut out labore et dolore magna minim veniam, quis.
        	
        	<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
        	
        	[/vc_column_text] [vc_column_text title="Font Awesome Icons" icon="icon-bolt" pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
        	
        	Lorem ipsum dolor sit amet, cons tet ur adipisicing et elit, sed mod. incidid un ut out labore et dolore magna minim veniam, quis.
        	
        	<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
        	
        	[/vc_column_text] [blank_spacer height="30px" width="1/1" el_position="first last"] [vc_column_text title="Page Templates" icon="icon-file-alt" pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="first"]
        	
        	Lorem ipsum dolor sit amet, cons tet ur adipisicing et elit, sed mod. incidid un ut out labore et dolore magna minim veniam, quis.
        	
        	<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
        	
        	[/vc_column_text] [vc_column_text title="5-Star Support" icon="icon-trophy" pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
        	
        	Lorem ipsum dolor sit amet, cons tet ur adipisicing et elit, sed mod. incidid un ut out labore et dolore magna minim veniam, quis.
        	
        	<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
        	
        	[/vc_column_text] [vc_column_text title="Translation Ready" icon="icon-globe" pb_margin_bottom="no" pb_border_bottom="no" width="1/4"]
        	
        	Lorem ipsum dolor sit amet, cons tet ur adipisicing et elit, sed mod. incidid un ut out labore et dolore magna minim veniam, quis.
        	
        	<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
        	
        	[/vc_column_text] [vc_column_text title="SEO Optimized" icon="icon-search" pb_margin_bottom="no" pb_border_bottom="no" width="1/4" el_position="last"]
        	
        	Lorem ipsum dolor sit amet, cons tet ur adipisicing et elit, sed mod. incidid un ut out labore et dolore magna minim veniam, quis.
        	
        	<a class="read-more" href="#">Find out more <i class="icon-chevron-right">&gt;</i></a>
        	
        	[/vc_column_text] [blank_spacer height="30px" width="1/1" el_position="first last"] [testimonial_slider title="Client testimonials" text_size="large" item_count="6" order="rand" category="all" animation="fade" autoplay="no" alt_background="alt-two" el_class="mb0 bb0 no-arrow" width="1/1" el_position="first last"]';
        
        } else if ($template_id == "sf-meet-the-team") {

        	$content = '[team item_count="4" category="all" social_icon_type="dark" pagination="yes" el_class="pb0 mb0" width="1/1" el_position="first last"] [impact_text include_button="yes" title="Browse work" color="accent" size="standard" type="roundedarrow" target="_self" position="cta_align_right" alt_background="alt-one" el_class="mt0 no-arrow" width="1/1" el_position="first last"]
        	<p class="impact-text">Our team works hard to create amazing things, check them out.</p>
        	[/impact_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
        	<h3 style="text-align: center;">Fun facts about the team</h3>
        	<p style="text-align: center;">[hr]</p>
        	[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="first"]
        	
        	[one_fourth]<img class="alignnone size-full wp-image-6756" alt="ff_team4_retina_bw" src="http://themes.swiftpsd.com/test/flexform/wp-content/uploads/2013/03/ff_team4_retina_bw.jpg" width="540" height="540" />
        	
        	[/one_fourth]
        	
        	[three_fourth_last]
        	
        	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie.
        	
        	[/three_fourth_last]
        	
        	&nbsp;
        	
        	[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="last"]
        	
        	[one_fourth]<img class="alignnone size-full wp-image-6615" alt="ff_team1_retina_bw" src="http://themes.swiftpsd.com/test/flexform/wp-content/uploads/2013/03/ff_team1_retina_bw.jpg" width="540" height="540" />
        	
        	[/one_fourth]
        	
        	[three_fourth_last]
        	
        	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie.
        	
        	[/three_fourth_last]
        	
        	&nbsp;
        	
        	[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="first"]
        	
        	[one_fourth]<img class="alignnone size-full wp-image-6616" alt="team2_retina_bw" src="http://themes.swiftpsd.com/test/flexform/wp-content/uploads/2013/03/team2_retina_bw.jpg" width="540" height="540" />
        	
        	[/one_fourth]
        	
        	[three_fourth_last]
        	
        	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie.
        	
        	[/three_fourth_last]
        	
        	&nbsp;
        	
        	[/vc_column_text] [vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="last"]
        	
        	[one_fourth]<img class="alignnone size-full wp-image-6614" alt="ff_team3_retina_bw" src="http://themes.swiftpsd.com/test/flexform/wp-content/uploads/2012/11/ff_team3_retina_bw.jpg" width="540" height="540" />
        	
        	[/one_fourth]
        	
        	[three_fourth_last]
        	
        	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie hendrerit. Quisque nec nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse viverra mauris eget tortor imperdiet vehicula. Proin egestas diam ac mauris molestie.
        	
        	[/three_fourth_last]
        	
        	&nbsp;
        	
        	[/vc_column_text]';
        
        } else if ($template_id == "sf-pricing") {

        	$content = '[vc_column_text pb_margin_bottom="no" pb_border_bottom="no" width="1/1" el_position="first last"]
        	
        	[labelled_pricing_table columns="5"]
        	
        	[lpt_label_column]
        	
        	[lpt_row_label alt="yes"] Feature 1 [/lpt_row_label]
        	
        	[lpt_row_label] Feature 2[/lpt_row_label]
        	
        	[lpt_row_label alt="yes"] Feature 3 [/lpt_row_label]
        	
        	[lpt_row_label] Feature 4 [/lpt_row_label]
        	
        	[lpt_row_label alt="yes"] Feature 5 [/lpt_row_label]
        	
        	[lpt_row_label] Feature 6 [/lpt_row_label]
        	
        	[lpt_row_label alt="yes"] Feature 7 [/lpt_row_label]
        	
        	[lpt_row_label] Feature 8 [/lpt_row_label]
        	
        	[/lpt_label_column]
        	
        	[lpt_column]
        	
        	[lpt_price]$100<span>/ mo.</span>[/lpt_price]
        	
        	[lpt_package]Basic Package[/lpt_package]
        	
        	[lpt_row_label alt="yes"] LABEL 0 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] - [/lpt_row]
        	
        	[lpt_row_label] LABEL 1 [/lpt_row_label]
        	
        	[lpt_row] 10 [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 2 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 3 [/lpt_row_label]
        	
        	[lpt_row] - [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 4 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] 100[/lpt_row]
        	
        	[lpt_row_label] LABEL 5 [/lpt_row_label]
        	
        	[lpt_row] - [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 6 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 7 [/lpt_row_label]
        	
        	[lpt_row] yes [/lpt_row]
        	
        	[lpt_button link="#" target="_self"]Buy now[/lpt_button]
        	
        	[/lpt_column]
        	
        	[lpt_column]
        	
        	[lpt_price]$150<span>/ mo.</span>[/lpt_price]
        	
        	[lpt_package]Standard Package[/lpt_package]
        	
        	[lpt_row_label alt="yes"] LABEL 0 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] - [/lpt_row]
        	
        	[lpt_row_label] LABEL 1 [/lpt_row_label]
        	
        	[lpt_row] 25 [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 2 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 3 [/lpt_row_label]
        	
        	[lpt_row] - [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 4 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] 150 [/lpt_row]
        	
        	[lpt_row_label] LABEL 5 [/lpt_row_label]
        	
        	[lpt_row] - [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 6 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 7 [/lpt_row_label]
        	
        	[lpt_row] yes [/lpt_row]
        	
        	[lpt_button link="#" target="_self"]Buy now[/lpt_button]
        	
        	[/lpt_column]
        	
        	[lpt_column highlight="yes"]
        	
        	[lpt_price]$200<span>/ mo.</span>[/lpt_price]
        	
        	[lpt_package]Premium Package[/lpt_package]
        	
        	[lpt_row_label alt="yes"] LABEL 0 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 1 [/lpt_row_label]
        	
        	[lpt_row] 50 [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 2 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 3 [/lpt_row_label]
        	
        	[lpt_row] yes [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 4 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] 200 [/lpt_row]
        	
        	[lpt_row_label] LABEL 5 [/lpt_row_label]
        	
        	[lpt_row] - [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 6 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 7 [/lpt_row_label]
        	
        	[lpt_row] yes [/lpt_row]
        	
        	[lpt_button link="#" target="_self"]Buy now[/lpt_button]
        	
        	[/lpt_column]
        	
        	[lpt_column]
        	
        	[lpt_price]$250<span>/ mo.</span>[/lpt_price]
        	
        	[lpt_package]Pro Package[/lpt_package]
        	
        	[lpt_row_label alt="yes"] LABEL 0 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 1 [/lpt_row_label]
        	
        	[lpt_row] 100 [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 2 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 3 [/lpt_row_label]
        	
        	[lpt_row] yes [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 4 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] 250 [/lpt_row]
        	
        	[lpt_row_label] LABEL 5 [/lpt_row_label]
        	
        	[lpt_row] yes [/lpt_row]
        	
        	[lpt_row_label alt="yes"] LABEL 6 [/lpt_row_label]
        	
        	[lpt_row alt="yes"] yes [/lpt_row]
        	
        	[lpt_row_label] LABEL 7 [/lpt_row_label]
        	
        	[lpt_row] yes [/lpt_row]
        	
        	[lpt_button link="#" target="_self"]Buy now[/lpt_button]
        	
        	[/lpt_column]
        	
        	[/labelled_pricing_table]
        	
        	[/vc_column_text] [testimonial_slider title="What our customers say" text_size="large" item_count="6" order="rand" category="all" animation="fade" autoplay="yes" alt_background="alt-five" width="1/1" el_position="first last"] [blank_spacer height="50px" width="1/1" el_position="first last"] [vc_column_text title="Am I going to be tied into a contract?" pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="first"]
        	
        	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In porta facilisis quam eu interdum. Quisque volutpat erat eget arcu malesuada porttitor. Maecenas vel nunc turpis, tempor vulputate nisi. Sed vel.
        	
        	[/vc_column_text] [vc_column_text title="How do I sign up?" pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="last"]
        	
        	Mauris malesuada elementum mauris, in posuere justo ornare nec. Nam ornare, nulla nec venenatis posuere, libero velit blandit mauris, a vestibulum urna lectus vitae dui. Nunc tellus mi, mollis at.
        	
        	[/vc_column_text] [blank_spacer height="40px" width="1/1" el_position="first last"] [vc_column_text title="How much is unlimited?" pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="first"]
        	
        	Fusce enim sapien, porttitor eget auctor ac, mollis vel augue. Aliquam erat volutpat. Vivamus at sapien a justo consequat egestas. Suspendisse hendrerit mauris at sapien sodales sit amet eleifend dolor.
        	
        	[/vc_column_text] [vc_column_text title="Can I upgrade at a later date?" pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="last"]
        	
        	Vestibulum ac tempor magna. Nulla consequat ornare lorem, accumsan ultrices sem placerat et. Donec felis mi, ultrices et tristique eu, pretium vel ligula. Nulla facilisi. Nulla fermentum, sapien eu varius.
        	
        	[/vc_column_text] [blank_spacer height="40px" width="1/1" el_position="first last"] [vc_column_text title="How do I cancel my agreement?" pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="first"]
        	
        	Nunc dignissim varius quam vitae sollicitudin. Phasellus odio felis, bibendum vitae egestas eu, congue et orci. Nam sed eros augue, eu dignissim lacus. Curabitur et tortor ultricies diam condimentum iaculis.
        	
        	[/vc_column_text] [vc_column_text title="Do I get a free t-shirt?" pb_margin_bottom="no" pb_border_bottom="no" width="1/2" el_position="last"]
        	
        	Morbi elementum consectetur rutrum. Nullam quam velit, posuere eget convallis bibendum, mattis at velit. Etiam blandit, diam sed accumsan gravida, arcu ligula vestibulum ante, a molestie est dui ut velit.
        	
        	[/vc_column_text] [blank_spacer height="40px" width="1/1" el_position="first last"] [fullwidth_text alt_background="alt-one" el_class="mb0 pb0 no-arrow" width="1/1" el_position="first last"]
        	<h2 style="text-align: center; margin-bottom: 20px;">Ready to experience the next generation?</h2>
        	<p style="text-align: center;">[button colour="accent" type="roundedarrow" size="large" link="#" target="_self"]Sign up today[/button]</p>
        	[/fullwidth_text]';
        
        } else if ($template_id == "sf-portfolio") {

        	$content = '[portfolio display_type="standard" columns="1" show_title="yes" show_subtitle="yes" show_excerpt="no" excerpt_length="120" item_count="5" category="single-column" portfolio_filter="yes" pagination="yes" width="1/1" el_position="first last"]';
    
        } else if ($template_id == "sf-blog") {

        	$content = '[blog blog_type="standard" item_count="5" category="all" show_title="yes" show_excerpt="yes" show_details="yes" excerpt_length="65" pagination="yes" width="1/1" el_position="first last"]';
        
        }
        
        
        echo do_shortcode($content);

        die();
    }
}