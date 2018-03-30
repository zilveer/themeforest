<?php 
get_header();
the_post(); 
?>
 <div class="bg" style="text-align: left">
    <div class="container">
            <div class="headline">
                        <div style="height: 68px">
                            <?php $icon = get_post_meta($post->ID, 'icon', true); if($icon != '') { ?>
                            <img src="<?php echo $icon;?>" />
                            <?php } ?>
                        </div>
                        <h2><?php $top_title = get_post_meta($post->ID, 'top_title', true); if($top_title != '') echo $top_title; else the_title();?></h2>
            </div>
            <p class="singlemeta">
                <?php _e('Posted on', 'Tharsis');?> 
                <?php the_time("d M Y");?> 
                in <?php the_category(', ') ?> | 
                <?php comments_popup_link(esc_html__('0 comments','Tharsis'), esc_html__('1 comment','Tharsis'), '% '.esc_html__('comments','Tharsis')); ?>
            </p>
            <div class="single">
                  <?php the_content();?>
                  <div class="tags">
                     <?php the_tags(esc_attr('Tags: '), ' ', '<br />'); ?> 
                  </div>
                  <?php 
                  edit_post_link(); 
                  comments_template('', true);?>
             </div>
    </div>
</div>
<?php get_footer();?>