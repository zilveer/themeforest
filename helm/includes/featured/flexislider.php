<section>
	<div class="spaced-wrap clearfix">
		<div class="flexslider-container clearfix">
			<div class="flexslider-loader">
				<div class="flexslider">
				<ul class="slides">
					<?php
					$captioncodes="";
					$count=0;
					query_posts( array( 'post_type' => 'mtheme_featured', 'showposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC') );
					?>
					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
					
					<?php
					$image_id = get_post_thumbnail_id(($post->ID), 'full'); 
					$image_url = wp_get_attachment_image_src($image_id,'full');  
					$image_url = $image_url[0];
					
					$custom = get_post_custom(get_the_ID());
					$featured_description="";
					$featured_link="";
					
					if ( isset($custom["featured_bigtitle"][0]) ) $featured_bigtitle=$custom["featured_bigtitle"][0];
					
					if ( isset($custom["featured_description"][0]) ) { $featured_description=$custom["featured_description"][0]; }
					if ( isset($custom["featured_link"][0]) && $custom["featured_link"][0]<>"" ) { 
						$featured_link=$custom["featured_link"][0];
						} else {
						$featured_link = get_post_permalink();
					}

					//$textblock=$featured_description;
					$title=get_the_title(); 
					$text=$featured_description;
					$permalink = $featured_link;
					$count++;
					?>
					<li>
					<a href="<?php echo $permalink; ?>">
						<img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" />
					</a>
					<?php
					
					$titlecode ='<div class="flex-title"><a href="'.$permalink. '">' .$title . '</a></div>';
					$captioncodes ='<div class="flex-caption">' . $text . '</div>';
					$bigtitle='<div class="flex-bigtitle"><a href="'.$permalink. '">'.$featured_bigtitle.'</a></div>';

					echo '<div class="flex-caption-wrap">';
					echo $titlecode;
					echo $captioncodes;
					echo $bigtitle;
					echo '</div>';

					?>
					</li>
					<?php					
					endwhile; endif; 
					?>
				</ul>
			  </div>
		  </div>
		</div>
	</div>
</section>