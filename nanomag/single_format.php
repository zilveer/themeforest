<div class="single_post_format">
<?php if(has_post_format('quote')){?>
<div class="single_post_format_quote">
  <blockquote class="quote_content"><span>
<p class="quote_source"><?php $quote_source= get_post_custom_values('quote_jellywp_textarea'); if($quote_source !=""){echo esc_attr($quote_source[0]);}?></p>
</span></blockquote>
</div>
<?php }elseif(has_post_format('gallery')){?>
<div class="full-width-slider header-slider2">
<div class="owl_slider slider-large full-width-slider owl-carousel">
<?php
global $wpdb;
$images = get_post_meta( get_the_ID(), 'image_upload_slider_jellywp_imgadv', false );
$images = implode( ',' , $images );
// Re-arrange images with 'menu_order'
if($images){
$images = $wpdb->get_col( "
    SELECT ID FROM {$wpdb->posts}
    WHERE post_type = 'attachment'
    AND ID in ({$images})
    ORDER BY menu_order ASC
" );
foreach ( $images as $att )
{
    // Get image's source based on size, can be 'thumbnail', 'medium', 'large', 'full' or registed post thumbnails sizes
    $src = wp_get_attachment_image_src( $att, 'slider-feature' );
    $src = $src[0];
    // Show image
  echo '<div class="item_slide home_large_img_slider">';?>
    <img src='<?php echo esc_attr("{$src}");?>' />
  <?php echo '</div>';
}}
   ?>
  </div>
</div>    
<?php }elseif(has_post_format('video')){?>
<div class="single_post_format_video">
<?php $full= get_post_custom_values('embed_video_jellywp_textarea'); if($full){echo $full[0];}?>
</div>
<?php }elseif(has_post_format('audio')){?>
<div class="single_post_format_audio">
<?php 
$full= get_post_custom_values('html5_audio_mp3_jellywp_text');
if($full!=''){
if ( has_post_thumbnail()) {the_post_thumbnail('slider-feature');}?>
<audio  src="<?php  if($full!=''){echo esc_attr($full[0]);}?>" type="audio/mp3" controls="controls"></audio>
<?php }else{?>
<?php 
if ( has_post_thumbnail()) {the_post_thumbnail('slider-feature');}
$full= get_post_custom_values('embed_audio_jellywp_textarea'); if($full){echo $full[0];}?>
<?php }echo '</div>';}else{?>
<div class="single_post_format_image">
    <?php if ( has_post_thumbnail()) {the_post_thumbnail('slider-feature');}
else{echo '<img class="no_feature_img" alt="" src="'.get_template_directory_uri().'/img/feature_img/slider-feature.jpg'.'">';} ?>
</div>   
<?php }?>
</div>