<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();


$query = array(
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_status' => 'inherit',
);

if ($images) {
    $query['post__in'] = explode(',', $images);
}

$r = new WP_Query($query);

?>

<div id="mk-slideshow-box-<?php echo $id; ?>" class="mk-slideshow-box mk-page-section full-width-<?php echo $full_width_cnt; ?> full-height-<?php echo $full_height; ?> <?php echo $el_class; ?> <?php if( $full_height == 'true' ) echo 'js-el' ?>" <?php if( $full_height == 'true' ) echo 'data-mk-component="FullHeight"' ?> data-transitionspeed="<?php echo $transition_speed; ?>" data-slideshowspeed="<?php echo $slideshow_speed; ?>">
	
	<div style="background-color:<?php echo $overlay; ?>;" class="mk-slideshow-box-color-mask"></div>

	<div class="mk-slideshow-box-items">
		<?php if ( $r->have_posts() ) : ?>
		    <?php while ( $r->have_posts() ) :
		        $r->the_post();
		            $image_src_array = wp_get_attachment_image_src(get_the_ID(), 'full');
		             ?>
		    		<div class="mk-slideshow-box-item" style="background-image:url(<?php echo $image_src_array[0]; ?>);"></div>
			    <?php endwhile;
			    wp_reset_query();
			endif;
		?>
	</div>

	<?php if ($full_width_cnt == "false") { ?>
		<div class="mk-grid">
	<?php } ?>

		<div class="mk-slideshow-box-content "><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>

	<?php if ($full_width_cnt == "false") { ?>
		</div>
	<?php } ?>

	<?php if ($slideshow_mask == "true") { ?>
		<div class="mk-video-mask"></div>
	<?php } ?>

</div>



<?php

if($full_height != 'true') {
	Mk_Static_Files::addCSS('
	#mk-slideshow-box-'.$id.' {
		min-height: '.$section_height.'px;
	}
	', $id);
}
Mk_Static_Files::addCSS('
#mk-slideshow-box-'.$id.' {
	min-height: '.$section_height.'px;
}

.mk-slideshow-box-content {
	padding-top: '.$padding_top.'px;
	padding-bottom: '.$padding_bottom.'px;
}
', $id);

if($background_cover == 'true') {
	Mk_Static_Files::addCss('
		.mk-slideshow-box-item{
			background-size: cover;
			background-size: cover;
  			-webkit-background-size: cover;
  			-moz-background-size: cover;
		}
	', $id);
}


Mk_Static_Files::addCss('
	.mk-slideshow-box-item{
		background-repeat: '.$bg_repeat.';
		background-position: '.$bg_position.';
	}
', $id);