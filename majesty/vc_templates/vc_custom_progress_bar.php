<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$bar_options = '';
$options = explode( ",", $options );
if ( in_array( "animated", $options ) ) $bar_options .= " active";
if ( in_array( "striped", $options ) ) $bar_options .= " progress-bar-striped";

$output = '<div class="skill'. esc_attr( $el_class ) .'">';
if( !empty( $title ) ) {
	$output .= '<h4>'. esc_attr( $title ) .'</h4>';
}
$output .= '<div class="progress">';
if( ! empty ($custombgcolor) && $bgcolor == 'custom' ) {
	$style = ' style="background-color:'. esc_attr($custombgcolor) .';width:'. absint( $value ) .'%;';
	$output .= '<div class="progress-bar'. esc_attr($bar_options) .'" style="background-color:'. esc_attr($custombgcolor) .';width:'. absint( $value ) .'%;" role="progressbar" data-value="'. absint( $value ) .'">
					<span>'. absint( $value ) .''. esc_attr( $unit ) .'</span>
				</div><span class="sr-only">'. absint( $value ) .''. esc_attr( $unit ) .' '. esc_html__('Complete', 'theme-majesty'). '</span>
			';
} else {
	
	$output .= '<div class="progress-bar '. esc_attr($bgcolor) .''. esc_attr($bar_options) .'" role="progressbar" aria-valuenow="'. absint( $value ) .'" aria-valuemin="0" aria-valuemax="100" style="width: '. absint( $value ) .'%;">
					'. absint( $value ) .''. esc_attr( $unit ) .'
				</div><span class="sr-only">'. absint( $value ) .''. esc_attr( $unit ) .' '. esc_html__('Complete', 'theme-majesty'). '</span>
			';
}

$output .= '</div></div>';
echo $output;