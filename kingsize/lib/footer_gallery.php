<?php
global $tpl_body_id,$portfolio_page,$data;

### getting current file template name ###
global $wp_query;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

if ($tpl_body_id=="colorbox"  || $template_name == "template-colorbox.php") { 
?>
<script type="text/javascript">

	jQuery(document).ready(function() { 

		var items = jQuery('div#content a,div.post a,div.page_content a').filter(function() {
			if (jQuery(this).attr('href'))	
				return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
		});

	<?php if ( $data['wm_img_gallery_nxt_prev'] == "1" ) {	?>
			if (items.length > 0){
				var gallerySwitch="gallery";
			}else{
				var gallerySwitch="";
			}
	<?php } else { ?>
			var gallerySwitch="";
	<?php  } ?>
		

		items.attr('rel',gallerySwitch);

		
		// Setting colorbox ------------------------------------------------------------------------------
		$(document).ready(function(){
			$(".gallery_2col").colorbox({fixed: true, maxWidth: '95%',maxHeight: '95%', rel:'gallery_2col' <?php if($data["wm_gallery_titles_colorbox"] != "Enable Colorbox Titles") { echo ", 'title' : false"; } ?>});	
			$(".gallery_3col").colorbox({fixed: true, maxWidth: '95%',maxHeight: '95%', rel:'gallery_3col' <?php if($data["wm_gallery_titles_colorbox"] != "Enable Colorbox Titles") { echo ", 'title' : false"; } ?>});
			$(".gallery_4col").colorbox({fixed: true, maxWidth: '95%',maxHeight: '95%', rel:'gallery_4col' <?php if($data["wm_gallery_titles_colorbox"] != "Enable Colorbox Titles") { echo ", 'title' : false"; } ?>});
			$(".gallery_grid").colorbox({fixed: true, maxWidth: '95%',maxHeight: '95%', rel:'gallery_grid' <?php if($data["wm_gallery_titles_colorbox"] != "Enable Colorbox Titles") { echo ", 'title' : false"; } ?>});			
		});

		// If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality
		jQuery("a[rel^='gallery']").colorbox({
			'maxHeight' : '95%',
			'maxWidth' : '95%',
			fixed: true 
			<?php if($data["wm_gallery_titles_colorbox"] != "Enable Colorbox Titles") { echo ", 'title' : false"; } ?>
		});
		
		
		var cboxOptions = {
		  maxWidth: '95%',
		  maxHeight: '95%',
		}
		$(window).resize(function(){
		  $.colorbox.resize({
			width: window.innerWidth > parseInt(cboxOptions.maxWidth) ? cboxOptions.maxWidth : cboxOptions.width,
			height: window.innerHeight > parseInt(cboxOptions.maxHeight) ? cboxOptions.maxHeight : cboxOptions.height
		  });
		});
		//---------------------------------------------------------------------------------------------------
		
	});
</script>
<?php
} elseif ($tpl_body_id=="fancybox"  || $template_name == "template-fancybox.php") { 
?>
<script type="text/javascript">
	
	function formatTitle(title, currentArray, currentIndex, currentOpts) {
	    return '<div id="tip7-title">' + (title && title.length ? '<b>' + title + '</b>' : '' ) + '<span>' + (currentIndex + 1) + ' / ' + currentArray.length + '</span></div>';
	}
	
	jQuery(document).ready(function() { 

			var items = jQuery('div#content a,div.post a,div.page_content a').filter(function() {
				if (jQuery(this).attr('href'))	
					return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
			});
			
	<?php if ( $data['wm_img_gallery_nxt_prev'] == "1" ) {	?>
			if (items.length > 0){
				var gallerySwitch="gallery";
			}else{
				var gallerySwitch="";
			}
	<?php } else { ?>
			var gallerySwitch="";
	<?php  } ?>

	items.attr('rel',gallerySwitch);	
			

		// Fancybox JS Added for responsive ----
		$(document).ready(function(){
			$('.fancybox').fancybox({
				closeClick : true,
				openEffect : 'elastic',
				openSpeed  : 200,
				prevEffect : 'fade',
				nextEffect : 'fade',
				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(0,0,0,0.85)'
						},
						showEarly : false
					}
				},
				'titleFormat'	: formatTitle
				<?php if($data["wm_gallery_titles_fancybox"] != "Enable Fancybox Titles") { echo ", 'title' : ''"; } ?>
			});
		});
		// Fancybox JS ends ----

			//load fancybox and options
			jQuery("#gallery_fancybox ul li a").fancybox({
				'overlayOpacity': '0.8',
				'overlayColor' 	: 'black',
				'transitionIn'  : 'elastic',
				'transitionOut' : 'fade',
				'titlePosition' : 'inside',
				'titleFormat'	: formatTitle
				<?php if($data["wm_gallery_titles_fancybox"] != "Enable Fancybox Titles") { echo ", 'title' : ''"; } ?>
				
			});	
			// If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality
			jQuery("a[rel^='gallery']").fancybox({
				'overlayOpacity': '0.8',
				'overlayColor' 	: 'black',
				'transitionIn'  : 'elastic',
				'transitionOut' : 'fade',
				'titlePosition' : 'inside',
				'titleFormat'	: formatTitle
				<?php if($data["wm_gallery_titles_fancybox"] != "Enable Fancybox Titles") { echo ", 'title' : ''"; } ?>
			});	

	});	
