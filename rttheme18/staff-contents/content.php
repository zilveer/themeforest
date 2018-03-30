<?php
# 
# rt-theme
# loop item for portfolio custom posts
# image post format
#
global $rt_item_width,$rt_sidebar_location; 


$short_data = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_short_data', true); 		
$long_data = get_the_content();
$permalink = ! empty( $long_data ) ? get_permalink() : "" ;
?>

<div class="half-background">
<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
<div class="person_image">
	<?php
	// Create thumbnail image
	$thumbnail_image_output = get_resized_image_output( array( "image_url" => "", "image_id" => get_post_thumbnail_id(), "w" => rt_get_min_resize_size( $rt_item_width ), "h" => 100000, "crop" => "" ) ); 	
	echo $thumbnail_image_output;
	?>
</div>
<?php endif;?>

<div class="person_name">
	
	<?php if( $permalink ) : ?>
		<h4><a href="<?php echo $permalink;?>"><?php the_title();?></a></h4>
	<?php else:?>
		<h4><?php the_title();?></h4>
	<?php endif;?>
</div>

<hr class="style-one">

<div class="profile">
	<?php echo $short_data; ?>
</div>
	
	<?php echo rt_staff_media_links(get_the_ID());?>
</div>