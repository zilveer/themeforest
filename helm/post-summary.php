<?php
$single_summary_type= get_post_meta($post->ID, MTHEME . '_post_summary_type', true);
$single_video_type= get_post_meta($post->ID, MTHEME . '_post_video_type', true);
$single_height= get_post_meta($post->ID, MTHEME . '_post_summary_image_height', true);
$single_height_setting= get_post_meta($post->ID, MTHEME . '_post_height_setting', true);

if ($single_height=="") { $single_height=0; }
if ($single_height_setting=="Auto" || $single_height_setting="") { $single_height=0; }

$width=MIN_CONTENT_WIDTH;
$postformat = get_post_format();
if($postformat == "") $postformat="standard";
$count++;
?>
<div class="<?php if ($count==1) { echo 'topseperator'; } ?> entry-wrapper post-<?php echo $postformat; ?>-wrapper clearfix">


<?php
get_template_part( 'includes/postformats/check-postformat' );
?>
</div>



