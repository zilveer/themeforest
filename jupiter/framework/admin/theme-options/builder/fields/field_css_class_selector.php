<?php

/**
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0
 * @package     artbees
 */

// Exit if accessed directly
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

// Don't duplicate me!
if (!class_exists('Mk_Options_Framework_Fields_Css_Class_Selector')) {
    
    class Mk_Options_Framework_Fields_Css_Class_Selector extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value, $saved_options) {
            
            $this->saved_options = $saved_options;
            $this->field = $value['type'];
            $this->name = $value['name'];
            $this->id = $value['id'];
            $this->default = parent::saved_default_value($this->id, $value['default']);
            $this->description = $value['desc'];
            $this->options = array(
                'body' => __("Body", "mk_framework"),
                'h1' => __("Heading 1", "mk_framework"),
                'h2' => __("Heading 2", "mk_framework"),
                'h3' => __("Heading 3", "mk_framework"),
                'h4' => __("Heading 4", "mk_framework"),
                'h5' => __("Heading 5", "mk_framework"),
                'h6' => __("Heading 6", "mk_framework"),
                'p' => __("Paragraphs", "mk_framework"),
                'a' => __("Links", "mk_framework"),
                'textarea,input,select,button' => __("Form Elements", "mk_framework"),
                '#mk-page-introduce' => __("Global Page Title", "mk_framework"),
                ".the-title" => __("Blog & Portfolio Titles", "mk_framework"),
                ".mk-edge-title, .edge-title" => __("Edge Slider Title", "mk_framework"),
                ".mk-edge-desc, .edge-desc" => __("Edge Slider Description", "mk_framework"),
                '.main-navigation-ul, .mk-vm-menuwrapper' => __("Main Navigation Links", "mk_framework"),
                '#mk-footer-navigation ul li a' => __("Footer Navigation", "mk_framework"),
                '.vm-header-copyright' => __("Vertical Header Copyright Text", "mk_framework"),
                '.mk-footer-copyright' => __("Footer Copyright", "mk_framework"),
                '.mk-content-box' => __("Content Box Shortcode", "mk_framework"),
                ".filter-portfolio a" => __("Portfolio Filter Links", "mk_framework"),
                ".mk-button" => __("Buttons Shortcode", "mk_framework"),
                ".mk-blockquote" => __("Blockquote Shortcode", "mk_framework"),
                '.mk-pricing-table .mk-offer-title, .mk-pricing-table .mk-pricing-plan, .mk-pricing-table .mk-pricing-price' => __("Pricing Table Headings", "mk_framework"),
                '.mk-tabs-tabs a' => __("Tabs Shortcode", "mk_framework"),
                '.mk-accordion-tab' => __("Accordion Shortcode", "mk_framework"),
                '.mk-toggle-title' => __("Toggle Shortcode", "mk_framework"),
                '.mk-dropcaps' => __("Dropcaps Shortcode", "mk_framework"),
                '.mk-single-price, .mk-price' => __("Woocommerce Price Amount", "mk_framework"),
                '.mk-imagebox' => __("Image Box Shortcode", "mk_framework"),
                '.mk-event-countdown' => __("Event Countdown Shortcode", "mk_framework"),
                '.mk-fancy-title' => __("Fancy Title Shortcode", "mk_framework"),
                '.mk-button-gradient' => __("Gradient Buttons Shortcode", "mk_framework"),
                '.mk-iconBox-gradient' => __("Gradient Icon Box Shortcode", "mk_framework"),
                '.mk-custom-box' => __("Custom Box Shortcode", "mk_framework"),
                '.mk-ornamental-title' => __("Ornamental Title Shortcode", "mk_framework"),
                '.mk-subscribe' => __("Subscribe Shortcode", "mk_framework"),
                '.mk-timeline' => __("Timeline Shortcode", "mk_framework"),
                '.mk-blog-container .mk-blog-meta .the-title, .post .blog-single-title, .mk-blog-hero .content-holder .the-title, .blog-blockquote-content, .blog-twitter-content' => __("Blog Post Headings", "mk_framework"),
                '.mk-blog-container .mk-blog-meta .the-excerpt p, .mk-single-content p' => __("Blog Post Body", "mk_framework"),
                '.mk-employees .mk-employee-item .team-info-wrapper .team-member-name' => __("Employee Shortcode Title", "mk_framework"),
                '.mk-testimonial-quote' => __("Testimonial Shortcode Quote", "mk_framework"),
                '.mk-contact-form, .mk-contact-form input,.mk-contact-form button' => __("Contact Form Shortcode & Widget", "mk_framework"),
                '.mk-box-icon .icon-box-title' => __("Icon Box Shortcode Title", "mk_framework"),
                
            );
        } 
        public function render() {
            
            $output = '<select class="mk-select mk-chosen" name="' . $this->id . '[]" id="' . $this->id . '" multiple="multiple" style="width:70%;">';
            if (!empty($this->options) && is_array($this->options)) {
                foreach ($this->options as $key => $option) {
                    $output.= '<option value="' . $key . '"';
                    if (isset($this->saved_options[$this->id])) {
                        if (is_array($this->saved_options[$this->id])) {
                            if (in_array($key, $this->saved_options[$this->id])) {
                                $output.= ' selected="selected"';
                            }
                        }
                    } 
                    else if (in_array($key, $this->default)) {
                        $output.= ' selected="selected"';
                    }
                    $output.= '>' . $option . '</option>';
                }
            }
            $output.= '</select>';
            
            return parent::field_wrapper($this->id, $this->name, $this->description, $output);
        }
        
        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {
        }
    }
}
