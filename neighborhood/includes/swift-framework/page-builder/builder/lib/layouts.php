<?php
	
	/*
	*
	*	Swift Page Builder - Shortcode Mapper Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	class SPBLayoutButton implements SPBTemplateInterface {
        protected $params = Array();

        public function setup( $params ) {
            if ( empty( $params['id'] ) || empty( $params['title'] ) ) {
                trigger_error( "Wrong layout params" );
            }
            $this->params = (array) $params;

            return $this;
        }

        public function output( $post = null ) {
            if ( empty( $this->params ) ) {
                return '';
            }
            $output = "";
            if ( $this->params['id'] == "row" ) {
                $output = '<li class="row-option"><a id="' . $this->params['id'] . '" data-element="spb_row" data-width="' . $this->params['id'] . '" class="' . $this->params['id'] . ' clickable_layout_action dropable_column" href="#"><span>' . __( $this->params['title'], 'swiftframework' ) . '</span></a></li>';
            } else {
                $output = '<li><a id="' . $this->params['id'] . '" data-element="spb_column" data-width="' . $this->params['id'] . '" class="' . $this->params['id'] . ' clickable_layout_action dropable_column" href="#"><span>' . __( $this->params['title'], 'swiftframework' ) . '</span></a></li>';
            }

            return $output;
        }
    }
	
	
	class SPBTemplateMenuButton implements SPBTemplateInterface {
	    protected $params = Array();
	    protected $id;
	
	    public function setID($id) {
	        $this->id = (string)$id;
	        return $this;
	    }
	    public function setup($params) {
	        $this->params = (array)$params;
	        return $this;
	    }
	
	    public function output($post = null) {
	        if(empty($this->params)) return '';
	        $output = '<li class="spb_template_li"><a data-template_id="'.$this->id.'" href="#">'.__($this->params['name'], "swiftframework").'</a> <span class="spb_remove_template"><i class="icon-trash spb_template_delete_icon"> </i> </span></li>';
	        return $output;
	    }
	}
	
	class SPBElementButton implements SPBTemplateInterface {
	    protected $params = Array();
	    protected $base;
	
	    public function setBase($base) {
	        $this->base = $base;
	        return $this;
	    }
	    public function setup($params) {
	        $this->params = $params;
	        return $this;
	    }
	    protected function getIcon() {
	        return !empty($this->params['icon']) ? '<i class="' . sanitize_title($this->params['icon']) . '"></i> ' : '';
	    }
	    public function output($post = null) {
	        if(empty($this->params)) return '';
	        $output = $class = '';
	        if ( isset( $this->params["class"] ) && $this->params["class"] != '' ) {
                $class_ar = explode( " ", $this->params["class"] );
                for ( $n = 0; $n < count( $class_ar ); $n ++ ) {
                    $class_ar[ $n ] .= "_nav";
                }
                $class = ' ' . implode( " ", $class_ar );
            }
	        $output .= '<li class="' . $this->base . '"><a data-element="' . $this->base . '" id="' . $this->base . '" class="dropable_el clickable_action'.$class.'" href="#">' . $this->getIcon() . __($this->params["name"], "swiftframework") .'</a></li>';
	        
	        if ( $this->base != "spb_column" && $this->base != "spb_row" ) {
                return $output;
            }
	    }
	}
	
	class SPBTemplateMenu implements SPBTemplateInterface {
	    protected $params = Array();
	
	    public function setup($params) {
	        $this->params = (array)$params;
	        return $this;
	    }
	
	    public function output( $post = null ) {
	        if(empty($this->params)) return '';
	        $output =  '<li class="nav-header">'.__('Save Template', "swiftframework").'</li>
		                <li id="spb_save_template"><a href="#">'.__('Save current page as a Template', "swiftframework").'</a></li>
		                <li class="divider"></li>
		                <li class="nav-header">'.__('Load Template', "swiftframework").'</li>';
	        $is_empty = true;
	        foreach($this->params as $id => $template) {
	            if( is_array( $template) ) {
	                $template_button = new SPBTemplateMenuButton();
	                $output .= $template_button->setup($template)->setID($id)->output();
	               $is_empty = false;
	            }
	        }
	        if($is_empty) $output .= '<li class="spb_no_templates"><span>'.__('No custom templates yet.', "swiftframework").'</span></li>';
	        return $output;
	    }
	}
	
	class SPBTemplate_r extends SFPageBuilderAbstract {
	
	    protected $templates = Array();
	
	    public function getMenu() {
	        $template_menu = new SPBTemplateMenu();
	        return $template_menu->setup($this->getTemplatesList())->output();
	    }
	    protected function getTemplates() {
	        if($this->templates==null)
	            $this->templates = (array)get_option('spb_js_templates');
	        return $this->templates;
	    }
	
	    public function getTemplatesList() {
	        return $this->getTemplates();
	    }
	}
	
	class SPBNavBar implements SPBTemplateInterface {
	    public function __construct() {
	
	    }
	    public function getColumnLayouts() {
	        $output = '';
	        foreach ( SPBMap::getLayouts() as $layout ) {
	            $layout_button = new SPBLayoutButton();
	            $output .= $layout_button->setup($layout)->output();
	        }
	        return $output;
	    }
	
	    public function getContentLayouts() {
	        $output = '';
	        foreach (SPBMap::getShortCodes() as $sc_base => $el) {
	            $element_button = new SPBElementButton();
	            $output .= $element_button->setBase($sc_base)->setup($el) ->output();
	        }
	
	        return $output;
	    }
	
	    public function getTemplateMenu() {
	        $template_r = new SPBTemplate_r();
	        return $template_r->getMenu();
	    }
		    
	    public function output($post = null) {
	        $output = '
	            <div id="spb-elements" class="navbar">
	                <div class="navbar-inner">
	                    <div class="container">
	                        <div class="nav-collapse">
	                            <ul class="nav">
	                                <li class="dropdown content-dropdown">
	                                    <a class="dropdown-toggle spb_content_elements" data-slideout="spb-content-elements" href="#">'.__("Choose Elements", "swiftframework").' <b class="caret"></b></a>
	                                    <ul class="dropdown-menu spb_elements_ul">
	                                        '.$this->getContentLayouts().'
	                                    </ul>
	                                </li>
	                            </ul>';
	                            
            $output .= '<ul class="nav pull-left columns-dropdown">
            	                            	<li class="dropdown">
                    								<a class="dropdown-toggle spb_columns" href="#">' . __( "Layout", "swiftframework" ) . ' <b class="caret"></b></a>
                    								<ul class="dropdown-menu">
                    									' . $this->getColumnLayouts() . '
                    								</ul>
                    							</li>
            	                            </ul>';
	                            
			$output .= '<ul class="nav pull-left pre-built-pages-nav">
	                                <li class="dropdown">
	                                    <a class="dropdown-toggle spb_prebuilt_pages" data-slideout="spb-prebuilt-pages" href="#">'.__('Pre-Built Pages', "swiftframework").' <b class="caret"></b></a>
	                                    <ul class="dropdown-menu spb_templates_ul">
	                            			<li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home">Home</a></li>
	                            			<li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-2">Home (Example Two)</a></li>
	                            			<li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-3">Home (Example Three)</a></li>
	                            			<li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-4">Home (Example Four)</a></li>
	                            			<li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-5">Home (Example Five)</a></li>
	                            			<li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-6">Home (Example Six)</a></li>
	                            			<li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-7">Home (Example Seven)</a></li>
	                            			<li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-8">Home (Example Eight)</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-about-us">About Us</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-about-us-alt">About Us (Alt)</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-contact">Contact</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-contact-alt">Contact (Alt)</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-help-faq">Help Center / F.A.Q</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-our-offices">Our Offices</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-services">Services & Capabilities</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-meet-the-team">Meet the team</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-pricing">Pricing</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-portfolio">Portfolio</a></li>
	                                        <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-blog">Blog</a></li>
	                                    </ul>
	                                </li>
	                            </ul>
	                            
	                            <ul class="nav pull-left custom-templates-nav">
	                                <li class="dropdown">
	                                    <a class="dropdown-toggle spb_templates" data-slideout="spb-custom-templates" href="#">'.__('Custom Templates', "swiftframework").' <b class="caret"></b></a>
	                                    <ul class="dropdown-menu spb_templates_ul">
	                                        '.$this->getTemplateMenu().'
	                                    </ul>
	                                </li>
	                            </ul>
	                            
	                            <ul class="nav pull-left">
	                            	<li>
	                            		<a id="clear-spb" href="#">' . __( 'Clear All Content', 'swiftframework' ) . '</a>
	                            	</li>
	                            </ul>
	                            
	                            <div class="brand"></div>
	                        </div><!-- /.nav-collapse -->
	                    </div>
	                </div>
	            </div>
	            <div id="spb-option-slideout">
	            	<ul class="spb-content-elements spb-item-slideout clearfix">
	            	    '.$this->getContentLayouts().'
	            	</ul>
	            	<ul class="spb-prebuilt-pages spb-item-slideout clearfix">
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home">Home</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-2">Home (Example Two)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-3">Home (Example Three)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-4">Home (Example Four)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-5">Home (Example Five)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-6">Home (Example Six)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-7">Home (Example Seven)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-home-8">Home (Example Eight)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-about-us">About Us</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-about-us-alt">About Us (Alt)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-contact">Contact</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-contact-alt">Contact (Alt)</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-help-faq">Help Center / F.A.Q</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-our-offices">Our Offices</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-services">Services & Capabilities</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-meet-the-team">Meet the team</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-pricing">Pricing</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-portfolio">Portfolio</a></li>
	            	    <li class="sf_prebuilt_template"><a href="#" data-template_id="sf-blog">Blog</a></li>
	            	</ul>
	            </div>
	            <style type="text/css">#swift_page_builder {display: none;}</style>';
	
	        return $output;
		}
	}
	
	class SPBLayout implements  SPBTemplateInterface {
	    protected $navBar;
	    public function __construct() {
	
	    }
	    public function getNavBar() {
	        if($this->navBar==null) $this->navBar = new SPBNavBar();
	        return $this->navBar;
	    }
	
		public function getContainerHelper() {
			$cont_help = "";
			
			$cont_help .= '<div class="container-helper">';
			$cont_help .= '<a href="javascript:open_elements_dropdown();" class="open-dropdown-content-element"><i class="icon"></i> ' . __( 'Add Content Elements', 'swiftframework' ) . '</a>
			<span>' . __("- or -", "swiftframework") .'</span>
			<a href="#" class="add-text-block-to-content" parent-container="#spb_content"><i class="icon"></i> ' . __( 'Add a Text Block', 'swiftframework' ) . '</a>';
			$cont_help .= '</div>';
			
			return $cont_help;
		}
	
	    public function output($post = null) {
	
	        $output = '';
	
	        $output .= $this->getNavBar()->output();
	
	        $output .= '<div class="metabox-builder-content">
						<div id="spb_edit_form"></div>
						<div id="spb_content" class="spb_main_sortable main_wrapper row-fluid spb_sortable_container">
							'.__("Loading, please wait...", "swiftframework").'
						</div>
						<div id="spb-empty">
							<h2>' . __("Welcome to your visual preview area...<br> You don’t have any content at the moment.", "swiftframework") .'</h2>
							<div class="unhappy-face"></div>
							<ul class="helper-steps">
								<li>
									<strong>' . __("Step 1:", "swiftframework") .'</strong>
									<a href="javascript:open_elements_dropdown();" class="open-dropdown-content-element step-one"><i class="icon"></i>Click the Choose Elements button above.</a>
								</li>	
								<li>
									<strong>' . __("Step 2:", "swiftframework") .'</strong>
									<p class="step-two"><i class="icon"></i>Edit the element by clicking the pencil icon.</p>
								</li>	
							</ul>
						</div>
					</div><div id="container-helper-block" style="display: none;">' . $this->getContainerHelper() . '</div>';
	
	        $spb_status = sf_get_post_meta($post->ID, '_spb_js_status', true);
	        if ( $spb_status == "" || !isset($spb_status) ) {
	            $spb_status = 'false';
	        }
	        $output .= '<input type="hidden" id="spb_js_status" name="spb_js_status" value="'. $spb_status .'" />';
	        $output .= '<input type="hidden" id="spb_loading" name="spb_loading" value="'. __("Loading, please wait...", "swiftframework") .'" />';
	
	        echo $output;
	    }
	}

?>