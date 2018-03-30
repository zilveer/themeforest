<?php
/**
* @KingSize 2011
* The PHP code for setup Theme Gallery Page support header file.
* Begin creating Gallery Page support header file
* Gallery Page support header file
*/
global $tpl_body_id;

###### getting current template name ######
global $wp_query,$data;
$template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true );

if ($tpl_body_id=="colorbox"  || $template_name == "template-colorbox.php") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/colorbox.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.colorbox.js"> </script>
<?php
}
elseif ($tpl_body_id=="fancybox"  || $template_name == "template-fancybox.php") { 
?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-buttons.js?v=1.0.5"></script>	
<?php
}
elseif ($tpl_body_id=="prettyphoto"   || $template_name == "template-prettyphoto.php") { 
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 
<?php
}
elseif ($tpl_body_id=="blog_overview" ) {
?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 

	<script type="text/javascript">  
	 jQuery(document).ready(function($) {
		<?php if ( $data['wm_blog_img_gallery_nxt_prev'] == "1" ) {	?>
			var items = jQuery('div#content a,div.post a,div.page_content a').filter(function() {
				if (jQuery(this).attr('href')){	

					//alert(jQuery(this).attr('rel')); 7/11/2013
					if(jQuery(this).attr('rel') == undefined) //if there is no rel defined in anchor
					{
					 return jQuery(this).attr('href').match(/\.(jpg|png|gif|JPG|GIF|PNG|Jpg|Gif|Png|JPEG|Jpeg)/);
					}
				}
			});
			
			if (items.length > 1){
				var gallerySwitch="prettyPhoto[gallery]";
			}else{
				var gallerySwitch="";
			}

			items.attr('rel',gallerySwitch);	
		<?php } ?>
		
		$("a[href$='.jpg'], a[href$='.jpeg'], a[href$='.gif'], a[href$='.png']").each(function(){
			if($(this).attr('rel') == undefined || $(this).attr('rel') == "" || $(this).attr('rel') == null || $(this).attr('rel') == 'gallery'){
				$(this).attr('rel','prettyPhoto');	
			}
		});
		
		
		/*
		$('.blog_text').find("a[href$='.jpg']").each(function() {
			if($(this).attr('rel') != 'prettyPhoto[gallery]'){
			    console.log($(this).attr('href'));
				//$(this).attr('rel','');	
			}
		});
		*/
		
		<?php
		//checking if PrettyPhoto is Disabled.
		if($data["wm_prettyphoto_enabled"] == "1") : 
		?>
	    $(".gallery-space a[href$='.jpg'],.gallery-space a[href$='.jpeg'],.gallery-space a[href$='.gif'],.gallery-space a[href$='.png'], .blog_img a[href$='.jpg'],.blog_img a[href$='.jpeg'],.blog_img a[href$='.gif'],.blog_img a[href$='.png']").prettyPhoto({
		<?php else :?>	
		$("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.gif'],a[href$='.png']").prettyPhoto({
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
	</script>
<?php
}
elseif ($tpl_body_id=="galleria"   || $template_name == "template-galleria.php") { 
?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/galleria.js"></script> 
	
	<?php
	if($data["wm_prettyphoto_enabled"] == "0" || $data["wm_prettyphoto_enabled"] == "") :
	?>
	<!-- // If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 
<?php
	endif;
}
elseif ($tpl_body_id=="slideviewer"   || $template_name == "template-slideviewer.php") { 
?>
 <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/responsiveslides.css">
 <script src="<?php echo get_template_directory_uri(); ?>/js/responsiveslides.min.js"></script>
 
 <script type="text/javascript">		
	//Sliderviewer alternate JS ----
	$(document).ready(function(){
		// Slideshow
		$("#slider").responsiveSlides({
			auto: false,
			pager: true,
			speed: 300
		});
	});
 </script>

	<?php
	if($data["wm_prettyphoto_enabled"] == "0" || $data["wm_prettyphoto_enabled"] == "") :
	?>
 <!-- // If an image is inserted into Gallery Page Template (PrettyPhoto) it breaks the page functionality -->
 <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" type="text/css" media="screen"/>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.prettyPhoto.js"></script> 
 
<?php
	endif;
}	
?>
