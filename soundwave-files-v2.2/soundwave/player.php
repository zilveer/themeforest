<?php
	$autoplay = of_get_option('player_autoplay');
	$opened = of_get_option('player_opened');
	$next = of_get_option('player_next');
		
	echo '
<script type="text/javascript">
    soundManager.url = "'.get_template_directory_uri().'/swf/";
	soundManager.flashVersion = 9;
	soundManager.useHTML5Audio = true;
	soundManager.debugMode = false;
	
    jQuery(document).ready(function(){
		
		//put your own soundcloud key here
    	jQuery("#fap").fullwidthAudioPlayer({ 
		keyboard: false,';
		
switch ($autoplay) {
        case "autoplay_on":
            echo 'autoPlay: true, ';
		break;	
		
        case "autoplay_off":
            echo 'autoPlay: false, ';
		break;
}		
		
switch ($opened) {
        case "opened_open":
            echo 'opened: true, ';
		break;	
		
        case "opened_closed":
            echo 'opened: false, ';
		break;
}	

switch ($next) {
        case "next_on":
            echo 'playNextWhenFinished: true, ';
		break;	
		
        case "next_off":
            echo 'playNextWhenFinished: false, ';
		break;
}	
		echo '
		});
	});
</script>';
	?>
	
<?php
$player_id = of_get_option('player_id');
        global $post;
        $query = new WP_Query();
        $query->query('post_type=audio&p='.$player_id.'&posts_per_page=1');
        while ($query->have_posts()):
            $query->the_post();
			$custom         = get_post_custom($post->ID);
			$image_id       = get_post_thumbnail_id();
            $cover          = wp_get_attachment_image_src($image_id, 'audio-widget');
			$genre          = $custom["audio_genre"][0];
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
            $playlist =null;
            if ($arrImages) {
                foreach ($arrImages as $attachment) {
                    $playlist .= '
          <a href="' . wp_get_attachment_url($attachment->ID) . '" title="' . $attachment->post_title . '" rel="' . $cover[0] . '" data-meta="#player-meta"></a>';
                }
			}
endwhile;
echo '
<div id="fap">';
if ($player_id) { 
echo '' . $playlist . ' ';
}

if ($player_id) { 
?>
<span id="player-meta">
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<div><?php echo ' ' . $pretty_date_d . ' ' . $pretty_date_M . '  ' . $pretty_date_yy . ' | '.$genre.' '; ?></div>
</span>
<?php
}
?>
</div>

<?php wp_reset_query(); ?> 