</script>
<?php
}
elseif ($tpl_body_id=="prettyphoto"  || $template_name == "template-prettyphoto.php") { 	
?>
<script type="text/javascript">
	jQuery(document).ready(function() { 

		var items = jQuery('div#content a,div.post a,div.page_content a').filter(function() {
			if (jQuery(this).attr('href')){	

					//alert(jQuery(this).attr('rel')); 7/11/2013 //if there is no rel defined in anchor
					if(jQuery(this).attr('rel') == undefined)
					{
					return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
					}
				}
		});
		
		<?php if ( $data['wm_img_gallery_nxt_prev'] == "1" ) {	?>
				if (items.length > 0){
					var gallerySwitch="prettyPhoto[gallery]";
				}else{
					var gallerySwitch="";
				}
		<?php } else { ?>
				var gallerySwitch="";
		<?php  } ?>

		items.attr('rel',gallerySwitch);	


	//load prettyPhoto
	<?php
	if($portfolio_page == 'portfolio') {	
	?>	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({ <?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false'; }?>});
	<?php } else { ?>
	jQuery(document).ready(function($) {
	
	<?php
	//checking if PrettyPhoto is Disabled.
	if($data["wm_prettyphoto_enabled"] == "1") : 
	?>
	$(".gallery-space a[href$='.jpg'],.gallery-space a[href$='.jpeg'],.gallery-space a[href$='.gif'],.gallery-space a[href$='.png'], .blog_img a[href$='.jpg'],.blog_img a[href$='.jpeg'],.blog_img a[href$='.gif'],.blog_img a[href$='.png']").prettyPhoto({
	<?php else :?>	
	$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").prettyPhoto({
	<?php
	endif;
	?>		
	 
		animationSpeed: 'normal', /* fast/slow/normal */
		padding: 40, /* padding for each side of the picture */
		opacity: 0.7, /* Value betwee 0 and 1 */
		<?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false,'; }?>
		<?php if($data["wm_gallery_titles_prettyphoto"] ==  "Enable PrettyPhoto Titles") { echo 'showTitle: true /* true/false */';} else { echo 'showTitle: false';} ?>
		});
	})
	<?php } ?>
  });
</script>
<?php
}
elseif ($tpl_body_id=="galleria"  || $template_name == "template-galleria.php") { 

	//FIX THE ISSUE OF GALLERIA ON ARCHIVE PAGE 
	 global $tpl_body_arhive_id;
   if($tpl_body_arhive_id!="blog_overview_archive"){	  
?>
<script type="text/javascript">
	
	// Galleria JS ----
	$(document).ready(function(){
		 // Load the classic theme
		Galleria.loadTheme('<?php echo get_template_directory_uri(); ?>/js/galleria.classic.js');
	
		// Initialize Galleria
		//Galleria.run('#galleria');	
		$('#galleria').galleria({height: 0.85, transition: 'fade' <?php if($data["wm_gallery_titles_galleria"] != "Enable Galleria Titles") { echo ", _toggleInfo: false, showInfo: false"; } ?> });
	});
	
	
<?php
if($data["wm_prettyphoto_enabled"] == "0" || $data["wm_prettyphoto_enabled"] == "") {
?>

	// If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality
	jQuery(document).ready(function() { 

		var items = jQuery('div#content a,div.post a,div.page_content a').filter(function() {
			if (jQuery(this).attr('href'))	
				return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
		});

		<?php if ( $data['wm_img_gallery_nxt_prev'] == "1" ) {	?>
			if (items.length > 0){
				var gallerySwitch="prettyPhoto[gallery]";
			}else{
				var gallerySwitch="";
			}
		<?php } else { ?>
				var gallerySwitch="";
		<?php  } ?>

		items.attr('rel',gallerySwitch);	

		jQuery("a[rel^='prettyPhoto']").prettyPhoto({ <?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false'; }?>});
  });
  
<?php
} //End Enable PrettyPhoto
?>

</script>
<?php
   }
}
elseif ($tpl_body_id=="slideviewer"   || $template_name == "template-slideviewer.php") { 
	
	//FIX THE ISSUE OF GALLERIA ON ARCHIVE PAGE 
	 global $tpl_body_arhive_id;
   if($tpl_body_arhive_id!="blog_overview_archive"){
?> 

<?php
if($data["wm_prettyphoto_enabled"] == "0" || $data["wm_prettyphoto_enabled"] == "") {
?>
<script type="text/javascript">	
jQuery(document).ready(function() { 

	var items = jQuery('div#content a,div.post a,div.page_content a').filter(function() {
		if (jQuery(this).attr('href'))	
			return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
	});

	if (items.length > 0){
		var gallerySwitch="prettyPhoto[gallery]";
	}else{
		var gallerySwitch="";
	}

	items.attr('rel',gallerySwitch);	

    jQuery("a[rel^='prettyPhoto']").prettyPhoto({ <?php if($data["wm_prettybox_share_option"] != "Disable PrettyPhoto Share") { echo ''; } else { echo 'social_tools: false'; }?>});

});
</script>
<?php
   }//end enable prettyPhoto

   }
}
?> 
<script type="text/javascript">	
jQuery(document).ready(function() { 
	jQuery('a.posts-read-more').removeAttr('rel');
});
</script>

<?php 
if( $data['wm_backtotop_enabled'] == '1' ) { //back-to-top enabled
?>
<script type="text/javascript">	
// Back to Top
jQuery('body').prepend('<a href="#" class="back-to-top">Back to Top</a>');

var amountScrolled = 300;

jQuery(window).scroll(function() {
	if ( jQuery(window).scrollTop() > amountScrolled ) {
		jQuery('a.back-to-top').fadeIn('slow');
	} else {
		jQuery('a.back-to-top').fadeOut('slow');
	}
});

jQuery('a.back-to-top').click(function() {
	jQuery('html, body').animate({
		scrollTop: 0
	}, 700);
	return false;
});
</script>
<?php
 }
?>