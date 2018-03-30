<?php
global $get_meta, $post;
$original_post = $post;

if( empty( $get_meta['tie_post_head'][0] ) || ( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] != 'none' ) ):

	//Get Post Video
	if( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] == 'video' ){ ?>
		<div class="single-post-video">
			<?php tie_video(); ?>
		</div>
	<?php
	}elseif( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] == 'audio' ){
		if( !empty( $get_meta["tie_audio_mp3"][0] ) || !empty( $get_meta["tie_audio_m4a"][0] ) || !empty( $get_meta["tie_audio_oga"][0] ) ){
			if( $get_meta["tie_sidebar_pos"][0] == 'full' || !empty( $get_meta["tie_post_head_cover"][0] ) ){
				$size = 'big-slider';
			}else{
				$size = 'slider';
			}

			$style = '';
			if ( !has_post_thumbnail($post->ID) ) $style =' style="bottom:0;"'; ?>
			<div class="single-post-audio single-post-thumb">
				<?php the_post_thumbnail( $size ); ?>
				<div class="single-audio"<?php echo $style ?>><?php tie_audio(); ?></div>
			</div>
	<?php
		}
	}elseif( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] == 'soundcloud' ){
		if( !empty( $get_meta["tie_audio_soundcloud"][0] ) ){
			$play = $visual = 'false';
			if( !empty( $get_meta["tie_audio_soundcloud_play"][0] )) $play = 'true';
			if( !empty( $get_meta["tie_audio_soundcloud_visual"][0] )) $visual = 'true';
			echo tie_soundcloud($get_meta["tie_audio_soundcloud"][0] , $play, $visual );?>
	<?php
		}
	}elseif( ( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] == 'thumb' ) || ( empty( $get_meta['tie_post_head'][0] ) && tie_get_option( 'post_featured' ) ) ){
		if( (  !empty( $get_meta['tie_sidebar_pos'][0] ) && $get_meta["tie_sidebar_pos"][0] == 'full' ) || !empty( $get_meta["tie_post_head_cover"][0] ) ){
			$size = 'big-slider';
		}else{
			$size = 'slider';
		}
	?>

	<?php if( !empty( $get_meta["tie_post_head_cover"][0] ) ) : ?>
		<div class="single-post-thumb<?php if( has_post_thumbnail() ){ ?> single-has-thumb<?php } ?>"<?php if( has_post_thumbnail() ){ ?> style="background-image:url( <?php echo tie_thumb_src( 'full' ); ?>);"<?php } ?>>
			<div class="post-cover-title">
			<?php tie_breadcrumbs() ?>
			<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php the_title(); ?></span></h1>
			<?php
				if( is_single() ){
					get_template_part( 'framework/parts/meta-post' );
				}
			?>
			</div>

			<a href="#the-post" class="go-to-the-post"><i class="fa fa-angle-down"></i></a>

		</div>
		<script>
			jQuery(window).scroll(function(){
				var scrolled = jQuery(window).scrollTop();
				 jQuery('.post-cover-title').css({ opacity : 1-(scrolled/1000) });
				 jQuery('.post-cover-head .single-post-thumb').css('background-position', 'center '+ -(scrolled*0.3)+'px');
			});
		</script>
	<?php else: ?>
		<div class="single-post-thumb">
			<?php the_post_thumbnail( $size ); ?>
		</div>
	<?php endif; ?>

		<?php $thumb_caption = get_post(get_post_thumbnail_id())->post_excerpt;
			if( !empty($thumb_caption) ){ ?><div class="single-post-caption"><?php echo $thumb_caption ?></div> <?php } ?>


<?php }elseif( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] == 'lightbox' && has_post_thumbnail($post->ID)){

		$image_id = get_post_thumbnail_id($post->ID);
		$image_url = wp_get_attachment_image_src($image_id,'large');
		$image_url = $image_url[0];

		if( $get_meta["tie_sidebar_pos"][0] == 'full' || !empty( $get_meta["tie_post_head_cover"][0] ) ){
			$size = 'big-slider';
		}else{
			$size = 'slider';
		} ?>
		<div class="single-post-thumb head-lightbox">
			<a href="<?php echo $image_url; ?>" class="lightbox-enabled"><?php the_post_thumbnail( $size ); ?></a>
		</div>
		<?php $thumb_caption = get_post(get_post_thumbnail_id())->post_excerpt;
			if( !empty($thumb_caption) ){ ?><div class="single-post-caption"><?php echo $thumb_caption ?></div> <?php } ?>

<?php } elseif( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] == 'map' && !empty( $get_meta['tie_googlemap_url'][0] ) ){
		if( $get_meta["tie_sidebar_pos"][0] == 'full' || !empty( $get_meta["tie_post_head_cover"][0] ) ){
			$width = 1003 ;
			$height = 498 ;
		}else{
			$width = 658;
			$height = 330 ;
		}?>
		<?php echo tie_google_maps( $get_meta['tie_googlemap_url'][0] , $width , $height ); ?>


<?php }elseif( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] == 'slider' && !empty( $get_meta['tie_post_slider'][0] ) ){

	if( $get_meta["tie_sidebar_pos"][0] == 'full' || !empty( $get_meta["tie_post_head_cover"][0] )){
		$size = 'big-slider';
	}else{
		$size = 'slider';
	}

	/*$effect = tie_get_option( 'flexi_slider_effect' );
	$speed = tie_get_option( 'flexi_slider_speed' );
	$time = tie_get_option( 'flexi_slider_time' );

	if( !$speed || $speed == ' ' || !is_numeric($speed))	$speed = 7000 ;
	if( !$time || $time == ' ' || !is_numeric($time))	$time = 600;

	if( $effect == 'slideV' )
			$effect = 'animation: "slide",
					  direction: "vertical",';
	elseif( $effect == 'slideH' )
				$effect = 'animation: "slide",';
	else
		$effect = 'animation: "fade",'; */

		$speed = 7000 ;
		$time = 600;
		$effect = 'animation: "fade",';

		$custom_slider_args = array( 'post_type' => 'tie_slider', 'p' => $get_meta['tie_post_slider'][0], 'no_found_rows' => 1 );
		$custom_slider = new WP_Query( $custom_slider_args );
	?>
	<div class="flexslider" id="flexslider-post">
		<ul class="slides">
		<?php while ( $custom_slider->have_posts() ) : $custom_slider->the_post();
			$custom = get_post_custom($post->ID);
			$slider = unserialize( $custom["custom_slider"][0] );
			$number = count($slider);

			if( $slider ){
			foreach( $slider as $slide ): ?>
			<li>
				<?php if( !empty( $slide['link'] ) ):?><a href="<?php  echo stripslashes( $slide['link'] )  ?>"><?php endif; ?>
				<img src="<?php echo tie_slider_img_src( $slide['id'] , $size ) ?>" alt="" />
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
		<?php endwhile;?>
		</ul>
	</div>
	<script>
	jQuery(window).load(function() {
	  jQuery('#flexslider-post').flexslider({
		<?php echo $effect  ?>
		slideshowSpeed: <?php echo $speed ?>,
		animationSpeed: <?php echo $time ?>,
		randomize: false,
		pauseOnHover: true,
		prevText: "",
		nextText: "",
		after: function(slider) {
			jQuery('.slider-caption').animate({bottom:12,}, 400)
		},
		before: function(slider) {
			jQuery('.slider-caption').animate({ bottom:-105,}, 400)
		},
		start: function(slider) {
			var slide_control_width = 100/<?php echo $number; ?>;
			jQuery('.flex-control-nav li').css('width', slide_control_width+'%');
			jQuery('.slider-caption').animate({ bottom:12,}, 400)
		}
	  });
	});
	</script>
<?php }
	$post = $original_post;
	wp_reset_query();

 endif; ?>
