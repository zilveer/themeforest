<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
$footer_style_option = isset($dfd_ronneby['footer_variant']) ? $dfd_ronneby['footer_variant'] : '';
$footer_style = !empty($footer_style_option) ? $footer_style_option : '1';
$footer_class = 'footer-style-'.$footer_style;
$footer_class .= (isset($dfd_ronneby['footer_bg_dark']) && strcmp($dfd_ronneby['footer_bg_dark'], '1') === 0) ? ' dfd-background-dark' : '';
$footer_class .= (strcmp($footer_style_option, '4') === 0) ? ' no-paddings' : '';

$dark_sub_footer_bg = (isset($dfd_ronneby['sub_footer_bg_dark']) && strcmp($dfd_ronneby['sub_footer_bg_dark'], '1') === 0) ? ' dfd-background-dark' : '';
?>

<?php if($footer_style != '4') : ?>

<div id="footer-wrap">
	
	<section id="footer" class="<?php echo esc_attr($footer_class); ?>">

		<?php get_template_part('templates/footer/style', $footer_style); ?>

	</section>

	<?php if(
				isset($dfd_ronneby['copyright_footer']) &&
				//strcmp($dfd_ronneby['copyright_footer'], '1' === 0) &&
				isset($dfd_ronneby['enable_subfooter']) &&
				(strcmp($dfd_ronneby['enable_subfooter'], '1') === 0) &&
				isset($dfd_ronneby['footer_copyright_position']) &&
				(strcmp($dfd_ronneby['footer_copyright_position'], 'footer') !== 0)
			) : ?>
		<section id="sub-footer" class="<?php echo esc_attr($dark_sub_footer_bg); ?>">
			<div class="row">
				<div class="twelve columns subfooter-copyright text-center">
					<?php echo $dfd_ronneby['copyright_footer']; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

</div>
<?php endif; ?>

<?php if(isset($dfd_ronneby['site_boxed']) && $dfd_ronneby['site_boxed']) : ?>
	</div>
	<script type="text/javascript">
		(function($) {
			var sideHeaderSetter = function() {
				var header = $('#header-container');
				if(header.hasClass('header-style-5')) {
					var bodyWrapper = $('.boxed_layout');
					var bodyWrapperOffset = bodyWrapper.offset().left;
					if(header.hasClass('left')) {
						header.find('#header').css('left', bodyWrapperOffset);
					}
					if(header.hasClass('right')) {
						header.find('#header').css('right', bodyWrapperOffset);
					}
				}
			};
			sideHeaderSetter();
			$(window).on('load resize', sideHeaderSetter);
		})(jQuery);
	</script>
<?php endif; ?>

<?php echo isset($dfd_ronneby['custom_js']) ? $dfd_ronneby['custom_js'] : ''; ?>

</div>

<div id="sidr">
	<div class="sidr-top">
		<?php if(isset($dfd_ronneby['mobile_menu_logo_image']['url']) && !empty($dfd_ronneby['mobile_menu_logo_image']['url'])) : ?>
			<div class="logo-for-panel">
				<a href="<?php echo home_url() ?>" title="<?php echo esc_attr__('Mobile logo','dfd') ?>">
					<img src="<?php echo esc_url($dfd_ronneby['mobile_menu_logo_image']['url']); ?>" alt="logo"/>
				</a>
			</div>
		<?php else : ?>
			<?php get_template_part('templates/header/block', 'custom_logo'); ?>
		<?php endif; ?>
	</div>
	<div class="sidr-inner"></div>
	<?php if(isset($dfd_ronneby['search_form_mobile_header']) && strcmp($dfd_ronneby['search_form_mobile_header'], '1') === 0) : ?>
		<div class="dfd-search-mobile-show" style="display: none;">
			<?php get_template_part('templates/searchform', 'mini'); ?>
		</div>
	<?php endif; ?>
	<?php if(isset($dfd_ronneby['text_mobile_header']) && !empty($dfd_ronneby['text_mobile_header'])): ?>
		<div class="sidr-text-container">
			<p><?php echo $dfd_ronneby['text_mobile_header']; ?></p>
		</div>
	<?php endif; ?>
</div>
<a href="#sidr-close" class="dl-trigger dfd-sidr-close"></a>

<?php
//if($_SERVER['SERVER_NAME'] ==  "rnbtheme.com" ||  $_SERVER['SERVER_NAME'] ==  "themes.dfd.name" || $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === 'localhost'){
//	require_once locate_template('inc/dfd_buttons.php'); //Custom style Panel
//}
?>
<?php wp_footer(); ?>
</body>
</html>
