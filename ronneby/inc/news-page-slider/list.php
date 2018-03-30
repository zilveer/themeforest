<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="wrap news-page-slider-wrap">

	<div id="<?php echo esc_attr($uniq_id); ?>" class="news-page-slider">
		<?php
			$slidesFormat = !empty($slider['slidesFormat']) ? $slider['slidesFormat'] : 7;
			$thumbnails_bar_html = '';
			$before_thumbnails_bar_html = '<div class="dfd-navbar-container"><div class="dfd-news-slider-navbar">';
			$after_thumbnails_bar_html = '</div></div>';
		?>

		<div class="slidee">
			<?php while ($query->have_posts()) : $query->the_post(); ?>

				<div class="news-page-slide">
				
					<?php require dirname(__FILE__) . '/loop.php'; ?>

				</div>
				
			<?php
			if($slidesFormat == 7) {
				ob_start();
				require dirname(__FILE__) . '/loop-thumbnails.php';
				$thumbnails_bar_html .= ob_get_clean();
			}
			endwhile; ?>
		</div>
		<?php
		if($slidesFormat == 7) {
			echo $before_thumbnails_bar_html . $thumbnails_bar_html . $after_thumbnails_bar_html;
		}
		?>
	</div>
</div>

<script type="text/javascript">
	(function($){
		"use strict";
		$(document).ready(function() {
			$('#<?php echo esc_js($uniq_id); ?> .slidee').slick({
				infinite: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				asNavFor: $('#<?php echo esc_js($uniq_id); ?> .dfd-news-slider-navbar'),
				arrows: false,
				dots: false,
				autoplay: false
			});
			$('#<?php echo esc_js($uniq_id); ?> .dfd-news-slider-navbar').slick({
				infinite: false,
				slidesToShow: 5,
				slidesToScroll: 1,
				asNavFor: $('#<?php echo esc_js($uniq_id); ?> .slidee'),
				arrows: false,
				focusOnSelect: true,
				dots: false,
				autoplay: false
			});
			$('#<?php echo esc_js($uniq_id); ?> .slidee').next('.slider-controls').find('.next').click(function(e) {
				$('#<?php echo esc_js($uniq_id); ?> .slidee').slickNext();

				e.preventDefault();
			});

			$('#<?php echo esc_js($uniq_id); ?> .slidee').next('.slider-controls').find('.prev').click(function(e) {
				$('#<?php echo esc_js($uniq_id); ?> .slidee').slickPrev();

				e.preventDefault();
			});
			$('#<?php echo esc_js($uniq_id); ?> .news-page-slide').on('mousedown select',(function(e){
				e.preventDefault();
			}));
		});
	})(jQuery);
</script>