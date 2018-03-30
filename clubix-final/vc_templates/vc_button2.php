<?php
$output = $color = $title = '';
extract( shortcode_atts( array(
	'link' => '',
	'title' => __( 'Text on the button', "js_composer" ),
	'color' => '',
	'el_class' => ''
), $atts ) );

//parse link
$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
$a_title = $link['title'];
$a_target = $link['target'];
$el_class = $this->getExtraClass( $el_class );

$output .= '<a href="'.$a_href.'" title="'.$a_title.'" target="'.$a_target.'"><button type="button" class="btn '.$el_class.'" style="background: '.$color.';">'.$title.'</button></a>';


$output .= $this->endBlockComment( 'vc_button' ) . "\n";
echo $output;