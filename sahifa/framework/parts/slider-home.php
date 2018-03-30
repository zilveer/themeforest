<?php
	global $get_meta, $post;
	$original_post = $post;

	//Default Values
	$cats = 0 ;
	$featured_query = $args = $theTagId = $slider_tags = $sep = '';

	$size = 'slider' ;
	if( !empty( $get_meta[ 'slider_pos' ][0] ) && $get_meta[ 'slider_pos' ][0] == 'big') {
		$size = 'big-slider' ;
	}
	$number 		= $get_meta[ 'slider_number' ][0];
	$slider_query 	= $get_meta[ 'slider_query'  ][0];
	$caption_length = $get_meta[ 'slider_caption_length' ][0];

	if( empty($caption_length) || $caption_length == ' ' || !is_numeric($caption_length))	$caption_length = 100;

	if( $slider_query == 'custom' ){
		$custom_slider_id = $get_meta[ 'slider_custom' ][0];

		$get_custom_slider = get_post_custom( $custom_slider_id );
		$custom_slider = unserialize( $get_custom_slider["custom_slider"][0] );
		$number = count($custom_slider);
	}else{
		if( $slider_query  == 'tag' && !empty( $get_meta['slider_tag'][0] ) ){
			$tags = explode (' , ' , $get_meta['slider_tag'][0] );
			foreach ($tags as $tag){
				$theTagId = get_term_by( 'name', $tag, 'post_tag' );
				if( !empty($slider_tags) ) $sep = ' , ';
				$slider_tags .=  $sep . $theTagId->slug;
			}
			$args= array('posts_per_page'=> $number , 'tag' => $slider_tags, 'no_found_rows' => 1 );
		}
		elseif( $slider_query == 'category'){

			if( !empty( $get_meta['slider_cat'][0] ) && is_serialized( $get_meta['slider_cat'][0] ) )
				$cats = unserialize ( $get_meta['slider_cat'][0] );

			$args = array('posts_per_page'=> $number , 'category__in' => $cats, 'no_found_rows' => 1 );
		}
		elseif( $slider_query  == 'post'){
			$posts_var = explode (',' , $get_meta['slider_posts'][0] );
			$args= array('posts_per_page'=> $number , 'post_type' => 'post', 'post__in' => $posts_var, 'no_found_rows' => 1 );
		}
		elseif( $slider_query  == 'page'){
			$pages_var = explode (',' , $get_meta['slider_pages'][0]);
			$args= array('posts_per_page'=> $number , 'post_type' => 'page', 'post__in' => $pages_var, 'no_found_rows' => 1 );
		}

		$featured_query = new wp_query( $args );
	}


if( $get_meta['slider_type'][0] == 'elastic' ):

	$effect 	= $get_meta[ 'elastic_slider_effect'  ][0];
	$speed 		= $get_meta[ 'elastic_slider_speed'   ][0];
	$interval 	= $get_meta[ 'elastic_slider_interval'][0];

	if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 800 ;
	if( !$interval || $interval == ' ' || !is_numeric($interval))	$interval = 3000;

	if( $effect == 'sides' ) $effect = 'sides';
	else $effect = 'center';

	if( !empty( $get_meta[ 'elastic_slider_autoplay'][0] ) ) $autoplay = 'true';
	else $autoplay = 'false';
?>

<?php if( $slider_query != 'custom' ): ?>
	<?php if( $featured_query->have_posts() ) : ?>
	<div id="ei-slider" class="ei-slider">
		<ul class="ei-slider-large">
		<?php $i= 0;
			while ( $featured_query->have_posts() ) : $featured_query->the_post(); $i++; ?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $size ); ?></a>
			<?php endif; ?>
				<div class="ei-title">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if ( !empty($get_meta['slider_caption'][0]) ) : ?><h3><?php echo tie_content_limit( get_the_excerpt() , $caption_length ) ?></h3><?php endif; ?>
				</div>
			</li>
		<?php endwhile;?>
		</ul>
		 <ul class="ei-slider-thumbs">
			<li class="ei-slider-element">Current</li>
		<?php $i= 0;
			while ( $featured_query->have_posts() ) : $featured_query->the_post(); $i++; ?>
			<li><a href="#">Slide <?php echo $i; ?></a><?php the_post_thumbnail( 'tie-medium' ); ?></li>
    		<?php endwhile;?>
		</ul><!-- ei-slider-thumbs -->
	</div>
	<?php endif; ?>
