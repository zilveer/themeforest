<div id="services-wrap">
	<ul id="servicesbox">
    
		<?php $loop = new WP_Query( array( 'post_type' => 'service','posts_per_page' => 50) ); ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <?php 
			$themnific_service_data = get_post_meta($post->ID, 'themnific_service_link', true);
		?>
        
            <li class="services">
                
        		<?php the_post_thumbnail('service-thumb'); ?>
                
				<?php if (get_post_meta($post->ID, 'themnific_service_link', true)) { ?>
                
                	<h3><a href="<?php echo $themnific_service_data; ?>"><?php the_title(  ); ?></a></h3>
                    
  				<?php } else { ?>
                
					<h3><?php the_title(  ); ?></h3>
                    
				<?php } ?>       
                
                <span class="spanner"></span>
                       
                <?php the_excerpt(); ?>
                
            </li>
        
        <?php endwhile; ?>
    
    </ul>
</div> 
<div style="clear: both;"></div>	