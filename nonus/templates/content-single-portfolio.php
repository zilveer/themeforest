<?php while (have_posts()) : the_post(); ?>
	<?php $custom = get_post_custom(get_the_ID()); ?>

	<div class="row-fluid">
		<?php if (ct_get_option("portfolio_single_show_image", 1)): ?>
	        <div class="span9">
		        <?php get_template_part('templates/portfolio/content-single-portfolio', ctPortfolioType::getMethodFromMeta($custom)); ?>
		    </div>
	    <?php endif;?>
		<div class="span3">
			<?php $next = get_next_post();?>
			<?php $prev = get_previous_post();?>
		    <nav class="work-nav">
			    <?php if($prev):?>
				    <a href="<?php echo get_permalink($prev->ID);?>" class="prev"><?php _e('Previous', 'ct_theme'); ?></a>
	            <?php endif;?>
			    <?php if($worksPage = ct_get_option('portfolio_index_page')): ?>
	                <?php
	                if(function_exists('icl_object_id')){
	                    $iclpageid = icl_object_id($worksPage, 'page', true, ICL_LANGUAGE_CODE);
	                    $worksPage = $iclpageid ? $iclpageid : $worksPage;
	                }
	                ?>
				    <a href="<?php echo get_permalink($worksPage);?>" class="all"><?php _e('All', 'ct_theme');?></a>
	            <?php endif;?>
			    <?php if($next):?>
				    <a href="<?php echo get_permalink($next->ID);?>" class="next"><?php _e('Next', 'ct_theme'); ?></a>
			    <?php endif;?>
		    </nav>
			<?php if (ct_get_option("portfolio_single_show_title", 1)): ?>
	            <h4><?php the_title();?></h4>
	        <?php endif;?>
			<?php if (ct_get_option("portfolio_single_show_content", 1)): ?>
	            <?php the_content();?>
	        <?php endif;?>
			<div class="spacer" style="height: 30px;"></div>
			<?php if (ct_get_option("portfolio_single_show_date", 1) && isset($custom['date'][0]) && $custom['date'][0]): ?>
	            <?php $dateIcon = isset($custom['date_icon'][0]) && $custom['date_icon'][0] ? $custom['date_icon'][0] : 'icon-calendar'?>
				<h4><i class="<?php echo $dateIcon; ?>"></i> <?php echo $custom['date'][0];?></h4>
	        <?php endif;?>
			<?php if (ct_get_option("portfolio_single_show_client", 1) && isset($custom['client'][0]) && $custom['client'][0]): ?>
	            <?php $clientIcon = isset($custom['client_icon'][0]) && $custom['client_icon'][0] ? $custom['client_icon'][0] : 'batch user-2'?>
				<h4><i class="<?php echo $clientIcon; ?>"></i> <?php echo $custom['client'][0];?></h4>
	       <?php endif;?>
			<?php if (ct_get_option("portfolio_single_show_venue", 1) && isset($custom['venue'][0]) && $custom['venue'][0]): ?>
	            <?php $venueIcon = isset($custom['venue_icon'][0]) && $custom['venue_icon'][0] ? $custom['venue_icon'][0] : 'icon-map-marker'?>
				<h4><i class="<?php echo $venueIcon; ?>"></i> <?php echo $custom['venue'][0];?></h4>
	       <?php endif;?>

			<?php $cats = ct_get_categories_string(get_the_ID(), ', ', 'portfolio_category');?>
	        <?php if (ct_get_option("portfolio_single_show_cats", 1) && $cats): ?>
	            <?php if ($cats): ?>
	                <h4><i class="icon-tag"></i> <?php echo $cats; ?></h4>
	            <?php endif; ?>
	        <?php endif;?>
			<?php if (isset($custom['external_url'][0]) && $custom['external_url'][0]): ?>
	            <?php $externalLabel = (isset($custom['external_label'][0]) && $custom['external_label'][0]) ? $custom['external_label'][0] : $custom['external_url'][0]?>
	            <h4>
	                <a href="<?php echo $custom['external_url'][0]?>"><i class="icon-link"></i> <?php echo $externalLabel;?></a>
	            </h4>
	        <?php endif;?>
		</div>
	</div>

    <div class="spacer" style="height: 30px"></div>

	<?php if (ct_get_option("portfolio_single_show_other_projects", 1)): ?>
		<?php echo do_shortcode('[works header="' . __('Related Works', 'ct_theme') . '" alllabel="" summaries="no" notids="' . get_the_ID() . '"]');?>
	<?php endif; ?>

	<?php comments_template('/templates/comments.php'); ?>

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
