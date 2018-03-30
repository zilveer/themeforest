<?php 
	/*
	Template Name: Archives
	*/
	get_header();
	the_post();
	
	$recent_posts = wp_get_recent_posts( 'numberposts=15' );
	$tags = get_tags();
?>

<section id="content" class="clearfix">
	
	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<?php 
			the_content(); 
			
			if( get_the_content() )
				echo '<div class="break-30"></div>';
		?>
		
		<div class="one_fourth">
			<h4 class="margin-bottom-10"><?php _e('By Month', 'ebor_starter'); ?></h4>
			<ul class="post-categories">
			   <?php wp_get_archives('type=monthly&limit=12'); ?>
			</ul>
		</div>
		
		<div class="one_fourth">
			<h4 class="margin-bottom-10"><?php _e('Last 15 Posts', 'ebor_starter'); ?></h4>
			<ul class="post-categories">
				<?php
					foreach( $recent_posts as $recent ){
						echo '<li><a href="'.get_permalink($recent["ID"]).'">'.$recent["post_title"].'</a></li>';
					}
				?>
			</ul>
		</div>
		
		<div class="one_fourth">
			<h4 class="margin-bottom-10"><?php _e('By Category', 'ebor_starter'); ?></h4>
			<ul>
			   <?php wp_list_categories('title_li='); ?> 
			</ul>
		</div>
		
		<div class="one_fourth last">
			<h4 class="margin-bottom-10"><?php _e('By Tags', 'ebor_starter'); ?></h4>
			<ul>
				<?php 
					foreach ($tags as $tag){
						echo '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a></li>';
					} 
				?>
			</ul>
		</div>
		<div class="clear"></div>
	
	</article>
	
</section>

<?php	
	get_footer();