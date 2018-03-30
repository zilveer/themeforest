<?php
$home_portfolio_column= of_get_option('home_portfolio_column');
$home_portfolio_cateogry= of_get_option('home_portfolio_category');
$portfolio_from = of_get_option('home_portfolio_from');
$portfoliol_limit = of_get_option('home_portfolio_limit');
	if ($portfoliol_limit==0) $portfoliol_limit=-1;
	
$portfolio_link=of_get_option('home_portfolio_link');
//$portfolio_column = "three-portfolio";
//$rows=3;
if ($home_portfolio_column=="2col") { $portfolio_column="two"; $portfolio_imagesize="large"; $columns=2; }
if ($home_portfolio_column=="3col") { $portfolio_column="three"; $portfolio_imagesize="medium"; $columns=3; }
if ($home_portfolio_column=="4col") { $portfolio_column="four"; $portfolio_imagesize="small"; $columns=4; }
	
if ($home_portfolio_cateogry=="All the items") $home_portfolio_cateogry="";

$height=0;
$count=0;
$portfolio_column_count=1;

$portfolio_from="portfolio";
?>
<section>
	<div class="section-wrap clearfix">
		<div class="grid-content-portfolio">
			<h2><?php echo of_get_option('portfolio_title'); ?></h2>
			<p class="description"><?php echo of_get_option('portfolio_description'); ?></p>
		</div>
		<div class="homeportfolio-columns-wrap clearfix">
			<ul class="portfolio-<?php echo $portfolio_column; ?>">
			<?php
			
			switch($portfolio_from) {
			
			case "portfolio":
			
				$newquery = array(
					'post_type' => 'mtheme_portfolio',
					'types' => $home_portfolio_cateogry,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'posts_per_page' => $portfoliol_limit,
					);
				query_posts($newquery);
				
					//query_posts($query);
					if (have_posts()) : while (have_posts()) : the_post();
					$custom = get_post_custom(get_the_ID());
					$portfolio_cats = get_the_terms( get_the_ID(), 'types' );
					$video_url="";
					$thumbnail="";
					$link_url="";
					if ( isset($custom["video"][0]) ) { $video_url=$custom["video"][0]; }
					if ( isset($custom["thumbnail"][0]) ) { $thumbnail=$custom["thumbnail"][0]; }
					if ( isset($custom["custom_link"][0]) ) { $link_url=$custom["custom_link"][0]; }
					$portfolio_thumb_header=$custom["portfolio_page_header"][0];
					
					if ($portfolio_column_count>$columns) $portfolio_column_count=1;
					?>
						<li class="portfolio-col-<?php echo $portfolio_column_count++; ?>">
							
							<?php
							if ( $custom["video"][0]<>"" ) {
								$p_class="fadethumbnail-play";
							} elseif ( $custom["custom_link"][0]<>"" ) {
								$p_class="fadethumbnail-link";
							} else {
								$p_class="fadethumbnail-view";
							}
							?>
								<?php
								if ($portfolio_link=="Lightbox" || $custom["custom_link"][0]<>"") {
									if ( $custom["video"][0]<>"" ) {
										echo activate_lightbox (
											$lightbox_type="prettyPhoto",
											$ID=$post->ID,
											$link=$video_url,
											$mediatype="video",
											$title=$post->post_title,
											$class="portfolio-image-link portfolio-columns",
											$navigation="prettyPhoto[portfolio]"
											);
										echo '<span class="column-portfolio-icon portfolio-video-icon"></span>';
										} elseif ( $custom["custom_link"][0]<>"" ) {
											echo '<a class="portfolio-image-link portfolio-columns" title="'.get_the_title().'" href="'.$custom["custom_link"][0].'" >';
											echo '<span class="column-portfolio-icon portfolio-link-icon"></span>';
					
										} else {
											echo activate_lightbox (
												$lightbox_type="prettyPhoto",
												$ID=$post->ID,
												$link=featured_image_link($post->ID),
												$mediatype="image",
												$title=$post->post_title,
												$class="portfolio-image-link portfolio-columns",
												$navigation="prettyPhoto[portfolio]"
												);
										echo '<span class="column-portfolio-icon portfolio-image-icon"></span>';
									}
								} else {
									echo '<a class="portfolio-image-link portfolio-columns" title="'.get_the_title().'" href="'.get_permalink().'" >';
									echo '<span class="column-portfolio-icon portfolio-image-icon"></span>';
								}
								?>
								<?php
								// Show Image
								if ($thumbnail<>"") {
									echo '<img src="'.$thumbnail.'" class="preload-image displayed-image" alt="thumbnail" />';
								} else {
									echo display_post_image (
										$post->ID,
										$have_image_url=$thumbnail_image_url,
										$link=false,
										$type="portfolio-" . $portfolio_imagesize,
										$post->post_title,
										$class="preload-image displayed-image"
									);
								}
								?>		
								</a>
								<div class="work-details">
									<h4><a href="<?php if ($link_url<>"") { echo $link_url; } else { the_permalink(); } ?>" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h4>
									<p class="entry-content work-description"><?php echo $custom["description"][0];?></p>
								</div>
						</li>
						<?php endwhile; ?>
						<?php endif;?>
 
			<?php
				break;
			}				
			?>
			</ul>
		</div>
	</div>
</section>