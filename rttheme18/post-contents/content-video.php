<?php
# 
# rt-theme
# post content for standart post types in listing pages
# 
global $rt_list_style, $more, $rt_global_post_values;


//extract global values 
extract( $rt_global_post_values );

if( $video_usage_listing == "only_featured_image" ){
	// Create thumbnail image
	$thumbnail_image_output = ! empty( $featured_image_id ) ? get_resized_image_output( array( "image_url" => "", "image_id" => $featured_image_id, "w" => $featured_image_width, "h" => $featured_image_height, "crop" => $crop ) ) : ""; 

	// Tiny image thumbnail for lightbox gallery feature
	$lightbox_thumbnail = ! empty( $featured_image_id ) ? rt_vt_resize( $featured_image_id, "", 75, 50, true ) : rt_vt_resize( $featured_image_id, "", 75, 50, true ); 
	$lightbox_thumbnail = is_array( $lightbox_thumbnail ) ? $lightbox_thumbnail["url"] : "" ; 
}else{
	$thumbnail_image_output = "";	
}

?> 
	
<!-- blog box-->
<article class="blog_list loop" id="post-<?php the_ID(); ?>">

	<?php if( $rt_list_style == "style1" ):?>
	<section class="first_section">     
		<div class="date_box"><span class="day"><?php the_time("d") ?></span><span class="year"><?php the_time("M") ?> <?php the_time("Y") ?></span></div>
	</section> 
	<?php endif;?>


	<section class="article_section <?php if( $rt_list_style != "style1" ):?>with_icon<?php endif;?>">
		
		<div class="blog-head-line clearfix">    

			<div class="post-title-holder">

				<!-- blog headline-->
				<?php if( $rt_list_style == "style2" ):?><h2 class="icon-videocam"><?php else:?><h2><?php endif;?><a href="<?php echo $permalink ?>" rel="bookmark"><?php the_title(); ?></a></h2> 
				<!-- / blog headline--> 
 
				<?php do_action( "post_meta_bar" )?>

			</div><!-- / end div  .post-title-holder -->
			
		</div><!-- / end div  .blog-head-line -->  


		<?php
		if( ! empty( $thumbnail_image_output ) && $video_usage_listing == "only_featured_image"  ):?>
			<!-- image -->
			<div class="imgeffect align<?php echo $featured_image_position;?>"> 

					<?php 
						//create lightbox link
						do_action("create_lightbox_link",
							array(
								'class'          => 'icon-right-dir lightbox_',
								'href'           => $video_mp4 ? $video_mp4 : $external_video,
								'title'          => __('Play Video','rt_theme'),
								'data_group'     => 'image_'.$featured_image_id,
								'data_title'     => $title,													
								'data_thumbnail' => $lightbox_thumbnail,
							)
						);
					?> 

					<a href="<?php echo $permalink;?>" class="icon-link" title="<?php echo $title; ?>" rel="bookmark" ></a>	

					<?php echo $thumbnail_image_output; ?>
					
			</div>
		<?php endif;?>


		<?php 
		//display the video
		if( $video_usage_listing == "same" && ( $external_video || $video_mp4 ) ){
						
			//self hosted videos
			if( $video_mp4 ){
				do_action("create_media_output",
					array(
						'id' => 'video-'.get_the_ID(),
						'type' => "video",
						'file_mp4' => $video_mp4,
						'file_webm' => $video_webm,
						'poster'=> $featured_image_url
					)
				);
			}

			//external videos
			if ($external_video){
				 
				if( strpos($external_video, 'youtube')  ) { //youtube
					echo '<div class="video-container"><iframe src="//www.youtube.com/embed/'.rt_find_tube_video_id($external_video).'" allowfullscreen></iframe></div>';
				}
				
				if( strpos($external_video, 'vimeo')  ) { //vimeo
					echo '<div class="video-container"><iframe src="//player.vimeo.com/video/'.rt_find_tube_video_id($external_video).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
				}			
			}

			echo '<div class="space margin-t20"></div>';

		}
		?>

		<?php 
			if( get_option(RT_THEMESLUG."_use_excerpts") ){
				the_excerpt();
			}else{
				the_content( __( 'Continue reading', 'rt_theme' ) );
				wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
			}
		?>

	</section> 

</article> 
<!-- / blog box-->