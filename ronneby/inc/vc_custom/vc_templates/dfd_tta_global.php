<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $this WPBakeryShortCode_VC_Tta_Accordion|WPBakeryShortCode_VC_Tta_Tabs|WPBakeryShortCode_VC_Tta_Tour|WPBakeryShortCode_VC_Tta_Pageable
 */
/* @var $this WPBakeryShortCode_VC_Tta_Tabs */
$el_class = $css = '';
$type = $this->getShortcode();
if (!function_exists("check_property")) {

	function check_property(&$property) {
		$result = (isset($property) && (!empty($property) || $property == 0));
		if (is_int($property) && $result) {
			return $property >= 0;
		}
		if ($result) {
			return true;
		}
		return false;
	}

}
//$atts["gap"]="";
//print_r($atts);
//$gap_replace = "";
//if (isset($atts["style"]) && $atts["style"] == "big_icon") {
//	if (isset($atts["gap"])) {
//		$gap_replace = $atts["gap"];
//		$atts["gap"] = "";
//	}
//}
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
$this->resetVariables($atts, $content);
extract($atts);


$this->setGlobalTtaInfo();

$this->enqueueTtaStyles();
$this->enqueueTtaScript();
//echo "<pre>";
//print_r($atts);
//echo "</pre>";
$style = check_property($style) ? esc_attr($style) : "";
$border_radius = check_property($border_radius) ? esc_attr($border_radius) . "px !important" : "";
$border_color_radius = check_property($border_color_radius) ? esc_attr($border_color_radius) . "" : "";
$color_content_area = check_property($color_content_area) ? esc_attr($color_content_area) : "";
$underline = isset($underline) && $underline == "on" ? "underline" : "";
$c_icon_position = isset($c_icon_position) ? "icon-position-" . $c_icon_position : "";
$tab_active_color_text = check_property($tab_active_color_text) ? esc_attr($tab_active_color_text) : "";
$tab_hover_text_color = check_property($tab_hover_text_color) ? esc_attr($tab_hover_text_color) : "";
$tab_text_color = check_property($tab_text_color) ? esc_attr($tab_text_color) : "";
$border_color_active = check_property($border_color_active) ? esc_attr($border_color_active) : "";
$font_size = check_property($font_size) ? esc_attr($font_size) : "";
$icon_color = check_property($icon_color) ? esc_attr($icon_color) : "";
$icon_size = check_property($icon_size) ? esc_attr($icon_size) : "";
$module_animation = isset($module_animation) ? $module_animation : "";
/* * ************************
 * Appear Animation
 * *********************** */

$animation_data  = $an_class = '';

if (!( $module_animation == '' )) {
	$an_class .= 'cr-animate-gen ';
	$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
}

$show_separator_line = isset($show_separator_line) && $show_separator_line == "on" ? "show_separator" : "hide_separator";
//$gap = $gap_replace;
$gap = isset($gap) ? (int) $gap : 0;
$id = uniqid();
if ($style == "collapse")
	$border_radius = "0px";
if ($style == "big_icon")
	$border_radius = "2px !important";
/* Add padding to content area if background color is exist */
$padding = "";
if ($color_content_area != "inherit" && $color_content_area != "") {
	$padding = "padding-left:20px;padding-right:20px;";
	if ($type == "vc_tta_tour")
		$padding .= "padding-top:20px;padding-bottom:20px;";
}
$separator_space = ($gap / 2);
if (!$separator_space) {
	if ($padding) {
		$separator_space = 7;
	} else {
		$separator_space = 0;
	}
}
// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable('content');
$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter.=" " . $underline . " " . $type . " " . $show_separator_line . " " . $c_icon_position . " ";
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$output = '<div class="dfd_tabs_block '.$an_class.'" id="tabid_' . $id . '" '.$animation_data.'>';
$output .= '<div ' . $this->getWrapperAttributes() . '>';
$output .= $this->getTemplateVariable('title');
$output .= '<div class="' . esc_attr($css_class) . " " . esc_attr($style) . '">';
$output .= $this->getTemplateVariable('tabs-list-top');
$output .= $this->getTemplateVariable('tabs-list-left');
$output .= '<div class="vc_tta-panels-container ' . $style . '">';
$output .= $this->getTemplateVariable('pagination-top');
$output .= '<div class="vc_tta-panels">';
$output .= $prepareContent;
$output .= '</div>';
$output .= $this->getTemplateVariable('pagination-bottom');
$output .= '</div>';
$output .= $this->getTemplateVariable('tabs-list-bottom');
$output .= $this->getTemplateVariable('tabs-list-right');
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;
$id = "#tabid_" . $id;
?>
<style type="text/css">
<?php ob_start(); ?>
    /*Tabs*/
