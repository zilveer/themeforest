<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if($enable_title || $enable_meta) {
	echo '<div class="dfd-gallery-heading-wrap dfd-title-'.esc_attr($title_position).'">';
	if($enable_title) {
		if(isset($permalink) && !empty($permalink))
			$title = '<a href="'.esc_url($permalink).'" title="'.esc_attr($title).'">'.esc_html($title).'</a>';

		echo '<div class="dfd-folio-categories">';
			get_template_part('templates/gallery', 'term');
		echo '</div>';

		if ( ! empty( $title ) ) {
			$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'widget-title', $title_google_fonts, $title_custom_fonts );
			echo '<'.$title_options['tag'].' class="dfd-blog-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . $title . '</'.$title_options['tag'].'>';
		}
	}
	if($enable_meta) {
		if($subtitle && !empty($subtitle)) {
		?>
			<div class="subtitle"><?php echo esc_html($subtitle); ?></div>
		<?php	
		}
	}
	echo '</div>';
}