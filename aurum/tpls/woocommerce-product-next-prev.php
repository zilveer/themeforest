<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if( ! get_data('shop_single_next_prev'))
	return;

$prev_post = get_adjacent_post(true, '', false, 'product_cat');
$next_post = get_adjacent_post(true, '', true, 'product_cat');

$prev_product = get_product($prev_post);
$next_product = get_product($next_post);


if( ! $prev_post && ! $next_post)
	return;
?>
<div class="svg-wrap">
	<!--
<svg width="64" height="64" viewBox="0 0 64 64">
		<path id="arrow-previous" d="M26.667 10.667q1.104 0 1.885 0.781t0.781 1.885q0 1.125-0.792 1.896l-14.104 14.104h41.563q1.104 0 1.885 0.781t0.781 1.885-0.781 1.885-1.885 0.781h-41.563l14.104 14.104q0.792 0.771 0.792 1.896 0 1.104-0.781 1.885t-1.885 0.781q-1.125 0-1.896-0.771l-18.667-18.667q-0.771-0.813-0.771-1.896t0.771-1.896l18.667-18.667q0.792-0.771 1.896-0.771z" />
	</svg>
	<svg width="64" height="64" viewBox="0 0 64 64">
		<path id="arrow-next" d="M37.333 10.667q1.125 0 1.896 0.771l18.667 18.667q0.771 0.771 0.771 1.896t-0.771 1.896l-18.667 18.667q-0.771 0.771-1.896 0.771-1.146 0-1.906-0.76t-0.76-1.906q0-1.125 0.771-1.896l14.125-14.104h-41.563q-1.104 0-1.885-0.781t-0.781-1.885 0.781-1.885 1.885-0.781h41.563l-14.125-14.104q-0.771-0.771-0.771-1.896 0-1.146 0.76-1.906t1.906-0.76z" />
	</svg>
-->

	<svg width="64" height="64" viewBox="0 0 64 64">
		<path id="arrow-previous" d="M46.077 55.738c0.858 0.867 0.858 2.266 0 3.133s-2.243 0.867-3.101 0l-25.056-25.302c-0.858-0.867-0.858-2.269 0-3.133l25.056-25.306c0.858-0.867 2.243-0.867 3.101 0s0.858 2.266 0 3.133l-22.848 23.738 22.848 23.738z" />
	</svg>
	<svg width="64" height="64" viewBox="0 0 64 64">
		<path id="arrow-next" d="M17.919 55.738c-0.858 0.867-0.858 2.266 0 3.133s2.243 0.867 3.101 0l25.056-25.302c0.858-0.867 0.858-2.269 0-3.133l-25.056-25.306c-0.858-0.867-2.243-0.867-3.101 0s-0.858 2.266 0 3.133l22.848 23.738-22.848 23.738z" />
	</svg>
</div>


<nav class="nav-growpop">

	<?php if($prev_post): ?>
	<a class="prev" href="<?php echo get_permalink($prev_post); ?>">
		<span class="icon-wrap">
			<svg class="icon" width="24" height="24" viewBox="0 0 64 64">
				<use xlink:href="#arrow-previous">
			</svg>
		</span>
		<div class="popup-container">
			<h3><?php echo get_the_title($prev_post); ?></h3>
			<p class="price"><?php echo $prev_product->get_price_html(); ?></p>
			<?php
			if($prev_post->_thumbnail_id):
				echo wp_get_attachment_image($prev_post->_thumbnail_id, apply_filters( 'aurum_woocommerce_prevnext_thumbnail_size', 'thumbnail' ) );
			else:
				echo '<img src="' . wc_placeholder_img_src() . '" />';
			endif;

			?>
		</div>
	</a>
	<?php endif; ?>

	<?php if($next_post): ?>
	<a class="next" href="<?php echo get_permalink($next_post); ?>">
		<span class="icon-wrap">
			<svg class="icon" width="24" height="24" viewBox="0 0 64 64">
				<use xlink:href="#arrow-next">
			</svg>
		</span>
		<div class="popup-container">
			<h3><?php echo get_the_title($next_post); ?></h3>
			<p class="price"><?php echo $next_product->get_price_html(); ?></p>
			<?php
			if($next_post->_thumbnail_id):
				echo wp_get_attachment_image($next_post->_thumbnail_id, apply_filters( 'aurum_woocommerce_prevnext_thumbnail_size', 'thumbnail' ) );
			endif;

			?>
		</div>
	</a>
	<?php endif; ?>
</nav>