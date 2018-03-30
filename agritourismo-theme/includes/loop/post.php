<?php 
	$image = get_post_thumb($post->ID,0,0); 
	if(!is_page_template ( 'template-homepage.php' )) { 
		$tag = "h2";
	} else {
		$tag = "h3";
	}
?>

<!-- BEGIN .article-block -->
<div class="article-block<?php if(get_option(THEME_NAME."_show_first_thumb") != "on" || $image['show']!=true) { ?> without-photo<?php } ?>">
	<?php get_template_part(THEME_LOOP."image"); ?>
	<div class="article-content">
		<<?php echo $tag;?>>
			<a href="<?php the_permalink();?>"><?php the_title();?></a>
			<?php if ( comments_open() ) { ?>
				<a href="<?php the_permalink();?>#comments" class="comment-link">
					<span class="icon-text">&#59160;</span>
					<?php comments_number("0","1","%"); ?>
				</a>
			<?php } ?>
		</<?php echo $tag;?>>
		<div class="article-icons">
			<?php echo the_author_posts_link();?>
			<span class="article-icon">
				<span class="icon-text">&#59148;</span>
				<?php 
					$postCategories = wp_get_post_categories( $post->ID );
					$catCount = count($postCategories);
					$i=1;
					foreach($postCategories as $c){
						$cat = get_category( $c );
						$link = get_category_link($cat->term_id);
					?>
						<a href="<?php echo $link;?>">
							<?php echo $cat->name;?>
						</a><?php if($catCount!=$i) { echo ", "; } ?> 
					<?php
						$i++;
					}
				?>
			</span>
			<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" class="article-icon"><span class="icon-text">&#128340;</span><?php the_time("F j, Y");?></a>
		</div>
		<?php 
			add_filter('excerpt_length', 'new_excerpt_length_40');
			the_excerpt();
			remove_filter('excerpt_length', 'new_excerpt_length_40');
		?>
		<a href="<?php the_permalink();?>" class="button-link">
			<?php _e("Read More", THEME_NAME);?>
			<span class="icon-text">&#9656;</span>
		</a>
	</div>
	<div class="clear-float"></div>
<!-- END .article-block -->
</div>