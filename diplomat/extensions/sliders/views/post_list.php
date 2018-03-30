<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$unique_id = uniqid();
$imgurl = ($imgurl) ? $imgurl : 'http://placehold.it/230x184&text=NO IMAGE';
?>

<li class="post_slider_item">
    <div  class="post_thumb" style="background-image: url('<?php echo $imgurl ?>'); width:230px; height:184px; background-size: cover;" ></div>
    <input type="hidden" class="post_id" value="<?php echo esc_attr($id); ?>" />

    <div class="post_slide_title">
        <h3><?php if (strlen($title)>32){ $title_s=mb_substr($title, 0, 32); echo esc_html($title_s . '...'); } else echo esc_html($title); ?></h3>
    </div>
</li>
        
