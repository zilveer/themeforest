<?php

/**
 * Text divider shortcode handler
 *
 * @package wpv
 * @subpackage editor
 */

/**
 * class WPV_Text_Divider
 */
class WPV_Text_Divider {
	/**
	 * Register the shortcode
	 */
	public function __construct() {
		add_shortcode('text_divider',array(__CLASS__, 'shortcode'));
	}

	/**
	 * Text divider shortcode callback
	 *
	 * @param  array  $atts    shortcode attributes
	 * @param  string $content shortcode content
	 * @param  string $code    shortcode name
	 * @return string          output html
	 */
	public static function shortcode($atts, $content = null, $code='text_divider') {
		extract(shortcode_atts(array(
			'more' => '',
			'more_text' => __('', 'health-center'),
			'type' => 'single'
		), $atts));

		$content = preg_replace('#<\s*/?\s*p[^>]*>#', '', $content);

		$has_html = preg_match('/^\s*</', $content);

		$link = '';
		$class = 'single';
		if(!empty($more)) {
			$class = 'has-more';
			$link = "<span class='sep-text-more'><a href='$more' title='".esc_attr( $more_text )."' class='more'>".$more_text.'</a></span>';
		}

		if(current_theme_supports('wpv-centered-text-divider'))
			$class .= ' centered';

		ob_start();

		if($type == 'single'):
	?>
		<div class="sep-text <?php echo $class?>">
			<?php if(current_theme_supports('wpv-centered-text-divider')): ?>
				<span class="sep-text-before"><div class="sep-text-line"></div></span>
			<?php endif ?>
			<div class="content">
				<?php
					if ( $has_html ) {
						echo do_shortcode( $content ); // xss ok
					} else {
						echo '<h2 class="text-divider-double">' . do_shortcode( $content ) . '</h2>'; // xss ok
					}
				?>
			</div>
			<span class="sep-text-after"><div class="sep-text-line"></div></span>
			<?php echo $link ?>
		</div>
	<?php elseif($type == 'double'): ?>
		<?php if(!$has_html) echo '<h2 class="text-divider-double">'; ?>
			<?php echo do_shortcode($content) ?>
		<?php if(!$has_html) echo '</h2>'; ?>
		<?php echo do_shortcode('[divider type="1"]') ?>
	<?php
		endif;
		return apply_filters('wpv_shortcode_text_divider_html', ob_get_clean(), $content, $atts);
	}
}

new WPV_Text_Divider;
