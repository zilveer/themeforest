<?php epic_user_registration_head();?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="UTF-8">
<title>
<?php wp_title(''); ?>
<?php if(wp_title('', false)) { echo ' :: '; } ?>
<?php bloginfo('name'); if(is_home()) { echo ' :: '; bloginfo('description'); } ?>
</title>
<?php epic_enqueue_theme_js();?>
<?php load_theme_textdomain( 'epic', TEMPLATEPATH . '/languages' );?>

<?php
$bodyfont = get_option('epic_body_google_fontfamily');
$bodyfont_weight = get_option('epic_body_google_fontfamily_weight');

$titlefont = get_option('epic_google_title_fontfamily');
$titlefont_weight = get_option('epic_title_google_fontfamily_weight');
?>
 <script type="text/javascript">
	      WebFontConfig = {
	        google: { families: [ '<?php echo $bodyfont.$bodyfont_weight;?>', '<?php echo $titlefont.$titlefont_weight;?>' ] }
	      };
	      (function() {
	        var wf = document.createElement('script');
	        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
	            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
	        wf.type = 'text/javascript';
	        wf.async = 'false';
	        var s = document.getElementsByTagName('script')[0];
	        s.parentNode.insertBefore(wf, s);
	      })();

</script>
	      
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
<?php wp_head(); ?>





<?php 
if(is_page() || is_single()){

	$page_background = get_post_meta($post->ID,'epic_page_background',true);
	$epic_page_background_color = get_post_meta($post->ID,'epic_page_background_color',true);
	$fit_to_screen   = get_post_meta($post->ID,'epic_page_background_stretch',true);
	$page_css   = get_post_meta($post->ID,'epic_page_css',true);

	if( $page_css || $page_background || $epic_page_background_color){

	echo '<style>'."\n";
	if($epic_page_background_color) {echo '#wrapper{background-color:'.$epic_page_background_color.' !important; background-image:none;}'."\n";}
	if($page_background ){ echo '#wrapper {background-image:url('.$page_background.') !important;}';}
	if($page_css){echo $page_css."\n";}

	echo '</style>'."\n";
	}

	}
?>
</head>
<body <?php body_class();?>>

<?php ?>

<?php 
epic_wrapper_alpha();

epic_content_alpha();
?>