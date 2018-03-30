<?php
/*
* @KingSize 2012 - 2014 V5
** Add Gallery ShortCodes **
*/
######################   Gallery ShortCodes ######################  
// [img_gallery id="1" type="colorbox" layout="grid" orderby="random/custom_id/asc_order" order="ASC/DESC"  description="Some text here..." placement="above"]
function gallery_shortcodes( $atts, $content = null ) {
   
    global $data;
	extract(shortcode_atts(array(
		'id' => false,
        'type'	  => false,
		'layout'  => false,
		'orderby'	  => false,
		'order'	  => false,
		'description' => false,
		'placement'	=> false,
		'crop' => "center"
    ), $atts));

		
	// variable setup	
	$post_id = ($id) ? $id  : '';
	$gallery_type = ($type) ? $type  : 'prettyphoto';
	$layout = ($layout) ? $layout  : 2;
	$order = ($order) ? $order  : 'ASC';
	$orderby = ($orderby) ? $orderby  : 'custom_id';
	$description = ($description) ? $description  : '';
	$placement = ($placement) ? $placement  : 'above';
	$crop = ($crop) ? $crop  : 'center';
	
	//croping 
	$crop = strtolower($crop);
	$crop = trim($crop);

	
	//croping image location
	if($crop == "top")
	   $str_crop = "Align top";
	elseif($crop == "top right")
	   $str_crop = "Align top right";
	elseif($crop == "top left")
	   $str_crop = "Align top left";
	elseif($crop == "bottom")
	   $str_crop = "Align bottom";
	elseif($crop == "bottom right")
	   $str_crop = "Align bottom right";
	elseif($crop == "bottom left")
	   $str_crop = "Align bottom left";
	elseif($crop == "left")
	   $str_crop = "Align left";
	elseif($crop == "right")
	   $str_crop = "Align right";
	else
	   $str_crop = "center";
	//////////// end crop location ////////

	//order by
	if($orderby == 'random')
		$orderby = 'rand';
	elseif($orderby == 'menu_order' || $orderby == 'custom_id')
		$orderby = 'menu_order ID';
	elseif($orderby == 'asc_order')
		$orderby = 'date';
	elseif($orderby == 'title')
		$orderby = 'title';
	else
		$orderby = 'menu_order ID';
	

	//if no post id defined return blank
	if($post_id == '')
		return false;
	
	if($layout == "grid")
		$no_of_page_columns = "grid";
	elseif($layout == "2")
		$no_of_page_columns = "2columns";
	elseif($layout == "3")
		$no_of_page_columns = "3columns";
	elseif($layout == "4")
		$no_of_page_columns = "4columns";


	// Add Gallery type JS and CSS
	global $tpl_body_id;
	if($tpl_body_id != "blog_overview") ##fix the blog overview page error.
		$tpl_body_id = $gallery_type;
	
	
	// Apply Gallery Type
	if($gallery_type=="colorbox")
		$relative_gal = 'rel="gallery-'.$post_id.'"';
	elseif($gallery_type=="prettyphoto")
		$relative_gal = 'rel="prettyPhoto[gallery-'.$post_id.']"';
	elseif($gallery_type=="fancybox")
		$relative_gal = 'rel="gallery-'.$post_id.'"';


//<!-- Gallery start here -->
##### Enable/Disabled Gallery Title #####
	$showTitle =  false;
if($gallery_type == "colorbox" && $data["wm_gallery_titles_colorbox"] == "Enable Colorbox Titles")
	$showTitle =  true;	
elseif($gallery_type == "fancybox" && $data["wm_gallery_titles_fancybox"] == "Enable Fancybox Titles")
	$showTitle =  true;	
elseif($gallery_type == "prettyphoto" && $data["wm_gallery_titles_prettyphoto"] == "Enable PrettyPhoto Titles")
	$showTitle =  true;	
elseif($gallery_type == "galleria" && $data["wm_gallery_titles_galleria"] == "Enable Galleria Titles")
	$showTitle =  true;	
##### END Enable/Disabled Gallery Title #####

#### getting the page Gallery attachments images ####
$args = array('post_type' => 'attachment', 'post_parent' => $post_id,  'orderby' => $orderby, 'order' => $order); 
$attachments = get_children($args); 

ob_start();
  
if($description && $placement=="above")
 	echo '<p>'.$description.'</p>';

$url_post_img = "";		
if($gallery_type == "colorbox" || $gallery_type == "prettyphoto" || $gallery_type == "fancybox") :


?>

<div class="row gallery-space pV0H10">
	<?php 
		if ($attachments) { 
			foreach ($attachments as $attachment) { 
				
				########### FIXING # OF COLUMN AND IMAGE URL ###########
				if($no_of_page_columns=="2columns"){
					$url_post_img = wm_image_resize('400','250', wp_get_attachment_url($attachment->ID),$str_crop);
					$div_layout = "six columns mobile-three";
				}
				elseif($no_of_page_columns=="3columns"){
					$url_post_img = wm_image_resize('400','250', wp_get_attachment_url($attachment->ID),$str_crop);
					$div_layout = "four columns mobile-four";
				}
				elseif($no_of_page_columns=="4columns"){
					$url_post_img = wm_image_resize('400','250', wp_get_attachment_url($attachment->ID),$str_crop);
					$div_layout = "three columns mobile-one";
				}
				elseif($no_of_page_columns=="grid"){
					$url_post_img = wm_image_resize('500','500', wp_get_attachment_url($attachment->ID),$str_crop);
					$div_layout = "six_col columns grid_columns mobile-one";
				}

				########### POST Title ###########
				if($gallery_type == "prettyphoto" && !empty($attachment->post_content))
					$post_title = "<p>".strip_tags($attachment->post_content)."</p>";
				elseif(!empty($attachment->post_content))
					$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
				else
					$post_title = $attachment->post_title;

				########### POST ALT ########
				if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
					$post_alt = $attachment->post_title;
				else
					$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
				
				########### Gallery Column CLASS ###########
				if($gallery_type=="colorbox"){

				  $class_gal = 'gallery_'.$layout;
				  
				  if($layout!='grid') 
					$class_gal .= "col";
				}
				elseif($gallery_type=="prettyphoto"){

				  $class_gal = 'gallery_'.$layout;
				  
				  if($layout!='grid') 
					$class_gal .= "col";

					if($layout=='grid') 
						$relative_gal = 'rel="prettyPhoto[gallery'.$layout.']"';
					else
						$relative_gal = 'rel="prettyPhoto[gallery'.$layout.'col]"';
				}
				elseif($gallery_type=="fancybox"){
					
				  $class_gal = 'fancybox gallery_'.$layout;
				  
				  if($layout!='grid') 
					$class_gal .= "col";

					if($layout=='grid') 
						$relative_gal = 'data-fancybox-group="gallery_'.$layout.'"';
					else
						$relative_gal = 'data-fancybox-group="gallery_'.$layout.'col"';
				}
		?>
			<div class="<?php echo $div_layout;?> space-bottom mobile-fullwidth">
				<div class="row">
					<div class="twelve columns pV0H5 gallery_<?php echo $gallery_type;?>">
						<a class="<?php echo $class_gal?> image" <?php echo $relative_gal;?>  href="<?php echo wp_get_attachment_url($attachment->ID);?>" title="<?php  if($showTitle == true) echo $post_title; ?>">
					<?php
					if($data["wm_lazyloader_option"] == "Enable Lazyloader") :
					?>
						<img  class="lazy" data-original="<?php echo $url_post_img;?>" src="<?php echo get_template_directory_uri();?>/images/loading.gif" alt="<?php  if($showTitle == true) echo $post_alt;  ?>" title="<?php  if($showTitle == true) echo $attachment->post_title;  ?>"/>
					<?php
					else :
					 ?>
						<img src="<?php echo $url_post_img;?>" alt="<?php  if($showTitle == true) echo $post_alt;  ?>" title="<?php  if($showTitle == true) echo $attachment->post_title;  ?>"/>
					<?php
					endif;
					?>
						</a>
					</div>
				</div>
			</div>                 
				
	<?php
		   }
		}
	?>	

</div>            

<?php elseif ($gallery_type == "galleria"): ?>
<!-- Galleria - place you images here -->
	<div class="row">
       <div id="galleria">	
		<?php 
			//getting the page Gallery attachments images
			if ($attachments) { 
				foreach ($attachments as $attachment) { 				
					
					$url_post_img = wm_image_resize('680','450', wp_get_attachment_url($attachment->ID),$str_crop);
					$url_post_img_thumb = wm_image_resize('100','50', wp_get_attachment_url($attachment->ID),$str_crop);
					
					
				if(!empty($attachment->post_content))
					$post_title = $attachment->post_title."<p>".strip_tags($attachment->post_content)."</p>";
				elseif(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
					$post_title = $attachment->post_title;
				else
					$post_title = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
					
				if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
					$post_alt = $attachment->post_title;
				else
					$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

				if($showTitle == true) {	
					echo '<a href="'.$url_post_img.'">';
						echo '<img title="'.$post_title.'" data-title="'.$post_title.'"  src="'.$url_post_img_thumb.'"  data-big="'.wp_get_attachment_url($attachment->ID).'"
							   data-description=""  />';
					echo '</a>';
				}
				else{
					echo '<a href="'.$url_post_img.'">';
						echo '<img title="'.$post_title.'" data-title="'.$post_title.'"  src="'.$url_post_img_thumb.'"  data-big="'.wp_get_attachment_url($attachment->ID).'"
							   data-description=""  />';
					echo '</a>';
				}
		
			   }
			}
		?>	
	 </div>	
  </div>	
<!-- Galleria ends here -->

<?php elseif ($gallery_type == "slideviewer"): ?>

<!-- slideviewer - place you images here -->
	 <div class="row">
	 <!-- slideviewer - place you images here -->
       <div id="gallerySlideviewer">	
	    <ul class="rslides" id="slider">
			<?php 
				if ($attachments) { 
					foreach ($attachments as $attachment) { 										
						$url_post_img = wm_image_resize('680','450', wp_get_attachment_url($attachment->ID),$str_crop);
						$post_title = $attachment->post_title;
								
						if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
							$post_alt = $attachment->post_title;
						else
							$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
							
				
						if($showTitle == true) {
							echo '<li><img alt="'.$post_alt.'" title="'.$post_title.'" src="'.$url_post_img.'" /></li>'; 
						}else{
							echo '<li><img alt="'.$post_alt.'" title="" src="'.$url_post_img.'" /></li>'; 
						}
			
				   }
				}
			?>	
			</ul>
		</div>
		<!-- slideviewer ends here -->
	</div>
<!-- slideviewer ends here -->

<!--Orbit Slider Start-->
<?php elseif ($gallery_type == "orbit"): ?>
  <div id="featured">
	  <?php
	  if ($attachments) { 
		 foreach ($attachments as $attachment) { 
			 
			$url_post_img = wm_image_resize('680','450', wp_get_attachment_url($attachment->ID),$str_crop);
			$post_title = $attachment->post_title;
					
			if(get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) == "")
				$post_alt = $attachment->post_title;
			else
				$post_alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
	  ?>
	  <img  src="<?php echo $url_post_img;?>"  title="<?php if($showTitle == true) echo $post_title;?>" alt="<?php if($showTitle == true) echo $post_alt;?>"/>
	  <?php
	   }
	}
	?>
	</div>
<!--Ends Orbit Slider Start-->

<?php
endif;
//<!-- Gallery ends here -->

if($description && $placement=="below")
	echo '<p>'.$description.'</p>';

$output = ob_get_contents();
ob_end_clean();
return $output;
}	

add_shortcode('img_gallery', 'gallery_shortcodes');
###################### End Gallery ShortCodes  #####################  
?>
