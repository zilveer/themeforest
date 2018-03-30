<?php
static $gallery_id;
$terms = get_the_terms( $post->ID , 'portfolio_filter', 'string');
$term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
$second_query = new WP_Query( array(
      'post_type' => 'portfolio',
      'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_filter',
                        'field' => 'id',
                        'terms' => $term_ids,
                        'operator'=> 'IN' //Or 'AND' or 'NOT IN'
                     )),
      'posts_per_page' => 4,
      'ignore_sticky_posts' => 1,
      'orderby' => 'date',  // 'rand' for random order
      'post__not_in'=>array($post->ID)
   ) );
?>

<?php	//Loop through posts and display...
	if($second_query->have_posts()) {?>
		<section id="portfolio-related-post" class="section-fullwidth">
		<div class="container">
			<div class="span12">
				<div class="separator_block center">
					<h3><span><?php _e('Related Projects', 'richer'); ?></span></h3>
					<div class="separator short" style="margin-bottom:45px;">
						<div class="separator_line"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<ul class="unstyled row-fluid">
			<?php while ($second_query->have_posts() ) : $second_query->the_post(); ++$gallery_id; ?>
		      	<li>
		      		<div class="portfolio-item span3 no-margin">
				    <?php 
					if ( has_post_thumbnail()) { ?> 
					  		<div class="portfolio-pic"><?php the_post_thumbnail('span4'); ?>
					  			<div class="portfolio-overlay">
	          						<?php echo overlay_link($gallery_id);?>
	          					</div>
					  		</div>
					  		<div class="portfolio-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div><div class="clear"></div>
					<?php } else if (get_post_meta( get_the_ID(), 'richer_embed', true ) != '') {  
					    if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'vimeo') {  
					        echo '<div id="portfolio-video"><div><iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="470" height="340" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';  
					    	echo '<div class="portfolio-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div><div class="clear"></div>';
					    }  
					    else if (get_post_meta( get_the_ID(), 'richer_source', true ) == 'youtube') {  
					        echo '<div id="portfolio-video"><div><iframe width="470" height="340" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'richer_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe></div></div>';  
					    	echo '<div class="portfolio-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div><div class="clear"></div>';
					    }  
					    else {  
					        echo '<div id="portfolio-video"><div>'.get_post_meta( get_the_ID(), 'richer_embed', true ).'</div></div>';
					    	echo '<div class="portfolio-title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></div><div class="clear"></div>';
					    }  
					} else { 
						$no_img = wp_get_attachment_image_src( 1300, 'span4', true );
						$no_img_src = $no_img[0];
						echo '<div class="portfolio-pic">';
						echo '<div class="portfolio-overlay">'.overlay_link($gallery_id).'</div>';
						echo '<img src="'.$no_img_src.'" /></div>';
					  	echo '<div class="portfolio-title">';
					  	echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a>';	
					  	echo '</div>';
				 } ?>
		      </div></li>
		   <?php endwhile; wp_reset_postdata(); ?>			
			</ul>
		</div> <!-- end of portfolio-related-posts -->
	</div>
</section>
<?php } ?>
