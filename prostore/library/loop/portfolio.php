<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/loop/portfolio.php
 * @file	 	1.0
 */
?>
<?php
	global $masonry, $data, $prefix;
?>

<?php

	$portfolio_cats = get_the_terms( get_the_ID(), 'field' );

?>

<div class="portfolio-<?php echo $masonry; ?>-item <?php if($portfolio_cats != '') {foreach ($portfolio_cats as $taxonomy) { echo $taxonomy->slug .' '; } } ?>" id="post-<?php echo get_the_ID(); ?>">

	<div class="portfolio-post clearfix <?php echo $masonry; ?>">

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
			<?php
				$link = get_permalink($post->ID);
			?>
			<a class="entry-item" href="<?php echo $link; ?>" title="<?php the_title(); ?>">
				<div class="portfolio-thumb">
					<?php
						$thumb = featured_image_link_portf($post->ID);
					?>
					<?php if($masonry!="masonry") { ?>
						<img src="<?php echo $thumb; ?>" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" width="400" height="225" />
					<?php } else { ?>
						<?php the_post_thumbnail('full'); ?>
					<?php } ?>
					<div class="overlay">
						<div class="overlay-inner">
							<div class="overlay-content">
							<!-- 	<p><em class="icon-plus icon-white"></em></p> -->
								<h3><?php echo get_the_title(); ?></h2>
								<?php if($data[$prefix."meta_portf_field"]=="1") { ?>
									<div class="portfolio-cats">
									<?php
										$project_cats = get_the_terms($post->ID, 'field');
										if($project_cats) { $project_cats = array_values($project_cats); }
										for($cat_count=0; $cat_count<count($project_cats); $cat_count++) {
										    echo $project_cats[$cat_count]->name;
										    if ($cat_count<count($project_cats)-1){
										        echo ', ';
										    }
										}
									?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</a>

		</article> <!-- end article -->
	</div>

</div>