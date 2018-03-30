<div class="fullpage-contents-wrap">
	<div class="page-container">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="portfolio-contents">
				<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="entry-content clearfix">
						<?php
						the_content();
						?>
						</div>
					<?php endwhile; else: ?>
				<?php endif; ?>
			</div>
			<div>
					<ul id="portfolio-filter">
					<li><a href="#all"><?php _e('All','mthemelocal'); ?></a></li>
					<?php					
					$categories=  get_categories('child_of='.$portfolio_cat_ID.'&orderby=slug&taxonomy=types&title_li=');
					foreach ($categories as $category){ ?>
					<li><a href="#<?php echo "filter-" . $category->slug;?>" title="Filter by <?php echo $category->name;?>"><?php echo $category->name;?></a></li>
					<?php }?>
					</ul>
			</div>

			<div class="portfolio-wrap clearfix">
				<ul id="portfolio-list">
					<?php
					$newquery = array(
						'post_type' => 'mtheme_portfolio',
						'types' => $portfolio_cat_slug,
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page' => -1,
						);
					//$query = 'post_type=mtheme_portfolio&posts_per_page=-1&orderby=menu_order&order=ASC';
					query_posts($newquery);
					if (have_posts()) : while (have_posts()) : the_post();
					$custom = get_post_custom(get_the_ID());
					$portfolio_cats = get_the_terms( get_the_ID(), 'types' );
					$video_url="";
					$thumbnail="";
					if ( isset($custom["video"][0]) ) { $video_url=$custom["video"][0]; }
					if ( isset($custom["thumbnail"][0]) ) { $thumbnail=$custom["thumbnail"][0]; }
					?>
					<li class="<?php foreach ($portfolio_cats as $taxonomy) { echo 'filter-' . $taxonomy->slug . ' '; } ?>">
						<div class="filter-thumbnail-loader"></div>
						<?php if ( $custom["video"][0]<>"" ) { ?>
						<div class="fadethumbnail-play filter-thumbnail-block">
						<?php } else { ?>
						<div class="fadethumbnail-view filter-thumbnail-block">
						<?php } ?>
							<?php	if ($portfolio_link=="Lightbox") { ?>
							<a class="filter-image-holder" rel="prettyPhoto[gallery]" href="<?php if ( $custom["video"][0]<>"" ) { echo $video_url; } else { echo featured_image_link($post->ID); } ?>">
							<?php } else { ?>
							<a class="filter-image-holder" href="<?php the_permalink(); ?>">
							<?php } ?>
							<?php
							// Show Image
							if ($thumbnail<>"") {
								echo '<img src="'.$thumbnail.'" class="displayed-image" alt="thumbnail" />';
							} else {
								echo mtheme_display_post_image (
								$ID=get_the_id(),
								$image_url=false,
								$link=false,
								$type="portfolio-three",
								$post->post_title,
								$class="displayed-image"
								);
							}
							?>					
							</a>
						</div>
						<div class="work-details">
							<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h4>
							<p class="short"><?php echo $custom["description"][0];?></p>
						</div>
					</li>
					<?php endwhile; ?>
					<?php endif;?>
			 
				</ul>
			</div>
		</div>
	</div>
</div>