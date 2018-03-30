<?php

global $post, $widget_photos, $gallery_layout, $gallery_height;

$photo_sizes_options = get_iron_option('photo_sizes');
$available_sizes = array();

$i = 0;
foreach($photo_sizes_options as $photo_size) {

	$width = $photo_size["size_width"];
	$height = $photo_size["size_height"];
	
	$available_sizes[$i]["width"] = $width;
	$available_sizes[$i]["height"] = $height;
	
	$i++;
}

if(!empty($widget_photos)) {
	$photos = $widget_photos;
}else{
	$photos = get_field('album_photos', $post->ID);
}

if(!empty($photos)):
?>

	<div class="photogrid-wrap free-wall" data-layout="<?php echo esc_attr($gallery_layout);?>" data-height="<?php echo esc_attr($gallery_height);?>">
	<?php 
		foreach($photos as $photo) {
		

			$title = $photo["photo_title"];
			if(empty($title)) {
				$title = $photo["photo_file"]["title"];
			}
			
			$full_image = $photo["photo_file"]["url"];
			$image = $photo["photo_file"]["sizes"]["large"];

			$photo_size = $photo["photo_size"];
	
			if($photo_size == 'random') {
				
				$size = $available_sizes[rand(0, count($available_sizes) - 1)];
				$width = $size["width"];
				$height = $size["height"];
				
			}else{
				
				$photo_size = str_replace("size_", "", $photo_size);
				$photo_size = $photo_sizes_options[$photo_size];
				$width = $photo_size["size_width"];
				$height = $photo_size["size_height"];
			}
	
			echo '<a class="brick lightbox" rel="lightbox" title="'.esc_attr($title).'" href="'.esc_url($full_image).'" style="display:block;background-image:url('.esc_attr($image).'); background-position:'.$photo["photo_position"].'; background-repeat: no-repeat; background-size: cover; width:'.esc_attr($width).'px; height: '.esc_attr($height).'px"><div class="imgoverlay"></div></a>';
		}
	?>
	</div>

<?php endif; ?>