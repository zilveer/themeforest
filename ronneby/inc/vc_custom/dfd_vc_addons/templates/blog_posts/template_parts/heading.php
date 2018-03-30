<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if($enable_title || $enable_meta) {
	echo '<div class="dfd-blog-heading-wrap">';
	if($enable_title) {
		$title = get_the_title();	

		if(isset($permalink) && !empty($permalink))
			$title = '<a href="'.esc_url($permalink).'" title="'.esc_attr($title).'">'.esc_html($title).'</a>';

		if($enable_cat) {
			echo '<div class="dfd-news-categories">';
				get_template_part('templates/entry-meta/mini', 'category-highlighted');
			echo '</div>';
		}

		if ( ! empty( $title ) ) {
			$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'widget-title', $title_google_fonts, $title_custom_fonts );
			echo '<'.$title_options['tag'].' class="dfd-blog-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . $title . '</'.$title_options['tag'].'>';
		}
	}
	if($enable_meta) {
	?>
		<div class="dfd-meta-wrap">
			<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
		</div>
	<?php
	}
	echo '</div>';
}