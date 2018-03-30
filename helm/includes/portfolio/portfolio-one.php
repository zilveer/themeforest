<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="fullpage-portfolio-wrap">
	<div class="page-container">
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
if ( post_password_required() ) {
	
	echo '<div id="password-protected">';
	echo get_the_password_form();
	echo '</div>';
	
	} else {
?>				
<div class="portfolio-columns-wrap clearfix">
	<ul class="portfolio-one">
		<?php
		if ($portfolio_category=="All the items") {
			query_posts( array( 'post_type' => 'mtheme_portfolio', 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $paged , 'posts_per_page' => $portfolio_perpage) );
			} else {
			query_posts( array( 'post_type' => 'mtheme_portfolio', 'orderby' => 'menu_order', 'order' => 'ASC', 'types' => $portfolio_category , 'paged' => $paged , 'posts_per_page' => $portfolio_perpage) );
		}
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
		?>
		<li>
			
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
						$type="portfolio-full",
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
 
	</ul>
	<?php require ( MTHEME_INCLUDES . '/navigation.php' ); ?>
</div>

<?php
}
?>
		</div>
	</div>
</div>