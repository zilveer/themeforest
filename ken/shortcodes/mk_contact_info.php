<?php
$output = '';
extract( shortcode_atts( array(
			'skin' => 'dark',
			'text_icon_color' => '',
			'border_color' => '',
			'name' => '',
			'cellphone' => '',
			'phone' => '',
			'address' => '',
			'website' => '',
			'email' => '',
			'animation' => '',
			'el_class' => '',
		), $atts ) );


$style_id = Mk_Static_Files::shortcode_id();

$animation_css = ($animation != '') ? (' class="mk-animate-element ' . $animation . '" ') : '';

$output .= '<div id="mk-contactinfo-shortcode-'.$style_id.'" class="widget_contact_info mk-contactinfo-shortcode '.$skin.'-skin '.$el_class.'">';
$output .= '<ul '.get_schema_markup('person').'>';
$output .= !empty( $name )  ? '<li'.$animation_css.'><i class="mk-theme-icon-user"></i><span itemprop="name">'.$name.'</span></li>' : '';
$output .= !empty( $cellphone )  ? '<li'.$animation_css.'><i class="mk-theme-icon-cellphone"></i><span>'.$cellphone.'</span></li>' : '';
$output .= !empty( $phone )  ? '<li'.$animation_css.'><i class="mk-theme-icon-phone"></i><span>'.$phone.'</span></li>' : '';
$output .= !empty( $address )  ? '<li'.$animation_css.'><i class="mk-theme-icon-office"></i><span itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">'.$address.'</span></li>' : '';
$output .= !empty( $website )  ? '<li'.$animation_css.'><i class="mk-icon-globe"></i><span temprop="url"><a href="' . $website . '">'.$website.'</a></span></li>' : '';
$output .= !empty( $email )  ? '<li'.$animation_css.'><i class="mk-theme-icon-email"></i><span itemprop="email"><a href="mailto:' . antispambot($email) . '">'.$email.'</a></span></li>' : '';

$output .= '</ul>';
$output .= '</div>';


echo $output;

if ( $skin == 'custom' ) {

	    Mk_Static_Files::addCSS('
	        #mk-contactinfo-shortcode-'.$style_id.'.custom-skin li i {
	            border-right: 2px solid '.$border_color.';
				color: '.$text_icon_color.';
	        }
	        #mk-contactinfo-shortcode-'.$style_id.' ul li{
	        	color: '.$text_icon_color.' !important;
	        }
	        #mk-contactinfo-shortcode-'.$style_id.' ul li a{
	        	color: '.$text_icon_color.' !important;
	        }
	    ', $style_id);

}

