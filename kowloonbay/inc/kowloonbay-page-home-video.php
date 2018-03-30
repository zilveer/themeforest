<?php
/*
Template Name: KowloonBay Homepage (Video Background)
*/

the_post();

get_header();

global $kowloonbay_redux_opts;

$homepage_youtube_or_html5 = get_query_var('homepage_youtube_or_html5');
if ($homepage_youtube_or_html5 === '')
	$homepage_youtube_or_html5 = $kowloonbay_redux_opts['homepage_youtube_or_html5'];
$homepage_youtube_url = $kowloonbay_redux_opts['homepage_youtube_url'];
$homepage_youtube_quality = $kowloonbay_redux_opts['homepage_youtube_quality'];
$homepage_youtube_mute = ($kowloonbay_redux_opts['homepage_youtube_mute'] === '1');
$homepage_youtube_loop = ($kowloonbay_redux_opts['homepage_youtube_loop'] === '1');
$homepage_youtube_opacity = $kowloonbay_redux_opts['homepage_youtube_opacity'];
$homepage_youtube_start_at = (int)$kowloonbay_redux_opts['homepage_youtube_start_at'];
$homepage_youtube_stop_at = $kowloonbay_redux_opts['homepage_youtube_stop_at'];
if ($homepage_youtube_stop_at !== '') $homepage_youtube_stop_at = (int) $homepage_youtube_stop_at;

if ($homepage_youtube_mute) $homepage_youtube_mute = 'true'; else $homepage_youtube_mute = 'false';
if ($homepage_youtube_loop) $homepage_youtube_loop = 'true'; else $homepage_youtube_loop = 'false';

$youtube_shortcode = '[mbYTPlayer url="'.$homepage_youtube_url.'" opacity="'.$homepage_youtube_opacity.'" quality="'.$homepage_youtube_quality.'" ratio="auto" isinline="false" showcontrols="false" realfullscreen="true" printurl="true" autoplay="true" mute="'.$homepage_youtube_mute.'" loop="'.$homepage_youtube_loop.'" addraster="false" gaTrack="false" startat="'.$homepage_youtube_start_at.'" stopat="'.$homepage_youtube_stop_at.'"]';

global $kowloonbay_allowed_html;
?>
		
		<?php the_content(); ?>
		<?php 
			if ($homepage_youtube_or_html5 === 'youtube' && $homepage_youtube_url !== ''){
				echo wp_kses(do_shortcode($youtube_shortcode), $kowloonbay_allowed_html);
			}
		?>
<?php 
get_footer();