<?php $custom = get_post_custom(get_the_ID()); ?>
<?php echo do_shortcode('[video link="' . $custom['video'][0] . '"]') ?>
<script>
jQuery(document).ready(function(){
  jQuery(".videoFrameContainer").fitVids();
});
</script>