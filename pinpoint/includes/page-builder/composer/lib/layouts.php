<?php
/**
 * Swift Page Builder helpers functions
 *
 * @package WPBakeryVisualComposer
 *
 */


class WPBakeryVisualComposerLayoutButton implements WPBakeryVisualComposerTemplateInterface {
    protected $params = Array();

    public function setup($params) {
        if(empty($params['id']) || empty($params['title']))
            trigger_error( __("Wrong layout params", "js_composer"));
        $this->params = (array)$params;
        return $this;
    }

    public function output($post = null) {
        if(empty($this->params)) return '';
        $output = '<li><a id="'.$this->params['id'].'" data-element="vc_column" data-width="'.$this->params['id'].'" class="'.$this->params['id'].' clickable_layout_action dropable_column" href="#"><span>'.__($this->params['title'], "js_composer").'</span></a></li>';
        return $output;
    }
}


class WPBakeryVisualComposerTemplateMenuButton implements WPBakeryVisualComposerTemplateInterface {
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
        $output = '<li class="wpb_template_li"><a data-template_id="'.$this->id.'" href="#">'.__($this->params['name'], "js_composer").'</a> <span class="wpb_remove_template"><i class="icon-trash wpb_template_delete_icon"> </i> </span></li>';
        return $output;
    }
}

class WPBakeryVisualComposerElementButton implements WPBakeryVisualComposerTemplateInterface {
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
        if ( $this->params["class"] != '' ) {
            $class_ar = explode(" ", $this->params["class"]);
            for ($n=0; $n<count($class_ar); $n++) {
                $class_ar[$n] .= "_nav";
            }
            $class = ' ' . implode(" ", $class_ar);
        }
        $output .= '<li><a data-element="' . $this->base . '" id="' . $this->base . '" class="dropable_el clickable_action'.$class.'" href="#">' . $this->getIcon() . __($this->params["name"], "js_composer") .'</a></li>';
        return $output;
    }
}

class WPBakeryVisualComposerTemplateMenu implements WPBakeryVisualComposerTemplateInterface {
    protected $params = Array();

    public function setup($params) {
        $this->params = (array)$params;
        return $this;
    }

    public function output( $post = null ) {
        if(empty($this->params)) return '';
        $output =  '<li class="nav-header">'.__('Save', 'js_composer').'</li>
	                <li id="wpb_save_template"><a href="#">'.__('Save current page as a Template', 'js_composer').'</a></li>
	                <li class="divider"></li>
	                <li class="nav-header">'.__('Load Template', 'js_composer').'</li>';
        $is_empty = true;
        foreach($this->params as $id => $template) {
            if( is_array( $template) ) {
                $template_button = new WPBakeryVisualComposerTemplateMenuButton();
                $output .= $template_button->setup($template)->setID($id)->output();
               $is_empty = false;
            }
        }
        if($is_empty) $output .= '<li class="wpb_no_templates"><span>'.__('No custom templates yet.', 'js_composer').'</span></li>';
        return $output;
    }
}

class WPBakeryVisualComposerTemplate_r extends SwiftPageBuilderAbstract {

    protected $templates = Array();

    public function getMenu() {
        $template_menu = new WPBakeryVisualComposerTemplateMenu();
        return $template_menu->setup($this->getTemplatesList())->output();
    }
    protected function getTemplates() {
        if($this->templates==null)
            $this->templates = (array)get_option('wpb_js_templates');
        return $this->templates;
    }

    public function getTemplatesList() {
        return $this->getTemplates();
    }
}

class WPBakeryVisualComposerNavBar implements WPBakeryVisualComposerTemplateInterface {
    public function __construct() {

    }
    public function getColumnLayouts() {
        $output = '';
        foreach ( WPBMap::getLayouts() as $layout ) {
            $layout_button = new WPBakeryVisualComposerLayoutButton();
            $output .= $layout_button->setup($layout)->output();
        }
        return $output;
    }