<?php echo $id; ?>.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a {
        border-radius:<?php echo $border_radius; ?>;
        border-color: <?php echo $border_color_radius; ?>;
        font-size: <?php echo $font_size; ?>px !important;	
		color: <?php echo $tab_text_color; ?>;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab:not(.vc_active) a {
		background-color: <?php echo $tab_background; ?> !important;
	}
<?php echo $id; ?>.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a:hover {
		color: <?php echo $tab_hover_text_color; ?> !important;
		background-color: <?php echo $tab_hover_background; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_tta-tab a .vc_tta-icon{
		font-size: <?php echo $icon_size; ?>px !important;	
		color: <?php echo $icon_color; ?>;
	}

<?php echo $id; ?>.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a{
		color: <?php echo $tab_active_color_text; ?>;
		background-color: <?php echo $active_tab_background; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-tabs .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a:hover{
		background-color: <?php echo $active_tab_background; ?> !important;
	}
<?php echo $id; ?>.dfd_tabs_block .vc_tta-tabs.classic_empty .vc_tta-tabs-container .vc_tta-tabs-list li.vc_active a{
        border-radius:<?php echo $border_radius; ?> !important;
        border-color: <?php echo $border_color_radius ?> !important; 
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-tabs .vc_tta-panels-container .vc_tta-panel{
        background-color: <?php echo $color_content_area ?>; 
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-panel .vc_tta-panel-body{
<?php echo $padding; ?>
    }
    /*Accordion*/
<?php echo $id; ?>.dfd_tabs_block .vc_tta-panel .vc_tta-panel-heading{
        border-color: <?php echo $border_color_radius ?>; 
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading{
		background-color: <?php echo $tab_background; ?> !important;
		border-radius:<?php echo $border_radius; ?>;	
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover{
		background-color: <?php echo $tab_hover_background; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading{
		background-color: <?php echo $active_tab_background; ?> !important;
		border-radius:<?php echo $border_radius; ?>;	
		border-color:<?php echo $border_color_active; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-body{
        background-color: <?php echo $color_content_area; ?>;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a{
		font-size: <?php echo $font_size; ?>px !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading h4 a{
		color:<?php echo $tab_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading h4 a:hover{
		color:<?php echo $tab_hover_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a{
		color:<?php echo $tab_active_color_text; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a i:before, <?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading h4 a i:after{
		border-color: <?php echo $tab_active_color_text; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a i:before, <?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a i:after{
		border-color: <?php echo $tab_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-heading h4 a .vc_tta-icon{
		font-size: <?php echo $icon_size; ?>px !important;	
		color: <?php echo $icon_color; ?>;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text{
		font-size: <?php echo $font_size; ?>px !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text{
		color:<?php echo $tab_active_color_text; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text{
		color:<?php echo $tab_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion .vc_tta-panel:not(.vc_active) .vc_tta-panel-title a .vc_tta-title-text .accordion_inner_text:hover{
		color:<?php echo $tab_hover_text_color; ?> !important;
    }
    /* Tour*/
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a{
		font-size: <?php echo $font_size; ?>px !important;
    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a .vc_tta-icon{
		font-size: <?php echo $icon_size; ?>px !important;	
		color: <?php echo $icon_color; ?>;
    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a{
		background-color: <?php echo $tab_background; ?> !important;
		color:<?php echo $tab_text_color; ?> !important;

    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab:not(.vc_active) a:hover{
		background-color: <?php echo $tab_hover_background; ?> !important;
		color:<?php echo $tab_hover_text_color; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a{
		background-color: <?php echo $active_tab_background; ?> !important;
		color:<?php echo $tab_active_color_text; ?> !important;
		border-color:<?php echo $border_color_active; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a:before, <?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab.vc_active a:after{
		border-color: <?php echo $tab_active_color_text; ?> !important;
    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a:before, <?php echo $id; ?>.dfd_tabs_block .dfd_tta_tour .vc_tta-tabs-container .vc_tta-tab a:after{
		border-color: <?php echo $tab_text_color; ?> !important;
    }
    /*Separator*/
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tabs:not(.big_icon) .vc_tta-panels-container:before{
		top:-<?php echo $separator_space; ?>px !important;
    }
<?php echo $id; ?>.dfd_tabs_block .dfd_tta_tabs:not(.big_icon) .vc_tta-panels-container:after{
		bottom:-<?php echo $separator_space; ?>px !important;
    }
<?php $css = ob_get_clean();
?>
</style>
<?php ?>
<script type="text/javascript">
	(function($){
		$('head').append('<style type="text/css"><?php echo esc_js($css); ?></style>');
		$("<?php echo $id; ?>.dfd_tabs_block .vc_tta-accordion.underline .vc_tta-title-text").each(function(){
			var accordion_text = $(this).text();
			$(this).text(" ");
			$(this).append("<div class='accordion_inner_text'>" + accordion_text + "</div>");
		});

		$("<?php echo $id; ?> .vc_tta-accordion .vc_tta-panels .vc_tta-panel").each(function(){
			var $icon = $(this).find(".vc_tta-icon");
			if($icon[0]){
				$(this).find(".vc_tta-panel-title").addClass("hasIcon");
			}
		});

	})(jQuery);
</script>
<?php ?>