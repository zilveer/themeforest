<?php
$first = 'active';
global $jaw_data;
$gallery = jaw_template_get_var('gallery');
jaw_template_inc_counter('gallery');
?>

<div id="jaw-gallery-<?php echo jaw_template_get_counter('gallery'); ?>" class="carousel slide jaw-gallery">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php
        foreach ((array) $gallery as $key => $image) {
            ?><div class="item <?php echo $first; ?>">
                <div class="carousel-caption row">
                    <?php if (jaw_template_get_var('lightbox', '0') == '1') { 
                       
                        ?>
                        <a href="<?php echo $image['url']; ?>" rel="prettyPhoto[gal-<?php echo jaw_template_get_counter('gallery'); ?>]" title="<?php echo ($image['description']!='')?$image['description']:'' ?>">
                        <?php } ?>

                        <img class="lazy" src="<?php echo $image['url-small']; ?>" data-original="<?php echo $image['url']; ?>" alt="<?php echo ($image['caption']!='')?$image['caption']:''; ?>" height="<?php echo $image['size']['height']; ?>" width="<?php echo $image['size']['width']; ?>"/>  

                        <?php if (jaw_template_get_var('lightbox', '0') == '1') { ?>
                        </a>
                    <?php } ?>
                </div>
            </div><?php
            $first = '';
        }
        ?></div>
    <!-- Controls -->
    <a class="left carousel-control" href="#jaw-gallery-<?php echo jaw_template_get_counter('gallery'); ?>" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#jaw-gallery-<?php echo jaw_template_get_counter('gallery'); ?>" data-slide="next">
        <span class="icon-next"></span>
    </a>
</div>
<div class="clear"></div>

