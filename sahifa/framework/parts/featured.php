<?php
	global $post, $get_meta;
	$original_post = $post;	

	$size = 'slider';
	$featured_query = $args = $fea_tags = $theTagId = $sep = $featured_posts_query = '';
	$featured_posts_number  = 5;
	
	$featured_posts_number 	= $get_meta[ 'featured_posts_number' ][0];
	$featured_posts_query  	= $get_meta[ 'featured_posts_query'  ][0];
	$fea_speed 				= $get_meta[ 'featured_posts_speed' ][0];
	$fea_time 				= $get_meta[ 'featured_posts_time' ][0];
	
	if( !$fea_speed || $fea_speed == ' ' || !is_numeric($fea_speed))	$fea_speed = 7000 ;
	if( !$fea_time  || $fea_time == ' ' || !is_numeric($fea_time))	$fea_time = 600;

	if( $featured_posts_query == 'custom' ){
		$custom_featured_posts_id = $get_meta[ 'featured_posts_custom' ][0];
				
		$get_custom_slider = get_post_custom( $custom_featured_posts_id );
		$fea_custom_slider = unserialize( $get_custom_slider["custom_slider"][0] );
		$featured_posts_number = count($fea_custom_slider);
	}else{
		if( $featured_posts_query  == 'tag' && !empty( $get_meta['featured_posts_tag'][0] ) ){
			$tags = explode (' , ' , $get_meta['featured_posts_tag'][0] );
			foreach ($tags as $tag){
				$theTagId = get_term_by( 'name', $tag, 'post_tag' );
				if( !empty($fea_tags) ) $sep = ' , ';
				$fea_tags .=  $sep . $theTagId->slug;
			}
			$args= array('posts_per_page'=> $featured_posts_number , 'tag' => $fea_tags, 'no_found_rows' => 1 );
		}
		elseif( $featured_posts_query  == 'category'){
		
			if( !empty( $get_meta['featured_posts_cat'][0] ) && is_serialized( $get_meta['featured_posts_cat'][0] ) )
				$cats = unserialize ( $get_meta['featured_posts_cat'][0] );
				
			$args= array('posts_per_page'=> $featured_posts_number , 'category__in' => $cats, 'no_found_rows' => 1 );
		}
		elseif( $featured_posts_query  == 'post'){
			$posts_var = explode (',' , $get_meta['featured_posts_posts'][0]);
			$args= array('posts_per_page'=> $featured_posts_number , 'post_type' => 'post', 'post__in' => $posts_var, 'no_found_rows' => 1 );
		}
		elseif( $featured_posts_query  == 'page'){
			$pages_var = explode (',' , $get_meta['featured_posts_pages'][0]);
			$args= array('posts_per_page'=> $featured_posts_number , 'post_type' => 'page', 'post__in' => $pages_var, 'no_found_rows' => 1 );
		}
	
		$featured_query = new wp_query( $args );
	}
	
if( $featured_posts_query != 'custom' ): ?>		
	<?php if( $featured_query->have_posts() ) : ?>
	<div id="featured-posts"<?php if( $featured_posts_number <= 5 ) echo ' class="featured-posts-disable-nav"'; ?>>
	<?php $i = $j= 0;
		while ( $featured_query->have_posts() ) : $featured_query->the_post(); $i++; $j++; ?>
		<div class="featured-post featured-post-<?php echo $i; ?> fea-<?php echo $j; ?>">
			<div class="featured-post-inner" style="background-image:url(<?php echo tie_thumb_src( $size ); ?>);">	
				<div class="featured-cover"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></div>
				<div class="featured-title">
					<?php tie_get_time() ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<h3><?php echo tie_content_limit( get_the_excerpt() , 100 ) ?></h3>
				</div>
			</div>
		</div>
		<?php if( $i == 5) $i=0;
		endwhile;?>
	</div>
	<div class="clear"></div>
	<?php endif; ?>
<?php else: ?>
					
	<div id="featured-posts" class="">
		<?php $i = $j= 0;
		if( $fea_custom_slider ){
		foreach( $fea_custom_slider as $slide ): $i++ ; $j++;?>	
			<div class="featured-post featured-post-<?php echo $i; ?> fea-<?php echo $j; ?>">
				<div class="featured-post-inner" style="background-image:url(<?php echo tie_slider_img_src( $slide['id'] , $size ) ?>);">
					<div class="featured-cover"><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"></a><?php endif; ?></div>
					<?php if( !empty( $slide['title'] ) || !empty( $slide['caption'] ) ) :?>
					<div class="featured-title">
						<?php if( !empty( $slide['title'] ) ):?>
						<h2><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
							<?php  echo stripslashes( $slide['title'] )  ?>
							<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
						</h2>
						<?php endif; ?>
						<?php if( !empty( $slide['caption'] ) ):?><h3><?php echo stripslashes($slide['caption']) ; ?></h3><?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php if( $i == 5) $i=0;
		endforeach;?>		
	<?php
		}?>
	</div>
	<div class="clear"></div>
	
<?php endif; ?>
<script>
jQuery(document).ready(function() {
	var featuredItems = jQuery("#featured-posts .featured-post");
		for(var i = 0; i < featuredItems.length; i+=5) {
			featuredItems.slice(i, i+5).wrapAll('<div class="featured-posts-single-slide"></div>');
	}
  jQuery('#featured-posts').flexslider({
    animation: "fade",
	selector: ".featured-posts-single-slide", 
	slideshowSpeed: <?php echo $fea_speed ?>,
	animationSpeed: <?php echo $fea_time ?>,
	randomize: false,
	pauseOnHover: true,
	prevText: "",
	nextText: "",
	slideshow: <?php if( $get_meta[ 'featured_auto' ][0] ) echo 'true'; else echo 'false'; ?> ,
	controlNav: false, 
  });
});
</script>
<?php
	$post = $original_post;
	wp_reset_query();
?>
