<?php 
	global $options_data;
	global $blogtype;
	global $wp_query;
	if(isset($wp_query->queried_object->ID)) {$postid=$wp_query->queried_object->ID;} else {$postid='';}
	$gallery_type = get_post_meta($postid, 'richer_gridlayout', true );

	if ($blogtype == 'medium') {
		$image_size = 'standard';
	}
	if ($blogtype == 'large') {
		$image_size = 'span12';
	}
	if($options_data['select_blogsidebar'] != 'none' && $options_data['select_blogsidebar'] != ''){
		$sidebar_pos = $options_data['select_blogsidebar'].' span9';
		$image_gallery_size = 'span4 grid-gal-item';
	} else {
		$image_gallery_size = 'span3 grid-gal-item';
	}
	$images = rwmb_meta( 'richer_screenshot', 'type=image&size='.$image_size );
	if($gallery_type == 'true'){
		$image_size = 'span4';
		$images = rwmb_meta( 'richer_screenshot', 'type=image&size='.$image_size );
		if ( !empty($images)){ ?>
			<div class="post-gallery clearfix">
				<div class="row-fluid">
					<?php foreach( $images as $image ) :  ?>
						<div class="<?php echo $image_gallery_size; ?>"><a href="<?php echo $image['full_url']; ?>" rel="prettyphoto[gallery]"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a></div>
					<?php endforeach; ?>
				</div>
			</div> 
		<?php } 
	} else { ?>
	<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery(".post-gallery").flexslider({
				animation: "fade",
				slideshow: true,
				smoothHeight : true,
				directionNav: true,
				controlNav: false,
			});
		});
	</script>
	<?php if ( !empty($images)){ ?>
	<div class="post-gallery flexslider">
		<ul class="slides">
			<?php foreach( $images as $image ) :  ?>
				<li><a href="<?php echo $image['full_url']; ?>" rel="prettyphoto[gallery]"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a></li>
			<?php endforeach; ?>
		</ul>
	</div>	
<?php } } ?>