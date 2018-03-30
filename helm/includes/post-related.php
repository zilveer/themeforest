<?php
	$count=0;
	$original_post = $post;
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) {
		$tagcount = count($tags);
		for ($i = 0; $i < $tagcount; $i++) {
		  $tagIDs[$i] = $tags[$i]->term_id;
		}
		$args=array(
			'tag__in' => $tagIDs,
			'post__not_in' => array($post->ID),
			'showposts'=>4,
			'caller_get_posts'=>1
		   );
		$my_query = new WP_Query($args);
		if( $my_query->have_posts() ) {
			echo '<div class="relatedbigtitle">'.__('Related Posts','mthemelocal').'</div>';
			echo '<div class="relatedposts">';
			while ($my_query->have_posts()) : $my_query->the_post(); ?>
		
		<?php
		$image_id = get_post_thumbnail_id(($post->ID), 'full'); 
		$image_url = wp_get_attachment_image_src($image_id,'full');  
		$image_url = $image_url[0];
		$count++;
		?>
			<div class="relatedblock <?php if ($count<4) { echo 'relatedmargin'; } ?>">
				<div class="relatedimage">
				  <a href="<?php the_permalink() ?>">
					<?php 
					
					echo showfeaturedimage (
						$post->ID,
						$linked,
						$resize=true,
						$related_height=90,
						$related_width=125,
						$quality=THEME_IMAGE_QUALITY, 
						$crop=1,
						$post->post_title,
						$class="" 
						);
					
					?>
				  </a>
				</div>
				<div class="relatedtextblock">
					<div class="relatedtitle">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php the_title(); ?>
					</a>
					</div>
				</div>
			</div>
		<?php endwhile;
		echo "</div>";
	  }
	}
	$post = $original_post;
	wp_reset_query();
?>

<div class="clear"></div>