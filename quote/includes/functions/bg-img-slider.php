<?php 

//==========================================================
// === REALTED BITS YO
//==========================================================
function dt_bg_slider() {
	wp_reset_query();
	global $post;
	$bgimgs = rwmb_meta( 'additonal_images', 'type=image' );

	if (is_page_template( 'page-templates/template-page-builder-home.php' ) && $bgimgs || 
		is_page_template( 'page-templates/template-page-builder.php' ) && $bgimgs || 
		is_page_template( 'page-templates/template-single-page-home.php' ) && $bgimgs) { ?>

			<script type="text/javascript">
			jQuery(document).ready(function(){
			    <?php $bgimgs = rwmb_meta( 'additonal_images', 'type=image' ); ?>
			    jQuery('#headerwrap').backstretch([
			    <?php if ($bgimgs) { foreach($bgimgs as $bg) :
			            echo '"'; echo $bg['full_url']; echo '",';
			        endforeach; } ?>
			    ], {duration: 5000, fade: 800, fadeFirstImage: false});
			});
			</script> 

	<?php } elseif (is_singular('dt_portfolio_cpt') && $bgimgs) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
	    <?php $bgimgs = rwmb_meta( 'additonal_images', 'type=image' ); ?>
	    <?php $thumb = get_post_thumbnail_id($post->ID); $img_url = wp_get_attachment_url( $thumb,'full' ); ?>
	    <?php if($img_url) { ?>
	    jQuery('#headerwrap').backstretch([
	    <?php if($img_url) {?>"<?php echo $img_url; ?>",<?php } ?>
	    <?php if ($bgimgs) { foreach($bgimgs as $bg) :
	            echo '"'; echo $bg['full_url']; echo '",';
	        endforeach; } ?>
	    ], {duration: 5000, fade: 800, fadeFirstImage: false});
	    <?php } ?>
	});
	</script> 
	<?php } elseif (is_single() && $bgimgs || is_single() && !is_singular('dt_portfolio_cpt') || is_page() && $bgimgs) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
	    <?php $bgimgs = rwmb_meta( 'additonal_images', 'type=image' ); ?>
	    <?php $thumb = get_post_thumbnail_id($post->ID); $img_url = wp_get_attachment_url( $thumb,'full' ); ?>
	    <?php if($img_url) { ?>
	    jQuery('#headerwrap').backstretch([
     	<?php if($img_url) {?>"<?php echo $img_url; ?>",<?php } ?>
	    <?php if ($bgimgs) { foreach($bgimgs as $bg) :
	            echo '"'; echo $bg['full_url']; echo '",';
	        endforeach; } ?>
	    ], {duration: 5000, fade: 800, fadeFirstImage: false});
	    <?php } ?>
	});
	</script>
	<?php } else { ?>
    <?php 
    $bg1 = get_option('bg_01');
    $bg2 = get_option('bg_02');
    $bg3 = get_option('bg_03');
    $bg4 = get_option('bg_04');
    $bg5 = get_option('bg_05');
    $bg6 = get_option('bg_06'); 
    if($bg1 || $bg2 || $bg3 || $bg4 || $bg5 || $bg6) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
	    jQuery('#headerwrap').backstretch([
	      <?php if($bg1) { echo '"'; echo $bg1; echo '"'; }?>
	      <?php if($bg2) { echo ',"'; echo $bg2; echo '"'; }?>
	      <?php if($bg3) { echo ',"'; echo $bg3; echo '"'; }?>
	      <?php if($bg4) { echo ',"'; echo $bg4; echo '"'; }?>
	      <?php if($bg5) { echo ',"'; echo $bg5; echo '"'; }?>
	      <?php if($bg6) { echo ',"'; echo $bg6; echo '"'; }?>
	    ], {duration: 5000, fade: 800, fadeFirstImage: false});
	});
	</script>		
	<?php }
	}

}