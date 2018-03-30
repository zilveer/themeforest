<?php

$hover_overlay = get_post_meta(get_the_ID(), '_hover_skin', true);
$hover_overlay = !empty($hover_overlay) ? (' style="background-color:' . $hover_overlay . '"') : '';

?>

<li>
	<div class="mk-portfolio-item <?php echo $view_params['hover_scenarios']; ?>-hover">

		<?php if ($view_params['hover_scenarios'] == 'none') { ?>
			<a class="full-cover-link" title="<?php the_title_attribute(); ?>" href="<?php echo esc_url( get_permalink() ); ?>">&nbsp;</a>
		<?php  } ?>


		<div class="featured-image">

			<?php echo mk_get_shortcode_view('mk_portfolio_carousel', 'components/thumbnail', true, ['width' => 500, 'height' => 350, 'image_size' => $view_params['image_size']]); ?>


		    <?php if ($view_params['hover_scenarios'] == 'fadebox') { ?>
		        <div class="hover-overlay add-gradient"<?php echo $hover_overlay; ?>></div>
		    <?php } else { ?>
		        <?php if ($view_params['hover_scenarios'] == 'zoomout') { ?>
		            <div class="image-hover-overlay"></div>
		        <?php } else { ?>
		            <a href="<?php echo mk_get_super_link(get_post_meta(get_the_ID(), '_portfolio_permalink', true)); ?>">
		            	<div class="image-hover-overlay"></div>
		            </a>
		    <?php }
		    } ?>

		    <?php if ($view_params['hover_scenarios'] != 'none') { ?>

			    <div class="icons-holder">
			    	<a class="hover-icon project-load" data-post-id="<?php echo the_ID(); ?>" href="<?php echo mk_get_super_link(get_post_meta(get_the_ID(), '_portfolio_permalink', true)); ?>">
						<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-circle', 30); ?>
			    	</a>

			    	<a class="hover-icon mk-lightbox" href="<?php echo mk_get_portfolio_lightbox_url($view_params['post_type']); ?>" title="<?php the_title_attribute(); ?>" data-fancybox-group="carousel-<?php echo $view_params['id']; ?>" >
						<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-plus-circle', 30); ?>
			    	</a>
			    </div>

		        <div class="portfolio-meta" <?php if($view_params['hover_scenarios'] == 'slidebox') { echo $hover_overlay; } ?>>
		        	<h3 class="the-title"><?php the_title(); ?></h3><div class="clearboth"></div>
			        <?php if ($view_params['meta_type'] == 'category') { ?>
			            <div class="item-cats"><?php echo implode(' ', mk_get_custom_tax(get_the_id(), 'portfolio', false, false)); ?></div>
			        <?php } else { ?>
			            <time class="item-date" datetime="<?php the_date('Y-m-d'); ?>"><?php the_date(); ?></time>
			       <?php  } ?>
		        </div>

		    <?php } ?>


		</div>
	</div>
</li>



