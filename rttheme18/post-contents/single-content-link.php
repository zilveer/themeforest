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
				<?php if( $rt_list_style == "style2" ):?><h1 class="icon-link entry-title"><?php else:?><h1 class="entry-title"><?php endif;?><?php the_title('',': '); ?><?php echo '<a href="'.$post_format_link.'"  target="_blank" title="">'.$post_format_link.'</a>'?></h1> 
				<!-- / blog headline--> 
 
				<?php do_action( "post_meta_bar" )?>

			</div><!-- / end div  .post-title-holder -->
			
		</div><!-- / end div  .blog-head-line -->  

	</section> 


	<div class="article_content clearfix entry-content">

		<?php if( ! empty( $thumbnail_image_output )  && $featured_image_single_page ):?>
			<div class="imgeffect align<?php echo $featured_image_position;?>"> 	
					<a href="<?php echo $post_format_link;?>" target="_blank" class="icon-forward single" title="<?php echo __( 'Go to: ', 'rt_theme' ) ."". $post_format_link; ?>"></a>	
					<?php echo $thumbnail_image_output; ?>
			</div>
		<?php endif;?>
 

		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>

		<?php do_action( "post_tag_bar" )?>
		<!-- updated--> 
		<span class="updated hidden"><?php echo the_modified_date();?></span>
	</div> 

</article> 
<!-- / blog box-->