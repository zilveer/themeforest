<?php
# 
# rt-theme
# post content for standart post types in listing pages
# 
global $rt_list_style, $more, $rt_global_post_values;

//extract global values 
extract( $rt_global_post_values );

// Create thumbnail image
if( $featured_image_single_page ){
	if( ! $featured_image_same_single_page ){
		$featured_image_width = $max_image_width;
		$featured_image_height = 10000;	
		$crop = false;
		$featured_image_position = "center";	
	}

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
<article class="blog_list single" id="post-<?php the_ID(); ?>">

	<?php if( $rt_list_style == "style1" ):?>
	<section class="first_section">     
		<div class="date_box"><span class="day"><?php the_time("d") ?></span><span class="year"><?php the_time("M") ?> <?php the_time("Y") ?></span></div>
	</section> 
	<?php endif;?>


	<section class="article_info article_section <?php if( $rt_list_style != "style1" ):?>with_icon<?php endif;?>">
		
		<div class="blog-head-line clearfix">    

			<div class="post-title-holder">

				<!-- blog headline-->
				<?php if( $rt_list_style == "style2" ):?><h1 class="icon-videocam entry-title"><?php else:?><h1 class="entry-title"><?php endif;?><?php the_title(); ?></h1> 
				<!-- / blog headline--> 
 
				<?php do_action( "post_meta_bar" )?>

			</div><!-- / end div  .post-title-holder -->
			
		</div><!-- / end div  .blog-head-line -->  

	</section> 


	<div class="article_content clearfix entry-content">

		<?php
		if( ! empty( $thumbnail_image_output ) && $featured_image_single_page ):?>
			<!-- image -->
			<div class="imgeffect align<?php echo $featured_image_position;?>"> 
					<?php 
						//create lightbox link
						do_action("create_lightbox_link",
							array(
								'class'          => 'icon-right-dir lightbox_ single',
								'href'           => $video_mp4 ? $video_mp4 : $external_video,
								'title'          => __('Play Video','rt_theme'),
								'data_group'     => 'image_'.$featured_image_id,
								'data_title'     => $title,													
								'data_thumbnail' => $lightbox_thumbnail,
							)
						);
					?> 

					<?php echo $thumbnail_image_output; ?>
			</div>
		<?php endif;?>
 


		<?php 
		//display the video
		if( $external_video || $video_mp4 ){
			
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


		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

		<?php do_action( "post_tag_bar" )?>
		<!-- updated--> 
		<span class="updated hidden"><?php echo the_modified_date();?></span>

	</div> 

</article> 
<!-- / blog box-->