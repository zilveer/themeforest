	<!--Slider Begin-->
	<div id="homepage-slider">
    	<div class="flexslider">
        	<ul class="slides">
			<?php wp_reset_query(); query_posts('post_type=slider&posts_per_page=-1&orderby=menu_order&order=ASC'); if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            <li>
            	<?php 				
				$slide_link = get_post_meta($post->ID, 'slide_link', true); 
				$slide_caption = get_post_meta($post->ID, 'slide_caption', true);
				$slide_title = get_post_meta($post->ID, 'slide_title_enabled', true);
				
				if($slide_link){ echo '<a href="'.$slide_link.'">'; } // Check if the slide has a link assigned ?>
            	<img src="<?php $imgurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homepage-slider' ); echo $imgurl[0]; ?>" alt>
                <?php 
				if($slide_link){ echo '</a>'; } 				
				if($slide_caption){
					echo '<p class="flex-caption">';
					echo '<span class="slide-caption">'.$slide_caption.'</span>';
					echo '</p>';
				}
				?>             
            </li>
            
            <?php endwhile; endif; ?>
        	</ul>
		</div>
    </div>
	<!--Slider End-->