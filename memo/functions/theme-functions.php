<?php

/* These are functions specific to the included option settings and this theme */


/*-----------------------------------------------------------------------------------*/
/* Output Custom CSS from theme options
/*-----------------------------------------------------------------------------------*/

function tz_head_css() {

		$shortname =  get_option('tz_shortname'); 
		$output = '';
		
		$custom_css = get_option('tz_custom_css');
		$colour = get_option('tz_link_colour');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
		if ( $colour != '#' ) { // maybe a value was deleted
    		if ( $colour <> '' ) {
    		    // text hover colours
    		    $output .= "\ta,\n\t.entry-title a:hover,\n\t.page-title a:hover,\n\th1.entry-title a:hover,\n\th2.entry-title a:hover,\n\t.comment-author cite a:hover,\n\t#sidebar a:hover,\n\t.format-link .post-header a:hover ";
    		    $output .= "{\n\t\tcolor: $colour;\n\t}\n";
    		    // border colours
    		    $output .= "\t.flickr_badge_image img:hover,\n\t.bypostauthor .avatar {\n\tborder-color: $colour;\n\t}";
		    }
		}
		
		// Output styles
		if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo stripslashes($output);
		}
	
}

add_action('wp_head', 'tz_head_css');


/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function tz_favicon() {
	$shortname = get_option('tz_shortname');
	if (get_option($shortname . '_custom_favicon') != '') {
	echo '<link rel="shortcut icon" href="'. get_option('tz_custom_favicon') .'"/>'."\n";
	}
	else { ?>
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />
	<?php }
}

add_action('wp_head', 'tz_favicon');


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function tz_analytics(){
	$shortname =  get_option('tz_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','tz_analytics');


/*-----------------------------------------------------------------------------------*/
/*	Helpful function to see if a number is a multiple of another number
/*-----------------------------------------------------------------------------------*/

function tz_is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
}

/*-----------------------------------------------------------------------------------*/
/*	Gallery JS
/*-----------------------------------------------------------------------------------*/

function tz_gallery($postid) { ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#slider-<?php echo $postid; ?>").slides({
				preload: true,
				preloadImage: jQuery("#slider-<?php echo $postid; ?>").attr('data-loader'), 
				generatePagination: false,
				generateNextPrev: true,
				effect: 'fade',
				crossfade: true,
				autoHeight: true,
				bigTarget: true
			});
		});
	</script>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Audio JS
/*-----------------------------------------------------------------------------------*/

function tz_audio($postid, $width = 600) {
	
    	$mp3 = get_post_meta($postid, 'tz_audio_mp3', TRUE);
    	$ogg = get_post_meta($postid, 'tz_audio_ogg', TRUE);
    	$poster = get_post_meta($postid, 'tz_audio_poster', TRUE);
    	$height = get_post_meta($postid, 'tz_poster_height', TRUE);
	    $height = ($height) ? $height : 46;
    ?>

    		<script type="text/javascript">
		
    			jQuery(document).ready(function($){
	
    				if( $().jPlayer ) {
    					$("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    						ready: function () {
    							$(this).jPlayer("setMedia", {
    							    <?php if($poster != '') : ?>
    							    poster: "<?php echo $poster; ?>",
    							    <?php endif; ?>
    							    <?php if($mp3 != '') : ?>
    								mp3: "<?php echo $mp3; ?>",
    								<?php endif; ?>
    								<?php if($ogg != '') : ?>
    								oga: "<?php echo $ogg; ?>",
    								<?php endif; ?>
    								end: ""
    							});
    						},
    						<?php if( !empty($poster) ) { ?>
    						size: {
            				    width: "<?php echo $width; ?>px",
            				    height: "<?php echo $height . 'px'; ?>"
            				},
            				<?php } ?>
    						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
    					});
					
				}
			});
		</script>
	<?php 
}

/*-----------------------------------------------------------------------------------*/
/*	Video JS
/*-----------------------------------------------------------------------------------*/

function tz_video($postid) {
	
	$m4v = get_post_meta($postid, 'tz_video_m4v', TRUE);
	$ogv = get_post_meta($postid, 'tz_video_ogv', TRUE);
	$poster = get_post_meta($postid, 'tz_video_poster', TRUE);
	
	if(has_post_format('video', $postid) || get_post_type($postid) == 'portfolio') {
	 ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				
				if(jQuery().jPlayer) {
					jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
						ready: function () {
							jQuery(this).jPlayer("setMedia", {
								<?php if($m4v != '') : ?>
								m4v: "<?php echo $m4v; ?>",
								<?php endif; ?>
								<?php if($ogv != '') : ?>
								ogv: "<?php echo $ogv; ?>",
								<?php endif; ?>
								<?php if ($poster != '') : ?>
								poster: "<?php echo $poster; ?>"
								<?php endif; ?>
							});
						},
						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
						supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
					});
					
				}
			});
		</script>
	<?php }
}