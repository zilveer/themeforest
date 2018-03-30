<?php if(os_get_show_featured_posts_on_index() == true){ ?>
  <?php if(os_get_featured_posts_type_on_index() == 'compact'){ ?>
    <?php echo do_shortcode('[os_featured_slider]'); ?>
  <?php }else{ ?>
    <?php echo do_shortcode('[os_featured_carousel]'); ?>
  <?php } ?>
<?php } ?>