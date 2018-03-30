<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

global $mk_options;



$query = mk_wp_query(array(
            'post_type' => 'slideshow',
            'count' => $count,
            'posts' => $slides,
            'orderby' => $orderby,
            'order' => $order,
        ));

$loop = $query['wp_query'];

$slider_atts[] = 'data-animation="'.$effect.'"';
$slider_atts[] = 'data-easing="swing"';
$slider_atts[] = 'data-direction="horizontal"';
$slider_atts[] = 'data-smoothHeight="'.$smooth_height.'"';
$slider_atts[] = 'data-animationSpeed="'.$animation_speed.'"';
$slider_atts[] = 'data-slideshowSpeed="'.$slideshow_speed.'"';
$slider_atts[] = 'data-pauseOnHover="'.$pause_on_hover.'"';
$slider_atts[] = 'data-controlNav="false"';
$slider_atts[] = 'data-directionNav="'.$direction_nav.'"';
$slider_atts[] = 'data-isCarousel="false"';


mk_get_view('global', 'shortcode-heading', false, ['title' => $title]); ?>


<div class="mk-slideshow mk-script-call mk-flexslider js-flexslider <?php echo $el_class; ?>" style="max-width:<?php echo $image_width; ?>px;" <?php echo implode(' ', $slider_atts); ?>>
	<ul class="mk-flex-slides">
		<?php 
		while ( $loop->have_posts() ):
			$loop->the_post();

			$url = mk_get_super_link(get_post_meta( get_the_ID(), '_link_to', true ), false);
			$caption = get_post_meta( get_the_ID(), '_title', true );
			$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		?>

		<li>
				<?php if(!empty( $url )) { ?>
					<a href="<?php echo $url; ?>">
				<?php } ?>

					<img alt="<?php echo $caption; ?>" src="<?php echo $image_src_array[ 0 ]; ?>" />

				<?php if(!empty( $url )) { ?>
					</a>
				<?php } ?>

				<?php if(!empty( $caption )) { ?>
					<div class="mk-flex-caption">
						<div style="background-color:<?php echo !empty( $caption_bg_color ) ? $caption_bg_color : $mk_options['skin_color']; ?>; opacity:<?php echo $caption_bg_opacity; ?>;" class="color-mask"></div>
						<span style="color:<?php echo $caption_color; ?>"><?php echo $caption; ?></span>
					</div>
				<?php } ?>
		</li>
		<?php 
		endwhile;
		wp_reset_query();
		?>
	</ul>
</div>
