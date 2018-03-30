<?php 
	$venue = get_post_meta ($post->ID, THEME_NAME."_venue", true );
	$date = get_post_meta ($post->ID, THEME_NAME."_datepicker", true );

?>

	<!-- BEGIN .event-block -->
	<div class="event-block">
		<div class="event-date">
			<a href="<?php the_permalink();?>" class="event-calendar"><?php echo date("d",$date);?><span><?php echo date("F",$date);?></span></a>
		</div>
		<div class="event-content">
			<h3>
				<a href="<?php the_permalink();?>"><?php the_title();?></a>
				<a href="<?php the_permalink();?>#comments" class="comment-link">
					<span class="icon-text">&#59160;</span><?php comments_number("0","1","%"); ?>
				</a>
			</h3>
			<div class="article-icons">
				<?php if($venue) { ?>
					<span class="article-icon">
						<span class="icon-text">&#59172;</span>
						<?php echo $venue;?>
					</span>
				<?php } ?>
				<a href="<?php the_permalink();?>" class="article-icon"><span class="icon-text">&#128340;</span><?php echo date("F d, Y, H:i",$date);?></a>
			</div>
			<div class="event-text">
				<?php 
					if(!is_page_template ( 'template-homepage.php' )) {
						add_filter('excerpt_length', 'new_excerpt_length_50');
					} else {
						add_filter('excerpt_length', 'new_excerpt_length_40');	
					}								
					the_excerpt();
					if(!is_page_template ( 'template-homepage.php' )) {
						remove_filter('excerpt_length', 'new_excerpt_length_50');
					} else {
						remove_filter('excerpt_length', 'new_excerpt_length_40');
					}
				?>
			</div>
			<a href="<?php the_permalink();?>" class="button-link"><?php _e("View More Information", THEME_NAME);?>
				<span class="icon-text">▸</span>
			</a>
		</div>
	<!-- END .event-block -->
	</div>
