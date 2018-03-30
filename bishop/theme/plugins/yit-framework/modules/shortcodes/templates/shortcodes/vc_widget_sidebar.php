<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_registered_sidebars;


$output = $el_position = $title = $width = $el_class = $sidebar_id = '';
extract(shortcode_atts(array(
	'el_position' => '',
	'title' => '',
	'width' => '1/1',
	'el_class' => '',
	'sidebar_id' => '',
	'layout' => 'vertical',
	'num_of_col' => 1

), $atts));
if ( $sidebar_id == '' ) return null;


if( $layout == 'horizontal' ){
	$old =  $wp_registered_sidebars[$sidebar_id]['before_widget'] ;
	$wp_registered_sidebars[$sidebar_id]['before_widget'] = '<div id="%1$s" class="widget col-sm-'.(12/$num_of_col).' %2$s">';
}

$el_class = $this->getExtraClass($el_class);

ob_start();
dynamic_sidebar($sidebar_id);
$sidebar_value = ob_get_contents();
ob_end_clean();

$sidebar_value = trim($sidebar_value);
$sidebar_value = (substr($sidebar_value, 0, 3) == '<li' ) ? '<ul>'.$sidebar_value.'</ul>' : $sidebar_value;
//
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_widgetised_column wpb_content_element'.$el_class, $this->settings['base']);
$output .= "\n\t".'<div class="'.$css_class.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper' . ( $layout == 'horizontal' ? ' row' : '' ) . '">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_widgetised_column_heading'));
$output .= "\n\t\t\t".$sidebar_value;
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_widgetised_column');

echo $output;

if( $layout == 'horizontal' ){
	$wp_registered_sidebars[$sidebar_id]['before_widget'] = $old;
}