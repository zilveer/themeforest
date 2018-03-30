<?php
$sb = get_post_meta($post->ID, 'sidebarss_position', 1);
$title = get_post_meta($post->ID, 'page_title', 1) 
?>

<?php if( get_post_meta($post->ID, 'cont_lay', 1) !="Full Page"){?>
<div class="container">
<div class="oi_page_holder <?php if ( isset($sb)  && $sb =='No'){?>oi_without_sidebar<?php };?> <?php if( get_post_meta($post->ID, 'cont_lay', 1) =="Without Paddings"){?>oi_page_without_paddings<?php };?> <?php if(get_post_meta($post->ID, 'cont_lay', 1)=='Full Page Raw Scroller'){echo 'oi_full_port_page_raw_scroller oi_page_without_paddings ';};?>">
    <div class="oi_just_page oi_sections_holder">
    <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="row">
            <div class="col-md-12">
                <?php echo qoon_breadcrumbs()?>
                <?php if ($title != "No"){?>
                    <?php if(!is_home() && !is_front_page()) {?>
                    <div class="oi_page_heading">
                        <h1 class="oi_page_title"><span><?php the_title()?></span></h1>
                    </div>
                    <?php };?>
                <?php };?>
                <?php the_content();?>
            </div>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>
</div>
<?php }else{?>
<div class="oi_page_holder oi_full_f_page">
<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php the_content();?>
<?php endwhile; endif; ?>
</div>
<?php };?>
