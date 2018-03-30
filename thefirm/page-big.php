<?php
/*
Template Name: Big Page 
*/
?>
<?php if (!(isset($_POST["ishome"]) && $_POST["ishome"] == 1)) 
	$firmIsPage = true;


if ($firmIsPage) {
?>
	<?php get_header(); ?>

<?php }; ?>
<?php $subtitle = get_post_custom_values("title"); ?>
<div class="homepostload homereadybig">
	
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1 class="pageposttitle"><?php the_title(); ?></h1>
            <h2 class="pagepostsub"><?php echo $subtitle[0]; ?></h2>
    <?php $subtitle = get_post_custom_values("title"); ?>
    <?php $content = get_post_custom_values("pex"); ?>
<?php if (has_post_thumbnail()) { ?> 
    <div class="pthumbnailbig">
            <?php $thumb = get_post_thumbnail_id();
            $image = vt_resize( $thumb,'' , 860, 220, true ); ?>
            <img src="<?php echo $image['url']; ?>" width="860" height="220" alt="<?php the_title(); ?>" />
            
    </div>
<?php } ?>
<?php the_content(); ?>


	    
	<?php if (!$firmIsPage) { ?><img src="<?php echo get_template_directory_uri(); ?>/images/close.png"  alt= "<?php __('Close', 'eet_textdomain'); ?>" class="close"  /> <?php }; ?>
    <?php endwhile; else: ?>
    <?php endif; ?>
</div>


<?php if ($firmIsPage) { ?>
	<?php get_footer(); ?>
<?php }; ?>