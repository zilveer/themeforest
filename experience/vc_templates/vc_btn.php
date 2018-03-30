<?php
$defaults = array(
	'size'				=> 'md',
	'align'				=> 'inline',
	'link'				=> '',
	'title'				=> '',
	'button_block'		=> '',
	'el_class'			=> '',
	'add_icon'			=> '',
	'i_align'			=> 'left',
	'i_icon_pixelicons'	=> '',
	'i_type'			=> 'fontawesome',
	'i_icon_fontawesome'=> 'fa fa-adjust',
	'i_icon_openiconic'	=> 'vc-oi vc-oi-dial',
	'i_icon_typicons'	=> 'typcn typcn-adjust-brightness',
	'i_icon_entypo'		=> 'entypo-icon entypo-icon-note',
	'i_icon_linecons'	=> 'vc_li vc_li-heart',
	'color'				=> '',
	'css_animation' 	=> '',
	'css'				=> '',
);

$inline_css		= '';
$icon_wrapper	= false;
$icon_html		= false;

$atts = shortcode_atts( $defaults, $atts );
extract( $atts );

//parse link
$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;
if ( strlen( $link['url'] ) > 0 ) {
	$use_link = true;
	$a_href = $link['url'];
	$a_title = $link['title'];
	$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' vc_btn3-container '. $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'] , $atts );
$css_class .= $this->getCSSAnimation( $css_animation );
$button_class = ' vc_btn3-size-'. $size;
$button_html = $title;


if ( $color == 'secondary' ) {
	$button_class .= ' btn-color-secondary';
}


if ( '' == trim( $title ) ) {
	$button_class .= ' vc_btn3-o-empty';
	$button_html = '<span class="vc_btn3-placeholder">&nbsp;</span>';
}


if ( 'true' == $button_block && 'inline' != $align ) {
	$button_class .= ' vc_btn3-block';
}


if ( 'true' === $add_icon ) {
	$button_class .= ' vc_btn3-icon-'. $i_align;
	vc_icon_element_fonts_enqueue( $i_type );

	if ( isset( ${"i_icon_". $i_type} ) ) {
		if ( 'pixelicons' === $i_type ) {
			$icon_wrapper = true;
		}
		$iconClass = ${"i_icon_". $i_type};
	} else {
		$iconClass = 'fa fa-adjust';
	}

	if ( $icon_wrapper ) {
		$icon_html = '<i class="vc_btn3-icon"><span class="vc_btn3-icon-inner '. esc_attr( $iconClass ) .'"></span></i>';
	} else {
		$icon_html = '<i class="vc_btn3-icon '. esc_attr( $iconClass ) .'"></i>';
	}


	if ( $i_align == 'left' ) {
		$button_html = $icon_html .' '. $button_html;
	} else {
		$button_html .= ' '. $icon_html;
	}
}

if ( '' != $inline_css ) {
	$inline_css = ' style="'. esc_attr( $inline_css ) .'"';
} ?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?> vc_btn3-<?php echo esc_attr( $align ); ?>">
	<?php if ( $use_link ): ?>
		<a class="vc_btn3 <?php echo esc_attr( trim( $button_class ) ); ?>"
			href="<?php echo esc_url( $a_href ); ?>"
			title="<?php echo esc_attr( $a_title ); ?>"
			target="<?php echo esc_attr( trim( $a_target ) ); ?>"
			<?php echo $inline_css; ?>
		>
			<?php echo wp_kses( $button_html, array( 'span' => array( 'class ' => array() ), 'i' => array( 'class' => array() ) ) ); ?>
		</a>
	<?php else: ?>
		<a class="vc_btn3 <?php echo esc_attr( $button_class ); ?>"<?php echo $inline_css; ?>>
			<?php echo wp_kses( $button_html, array( 'span' => array( 'class ' => array() ), 'i' => array( 'class' => array() ) ) ); ?>
		</a>
	<?php endif; ?>
</div>
<?php echo $this->endBlockComment( 'vc_btn3' ) ."\n";