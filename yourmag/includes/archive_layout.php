    
	
	
	<div id="archive">
	
	<div class="archive_title"><h3><?php echo get_option('op_30_recent_posts'); ?></h3></div> 
    <ul>
	
	<?php $archive_query = new WP_Query('showposts=30');  
        while ($archive_query->have_posts()) : $archive_query->the_post(); ?>  
		
        <li>  
		<?php if(has_post_thumbnail()) { ?>
		<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnails', false, '' ); $thumbnailSrc = $src[0]; ?>		
		
		<?php echo $post_format_image ?> 
		
        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
		<?php $image = aq_resize( $thumbnailSrc, 70, 40, true); ?>
        <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
		</a>
		
        <?php } else {} ?>
		
        <a class="arch_title" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>  
	   
	   </li>  
    <?php endwhile; ?>  
    </ul>
	
    </div>
	
	<div class="clear"></div>