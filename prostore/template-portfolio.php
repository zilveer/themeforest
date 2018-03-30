<?php
/*
Template Name: Portfolio
*/
?>
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
 * @package 	proStore/template-portfolio.php
 * @file	 	1.0
 */
?>
<?php get_header(); ?>

    	<div id="main" class="clearfix template-portfolio" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php
					$temp = $wp_query;
					$wp_query= null;
					$wp_query = new WP_Query();

					if(get_post_meta($post->ID,'portfolio_pagination',true)=="on") {
						$posts_per_page = get_option('posts_per_page');
					} else {
						$posts_per_page = '-1';
					}

					if(get_post_meta($post->ID,'portfolio_tax_specific',true)!="on") {
						$args = array(
								'post_type'=>array('portfolio'),
					 			'posts_per_page'=>$posts_per_page,
					 			'orderby'=>'menu_order',
					 			'order'=>'ASC',
					 			'ignore_sticky_posts' => 1,
					 			'paged'=>$paged
					 			);
					} else {
						$args = array(
								'post_type'=>array('portfolio'),
					 			'posts_per_page'=>$posts_per_page,
					 			'orderby'=>'menu_order',
					 			'order'=>'ASC',
					 			'ignore_sticky_posts' => 1,
					 			'tax_query' => array(
					 				array(
										'taxonomy' => 'field',
										'field' => 'id',
										'terms' => get_post_meta($post->ID,'portfolio_tax',true)
					 				)
					 			),
					 			'paged'=>$paged
						);
					}
					$wp_query->query($args);
				?>

				<?php if(get_post_meta($post->ID,"portfolio_tax_specific",true)!="on" && get_post_meta($post->ID,"portfolio_filter",true)=="on") { ?>
					<div class="filter-container clearfix text-center" id="portfolio-filter">
						<div class="row container">
							<dl class="clearfix sub-nav hide-for-small twelve columns" id="filter">
								<dt><span>Filter</span></dt>
								<dd class="all"><a href="#" class="active" data-filter="*">All</a></dd>
									<?php
									$categories= get_categories('orderby=slug&taxonomy=field&title_li=');
									foreach ($categories as $category){
								?>
									<dd class="cat-item <?php echo strtolower($category->slug);?>"><a href="#" title="All posts under <?php echo $category->name;?>" data-filter=".<?php echo strtolower($category->slug);?>"><?php echo $category->name;?></a></dd>
								<?php
									}
								?>
							</dl>
							<div class="text-center show-for-small">
								<ul class="button-group portfolio-filter clearfix" id="filter_responsive" name="filter_responsive">
	  								<li><a href="#" class="button prefix active" title="View all projects" data-filter="*"><i class="icon-cw"></i></a></li>
	  								<li>
	  									<div href="#" class="button dropdown postfix">
	  										Filter
	  										<ul>
												<?php
													$categories= get_categories('orderby=slug&taxonomy=field&title_li=');
													foreach ($categories as $category){
												?>
													<li class="cat-item <?php echo strtolower($category->slug);?>"><a href="#" title="All posts under <?php echo $category->name;?>" data-filter=".<?php echo strtolower($category->slug);?>"><?php echo $category->name;?> <span class="label"><?php echo $category->count; ?></span></a></li>
												<?php
													}
												?>
	 	 									</ul>
										</div>
									</li>
								</ul>
							</div>

						</div>
					</div>
				<?php } ?>


				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

					<header class="row container clearfix">
						<div class="twelve columns clearfix">
							<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
							<?php if(get_post_meta($post->ID,"page_subtitle",true)!="") { ?>
								<h4 class="subheader"><?php echo get_post_meta($post->ID,"page_subtitle",true); ?></h4>
							<?php } ?>
						</div>
					</header> <!-- end article header -->

					<?php
						$masonry = get_post_meta($post->ID,"portfolio_style",true);
					?>

					<?php if(!empty( $post->post_content) ) { ?>
						<div class="row">
							<div class="twelve columns">
								<?php the_content(); ?>
							</div>
						</div>
					<?php } ?>

					<section class="post_content portfolio-<?php echo $masonry; ?>">

						<?php

							while ($wp_query->have_posts()) : $wp_query->the_post();

								get_template_part( 'library/loop/portfolio');

							endwhile;
						?>

					</section> <!-- end article section -->


					<footer>

						<?php get_template_part( 'library/loop/pagination'); ?>

						<?php
							$wp_query = null; $wp_query = $temp;
							wp_reset_query();
						?>

					</footer> <!-- end article footer -->

				</article> <!-- end article -->

			<?php endwhile; ?>

			<?php else : ?>

				<?php article_not_found(); ?>

			<?php endif; ?>

		</div> <!-- end #main -->

<?php get_footer(); ?>