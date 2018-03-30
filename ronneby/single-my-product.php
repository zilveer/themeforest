<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$folio_stun_header = DfdMetaBoxSettings::compared('folio_single_stun_header', 'on');

$description_position = DfdMetaBoxSettings::compared('folio_description_position', 'left');

$gallery_type = DfdMetaBoxSettings::compared('folio_gallery_type', 'default');

$folio_inside_template = DfdMetaBoxSettings::compared('folio_inside_template', 'folio_inside_1');

$inside_format = DfdMetaBoxSettings::compared('folio_layout_type', 'default');

$inside_width = DfdMetaBoxSettings::compared('folio_layout_width', '');

$show_fixed_share = DfdMetaBoxSettings::compared('folio_single_show_fixed_share', false);

if($folio_stun_header != 'off') {
	get_template_part('templates/header/top', 'folio');
}
$single_folio_class = $gallery_type .' ' . $folio_inside_template . ' ' . $inside_format;

$folio_single_enable_pagination = DfdMetaBoxSettings::compared('folio_single_enable_pagination', false);

?>
<section id="layout" class="single-folio <?php echo esc_attr($single_folio_class); ?>">

	<?php 
	if($folio_single_enable_pagination == 'on') {
		$folio_single_pagination_style = DfdMetaBoxSettings::compared('folio_single_pagination_style', false);

		if($folio_single_pagination_style) { ?>
			<div class="row <?php echo esc_attr($inside_width); ?>">
				<div class="twelve columns">
					<?php get_template_part('templates/pagination', 'links'); ?>
					<?php get_template_part('templates/entry-meta/folio-top-link'); ?>
				</div>
			</div>
		<?php } else {
			get_template_part('templates/inside-pagination');
		}
	}
	if (!post_password_required(get_the_id())) {
		if(!empty($inside_format) && strcmp($inside_format, 'default') !== 0) {
			get_template_part('templates/content', 'page');
			if($show_fixed_share == 'on') {
				get_template_part('templates/entry-meta/mini','share-single');
			}
		} else {
		?>
			<div class="row project <?php echo esc_attr($inside_width); ?>">
				<?php
				if($show_fixed_share == 'on') {
					get_template_part('templates/entry-meta/mini','share-single');
				}
				?>
				<?php get_template_part('templates/portfolio/inside', $folio_inside_template); ?>
			</div>
			<?php
			if (isset($dfd_ronneby['recent_items_disp']) && $dfd_ronneby['recent_items_disp']) {
				echo '<div class="dfd-portfolio-shortcodes">';
					echo do_shortcode($dfd_ronneby['block_single_folio_item']);
				echo '</div>';
			}
		}
	} else {
		echo get_the_password_form();
	}
	?>

</section>

<?php 
switch ($gallery_type) {
	case 'default':
		?>
		<script type="text/javascript">
			(function($) {
				"use strict";
				$(document).ready(function() {
					$('.portfolio-inside-main-carousel').slick({
						infinite: true,
						slidesToShow: 1,
						slidesToScroll: 1,
						speed: 600,
						arrows: false,
						asNavFor: '.portfolio-inside-thumbs-carousel',
						autoplay: true,
						autoplaySpeed: 7000,
						dots: false
					});
					$('.portfolio-inside-thumbs-carousel').slick({
						infinite: true,
						slidesToShow: 5,
						slidesToScroll: 1,
						asNavFor: '.portfolio-inside-main-carousel',
						speed: 600,
						centerMode: true,
						arrows: false,
						//focusOnSelect: true,
						dots: false,
						responsive: [
						{
							breakpoint: 1280,
							settings: {
								slidesToShow: 4,
								infinite: true,
								arrows: false,
								dots: false
							}
						},
						{
							breakpoint: 1024,
							settings: {
								slidesToShow: 3,
								infinite: true,
								arrows: false,
								dots: false
							}
						},
						{
							breakpoint: 600,
							settings: {
								slidesToShow: 2,
								arrows: false,
								dots: false
							}
						}
					]
					});
				});

			})(jQuery);
		</script>
		<?php
		break;
	case 'big_images_list':
		break;
	case 'middle_image_list':
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				var container = jQuery('#my-work-slider > ul');
				container.addClass('row collapse');
				jQuery('> li', container).addClass('columns six');
				container.portfolio_inside_isotop(2);
			});
		</script>
		<?php
		break;
	case 'small_images_list':
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				var container = jQuery('#my-work-slider > ul');
				container.addClass('row collapse');
				jQuery('> li', container).addClass('columns four');
				container.portfolio_inside_isotop(3);
			});
		</script>
		<?php
		break;
	case 'advanced_gallery':
		?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				var container = jQuery('#my-work-slider > ul');
				container.addClass('row collapse');
				jQuery('> li', container).first().addClass('columns eight').end().not(':first, .clear').addClass('columns four');
			});
		</script>
		<?php
		break;
}