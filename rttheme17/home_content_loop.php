<?php
/* 
* rt-theme home page content loop
*/

global $home_page,$which_theme,$row,$layout_values,$layout,$firstBox,$lastBox,$reset,$this_column_width_pixel,$item_width,$box_border,$layout_values,$content_width,$container_border;
 
	
		//keep posts
		$keep = new WP_Query($home_page); 
 
		$count_home_boxes=1;
		
		#
		#	Reset counter for all content listing option
		#
		$reset_counter = ($item_width) ? 1 : false;			


		#
		#	this column width	- pixel - for all content listing option
		#
		$this_column_width_pixel =  ($item_width!=1) ? intval ($this_column_width_pixel/$item_width) : $this_column_width_pixel;


		if ($keep -> have_posts() ) : while ( $keep -> have_posts() ) : $keep -> the_post();
		
		#
		#	Values 
		#
		
		$box_title				=	get_the_title();
		$box_sub_title			=	get_post_meta($keep->post->ID, THEMESLUG.'sub_title', true);
		$custom_link 			= 	get_post_meta($keep->post->ID, THEMESLUG.'custom_link', true);
		$custom_link_text 		= 	get_post_meta($keep->post->ID, THEMESLUG.'custom_link_text', true);
		$custom_link_target 	=   get_post_meta($keep->post->ID, THEMESLUG.'custom_link_target', true) ? get_post_meta($keep->post->ID, THEMESLUG.'custom_link_target', true) : "_self";		
		$image 					=	get_post_thumbnail_id();
		$crop					=	get_post_meta($keep->post->ID, THEMESLUG.'homepage_image_crop', true);
		$custom_image_height	=	get_post_meta($keep->post->ID, THEMESLUG.'homepage_image_height', true);
		$featured_image_position	=	@get_post_meta($keep->post->ID, THEMESLUG.'featured_image_position', true);
		$heading_and_text_position	= @get_post_meta($keep->post->ID, THEMESLUG.'heading_and_text_position', true);
		$hide_the_heading		=	@get_post_meta($keep->post->ID, THEMESLUG.'hide_the_heading', true);

		
		
		#
 		#	Layout names
 		# 		
		$layout_names	= array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one");			 
			
		#
		#	Thumbnail dimensions
		#
		/*
		$w = intval ($this_column_width_pixel-40);
		$h = intval ($this_column_width_pixel/2);
		*/

		$w = ($item_width == 1) ? 940 : (($item_width == 2) ? 440 : 420);
		$h = intval($w * 0.6);

		#
		#	Crop
		#
		if($crop) $h=intval($custom_image_height); else $h=10000;
		
		#
		#	Resize Image
		#
		if($image) $image_thumb = vt_resize( $image, '', $w, $h, $crop );
		 

		#
		#	Box border
		#
		$addClass2 = ($box_border) ? "" : "" ;

		// fixed row holder			
		if($reset_counter ==1) echo '<div class="fixed-row">';	

		#
		#	Box Size
		#
		$layout 	= ($item_width) ? $layout_names[$item_width] : $layout;
		$firstBox = ($reset_counter == 1) ? "first" : false;
		$lastBox 	= ($reset_counter == $item_width) ? "last" : false;  
		?>

		<!-- box -->
		<div class="template_builder box home-content-box box-shadow <?php echo $layout;?> <?php echo $firstBox .' '. $lastBox  .' '. $addClass2;?>" id="post-<?php echo $keep->post->ID;?>">

				<?php
				//featured image alignments
				$thePositionClass = ($featured_image_position) ? explode("-",$featured_image_position): "";
				$thePositionClass = $thePositionClass ? "align".$thePositionClass[1] : "";
				?>				

				<?php if($image && ($featured_image_position=="before-center" || $featured_image_position=="before-left" || $featured_image_position=="before-right") ):?>
					<?php if ($custom_link) echo  "<a href=\"". $custom_link ."\" target=\"".$custom_link_target."\" title=\"". $box_title ."\" >"; ?>
						<!-- featured image -->
						<img src="<?php echo @$image_thumb["url"];?>" class="featured <?php echo $thePositionClass;?>" alt="<?php echo $box_title;?>" />
						<?php if($thePositionClass=="aligncenter" || $thePositionClass==""):?><div class="space margin-b10"></div><?php endif;?>
					<?php if ($custom_link) echo  "</a>"; ?>
				<?php endif;?>


				<?php if($box_title && !$hide_the_heading):?> 
				<!-- box title-->
				<h3 <?php if ($heading_and_text_position=="center") echo 'class="aligncenter"'; ?>><?php if($custom_link):?><a href="<?php echo $custom_link;?>" target="<?php echo $custom_link_target;?>" title="<?php echo $box_title;?>"><?php endif;?><?php echo $box_title;?><?php if($custom_link):?></a><?php endif;?></h3>
				<?php endif;?> 
				
				<?php if($box_title || $box_sub_title):?>
				<?php if($thePositionClass=="aligncenter" || $thePositionClass==""):?><div class="space margin-b10"></div><?php endif;?>
				<?php endif;?>

				<?php if($image && ($featured_image_position=="after-center" || $featured_image_position=="after-left" || $featured_image_position=="after-right" || $featured_image_position=="") ):?>
					<?php if ($custom_link) echo  "<a href=\"". $custom_link ."\" target=\"".$custom_link_target."\" title=\"". $box_title ."\" >"; ?>
						<!-- featured image -->
						<img src="<?php echo @$image_thumb["url"];?>" class="featured <?php echo $thePositionClass;?>" alt="<?php echo $box_title;?>" />
						<?php if($thePositionClass=="aligncenter" || $thePositionClass==""):?><div class="space margin-b10"></div><?php endif;?>
					<?php if ($custom_link) echo  "</a>"; ?>
				<?php endif;?>


				<?php
				if ($custom_link && $custom_link_text):
					$read_more =  "<a href=\"". $custom_link ."\" target=\"".$custom_link_target."\" title=\"". $box_title ."\" class=\"read_more\">". $custom_link_text ." →</a>";
				else:
					$read_more ="";
				endif;
				?>
			
				<!-- text-->
				<?php
				$theContent = apply_filters('the_content',(get_the_content().$read_more));
				$theContent = ($heading_and_text_position=="center") ? str_replace("<p","<p class=\"aligncenter\"",$theContent ): $theContent;
				echo $theContent;
				?>
				
		</div>
		<!-- /box -->
    
		<?php
		#
		#	Reset columns - for all content listing option
		#
		$post_count = $keep->post_count; 
		$margin  = 30 ; 
		//end fixed rows
		if (($reset_counter && $item_width==$reset_counter) || $count_home_boxes == $post_count) echo '</div>';		


		if ($reset_counter && $item_width==$reset_counter && $count_home_boxes != $post_count):
			echo '<div class="clear"></div><div class="space margin-b'.$margin.'"></div>';
			$reset_counter=1;
		else:
			$reset_counter++;
		endif;
		
		$count_home_boxes ++;
		?>		
    
		<?php endwhile;endif;?>
            
<?php
$keep = "";
wp_reset_query();?> 