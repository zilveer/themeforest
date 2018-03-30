<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

get_header(); 

//Get homepage style
global $pp_homepage_style;
$pp_homepage_style = '';

if(isset($_SESSION['pp_homepage_style']))
{
    $pp_homepage_style = $_SESSION['pp_homepage_style'];
}
else
{
    $pp_homepage_style = get_option('pp_homepage_style');
}

//Get homepage gallery images
$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');

//Check homepage style included files
switch($pp_homepage_style)
{
	case 'fullscreen':
		wp_enqueue_script("script-supersized-gallery", get_template_directory_uri()."/templates/script-supersized-gallery.php?gallery_id=".$pp_homepage_slideshow_cat, false, THEMEVERSION, true);
	break;
	
	case 'kenburns':
		wp_enqueue_script("kenburns", get_template_directory_uri()."/js/kenburns.js", false, THEMEVERSION, true);
		wp_enqueue_script("script-kenburns-gallery", get_template_directory_uri()."/templates/script-kenburns-gallery.php?gallery_id=".$pp_homepage_slideshow_cat, false, THEMEVERSION, true);
	break;
	
	case 'flow':
		wp_enqueue_script("script-flow-gallery", get_template_directory_uri()."/templates/script-flow-gallery.php?gallery_id=".$pp_homepage_slideshow_cat, false, THEMEVERSION, true);
	break;
	
	case 'flip':
		wp_enqueue_script("script-flip-gallery", get_template_directory_uri()."/templates/script-flip-gallery.php?gallery_id=".$pp_homepage_slideshow_cat, false, THEMEVERSION, true);
	break;
	
	case 'static':
		$pp_homepage_bg = get_option('pp_homepage_bg');
		wp_enqueue_script("script-static-bg", get_template_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_homepage_bg, false, THEMEVERSION, true);
	break;
	
	case 'wall':
	break;
	
	case 'youtube':
		wp_enqueue_script("jquery.tubular.1.0", get_template_directory_uri()."/js/jquery.tubular.1.0.js", false, THEMEVERSION, true);
		$pp_homepage_youtube_id = get_option('pp_homepage_youtube_id');
		wp_enqueue_script("script-youtube-bg", get_template_directory_uri()."/templates/script-youtube-bg.php?youtube_id=".$pp_homepage_youtube_id, false, THEMEVERSION, true);
	break;
	
	case 'vimeo':
		$pp_homepage_vimeo_id = get_option('pp_homepage_vimeo_id');
?>
<div id="vimeo_bg">
	<iframe frameborder="0" src="http://player.vimeo.com/video/<?php echo $pp_homepage_vimeo_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=0" webkitallowfullscreen="" allowfullscreen=""></iframe>
</div>
<?php
	break;
	
	default:
		$pp_homepage_bg = get_option('pp_homepage_bg');
		wp_enqueue_script("script-static-bg", get_template_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_homepage_bg, false, THEMEVERSION, true);
	break;
}

//Include homepage style content
if(file_exists(get_template_directory() . "/templates/template-homepage-".$pp_homepage_style.".php"))
{
	get_template_part("/templates/template-homepage-".$pp_homepage_style);
}
else
{
	get_template_part("/templates/template-homepage-static");
}

get_footer();
?>