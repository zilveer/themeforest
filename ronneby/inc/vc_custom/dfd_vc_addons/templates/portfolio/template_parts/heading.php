<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if($enable_title || $enable_meta) {
	echo '<div class="dfd-folio-heading-wrap">';
	if($enable_title) {
		$title = get_the_title();	

		if(isset($permalink) && !empty($permalink))
			$title = '<a href="'.esc_url($permalink).'" title="'.esc_attr($title).'">'.esc_html($title).'</a>';

		echo '<div class="dfd-folio-categories">';
			get_template_part('templates/folio', 'term');
		echo '</div>';

		if ( ! empty( $title ) ) {
			$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'widget-title', $title_google_fonts, $title_custom_fonts );
			echo '<'.$title_options['tag'].' class="dfd-blog-title dfd-portfolio-title ' . esc_attr($title_options['class']) . '" ' . $title_options['style'] . '>' . $title . '</'.$title_options['tag'].'>';
		}
	}
	if($enable_meta) {
		$subtitle_text = get_post_meta(get_the_id(), 'stunnig_headers_subtitle', true);
		if($subtitle_text && !empty($subtitle_text)) {
		?>
			<div class="subtitle"><?php echo esc_html($subtitle_text); ?></div>
		<?php	
		}
	}
	echo '</div>';
}