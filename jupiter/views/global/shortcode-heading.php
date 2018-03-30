<?php 

$class[] = 'shortcode-heading';
$class[] = 'mk-fancy-title';
$class[] = '';
$class[] = (isset($view_params['pattern']) && $view_params['pattern'] == 'false') ? '' : 'pattern-style';
$class[] = isset($view_params['align']) ? 'align-'.$view_params['align'] : 'align-left';
$class[] = isset($view_params['el_class']) ? $view_params['el_class'] : '';

$content_after = isset($view_params['content_after']) ? $view_params['content_after'] : '';

if (!empty($view_params['title'])) { ?>
	    <h3 class="<?php echo esc_attr( implode(' ', $class) ); ?>"><span><?php echo esc_html( $view_params['title'] ); ?></span><?php echo $content_after; ?></h3>
<?php }