    public function getContentLayouts() {
        $output = '';
        foreach (WPBMap::getShortCodes() as $sc_base => $el) {
            $element_button = new WPBakeryVisualComposerElementButton();
            $output .= $element_button->setBase($sc_base)->setup($el) ->output();
        }

        return $output;
    }

    public function getTemplateMenu() {
        $template_r = new WPBakeryVisualComposerTemplate_r();
        return $template_r->getMenu();
    }

    public function output($post = null) {
        $output = '
            <div id="wpb_visual_composer-elements" class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <div class="nav-collapse">
                            <ul class="nav">
                                <li class="dropdown content-dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle wpb_content_elements" href="#">'.__("Choose Elements", "js_composer").' <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        '.$this->getContentLayouts().'
                                    </ul>
                                </li>
                            </ul>

                            <ul class="nav pull-right">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle wpb_templates" href="#">'.__('Templates', 'js_composer').' <b class="caret"></b></a>
                                    <ul class="dropdown-menu wpb_templates_ul">
                                        '.$this->getTemplateMenu().'
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.nav-collapse -->
                    </div>
                </div>
            </div>
            <style type="text/css">#wpb_visual_composer {display: none;}</style>';

        return $output;
	}
}

class WPBakeryVisualComposerLayout implements  WPBakeryVisualComposerTemplateInterface {
    protected $navBar;
    public function __construct() {

    }
    public function getNavBar() {
        if($this->navBar==null) $this->navBar = new WPBakeryVisualComposerNavBar();
        return $this->navBar;
    }

	public function getContainerHelper() {
		$cont_help = "";
		
		$cont_help .= '<div class="container-helper">';
		$cont_help .= '<a href="javascript:open_elements_dropdown();" class="open-dropdown-content-element"><i class="icon"></i> Add Content Elements</a>
		<span>' . __("- or -", "js_composer") .'</span>
		<a href="#" class="add-text-block-to-content" parent-container="#visual_composer_content"><i class="icon"></i> Add Text block with a single click</a>';
		$cont_help .= '</div>';
		
		return $cont_help;
	}

    public function output($post = null) {

        $output = '';

        $output .= $this->getNavBar()->output();

        $output .= '<div class="metabox-composer-content">
					<div id="visual_composer_edit_form" class="row-fluid"></div>
					<div id="visual_composer_content" class="wpb_main_sortable main_wrapper row-fluid wpb_sortable_container">
						'.__("Loading, please wait...", "js_composer").'
					</div>
					<div id="wpb-empty-blocks">
						<h2>' . __("This is your visual preview area.", "js_composer") .'</h2>
						<h3>' . __("You don’t have any content at the moment.", "js_composer") .'</h3>
						<ul class="helper-steps">
							<li>
								<strong>' . __("Step 1:", "js_composer") .'</strong>
								<a href="javascript:open_elements_dropdown();" class="open-dropdown-content-element"><i class="icon"></i> Add Content Elements</a>
								<span>' . __("- or -", "js_composer") .'</span>
								<a href="#" class="add-text-block-to-content" parent-container="#visual_composer_content"><i class="icon"></i> Add Text block with a single click</a>
							</li>	
							<li>
								<strong>' . __("Step 2:", "js_composer") .'</strong>
								<p><i class="icon"></i>' . __("Click the pencil icon on the content element to change its properties.", "js_composer") .'</p>
							</li>	
						</ul>
					</div>
				</div><div id="container-helper-block" style="display: none;">' . $this->getContainerHelper() . '</div>';

        $wpb_vc_status = get_post_meta($post->ID, '_wpb_vc_js_status', true);
        if ( $wpb_vc_status == "" || !isset($wpb_vc_status) ) {
            $wpb_vc_status = 'false';
        }
        $output .= '<input type="hidden" id="wpb_vc_js_status" name="wpb_vc_js_status" value="'. $wpb_vc_status .'" />';
        $output .= '<input type="hidden" id="wpb_vc_loading" name="wpb_vc_loading" value="'. __("Loading, please wait...", "js_composer") .'" />';

        echo $output;
    }
}