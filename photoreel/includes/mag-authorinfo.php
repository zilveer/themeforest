		<div class="postauthor">
        	<h3 class="leading"><?php _e('About the Author','themnific');?>: <?php the_author_posts_link(); ?></h3>
            <div class="hrline"></div>  
			<?php  echo get_avatar( get_the_author_meta('ID'), '75' );   ?>
 			<div class="authordesc"><?php the_author_meta('description'); ?></div>
		</div>