<?php get_header(); ?>

<div id="content">

   <div class="title-head"><h1><?php
the_title();
?></h1></div>

   <div class="adsng-col clearfix">					
      <div class="adsng-left">
<?php
$custom         = get_post_custom($post->ID);
$image_id       = get_post_thumbnail_id();
$cover          = wp_get_attachment_image_src($image_id, 'audio-single');
$cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
$itunes         = $custom["audio_itunes"][0];
$amazon         = $custom["audio_amazon"][0];
$beatport       = $custom["audio_beatport"][0];
$other          = $custom["audio_other"][0];
$other_text     = $custom["audio_other_text"][0];
$genre          = $custom["audio_genre"][0];
$price          = $custom["audio_price"][0];
$artist         = $custom["audio_artist"][0];
$data_audio     = get_post_meta($post->ID, 'release_date', true);
$time           = strtotime($data_audio);
$pretty_date_yy = date('Y', $time);
$pretty_date_M  = date('F', $time);
$pretty_date_d  = date('d', $time);
$no_cover       = get_template_directory_uri();
echo '
         <div class="adsng-cover">
            <div class="wz-wrap wz-hover">';
if ($image_id) {
    echo '
               <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
} else {
    echo '
               <img src="' . $no_cover . '/images/no-cover/audio-sng.png" alt="no image" />';
}

echo '	
               <div class="he-view">
                  <div class="bg a1" data-animate="fadeIn">	
							<a href="' . get_permalink() . '" class="adsng-link a2" data-animate="zoomIn"></a>
							<a href="' . $cover_large[0] . '" class="adsng-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
                  </div>
               </div>	
            </div>			
         </div><!-- end .blog-home-cover --> ';
echo '
         <div class="adsng-info">';
if ($genre != null) {
    echo '	  
            <div class="evsng-info-in">
               <div class="adsng-cell">' . __('Genre', 'wizedesign') . '</div>
               <div class="adsng-cell-info">' . $genre . '</div>					  
            </div>';
}
if ($pretty_date_d != null) {
    echo '	 
            <div class="evsng-info-in">                                     
               <div class="adsng-cell">' . __('Release date', 'wizedesign') . '</div>
               <div class="adsng-cell-info">' . $pretty_date_d . ' ' . $pretty_date_M . '  ' . $pretty_date_yy . '</div>                                    
            </div>';
}
if ($artist != null) {
    echo '
            <div class="evsng-info-in">                                     
               <div class="adsng-cell">' . __('Artist', 'wizedesign') . '</div>
               <div class="adsng-cell-info">' . $artist . '</div>                                    
            </div>';
}
if ($price != null) {
    echo '
            <div class="evsng-info-in">                                     
               <div class="adsng-cell">' . __('Price', 'wizedesign') . '</div>
               <div class="adsng-cell-info">' . $price . '</div>                                    
            </div>';
}
echo '
         </div>';

if ($amazon != null) {
    echo '
         <div class="adsng-buy"><a href="' . $amazon . '">Amazon</a></div>';
}
if ($itunes != null) {
    echo '
         <div class="adsng-buy"><a href="' . $itunes . '">iTunes</a></div>';
}
if ($beatport != null) {
    echo '
         <div class="adsng-buy"><a href="' . $beatport . '">Beatport</a></div>';
}
if ($other != null) {
    echo '
         <div class="adsng-buy"><a href="' . $other . '">' . $other_text . '</a></div>';
}
?>

      </div><!-- end .adsng-left -->
      <div class="adsng-text">
<?php
$player      = null;
$playlist    = null;
$args        = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_status' => null,
    'post_parent' => $post->ID
);
$attachments = get_posts($args);
$arrImages =& get_children('post_type=attachment&orderby=title&order=ASC&post_mime_type=audio/mpeg&post_parent=' . get_the_ID());

if ($arrImages) {
    foreach ($arrImages as $attachment) {
        $playlist .= '
            <li><a href="' . wp_get_attachment_url($attachment->ID) . '" title="' . $attachment->post_title . '" rel="' . $cover[0] . '" data-meta="#player-meta-widget" class="no-ajax">' . $attachment->post_title . '</a>  </li>';
    }
}
echo ' 
         <ul class="fap-my-playlist"> 
' . $playlist . ' 
         </ul>
         <span id="player-meta-widget">';
?>
<a href="<?php
the_permalink();
?>"><?php
the_title();
?></a>
<div><?php
echo ' ' . $pretty_date_d . ' ' . $pretty_date_M . '  ' . $pretty_date_yy . ' | ' . $genre . ' ';
?></div>
         </span>
         <div class="audio-post">
<?php
if (have_posts())
    while (have_posts()):
        the_post();
    endwhile;
?>

<?php the_content(); ?>
         </div><!-- end .audio-post -->
      </div><!-- end .adsng-text -->    
  </div><!-- end .adsng-col clearfix -->
  
</div><!-- end #content -->

<?php get_footer(); ?>