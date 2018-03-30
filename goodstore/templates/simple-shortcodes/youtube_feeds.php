<?php global $jaw_data; ?>

<div class="youtube_feeds row">
    <h2><a href="<?php echo jaw_template_get_var('url'); ?>"><?php echo jaw_template_get_var('title'); ?></a></h2>
    <?php foreach ((array) jaw_template_get_var('videos') as $video) { ?>
        <div class="col-lg-6 ">
            <?php if (isset($video['title'])) { ?>
                <h3><?php echo $video['title']; ?></h3> 
            <?php } ?>
            <?php if (isset($video['content'])) { ?>
                <p><?php echo $video['content']; ?></p>
            <?php } ?>
            <?php if (isset($video['link']['href'])) { ?>
                <?php echo do_shortcode('[jaw_y_video clip_id="' . $video['link']['href'] . '" width="470px" title="' . $video['title'] . '" autoplay="false" /]'); ?>
            <?php } ?>
        </div>
    <?php } ?>


</div>