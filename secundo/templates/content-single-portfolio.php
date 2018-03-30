<?php while (have_posts()) : the_post(); ?>
	<?php $custom = get_post_custom(get_the_ID()); ?>
	<?php if (ct_get_option("portfolio_single_show_title", 1)): ?>
		<div class="row-fluid">
			<div class="span12">
				<h2 class="vmedium"><?php echo the_title() ?></h2>
				<br>
			</div>
		</div>
	<?php endif; ?>
	<div class="row-fluid">
		<div class="span8">
			<?php if (ct_get_option("portfolio_single_show_image", 1)): ?>
				<?php get_template_part('templates/portfolio/content-single-portfolio', ctPortfolioType::getMethodFromMeta($custom)); ?>
			<?php endif; ?>

		</div>
		<div class="span4">
			<?php if (ct_get_option("portfolio_single_show_client", 1) && isset($custom['client'][0]) && $custom['client'][0]): ?>
				<h3 class="oneLine"><span><?php echo ct_get_option("portfolio_single_lab_client", __("CLIENT", "ct_theme")) ?></span></h3>
				<span class="vitalic"><?php echo $custom['client'][0]; ?></span><br>
			<?php endif; ?>

			<br>

			<?php $cats = get_the_terms(get_the_ID(), 'portfolio_category'); ?>
			<?php if (ct_get_option("portfolio_single_show_services", 1) && $cats): ?>
				<h3 class="oneLine"><span><?php echo ct_get_option("portfolio_single_lab_services", __("SERVICES", "ct_theme")) ?></span></h3>
				<?php if ($cats): ?>
					<?php foreach ($cats as $cat): ?>
						<span class="vitalic"><?php echo $cat->name ?></span><br>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endif; ?>

			<br>

			<?php if (ct_get_option("portfolio_single_show_content", 1)): ?>
				<h3 class="oneLine"><span><?php echo ct_get_option("portfolio_single_lab_about", __("ABOUT PROJECT", "ct_theme")) ?></span></h3>
				<p><?php the_content(); ?></p><br>
			<?php endif; ?>

			<?php if (isset($custom['external_url'][0]) && $custom['external_url'][0]): ?>
				<a href="<?php echo $custom['external_url'][0] ?>" class="btn vorange vlarge"><?php echo ct_get_option("portfolio_single_lab_button", __("SEE ONLINE", "ct_theme")) ?></a>
			<?php endif; ?>
		</div>
	</div>

	<?php comments_template('/templates/comments.php'); ?>

	<?php if (ct_get_option("portfolio_single_show_other_projects", 1)): ?>
		<?php echo do_shortcode('[row][full_column]<h2 class="crossLine"><span>' . __("OTHER PROJECTS", "ct_theme") . '</span></h2><br/>[works summaries="no" notids="' . get_the_ID() . '"][/full_column][/row]') ?>
	<?php endif; ?>

	<?php //highlight manu portfolio item ?>
	<?php if ($id = ct_get_option('portfolio_index_page')): ?>
		<?php if ($page = get_post($id)): ?>
			<?php
			if(function_exists('icl_object_id')){
				$iclpageid = icl_object_id($id, 'page', true, ICL_LANGUAGE_CODE);
				$page = $iclpageid ? get_post($iclpageid) : $page;
			}
			?>
			<script type="text/javascript">
				jQuery(document).ready(function () {
					var $menu = jQuery('#nav-main');
					var $element = $menu.find('a[href*="/<?php echo $page->post_name?>/"]').parent();
					if ($element.length == 1) {
						$menu.find('li').removeClass('active');
						$element.addClass("active");
					}
				});
			</script>
		<?php endif; ?>
	<?php endif; ?>

<?php endwhile; ?>
