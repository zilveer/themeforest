<?php
$autoplay  = of_get_option('player_autoplay');
$opened    = of_get_option('player_opened');
$next      = of_get_option('player_next');
$player = of_get_option('player_default');
$player_id = of_get_option('player_id');
$player_sound = of_get_option('player_soundcloud');

echo '
<script type="text/javascript">
    soundManager.url = "' . get_template_directory_uri() . '/swf/";
    soundManager.flashVersion = 9;
    soundManager.useHTML5Audio = true;
    soundManager.debugMode = false;

    jQuery(document).ready(function() {
		
        jQuery("#fap").fullwidthAudioPlayer({
            keyboard: false,
            autoPlay: ' . esc_js($autoplay) . ',
            opened: ' . esc_js($opened) . ',
            playNextWhenFinished: ' . esc_js($next) . '
        });
		
    });
</script>
';

global $post;
$query = new WP_Query();
$query->query('post_type=audio&p=' . $player_id . '&posts_per_page=1');
while ($query->have_posts()):
    $query->the_post();
    $custom         = get_post_custom($post->ID);
    $image_id       = get_post_thumbnail_id();
    $cover          = wp_get_attachment_image_src($image_id, 'AdMx');
    $genre          = $custom["ad_genre"][0];
    $data           = get_post_meta($post->ID, 'release_date', true);
    $time           = strtotime($data);
    $pretty_date_yy = date('Y', $time);
    $pretty_date_M  = date('M', $time);
    $pretty_date_d  = date('d', $time);
    $args           = array(
        'post_type' => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => $post->ID
    );
    $attachments    = get_posts($args);
    $arrImages =& get_children('post_type=attachment&orderby=title&order=ASC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());
    $playlist = null;
    if ($arrImages) {
        foreach ($arrImages as $attachment) {
            $playlist .= '
    <a href="' . esc_url(wp_get_attachment_url($attachment->ID)) . '" title="' . esc_attr($attachment->post_title) . '" rel="' . esc_attr($cover[0]) . '" data-meta="#player-meta"></a>';
        }
    }
	
endwhile;

echo '
<div id="fap">';

switch ($player) {
    case "audio":
		echo '
		 ' . $playlist . '
    <span id="player-meta">
		<a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>
		<div>' . esc_html($genre, "wizedesign") . '</div>
	</span><!-- end span#player-meta -->';
	
    break;
		
	case "soundcloud":
		echo '
	<a class="fap-single-track" href="' . esc_url($player_sound) . '"></a>';
	
    break;	
}

echo '
</div><!-- end #fap -->
';

wp_reset_postdata();