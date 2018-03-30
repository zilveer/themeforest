<?php
$animation = of_get_option('photo_animation');
$slideshow = of_get_option('photo_slideshow');
$opacity   = of_get_option('photo_opacity');
$title     = of_get_option('photo_title');
$social    = of_get_option('photo_social');
$videos    = of_get_option('photo_videos');
$theme     = of_get_option('photo_theme');
$download  = of_get_option('photo_download');
?>
<script type="text/javascript">
jQuery(document).ready(function($){
   if (jQuery().prettyPhoto) {
      	    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: '<?php echo $animation; ?>',
			slideshow: <?php echo $slideshow; ?>,
			opacity: <?php echo $opacity; ?>,
			show_title: <?php echo $title; ?>,
			allow_resize: true,
			default_width: 540,
			default_height: 344,
			counter_separator_label: '/',
			theme: '<?php echo $theme; ?>',
			horizontal_padding: 20,
			autoplay: <?php echo $videos; ?>,		
			ie6_fallback: true,
<?php
			switch ($social) {
			case "off":
            echo '			social_tools: false,';
			}
			switch ($download) {
			case "on":
?>

			image_markup: '<img id="fullResImage" src="{path}" /><a class="pp_download" href="<?php echo get_template_directory_uri(); ?>/includes/download-image.php?imageurl={path}">Download</a>'
<?php
			}
?>

		});
   }
   
   if (jQuery().prettyPhoto) {
      	    jQuery("a[rel^='prettyPhoto-widget']").prettyPhoto({
            animation_speed: '<?php echo $animation; ?>',
			slideshow: <?php echo $slideshow; ?>,
			opacity: <?php echo $opacity; ?>,
			show_title: <?php echo $title; ?>,
			allow_resize: true,
			default_width: 540,
			default_height: 344,
			counter_separator_label: '/',
			theme: '<?php echo $theme; ?>',
			horizontal_padding: 20,
			autoplay: <?php echo $videos; ?>,		
			ie6_fallback: true,
<?php
			switch ($social) {
			case "off":
            echo '			social_tools: false,';
			}
			switch ($download) {
			case "on":
?>

			image_markup: '<img id="fullResImage" src="{path}" /><a class="pp_download" href="<?php echo get_template_directory_uri(); ?>/includes/download-image.php?imageurl={path}">Download</a>'
<?php
			}
?>

		});
   }
   
   });
</script>