<?php
# 
# rt-theme
# loop item for portfolio custom posts
# image post format
# 

$testimonial = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_testimonial', true); 		
$name = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_name', true); 		
$title = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_title', true); 
$link = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_link', true); 
$link_text = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_link_text', true); 
$add_class = has_post_thumbnail() ? "with_image" : "";
?>

<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
<div class="client_image gradient">
	<?php
	// Create thumbnail image
	$thumbnail_image_output = get_resized_image_output( array( "image_url" => "", "image_id" => get_post_thumbnail_id(), "w" => 400, "h" => 400, "crop" => true ) ); 	
	echo $thumbnail_image_output;
	?>
</div>
<?php endif;?>

<div class="text <?php echo $add_class;?>">
	<p>
		<span class="icon-quote-left"></span>
			<?php echo $testimonial; ?>
		<span class="icon-quote-right"></span>
	</p>
	<div class="client_info">
		<?php echo $name; ?> 
		<?php echo ! empty( $title ) ? '- <span>'. $title. '</span>' : "" ; ?>
		
		<?php echo ! empty( $link ) && ! empty( $link_text ) ? '<a href="'. $link. '" target="_blank" title="'.$link_text.'" class="client_link">'. str_replace( "http://","",$link_text ). '</a>' : "" ; ?>
		<?php echo ! empty( $link ) && empty( $link_text ) ? '<a href="'. $link. '" target="_blank" title="" class="client_link">'. str_replace( "http://","",$link ). '</a>' : "" ; ?>

	</div>
</div>