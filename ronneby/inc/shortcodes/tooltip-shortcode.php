<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function tooltip_shortcode( $atts, $content = null ) {

	wp_enqueue_script( 'tooltip-js', get_template_directory_uri() . '/assets/js/tooltip.bootstrap.min.js', array( 'jquery' ), false, true );

    $shortcode_atts = shortcode_atts( array(
        'text'  => 'Tooltip',
        'align' => 'top',
    ), $atts );

    $tooltip_text = sanitize_text_field( $shortcode_atts['text'] );

    $output = '<span data-toggle="tooltip" class="has-tooltip" data-placement="' . $shortcode_atts['align'] . '" title="' . $tooltip_text . '">' . $content . '</span>';

    return $output;

}

add_shortcode( 'tooltip', 'tooltip_shortcode' );

function crumina_popover_shortcode($atts, $content = null){

	wp_enqueue_script( 'tooltip-js', get_template_directory_uri() . '/assets/js/tooltip.bootstrap.min.js', array( 'jquery' ), false, true );

    $image ='';

    $shortcode_atts = shortcode_atts( array(
        'position'  => '',
        'image'  => '',
        'content' => '',
		'contentwidth'=>''
    ), $atts );


    if ( ! empty( $shortcode_atts['image'] ) ) {
        $image = '<img src="' . $shortcode_atts['image'] . '" alt="" ><br>';
    }
	$contentwidth = isset($shortcode_atts['contentwidth']) ? $shortcode_atts['contentwidth'] : "" ;
	$id = "id".uniqid();
	$output = '<span class="has-popover '.$id.'" data-html="true" data-trigger="hover" data-placement="' . $shortcode_atts['position'] . '" rel="popover">
	' . $content . '
	<span class="popover-content hidden">'.$image . html_entity_decode( $shortcode_atts['content'] ) . '</span>
	</span>';
	$css ="";
	if((int)$contentwidth>0 &&  $contentwidth!=""){
		$contentwidth = (int)$contentwidth."px";
	}else{
		$contentwidth = "auto";
	}
		$css = ".$id ~ div.popover{ width: ".$contentwidth."}";
	?>

<script>
		(function($){
			$('head').append('<style type="text/css"><?php echo $css; ?></style>');
		})(jQuery);
	</script>
		<?php
    return $output;
	

}

add_shortcode('popover','crumina_popover_shortcode');