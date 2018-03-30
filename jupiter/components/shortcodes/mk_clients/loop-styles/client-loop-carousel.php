<?php


$slideshow_params[] = 'data-animation="slide"';
$slideshow_params[] = 'data-easing="swing"';
$slideshow_params[] = 'data-direction="horizontal"';
$slideshow_params[] = 'data-smoothHeight="false"';
$slideshow_params[] = 'data-slideshowSpeed="' . (($view_params['autoplay'] == 'false') ? 100000 : 4000) . '"';
$slideshow_params[] = 'data-animationSpeed="500"';
$slideshow_params[] = 'data-pauseOnHover="true"';
$slideshow_params[] = 'data-controlNav="false"';
$slideshow_params[] = 'data-directionNav="' . (($view_params['autoplay'] == 'false') ? 'true' : 'false') . '"';
$slideshow_params[] = 'data-isCarousel="true"';
$slideshow_params[] = 'data-itemWidth="180"';
$slideshow_params[] = 'data-itemMargin="0"';
$slideshow_params[] = 'data-minItems="1"';
$slideshow_params[] = 'data-maxItems="6"';
$slideshow_params[] = 'data-move="1"';

$class[] = 'bg-cover-' . $view_params['cover'];
$class[] = ($view_params['title'] == '') ? 'slideshow-no-title' : '';
$class[] = ($view_params['title'] == '') ? 'slideshow-no-title' : '';
$class[] = $view_params['el_class'];


?>
<div id="clients-<?php echo $view_params['id']; ?>" <?php echo implode(' ', $slideshow_params); ?> class="mk-clients mk-flexslider js-flexslider mk-script-call <?php echo implode(' ', $class); ?>">

	<?php mk_get_view('global', 'shortcode-heading', false, ['title' => $view_params['title']]); ?>

	<ul class="mk-flex-slides">

		<?php 
		while ($view_params['query']->have_posts()):
		    $view_params['query']->the_post();
		    $url = get_post_meta(get_the_ID() , '_url', true);

		    $image_src = Mk_Image_Resize::resize_by_id( get_post_thumbnail_id(), 'full', false, false, $crop = false, $dummy = true);
		    ?>
		    <li>
			    <?php 
			    echo !empty($url) ? '<a target="' . $view_params['target'] . '" href="' . $url . '">' : '';
			    ?>
			    <div title="<?php the_title_attribute(); ?>" class="client-logo" style="background-image:url(<?php echo $image_src; ?>); <?php echo $view_params['height']; ?>"></div>
			    <?php 
			    echo !empty($url) ? '</a>' : '';
			    ?>
		    </li>
		<?php     
		endwhile;
		wp_reset_query();
		?>

	</ul>
</div>
