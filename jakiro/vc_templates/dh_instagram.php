<?php
extract( shortcode_atts( array(
	'username'			=> '',
	'images_number'		=> '12',
	'refresh_hour'		=> '5',
	'visibility'        => '',
	'el_class'             => '',
), $atts ) );
/**
 * script
 * {{
 */
wp_enqueue_script('vendor-carouFredSel');
$el_class  = !empty($el_class) ? ' '.esc_attr( $el_class ) : '';
$el_class .= dh_visibility_class($visibility);
$username = strtolower($username);
ob_start();
?>
<div class="instagram">
	<div class="instagram-wrap">
		<?php ;
		$images_data = dh_instagram($username,$images_number, $refresh_hour);

		if ( !is_wp_error($images_data) && ! empty( $images_data ) ) {
			?>
			<div class="caroufredsel caroufredsel-item-no-padding"  data-height="variable" data-scroll-fx="scroll" data-scroll-item="1" data-visible-min="6" data-visible-max="6" data-responsive="1" data-infinite="1" data-autoplay="0" data-circular="1">
			<div class="caroufredsel-wrap">
			<ul class="caroufredsel-items row">
				<?php foreach ((array)$images_data as $item):?>
				<li class="caroufredsel-item col-lg-2 col-sm-3 col-xs-6">
					<a href="<?php echo esc_attr( $item['link'])?>" title="<?php echo esc_attr($item['description'])?>" target="_blank">
						<img src="<?php echo esc_attr($item['thumbnail'])?>"  alt="<?php echo esc_attr($item['description'])?>"/>
					</a>
				</li>
				<?php endforeach;?>
			</ul>
			<a href="#" class="caroufredsel-prev"></a>
			<a href="#" class="caroufredsel-next"></a>
			</div>
			</div>
			<?php
		} else {
			echo '<div class="text-center" style="margin-bottom:30px">';
			if(is_wp_error($images_data)){
				echo implode($images_data->get_error_messages());
			}else{
				echo esc_html__( 'Instagram did not return any images.', 'jakiro' );
			}
			echo '</div>';
		};
		?>
	</div>
</div>
<?php
echo ob_get_clean();