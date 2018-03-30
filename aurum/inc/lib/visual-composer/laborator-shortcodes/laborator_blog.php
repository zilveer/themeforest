<?php
/**
 *	Products Carousel Shortcode for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */


class WPBakeryShortCode_laborator_blog_posts extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		global $parsed_from_vc, $quickview_enabled, $row_clear, $is_blog_posts;

		if( function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		}
		
		extract(shortcode_atts(array(
			'blog_query' => '',
			'row_clear' => '',
			'equal_heights' => '',
			'more' => '',
			'carousel_enabled' => '',
			'auto_rotate' => '',
			'el_class' => '',
			'css' => '',
		), $atts));

		$link     = vc_build_link($more);
		$a_href   = $link['url'];
		$a_title  = $link['title'];
		$a_target = trim($link['target']);

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lab_wpb_blog_posts  wpb_content_element '.($carousel_enabled ? ' carousel-enabled' : '').$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);

		$rand_id = "el_" . time() . mt_rand(10000,99999);

		list($args, $blog_query) = vc_build_loop_query($blog_query);

		ob_start();


		?>
		<div class="<?php echo $css_class; ?>" id="<?php echo $rand_id; ?>">

			<div class="blog-posts row"<?php echo $equal_heights && ! $carousel_enabled ? ' data-equal=".blog-post"' : ''; ?>>

				<?php
				$i = 1;

				while($blog_query->have_posts()): $blog_query->the_post();

					switch($row_clear)
					{
						case 1:
							$column_class = 'col-sm-12';
							break;

						case 2:
							$column_class = 'col-sm-6';
							break;

						case 3:
							$column_class = 'col-sm-4';
							break;

						default:
							$column_class = 'col-sm-3';
							break;
					}
					?>

					<?php if( ! $carousel_enabled): ?>
					<div class="col <?php echo $column_class; ?>">
					<?php endif; ?>

						<article class="blog-post<?php echo in_array($row_clear, array(3, 4)) ? ' block-image' : ''; ?>">

							<?php if(has_post_thumbnail()): ?>
							<div class="image">

								<a href="<?php the_permalink(); ?>">
									<?php #echo laborator_show_img(get_the_id(), 'blog-thumb-3'); ?>
									<?php the_post_thumbnail('blog-thumb-3'); ?>

									<span class="hover-overlay"></span>
									<span class="hover-readmore">
										<?php _e('Read more...', 'aurum'); ?>
									</span>
								</a>

							</div>
							<?php endif; ?>

							<div class="post">
								<h3>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

								<?php if(get_data('blog_post_date')): ?>
								<div class="date">
									<?php the_date(); ?>
								</div>
								<?php endif; ?>

								<div class="content">
									<?php echo apply_filters('the_excerpt', wp_trim_words(get_the_excerpt(), has_post_thumbnail() ? 20 : 35) ); ?>
								</div>
							</div>

						</article>

					<?php if( ! $carousel_enabled): ?>
					</div>
					<?php endif; ?>
					<?php

					if( ! $carousel_enabled)
						echo $i % $row_clear == 0 ? '<div class="clear"></div>' : '';

					$i++;

				endwhile;

				?>
			</div>


			<?php
			if($blog_query->have_posts() && $a_href && $a_title)
			{
				?>
				<div class="more-link">
					<a href="<?php echo $a_href; ?>" class="btn btn-white" target="<?php echo $a_target; ?>">
						<?php echo $a_title; ?>
					</a>
				</div>
				<?php
			}
			?>

		</div>

		<?php if($carousel_enabled): ?>
		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				var $carousel_el = $("#<?php echo $rand_id; ?> .blog-posts");

				$carousel_el.owlCarousel({
					items: <?php echo $row_clear; ?>,
					navigation: false,
					pagination: true,
					autoPlay: <?php echo absint($auto_rotate) <= 0 ? 'false' : $auto_rotate * 1000; ?>,
					stopOnHover: true,
					singleItem: <?php echo $row_clear == 1 ? 'true' : 'false'; ?>,
					direction: _rtl()
				});

				<?php if($equal_heights): ?>
				$carousel_el.find('.blog-post').equalHeights();

				imagesLoaded($carousel_el, function()
				{
					$carousel_el.find('.blog-post').equalHeights();
				});
				<?php endif; ?>
			});
		</script>
		<?php endif; ?>

		<?php


		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

// Shortcode Options
$opts = array(
	"name"		=> __("Blog Posts", TD),
	"description" => __('Display blog posts with carousel.', TD),
	"base"		=> "laborator_blog_posts",
	"class"		=> "vc_laborator_blog_posts",
	"icon"		=> "icon-lab-blog-posts",
	"controls"	=> "full",
	"category"  => __('Laborator', TD),
	"params"	=> array(


		array(
			"type" => "loop",
			"heading" => __("Products Query", TD),
			"param_name" => "blog_query",
			'settings' => array(
				'size' => array('hidden' => false, 'value' => 12),
				'order_by' => array('value' => 'date'),
				'post_type' => array('value' => 'post', 'hidden' => false)
			),
			"description" => __("Create WordPress loop, to populate products from your site.", TD)
		),

		array(
			"type" => "dropdown",
			"heading" => __("Columns count", TD),
			"param_name" => "row_clear",
			"std" => 2,
			"value" => array(
				"4 Columns"  => 4,
				"3 Columns"  => 3,
				"2 Columns"  => 2,
				"1 Column"   => 1,
			),
			"description" => __("Based on layout columns you use, select number of columns to wrap the product.", TD)
		),

		array(
			"type" => "checkbox",
			"heading" => __("Equal Heights", TD),
			"param_name" => "equal_heights",
			"value" => array(
				"Yes" => true
			),
			"description" => __("Set equal heights for all blog posts.", TD)
		),

		array(
			"type" => "vc_link",
			"heading" => __("More URL", TD),
			"param_name" => "more",
			"description" => __("Will add a link at the end of posts to continue to read more. (Optional)", TD)
		),

		array(
			"type" => "checkbox",
			"heading" => __("Enable Carousel", TD),
			"param_name" => "carousel_enabled",
			"value" => array(
				"Yes" => true
			),
			"description" => __("Activate horizontal scroll carousel for this widget.", TD)
		),

		array(
			"type" => "textfield",
			"heading" => __("Auto Rotate", TD),
			"param_name" => "auto_rotate",
			"value" => "5",
			"description" => __("You can set automatical rotation of carousel, unit is seconds. Enter 0 to disable.", TD),
			'dependency' => array( 'element' => 'carousel_enabled', 'not_empty' => true )
		),

		array(
			"type" => "textfield",
			"heading" => __("Extra class name", TD),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", TD)
		),

		array(
			"type" => "css_editor",
			"heading" => __('Css', TD),
			"param_name" => "css",
			"group" => __('Design options', TD)
		)
	)
);

// Add & init the shortcode
vc_map($opts);