<?php else: ?>

	<div id="ei-slider" class="ei-slider">
		<ul class="ei-slider-large">
		<?php $i= 0;
			if( $custom_slider ){
			foreach( $custom_slider as $slide ): ?>
			<li>
			<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo tie_slider_img_src( $slide['id'] , $size ) ?>" width="660" height="330" alt="<?php  echo stripslashes( $slide['title'] )  ?>" />
				<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
				<?php if( !empty( $slide['title'] ) || !empty( $slide['caption'] ) ) :?>
				<div class="ei-title">
					<?php if( !empty( $slide['title'] ) ):?>
					<h2><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
						<?php  echo stripslashes( $slide['title'] )  ?>
						<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
					</h2>
					<?php endif; ?>
					<?php if( !empty( $slide['caption'] ) ):?><h3><?php echo stripslashes($slide['caption']) ; ?></h3><?php endif; ?>
				</div>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>

		</ul>

		 <ul class="ei-slider-thumbs">
			<li class="ei-slider-element">Current</li>
			<?php $i= 0; foreach( $custom_slider as $slide ): $i++; ?>
			<li><a href="#">Slide <?php echo $i; ?></a><img src="<?php echo tie_slider_img_src($slide['id'] , 'tie-medium' ); ?>" width="660" height="330" alt="<?php  echo stripslashes( $slide['title'] )  ?>" /></li>
			<?php endforeach; ?>

		</ul><!-- ei-slider-thumbs -->

	<?php
		}?>
	</div>


<?php endif; ?>

        <script type="text/javascript">
            jQuery(function() {
                jQuery('#ei-slider').eislideshow({
					animation			: '<?php echo $effect ?>',
					autoplay			: <?php echo $autoplay ?>,
					slideshow_interval	: <?php echo $interval ?>,
					speed          		: <?php echo $speed ?>,
					titlesFactor		: 0.60,
					titlespeed          : 1000,
					thumbMaxWidth       : 100
                });
            });
        </script>

	<?php

else:

	$effect = $get_meta[ 'flexi_slider_effect'][0];
	$speed 	= $get_meta[ 'flexi_slider_speed' ][0];
	$time 	= $get_meta[ 'flexi_slider_time'  ][0];

	if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 7000 ;
	if( !$time  || $time  == ' ' || !is_numeric($time) )	$time  = 600;

	if( $effect == 'slideV' )
			$effect = 'animation: "slide",
					  direction: "vertical",';
	elseif( $effect == 'slideH' )
				$effect = 'animation: "slide",';
	else
		$effect = 'animation: "fade",'; ?>


<?php if( $slider_query != 'custom' ): ?>
	<?php if( $featured_query->have_posts() ) : ?>
	<div id="flexslider" class="flexslider">
		<ul class="slides">
		<?php while ( $featured_query->have_posts() ) : $featured_query->the_post()?>
			<li>
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $size ); ?>
				</a>
			<?php endif; ?>
				<div class="slider-caption">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if ( !empty( $get_meta['slider_caption'][0] ) ) : ?><p><?php echo tie_content_limit( get_the_excerpt() , $caption_length ) ?></p><?php endif; ?>
				</div>
			</li>
		<?php endwhile;?>
		</ul>
	</div>
	<?php endif; ?>
<?php else: ?>
	<div class="flexslider" id="flexslider">
		<ul class="slides">
		<?php
			if( $custom_slider ){
			foreach( $custom_slider as $slide ): ?>
			<li>
				<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo tie_slider_img_src( $slide['id'] , $size ) ?>" width="660" height="330" alt="" />
				<?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?>
				<?php if( !empty( $slide['title'] ) || !empty( $slide['caption'] ) ) :?>
				<div class="slider-caption">
					<?php if( !empty( $slide['title'] ) ):?><h2><?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?><?php  echo stripslashes( $slide['title'] )  ?><?php if( !empty( $slide['link'] ) ):?></a><?php endif; ?></h2><?php endif; ?>
					<?php if( !empty( $slide['caption'] ) ):?><p><?php echo stripslashes($slide['caption']) ; ?></p><?php endif; ?>
				</div>
				<?php endif; ?>
			</li>
			<?php endforeach;
			}?>
		</ul>
	</div>
<?php endif; ?>

<script>
jQuery(document).ready(function() {
  jQuery('#flexslider').flexslider({
    <?php echo $effect  ?>
	slideshowSpeed: <?php echo $speed ?>,
	animationSpeed: <?php echo $time ?>,
	randomize: false,
	pauseOnHover: true,
	prevText: "",
	nextText: "",
	after: function(slider) {
		jQuery('#flexslider .slider-caption').animate({bottom:12,}, 400)
	},
	before: function(slider) {
		jQuery('#flexslider .slider-caption').animate({ bottom:-105,}, 400)
	},
	start: function(slider) {
       	var slide_control_width = 100/<?php echo $number; ?>;
    	jQuery('#flexslider .flex-control-nav li').css('width', slide_control_width+'%');
		jQuery('#flexslider .slider-caption').animate({ bottom:12,}, 400)
	}
  });
});
</script>

	<?php
		endif;

		$post = $original_post;
		wp_reset_query();
	?>
