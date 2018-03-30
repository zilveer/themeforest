<?php get_header(); ?>
<div class="loadpageajax"> </div> 
<div class="clearfix"></div>
<div id="homepostswrapper">
<div id="teamwrap">
<?php $count = 1; ?>
<?php $homepageposts = explode(", ", $eet_option['eetcnt_hp_posts']); ?>

<?php $wp_query = new WP_Query( array( 'post_type' => 'page', 'post__in' => $homepageposts, 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );?>

<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
    
    <?php $thumb = get_post_thumbnail_id();
    if (has_post_thumbnail()) $image = vt_resize( $thumb,'' , 240, 175, true ); ?>

    <?php $subtitle = get_post_custom_values("title"); ?>
    <?php $content = get_post_custom_values("pex"); ?>
        <?php
        if ($count == 1) $class='boxhome bhomefirst';
        if ($count == 2) $class='boxhome';
        if ($count == 3) $class='boxhome boxhomelast';
        ?>
    <a href="<?php the_permalink() ?>" class="homeload" > <div class="boxhome bhomefirst">
        <div class="bhomewrap"><div class="whitebg"></div>
        <div class="imagetitle">
            <div class="whitebg"></div>
            <?php if (has_post_thumbnail()) { ?><img  class="imghBXhome" src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>" /> <?php }; ?>
            <div class="clearfix"></div>
            <h1><?php the_title(); ?></h1>
            <h2><?php echo $subtitle[0]; ?></h2>
        </div>
        <p><?php echo do_shortcode($content[0]); ?></p></div>
        <div class="readmore"><span><?php echo $eet_option['eetcnt_tr_rm'] ?></span></div>

    </div></a>
    <?php $count++; ?>


<?php endwhile; else: ?>
<?php endif; ?>
</div>
</div>
<div class="clearfix"></div>


<?php get_footer(); ?>