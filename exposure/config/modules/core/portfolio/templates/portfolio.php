<ul id="thb-portfolio-container">

	<?php
		thb_works_query();

		if( have_posts() ) : $i=1; while( have_posts() ) : the_post();
	?>

		<?php
			global $post;

			$work_id = get_the_ID();

			$work_featured_image = thb_get_featured_image($work_id, $work_image_size);
			$work_categories = wp_get_object_terms($work_id, 'portfolio_categories');

			$itemclass = $cats = array();
			$itemclass = thb_get_post_classes( $i, array(''), $num_cols );

			if( empty($work_featured_image) ) {
				$itemclass[] = 'wout-featured-image';
			}

			foreach( $work_categories as $cat ) {
				$itemclass[] = $cat->slug;
				$cats[] = $cat->name;
			}
		?>
		<?php thb_post_before(); ?>

		<li class="item <?php echo implode(" ", $itemclass); ?> ">
			<?php thb_post_start(); ?>

			<?php
				thb_portfolio_item(array(
					'work_featured_image' => $work_featured_image,
					'post' => $post,
					'work_categories' => $cats,
					'portfolio_item_template' => $portfolio_item_template,
					'i' => $i
				));
			?>

			<?php thb_post_end(); ?>
		</li>

		<?php thb_post_after(); ?>

	<?php $i++; endwhile; endif; ?>
</ul>

<?php
	$thb_pagination_config = array(
		'type' => 'links',
		'id' => 'thb-portfolio-pagination'
	);

	if( isset($previousText) ) $thb_pagination_config['previousText'] = $previousText;
	if( isset($nextText) ) $thb_pagination_config['nextText'] = $nextText;
	if( isset($arrowPreviousText) ) $thb_pagination_config['arrowPreviousText'] = $arrowPreviousText;
	if( isset($arrowNextText) ) $thb_pagination_config['arrowNextText'] = $arrowNextText;

	thb_pagination($thb_pagination_config);
?>

<script type="text/javascript">

	jQuery(document).ready(function($) {

		$.thb.config.set('portfolio', $.thb.config.defaultKeyName, {
			useAJAX: <?php echo (int) thb_get_post_meta(thb_get_page_ID(), 'works_ajax_pagination'); ?>
		});

	});

</script>