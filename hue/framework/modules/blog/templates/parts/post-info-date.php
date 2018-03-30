<div class="mkd-post-info-date">
    <?php if(!hue_mikado_post_has_title()) { ?>
    <a href="<?php the_permalink() ?>">
        <?php } ?>
        <span><?php the_time(get_option('date_format')); ?></span>
        <?php if(!hue_mikado_post_has_title()) { ?>
    </a>
<?php } ?>
</div>