<?php
get_header();
?>


<div id="content">

<div class="title-head"><h1><?php
if (function_exists('cat_post_types'))
    cat_post_types();
?></h1></div>

<div class="fixed">
  <div class="audio-single-col">					
    <div class="audio-single-cover">
<?php
$custom         = get_post_custom($post->ID);
$image_id       = get_post_thumbnail_id();
$cover          = wp_get_attachment_image_src($image_id, 'audio-single');
$itunes         = $custom["audio_itunes"][0];
$amazon         = $custom["audio_amazon"][0];
$beatport       = $custom["audio_beatport"][0];
$other          = $custom["audio_other"][0];
$other_text     = $custom["audio_other_text"][0];
$genre          = $custom["audio_genre"][0];
$data_audio     = get_post_meta($post->ID, 'release_date', true);
$time           = strtotime($data_audio);
$pretty_date_yy = date('Y', $time);
$pretty_date_M  = date('M', $time);
$pretty_date_d  = date('d', $time);
if ($image_id) {
    echo '
      <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
} else {
    echo '
      <img src="' . get_template_directory_uri() . '/images/no-featured/audio-single.png" alt="no image" />';
}
echo '
        <ul class="audio-meta">';
if ($genre != null) {
    echo '
          <li><span>' . __('Genre', 'clubber') . ':</span>' . $genre . '</li>';
}
if ($data_audio != null) {
    echo '
          <li><span>' . __('Release date', 'clubber') . ':</span>' . $pretty_date_d . ' ' . $pretty_date_M . '  ' . $pretty_date_yy . '</li>';
}
echo '
        </ul><!-- end ul.audio-meta -->';
if ($amazon != null) {
    echo '
        <div class="audio-buy"><a href="' . $amazon . '">Amazon</a></div>';
}
if ($itunes != null) {
    echo '
        <div class="audio-buy"><a href="' . $itunes . '">iTunes</a></div>';
}
if ($beatport != null) {
    echo '
        <div class="audio-buy"><a href="' . $beatport . '">Beatport</a></div>';
}
if ($other != null) {
    echo '
        <div class="audio-buy"><a href="' . $other . '">' . $other_text . '</a></div>';
}
?>

    </div><!-- end .audio-single-cover -->

    <div class="audio-single">
        <h2 class="audio-single-title"><?php the_title(); ?></h2>

<?php
$player = null;
$playlist = null;
$args        = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_status' => null,
    'post_parent' => $post->ID
);
$attachments = get_posts($args);
$arrImages =& get_children('post_type=attachment&orderby=menu_order&order=DESC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());
$player .= '
        <div class="audiojsW">
            <audio></audio>
            <div class="play-pauseW">
                <p class="playW"></p>
                <p class="pauseW"></p>
                <p class="loadingW"></p>
                <p class="errorW"></p>
            </div>
            <div class="scrubberW">
                <div class="progressW"></div>
                <div class="loadedW"></div>
            </div>
            <div class="timeW"><em class="playedW">00:00</em>/<strong class="durationW">00:00</strong>
            </div>
            <div class="error-messageW"></div>
        </div><!-- end .audiojsW -->';
if ($arrImages) {
    foreach ($arrImages as $attachment) {
        $playlist .= '
            <li><a href="#" data-src="' . wp_get_attachment_url($attachment->ID) . '">' . $attachment->post_title . '</a></li>';
    }
}
?>

<?php
if ($playlist != null) {
    echo '
' . $player . '

        <ol>
' . $playlist . '

        </ol>';
}
?>

        <div class="audio-post">
            <?php
if (have_posts())
    while (have_posts()):
        the_post();
    endwhile;
?>

            <?php
the_content();
?>
        </div><!-- end .audio-post -->
    </div><!-- end .audio-single -->    
  </div><!-- end .aduio-single-col -->
</div><!-- end .fixed -->
</div><!-- end #content -->

<?php
get_footer();
?>